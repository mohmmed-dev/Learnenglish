@php
    $channelUrl = config('services.youtube.channel_url');
@endphp

<footer class="border-t border-base-200 bg-base-200/40 transition-colors duration-300 dark:border-base-content/10 dark:bg-base-300/20">
    <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-4">
            <!-- Brand -->
            <div class="space-y-4 lg:col-span-1">
                <a href="/" class="flex items-center gap-3" aria-label="{{ __('LearnEnglish Audio home') }}">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-linear-to-br from-[#0066E6] to-[#4094f7] text-white shadow-lg shadow-[#0066E6]/25">
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H18a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3H6.5A2.5 2.5 0 0 1 4 18.5v-13Zm5 2.2v8.6L15 12 9 7.7Z"></path>
                        </svg>
                    </span>
                    <span class="text-lg font-extrabold tracking-tight">LearnEnglish<span class="text-[#0066E6]">Audio</span></span>
                </a>
                <p class="max-w-sm text-sm leading-relaxed text-base-content/65">
                    {{ __('A home for every video our channel publishes. Watch, listen, and turn real English into a daily habit.') }}
                </p>
                <div class="flex items-center gap-2">
                    <a href="{{ $channelUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-circle btn-sm btn-ghost hover:bg-[#0066E6]/10 hover:text-[#0066E6]" aria-label="{{ __('Visit our YouTube channel') }}">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M23.5 6.2a3 3 0 0 0-2.1-2.2C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.2c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.2A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8ZM9.5 15.6V8.4L15.8 12l-6.3 3.6Z"></path>
                        </svg>
                    </a>
                    <a href="mailto:hello@learnenglishaudio.com" class="btn btn-circle btn-sm btn-ghost hover:bg-[#0066E6]/10 hover:text-[#0066E6]" aria-label="{{ __('Email us') }}">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                            <path d="m2 7 10 6 10-6"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Explore -->
            <div class="space-y-3">
                <h2 class="text-base font-bold text-base-content">{{ __('Explore') }}</h2>
                <ul class="space-y-2 text-sm text-base-content/65">
                    <li><a href="#hero" class="transition-colors hover:text-[#0066E6]">{{ __('Home') }}</a></li>
                    <li><a href="#videos" class="transition-colors hover:text-[#0066E6]">{{ __('Latest videos') }}</a></li>
                    <li><a href="#playlists" class="transition-colors hover:text-[#0066E6]">{{ __('Playlists') }}</a></li>
                    <li><a href="#channel" class="transition-colors hover:text-[#0066E6]">{{ __('The channel') }}</a></li>
                </ul>
            </div>

            <!-- Topics -->
            <div class="space-y-3">
                <h2 class="text-base font-bold text-base-content">{{ __('Popular topics') }}</h2>
                <ul class="space-y-2 text-sm text-base-content/65">
                    <li><a href="#videos" class="transition-colors hover:text-[#0066E6]">{{ __('Everyday conversations') }}</a></li>
                    <li><a href="#videos" class="transition-colors hover:text-[#0066E6]">{{ __('Pronunciation') }}</a></li>
                    <li><a href="#videos" class="transition-colors hover:text-[#0066E6]">{{ __('Business English') }}</a></li>
                    <li><a href="#videos" class="transition-colors hover:text-[#0066E6]">{{ __('Listening practice') }}</a></li>
                    <li><a href="#videos" class="transition-colors hover:text-[#0066E6]">{{ __('Exam preparation') }}</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="space-y-3">
                <h2 class="text-base font-bold text-base-content">{{ __('Weekly learning email') }}</h2>
                <p class="text-xs leading-relaxed text-base-content/65">
                    {{ __('One useful phrase, one quick tip, and the newest video every Sunday.') }}
                </p>
                <form onsubmit="event.preventDefault(); alert('{{ __('Thanks for subscribing! Check your inbox soon.') }}');" class="space-y-2">
                    <label class="input input-bordered flex h-10 items-center gap-2 rounded-xl focus-within:border-[#0066E6]">
                        <svg class="h-4 w-4 text-base-content/45" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                            <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                            <path d="m2 7 10 6 10-6"></path>
                        </svg>
                        <input type="email" required placeholder="{{ __('Your email address') }}" class="grow bg-transparent text-sm outline-none" aria-label="{{ __('Your email address') }}">
                    </label>
                    <button type="submit" class="btn btn-sm w-full rounded-xl bg-linear-to-r from-[#0066E6] to-[#3385ff] text-white">
                        {{ __('Subscribe') }}
                    </button>
                </form>
            </div>
        </div>

        <div class="my-10 h-px bg-base-300 dark:bg-base-content/10"></div>

        <div class="flex flex-col items-center justify-between gap-4 text-xs text-base-content/55 sm:flex-row">
            <p>
                &copy; {{ now()->year }} <span class="font-bold text-base-content">{{ __('LearnEnglish Audio') }}</span>. {{ __('All rights reserved.') }}
            </p>
            <p class="flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-[#0066E6]"></span>
                {{ __('New lessons from the channel, every week.') }}
            </p>
        </div>
    </div>
</footer>
