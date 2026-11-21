@extends('layout.app')

@section('content')
<div class="py-10 sm:py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-10 text-center sm:text-left sm:flex sm:items-end sm:justify-between">
            <div class="max-w-2xl space-y-3">
                <div class="inline-flex items-center gap-2 rounded-full border border-[#0066E6]/20 bg-[#0066E6]/10 px-3.5 py-1 text-xs font-bold text-[#0066E6]">
                    <span class="h-2 w-2 rounded-full bg-[#0066E6]"></span>
                    {{ __('Learning Paths') }}
                </div>
                <h1 class="text-3xl font-extrabold tracking-tight text-base-content sm:text-5xl">
                    {{ __('Curated Playlists') }}
                </h1>
                <p class="text-sm leading-relaxed text-base-content/65 sm:text-base">
                    {{ __('Follow clear, progressive learning journeys designed to level up your English step by step.') }}
                </p>
            </div>
            <div class="mt-4 sm:mt-0 text-sm font-semibold text-base-content/60">
                {{ __('Showing') }} <span class="text-[#0066E6] font-bold">{{ $playlists->total() }}</span> {{ trans_choice('Playlist|Playlists', $playlists->total()) }}
            </div>
        </div>

        <!-- Search and Filters Bar -->
        <div class="mb-8 rounded-3xl border border-base-200 bg-base-100 p-4 shadow-sm dark:border-base-content/10 sm:p-6">
            <form action="{{ route('playlists.index') }}" method="GET" class="space-y-4">
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <input
                            type="text"
                            name="q"
                            value="{{ $search }}"
                            placeholder="{{ __('Search playlists by name or topic...') }}"
                            class="w-full rounded-2xl border border-base-300 bg-base-200/50 py-3 pl-12 pr-4 text-sm font-medium text-base-content placeholder:text-base-content/40 transition-colors focus:border-[#0066E6] focus:bg-base-100 focus:outline-none focus:ring-2 focus:ring-[#0066E6]/20"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary rounded-2xl px-6 font-bold text-white shadow-md shadow-[#0066E6]/20">
                        {{ __('Search') }}
                    </button>
                    @if(!empty($search) || !empty($categorySlug))
                        <a href="{{ route('playlists.index') }}" class="btn btn-ghost rounded-2xl text-xs font-semibold text-base-content/60 hover:text-error">
                            {{ __('Clear Filters') }}
                        </a>
                    @endif
                </div>

                @if($categories->isNotEmpty())
                    <div class="flex items-center gap-2 overflow-x-auto pb-1 pt-2 no-scrollbar">
                        <span class="text-xs font-bold uppercase tracking-wider text-base-content/50 shrink-0 mr-1">
                            {{ __('Category:') }}
                        </span>
                        <a
                            href="{{ route('playlists.index', array_filter(['q' => $search])) }}"
                            class="shrink-0 rounded-xl px-3.5 py-1.5 text-xs font-bold transition-colors {{ empty($categorySlug) ? 'bg-[#0066E6] text-white shadow-sm' : 'bg-base-200 text-base-content/75 hover:bg-base-300' }}"
                        >
                            {{ __('All Categories') }}
                        </a>
                        @foreach($categories as $cat)
                            <a
                                href="{{ route('playlists.index', array_filter(['category' => $cat->slug, 'q' => $search])) }}"
                                class="shrink-0 rounded-xl px-3.5 py-1.5 text-xs font-bold transition-colors {{ $categorySlug === $cat->slug ? 'bg-[#0066E6] text-white shadow-sm' : 'bg-base-200 text-base-content/75 hover:bg-base-300' }}"
                            >
                                {{ $cat->name }} ({{ $cat->playlists_count }})
                            </a>
                        @endforeach
                    </div>
                @endif
            </form>
        </div>

        <!-- Playlists Grid -->
        @if($playlists->isNotEmpty())
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($playlists as $playlist)
                    <x-playlist-card :playlist="$playlist" />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $playlists->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="rounded-3xl border border-dashed border-base-300 p-12 text-center dark:border-base-content/20">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#0066E6]/10 text-[#0066E6]">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                    </svg>
                </div>
                <h3 class="mt-4 text-xl font-bold text-base-content">{{ __('No playlists found') }}</h3>
                <p class="mt-2 text-sm text-base-content/65 max-w-md mx-auto">
                    {{ __('Try searching with another keyword or browse all our English playlists.') }}
                </p>
                <div class="mt-6">
                    <a href="{{ route('playlists.index') }}" class="btn btn-primary btn-sm rounded-xl text-white">
                        {{ __('View All Playlists') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
