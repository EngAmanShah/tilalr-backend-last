<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogResource\Pages;
use App\Models\ActivityLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ActivityLogResource extends Resource
{
    use Concerns\HasResourcePermissions;
    use Concerns\HasTranslations;

    protected static ?string $model = ActivityLog::class;
    protected static ?string $permissionKey = 'activity_logs';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Administration';

    protected static ?int $navigationSort = 3;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();
        return (bool) ($user && static::isSuperAdmin($user));
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.nav.administration');
    }

    public static function getModelLabel(): string
    {
        return __('admin.resources.activity_log');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.activity_logs');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.activity_logs');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label(fn () => __('admin.form.created_at') ?? 'Timestamp')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user_name')
                    ->label(fn () => __('admin.resources.user') ?? 'User')
                    ->searchable()
                    ->sortable()
                    ->description(fn (ActivityLog $record) => $record->user_email),

                Tables\Columns\TextColumn::make('user_role')
                    ->label(fn () => __('admin.resources.role') ?? 'Role')
                    ->badge()
                    ->color('secondary')
                    ->sortable(),

                Tables\Columns\TextColumn::make('action')
                    ->label(fn () => __('admin.form.action') ?? 'Action')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'info',
                        'deleted' => 'danger',
                        default => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'created' => '✨ Created',
                        'updated' => '✏️ Updated',
                        'deleted' => '🗑️ Deleted',
                        default => ucfirst($state),
                    }),

                Tables\Columns\TextColumn::make('model_type')
                    ->label('Resource / Item')
                    ->searchable()
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('description')
                    ->label(fn () => __('admin.form.description') ?? 'Details')
                    ->searchable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('action')
                    ->options([
                        'created' => 'Created',
                        'updated' => 'Updated',
                        'deleted' => 'Deleted',
                    ]),
                Tables\Filters\SelectFilter::make('model_type')
                    ->label('Resource Type')
                    ->options(fn () => ActivityLog::distinct()->pluck('model_type', 'model_type')->toArray()),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->form([
                        Forms\Components\TextInput::make('user_name')
                            ->label('User Name'),
                        Forms\Components\TextInput::make('user_email')
                            ->label('User Email'),
                        Forms\Components\TextInput::make('user_role')
                            ->label('User Role'),
                        Forms\Components\TextInput::make('action')
                            ->label('Action'),
                        Forms\Components\TextInput::make('model_type')
                            ->label('Item Type'),
                        Forms\Components\TextInput::make('model_id')
                            ->label('Item ID'),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->columnSpanFull(),
                        Forms\Components\KeyValue::make('changes.before')
                            ->label('Before Changes')
                            ->columnSpanFull()
                            ->hidden(fn ($record) => empty($record?->changes['before'])),
                        Forms\Components\KeyValue::make('changes.after')
                            ->label('After Changes')
                            ->columnSpanFull()
                            ->hidden(fn ($record) => empty($record?->changes['after'])),
                        Forms\Components\KeyValue::make('changes.deleted_record')
                            ->label('Deleted Record Data')
                            ->columnSpanFull()
                            ->hidden(fn ($record) => empty($record?->changes['deleted_record'])),
                    ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivityLogs::route('/'),
        ];
    }
}
