<header class="sticky top-0 z-50 border-b border-base-200/80 bg-base-100/90 backdrop-blur-xl transition-colors duration-300 dark:border-base-content/10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="navbar min-h-[4.5rem] justify-between items-center p-0">
            <!-- Mobile menu button -->
            <div class="navbar-start w-auto lg:hidden">
                <div class="dropdown">
                    <label tabindex="0" class="btn btn-ghost btn-circle btn-sm" aria-label="{{ __('Open navigation menu') }}">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                            <path d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                    </label>
                    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] w-64 space-y-1 rounded-2xl border border-base-200 bg-base-100 p-3 shadow-2xl dark:border-base-content/10">
                        <li>
                            <a href="{{ route('home') }}" class="font-semibold {{ request()->routeIs('home') ? 'active text-primary' : '' }}">
                                {{ __('Home') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lessons.index') }}" class="font-semibold {{ request()->routeIs('lessons.*') ? 'active text-primary' : '' }}">
                                {{ __('Lessons') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('playlists.index') }}" class="font-semibold {{ request()->routeIs('playlists.*') ? 'active text-primary' : '' }}">
                                {{ __('Playlists') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('categories.index') }}" class="font-semibold {{ request()->routeIs('categories.*') ? 'active text-primary' : '' }}">
                                {{ __('Categories') }}
                            </a>
                        </li>
                        <li class="mt-2 pt-2 border-t border-base-200 dark:border-base-content/10">
                            <a href="{{ route('set.locale', app()->getLocale() === 'ar' ? 'en' : 'ar') }}" class="font-semibold flex items-center justify-between">
                                <span>{{ app()->getLocale() === 'ar' ? 'English (EN)' : 'العربية (AR)' }}</span>
                                <span class="badge badge-sm badge-outline">{{ strtoupper(app()->getLocale() === 'ar' ? 'en' : 'ar') }}</span>
                            </a>
                        </li>
                        <li class="mt-2">
                            <a href="{{ config('services.youtube.channel_url', 'https://www.youtube.com/') }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary w-full text-white">
                                <svg class="h-4 w-4 fill-current mr-1" viewBox="0 0 24 24">
                                    <path d="M23.5 6.2a3 3 0 0 0-2.1-2.2C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.2c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.2A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8ZM9.5 15.6V8.4L15.8 12l-6.3 3.6Z"/>
                                </svg>
                                {{ __('YouTube Channel') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


            <!-- Desktop Navigation -->
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal gap-1 px-1 text-sm font-semibold">
                    <li>
                        <a href="{{ route('home') }}" class="rounded-xl px-3.5 py-2 transition-colors {{ request()->routeIs('home') ? 'bg-[#0066E6]/10 text-[#0066E6]' : 'hover:bg-base-200 hover:text-[#0066E6]' }}">
                            {{ __('Home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('lessons.index') }}" class="rounded-xl px-3.5 py-2 transition-colors {{ request()->routeIs('lessons.*') ? 'bg-[#0066E6]/10 text-[#0066E6]' : 'hover:bg-base-200 hover:text-[#0066E6]' }}">
                            {{ __('Lessons') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('playlists.index') }}" class="rounded-xl px-3.5 py-2 transition-colors {{ request()->routeIs('playlists.*') ? 'bg-[#0066E6]/10 text-[#0066E6]' : 'hover:bg-base-200 hover:text-[#0066E6]' }}">
                            {{ __('Playlists') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}" class="rounded-xl px-3.5 py-2 transition-colors {{ request()->routeIs('categories.*') ? 'bg-[#0066E6]/10 text-[#0066E6]' : 'hover:bg-base-200 hover:text-[#0066E6]' }}">
                            {{ __('Categories') }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Actions (Theme, Language, YouTube) -->
            <div class="navbar-end gap-2">
                <!-- Language Switcher -->
                <a
                    href="{{ route('set.locale', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                    class="btn btn-ghost btn-sm rounded-xl text-xs font-bold text-base-content/80 hover:bg-base-200 hover:text-[#0066E6]"
                    title="{{ app()->getLocale() === 'ar' ? 'Switch to English' : 'التحويل إلى العربية' }}"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                    </svg>
                    <span>{{ strtoupper(app()->getLocale() === 'ar' ? 'EN' : 'عربي') }}</span>
                </a>

                <!-- Theme Toggle -->
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

                <!-- YouTube Button -->
                <a
                    href="{{ config('services.youtube.channel_url', 'https://www.youtube.com/') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="hidden sm:inline-flex btn btn-sm rounded-xl bg-linear-to-r from-[#0066E6] to-[#3385ff] px-4 font-bold text-white shadow-md shadow-[#0066E6]/25 transition-all hover:shadow-lg hover:shadow-[#0066E6]/35"
                >
                    <svg class="h-4 w-4 fill-current mr-1" viewBox="0 0 24 24">
                        <path d="M23.5 6.2a3 3 0 0 0-2.1-2.2C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.2c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.2A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8ZM9.5 15.6V8.4L15.8 12l-6.3 3.6Z"/>
                    </svg>
                    {{ __('YouTube') }}
                </a>
            </div>
        </div>
    </div>
</header>
