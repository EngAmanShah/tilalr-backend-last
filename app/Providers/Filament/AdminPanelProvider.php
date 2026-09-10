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
use Filament\Navigation\NavigationGroup;

class AdminPanelProvider extends PanelProvider
{
    /**
     * Single Source of Truth for Navigation Sections & Role Permission Tabs.
     * Edit this single array to add, remove, or modify any sidebar navigation section or permission group.
     */
    public static function getNavigationMap(): array
    {
        return [
            'dashboard' => [
                'tab_name' => 'Dashboard',
                'icon' => 'heroicon-o-home',
                'groups' => ['Dashboard', 'Reports'],
                'label' => 'Dashboard',
            ],
            'visas' => [
                'tab_name' => 'visas',
                'icon' => 'heroicon-o-document-text',
                'groups' => ['Schengen Applications', 'E-Visa Applications', 'Saudi Visas', 'Visa Countries'],
                'label' => 'visas',
            ],
            'cities' => [
                'tab_name' => 'cities',
                'icon' => 'heroicon-o-building-office-2',
                'groups' => ['Cities'],
                'label' => 'cities',
            ],
            'users' => [
                'tab_name' => 'Users',
                'icon' => 'heroicon-o-users',
                'groups' => ['Users'],
                'label' => 'Users',
            ],
            // 'payments' => [
            //     'tab_name' => 'Payments',
            //     'icon' => 'heroicon-o-currency-dollar',
            //     'groups' => ['Payments', 'Custom Payment Offers'],
            //     'label' => 'Payments',
            // ],
          
            'tourism' => [
                'tab_name' => 'Tourism',
                'icon' => 'heroicon-o-globe-americas',
                'groups' => ['Saudi Offers', 'International Destinations'],
                'label' => 'Tourism',
            ],
            'jamoula' => [
                'tab_name' => 'Jamoula',
                'icon' => 'heroicon-o-sparkles',
                'groups' => ['Jamoula Offers'],
                'label' => 'Jamoula',
            ],
            'international_services' => [
                'tab_name' => 'International Services',
                'icon' => 'heroicon-o-rocket-launch',
                'groups' => ['Services', 'Internet Package Requests', 'Private Jet Requests'],
                'label' => 'International Services',
            ],
            'bookings' => [
                'tab_name' => 'Bookings',
                'icon' => 'heroicon-o-receipt-refund',
                'groups' => ['Bookings', 'Reservations'],
                'label' => 'Bookings',
            ],
              'communication' => [
                'tab_name' => 'Communication',
                'icon' => 'heroicon-o-chat-bubble-left-right',
                'groups' => ['Contacts & Inquiries'],
                'label' => 'Communication',
            ],
            'settings' => [
                'tab_name' => 'Settings',
                'icon' => 'heroicon-o-photo',
                'groups' => ['Banners', 'Header Banners', 'Partner Logos'],
                'label' => 'Settings',
            ],
            'administration' => [
                'tab_name' => 'Administration',
                'icon' => 'heroicon-o-shield-check',
                'groups' => ['Roles', 'Permissions', 'Activity & Audit Logs', 'Activity Logs'],
                'label' => 'Administration',
            ],
            // 'content' => [
            //     'tab_name' => 'Content',
            //     'icon' => 'heroicon-o-newspaper',
            //     'groups' => ['Special Offers', 'Trips', 'Products', 'Projects'],
            //     'label' => 'Content',
            // ],
            'website' => [
                'tab_name' => 'Website',
                'icon' => 'heroicon-o-cog-6-tooth',
                'groups' => ['App Settings'],
                'label' => 'Website',
            ],
        ];
    }

    public function panel(Panel $panel): Panel
    {
        $navigationGroups = array_map(
            fn ($key, $item) => NavigationGroup::make()->label(fn () => __("admin.nav.{$key}", ['default' => $item['label']])),
            array_keys(static::getNavigationMap()),
            static::getNavigationMap()
        );

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
            ->favicon(asset('assets/icon/favicon.ico'))
            ->navigationGroups($navigationGroups)
            ->renderHook(
                PanelsRenderHook::USER_MENU_BEFORE,
                fn () => Blade::render('<livewire:language-switcher />')
            );
    }
}
