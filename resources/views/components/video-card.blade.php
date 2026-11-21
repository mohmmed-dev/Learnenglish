@props([
    'video',
    'channelUrl' => null,
])

@php
    $isModel = $video instanceof \App\Models\Lesson;

    $title = $isModel ? $video->title : ($video['title'] ?? '');
    $description = $isModel ? $video->description : ($video['description'] ?? '');
    $slug = $isModel ? $video->slug : ($video['slug'] ?? null);
    $categoryName = $isModel ? ($video->category?->name ?? __('English')) : ($video['topic'] ?? __('English'));
    $level = $isModel ? ($video->tags->first()?->name ?? __('Lesson')) : ($video['level'] ?? __('Lesson'));
    $duration = $isModel ? '15:00' : ($video['duration'] ?? '10:00');
    $posterClass = !$isModel ? ($video['poster'] ?? 'poster-brand') : 'poster-brand';
    $imageUrl = $isModel ? $video->image_url : null;
    $hasAudio = $isModel ? !empty($video->audio_url) : false;
    $hasBody = $isModel ? !empty($video->body) : false;

    // Extract youtube ID if not set directly
    $youtubeId = null;
    if ($isModel && !empty($video->youtube_url)) {
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $video->youtube_url, $matches)) {
            $youtubeId = $matches[1];
        }
    } elseif (!$isModel) {
        $youtubeId = $video['youtube_id'] ?? null;
    }

    $lessonUrl = $slug ? route('lessons.show', $slug) : ($youtubeId ? "https://www.youtube.com/watch?v={$youtubeId}" : '#');
@endphp

<a
    href="{{ $lessonUrl }}"
    class="group flex h-full flex-col overflow-hidden rounded-3xl border border-base-200 bg-base-100 shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:border-[#0066E6]/40 hover:shadow-2xl hover:shadow-[#0066E6]/10 dark:border-base-content/10"
    aria-label="{{ __('Watch lesson') }}: {{ $title }}"
>
    <div class="relative aspect-video overflow-hidden {{ $posterClass }}">
        @if ($imageUrl)
            <img
                src="{{ $imageUrl }}"
                alt="{{ $title }}"
                loading="lazy"
                class="absolute inset-0 h-full w-full object-cover opacity-90 transition-transform duration-500 group-hover:scale-105"
            >
        @elseif ($youtubeId)
            <img
                src="https://i.ytimg.com/vi/{{ $youtubeId }}/hqdefault.jpg"
                alt="{{ $title }}"
                loading="lazy"
                class="absolute inset-0 h-full w-full object-cover opacity-90 transition-transform duration-500 group-hover:scale-105"
            >
        @endif

        <span class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></span>

        <!-- Level badge -->
        <span class="absolute left-4 top-4 rounded-full bg-white/90 px-3 py-1 text-[11px] font-bold text-[#0066E6] shadow-sm backdrop-blur">
            {{ $level }}
        </span>

        <!-- Features Badges (Audio / Transcript) -->
        <div class="absolute right-4 top-4 flex gap-1.5">
            @if($hasAudio)
                <span class="flex h-6 items-center gap-1 rounded-full bg-emerald-500/90 px-2 text-[10px] font-bold text-white shadow-sm backdrop-blur" title="{{ __('Audio available') }}">
                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>
                    </svg>
                    <span>{{ __('Audio') }}</span>
                </span>
            @endif
            @if($hasBody)
                <span class="flex h-6 items-center gap-1 rounded-full bg-indigo-500/90 px-2 text-[10px] font-bold text-white shadow-sm backdrop-blur" title="{{ __('Interactive transcript') }}">
                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                    <span>{{ __('Transcript') }}</span>
                </span>
            @endif
        </div>

        <!-- Center Play Button -->
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
            {{ $categoryName }}
        </p>
        <h3 class="mt-2 text-lg font-bold leading-snug text-base-content transition-colors group-hover:text-[#0066E6]">
            {{ $title }}
        </h3>
        <p class="mt-2 flex-1 text-sm leading-relaxed text-base-content/65 line-clamp-2">
            {{ $description }}
        </p>
        <div class="mt-5 flex items-center justify-between border-t border-base-200 pt-4 dark:border-base-content/10">
            <span class="inline-flex items-center gap-1.5 text-sm font-bold text-[#0066E6]">
                {{ __('Practice lesson') }}
                <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                </svg>
            </span>
            @if($isModel && $video->playlist)
                <span class="text-xs text-base-content/50 truncate max-w-[140px]" title="{{ $video->playlist->name }}">
                    {{ $video->playlist->name }}
                </span>
            @endif
        </div>
    </div>
</a>
