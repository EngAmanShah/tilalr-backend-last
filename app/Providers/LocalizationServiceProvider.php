<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\App;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;

class LocalizationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register a custom Blade directive for RTL
        Blade::directive('rtl', function () {
            return "<?php echo app()->getLocale() === 'ar' ? 'rtl' : 'ltr'; ?>";
        });

        // Register a custom Blade directive for direction attribute
        Blade::directive('direction', function () {
            return "<?php echo app()->getLocale() === 'ar' ? 'dir=\"rtl\"' : 'dir=\"ltr\"'; ?>";
        });

        // Inject RTL styles when Arabic is selected
        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_END,
            function () {
                if (App::getLocale() === 'ar') {
                    return <<<'HTML'
                    <style>
                        /* RTL Support for Filament Admin Panel */
                        :root {
                            --direction: rtl;
                        }
                        
                        html, body {
                            direction: rtl;
                            text-align: right;
                        }
                        
                        /* Main Layout Container */
                        .fi-layout {
                            flex-direction: row-reverse !important;
                        }
                        
                        .fi-main {
                            margin-right: 0 !important;
                            margin-left: auto !important;
                            padding-right: 0 !important;
                        }
                        
                        /* Sidebar positioning */
                        .fi-sidebar {
                            right: 0 !important;
                            left: auto !important;
                            border-right: none !important;
                            border-left: 1px solid var(--c-gray-200) !important;
                        }
                        
                        .fi-sidebar-close-overlay {
                            left: 0 !important;
                            right: auto !important;
                        }
                        
                        /* Navigation items */
                        .fi-sidebar-nav-groups {
                            text-align: right;
                        }
                        
                        .fi-sidebar-item-button {
                            flex-direction: row-reverse;
                            justify-content: flex-end;
                        }
                        
                        .fi-sidebar-item-icon {
                            margin-left: 0.75rem !important;
                            margin-right: 0 !important;
                        }
                        
                        /* Topbar */
                        .fi-topbar {
                            flex-direction: row-reverse;
                            justify-content: space-between;
                        }
                        
                        .fi-topbar-nav {
                            flex-direction: row-reverse;
                        }
                        
                        /* Forms */
                        .fi-fo-field-wrp {
                            text-align: right;
                        }
                        
                        .fi-input {
                            text-align: right;
                            padding-right: 0.75rem !important;
                            padding-left: 0.75rem !important;
                        }
                        
                        /* Tables */
                        .fi-ta-header-cell {
                            text-align: right;
                        }
                        
                        .fi-ta-cell {
                            text-align: right;
                        }
                        
                        /* Buttons */
                        .fi-btn {
                            flex-direction: row-reverse;
                        }
                        
                        .fi-btn-icon {
                            margin-left: 0.5rem;
                            margin-right: 0;
                        }
                        
                        /* Dropdowns */
                        .fi-dropdown-panel {
                            left: 0;
                            right: auto;
                        }
                        
                        /* Modal */
                        .fi-modal-close-btn {
                            left: 1rem;
                            right: auto;
                        }
                        
                        /* Breadcrumbs */
                        .fi-breadcrumbs {
                            flex-direction: row-reverse;
                        }
                        
                        .fi-breadcrumbs-item-separator svg {
                            transform: rotate(180deg);
                        }
                        
                        /* Stats widgets */
                        .fi-wi-stats-overview-stat {
                            text-align: right;
                        }
                        
                        /* Cards */
                        .fi-section-header {
                            text-align: right;
                        }
                        
                        /* Actions */
                        .fi-ac-btn-group {
                            flex-direction: row-reverse;
                        }
                        
                        /* Tabs */
                        .fi-tabs-nav {
                            flex-direction: row-reverse;
                        }
                        
                        /* Pagination */
                        .fi-pagination {
                            flex-direction: row-reverse;
                        }
                        
                        .fi-pagination-previous-btn svg,
                        .fi-pagination-next-btn svg {
                            transform: rotate(180deg);
                        }
                        
                        /* Checkbox & Toggle */
                        .fi-checkbox-input,
                        .fi-toggle-input {
                            margin-left: 0.5rem;
                            margin-right: 0;
                        }
                        
                        /* Select */
                        .fi-select-input {
                            text-align: right;
                            padding-right: 0.75rem;
                            padding-left: 2.5rem;
                        }
                        
                        /* Search */
                        .fi-global-search-field {
                            text-align: right;
                        }
                        
                        /* Date picker */
                        .fi-datepicker-input {
                            text-align: right;
                        }
                        
                        /* User menu */
                        .fi-user-menu {
                            flex-direction: row-reverse;
                        }
                        
                        /* Notifications */
                        .fi-notification {
                            flex-direction: row-reverse;
                        }
                        
                        /* Key-value component */
                        .fi-key-value {
                            direction: rtl;
                        }
                        
                        /* Header actions */
                        .fi-header-actions {
                            flex-direction: row-reverse;
                        }
                        
                        /* Section content */
                        .fi-section-content {
                            text-align: right;
                        }
                        
                        /* Flex utilities override */
                        .rtl .gap-x-1, .rtl .gap-x-2, .rtl .gap-x-3, .rtl .gap-x-4 {
                            flex-direction: row-reverse;
                        }
                        
                        /* Main content area adjustment - IMPORTANT FOR SPACING */
                        .fi-layout-content {
                            margin-right: 0 !important;
                            padding-right: 0 !important;
                        }
                        
                        .fi-main-ctn {
                            margin-right: 0 !important;
                            margin-left: 0 !important;
                            padding-right: 0 !important;
                            padding-left: 0 !important;
                        }
                        
                        @media (min-width: 1024px) {
                            .fi-layout {
                                display: flex;
                                flex-direction: row-reverse;
                                gap: 0 !important;
                            }
                            
                            .fi-main-ctn {
                                flex: 1;
                                padding-right: 0 !important;
                                padding-left: 0 !important;
                                margin-right: 0 !important;
                                margin-left: 0 !important;
                            }
                            
                            .fi-sidebar {
                                right: 0 !important;
                                left: auto !important;
                                border-right: none !important;
                                border-left: 1px solid var(--c-gray-200) !important;
                                flex-shrink: 0;
                            }
                        }
                        
                        /* Override any LTR spacing */
                        [class*="mr-"]:not([class*="ml-"]) {
                            margin-right: 0 !important;
                        }
                        
                        [class*="ml-"]:not([class*="mr-"]) {
                            margin-left: 0 !important;
                        }
                        
                        /* Form helper text */
                        .fi-fo-field-wrp-hint-ctn {
                            text-align: right;
                        }
                        
                        /* Badge position */
                        .fi-badge {
                            direction: rtl;
                        }
                        
                        /* Icon buttons */
                        .fi-icon-btn {
                            direction: rtl;
                        }
                    </style>
                    HTML;
                }
                
                return '';
            }
        );

        // Add dir attribute to body
        FilamentView::registerRenderHook(
            PanelsRenderHook::BODY_START,
            function () {
                if (App::getLocale() === 'ar') {
                    return <<<'HTML'
                    <script>
                        document.documentElement.setAttribute('dir', 'rtl');
                        document.documentElement.setAttribute('lang', 'ar');
                        document.body.classList.add('rtl');
                    </script>
                    HTML;
                }
                
                return <<<'HTML'
                <script>
                    document.documentElement.setAttribute('dir', 'ltr');
                    document.documentElement.setAttribute('lang', 'en');
                    document.body.classList.remove('rtl');
                </script>
                HTML;
            }
        );
    }
}
