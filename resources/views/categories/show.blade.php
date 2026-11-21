@extends('layout.app')

@section('content')
<div class="py-8 sm:py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="mb-6 flex items-center gap-2 text-xs font-semibold text-base-content/60 overflow-x-auto no-scrollbar py-1" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#0066E6] transition-colors shrink-0">{{ __('Home') }}</a>
            <span class="text-base-content/30 shrink-0">/</span>
            <a href="{{ route('categories.index') }}" class="hover:text-[#0066E6] transition-colors shrink-0">{{ __('Categories') }}</a>
            <span class="text-base-content/30 shrink-0">/</span>
            <span class="text-base-content font-bold truncate max-w-xs">{{ $category->name }}</span>
        </nav>

        <!-- Category Header Banner -->
        <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900 p-8 sm:p-12 text-white shadow-xl mb-12 border border-slate-800">
            <span class="pointer-events-none absolute -right-16 -top-16 h-64 w-64 rounded-full border-[32px] border-white/5"></span>
            <span class="pointer-events-none absolute -bottom-28 -left-12 h-64 w-64 rounded-full bg-[#0066E6]/20 blur-3xl"></span>

            <div class="relative z-10 max-w-3xl space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="rounded-full bg-[#0066E6] px-3.5 py-1 text-xs font-bold uppercase tracking-wider">
                        {{ $category->lessons_count }} {{ trans_choice('Lesson|Lessons', $category->lessons_count) }}
                    </span>
                    <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold backdrop-blur">
                        {{ $category->playlists_count }} {{ trans_choice('Playlist|Playlists', $category->playlists_count) }}
                    </span>
                </div>

                <h1 class="text-3xl font-extrabold tracking-tight sm:text-5xl leading-tight">
                    {{ $category->name }}
                </h1>

                @if($category->description)
                    <p class="text-base leading-relaxed text-white/80 sm:text-lg">
                        {{ $category->description }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Playlists in this category (if any) -->
        @if(!empty($playlists) && $playlists->isNotEmpty())
            <div class="mb-14 space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-extrabold text-base-content sm:text-2xl">
                        {{ __('Curated Playlists in') }} {{ $category->name }}
                    </h2>
                </div>
                <div class="grid gap-6 md:grid-cols-3">
                    @foreach($playlists as $playlist)
                        <x-playlist-card :playlist="$playlist" />
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Lessons in this category -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-extrabold text-base-content sm:text-2xl">
                    {{ __('Category Lessons') }}
                </h2>
                <span class="text-xs text-base-content/60 font-semibold">
                    {{ __('Showing') }} {{ $lessons->total() }} {{ trans_choice('Lesson|Lessons', $lessons->total()) }}
                </span>
            </div>

            @if($lessons->isNotEmpty())
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($lessons as $lesson)
                        <x-video-card :video="$lesson" />
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $lessons->links() }}
                </div>
            @else
                <div class="rounded-3xl border border-dashed border-base-300 p-12 text-center dark:border-base-content/20">
                    <p class="text-sm text-base-content/60">
                        {{ __('No lessons published in this category yet.') }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
