<?php
namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    
    protected static ?int $navigationSort = 2;

    // Display booking ID in admin UI
    protected static ?string $recordTitleAttribute = 'id';
    public static function getNavigationGroup(): ?string
    {
        return __('admin.nav.reservations_bookings');
    }

    public static function getModelLabel(): string
    {
        return __('admin.resources.booking');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.bookings');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.bookings');
    }

    // Executive Manager, Consultant, and Super Admin can access
    public static function canAccess(): bool
    {
        $user = auth()->user();
        return $user && ($user->hasRole('executive_manager') || $user->hasRole('consultant') || $user->hasRole('super_admin'));
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('admin.form.customer_information'))
                    ->schema([
                        Forms\Components\TextInput::make('user_id')
                            ->label(__('admin.form.user_id'))
                            ->numeric()
                            ->default(null)
                            ->helperText(__('admin.form.guest_bookings_helper')),
                        Forms\Components\TextInput::make('details.name')
                            ->label(__('admin.form.customer_name'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('details.email')
                            ->label(__('admin.form.customer_email'))
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('details.phone')
                            ->label(__('admin.form.customer_phone'))
                            ->tel()
                            ->maxLength(20),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('admin.form.booking_details'))
                    ->schema([
                        Forms\Components\TextInput::make('service_id')
                            ->label(__('admin.form.service_trip_id'))
                            ->numeric()
                            ->default(null),
                        Forms\Components\TextInput::make('details.trip_title')
                            ->label(__('admin.form.trip_title'))
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('date')
                            ->label(__('admin.form.booking_date')),
                        Forms\Components\TextInput::make('guests')
                            ->label(__('admin.form.number_of_guests'))
                            ->required()
                            ->numeric()
                            ->default(1)
                            ->minValue(1),
                        Forms\Components\TextInput::make('details.amount')
                            ->label(__('admin.form.amount') . ' (' . __('admin.currency.sar') . ')')
                            ->numeric()
                            ->prefix(__('admin.currency.sar')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('admin.form.status'))
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label(__('admin.form.status'))
                            ->options([
                                'pending' => __('admin.status.pending'),
                                'confirmed' => __('admin.status.confirmed'),
                                'cancelled' => __('admin.status.cancelled'),
                            ])
                            ->required()
                            ->native(false)
                            ->default('pending'),
                        Forms\Components\Select::make('payment_status')
                            ->label(__('admin.form.payment_status'))
                            ->options([
                                'pending' => __('admin.status.pending'),
                                'paid' => __('admin.status.paid'),
                                'failed' => __('admin.status.failed'),
                            ])
                            ->required()
                            ->native(false)
                            ->default('pending'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('admin.form.additional_details'))
                    ->schema([
                        Forms\Components\KeyValue::make('details')
                            ->label(__('admin.form.all_details'))
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('admin.form.id'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('details.name')
                    ->label(__('admin.table.customer'))
                    ->searchable('details')
                    ->sortable(),
                Tables\Columns\TextColumn::make('details.email')
                    ->label(__('admin.table.email'))
                    ->searchable('details')
                    ->copyable()
                    ->icon('heroicon-m-envelope')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('details.trip_title')
                    ->label(__('admin.table.trip'))
                    ->limit(30)
                    ->searchable('details'),
                Tables\Columns\TextColumn::make('date')
                    ->label(__('admin.table.date'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('guests')
                    ->label(__('admin.table.guests'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('details.amount')
                    ->label(__('admin.table.amount'))
                    ->formatStateUsing(fn ($state) => $state ? number_format($state, 2) . ' ' . __('admin.currency.sar') : '-')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin.table.status'))
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => __('admin.status.' . $state))
                    ->color(fn (string $state): string => match($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('payment_status')
                    ->label(__('admin.table.payment'))
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => __('admin.status.' . $state))
                    ->color(fn (string $state): string => match($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.table.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.table.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('admin.form.status'))
                    ->options([
                        'pending' => __('admin.status.pending'),
                        'confirmed' => __('admin.status.confirmed'),
                        'cancelled' => __('admin.status.cancelled'),
                    ]),
                Tables\Filters\SelectFilter::make('payment_status')
                    ->label(__('admin.form.payment_status'))
                    ->options([
                        'pending' => __('admin.status.pending'),
                        'paid' => __('admin.status.paid'),
                        'failed' => __('admin.status.failed'),
                    ]),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label(__('admin.form.start_date')),
                        Forms\Components\DatePicker::make('until')
                            ->label(__('admin.form.end_date')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('confirmBooking')
                    ->label(__('admin.actions.confirm'))
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Booking $record) {
                        $record->update(['status' => 'confirmed']);
                        Notification::make()
                            ->title(__('admin.messages.updated_successfully', ['resource' => __('admin.resources.booking')]))
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Booking $record) => $record->status === 'pending'),
                Tables\Actions\Action::make('markPaid')
                    ->label(__('admin.status.paid'))
                    ->icon('heroicon-o-currency-dollar')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Booking $record) {
                        $record->update(['payment_status' => 'paid']);
                        Notification::make()
                            ->title(__('admin.messages.updated_successfully', ['resource' => __('admin.form.payment_status')]))
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Booking $record) => $record->payment_status !== 'paid'),
                Tables\Actions\ViewAction::make()
                    ->label(__('admin.actions.view')),
                Tables\Actions\EditAction::make()
                    ->label(__('admin.actions.edit')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('confirmAll')
                        ->label(__('admin.actions.confirm'))
                        ->icon('heroicon-o-check-circle')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            $records->each(fn ($record) => $record->update(['status' => 'confirmed']));
                            Notification::make()
                                ->title(__('admin.messages.updated_successfully', ['resource' => __('admin.resources.bookings')]))
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\DeleteBulkAction::make()
                        ->label(__('admin.actions.delete')),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
