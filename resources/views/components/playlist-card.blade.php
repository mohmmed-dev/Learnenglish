@props([
    'playlist',
    'channelUrl' => null,
])

<a
    href="{{ $channelUrl ?? config('services.youtube.channel_url') }}"
    target="_blank"
    rel="noopener noreferrer"
    class="group relative flex min-h-56 flex-col justify-end overflow-hidden rounded-3xl p-6 text-white shadow-lg transition-all duration-300 hover:-translate-y-1.5 {{ $playlist['poster'] }}"
    aria-label="{{ __('Open playlist') }}: {{ __($playlist['title']) }}"
>
    <span class="pointer-events-none absolute -right-10 -top-16 h-52 w-52 rounded-full border-[28px] border-white/10 transition-transform duration-500 group-hover:scale-125"></span>
    <span class="pointer-events-none absolute -bottom-24 -left-10 h-52 w-52 rounded-full bg-white/10 blur-2xl"></span>

    <span class="relative inline-flex w-fit rounded-full bg-white/20 px-3 py-1 text-[11px] font-bold uppercase tracking-wider backdrop-blur">
        {{ __($playlist['count']) }}
    </span>
    <h3 class="relative mt-3 text-xl font-bold leading-snug">{{ __($playlist['title']) }}</h3>
    <p class="relative mt-2 text-sm leading-relaxed text-white/80">{{ __($playlist['description']) }}</p>
    <span class="relative mt-5 inline-flex items-center gap-2 text-sm font-bold">
        {{ __('Explore playlist') }}
        <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M5 12h14"></path>
            <path d="m12 5 7 7-7 7"></path>
        </svg>
    </span>
</a>
