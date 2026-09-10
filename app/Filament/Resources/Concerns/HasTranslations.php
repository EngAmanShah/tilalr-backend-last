<?php

namespace App\Filament\Resources\Concerns;

use Illuminate\Support\Facades\Lang;

trait HasTranslations
{
    /**
     * Get translated navigation group
     */
    public static function getNavigationGroup(): ?string
    {
        if (isset(static::$navigationGroupKey) && static::$navigationGroupKey) {
            return __('admin.nav.' . static::$navigationGroupKey);
        }
        if (property_exists(static::class, 'navigationGroup') && static::$navigationGroup) {
            $key = strtolower(str_replace([' ', '&', '-'], ['_', '_', '_'], static::$navigationGroup));
            if (Lang::has('admin.nav.' . $key)) {
                return __('admin.nav.' . $key);
            }
            return static::$navigationGroup;
        }
        return null;
    }

    /**
     * Get translated model label (singular)
     */
    public static function getModelLabel(): string
    {
        if (property_exists(static::class, 'label') && static::$label) {
            $key = strtolower(str_replace([' ', '&', '-'], ['_', '_', '_'], static::$label));
            if (Lang::has('admin.resources.' . $key)) {
                return __('admin.resources.' . $key);
            }
        }
        $key = static::getResourceKey();
        return Lang::has('admin.resources.' . $key) ? __('admin.resources.' . $key) : (static::$label ?? ucwords(str_replace('_', ' ', $key)));
    }

    /**
     * Get translated model label (plural)
     */
    public static function getPluralModelLabel(): string
    {
        if (property_exists(static::class, 'pluralLabel') && static::$pluralLabel) {
            $key = strtolower(str_replace([' ', '&', '-'], ['_', '_', '_'], static::$pluralLabel));
            if (Lang::has('admin.resources.' . $key)) {
                return __('admin.resources.' . $key);
            }
        }
        $resourceKey = static::getResourceKey() . 's';
        if (Lang::has('admin.resources.' . $resourceKey)) {
            return __('admin.resources.' . $resourceKey);
        }
        $resourceKeySingular = static::getResourceKey();
        if (Lang::has('admin.resources.' . $resourceKeySingular)) {
            return __('admin.resources.' . $resourceKeySingular);
        }
        return static::$pluralLabel ?? ucwords(str_replace('_', ' ', $resourceKey));
    }

    /**
     * Get translated navigation label
     */
    public static function getNavigationLabel(): string
    {
        return static::getPluralModelLabel();
    }

    /**
     * Get the resource key from model class name
     */
    protected static function getResourceKey(): string
    {
        // Convert BookingResource -> booking, ReservationResource -> reservation
        $class = class_basename(static::class);
        $resource = str_replace('Resource', '', $class);
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $resource));
    }

    /**
     * Get translated status options
     */
    protected static function getStatusOptions(): array
    {
        return [
            'pending' => __('admin.status.pending'),
            'confirmed' => __('admin.status.confirmed'),
            'cancelled' => __('admin.status.cancelled'),
            'completed' => __('admin.status.completed'),
            'processing' => __('admin.status.processing'),
            'failed' => __('admin.status.failed'),
            'paid' => __('admin.status.paid'),
            'unpaid' => __('admin.status.unpaid'),
            'active' => __('admin.status.active'),
            'inactive' => __('admin.status.inactive'),
            'approved' => __('admin.status.approved'),
            'rejected' => __('admin.status.rejected'),
            'draft' => __('admin.status.draft'),
            'published' => __('admin.status.published'),
        ];
    }

    /**
     * Get translated payment status options
     */
    protected static function getPaymentStatusOptions(): array
    {
        return [
            'pending' => __('admin.status.pending'),
            'paid' => __('admin.status.paid'),
            'failed' => __('admin.status.failed'),
        ];
    }

    /**
     * Get translated trip type options
     */
    protected static function getTripTypeOptions(): array
    {
        return [
            'activity' => __('admin.trip_types.activity'),
            'hotel' => __('admin.trip_types.hotel'),
            'flight' => __('admin.trip_types.flight'),
            'package' => __('admin.trip_types.package'),
            'school' => __('admin.trip_types.school'),
            'corporate' => __('admin.trip_types.corporate'),
            'family' => __('admin.trip_types.family'),
            'private' => __('admin.trip_types.private'),
        ];
    }

    /**
     * Format status for display
     */
    protected static function formatStatus(string $state): string
    {
        return __('admin.status.' . $state, [], app()->getLocale()) ?: ucfirst($state);
    }
}
