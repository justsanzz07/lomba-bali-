<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Supported application locales for international tourists and domestic visitors.
     */
    public const SUPPORTED_LOCALES = ['id', 'en', 'zh', 'ja', 'ru', 'fr', 'de'];

    /**
     * Handle an incoming request and set application locale.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check if language is provided via query parameter ?lang=
        if ($request->has('lang')) {
            $lang = $request->query('lang');
            if (in_array($lang, self::SUPPORTED_LOCALES, true)) {
                session(['locale' => $lang]);
            }
        }

        // 2. Resolve locale from session, defaulting to Indonesian ('id')
        $locale = session('locale', config('app.locale', 'id'));

        if (in_array($locale, self::SUPPORTED_LOCALES, true)) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
