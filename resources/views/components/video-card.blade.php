@props([
    'video',
    'channelUrl' => null,
])

@php
    $youtubeId = $video['youtube_id'] ?? null;
    $watchUrl = $youtubeId
        ? 'https://www.youtube.com/watch?v='.$youtubeId
        : ($channelUrl ?? config('services.youtube.channel_url'));
@endphp

<a
    href="{{ $watchUrl }}"
    target="_blank"
    rel="noopener noreferrer"
    class="group flex h-full flex-col overflow-hidden rounded-3xl border border-base-200 bg-base-100 shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:border-[#0066E6]/40 hover:shadow-2xl hover:shadow-[#0066E6]/10 dark:border-base-content/10"
    aria-label="{{ __('Watch video') }}: {{ __($video['title']) }}"
>
    <div class="relative aspect-video overflow-hidden {{ $video['poster'] }}">
        @if ($youtubeId)
            <img
                src="https://i.ytimg.com/vi/{{ $youtubeId }}/hqdefault.jpg"
                alt="{{ __($video['title']) }}"
                loading="lazy"
                class="absolute inset-0 h-full w-full object-cover opacity-90 transition-transform duration-500 group-hover:scale-105"
            >
        @endif

        <span class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-transparent to-transparent"></span>

        <span class="absolute left-4 top-4 rounded-full bg-white/90 px-3 py-1 text-[11px] font-bold text-[#0066E6] shadow-sm backdrop-blur">
            {{ __($video['level']) }}
        </span>

        <span class="absolute bottom-4 right-4 rounded-md bg-slate-950/70 px-2 py-1 font-mono text-[11px] font-semibold text-white backdrop-blur">
            {{ __($video['duration']) }}
        </span>

        <span class="absolute inset-0 flex items-center justify-center">
            <span class="flex h-14 w-14 items-center justify-center rounded-full bg-white text-[#0066E6] shadow-xl shadow-slate-950/20 transition-all duration-300 group-hover:scale-110 group-hover:bg-[#0066E6] group-hover:text-white">
                <svg class="ml-0.5 h-6 w-6 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                    <polygon points="6 4 20 12 6 20 6 4"></polygon>
                </svg>
            </span>
        </span>
    </div>

    <div class="flex flex-1 flex-col p-6">
        <p class="text-xs font-bold uppercase tracking-wider text-[#0066E6]">
            {{ __($video['topic']) }}
        </p>
        <h3 class="mt-2 text-lg font-bold leading-snug text-base-content transition-colors group-hover:text-[#0066E6]">
            {{ __($video['title']) }}
        </h3>
        <p class="mt-2 flex-1 text-sm leading-relaxed text-base-content/65">
            {{ __($video['description']) }}
        </p>
        <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-bold text-[#0066E6]">
            {{ __('Watch lesson') }}
            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M5 12h14"></path>
                <path d="m12 5 7 7-7 7"></path>
            </svg>
        </span>
    </div>
</a>
