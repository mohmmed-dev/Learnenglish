<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ __('Learn English with real video lessons from our YouTube channel. Watch, listen, and speak with confidence.') }}">

    <title>@yield('title', __('LearnEnglish Audio | Real English Lessons from Our YouTube Channel'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        (function () {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = savedTheme ? savedTheme : (prefersDark ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
            document.documentElement.classList.toggle('dark', theme === 'dark');
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="min-h-screen flex flex-col bg-base-100 text-base-content font-sans antialiased selection:bg-[#0066E6] selection:text-white transition-colors duration-300">

    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-xl focus:bg-[#0066E6] focus:px-4 focus:py-2 focus:text-white">
        {{ __('Skip to content') }}
    </a>

    @include('layout.navber')

    <main id="main" class="flex-grow">
        @yield('content')
    </main>

    @include('layout.footer')

    <script>
        function toggleTheme() {
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            document.documentElement.classList.toggle('dark', newTheme === 'dark');

            document.querySelectorAll('.theme-controller').forEach((controller) => {
                controller.checked = newTheme === 'dark';
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            document.querySelectorAll('.theme-controller').forEach((controller) => {
                controller.checked = currentTheme === 'dark';
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
