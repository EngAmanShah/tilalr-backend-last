<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = ['en', 'ar'];
        
        // Check query param first (highest priority - used during language switch)
        $queryLocale = $request->query('locale');
        if ($queryLocale && in_array($queryLocale, $supportedLocales)) {
            $locale = $queryLocale;
            // Persist query param locale to session
            Session::put('locale', $locale);
        } else {
            // Fall back to session > cookie > config default
            $locale = Session::get('locale')
                ?? $request->cookie('locale')
                ?? config('app.locale', 'en');
        }

        // Validate locale
        if (!in_array($locale, $supportedLocales)) {
            $locale = 'en';
        }

        // Log what source determined the locale for debugging
        Log::info('SetLocale: determined locale', [
            'query' => $queryLocale ?? null,
            'session_before' => Session::get('locale'),
            'cookie' => $request->cookie('locale'),
            'chosen' => $locale,
            'accept_language' => $request->header('Accept-Language'),
            'path' => $request->path(),
        ]);

        // Set the application locale
        App::setLocale($locale);
        
        // Always ensure session has current locale
        Session::put('locale', $locale);

        return $next($request);
    }
}
