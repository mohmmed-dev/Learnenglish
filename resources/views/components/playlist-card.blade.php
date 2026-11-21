@props([
    'playlist',
    'channelUrl' => null,
])

@php
    $isModel = $playlist instanceof \App\Models\Playlist;

    $title = $isModel ? $playlist->name : ($playlist['title'] ?? '');
    $description = $isModel ? $playlist->description : ($playlist['description'] ?? '');
    $slug = $isModel ? $playlist->slug : ($playlist['slug'] ?? null);
    $countText = $isModel
        ? ($playlist->lessons_count . ' ' . trans_choice('Lesson|Lessons', $playlist->lessons_count))
        : ($playlist['count'] ?? '3 Lessons');
    $categoryName = $isModel ? $playlist->category?->name : null;
    $posterClass = !$isModel ? ($playlist['poster'] ?? 'poster-brand') : 'poster-brand';

    $playlistUrl = $slug ? route('playlists.show', $slug) : ($channelUrl ?? config('services.youtube.channel_url'));
@endphp

<a
    href="{{ $playlistUrl }}"
    class="group relative flex min-h-60 flex-col justify-end overflow-hidden rounded-3xl p-6 text-white shadow-lg transition-all duration-300 hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-[#0066E6]/25 {{ $posterClass }}"
    aria-label="{{ __('Open playlist') }}: {{ $title }}"
>
    <!-- Background artistic patterns -->
    <span class="pointer-events-none absolute -right-10 -top-16 h-52 w-52 rounded-full border-[28px] border-white/10 transition-transform duration-500 group-hover:scale-125"></span>
    <span class="pointer-events-none absolute -bottom-24 -left-10 h-52 w-52 rounded-full bg-white/10 blur-2xl"></span>

    <div class="relative z-10 flex flex-wrap items-center gap-2">
        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-1 text-[11px] font-bold uppercase tracking-wider backdrop-blur">
            <svg class="h-3.5 w-3.5 fill-current" viewBox="0 0 24 24">
                <path d="M4 6h16M4 10h16M4 14h10M4 18h10"></path>
            </svg>
            {{ $countText }}
        </span>

        @if($categoryName)
            <span class="inline-flex rounded-full bg-black/20 px-3 py-1 text-[11px] font-semibold backdrop-blur">
                {{ $categoryName }}
            </span>
        @endif
    </div>

    <h3 class="relative z-10 mt-3 text-xl font-bold leading-snug">{{ $title }}</h3>
    <p class="relative z-10 mt-2 text-sm leading-relaxed text-white/80 line-clamp-2">{{ $description }}</p>

    <span class="relative z-10 mt-5 inline-flex items-center gap-2 text-sm font-bold text-white">
        {{ __('Explore playlist') }}
        <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M5 12h14"></path>
            <path d="m12 5 7 7-7 7"></path>
        </svg>
    </span>
</a>
