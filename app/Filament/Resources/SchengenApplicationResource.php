<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchengenApplicationResource\Pages;
use App\Models\SchengenApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;


class SchengenApplicationResource extends Resource
{
    protected static ?string $model = SchengenApplication::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Schengen Visa';

    protected static ?string $modelLabel = 'Schengen Application';

    protected static ?string $pluralModelLabel = 'Schengen Applications';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Applicant Information')
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->required()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nationality')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('passport_number')
                            ->label('Passport Number')
                            ->maxLength(50),
                        Forms\Components\Select::make('applicant_type')
                            ->options([
                                'saudi' => 'Saudi',
                                'resident' => 'Resident',
                            ])
                            ->required(),
                        Forms\Components\DatePicker::make('travel_date'),
                        Forms\Components\Textarea::make('notes')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Status Management')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                                'completed' => 'Completed',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Admin Notes')
                            ->maxLength(65535),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('full_name')
                    ->label('Full Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('applicant_type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === 'saudi' ? '🇸🇦 Saudi' : '🏠 Resident')
                    ->color(fn (string $state): string => $state === 'saudi' ? 'success' : 'info'),
                TextColumn::make('nationality')
                    ->label('Nationality')
                    ->searchable(),
                TextColumn::make('travel_date')
                    ->label('Travel Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'completed' => 'success',
                        default => 'secondary',
                    }),
                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'completed' => 'Completed',
                    ]),
                Tables\Filters\SelectFilter::make('applicant_type')
                    ->options([
                        'saudi' => 'Saudi',
                        'resident' => 'Resident',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchengenApplications::route('/'),
            'create' => Pages\CreateSchengenApplication::route('/create'),
            'edit' => Pages\EditSchengenApplication::route('/{record}/edit'),
        ];
    }
}
