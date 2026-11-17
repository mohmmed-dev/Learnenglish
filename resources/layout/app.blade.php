<!DOCTYPE html>
<html lang="ar" dir="rtl" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'LearnEnglish | تعلم اللغة الإنجليزية بذكاء وعصرية')</title>

    <!-- Google Fonts: Cairo for Arabic & Plus Jakarta Sans for English -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Theme Initialization Script to Prevent FOUC -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = savedTheme ? savedTheme : (prefersDark ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Cairo', 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }
        .en-font {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen flex flex-col bg-base-100 text-base-content antialiased selection:bg-[#0066E6] selection:text-white transition-colors duration-300">

    <!-- Header / Navbar -->
    @include('layout.navber')

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layout.footer')

    <!-- Theme Toggle Helper Script -->
    <script>
        function toggleTheme() {
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            if (newTheme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }

            // Sync all theme toggle switches on the page
            document.querySelectorAll('.theme-controller').forEach(controller => {
                controller.checked = (newTheme === 'dark');
            });
        }

        // Initialize checkboxes state on load
        document.addEventListener('DOMContentLoaded', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            document.querySelectorAll('.theme-controller').forEach(controller => {
                controller.checked = (currentTheme === 'dark');
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
