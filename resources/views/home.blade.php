@extends('layout.app')

@section('title', __('LearnEnglish Audio | Learn English with Real YouTube Videos'))

@section('content')
@php
    $videos = config('landing.videos');
    $playlists = config('landing.playlists');
    $channelUrl = config('services.youtube.channel_url');
    $featured = $videos[0];
@endphp

<!-- Latest videos -->
<section id="videos" class="py-5 sm:py-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-12 flex flex-col justify-between gap-5 md:flex-row md:items-end">
            <div class="max-w-2xl space-y-3">
                <span class="badge badge-outline border-[#0066E6]/30 text-[#0066E6]">{{ __('From the channel') }}</span>
                <h2 class="text-3xl font-extrabold tracking-tight text-base-content sm:text-4xl">
                    {{ __('The newest lessons, ready to play') }}
                </h2>
                <p class="text-sm leading-relaxed text-base-content/65 sm:text-base">
                    {{ __('We turn every new upload into a clean, focused lesson so you can spend less time searching and more time learning.') }}
                </p>
            </div>
            <a href="{{ $channelUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex shrink-0 items-center gap-2 text-sm font-bold text-[#0066E6] hover:underline">
                {{ __('See every video on YouTube') }}
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M7 17 17 7"></path>
                    <path d="M7 7h10v10"></path>
                </svg>
            </a>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($videos as $video)
                <x-video-card :video="$video" :channelUrl="$channelUrl" />
            @endforeach
        </div>
    </div>
</section>

<!-- Playlists -->
<section id="playlists" class="border-y border-base-200 bg-base-200/40 py-20 dark:border-base-content/10 dark:bg-base-300/20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-12 max-w-2xl space-y-3">
            <span class="badge badge-outline border-[#0066E6]/30 text-[#0066E6]">{{ __('Curated collections') }}</span>
            <h2 class="text-3xl font-extrabold tracking-tight text-base-content sm:text-4xl">
                {{ __('Follow a path, not just a video') }}
            </h2>
            <p class="text-sm leading-relaxed text-base-content/65 sm:text-base">
                {{ __('Our playlists group the channel into clear journeys, so you always know what to watch next.') }}
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            @foreach ($playlists as $playlist)
                <x-playlist-card :playlist="$playlist" :channelUrl="$channelUrl" />
            @endforeach
        </div>
    </div>
</section>

<!-- How it works -->
{{-- <section id="how-it-works" class="py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-12 text-center">
            <span class="badge badge-outline border-[#0066E6]/30 text-[#0066E6]">{{ __('Simple by design') }}</span>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">{{ __('Three steps to a better ear') }}</h2>
        </div>

        <div class="grid gap-8 md:grid-cols-3">
            <div class="relative rounded-3xl border border-base-200 bg-base-100 p-7 shadow-sm dark:border-base-content/10">
                <span class="text-5xl font-extrabold text-[#0066E6]/15">{{ __('01') }}</span>
                <div class="mt-3 flex h-11 w-11 items-center justify-center rounded-2xl bg-[#0066E6]/10 text-[#0066E6]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="2" y="4" width="20" height="16" rx="3"></rect>
                        <path d="m10 9 5 3-5 3V9Z"></path>
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-bold">{{ __('Watch the video') }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-base-content/65">{{ __('Start with the story and meaning. Every lesson comes from a real channel upload.') }}</p>
            </div>

            <div class="relative rounded-3xl border border-base-200 bg-base-100 p-7 shadow-sm dark:border-base-content/10">
                <span class="text-5xl font-extrabold text-[#0066E6]/15">{{ __('02') }}</span>
                <div class="mt-3 flex h-11 w-11 items-center justify-center rounded-2xl bg-[#0066E6]/10 text-[#0066E6]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M3 14v-3a9 9 0 0 1 18 0v3"></path>
                        <rect x="2" y="13" width="4" height="7" rx="2"></rect>
                        <rect x="18" y="13" width="4" height="7" rx="2"></rect>
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-bold">{{ __('Listen and shadow') }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-base-content/65">{{ __('Replay the hard parts and repeat out loud, copying the rhythm and intonation.') }}</p>
            </div>

            <div class="relative rounded-3xl border border-base-200 bg-base-100 p-7 shadow-sm dark:border-base-content/10">
                <span class="text-5xl font-extrabold text-[#0066E6]/15">{{ __('03') }}</span>
                <div class="mt-3 flex h-11 w-11 items-center justify-center rounded-2xl bg-[#0066E6]/10 text-[#0066E6]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 3a3 3 0 0 0-3 3v6a3 3 0 0 0 6 0V6a3 3 0 0 0-3-3Z"></path>
                        <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                        <path d="M12 19v3"></path>
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-bold">{{ __('Speak with confidence') }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-base-content/65">{{ __('Use the same phrases in your own conversations until they become second nature.') }}</p>
            </div>
        </div>
    </div>
</section> --}}

