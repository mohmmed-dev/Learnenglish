<?php

namespace App\Http\Controllers;

use App\Helpers\Seo;
use App\Models\Category;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlaylistController extends Controller
{
    /**
     * Display a listing of playlists.
     */
    public function index(Request $request)
    {
        $search = trim($request->get('q', ''));
        $categorySlug = $request->get('category');

        $query = Playlist::with('category')
            ->withCount(['lessons' => fn($q) => $q->where('is_public', true)]);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if (!empty($categorySlug)) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        $playlists = $query->latest()->paginate(9)->withQueryString();

        $categories = Category::withCount(['playlists', 'lessons' => fn($q) => $q->where('is_public', true)])
            ->orderBy('name')
            ->get();

        $title = __('Curated English Playlists | LearnEnglish Audio');
        $description = __('Follow clear learning journeys with our curated English video playlists. Master conversations, pronunciation, and listening step-by-step.');

        $seoData = Seo::metaTags(
            title: $title,
            description: $description,
            type: 'playlist',
            extra: [
                'breadcrumbs' => [
                    ['name' => __('Home'), 'url' => route('home')],
                    ['name' => __('Playlists'), 'url' => route('playlists.index')],
                ],
            ]
        );

        return view('playlist.index', compact(
            'playlists',
            'categories',
            'search',
            'categorySlug',
            'seoData'
        ));
    }

    /**
     * Display the specified playlist.
     */
    public function show(Request $request, string $locale = null, string $slug = null)
    {
        $slug = $request->route('slug') ?? $slug ?? $locale;

        $playlist = Playlist::where('slug', $slug)
            ->with([
                'category',
                'lessons' => fn($q) => $q->where('is_public', true)->with('tags'),
            ])
            ->withCount(['lessons' => fn($q) => $q->where('is_public', true)])
            ->firstOrFail();

        $seoTitle = $playlist->name . ' - ' . __('Playlist') . ' | LearnEnglish Audio';
        $seoDesc = Str::limit(strip_tags($playlist->description), 160) ?: __('Watch and practice all lessons in the :name playlist.', ['name' => $playlist->name]);

        $firstLessonImage = $playlist->lessons->first()?->image_url;

        $seoData = Seo::metaTags(
            title: $seoTitle,
            description: $seoDesc,
            type: 'playlist',
            image: $firstLessonImage ?: asset('logo.png'),
            extra: [
                'breadcrumbs' => [
                    ['name' => __('Home'), 'url' => route('home')],
                    ['name' => __('Playlists'), 'url' => route('playlists.index')],
                    ['name' => $playlist->name, 'url' => route('playlists.show', $playlist->slug)],
                ],
                'carousel' => $playlist->lessons->map(fn($l) => [
                    'name' => $l->title,
                    'url' => route('lessons.show', $l->slug),
                    'image' => $l->image_url,
                ])->toArray(),
            ]
        );

        return view('playlist.show', compact('playlist', 'seoData'));
    }
}
