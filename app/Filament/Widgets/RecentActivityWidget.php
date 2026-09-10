<?php

namespace App\Filament\Widgets;

use App\Models\ActivityLog;
use Filament\Widgets\Widget;

class RecentActivityWidget extends Widget
{
    protected static string $view = 'filament.widgets.recent-activity-widget';

    protected static ?int $sort = 10;

    public static function canView(): bool
    {
        $user = auth()->user();
        return (bool) ($user && ($user->hasRole('super_admin') || $user->hasRole('Super Admin')));
    }

    public function getRecentActivities()
    {
        return ActivityLog::with('user')
            ->latest()
            ->take(8)
            ->get();
    }
}
