<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisaCountryResource\Pages;
use App\Models\VisaCountry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VisaCountryResource extends Resource
{
    protected static ?string $model = VisaCountry::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    protected static ?string $navigationLabel = 'Visa Countries';

    protected static ?string $navigationGroup = 'International Destinations';

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Country Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                                $operation === 'create' && $set('slug', \Str::slug($state))
                            ),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('flag_emoji')
                            ->label('Flag Emoji')
                            ->maxLength(10),
                        Forms\Components\TextInput::make('flag_path')
                            ->label('Flag Image Path')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),

                Forms\Components\Section::make('Visa Information')
                    ->schema([
                        Forms\Components\TextInput::make('visa_type')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('processing_time')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('cost_per_person')
                            ->required()
                            ->numeric()
                            ->prefix('SAR'),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Repeater::make('documents')
                            ->schema([
                                Forms\Components\TextInput::make('document')->required(),
                            ])
                            ->defaultItems(5)
                            ->columnSpanFull(),
                        Forms\Components\Repeater::make('notes')
                            ->schema([
                                Forms\Components\TextInput::make('note')->required(),
                            ])
                            ->defaultItems(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('visa_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('processing_time'),
                Tables\Columns\TextColumn::make('cost_per_person')
                    ->money('SAR')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_active')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVisaCountries::route('/'),
            'create' => Pages\CreateVisaCountry::route('/create'),
            'edit' => Pages\EditVisaCountry::route('/{record}/edit'),
        ];
    }
}
