@extends('layout.app')

@section('content')
<div class="py-10 sm:py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-12 text-center max-w-2xl mx-auto space-y-3">
            <div class="inline-flex items-center gap-2 rounded-full border border-[#0066E6]/20 bg-[#0066E6]/10 px-3.5 py-1 text-xs font-bold text-[#0066E6]">
                <span class="h-2 w-2 rounded-full bg-[#0066E6]"></span>
                {{ __('Topics & Levels') }}
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight text-base-content sm:text-5xl">
                {{ __('Explore by Category') }}
            </h1>
            <p class="text-sm leading-relaxed text-base-content/65 sm:text-base">
                {{ __('Find exactly what you need to study today — from casual small talk to business meetings and accent reduction.') }}
            </p>
        </div>

        <!-- Categories Grid -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($categories as $category)
                <a
                    href="{{ route('categories.show', $category->slug) }}"
                    class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-base-200 bg-base-100 p-7 shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:border-[#0066E6]/40 hover:shadow-2xl hover:shadow-[#0066E6]/10 dark:border-base-content/10"
                >
                    <div class="space-y-4">
                        <!-- Icon Badge -->
                        <div class="flex items-center justify-between">
                            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-linear-to-br from-[#0066E6]/15 to-[#3385ff]/10 text-xl font-bold text-[#0066E6] group-hover:scale-110 group-hover:bg-[#0066E6] group-hover:text-white transition-all duration-300">
                                📚
                            </span>
                            <span class="rounded-full bg-base-200 px-3 py-1 text-xs font-bold text-base-content/70">
                                {{ $category->lessons_count }} {{ trans_choice('Lesson|Lessons', $category->lessons_count) }}
                            </span>
                        </div>

                        <!-- Name & Description -->
                        <h2 class="text-xl font-bold text-base-content group-hover:text-[#0066E6] transition-colors">
                            {{ $category->name }}
                        </h2>

                        <p class="text-sm leading-relaxed text-base-content/65 line-clamp-3">
                            {{ $category->description }}
                        </p>
                    </div>

                    <!-- Bottom Link / Stats -->
                    <div class="mt-6 flex items-center justify-between border-t border-base-200 pt-4 dark:border-base-content/10">
                        <span class="text-xs font-semibold text-base-content/50">
                            {{ $category->playlists_count }} {{ trans_choice('Playlist|Playlists', $category->playlists_count) }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0066E6]">
                            {{ __('Explore') }}
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M5 12h14"></path>
                                <path d="m12 5 7 7-7 7"></path>
                            </svg>
                        </span>
                    </div>
                </a>
            @empty
                <div class="col-span-full rounded-3xl border border-dashed border-base-300 p-12 text-center dark:border-base-content/20">
                    <p class="text-sm text-base-content/60">
                        {{ __('No categories found.') }}
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
