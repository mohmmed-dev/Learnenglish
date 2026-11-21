@extends('layout.app')

@section('content')
<div class="py-10 sm:py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-10 text-center sm:text-left sm:flex sm:items-end sm:justify-between">
            <div class="max-w-2xl space-y-3">
                <div class="inline-flex items-center gap-2 rounded-full border border-[#0066E6]/20 bg-[#0066E6]/10 px-3.5 py-1 text-xs font-bold text-[#0066E6]">
                    <span class="h-2 w-2 rounded-full bg-[#0066E6]"></span>
                    {{ __('Lesson Library') }}
                </div>
                <h1 class="text-3xl font-extrabold tracking-tight text-base-content sm:text-5xl">
                    {{ __('English Lessons & Videos') }}
                </h1>
                <p class="text-sm leading-relaxed text-base-content/65 sm:text-base">
                    {{ __('Real YouTube lessons equipped with synchronized audio transcripts and practical listening practice.') }}
                </p>
            </div>
            <div class="mt-4 sm:mt-0 text-sm font-semibold text-base-content/60">
                {{ __('Showing') }} <span class="text-[#0066E6] font-bold">{{ $lessons->total() }}</span> {{ trans_choice('Lesson|Lessons', $lessons->total()) }}
            </div>
        </div>

        <!-- Search and Filters Bar -->
        <div class="mb-8 rounded-3xl border border-base-200 bg-base-100 p-4 shadow-sm dark:border-base-content/10 sm:p-6">
            <form action="{{ route('lessons.index') }}" method="GET" class="space-y-4">
                <!-- Search row -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <input
                            type="text"
                            name="q"
                            value="{{ $search }}"
                            placeholder="{{ __('Search lessons by keyword, topic, or phrase...') }}"
                            class="w-full rounded-2xl border border-base-300 bg-base-200/50 py-3 pl-12 pr-4 text-sm font-medium text-base-content placeholder:text-base-content/40 transition-colors focus:border-[#0066E6] focus:bg-base-100 focus:outline-none focus:ring-2 focus:ring-[#0066E6]/20"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary rounded-2xl px-6 font-bold text-white shadow-md shadow-[#0066E6]/20">
                        {{ __('Search') }}
                    </button>
                    @if(!empty($search) || !empty($categorySlug) || !empty($tagSlug) || !empty($playlistSlug))
                        <a href="{{ route('lessons.index') }}" class="btn btn-ghost rounded-2xl text-xs font-semibold text-base-content/60 hover:text-error">
                            {{ __('Clear Filters') }}
                        </a>
                    @endif
                </div>

                <!-- Category Filters Row -->
                @if($categories->isNotEmpty())
                    <div class="flex items-center gap-2 overflow-x-auto pb-1 pt-2 no-scrollbar">
                        <span class="text-xs font-bold uppercase tracking-wider text-base-content/50 shrink-0 mr-1">
                            {{ __('Category:') }}
                        </span>
                        <a
                            href="{{ route('lessons.index', array_filter(['q' => $search, 'tag' => $tagSlug])) }}"
                            class="shrink-0 rounded-xl px-3.5 py-1.5 text-xs font-bold transition-colors {{ empty($categorySlug) ? 'bg-[#0066E6] text-white shadow-sm' : 'bg-base-200 text-base-content/75 hover:bg-base-300' }}"
                        >
                            {{ __('All Categories') }}
                        </a>
                        @foreach($categories as $cat)
                            <a
                                href="{{ route('lessons.index', array_filter(['category' => $cat->slug, 'q' => $search, 'tag' => $tagSlug])) }}"
                                class="shrink-0 rounded-xl px-3.5 py-1.5 text-xs font-bold transition-colors {{ $categorySlug === $cat->slug ? 'bg-[#0066E6] text-white shadow-sm' : 'bg-base-200 text-base-content/75 hover:bg-base-300' }}"
                            >
                                {{ $cat->name }} ({{ $cat->lessons_count }})
                            </a>
                        @endforeach
                    </div>
                @endif

                <!-- Tag Filters Row -->
                @if($tags->isNotEmpty())
                    <div class="flex items-center gap-2 overflow-x-auto pb-1 pt-1 no-scrollbar">
                        <span class="text-xs font-bold uppercase tracking-wider text-base-content/50 shrink-0 mr-1">
                            {{ __('Level / Tag:') }}
                        </span>
                        <a
                            href="{{ route('lessons.index', array_filter(['q' => $search, 'category' => $categorySlug])) }}"
                            class="shrink-0 rounded-xl px-3 py-1 text-[11px] font-semibold transition-colors {{ empty($tagSlug) ? 'bg-slate-800 text-white dark:bg-slate-200 dark:text-slate-900' : 'bg-base-200/70 text-base-content/65 hover:bg-base-200' }}"
                        >
                            {{ __('All') }}
                        </a>
                        @foreach($tags as $t)
                            <a
                                href="{{ route('lessons.index', array_filter(['tag' => $t->slug, 'q' => $search, 'category' => $categorySlug])) }}"
                                class="shrink-0 rounded-xl px-3 py-1 text-[11px] font-semibold transition-colors {{ $tagSlug === $t->slug ? 'bg-slate-800 text-white dark:bg-slate-200 dark:text-slate-900' : 'bg-base-200/70 text-base-content/65 hover:bg-base-200' }}"
                            >
                                #{{ $t->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </form>
        </div>

        <!-- Lessons Grid -->
        @if($lessons->isNotEmpty())
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($lessons as $lesson)
                    <x-video-card :video="$lesson" />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $lessons->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="rounded-3xl border border-dashed border-base-300 p-12 text-center dark:border-base-content/20">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#0066E6]/10 text-[#0066E6]">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>
                <h3 class="mt-4 text-xl font-bold text-base-content">{{ __('No lessons found') }}</h3>
                <p class="mt-2 text-sm text-base-content/65 max-w-md mx-auto">
                    {{ __('We could not find any lessons matching your criteria. Try adjusting your search term or clearing the filters.') }}
                </p>
                <div class="mt-6">
                    <a href="{{ route('lessons.index') }}" class="btn btn-primary btn-sm rounded-xl text-white">
                        {{ __('View All Lessons') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
