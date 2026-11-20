<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function __invoke(Request $request, string $locale)
    {
        app()->setLocale($locale);

        $previousUrl = url()->previous();
        $parsedUrl = parse_url($previousUrl);

        $path = $parsedUrl['path'] ?? '/';
        $pathSegments = explode('/', ltrim($path, '/'));

        // Get supported locales from AppServiceProvider shared view data (or define it here)
        $supportedLocales = ['ar', 'en'];

        // Check if the first segment is an allowed locale
        if (in_array($pathSegments[0], $supportedLocales)) {
            $pathSegments[0] = $locale;
            $newPath = '/' . implode('/', $pathSegments);

            $newUrl = url($newPath);
            if (isset($parsedUrl['query'])) {
                $newUrl .= '?' . $parsedUrl['query'];
            }

            return redirect($newUrl)->withCookie(cookie('locale', $locale, 60 * 24 * 30));
        }

        return redirect()->back()->withCookie(cookie('locale', $locale, 60 * 24 * 30));
    }
}
