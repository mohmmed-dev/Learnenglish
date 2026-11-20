<header class="sticky top-0 z-50 border-b border-base-200/80 bg-base-100/85 backdrop-blur-xl transition-colors duration-300 dark:border-base-content/10">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="navbar min-h-[4.5rem] justify-between items-center p-0">
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
                        <li><a href="#videos" class="font-semibold">{{ __('videos') }}</a></li>
                        <li><a href="#playlists" class="font-semibold">{{ __('Playlists') }}</a></li>
                        <li class="mt-2">
                            <a href="#" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary w-full text-white">{{ __('Watch on YouTube') }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Brand -->
            <!-- Desktop navigation -->
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal gap-1 px-1 text-[15px] font-semibold">
                    <li><a href="#hero" class="rounded-xl hover:bg-[#0066E6]/10 hover:text-[#0066E6]">{{ __('Home') }}</a></li>
                    <li><a href="#videos" class="rounded-xl hover:bg-[#0066E6]/10 hover:text-[#0066E6]">{{ __('videos') }}</a></li>
                    <li><a href="#playlists" class="rounded-xl hover:bg-[#0066E6]/10 hover:text-[#0066E6]">{{ __('Playlists') }}</a></li>
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
                    href="#"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-sm rounded-xl bg-linear-to-r from-[#0066E6] to-[#3385ff] px-4 font-bold text-white shadow-md shadow-[#0066E6]/25 transition-all hover:shadow-lg hover:shadow-[#0066E6]/35"
                >
                Carts
            </a>
            </div>
        </div>
    </div>
</header>
