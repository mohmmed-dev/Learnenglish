<footer class="border-t border-base-200 bg-base-200/40 transition-colors duration-300 dark:border-base-content/10 dark:bg-base-300/20">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-4">
            <!-- Brand -->
            <div class="space-y-4 md:col-span-2">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5" aria-label="{{ __('LearnEnglish Audio home') }}">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-linear-to-br from-[#0066E6] to-[#4094f7] text-white shadow-lg shadow-[#0066E6]/25">
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H18a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3H6.5A2.5 2.5 0 0 1 4 18.5v-13Zm5 2.2v8.6L15 12 9 7.7Z"></path>
                        </svg>
                    </span>
                    <span class="text-lg font-extrabold tracking-tight">LearnEnglish<span class="text-[#0066E6]">Audio</span></span>
                </a>
                <p class="max-w-md text-sm leading-relaxed text-base-content/65">
                    {{ __('Turn real YouTube channel uploads into practical English lessons. Practice listening, follow synchronized audio transcripts, and master English at your own pace.') }}
                </p>
                <div class="flex items-center gap-2 pt-1">
                    <a href="{{ config('services.youtube.channel_url', 'https://www.youtube.com/') }}" target="_blank" rel="noopener noreferrer" class="btn btn-circle btn-sm btn-ghost hover:bg-[#0066E6]/10 hover:text-[#0066E6]" aria-label="{{ __('Visit our YouTube channel') }}">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M23.5 6.2a3 3 0 0 0-2.1-2.2C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.2c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.2A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8ZM9.5 15.6V8.4L15.8 12l-6.3 3.6Z"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-3">
                <h3 class="text-sm font-bold uppercase tracking-wider text-base-content">{{ __('Explore') }}</h3>
                <ul class="space-y-2 text-sm text-base-content/70">
                    <li><a href="{{ route('home') }}" class="transition-colors hover:text-[#0066E6]">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('lessons.index') }}" class="transition-colors hover:text-[#0066E6]">{{ __('All Lessons') }}</a></li>
                    <li><a href="{{ route('playlists.index') }}" class="transition-colors hover:text-[#0066E6]">{{ __('Playlists') }}</a></li>
                    <li><a href="{{ route('categories.index') }}" class="transition-colors hover:text-[#0066E6]">{{ __('Categories') }}</a></li>
                </ul>
            </div>

            <!-- Languages -->
            <div class="space-y-3">
                <h3 class="text-sm font-bold uppercase tracking-wider text-base-content">{{ __('Languages') }}</h3>
                <ul class="space-y-2 text-sm text-base-content/70">
                    <li>
                        <a href="{{ route('set.locale', 'en') }}" class="flex items-center gap-2 transition-colors hover:text-[#0066E6] {{ app()->getLocale() === 'en' ? 'font-bold text-[#0066E6]' : '' }}">
                            <span>English</span>
                            @if(app()->getLocale() === 'en')
                                <span class="h-1.5 w-1.5 rounded-full bg-[#0066E6]"></span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('set.locale', 'ar') }}" class="flex items-center gap-2 transition-colors hover:text-[#0066E6] {{ app()->getLocale() === 'ar' ? 'font-bold text-[#0066E6]' : '' }}">
                            <span>العربية</span>
                            @if(app()->getLocale() === 'ar')
                                <span class="h-1.5 w-1.5 rounded-full bg-[#0066E6]"></span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="my-8 h-px bg-base-300 dark:bg-base-content/10"></div>

        <div class="flex flex-col items-center justify-between gap-4 text-xs text-base-content/55 sm:flex-row">
            <p>
                &copy; {{ now()->year }} <span class="font-bold text-base-content">{{ config('app.name', 'LearnEnglish Audio') }}</span>. {{ __('All rights reserved.') }}
            </p>
            <p class="flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-[#0066E6] animate-pulse"></span>
                {{ __('Learn English with authentic channel videos every day.') }}
            </p>
        </div>
    </div>
</footer>
