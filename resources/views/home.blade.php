@extends('layout.app')

@section('content')
@php
    $videosList = (!empty($lessons) && $lessons->isNotEmpty()) ? $lessons : collect(config('landing.videos'));
    $playlistsList = (!empty($playlists) && $playlists->isNotEmpty()) ? $playlists : collect(config('landing.playlists'));
    $channelUrl = $channelUrl ?? config('services.youtube.channel_url', 'https://www.youtube.com/');
    $activeCategory = $selectedCategory ?? null;
    $activeType = $filterType ?? null;
@endphp

<div class="min-h-screen pb-16">
    <!-- Top Sticky YouTube-Style Topic Chips Bar -->
    <div class="sticky top-[4.5rem] z-40 border-b border-base-200/80 bg-base-100/95 backdrop-blur-xl transition-colors duration-300 dark:border-base-content/10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 overflow-x-auto py-3 no-scrollbar">
                <!-- All chip -->
                <a
                    href="{{ route('home') }}"
                    class="shrink-0 rounded-xl px-4 py-2 text-xs font-bold transition-all {{ empty($activeCategory) && empty($activeType) ? 'bg-base-content text-base-100 shadow-sm' : 'bg-base-200 text-base-content/75 hover:bg-base-300' }}"
                >
                    {{ __('All') }}
                </a>

                <!-- Category chips -->
                @foreach($categories as $cat)
                    <a
                        href="{{ route('home', ['category' => $cat->slug]) }}"
                        class="shrink-0 rounded-xl px-4 py-2 text-xs font-bold transition-all {{ $activeCategory === $cat->slug ? 'bg-base-content text-base-100 shadow-sm' : 'bg-base-200 text-base-content/75 hover:bg-base-300' }}"
                    >
                        {{ $cat->name }}
                        @if($cat->lessons_count > 0)
                            <span class="ml-1 opacity-60">({{ $cat->lessons_count }})</span>
                        @endif
                    </a>
                @endforeach

                <span class="h-5 w-px bg-base-300 dark:bg-base-content/20 shrink-0 mx-1"></span>

                <!-- Audio filter chip -->
                <a
                    href="{{ route('home', ['type' => 'audio']) }}"
                    class="shrink-0 rounded-xl px-3.5 py-2 text-xs font-bold transition-all flex items-center gap-1.5 {{ $activeType === 'audio' ? 'bg-[#0066E6] text-white shadow-sm' : 'bg-base-200 text-base-content/75 hover:bg-base-300' }}"
                >
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>
                    </svg>
                    <span>{{ __('Audio Track') }}</span>
                </a>

                <!-- Transcript filter chip -->
                <a
                    href="{{ route('home', ['type' => 'transcript']) }}"
                    class="shrink-0 rounded-xl px-3.5 py-2 text-xs font-bold transition-all flex items-center gap-1.5 {{ $activeType === 'transcript' ? 'bg-[#0066E6] text-white shadow-sm' : 'bg-base-200 text-base-content/75 hover:bg-base-300' }}"
                >
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                    <span>{{ __('With Transcripts') }}</span>
                </a>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-6 space-y-10">

        <!-- Quick Search Bar (YouTube Style) -->
        <div class="flex items-center justify-center">
            <form action="{{ route('lessons.index') }}" method="GET" class="w-full max-w-2xl">
                <div class="relative flex items-center">
                    <input
                        type="text"
                        name="q"
                        placeholder="{{ __('Search videos, conversations, pronunciation, listening...') }}"
                        class="w-full rounded-full border border-base-300 bg-base-100 py-3 pl-12 pr-28 text-sm font-medium text-base-content shadow-sm transition-all focus:border-[#0066E6] focus:outline-none focus:ring-2 focus:ring-[#0066E6]/20 dark:border-base-content/20"
                    />
                    <svg class="pointer-events-none absolute left-4 h-5 w-5 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <button
                        type="submit"
                        class="absolute right-1.5 rounded-full bg-[#0066E6] px-5 py-2 text-xs font-bold text-white shadow-sm hover:bg-[#0052b8] transition-colors"
                    >
                        {{ __('Search') }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Featured Video Spotlight (Clean YouTube Spotlight Banner) -->
        @if(empty($activeCategory) && empty($activeType) && $featured)
            @php
                $isFeaturedModel = $featured instanceof \App\Models\Lesson;
                $featTitle = $isFeaturedModel ? $featured->title : ($featured['title'] ?? '');
                $featDesc = $isFeaturedModel ? $featured->description : ($featured['description'] ?? '');
                $featSlug = $isFeaturedModel ? $featured->slug : null;
                $featImg = $isFeaturedModel ? $featured->image_url : null;
                $featUrl = $featSlug ? route('lessons.show', $featSlug) : '#';
                $featCategory = $isFeaturedModel ? ($featured->category?->name ?? __('English Lesson')) : ($featured['topic'] ?? __('English'));
                $featAudio = $isFeaturedModel ? !empty($featured->audio_url) : false;
                $featBody = $isFeaturedModel ? !empty($featured->body) : false;
            @endphp
            <div class="relative overflow-hidden rounded-3xl border border-base-200 bg-base-100 shadow-md transition-all duration-300 hover:shadow-xl dark:border-base-content/10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">
                    <!-- Left: Big 16:9 Thumbnail -->
                    <a href="{{ $featUrl }}" class="group relative aspect-video lg:col-span-7 overflow-hidden bg-slate-900 block">
                        @if($featImg)
                            <img src="{{ $featImg }}" alt="{{ $featTitle }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @else
                            <div class="h-full w-full bg-gradient-to-br from-[#0066E6] via-[#0052b8] to-[#003e8c] flex items-center justify-center text-white">
                                <span class="text-6xl">▶</span>
                            </div>
                        @endif
                        <span class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></span>
                        
                        <!-- Floating Duration/Spotlight pill -->
                        <span class="absolute top-4 left-4 rounded-full bg-[#0066E6] px-3 py-1 text-xs font-bold uppercase tracking-wider text-white shadow-md">
                            ★ {{ __('Featured Lesson') }}
                        </span>

                        <!-- Big Center Play Button on hover -->
                        <span class="absolute inset-0 flex items-center justify-center">
                            <span class="flex h-16 w-16 items-center justify-center rounded-full bg-white text-[#0066E6] shadow-2xl transition-all duration-300 group-hover:scale-110 group-hover:bg-[#0066E6] group-hover:text-white">
                                <svg class="ml-1 h-7 w-7 fill-current" viewBox="0 0 24 24">
                                    <polygon points="6 4 20 12 6 20 6 4"></polygon>
                                </svg>
                            </span>
                        </span>
                    </a>

                    <!-- Right: Info & Actions -->
                    <div class="p-6 sm:p-8 lg:col-span-5 flex flex-col justify-between">
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-[#0066E6]/10 text-xs font-black text-[#0066E6]">
                                    LE
                                </span>
                                <div>
                                    <p class="text-xs font-bold text-base-content/80 flex items-center gap-1">
                                        {{ __('LearnEnglish Channel') }}
                                        <svg class="h-3.5 w-3.5 text-[#0066E6] fill-current" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                    </p>
                                    <p class="text-[11px] font-semibold text-[#0066E6]">{{ $featCategory }}</p>
                                </div>
                            </div>

                            <a href="{{ $featUrl }}" class="block group">
                                <h2 class="text-xl sm:text-2xl font-black text-base-content group-hover:text-[#0066E6] transition-colors leading-snug line-clamp-2">
                                    {{ $featTitle }}
                                </h2>
                            </a>

                            <p class="text-sm leading-relaxed text-base-content/65 line-clamp-3">
                                {{ $featDesc }}
                            </p>

                            <!-- Feature Badges -->
                            <div class="flex flex-wrap items-center gap-2 pt-1">
                                @if($featAudio)
                                    <span class="inline-flex items-center gap-1 rounded-lg bg-emerald-500/10 px-2.5 py-1 text-xs font-bold text-emerald-600 dark:text-emerald-400">
                                        🎧 {{ __('Audio Track') }}
                                    </span>
                                @endif
                                @if($featBody)
                                    <span class="inline-flex items-center gap-1 rounded-lg bg-indigo-500/10 px-2.5 py-1 text-xs font-bold text-indigo-600 dark:text-indigo-400">
                                        📝 {{ __('Synchronized Text') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-6 flex flex-wrap items-center gap-3 pt-4 border-t border-base-200 dark:border-base-content/10">
                            <a href="{{ $featUrl }}" class="btn btn-primary rounded-xl px-6 font-bold shadow-md shadow-[#0066E6]/20">
                                <svg class="h-4 w-4 fill-current mr-1" viewBox="0 0 24 24">
                                    <polygon points="6 4 20 12 6 20 6 4"></polygon>
                                </svg>
                                {{ __('Play Now') }}
                            </a>
                            <a href="{{ route('lessons.index') }}" class="btn btn-ghost rounded-xl text-xs font-bold text-base-content/75 hover:bg-base-200">
                                {{ __('Browse All') }} &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Video Grid Shelf (The YouTube Feed) -->
        <section class="space-y-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-red-600 text-white shadow-sm">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                            <polygon points="6 4 20 12 6 20 6 4"></polygon>
                        </svg>
                    </span>
                    <div>
                        <h2 class="text-xl sm:text-2xl font-black text-base-content">
                            @if($activeCategory)
                                {{ $categories->firstWhere('slug', $activeCategory)?->name ?? __('Lessons') }}
                            @elseif($activeType === 'audio')
                                {{ __('Lessons with Audio Tracks') }}
                            @elseif($activeType === 'transcript')
                                {{ __('Lessons with Sentence Transcripts') }}
                            @else
                                {{ __('Latest Uploads & Lessons') }}
                            @endif
                        </h2>
                    </div>
                </div>

                <a href="{{ route('lessons.index', array_filter(['category' => $activeCategory])) }}" class="text-xs font-bold text-[#0066E6] hover:underline flex items-center gap-1">
                    {{ __('View all') }}
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>

            <!-- YouTube Video Cards Grid (4 columns on wide screens, 3 on laptop, 2 on tablet, 1 on mobile) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-5 gap-y-8">
                @foreach($videosList as $video)
                    @php
                        $isModel = $video instanceof \App\Models\Lesson;
                        $title = $isModel ? $video->title : ($video['title'] ?? '');
                        $description = $isModel ? $video->description : ($video['description'] ?? '');
                        $slug = $isModel ? $video->slug : ($video['slug'] ?? null);
                        $categoryName = $isModel ? ($video->category?->name ?? __('English')) : ($video['topic'] ?? __('English'));
                        $level = $isModel ? ($video->tags->first()?->name ?? null) : ($video['level'] ?? null);
                        $imageUrl = $isModel ? $video->image_url : null;
                        $hasAudio = $isModel ? !empty($video->audio_url) : false;
                        $hasBody = $isModel ? !empty($video->body) : false;
                        $lessonUrl = $slug ? route('lessons.show', $slug) : '#';

                        // YouTube ID
                        $ytId = null;
                        if ($isModel && !empty($video->youtube_url)) {
                            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $video->youtube_url, $m)) {
                                $ytId = $m[1];
                            }
                        }
                    @endphp

                    <!-- YouTube Video Card Item -->
                    <div class="group flex flex-col space-y-3">
                        <!-- Thumbnail (16:9 Aspect Ratio) -->
                        <a href="{{ $lessonUrl }}" class="relative aspect-video w-full overflow-hidden rounded-2xl bg-slate-900 shadow-sm transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-xl">
                            @if($imageUrl)
                                <img src="{{ $imageUrl }}" alt="{{ $title }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @elseif($ytId)
                                <img src="https://i.ytimg.com/vi/{{ $ytId }}/hqdefault.jpg" alt="{{ $title }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="h-full w-full bg-gradient-to-br from-[#0066E6] via-[#0052b8] to-[#003e8c] flex items-center justify-center text-white font-black text-xl">
                                    EN
                                </div>
                            @endif

                            <!-- Bottom-right YouTube Duration / Feature Pill -->
                            <div class="absolute bottom-2.5 right-2.5 flex items-center gap-1.5">
                                @if($hasAudio)
                                    <span class="rounded-md bg-emerald-600/90 px-1.5 py-0.5 font-mono text-[10px] font-bold text-white shadow-sm backdrop-blur">
                                        🎧 MP3
                                    </span>
                                @endif
                                @if($hasBody)
                                    <span class="rounded-md bg-indigo-600/90 px-1.5 py-0.5 font-mono text-[10px] font-bold text-white shadow-sm backdrop-blur">
                                        📝 SUB
                                    </span>
                                @endif
                                <span class="rounded-md bg-slate-950/80 px-2 py-0.5 font-mono text-[11px] font-semibold text-white backdrop-blur">
                                    15:00
                                </span>
                            </div>

                            <!-- Hover Overlay with Play Button -->
                            <span class="absolute inset-0 bg-slate-950/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <span class="flex h-12 w-12 items-center justify-center rounded-full bg-white text-[#0066E6] shadow-xl transition-transform duration-300 group-hover:scale-110">
                                    <svg class="ml-0.5 h-5 w-5 fill-current" viewBox="0 0 24 24">
                                        <polygon points="6 4 20 12 6 20 6 4"></polygon>
                                    </svg>
                                </span>
                            </span>
                        </a>

                        <!-- Video Metadata (YouTube style avatar + title + channel) -->
                        <div class="flex items-start gap-3">
                            <!-- Channel Avatar -->
                            <a href="{{ $lessonUrl }}" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-linear-to-br from-[#0066E6] to-[#3385ff] text-xs font-black text-white shadow-sm mt-0.5">
                                LE
                            </a>

                            <!-- Title & Subtitle -->
                            <div class="flex-1 min-w-0">
                                <a href="{{ $lessonUrl }}" class="block">
                                    <h3 class="text-sm font-bold text-base-content leading-snug group-hover:text-[#0066E6] transition-colors line-clamp-2">
                                        {{ $title }}
                                    </h3>
                                </a>

                                <div class="mt-1 flex flex-col text-xs text-base-content/60">
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-semibold text-base-content/80 hover:text-[#0066E6]">{{ $categoryName }}</span>
                                        <span>•</span>
                                        @if($level)
                                            <span class="text-[11px] font-medium">{{ $level }}</span>
                                        @else
                                            <span class="text-[11px] font-medium">{{ __('Lesson') }}</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-1.5 text-[11px] text-base-content/50 mt-0.5">
                                        @if($isModel && $video->playlist)
                                            <span class="truncate max-w-[150px]">{{ $video->playlist->name }}</span>
                                            <span>•</span>
                                        @endif
                                        <span>{{ $isModel ? $video->created_at->diffForHumans() : __('Uploaded recently') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Playlists Shelf (YouTube Learning Paths / Playlists Section) -->
        @if($playlistsList->isNotEmpty())
            <section class="space-y-6 pt-6 border-t border-base-200 dark:border-base-content/10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-[#0066E6] text-white shadow-sm">
                            <svg class="h-4 w-4 fill-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                            </svg>
                        </span>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-black text-base-content">
                                {{ __('Curated Playlists & Courses') }}
                            </h2>
                        </div>
                    </div>

                    <a href="{{ route('playlists.index') }}" class="text-xs font-bold text-[#0066E6] hover:underline flex items-center gap-1">
                        {{ __('View all playlists') }}
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>

                <!-- Playlist cards grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach($playlistsList as $pl)
                        @php
                            $isPlModel = $pl instanceof \App\Models\Playlist;
                            $plTitle = $isPlModel ? $pl->name : ($pl['title'] ?? '');
                            $plDesc = $isPlModel ? $pl->description : ($pl['description'] ?? '');
                            $plSlug = $isPlModel ? $pl->slug : null;
                            $plCount = $isPlModel ? $pl->lessons_count : 4;
                            $plCat = $isPlModel ? $pl->category?->name : null;
                            $plUrl = $plSlug ? route('playlists.show', $plSlug) : '#';
                        @endphp

                        <!-- YouTube-style Playlist Card -->
                        <a href="{{ $plUrl }}" class="group flex flex-col space-y-3">
                            <!-- Stacked Thumbnail Visual -->
                            <div class="relative aspect-video w-full overflow-hidden rounded-2xl bg-gradient-to-br from-[#0066E6] via-[#0052b8] to-[#003e8c] p-5 text-white shadow-sm transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-xl flex flex-col justify-between">
                                <span class="pointer-events-none absolute -right-8 -top-8 h-32 w-32 rounded-full border-8 border-white/10"></span>
                                
                                <div class="flex items-center justify-between z-10">
                                    <span class="rounded-full bg-white/20 px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider backdrop-blur">
                                        {{ $plCat ?? __('Course') }}
                                    </span>
                                    <span class="rounded-full bg-black/30 px-2.5 py-0.5 text-[10px] font-bold backdrop-blur flex items-center gap-1">
                                        <svg class="h-3 w-3 fill-current" viewBox="0 0 24 24">
                                            <path d="M4 6h16M4 10h16M4 14h10M4 18h10"></path>
                                        </svg>
                                        {{ $plCount }}
                                    </span>
                                </div>

                                <div class="z-10">
                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-white/90 group-hover:text-white">
                                        <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                                            <polygon points="6 4 20 12 6 20 6 4"></polygon>
                                        </svg>
                                        {{ __('Play all') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Playlist Info -->
                            <div>
                                <h3 class="text-sm font-bold text-base-content group-hover:text-[#0066E6] transition-colors leading-snug line-clamp-2">
                                    {{ $plTitle }}
                                </h3>
                                <p class="text-xs text-base-content/60 line-clamp-1 mt-1">
                                    {{ $plDesc }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- YouTube Channel Banner Strip (Footer Callout) -->
        <div class="rounded-3xl bg-linear-to-r from-red-600 via-red-500 to-rose-600 p-6 sm:p-8 text-white shadow-xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">
            <div class="flex items-center gap-4">
                <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white text-red-600 shadow-md">
                    <svg class="h-8 w-8 fill-current" viewBox="0 0 24 24">
                        <path d="M23.5 6.2a3 3 0 0 0-2.1-2.2C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.2c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.2A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8ZM9.5 15.6V8.4L15.8 12l-6.3 3.6Z"/>
                    </svg>
                </span>
                <div>
                    <h3 class="text-lg sm:text-xl font-black">{{ __('Watch directly on our YouTube channel') }}</h3>
                    <p class="text-xs sm:text-sm text-white/80 mt-0.5">{{ __('Subscribe for weekly videos, podcasts, and spoken English tutorials.') }}</p>
                </div>
            </div>

            <a
                href="{{ $channelUrl }}"
                target="_blank"
                rel="noopener noreferrer"
                class="btn rounded-2xl border-none bg-white font-extrabold text-red-600 hover:bg-slate-100 shadow-lg shrink-0 px-6"
            >
                {{ __('Open Channel') }}
                <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </a>
        </div>

    </div>
</div>
@endsection
