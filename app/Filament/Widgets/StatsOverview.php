<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Trip;
use App\Models\Offer;
use App\Models\IslandDestination;
use App\Models\InternationalDestination;
use App\Models\Reservation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(__('admin.stats.total_users'), User::count())
                ->description(__('admin.stats.registered_users'))
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->chart([3, 4, 5, 5, 6, 6, 6]),

            Stat::make(__('admin.stats.trips'), Trip::count())
                ->description(__('admin.stats.active_trips'))
                ->descriptionIcon('heroicon-m-map')
                ->color('info')
                ->chart([2, 3, 4, 5, 5, 6, 6]),

            Stat::make(__('admin.stats.offers'), Offer::count())
                ->description(__('admin.stats.special_offers'))
                ->descriptionIcon('heroicon-m-gift')
                ->color('warning')
                ->chart([1, 2, 2, 3, 3, 3, 3]),

            Stat::make(__('admin.stats.island_destinations'), IslandDestination::count())
                ->description(__('admin.stats.local_island_destinations'))
                ->descriptionIcon('heroicon-m-sun')
                ->color('primary')
                ->chart([2, 3, 4, 5, 5, 6, 6]),

            Stat::make(__('admin.stats.international_destinations'), InternationalDestination::count())
                ->description(__('admin.stats.international_travel_packages'))
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('danger')
                ->chart([2, 3, 4, 5, 5, 6, 6]),

            Stat::make(__('admin.stats.reservations'), Reservation::count())
                ->description(__('admin.stats.total_bookings'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color('gray')
                ->chart([0, 0, 0, 0, 0, 0, 0]),
        ];
    }
}
