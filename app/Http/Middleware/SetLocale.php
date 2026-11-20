<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supportedUrlLocales = ['en', 'ar'];

        // 1. Determine the locale (Route -> Cookie -> Browser -> Default)
        $locale = $request->route('locale');

        if (!$locale) {
            $locale = $request->cookie('locale');
            if (!$locale) {
                $locale = $request->getPreferredLanguage($supportedUrlLocales);
            }
        }

        // Validate that the locale is supported
        if (!$locale || !in_array($locale, $supportedUrlLocales)) {
            $locale = config('app.locale', 'en');
        }

        $appLocale = $locale;

        // // Handle special app locale mappings
        // $mappings = [
        //     'zh' => 'zh_CN',
        //     'pt' => 'pt_BR',
        //     'fi' => 'fil'
        // ];

        // if (isset($mappings[$locale])) {
        //     $appLocale = $mappings[$locale];
        // }

        // 3. ضبط لغة التطبيق
        App::setLocale($appLocale);

        // 4. جعل الروابط تستخدم هذه اللغة تلقائياً
        URL::defaults(['locale' => $locale]);

        $response = $next($request);

        // 5. Only attach cookie if it's new or changed to reduce header overhead
        if ($request->cookie('locale') !== $locale) {
            $response->withCookie(cookie()->forever('locale', $locale));
        }

        return $response;
    }
}
