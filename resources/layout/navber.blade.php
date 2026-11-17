<header class="sticky top-0 z-50 backdrop-blur-xl bg-base-100/85 border-b border-base-200/80 dark:border-base-content/10 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="navbar min-h-[4.25rem] p-0">
            <!-- Mobile Menu Dropdown -->
            <div class="navbar-start w-auto lg:hidden">
                <div class="dropdown">
                    <label tabindex="0" class="btn btn-ghost btn-circle btn-sm" aria-label="قائمة التصفح">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </label>
                    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-3 shadow-2xl bg-base-100 border border-base-200 dark:border-base-content/10 rounded-2xl w-64 space-y-1">
                        <li><a href="#hero" class="active:bg-primary font-medium">الرئيسية</a></li>
                        <li>
                            <details>
                                <summary class="font-medium">المسارات التعليمية</summary>
                                <ul class="p-2 space-y-1">
                                    <li><a href="#tracks">مبتدئ (A1 - A2)</a></li>
                                    <li><a href="#tracks">متوسط (B1 - B2)</a></li>
                                    <li><a href="#tracks">متقدم وطلاقة (C1 - C2)</a></li>
                                    <li><a href="#tracks">الإنجليزية للأعمال</a></li>
                                </ul>
                            </details>
                        </li>
                        <li><a href="#speaking" class="font-medium">المحادثة التفاعلية <span class="badge badge-xs badge-primary">جديد</span></a></li>
                        <li><a href="#pronounce" class="font-medium">معمل النطق الصوتي</a></li>
                        <li><a href="#features" class="font-medium">مميزات المنصة</a></li>
                        <div class="divider my-2"></div>
                        <li class="space-y-2">
                            <a href="#login" class="btn btn-sm btn-ghost w-full justify-center">تسجيل الدخول</a>
                            <a href="#start" class="btn btn-sm btn-primary w-full text-white">ابدأ الآن مجاناً</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Brand Logo -->
            <div class="navbar-start flex-1 lg:flex-none">
                <a href="/" class="flex items-center gap-3 group focus:outline-none">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#0066E6] to-[#4094f7] flex items-center justify-center text-white shadow-lg shadow-[#0066E6]/25 group-hover:scale-105 transition-transform duration-200">
                        <!-- Modern Book / Speech Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-0.5-0.05"/>
                            <path d="M6 6h10"/>
                            <path d="M6 10h7"/>
                            <path d="M6 14h5"/>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-black tracking-tight text-base-content flex items-center gap-1.5 en-font">
                            Learn<span class="text-[#0066E6]">English</span>
                            <span class="badge badge-xs badge-primary font-semibold text-[10px] tracking-normal px-1.5 py-0.5">PRO</span>
                        </span>
                        <span class="text-[11px] font-medium text-base-content/60 -mt-1 hidden sm:inline-block">منصتك الذكية لطلاقة الإنجليزية</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal px-1 gap-1 text-[15px] font-medium">
                    <li>
                        <a href="#hero" class="hover:text-[#0066E6] hover:bg-[#0066E6]/10 rounded-xl transition-colors">الرئيسية</a>
                    </li>
                    <li class="relative group">
                        <details class="dropdown">
                            <summary class="hover:text-[#0066E6] hover:bg-[#0066E6]/10 rounded-xl transition-colors">
                                المسارات التعليمية
                            </summary>
                            <ul class="dropdown-content z-[1] menu p-3 shadow-xl bg-base-100 border border-base-200 dark:border-base-content/10 rounded-2xl w-64 space-y-1">
                                <li>
                                    <a href="#tracks" class="flex items-center gap-2.5 py-2">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                        <div>
                                            <div class="font-semibold text-sm">المبتدئين (A1 - A2)</div>
                                            <div class="text-xs text-base-content/60">الأساسيات وبناء الجمل</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tracks" class="flex items-center gap-2.5 py-2">
                                        <span class="w-2 h-2 rounded-full bg-[#0066E6]"></span>
                                        <div>
                                            <div class="font-semibold text-sm">المتوسط (B1 - B2)</div>
                                            <div class="text-xs text-base-content/60">طلاقة المحادثة اليومية</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tracks" class="flex items-center gap-2.5 py-2">
                                        <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                                        <div>
                                            <div class="font-semibold text-sm">المتقدم (C1 - C2)</div>
                                            <div class="text-xs text-base-content/60">المصطلحات المعقدة والنقاشات</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tracks" class="flex items-center gap-2.5 py-2">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        <div>
                                            <div class="font-semibold text-sm">الإنجليزية للأعمال (Business)</div>
                                            <div class="text-xs text-base-content/60">المقابلات ورسائل العمل</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </details>
                    </li>
                    <li>
                        <a href="#speaking" class="hover:text-[#0066E6] hover:bg-[#0066E6]/10 rounded-xl transition-colors flex items-center gap-1.5">
                            المحادثة الذكية
                            <span class="badge badge-xs badge-primary text-[10px] text-white">AI</span>
                        </a>
                    </li>
                    <li>
                        <a href="#pronounce" class="hover:text-[#0066E6] hover:bg-[#0066E6]/10 rounded-xl transition-colors">معمل النطق</a>
                    </li>
                    <li>
                        <a href="#features" class="hover:text-[#0066E6] hover:bg-[#0066E6]/10 rounded-xl transition-colors">لماذا نحن؟</a>
                    </li>
                </ul>
            </div>

            <!-- Navbar End: Theme Switcher & Action Buttons -->
            <div class="navbar-end gap-2.5">
                <!-- DaisyUI Theme Toggle Controller (Sun / Moon) -->
                <button 
                    onclick="toggleTheme()" 
                    class="btn btn-ghost btn-circle btn-sm text-base-content/80 hover:text-[#0066E6] hover:bg-base-200 transition-colors"
                    title="التبديل بين الوضع المظلم والصباحي"
                    aria-label="التبديل بين الوضع المظلم والصباحي"
                >
                    <!-- Sun Icon (shown in dark mode) -->
                    <svg class="w-5 h-5 hidden dark:block text-amber-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                    <!-- Moon Icon (shown in light mode) -->
                    <svg class="w-5 h-5 block dark:hidden text-slate-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                </button>

                <!-- Auth / CTA Buttons -->
                <a href="#login" class="btn btn-ghost btn-sm rounded-xl font-medium hidden md:inline-flex hover:text-[#0066E6]">
                    تسجيل الدخول
                </a>
                <a href="#start" class="btn btn-sm btn-primary rounded-xl font-bold px-4 shadow-md shadow-[#0066E6]/25 hover:shadow-lg hover:shadow-[#0066E6]/35 transition-all text-white flex items-center gap-1.5">
                    <span>ابدأ مجاناً</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 rtl:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</header>
