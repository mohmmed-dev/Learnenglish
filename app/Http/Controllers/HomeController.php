<?php

namespace App\Http\Controllers;

use App\Helpers\Seo;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\Playlist;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $channelUrl = 'https://www.youtube.com/@learn_english_audio';
        $selectedCategory = $request->get('category');
        $filterType = $request->get('type'); // 'audio', 'transcript'

        // Categories for the top YouTube-style chips bar
        $categories = Category::withCount(['lessons' => fn($q) => $q->where('is_public', true)])
            ->orderByDesc('lessons_count')
            ->get();

        // Main Lessons query
        $lessonsQuery = Lesson::where('is_public', true)
            ->with(['category', 'playlist', 'tags']);

        if (!empty($selectedCategory)) {
            $lessonsQuery->whereHas('category', function ($q) use ($selectedCategory) {
                $q->where('slug', $selectedCategory);
            });
        }

        if ($filterType === 'audio') {
            $lessonsQuery->whereNotNull('audio_url');
        } elseif ($filterType === 'transcript') {
            $lessonsQuery->whereNotNull('body');
        }

        $lessons = $lessonsQuery->latest()->take(12)->get();

        // Curated playlists for the Playlists shelf
        $playlists = Playlist::with('category')
            ->withCount(['lessons' => fn($q) => $q->where('is_public', true)])
            ->having('lessons_count', '>', 0)
            ->latest()
            ->take(4)
            ->get();

        // If no playlists with lessons yet, take latest
        if ($playlists->isEmpty()) {
            $playlists = Playlist::with('category')
                ->withCount(['lessons' => fn($q) => $q->where('is_public', true)])
                ->latest()
                ->take(4)
                ->get();
        }

        // Featured spotlight lesson (first lesson)
        $featured = $lessons->first();

        // SEO Data
        $seoData = Seo::metaTags(
            title: __('LearnEnglish Audio | Real YouTube Lessons & Transcripts'),
            description: __('Browse and watch authentic YouTube English lessons with line-by-line audio transcripts and shadowing practice.'),
            type: 'website',
            image: $featured?->image_url ?: asset('logo.png'),
            extra: [
                'carousel' => $lessons->map(fn($l) => [
                    'name' => $l->title,
                    'url' => route('lessons.show', $l->slug),
                    'image' => $l->image_url,
                ])->toArray(),
            ]
        );

        return view('home', compact(
            'lessons',
            'playlists',
            'categories',
            'featured',
            'channelUrl',
            'selectedCategory',
            'filterType',
            'seoData'
        ));
    }
}
