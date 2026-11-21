@extends('layout.app')

@section('content')
<div class="py-8 sm:py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="mb-6 flex items-center gap-2 text-xs font-semibold text-base-content/60 overflow-x-auto no-scrollbar py-1" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#0066E6] transition-colors shrink-0">{{ __('Home') }}</a>
            <span class="text-base-content/30 shrink-0">/</span>
            <a href="{{ route('playlists.index') }}" class="hover:text-[#0066E6] transition-colors shrink-0">{{ __('Playlists') }}</a>
            <span class="text-base-content/30 shrink-0">/</span>
            <span class="text-base-content font-bold truncate max-w-xs">{{ $playlist->name }}</span>
        </nav>

        <!-- Playlist Hero Banner -->
        <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-[#0066E6] via-[#0052b8] to-[#003e8c] p-8 sm:p-12 text-white shadow-xl brand-glow-lg mb-12">
            <span class="pointer-events-none absolute -right-16 -top-16 h-64 w-64 rounded-full border-[32px] border-white/10"></span>
            <span class="pointer-events-none absolute -bottom-28 -left-12 h-64 w-64 rounded-full bg-sky-300/15 blur-2xl"></span>

            <div class="relative z-10 max-w-3xl space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="rounded-full bg-white/20 px-3.5 py-1 text-xs font-bold uppercase tracking-wider backdrop-blur">
                        {{ $playlist->lessons_count }} {{ trans_choice('Lesson|Lessons', $playlist->lessons_count) }}
                    </span>
                    @if($playlist->category)
                        <a href="{{ route('categories.show', $playlist->category->slug) }}" class="rounded-full bg-black/25 px-3 py-1 text-xs font-semibold backdrop-blur hover:bg-black/35 transition-colors">
                            {{ $playlist->category->name }}
                        </a>
                    @endif
                </div>

                <h1 class="text-3xl font-extrabold tracking-tight sm:text-5xl leading-tight">
                    {{ $playlist->name }}
                </h1>

                @if($playlist->description)
                    <p class="text-base leading-relaxed text-white/85 sm:text-lg">
                        {{ $playlist->description }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Lessons Sequence -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-extrabold text-base-content sm:text-2xl">
                    {{ __('Playlist Lessons') }}
                </h2>
                <span class="text-xs text-base-content/60 font-semibold">
                    {{ __('Complete the lessons in order for optimal progression') }}
                </span>
            </div>

            @if($playlist->lessons->isNotEmpty())
                <div class="grid gap-4 sm:gap-5">
                    @foreach($playlist->lessons as $index => $lesson)
                        <a
                            href="{{ route('lessons.show', $lesson->slug) }}"
                            class="group relative flex flex-col sm:flex-row sm:items-center gap-5 rounded-3xl border border-base-200 bg-base-100 p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-[#0066E6]/40 hover:shadow-xl dark:border-base-content/10"
                        >
                            <!-- Sequence Number Badge -->
                            <div class="flex sm:flex-col items-center gap-2 sm:justify-center sm:w-12 shrink-0">
                                <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-base-200 font-mono text-sm font-black text-base-content/75 group-hover:bg-[#0066E6] group-hover:text-white transition-colors">
                                    {{ sprintf('%02d', $index + 1) }}
                                </span>
                            </div>

                            <!-- Thumbnail -->
                            <div class="relative aspect-video sm:w-56 shrink-0 overflow-hidden rounded-2xl bg-slate-900">
                                @if($lesson->image_url)
                                    <img src="{{ $lesson->image_url }}" alt="{{ $lesson->title }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="h-full w-full bg-gradient-to-br from-[#0066E6] to-[#003e8c] flex items-center justify-center text-white font-bold">
                                        EN
                                    </div>
                                @endif
                                <span class="absolute inset-0 bg-slate-950/20 group-hover:bg-slate-950/40 transition-colors"></span>
                                <span class="absolute inset-0 flex items-center justify-center">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-[#0066E6] shadow-lg transition-transform group-hover:scale-110 group-hover:bg-[#0066E6] group-hover:text-white">
                                        <svg class="ml-0.5 h-4 w-4 fill-current" viewBox="0 0 24 24">
                                            <polygon points="6 4 20 12 6 20 6 4"></polygon>
                                        </svg>
                                    </span>
                                </span>
                            </div>

                            <!-- Details -->
                            <div class="flex-1 min-w-0 space-y-1.5">
                                <div class="flex flex-wrap items-center gap-2">
                                    @if($lesson->tags->isNotEmpty())
                                        <span class="rounded-full bg-base-200 px-2.5 py-0.5 text-[11px] font-semibold text-base-content/70">
                                            {{ $lesson->tags->first()->name }}
                                        </span>
                                    @endif
                                    @if(!empty($lesson->audio_url))
                                        <span class="rounded-full bg-emerald-500/10 px-2 py-0.5 text-[10px] font-bold text-emerald-600 dark:text-emerald-400">
                                            🎧 {{ __('Audio Included') }}
                                        </span>
                                    @endif
                                    @if(!empty($lesson->body))
                                        <span class="rounded-full bg-indigo-500/10 px-2 py-0.5 text-[10px] font-bold text-indigo-600 dark:text-indigo-400">
                                            📝 {{ count($lesson->body) }} {{ __('Phrases') }}
                                        </span>
                                    @endif
                                </div>

                                <h3 class="text-base sm:text-lg font-bold text-base-content group-hover:text-[#0066E6] transition-colors leading-snug">
                                    {{ $lesson->title }}
                                </h3>

                                <p class="text-xs sm:text-sm text-base-content/65 line-clamp-2 leading-relaxed">
                                    {{ $lesson->description }}
                                </p>
                            </div>

                            <!-- Play Action Button -->
                            <div class="sm:px-3 shrink-0">
                                <span class="btn btn-sm btn-ghost group-hover:btn-primary rounded-xl font-bold transition-all">
                                    <span>{{ __('Start') }}</span>
                                    <svg class="h-4 w-4 ml-1 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="rounded-3xl border border-dashed border-base-300 p-12 text-center dark:border-base-content/20">
                    <p class="text-sm text-base-content/60">
                        {{ __('No lessons have been added to this playlist yet.') }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
