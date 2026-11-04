<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
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
            if (in_array($lang, ['id', 'en'])) {
                session(['locale' => $lang]);
            }
        }

        // 2. Resolve locale from session, defaulting to Indonesian ('id')
        $locale = session('locale', config('app.locale', 'id'));

        if (in_array($locale, ['id', 'en'])) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
