@php
    $channelUrl = config('services.youtube.channel_url');
@endphp

<header class="sticky top-0 z-50 border-b border-base-200/80 bg-base-100/85 backdrop-blur-xl transition-colors duration-300 dark:border-base-content/10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="navbar min-h-[4.5rem] p-0">
            <!-- Mobile menu -->
            <div class="navbar-start w-auto lg:hidden">
                <div class="dropdown">
                    <label tabindex="0" class="btn btn-ghost btn-circle btn-sm" aria-label="{{ __('Open navigation menu') }}">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                            <path d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                    </label>
                    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] w-64 space-y-1 rounded-2xl border border-base-200 bg-base-100 p-3 shadow-2xl dark:border-base-content/10">
                        <li><a href="#hero" class="font-semibold">{{ __('Home') }}</a></li>
                        <li><a href="#videos" class="font-semibold">{{ __('Latest videos') }}</a></li>
                        <li><a href="#playlists" class="font-semibold">{{ __('Playlists') }}</a></li>
                        <li><a href="#how-it-works" class="font-semibold">{{ __('How it works') }}</a></li>
                        <li><a href="#channel" class="font-semibold">{{ __('The channel') }}</a></li>
                        <li class="mt-2">
                            <a href="{{ $channelUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary w-full text-white">{{ __('Watch on YouTube') }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Brand -->
            <div class="navbar-start flex-1 lg:flex-none">
                <a href="/" class="group flex items-center gap-3 focus:outline-none" aria-label="{{ __('LearnEnglish Audio home') }}">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-linear-to-br from-[#0066E6] to-[#4094f7] text-white shadow-lg shadow-[#0066E6]/25 transition-transform duration-200 group-hover:scale-105">
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H18a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3H6.5A2.5 2.5 0 0 1 4 18.5v-13Zm5 2.2v8.6L15 12 9 7.7Z"></path>
                        </svg>
                    </span>
                    <span class="flex flex-col">
                        <span class="text-lg font-extrabold leading-none tracking-tight text-base-content">
                            LearnEnglish<span class="text-[#0066E6]">Audio</span>
                        </span>
                        <span class="mt-1 hidden text-[11px] font-medium text-base-content/55 sm:block">{{ __('Real videos. Real English.') }}</span>
                    </span>
                </a>
            </div>

            <!-- Desktop navigation -->
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal gap-1 px-1 text-[15px] font-semibold">
                    <li><a href="#hero" class="rounded-xl hover:bg-[#0066E6]/10 hover:text-[#0066E6]">{{ __('Home') }}</a></li>
                    <li><a href="#videos" class="rounded-xl hover:bg-[#0066E6]/10 hover:text-[#0066E6]">{{ __('Latest videos') }}</a></li>
                    <li><a href="#playlists" class="rounded-xl hover:bg-[#0066E6]/10 hover:text-[#0066E6]">{{ __('Playlists') }}</a></li>
                    <li><a href="#how-it-works" class="rounded-xl hover:bg-[#0066E6]/10 hover:text-[#0066E6]">{{ __('How it works') }}</a></li>
                    <li><a href="#channel" class="rounded-xl hover:bg-[#0066E6]/10 hover:text-[#0066E6]">{{ __('The channel') }}</a></li>
                </ul>
            </div>

            <!-- Actions -->
            <div class="navbar-end gap-2">
                <button
                    type="button"
                    onclick="toggleTheme()"
                    class="btn btn-ghost btn-circle btn-sm text-base-content/75 transition-colors hover:bg-base-200 hover:text-[#0066E6]"
                    title="{{ __('Switch between light and dark mode') }}"
                    aria-label="{{ __('Switch between light and dark mode') }}"
                >
                    <svg class="hidden h-5 w-5 text-amber-400 dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                    <svg class="block h-5 w-5 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z"></path>
                    </svg>
                </button>

                <a
                    href="{{ $channelUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-sm rounded-xl bg-linear-to-r from-[#0066E6] to-[#3385ff] px-4 font-bold text-white shadow-md shadow-[#0066E6]/25 transition-all hover:shadow-lg hover:shadow-[#0066E6]/35"
                >
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M23.5 6.2a3 3 0 0 0-2.1-2.2C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.2c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.2A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8ZM9.5 15.6V8.4L15.8 12l-6.3 3.6Z"></path>
                    </svg>
                    <span class="hidden sm:inline">{{ __('Watch on YouTube') }}</span>
                    <span class="sm:hidden">{{ __('Watch') }}</span>
                </a>
            </div>
        </div>
    </div>
</header>
