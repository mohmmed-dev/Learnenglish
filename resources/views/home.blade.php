@extends('layout.app')

@section('title', 'LearnEnglish | تعلم الإنجليزية بذكاء وعصرية')

@section('content')
<!-- Hero Section -->
<section id="hero" class="relative overflow-hidden pt-8 pb-16 md:pt-14 md:pb-24">
    <!-- Ambient Background Lighting Effect -->
    <div class="absolute top-0 right-1/4 -z-10 w-96 h-96 bg-[#0066E6]/10 dark:bg-[#0066E6]/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 left-10 -z-10 w-80 h-80 bg-sky-400/10 dark:bg-sky-400/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left/Hero Text Content (in RTL it's the right side) -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-right">
                <!-- Pill Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#0066E6]/10 dark:bg-[#0066E6]/20 border border-[#0066E6]/20 text-[#0066E6] text-xs sm:text-sm font-semibold">
                    <span class="flex h-2 w-2 rounded-full bg-[#0066E6] animate-pulse"></span>
                    <span>الجيل الجديد لتعلم الإنجليزية بذكاء وعصرية ✨</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-base-content tracking-tight leading-[1.2] sm:leading-[1.2]">
                    تحدث الإنجليزية <br class="hidden sm:inline" />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#0066E6] via-[#3385ff] to-sky-500">
                        بطلاقة وبثقة كاملة،
                    </span>
                    بدون تردد!
                </h1>

                <!-- Subheadline -->
                <p class="text-base sm:text-lg text-base-content/75 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    منصة تعليمية مبتكرة تجمع بين <strong class="text-base-content">المحادثة التفاعلية الذكية</strong>، وتحسين مخارج النطق، وبنك المفردات الحية، لتنقلك من مرحلة الفهم الصامت إلى طلاقة التعبير في أي موقف.
                </p>

                <!-- Action CTAs -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                    <a href="#start" class="btn btn-primary btn-md sm:btn-lg rounded-2xl px-7 text-white font-bold shadow-lg shadow-[#0066E6]/30 hover:shadow-xl hover:shadow-[#0066E6]/40 transition-all w-full sm:w-auto flex items-center justify-center gap-2">
                        <span>ابدأ رحلتك مجاناً</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>

                    <a href="#test" class="btn btn-outline btn-md sm:btn-lg rounded-2xl px-6 font-semibold border-base-300 dark:border-base-content/20 hover:border-[#0066E6] hover:bg-[#0066E6]/10 hover:text-[#0066E6] transition-all w-full sm:w-auto flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#0066E6]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                        <span>اختبر مستواك بدقيقتين</span>
                    </a>
                </div>

                <!-- Social Proof Badges -->
                <div class="pt-4 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 text-xs sm:text-sm text-base-content/70">
                    <div class="avatar-group -space-x-3 rtl:space-x-reverse">
                        <div class="avatar border-2 border-base-100">
                            <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center font-bold text-blue-600 dark:text-blue-300 text-xs">س</div>
                        </div>
                        <div class="avatar border-2 border-base-100">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center font-bold text-emerald-600 dark:text-emerald-300 text-xs">م</div>
                        </div>
                        <div class="avatar border-2 border-base-100">
                            <div class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900/50 flex items-center justify-center font-bold text-purple-600 dark:text-purple-300 text-xs">خ</div>
                        </div>
                        <div class="avatar border-2 border-base-100">
                            <div class="w-8 h-8 rounded-full bg-[#0066E6] text-white flex items-center justify-center font-bold text-[10px]">+50k</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <div class="flex text-amber-400">
                            ★★★★★
                        </div>
                        <span class="font-bold text-base-content">4.9/5</span>
                        <span class="text-base-content/50">| أكثر من 50,000 متعلم نشط</span>
                    </div>
                </div>
            </div>

            <!-- Right Hero Card: Interactive Showcase -->
            <div class="lg:col-span-5 relative">
                <!-- Floating Decorative Badges -->
                <div class="absolute -top-5 -left-4 z-20 hidden sm:flex items-center gap-2.5 px-4 py-2.5 rounded-2xl bg-base-100/90 backdrop-blur-md shadow-xl border border-base-200 dark:border-base-content/10 animate-bounce duration-1000">
                    <span class="text-xl">🔥</span>
                    <div class="text-right">
                        <div class="text-xs font-bold text-base-content">14 يوماً حماساً</div>
                        <div class="text-[10px] text-base-content/60">مستمر بلا انقطاع!</div>
                    </div>
                </div>

                <div class="absolute -bottom-5 -right-4 z-20 hidden sm:flex items-center gap-2.5 px-4 py-2.5 rounded-2xl bg-base-100/90 backdrop-blur-md shadow-xl border border-base-200 dark:border-base-content/10">
                    <div class="w-8 h-8 rounded-full bg-emerald-500/10 text-emerald-500 flex items-center justify-center font-bold text-sm">
                        ✓
                    </div>
                    <div class="text-right">
                        <div class="text-xs font-bold text-emerald-600 dark:text-emerald-400">النطق سليم: 98%</div>
                        <div class="text-[10px] text-base-content/60">مخارج أصوات متقنة</div>
                    </div>
                </div>

                <!-- Main Glass Card -->
                <div class="relative bg-base-100 rounded-3xl p-6 sm:p-7 shadow-2xl border border-base-200 dark:border-base-content/10 transition-all duration-300">
                    
                    <!-- Card Header -->
                    <div class="flex items-center justify-between pb-4 border-b border-base-200 dark:border-base-content/10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#0066E6]/10 text-[#0066E6] flex items-center justify-center font-bold">
                                🎧
                            </div>
                            <div class="text-right">
                                <h3 class="font-bold text-sm text-base-content">محادثة اليوم التفاعلية</h3>
                                <p class="text-xs text-base-content/60">المستوى: متوسط (B1)</p>
                            </div>
                        </div>
                        <span class="badge badge-primary badge-outline text-xs font-semibold px-2 py-0.5">
                            الدرس 12 / 30
                        </span>
                    </div>

                    <!-- Progress Bar -->
                    <div class="pt-4 space-y-1.5">
                        <div class="flex justify-between text-xs text-base-content/70">
                            <span>هدف اليوم اليومي</span>
                            <span class="font-bold text-[#0066E6]">80%</span>
                        </div>
                        <progress class="progress progress-primary w-full h-2 rounded-full" value="80" max="100"></progress>
                    </div>

                    <!-- Phrase Box with Real Sound Player -->
                    <div class="my-5 p-4 rounded-2xl bg-base-200/60 dark:bg-base-300/40 border border-base-300/40 dark:border-base-content/5 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="badge badge-sm bg-base-100 font-mono text-[11px] text-base-content/70">English Phrase</span>
                            <span class="text-xs text-[#0066E6] font-semibold">اضغط للاستماع 🔊</span>
                        </div>

                        <div class="text-right">
                            <div class="text-lg font-bold en-font text-base-content tracking-wide" id="hero-phrase">
                                "Could you please elaborate on that?"
                            </div>
                            <div class="text-xs text-base-content/60 font-mono mt-0.5">
                                /kʊd juː pliːz ɪˈlæb.ə.reɪt ɑːn ðæt/
                            </div>
                            <div class="text-sm font-medium text-base-content/80 mt-2">
                                المعنى: هل يمكنك التوضيح والتفصيل في ذلك أكثر؟
                            </div>
                        </div>

                        <!-- Mini Audio Player Controls -->
                        <div class="flex items-center justify-between pt-2 border-t border-base-300/50 dark:border-base-content/10">
                            <button 
                                onclick="speakText('Could you please elaborate on that?')" 
                                class="btn btn-sm btn-primary rounded-xl text-white px-4 flex items-center gap-1.5 shadow-sm"
                                id="btn-hero-play"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                <span>استمع الآن</span>
                            </button>

                            <div class="flex items-center gap-1 text-xs text-base-content/60">
                                <span class="badge badge-ghost badge-sm font-mono">1.0x</span>
                                <span class="badge badge-ghost badge-sm">لهجة أمريكية 🇺🇸</span>
                            </div>
                        </div>
                    </div>

                    <!-- Micro Quiz / Interactive Pill -->
                    <div class="p-3.5 rounded-2xl border border-dashed border-base-300 dark:border-base-content/15 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-600 flex items-center justify-center font-bold text-sm">
                                💡
                            </div>
                            <div class="text-xs text-right">
                                <div class="font-bold text-base-content">استخدام الكلمة: Elaborate</div>
                                <div class="text-base-content/60">فعل يُستخدم في المقابلات واجتماعات العمل</div>
                            </div>
                        </div>
                        <span class="badge badge-success badge-sm text-white font-bold">+25 XP</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- Stats Bar -->
