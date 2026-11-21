@extends('layout.app')

@section('content')
<div class="py-8 sm:py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="mb-6 flex items-center gap-2 text-xs font-semibold text-base-content/60 overflow-x-auto no-scrollbar py-1" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#0066E6] transition-colors shrink-0">{{ __('Home') }}</a>
            <span class="text-base-content/30 shrink-0">/</span>
            <a href="{{ route('lessons.index') }}" class="hover:text-[#0066E6] transition-colors shrink-0">{{ __('Lessons') }}</a>
            @if($lesson->category)
                <span class="text-base-content/30 shrink-0">/</span>
                <a href="{{ route('categories.show', $lesson->category->slug) }}" class="hover:text-[#0066E6] transition-colors shrink-0">
                    {{ $lesson->category->name }}
                </a>
            @endif
            <span class="text-base-content/30 shrink-0">/</span>
            <span class="text-base-content font-bold truncate max-w-xs">{{ $lesson->title }}</span>
        </nav>

        <div class="grid grid-cols-1 gap-10 lg:grid-cols-12">
            <!-- Main Content (8 cols on large screens) -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Video Player Container -->
                <div class="overflow-hidden rounded-3xl border border-base-200 bg-slate-950 shadow-2xl shadow-slate-950/20 dark:border-base-content/10">
                    @if($youtubeId)
                        <div class="relative aspect-video w-full">
                            <iframe
                                id="youtube-player"
                                src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}?rel=0&enablejsapi=1"
                                title="{{ $lesson->title }}"
                                class="absolute inset-0 h-full w-full border-0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                            ></iframe>
                        </div>
                    @elseif($lesson->image_url)
                        <div class="relative aspect-video w-full">
                            <img src="{{ $lesson->image_url }}" alt="{{ $lesson->title }}" class="h-full w-full object-cover">
                            <div class="absolute inset-0 bg-slate-950/50 flex items-center justify-center">
                                @if($lesson->youtube_url)
                                    <a href="{{ $lesson->youtube_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary rounded-full px-6 font-bold shadow-xl">
                                        <svg class="h-5 w-5 mr-1 fill-current" viewBox="0 0 24 24">
                                            <path d="M23.5 6.2a3 3 0 0 0-2.1-2.2C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.2c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.2A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8ZM9.5 15.6V8.4L15.8 12l-6.3 3.6Z"/>
                                        </svg>
                                        {{ __('Watch on YouTube') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="aspect-video w-full bg-gradient-to-br from-[#0066E6] to-[#003e8c] flex items-center justify-center p-6 text-white text-center">
                            <div class="max-w-md space-y-3">
                                <span class="text-4xl">🎧</span>
                                <h2 class="text-2xl font-bold">{{ $lesson->title }}</h2>
                                <p class="text-sm text-white/80">{{ __('Audio & Practice Lesson') }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Dedicated Audio Player (if audio file uploaded) -->
                @if($lesson->audio_url)
                    <div class="rounded-3xl border border-base-200 bg-base-100 p-5 sm:p-6 shadow-sm dark:border-base-content/10">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>
                                </svg>
                            </span>
                            <div>
                                <h3 class="text-sm font-bold text-base-content">{{ __('Lesson Audio Track') }}</h3>
                                <p class="text-xs text-base-content/60">{{ __('Clean audio for listening and shadowing practice') }}</p>
                            </div>
                            <a
                                href="{{ asset('storage/' . $lesson->audio_url) }}"
                                download
                                class="ml-auto btn btn-ghost btn-sm rounded-xl text-xs font-bold text-[#0066E6] hover:bg-[#0066E6]/10"
                                title="{{ __('Download audio') }}"
                            >
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                {{ __('Download MP3') }}
                            </a>
                        </div>

                        <audio id="lesson-audio" controls class="w-full h-11 rounded-xl">
                            <source src="{{ asset('storage/' . $lesson->audio_url) }}" type="audio/mpeg">
                            {{ __('Your browser does not support the audio element.') }}
                        </audio>
                    </div>
                @endif

                <!-- Lesson Header Info -->
                <div class="rounded-3xl border border-base-200 bg-base-100 p-6 sm:p-8 shadow-sm dark:border-base-content/10 space-y-5">
                    <!-- Badges -->
                    <div class="flex flex-wrap items-center gap-2">
                        @if($lesson->category)
                            <a href="{{ route('categories.show', $lesson->category->slug) }}" class="rounded-full bg-[#0066E6]/10 px-3.5 py-1 text-xs font-bold text-[#0066E6] hover:bg-[#0066E6]/20 transition-colors">
                                {{ $lesson->category->name }}
                            </a>
                        @endif

                        @if($lesson->playlist)
                            <a href="{{ route('playlists.show', $lesson->playlist->slug) }}" class="rounded-full bg-indigo-500/10 px-3.5 py-1 text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:bg-indigo-500/20 transition-colors">
                                📚 {{ $lesson->playlist->name }}
                            </a>
                        @endif

                        <span class="text-xs text-base-content/50 ml-auto flex items-center gap-1.5">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            {{ $lesson->created_at->format('M d, Y') }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-2xl font-extrabold tracking-tight text-base-content sm:text-3xl leading-snug">
                        {{ $lesson->title }}
                    </h1>

                    <!-- Description -->
                    @if($lesson->description)
                        <div class="prose max-w-none text-sm sm:text-base leading-relaxed text-base-content/75 border-t border-base-200 pt-4 dark:border-base-content/10">
                            {!! nl2br(e($lesson->description)) !!}
                        </div>
                    @endif

                    <!-- Tags -->
                    @if($lesson->tags->isNotEmpty())
                        <div class="flex flex-wrap items-center gap-2 pt-2">
                            @foreach($lesson->tags as $tag)
                                <a href="{{ route('lessons.index', ['tag' => $tag->slug]) }}" class="rounded-lg bg-base-200 px-2.5 py-1 text-xs font-medium text-base-content/70 hover:bg-[#0066E6]/10 hover:text-[#0066E6] transition-colors">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Interactive Transcript Section -->
                <div class="rounded-3xl border border-base-200 bg-base-100 p-6 sm:p-8 shadow-sm dark:border-base-content/10 space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-base-200 pb-5 dark:border-base-content/10">
                        <div>
                            <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#0066E6]">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                </svg>
                                {{ __('Interactive Transcript') }}
                            </div>
                            <h2 class="text-xl font-extrabold text-base-content mt-1">
                                {{ __('Sentence-by-Sentence Study') }}
                            </h2>
                            <p class="text-xs text-base-content/60 mt-0.5">
                                {{ __('Click any sentence to practice shadowing, copy the phrase, or study its pronunciation.') }}
                            </p>
                        </div>

                        <!-- Transcript search -->
                        <div class="relative w-full sm:w-64">
                            <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            <input
                                type="text"
                                id="transcript-filter"
                                placeholder="{{ __('Search phrases...') }}"
                                class="w-full rounded-xl border border-base-300 bg-base-200/50 py-2 pl-9 pr-3 text-xs font-medium text-base-content placeholder:text-base-content/40 focus:border-[#0066E6] focus:bg-base-100 focus:outline-none"
                                onkeyup="filterTranscript()"
                            />
                        </div>
                    </div>

                    @if(!empty($transcriptLines))
                        <div id="transcript-container" class="space-y-3 max-h-[600px] overflow-y-auto pr-1">
                            @foreach($transcriptLines as $index => $item)
                                @php
                                    $lineIndex = $item['index'] ?? ($index + 1);
                                    $start = $item['start'] ?? '';
                                    $end = $item['end'] ?? '';
                                    $text = $item['text'] ?? '';
                                @endphp
                                <div
                                    class="transcript-row group relative flex items-start gap-4 rounded-2xl border border-base-200 bg-base-200/30 p-4 transition-all duration-200 hover:border-[#0066E6]/40 hover:bg-base-100 hover:shadow-md dark:border-base-content/10 dark:bg-base-300/10 dark:hover:bg-base-100"
                                    data-start="{{ $start }}"
                                    data-text="{{ strtolower($text) }}"
                                >
                                    <!-- Index Badge -->
                                    <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-xl bg-base-300 text-xs font-bold text-base-content/70 group-hover:bg-[#0066E6] group-hover:text-white transition-colors">
                                        {{ $lineIndex }}
                                    </span>

                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-1">
                                            @if($start)
                                                <button
                                                    type="button"
                                                    onclick="seekAudio('{{ $start }}')"
                                                    class="inline-flex items-center gap-1 rounded-md bg-[#0066E6]/10 px-2 py-0.5 font-mono text-[11px] font-bold text-[#0066E6] hover:bg-[#0066E6] hover:text-white transition-colors"
                                                    title="{{ __('Jump to this timestamp') }}"
                                                >
                                                    <svg class="h-3 w-3 fill-current" viewBox="0 0 24 24">
                                                        <polygon points="6 4 20 12 6 20 6 4"></polygon>
                                                    </svg>
                                                    <span>{{ $start }}</span>
                                                    @if($end)
                                                        <span class="text-base-content/40">&rarr; {{ $end }}</span>
                                                    @endif
                                                </button>
                                            @endif
                                        </div>

                                        <p class="transcript-text text-base sm:text-lg font-medium leading-relaxed text-base-content">
                                            {{ $text }}
                                        </p>
                                    </div>

                                    <!-- Quick Actions (Copy, Shadow) -->
                                    <div class="flex items-center gap-1 shrink-0 opacity-80 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity">
                                        <button
                                            type="button"
                                            onclick="speakText('{{ addslashes($text) }}')"
                                            class="btn btn-ghost btn-circle btn-sm hover:bg-[#0066E6]/10 hover:text-[#0066E6]"
                                            title="{{ __('Listen with speech synthesis') }}"
                                            aria-label="{{ __('Listen to text') }}"
                                        >
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>
                                            </svg>
                                        </button>
                                        <button
                                            type="button"
                                            onclick="copyPhrase(this, '{{ addslashes($text) }}')"
                                            class="btn btn-ghost btn-circle btn-sm hover:bg-[#0066E6]/10 hover:text-[#0066E6]"
                                            title="{{ __('Copy phrase') }}"
                                            aria-label="{{ __('Copy phrase') }}"
                                        >
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9m0 0H7.875a1.125 1.125 0 00-1.125 1.125v3.375m0 0h9a2.25 2.25 0 012.25 2.25v9a2.25 2.25 0 01-2.25 2.25z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- No transcript available -->
                        <div class="rounded-2xl border border-dashed border-base-300 p-8 text-center dark:border-base-content/20">
                            <p class="text-sm text-base-content/60">
                                {{ __('No line-by-line transcript is currently attached to this lesson. You can still watch the video and practice with the channel content.') }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar (4 cols on large screens) -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Playlist Module (if lesson belongs to one) -->
                @if($lesson->playlist)
                    <div class="rounded-3xl border border-base-200 bg-base-100 p-6 shadow-sm dark:border-base-content/10">
                        <div class="flex items-center justify-between gap-2 mb-4">
                            <div class="space-y-1">
                                <span class="text-xs font-bold uppercase tracking-wider text-[#0066E6]">{{ __('Part of Playlist') }}</span>
                                <h3 class="font-extrabold text-base-content">{{ $lesson->playlist->name }}</h3>
                            </div>
                            <a href="{{ route('playlists.show', $lesson->playlist->slug) }}" class="text-xs font-bold text-[#0066E6] hover:underline shrink-0">
                                {{ __('View All') }} &rarr;
                            </a>
                        </div>

                        <!-- Playlist items preview -->
                        <div class="space-y-2 mt-4">
                            @foreach($lesson->playlist->lessons as $plLesson)
                                <a
                                    href="{{ route('lessons.show', $plLesson->slug) }}"
                                    class="flex items-center gap-3 rounded-2xl p-2.5 transition-all {{ $plLesson->id === $lesson->id ? 'bg-[#0066E6] text-white shadow-md shadow-[#0066E6]/25' : 'hover:bg-base-200 text-base-content/80' }}"
                                >
                                    <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-xl text-xs font-bold {{ $plLesson->id === $lesson->id ? 'bg-white/20 text-white' : 'bg-base-300 text-base-content/60' }}">
                                        {{ $loop->iteration }}
                                    </span>
                                    <span class="truncate text-xs font-semibold flex-1">
                                        {{ $plLesson->title }}
                                    </span>
                                    @if($plLesson->id === $lesson->id)
                                        <span class="text-[10px] uppercase font-black tracking-wider bg-white/25 px-2 py-0.5 rounded-full">
                                            {{ __('Now') }}
                                        </span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Share Box -->
                <div class="rounded-3xl border border-base-200 bg-base-100 p-6 shadow-sm dark:border-base-content/10">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-base-content/80 mb-3">{{ __('Share Lesson') }}</h3>
                    <div class="flex items-center gap-2">
                        <!-- WhatsApp -->
                        <a
                            href="https://api.whatsapp.com/send?text={{ urlencode($lesson->title . ' - ' . url()->current()) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-sm btn-circle btn-ghost text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-500/10"
                            title="Share on WhatsApp"
                            aria-label="Share on WhatsApp"
                        >
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                                <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 15 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67Z"/>
                            </svg>
                        </a>

                        <!-- X (Twitter) -->
                        <a
                            href="https://twitter.com/intent/tweet?text={{ urlencode($lesson->title) }}&url={{ urlencode(url()->current()) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-sm btn-circle btn-ghost text-base-content hover:bg-base-200"
                            title="Share on X"
                            aria-label="Share on X"
                        >
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>

                        <!-- Copy Link Button -->
                        <button
                            type="button"
                            onclick="copyCurrentUrl(this)"
                            class="btn btn-sm btn-outline rounded-xl text-xs font-semibold ml-auto"
                        >
                            <svg class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                            </svg>
                            <span>{{ __('Copy Link') }}</span>
                        </button>
                    </div>
                </div>

                <!-- Related Lessons -->
                @if($relatedLessons->isNotEmpty())
                    <div class="rounded-3xl border border-base-200 bg-base-100 p-6 shadow-sm dark:border-base-content/10">
                        <h3 class="text-base font-extrabold text-base-content mb-4">{{ __('Related Lessons') }}</h3>
                        <div class="space-y-4">
                            @foreach($relatedLessons as $rel)
                                <a href="{{ route('lessons.show', $rel->slug) }}" class="group flex items-start gap-3 rounded-2xl p-2 transition-colors hover:bg-base-200/60">
                                    <div class="relative h-16 w-24 shrink-0 overflow-hidden rounded-xl bg-slate-900">
                                        @if($rel->image_url)
                                            <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}" class="h-full w-full object-cover transition-transform group-hover:scale-105">
                                        @else
                                            <div class="h-full w-full bg-gradient-to-br from-[#0066E6] to-[#003e8c] flex items-center justify-center text-white text-xs font-bold">
                                                EN
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-[11px] font-bold uppercase tracking-wider text-[#0066E6]">
                                            {{ $rel->category?->name ?? __('English') }}
                                        </p>
                                        <h4 class="text-xs font-bold text-base-content leading-snug group-hover:text-[#0066E6] transition-colors line-clamp-2 mt-0.5">
                                            {{ $rel->title }}
                                        </h4>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Audio timestamp jump
    function seekAudio(timestamp) {
        const audio = document.getElementById('lesson-audio');
        if (!audio) return;

        // Convert 00:01:23.456 or 01:23.456 to seconds
        const parts = timestamp.split(':');
        let seconds = 0;
        if (parts.length === 3) {
            seconds = parseFloat(parts[0]) * 3600 + parseFloat(parts[1]) * 60 + parseFloat(parts[2]);
        } else if (parts.length === 2) {
            seconds = parseFloat(parts[0]) * 60 + parseFloat(parts[1]);
        } else {
            seconds = parseFloat(timestamp);
        }

        if (!isNaN(seconds)) {
            audio.currentTime = seconds;
            audio.play();
        }
    }

    // Text to Speech
    function speakText(text) {
        if ('speechSynthesis' in window) {
            window.speechSynthesis.cancel();
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'en-US';
            utterance.rate = 0.9;
            window.speechSynthesis.speak(utterance);
        } else {
            alert('Speech synthesis is not supported on this browser.');
        }
    }

    // Copy single phrase
    function copyPhrase(btn, text) {
        navigator.clipboard.writeText(text).then(() => {
            const originalHtml = btn.innerHTML;
            btn.innerHTML = '<span class="text-xs font-bold text-emerald-600">✓</span>';
            setTimeout(() => {
                btn.innerHTML = originalHtml;
            }, 1800);
        });
    }

    // Copy page URL
    function copyCurrentUrl(btn) {
        navigator.clipboard.writeText(window.location.href).then(() => {
            const span = btn.querySelector('span');
            if (span) {
                const originalText = span.textContent;
                span.textContent = '{{ __("Copied!") }}';
                setTimeout(() => span.textContent = originalText, 1800);
            }
        });
    }

    // Filter Transcript
    function filterTranscript() {
        const query = document.getElementById('transcript-filter').value.toLowerCase().trim();
        const rows = document.querySelectorAll('.transcript-row');

        rows.forEach(row => {
            const text = row.getAttribute('data-text') || '';
            if (text.includes(query)) {
                row.style.display = 'flex';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endpush
@endsection
