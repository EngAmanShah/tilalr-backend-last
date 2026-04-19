<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class LanguageSwitcher extends Component
{
    public string $currentLocale;
    
    public function mount()
    {
        $this->currentLocale = App::getLocale();
    }
    
    public function switchLocale(string $locale)
    {
        $supportedLocales = ['en', 'ar'];
        
        if (in_array($locale, $supportedLocales)) {
            // Store in session
            Session::put('locale', $locale);
            Session::save();
            
            // Also set a cookie for persistence
            Cookie::queue('locale', $locale, 60 * 24 * 365); // 1 year
            
            // Log the switch attempt
            Log::info('LanguageSwitcher: switching locale', [
                'requested' => $locale,
                'session_before' => Session::get('locale'),
            ]);
            
            App::setLocale($locale);
            $this->currentLocale = $locale;
            
            // Get current URL and add/update locale query param
            $currentUrl = request()->header('Referer', url()->current());
            $parsedUrl = parse_url($currentUrl);
            $query = [];
            
            if (isset($parsedUrl['query'])) {
                parse_str($parsedUrl['query'], $query);
            }
            
            $query['locale'] = $locale;
            $newQuery = http_build_query($query);
            
            $baseUrl = ($parsedUrl['scheme'] ?? 'http') . '://' . ($parsedUrl['host'] ?? 'localhost');
            if (isset($parsedUrl['port'])) {
                $baseUrl .= ':' . $parsedUrl['port'];
            }
            $baseUrl .= ($parsedUrl['path'] ?? '/');
            
            $redirectUrl = $baseUrl . '?' . $newQuery;
            
            return redirect($redirectUrl);
        }
    }
    
    public function render()
    {
        return view('livewire.language-switcher');
    }
}