<section class="py-10 bg-base-200/40 dark:bg-base-300/20 border-y border-base-200 dark:border-base-content/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            
            <div class="space-y-1">
                <div class="text-3xl sm:text-4xl font-black text-[#0066E6] en-font">+50,000</div>
                <div class="text-xs sm:text-sm font-semibold text-base-content/80">متعلم نشط شهرياً</div>
            </div>

            <div class="space-y-1">
                <div class="text-3xl sm:text-4xl font-black text-base-content en-font">+1,200</div>
                <div class="text-xs sm:text-sm font-semibold text-base-content/80">درس ومحادثة تفاعلية</div>
            </div>

            <div class="space-y-1">
                <div class="text-3xl sm:text-4xl font-black text-[#0066E6] en-font">98%</div>
                <div class="text-xs sm:text-sm font-semibold text-base-content/80">نسبة تحسن طلاقة المتحدثين</div>
            </div>

            <div class="space-y-1">
                <div class="text-3xl sm:text-4xl font-black text-base-content en-font">4.9 / 5</div>
                <div class="text-xs sm:text-sm font-semibold text-base-content/80">تقييم المتعلمين المعتمد</div>
            </div>

        </div>
    </div>
</section>

<!-- Interactive Audio Pronunciation Lab -->
<section id="pronounce" class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto space-y-3 mb-12">
            <span class="badge badge-primary badge-outline text-xs font-bold uppercase tracking-wider">
                معمل النطق الصوتي الحي
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-base-content tracking-tight">
                استمع للنطق الصحيح ومارس الكلمات مباشرة
            </h2>
            <p class="text-sm sm:text-base text-base-content/70">
                اضغط على أي كلمة من الكلمات الشائعة لتسمع صوت نطقها السليم بواسطة محرك النطق، واطلع على الترميز الصوتي الدقيق.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Card 1 -->
            <div class="card bg-base-100 border border-base-200 dark:border-base-content/10 hover:border-[#0066E6] hover:shadow-xl transition-all duration-200 rounded-2xl group">
                <div class="card-body p-6 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="badge badge-ghost text-xs font-mono">صفة • Adjective</span>
                        <span class="text-xs text-base-content/50">🇺🇸 أمريكي</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold en-font text-base-content group-hover:text-[#0066E6] transition-colors">
                            Comfortable
                        </h3>
                        <p class="text-xs text-base-content/60 font-mono">/ˈkʌm.fɚ.t̬ə.bəl/</p>
                    </div>
                    <p class="text-sm text-base-content/80 font-medium">
                        المعنى: مريح / يشعر بالارتياح
                    </p>
                    <div class="pt-2">
                        <button 
                            onclick="speakText('Comfortable')" 
                            class="btn btn-sm btn-outline btn-primary w-full rounded-xl flex items-center justify-center gap-2 group-hover:btn-primary group-hover:text-white"
                        >
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                            <span>استمع للنطق</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card bg-base-100 border border-base-200 dark:border-base-content/10 hover:border-[#0066E6] hover:shadow-xl transition-all duration-200 rounded-2xl group">
                <div class="card-body p-6 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="badge badge-ghost text-xs font-mono">اسم • Noun</span>
                        <span class="text-xs text-base-content/50">🇬🇧 بريطاني</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold en-font text-base-content group-hover:text-[#0066E6] transition-colors">
                            Opportunity
                        </h3>
                        <p class="text-xs text-base-content/60 font-mono">/ˌɒp.əˈtjuː.nə.ti/</p>
                    </div>
                    <p class="text-sm text-base-content/80 font-medium">
                        المعنى: فرصة مناسبة أو سانحة
                    </p>
                    <div class="pt-2">
                        <button 
                            onclick="speakText('Opportunity', 'en-GB')" 
                            class="btn btn-sm btn-outline btn-primary w-full rounded-xl flex items-center justify-center gap-2 group-hover:btn-primary group-hover:text-white"
                        >
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                            <span>استمع للنطق</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="card bg-base-100 border border-base-200 dark:border-base-content/10 hover:border-[#0066E6] hover:shadow-xl transition-all duration-200 rounded-2xl group">
                <div class="card-body p-6 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="badge badge-ghost text-xs font-mono">اسم • Noun</span>
                        <span class="text-xs text-base-content/50">🇺🇸 أمريكي</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold en-font text-base-content group-hover:text-[#0066E6] transition-colors">
                            Schedule
                        </h3>
                        <p class="text-xs text-base-content/60 font-mono">/ˈskedʒ.uːl/</p>
                    </div>
                    <p class="text-sm text-base-content/80 font-medium">
                        المعنى: جدول مواعيد أو خطة عمل
                    </p>
                    <div class="pt-2">
                        <button 
                            onclick="speakText('Schedule')" 
                            class="btn btn-sm btn-outline btn-primary w-full rounded-xl flex items-center justify-center gap-2 group-hover:btn-primary group-hover:text-white"
                        >
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                            <span>استمع للنطق</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="card bg-base-100 border border-base-200 dark:border-base-content/10 hover:border-[#0066E6] hover:shadow-xl transition-all duration-200 rounded-2xl group">
                <div class="card-body p-6 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="badge badge-ghost text-xs font-mono">صفة • Adjective</span>
                        <span class="text-xs text-base-content/50">🇺🇸 أمريكي</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold en-font text-base-content group-hover:text-[#0066E6] transition-colors">
                            Enthusiastic
                        </h3>
                        <p class="text-xs text-base-content/60 font-mono">/ɪnˌθuː.ziˈæs.tɪk/</p>
                    </div>
                    <p class="text-sm text-base-content/80 font-medium">
                        المعنى: مفعم بالحماس والشغف
                    </p>
                    <div class="pt-2">
                        <button 
                            onclick="speakText('Enthusiastic')" 
                            class="btn btn-sm btn-outline btn-primary w-full rounded-xl flex items-center justify-center gap-2 group-hover:btn-primary group-hover:text-white"
                        >
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                            <span>استمع للنطق</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Learning Pathways / Levels Section -->
<section id="tracks" class="py-16 md:py-24 bg-base-200/40 dark:bg-base-300/20 border-t border-base-200 dark:border-base-content/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="space-y-3 max-w-xl">
                <span class="badge badge-primary badge-outline text-xs font-bold uppercase tracking-wider">
                    المسارات المعتمدة CEFR
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-base-content tracking-tight">
                    مسارات تدريبية تناسب مستواك وهدفك
                </h2>
                <p class="text-sm sm:text-base text-base-content/70">
                    من أول حرف وحتى إجراء مقابلات العمل وتقديم العروض التقديمية بالإنجليزية.
                </p>
            </div>
            <div>
                <a href="#test" class="btn btn-ghost hover:text-[#0066E6] flex items-center gap-1.5 font-bold text-sm">
                    <span>لست متأكداً من مستواك؟ اختبر نفسك الآن</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 rtl:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Track 1: A1 - A2 -->
            <div class="card bg-base-100 border border-base-200 dark:border-base-content/10 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-200 flex flex-col justify-between">
                <div class="card-body p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-1 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-bold text-xs en-font">
                            LEVEL A1 - A2
                        </span>
                        <span class="text-xs text-base-content/50">40 درساً</span>
                    </div>

                    <h3 class="text-xl font-bold text-base-content">
                        الأساسيات والمبتدئين
                    </h3>

                    <p class="text-xs text-base-content/70 leading-relaxed">
                        بناء القاعدة المتينة: تركيب الجمل البسيطة، التعارف، الأرقام والأوقات، وأهم 500 كلمة شائعة.
                    </p>

                    <ul class="text-xs space-y-2 text-base-content/80 pt-2 border-t border-base-200 dark:border-base-content/10">
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-500">✓</span> نطق الحروف المركبة
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-500">✓</span> جمل الحياة اليومية
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-500">✓</span> تمارين استماع بطيئة
                        </li>
                    </ul>
                </div>
                <div class="p-6 pt-0">
                    <a href="#start" class="btn btn-outline btn-sm w-full rounded-xl hover:bg-[#0066E6] hover:border-[#0066E6] hover:text-white transition-all">
                        استكشف المسار
                    </a>
                </div>
            </div>

            <!-- Track 2: B1 - B2 (Featured) -->
            <div class="card bg-base-100 border-2 border-[#0066E6] rounded-2xl shadow-lg relative flex flex-col justify-between">
                <div class="absolute -top-3.5 left-1/2 -translate-x-1/2">
                    <span class="badge badge-primary text-white text-[11px] font-bold px-3 py-1 shadow-md">
                        الأكثر طلباً ⭐
                    </span>
                </div>
                <div class="card-body p-6 space-y-4 pt-7">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-1 rounded-lg bg-[#0066E6]/10 text-[#0066E6] font-bold text-xs en-font">
                            LEVEL B1 - B2
                        </span>
                        <span class="text-xs text-base-content/50">65 درساً</span>
                    </div>

                    <h3 class="text-xl font-bold text-base-content">
                        المتوسط والطلاقة الحوارية
                    </h3>

                    <p class="text-xs text-base-content/70 leading-relaxed">
                        كسر حاجز الخوف من الحديث: التحدث في المطاعم، السفر، التسوق، ومناقشة الآراء والقصص الشخصية.
                    </p>

                    <ul class="text-xs space-y-2 text-base-content/80 pt-2 border-t border-base-200 dark:border-base-content/10">
                        <li class="flex items-center gap-2">
                            <span class="text-[#0066E6]">✓</span> محادثات ذكاء اصطناعي تفاعلية
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#0066E6]">✓</span> تصحيح الأخطاء القواعدية فورياً
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#0066E6]">✓</span> تعبيرات المحادثة Idioms
                        </li>
                    </ul>
                </div>
                <div class="p-6 pt-0">
                    <a href="#start" class="btn btn-primary btn-sm w-full rounded-xl text-white font-bold shadow-md shadow-[#0066E6]/30">
                        ابدأ مسار المتوسط
                    </a>
                </div>
            </div>

            <!-- Track 3: C1 - C2 -->
            <div class="card bg-base-100 border border-base-200 dark:border-base-content/10 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-200 flex flex-col justify-between">
                <div class="card-body p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-1 rounded-lg bg-purple-500/10 text-purple-600 dark:text-purple-400 font-bold text-xs en-font">
                            LEVEL C1 - C2
                        </span>
                        <span class="text-xs text-base-content/50">50 درساً</span>
                    </div>

                    <h3 class="text-xl font-bold text-base-content">
                        المتقدم والاحتراف اللغوي
                    </h3>

                    <p class="text-xs text-base-content/70 leading-relaxed">
                        الوصول لمستوى المتحدث الأصلي: فهم البودكاست السريع والأفلام دون ترجمة، والنقاش في مواضيع فكرية معقدة.
                    </p>

                    <ul class="text-xs space-y-2 text-base-content/80 pt-2 border-t border-base-200 dark:border-base-content/10">
                        <li class="flex items-center gap-2">
                            <span class="text-purple-500">✓</span> استيعاب اللهجات المتنوعة
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-purple-500">✓</span> التفكير المباشر بالإنجليزية
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-purple-500">✓</span> الكتابة الأكاديمية والتحليل
                        </li>
                    </ul>
                </div>
                <div class="p-6 pt-0">
                    <a href="#start" class="btn btn-outline btn-sm w-full rounded-xl hover:bg-[#0066E6] hover:border-[#0066E6] hover:text-white transition-all">
                        استكشف المسار
                    </a>
                </div>
            </div>

            <!-- Track 4: Business English -->
            <div class="card bg-base-100 border border-base-200 dark:border-base-content/10 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-200 flex flex-col justify-between">
                <div class="card-body p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-1 rounded-lg bg-amber-500/10 text-amber-600 dark:text-amber-400 font-bold text-xs en-font">
                            BUSINESS
                        </span>
                        <span class="text-xs text-base-content/50">45 درساً</span>
                    </div>

                    <h3 class="text-xl font-bold text-base-content">
                        الإنجليزية المهنية والأعمال
                    </h3>

                    <p class="text-xs text-base-content/70 leading-relaxed">
                        النجاح في بيئة العمل العالمية: كتابة رسائل البريد المهنية، التفاوض، تقديم العروض Presentation، واجتياز المقابلات.
                    </p>

                    <ul class="text-xs space-y-2 text-base-content/80 pt-2 border-t border-base-200 dark:border-base-content/10">
                        <li class="flex items-center gap-2">
                            <span class="text-amber-500">✓</span> قوالب إيميلات احترافية
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-amber-500">✓</span> مصطلحات الشركات والتسويق
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-amber-500">✓</span> محاكاة مقابلات التوظيف Job Interviews
                        </li>
                    </ul>
                </div>
                <div class="p-6 pt-0">
                    <a href="#start" class="btn btn-outline btn-sm w-full rounded-xl hover:bg-[#0066E6] hover:border-[#0066E6] hover:text-white transition-all">
                        استكشف المسار
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Interactive Speaking Chat Simulator Preview -->
<section id="speaking" class="py-16 md:py-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Info -->
            <div class="lg:col-span-6 space-y-6">
                <span class="badge badge-primary badge-outline text-xs font-bold uppercase tracking-wider">
                    المحادثة الصوتية الذكية
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-base-content tracking-tight">
                    تدرّب على المحادثة مع مدرب ذكي لا يحكم عليك أبداً
                </h2>
                <p class="text-base text-base-content/70 leading-relaxed">
                    أكبر عائق أمام تحدث الإنجليزية هو الخوف من الوقوع في الخطأ أو التلعثم أمام الآخرين. مع مدربنا الذكي، يمكنك التحدث بكل راحة في أي وقت، والحصول على تصحيح فوري ولطيف لقواعدك ونطقك.
                </p>

                <div class="space-y-4 pt-2">
                    <div class="flex items-start gap-3.5">
                        <div class="w-8 h-8 rounded-xl bg-[#0066E6]/10 text-[#0066E6] flex items-center justify-center font-bold text-sm shrink-0 mt-0.5">
                            💬
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-base-content">مواضيع واقعية لا حصر لها</h4>
                            <p class="text-xs text-base-content/60">تحدث عن هواياتك، التخطيط لرحلة، أو تحضير مقابلة عمل في دقائق.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5">
                        <div class="w-8 h-8 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center font-bold text-sm shrink-0 mt-0.5">
                            🎯
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-base-content">تصحيح ذكي بدون إحراج</h4>
                            <p class="text-xs text-base-content/60">يشرح لك المدرب الخطأ بلباقة ويقترح الجملة الأنسب والأكثر فصاحة.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="#start" class="btn btn-primary rounded-xl text-white font-bold px-6 shadow-md shadow-[#0066E6]/25">
                        جرّب جلسة محادثة تجريبية الآن
                    </a>
                </div>
            </div>

            <!-- Right Interactive Chat Mockup (DaisyUI Chat) -->
            <div class="lg:col-span-6">
                <div class="bg-base-100 rounded-3xl p-6 sm:p-8 shadow-2xl border border-base-200 dark:border-base-content/10 space-y-4">
                    
                    <!-- Chat Header -->
                    <div class="flex items-center justify-between pb-4 border-b border-base-200 dark:border-base-content/10">
                        <div class="flex items-center gap-3">
                            <div class="avatar online">
                                <div class="w-10 rounded-full bg-[#0066E6] text-white flex items-center justify-center font-bold text-sm">
                                    AI
                                </div>
                            </div>
                            <div>
                                <div class="font-bold text-sm text-base-content">مدربك الذكي (Alex)</div>
                                <div class="text-[11px] text-emerald-500 font-medium">متصل وجاهز للمحادثة الآن</div>
                            </div>
                        </div>
                        <span class="badge badge-sm badge-ghost">محادثة حرة</span>
                    </div>

                    <!-- Chat Message Area -->
                    <div class="space-y-4 py-2 font-sans" dir="ltr">
                        
                        <!-- AI Message 1 -->
                        <div class="chat chat-start">
                            <div class="chat-image avatar">
                                <div class="w-8 rounded-full bg-[#0066E6] text-white text-xs flex items-center justify-center font-bold">A</div>
                            </div>
                            <div class="chat-header text-[11px] opacity-50 mb-1">Alex (AI Tutor)</div>
                            <div class="chat-bubble bg-base-200 dark:bg-base-300 text-base-content text-sm leading-relaxed">
                                Hello Omar! How was your weekend? Did you do anything fun?
                            </div>
                        </div>

                        <!-- User Message 1 -->
                        <div class="chat chat-end">
                            <div class="chat-image avatar">
                                <div class="w-8 rounded-full bg-emerald-500 text-white text-xs flex items-center justify-center font-bold">You</div>
                            </div>
                            <div class="chat-header text-[11px] opacity-50 mb-1">Omar</div>
                            <div class="chat-bubble bg-[#0066E6] text-white text-sm leading-relaxed">
                                It was great! I go to the beach with my family yesterday.
                            </div>
                        </div>

                        <!-- AI Feedback Card & Response -->
                        <div class="chat chat-start">
                            <div class="chat-image avatar">
                                <div class="w-8 rounded-full bg-[#0066E6] text-white text-xs flex items-center justify-center font-bold">A</div>
                            </div>
                            <div class="chat-header text-[11px] opacity-50 mb-1">Alex (AI Tutor)</div>
                            <div class="chat-bubble bg-base-200 dark:bg-base-300 text-base-content text-sm space-y-2">
                                <p>That sounds lovely! Beaches are so relaxing 🏖️</p>
                                
                                <div class="p-2.5 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-right space-y-1" dir="rtl">
                                    <div class="font-bold text-amber-600 dark:text-amber-400 flex items-center gap-1">
                                        <span>💡 ملاحظة قواعدية سريعة:</span>
                                    </div>
                                    <p class="text-base-content/80 text-[11px]">
                                        بما أن الحدث حدث أمس (Yesterday)، يُفضل استخدام صيغة الماضي البسيط: 
                                        <br>
                                        <span class="en-font font-bold text-emerald-600 dark:text-emerald-400">"I went to the beach"</span> بدلاً من <span class="en-font line-through opacity-70">"I go"</span>.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Input Mockup -->
                    <div class="pt-3 border-t border-base-200 dark:border-base-content/10">
                        <div class="relative">
                            <input 
                                type="text" 
                                placeholder="اكتب ردك بالإنجليزي أو اضغط على المايك..." 
                                class="input input-bordered w-full rounded-2xl pr-4 pl-12 text-sm focus:border-[#0066E6] focus:outline-none"
                                disabled
                                value="Thank you! What is your favorite beach in California?"
                            />
                            <button class="btn btn-circle btn-primary btn-sm absolute left-2 top-1.5 text-white" title="تسجيل صوتي">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path><path d="M19 10v2a7 7 0 0 1-14 0v-2"></path><line x1="12" y1="19" x2="12" y2="23"></line><line x1="8" y1="23" x2="16" y2="23"></line></svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- Why Choose Us / Core Features -->
<section id="features" class="py-16 md:py-24 bg-base-200/40 dark:bg-base-300/20 border-t border-base-200 dark:border-base-content/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto space-y-3 mb-14">
            <span class="badge badge-primary badge-outline text-xs font-bold uppercase tracking-wider">
                مميزات المنصة
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-base-content tracking-tight">
                صُممت لتجعل تعلم الإنجليزية متعة يومية
            </h2>
            <p class="text-sm sm:text-base text-base-content/70">
                أحدث تقنيات التعليم التفاعلي مجتمعة في تجربة مستخدم سلسة وعصرية.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Feature 1 -->
            <div class="p-7 rounded-3xl bg-base-100 border border-base-200 dark:border-base-content/10 hover:border-[#0066E6] hover:shadow-xl transition-all duration-200 space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-[#0066E6]/10 text-[#0066E6] flex items-center justify-center text-xl font-bold">
                    ⚡
                </div>
                <h3 class="text-lg font-bold text-base-content">
                    نظام التكرار المتباعد الذكي
                </h3>
                <p class="text-xs sm:text-sm text-base-content/70 leading-relaxed">
                    لا مزيد من نسيان الكلمات! يقوم النظام بإعادة طرح الكلمات الصعبة في الوقت الدقيق قبل أن تنساها لترسيخها في ذاكرتك الدائمة.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="p-7 rounded-3xl bg-base-100 border border-base-200 dark:border-base-content/10 hover:border-[#0066E6] hover:shadow-xl transition-all duration-200 space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center text-xl font-bold">
                    🎙️
                </div>
                <h3 class="text-lg font-bold text-base-content">
                    تقييم مخارج الحروف والنطق
                </h3>
                <p class="text-xs sm:text-sm text-base-content/70 leading-relaxed">
                    قارن نطقك بنطق المتحدثين الأصليين، وتعرّف بدقة على الحروف التي تحتاج لتحسين لتبدو أكثر طبيعية وطلاقة.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="p-7 rounded-3xl bg-base-100 border border-base-200 dark:border-base-content/10 hover:border-[#0066E6] hover:shadow-xl transition-all duration-200 space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-500 flex items-center justify-center text-xl font-bold">
                    🌓
                </div>
                <h3 class="text-lg font-bold text-base-content">
                    الوضع المظلم والصباحي المريح
                </h3>
                <p class="text-xs sm:text-sm text-base-content/70 leading-relaxed">
                    واجهة أنيقة مريحة للعينين في جميع أوقات اليوم، سواء كنت تدرس صباحاً أو تراجع مفرداتك قبل النوم.
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="p-7 rounded-3xl bg-base-100 border border-base-200 dark:border-base-content/10 hover:border-[#0066E6] hover:shadow-xl transition-all duration-200 space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-500 flex items-center justify-center text-xl font-bold">
                    🏆
                </div>
                <h3 class="text-lg font-bold text-base-content">
                    تحفيز يومي وسلاسل إنجاز
                </h3>
                <p class="text-xs sm:text-sm text-base-content/70 leading-relaxed">
                    اكسب نقاط خبرة (XP) وشارات إنجاز مع كل تمرين تنجزه، وشارك في التحديات الأسبوعية مع أصدقائك.
                </p>
            </div>

            <!-- Feature 5 -->
            <div class="p-7 rounded-3xl bg-base-100 border border-base-200 dark:border-base-content/10 hover:border-[#0066E6] hover:shadow-xl transition-all duration-200 space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-500 flex items-center justify-center text-xl font-bold">
                    📱
                </div>
                <h3 class="text-lg font-bold text-base-content">
                    متجاوب مع كل الأجهزة
                </h3>
                <p class="text-xs sm:text-sm text-base-content/70 leading-relaxed">
                    تابع تقدمك بسلاسة تامة من الهاتف أو الحاسوب أو الجهاز اللوحي في أي وقت ومن أي مكان.
                </p>
            </div>

            <!-- Feature 6 -->
            <div class="p-7 rounded-3xl bg-base-100 border border-base-200 dark:border-base-content/10 hover:border-[#0066E6] hover:shadow-xl transition-all duration-200 space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-500 flex items-center justify-center text-xl font-bold">
                    📜
                </div>
                <h3 class="text-lg font-bold text-base-content">
                    شهادات إتمام معتمدة
                </h3>
                <p class="text-xs sm:text-sm text-base-content/70 leading-relaxed">
                    احصل على شهادة إتمام إلكترونية موثقة بعد إنهاء كل مسار تعليمي، يمكنك إضافتها لملفك في LinkedIn.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- Student Reviews / Testimonials -->
<section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto space-y-3 mb-14">
            <span class="badge badge-primary badge-outline text-xs font-bold uppercase tracking-wider">
                آراء وقصص النجاح
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-base-content tracking-tight">
                ماذا يقول المتعلمون عن LearnEnglish؟
            </h2>
            <p class="text-sm sm:text-base text-base-content/70">
                آلاف المتعلمين العرب تمكنوا من كسر حاجز اللغة والتحدث بثقة.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Review 1 -->
            <div class="p-6 rounded-3xl bg-base-100 border border-base-200 dark:border-base-content/10 shadow-sm space-y-4">
                <div class="flex text-amber-400 text-sm">
                    ★★★★★
                </div>
                <p class="text-sm text-base-content/80 leading-relaxed">
                    "كنت أفهم الإنجليزية جيداً حين أقرأ أو أسمع، لكن لساني كان يتجمد حين يُطلب مني الرد! تدريبات المحادثة الذكية منحتني الجرأة والطلاقة بدون أي توتر."
                </p>
                <div class="flex items-center gap-3 pt-2 border-t border-base-200 dark:border-base-content/10">
                    <div class="w-10 h-10 rounded-full bg-[#0066E6] text-white flex items-center justify-center font-bold text-sm">
                        ف
                    </div>
                    <div>
                        <div class="font-bold text-sm text-base-content">فهد الشمري</div>
                        <div class="text-xs text-base-content/60">مهندس برمجيات • الرياض</div>
                    </div>
                </div>
            </div>

            <!-- Review 2 -->
            <div class="p-6 rounded-3xl bg-base-100 border border-base-200 dark:border-base-content/10 shadow-sm space-y-4">
                <div class="flex text-amber-400 text-sm">
                    ★★★★★
                </div>
                <p class="text-sm text-base-content/80 leading-relaxed">
                    "التصميم هادئ ومريح جداً، وخاصة خيار الوضع الليلي والنهاري. مسار Business English ساعدني بشكل هائل في اجتياز مقابلة عملي الأخيرة بنجاح باهر."
                </p>
                <div class="flex items-center gap-3 pt-2 border-t border-base-200 dark:border-base-content/10">
                    <div class="w-10 h-10 rounded-full bg-purple-600 text-white flex items-center justify-center font-bold text-sm">
                        س
                    </div>
                    <div>
                        <div class="font-bold text-sm text-base-content">سارة المنصوري</div>
                        <div class="text-xs text-base-content/60">أخصائية تسويق • دبي</div>
                    </div>
                </div>
            </div>

            <!-- Review 3 -->
            <div class="p-6 rounded-3xl bg-base-100 border border-base-200 dark:border-base-content/10 shadow-sm space-y-4">
                <div class="flex text-amber-400 text-sm">
                    ★★★★★
                </div>
                <p class="text-sm text-base-content/80 leading-relaxed">
                    "معمل النطق الصوتي كان نقطة التحول بالنسبة لي. كنت أنطق كلمات كثيرة بشكل خاطئ لسنوات، والآن أصبحت أنطق مثل المتحدثين الأصليين وبكل ثقة."
                </p>
                <div class="flex items-center gap-3 pt-2 border-t border-base-200 dark:border-base-content/10">
                    <div class="w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-sm">
                        أ
                    </div>
                    <div>
                        <div class="font-bold text-sm text-base-content">أحمد العتيبي</div>
                        <div class="text-xs text-base-content/60">طالب دراسات عليا • جدة</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Final CTA Card -->
<section id="start" class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-tr from-[#0066E6] to-[#004bb3] text-white p-8 sm:p-14 shadow-2xl brand-glow-lg text-center">
            
            <!-- Subtle Background Circles -->
            <div class="absolute -top-24 -right-24 w-80 h-80 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-black/10 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10 max-w-2xl mx-auto space-y-6">
                <span class="inline-block px-3.5 py-1 rounded-full bg-white/15 backdrop-blur-md text-xs font-bold tracking-wide uppercase">
                    ابدأ مجاناً اليوم 🚀
                </span>

                <h2 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
                    هل أنت جاهز لتتحدث الإنجليزية بثقة تامة؟
                </h2>

                <p class="text-base sm:text-lg text-white/85 leading-relaxed font-normal">
                    انضم الآن وابدأ أول درس تفاعلي لك في أقل من دقيقة واحدة. بدون بطاقة ائتمان، ومجاناً بالكامل.
                </p>

                <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="#register" class="btn btn-lg bg-white text-[#0066E6] hover:bg-slate-100 border-none rounded-2xl px-8 font-extrabold shadow-xl transition-transform hover:scale-105 w-full sm:w-auto">
                        إنشاء حساب مجاني
                    </a>
                    <a href="#test" class="btn btn-lg btn-outline text-white hover:bg-white/15 border-white/40 rounded-2xl px-7 font-bold w-full sm:w-auto">
                        اختبار تحديد المستوى
                    </a>
                </div>

                <div class="text-xs text-white/70 pt-2">
                    ✓ وصول فوري للمسارات الأساسية &nbsp;•&nbsp; ✓ لا يلزم بطاقة دفع &nbsp;•&nbsp; ✓ تجربة مجانية بالكامل
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    /**
     * Browser Web Speech Synthesis for Real English Pronunciation
     */
    function speakText(text, lang = 'en-US') {
        if ('speechSynthesis' in window) {
            window.speechSynthesis.cancel(); // Stop previous utterance
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = lang;
            utterance.rate = 0.9; // Slightly slower for clear learner comprehension
            utterance.pitch = 1.0;
            window.speechSynthesis.speak(utterance);
        } else {
            alert('متصفحك لا يدعم خاصية نطق الصوت المباشرة.');
        }
    }
</script>
@endpush