<!-- Why learners stay -->
{{-- <section class="border-t border-base-200 bg-base-200/40 py-20 dark:border-base-content/10 dark:bg-base-300/20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-12 text-center">
            <span class="badge badge-outline border-[#0066E6]/30 text-[#0066E6]">{{ __('Why LearnEnglish Audio') }}</span>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">{{ __('Your channel, more useful than ever') }}</h2>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-3xl border border-base-200 bg-base-100 p-6 transition-all hover:-translate-y-1 hover:border-[#0066E6]/40 hover:shadow-xl dark:border-base-content/10">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#0066E6]/10 text-xl text-[#0066E6]" aria-hidden="true">▶</span>
                <h3 class="mt-4 font-bold">{{ __('Real channel content') }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-base-content/65">{{ __('No scripted studio dialogues. Just the videos our channel actually publishes.') }}</p>
            </div>
            <div class="rounded-3xl border border-base-200 bg-base-100 p-6 transition-all hover:-translate-y-1 hover:border-[#0066E6]/40 hover:shadow-xl dark:border-base-content/10">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#0066E6]/10 text-xl text-[#0066E6]" aria-hidden="true">◉</span>
                <h3 class="mt-4 font-bold">{{ __('Audio-first practice') }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-base-content/65">{{ __('Train your ear with replay-friendly lessons built around listening and repetition.') }}</p>
            </div>
            <div class="rounded-3xl border border-base-200 bg-base-100 p-6 transition-all hover:-translate-y-1 hover:border-[#0066E6]/40 hover:shadow-xl dark:border-base-content/10">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#0066E6]/10 text-xl text-[#0066E6]" aria-hidden="true">◇</span>
                <h3 class="mt-4 font-bold">{{ __('Learn at your pace') }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-base-content/65">{{ __('Short lessons fit a coffee break, deep-dive playlists fit a whole afternoon.') }}</p>
            </div>
            <div class="rounded-3xl border border-base-200 bg-base-100 p-6 transition-all hover:-translate-y-1 hover:border-[#0066E6]/40 hover:shadow-xl dark:border-base-content/10">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#0066E6]/10 text-xl text-[#0066E6]" aria-hidden="true">✦</span>
                <h3 class="mt-4 font-bold">{{ __('Always something new') }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-base-content/65">{{ __('The moment a new video goes live on YouTube, it has a place here.') }}</p>
            </div>
        </div>
    </div>
</section> --}}

<!-- Channel CTA -->
<section id="channel" class="py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-[2rem] bg-linear-to-br from-[#0066E6] via-[#0052b8] to-[#003e8c] px-6 py-14 text-center text-white shadow-2xl brand-glow-lg sm:px-12 sm:py-16">
            <div class="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full bg-white/10 blur-2xl"></div>
            <div class="pointer-events-none absolute -bottom-28 -left-24 h-80 w-80 rounded-full bg-sky-300/15 blur-2xl"></div>

            <div class="relative mx-auto max-w-2xl space-y-6">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-xs font-bold uppercase tracking-wider backdrop-blur">
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M23.5 6.2a3 3 0 0 0-2.1-2.2C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.2c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.2A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8ZM9.5 15.6V8.4L15.8 12l-6.3 3.6Z"></path>
                    </svg>
                    {{ __('It all starts on YouTube') }}
                </span>

                <h2 class="text-3xl font-extrabold leading-tight tracking-tight sm:text-5xl">
                    {{ __('Never miss a new English lesson') }}
                </h2>
                <p class="text-base leading-relaxed text-white/80 sm:text-lg">
                    {{ __('Subscribe to the channel and every new upload will find its way here, ready to watch and practice.') }}
                </p>

                <a href="{{ $channelUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-md rounded-2xl border-none bg-white px-8 font-extrabold text-[#0066E6] shadow-xl transition-transform hover:scale-105 sm:btn-lg">
                    {{ __('Subscribe on YouTube') }}
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M7 17 17 7"></path>
                        <path d="M7 7h10v10"></path>
                    </svg>
                </a>

                <p class="flex flex-wrap justify-center gap-x-5 gap-y-2 text-xs text-white/75">
                    <span>✓ {{ __('New videos weekly') }}</span>
                    <span>✓ {{ __('Free to watch') }}</span>
                    <span>✓ {{ __('Learn anywhere') }}</span>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
