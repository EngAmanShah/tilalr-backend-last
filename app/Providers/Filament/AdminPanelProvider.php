<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Blade;
use App\Livewire\LanguageSwitcher;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            // Re-enable widgets one-by-one to diagnose slow widget
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                \App\Filament\Widgets\StatsOverview::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                \App\Http\Middleware\SetLocale::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                \App\Http\Middleware\AdminAccessMiddleware::class,
            ])
            ->maxContentWidth('full')
            ->brandName(fn () => __('admin.panel_name'))
            ->favicon(asset('favicon.ico'))
            ->navigationGroups([
                \Filament\Navigation\NavigationGroup::make()
                    ->label(fn () => __('admin.nav.administration')),
                \Filament\Navigation\NavigationGroup::make()
                    ->label(fn () => __('admin.nav.users')),
                \Filament\Navigation\NavigationGroup::make()
                    ->label(fn () => __('admin.nav.content')),
                \Filament\Navigation\NavigationGroup::make()
                    ->label(fn () => __('admin.nav.local_destinations')),
                \Filament\Navigation\NavigationGroup::make()
                    ->label(fn () => __('admin.nav.international_destinations')),
                \Filament\Navigation\NavigationGroup::make()
                    ->label(fn () => __('admin.nav.reservations_bookings')),
                \Filament\Navigation\NavigationGroup::make()
                    ->label(fn () => __('admin.nav.payments')),
                \Filament\Navigation\NavigationGroup::make()
                    ->label(fn () => __('admin.nav.communication')),
                \Filament\Navigation\NavigationGroup::make()
                    ->label(fn () => __('admin.nav.settings')),
                \Filament\Navigation\NavigationGroup::make()
                    ->label(fn () => __('admin.nav.website')),
            ])
            ->renderHook(
                PanelsRenderHook::USER_MENU_BEFORE,
                fn () => Blade::render('<livewire:language-switcher />')
            );
    }
}
