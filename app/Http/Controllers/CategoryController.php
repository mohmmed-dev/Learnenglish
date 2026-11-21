<?php

namespace App\Http\Controllers;

use App\Helpers\Seo;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(Request $request)
    {
        $categories = Category::withCount([
            'lessons' => fn($q) => $q->where('is_public', true),
            'playlists',
        ])
        ->orderByDesc('lessons_count')
        ->get();

        $title = __('English Categories & Topics | LearnEnglish Audio');
        $description = __('Explore organized English learning topics: Everyday Conversations, Pronunciation, Business English, Listening Practice, and Idioms.');

        $seoData = Seo::metaTags(
            title: $title,
            description: $description,
            type: 'category',
            extra: [
                'breadcrumbs' => [
                    ['name' => __('Home'), 'url' => route('home')],
                    ['name' => __('Categories'), 'url' => route('categories.index')],
                ],
            ]
        );

        return view('categories.index', compact('categories', 'seoData'));
    }

    /**
     * Display the specified category.
     */
    public function show(Request $request, string $locale = null, string $slug = null)
    {
        $slug = $request->route('slug') ?? $slug ?? $locale;

        $category = Category::where('slug', $slug)
            ->withCount([
                'lessons' => fn($q) => $q->where('is_public', true),
                'playlists',
            ])
            ->firstOrFail();

        // Paginated lessons for this category
        $lessons = $category->lessons()
            ->where('is_public', true)
            ->with(['playlist', 'tags'])
            ->latest()
            ->paginate(9)
            ->withQueryString();

        // Playlists for this category
        $playlists = $category->playlists()
            ->withCount(['lessons' => fn($q) => $q->where('is_public', true)])
            ->get();

        $seoTitle = $category->name . ' - ' . __('Category') . ' | LearnEnglish Audio';
        $seoDesc = Str::limit(strip_tags($category->description), 160) ?: __('Browse lessons and playlists in the :name category.', ['name' => $category->name]);

        $seoData = Seo::metaTags(
            title: $seoTitle,
            description: $seoDesc,
            type: 'category',
            extra: [
                'breadcrumbs' => [
                    ['name' => __('Home'), 'url' => route('home')],
                    ['name' => __('Categories'), 'url' => route('categories.index')],
                    ['name' => $category->name, 'url' => route('categories.show', $category->slug)],
                ],
            ]
        );

        return view('categories.show', compact('category', 'lessons', 'playlists', 'seoData'));
    }
}
