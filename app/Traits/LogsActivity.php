<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait LogsActivity
{
    public static function bootLogsActivity(): void
    {
        static::created(function (Model $model) {
            static::logModelActivity($model, 'created');
        });

        static::updated(function (Model $model) {
            static::logModelActivity($model, 'updated');
        });

        static::deleted(function (Model $model) {
            static::logModelActivity($model, 'deleted');
        });
    }

    protected static function logModelActivity(Model $model, string $action): void
    {
        $user = Auth::user();
        
        $roleName = $user?->roles()->first()?->display_name 
            ?? ($user?->is_admin ? 'Super Admin' : 'System');

        $modelName = class_basename($model);
        $recordTitle = $model->name ?? $model->name_en ?? $model->name_ar ?? $model->title ?? $model->title_en ?? $model->title_ar ?? $model->display_name ?? $model->booking_number ?? $model->slug ?? $model->id;

        $description = match ($action) {
            'created' => "{$roleName} ({$user?->name}) created {$modelName} #{$recordTitle}",
            'updated' => "{$roleName} ({$user?->name}) updated {$modelName} #{$recordTitle}",
            'deleted' => "{$roleName} ({$user?->name}) deleted {$modelName} #{$recordTitle}",
            default => "{$action} {$modelName}",
        };

        $changes = null;
        if ($action === 'updated') {
            $dirty = $model->getDirty();
            $original = array_intersect_key($model->getOriginal(), $dirty);
            // Ignore timestamps
            unset($dirty['updated_at'], $dirty['created_at']);
            unset($original['updated_at'], $original['created_at']);
            
            if (!empty($dirty)) {
                $changes = [
                    'before' => $original,
                    'after' => $dirty,
                ];
            }
        } elseif ($action === 'deleted') {
            $changes = [
                'deleted_record' => array_diff_key($model->toArray(), array_flip(['created_at', 'updated_at', 'deleted_at'])),
            ];
        }

        ActivityLog::create([
            'user_id' => $user?->id,
            'user_name' => $user?->name ?? 'System',
            'user_email' => $user?->email ?? 'system',
            'user_role' => $roleName,
            'action' => $action,
            'model_type' => $modelName,
            'model_id' => (string) $model->getKey(),
            'description' => $description,
            'changes' => $changes,
            'ip_address' => Request::ip(),
        ]);
    }
}
