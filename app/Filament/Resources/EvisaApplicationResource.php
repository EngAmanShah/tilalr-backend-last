<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvisaApplicationResource\Pages;
use App\Models\EvisaApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class EvisaApplicationResource extends Resource
{
    use Concerns\HasResourcePermissions;
    use Concerns\HasTranslations;

    protected static ?string $model = EvisaApplication::class;
    protected static ?string $permissionKey = 'evisa_applications';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationLabel = 'E-Visa Applications';

    protected static ?string $modelLabel = 'E-Visa Application';

    protected static ?string $pluralModelLabel = 'E-Visa Applications';

    protected static ?string $navigationGroup = 'Visa Services';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('E-Visa Application Details')
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('country_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('passport_number')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('visa_type')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('passport_type')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('interview_city')
                            ->maxLength(100),
                        Forms\Components\DatePicker::make('date_of_birth'),
                        Forms\Components\DatePicker::make('passport_expiry'),
                        Forms\Components\TextInput::make('amount')
                            ->numeric()
                            ->prefix('SAR'),
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                                'completed' => 'Completed',
                            ])
                            ->default('pending')
                            ->required(),
                        Forms\Components\Textarea::make('notes')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('full_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('country_name')
                    ->label('Country')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('passport_number')
                    ->label('Passport #')
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Amount (SAR)')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'approved', 'completed' => 'success',
                        'rejected' => 'danger',
                        default => 'secondary',
                    })
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Submitted Date')
                    ->dateTime('M d, Y H:i')
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
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvisaApplications::route('/'),
            'create' => Pages\CreateEvisaApplication::route('/create'),
            'edit' => Pages\EditEvisaApplication::route('/{record}/edit'),
        ];
    }
}
