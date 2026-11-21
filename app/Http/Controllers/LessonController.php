<?php

namespace App\Http\Controllers;

use App\Helpers\Seo;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\Playlist;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    /**
     * Display a listing of lessons.
     */
    public function index(Request $request)
    {
        $search = trim($request->get('q', ''));
        $categorySlug = $request->get('category');
        $tagSlug = $request->get('tag');
        $playlistSlug = $request->get('playlist');

        $query = Lesson::where('is_public', true)
            ->with(['category', 'playlist', 'tags']);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if (!empty($categorySlug)) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if (!empty($tagSlug)) {
            $query->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            });
        }

        if (!empty($playlistSlug)) {
            $query->whereHas('playlist', function ($q) use ($playlistSlug) {
                $q->where('slug', $playlistSlug);
            });
        }

        $lessons = $query->latest()->paginate(9)->withQueryString();

        $categories = Category::withCount(['lessons' => fn($q) => $q->where('is_public', true)])
            ->orderBy('name')
            ->get();

        $tags = Tag::withCount('lessons')->orderBy('name')->get();
        $playlists = Playlist::orderBy('name')->get();

        // SEO metadata
        $title = __('English Lessons & Videos | LearnEnglish Audio');
        $description = __('Browse our collection of real YouTube-powered English lessons. Listen, practice with audio transcripts, and improve your English step by step.');

        if (!empty($categorySlug)) {
            $cat = $categories->firstWhere('slug', $categorySlug);
            if ($cat) {
                $title = $cat->name . ' - ' . __('Lessons') . ' | LearnEnglish Audio';
                $description = $cat->description ?: $description;
            }
        }

        $seoData = Seo::metaTags(
            title: $title,
            description: $description,
            type: 'website',
            extra: [
                'breadcrumbs' => [
                    ['name' => __('Home'), 'url' => route('home')],
                    ['name' => __('Lessons'), 'url' => route('lessons.index')],
                ],
            ]
        );

        return view('lessons.index', compact(
            'lessons',
            'categories',
            'tags',
            'playlists',
            'search',
            'categorySlug',
            'tagSlug',
            'playlistSlug',
            'seoData'
        ));
    }

    /**
     * Display the specified lesson.
     */
    public function show(Request $request, string $locale = null, string $slug = null)
    {
        $slug = $request->route('slug') ?? $slug ?? $locale;

        $lesson = Lesson::where('slug', $slug)
            ->where('is_public', true)
            ->with(['category', 'playlist', 'tags'])
            ->firstOrFail();

        // Extract YouTube video ID
        $youtubeId = null;
        if (!empty($lesson->youtube_url)) {
            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $lesson->youtube_url, $matches)) {
                $youtubeId = $matches[1];
            }
        }

        // Related lessons
        $relatedQuery = Lesson::where('is_public', true)
            ->where('id', '!=', $lesson->id)
            ->with(['category', 'playlist', 'tags']);

        if ($lesson->playlist_id) {
            $relatedLessons = (clone $relatedQuery)
                ->where('playlist_id', $lesson->playlist_id)
                ->latest()
                ->take(4)
                ->get();
        } elseif ($lesson->category_id) {
            $relatedLessons = (clone $relatedQuery)
                ->where('category_id', $lesson->category_id)
                ->latest()
                ->take(4)
                ->get();
        } else {
            $relatedLessons = $relatedQuery->latest()->take(4)->get();
        }

        // Fallback if playlist had no other lessons
        if ($relatedLessons->isEmpty()) {
            $relatedLessons = Lesson::where('is_public', true)
                ->where('id', '!=', $lesson->id)
                ->latest()
                ->take(4)
                ->get();
        }

        // Body transcript lines (already cast to array in model)
        $transcriptLines = is_array($lesson->body) ? $lesson->body : [];

        // SEO metadata
        $seoTitle = $lesson->title . ' | LearnEnglish Audio';
        $seoDesc = Str::limit(strip_tags($lesson->description), 160) ?: __('Watch and listen to this English lesson with real synchronized audio transcripts.');
        
        $breadcrumbs = [
            ['name' => __('Home'), 'url' => route('home')],
            ['name' => __('Lessons'), 'url' => route('lessons.index')],
        ];

        if ($lesson->category) {
            $breadcrumbs[] = [
                'name' => $lesson->category->name,
                'url' => route('categories.show', $lesson->category->slug),
            ];
        }

        $breadcrumbs[] = [
            'name' => $lesson->title,
            'url' => route('lessons.show', $lesson->slug),
        ];

        $seoData = Seo::metaTags(
            title: $seoTitle,
            description: $seoDesc,
            type: 'lesson',
            image: $lesson->image_url ?: ($youtubeId ? "https://i.ytimg.com/vi/{$youtubeId}/hqdefault.jpg" : asset('logo.png')),
            extra: [
                'video_url' => $lesson->youtube_url,
                'youtube_url' => $lesson->youtube_url,
                'embed_url' => $youtubeId ? "https://www.youtube.com/embed/{$youtubeId}" : null,
                'published_time' => $lesson->created_at,
                'breadcrumbs' => $breadcrumbs,
                'tags' => $lesson->tags->pluck('name')->toArray(),
            ]
        );

        return view('lessons.show', compact(
            'lesson',
            'youtubeId',
            'transcriptLines',
            'relatedLessons',
            'seoData'
        ));
    }
}
