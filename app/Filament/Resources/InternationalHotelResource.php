<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InternationalHotelResource\Pages;
use App\Filament\Resources\Concerns\HasResourcePermissions;
use App\Models\InternationalHotel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InternationalHotelResource extends Resource
{
    use HasResourcePermissions;

    protected static ?string $model = InternationalHotel::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.nav.international_destinations');
    }

    public static function getModelLabel(): string
    {
        return __('admin.resources.international_hotel');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.international_hotels');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.international_hotels');
    }

    public static function getPermissionKey(): string
    {
        return 'international_hotels';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hotel Details')
                    ->schema([
                        Forms\Components\TextInput::make('name_en')->required()->label('Name (EN)'),
                        Forms\Components\TextInput::make('name_ar')->label('Name (AR)'),
                        Forms\Components\TextInput::make('name_zh')->label('Name (ZH)'),
                        Forms\Components\TextInput::make('location_en')->required()->label('Location (EN)'),
                        Forms\Components\TextInput::make('location_ar')->label('Location (AR)'),
                        Forms\Components\TextInput::make('location_zh')->label('Location (ZH)'),
                        Forms\Components\TextInput::make('stars')->numeric()->minValue(1)->maxValue(5)->label('Stars'),
                        Forms\Components\TextInput::make('price_per_night')->required()->numeric()->label('Price per Night'),
                        Forms\Components\Textarea::make('description_en')->label('Description (EN)'),
                        Forms\Components\Textarea::make('description_ar')->label('Description (AR)'),
                        Forms\Components\Textarea::make('description_zh')->label('Description (ZH)'),
                        Forms\Components\FileUpload::make('image')->image()->directory('hotels')->disk('public')->preserveFilenames()->label('Image'),
                        Forms\Components\Toggle::make('active')->label('Active')->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_en')->label('Name (EN)')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('country_en')->label('Country')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('city_en')->label('City')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('location_en')->label('Location')->searchable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('stars')->label('Stars'),
                Tables\Columns\TextColumn::make('price_per_night')->label('Price')->money('usd', true),
                Tables\Columns\IconColumn::make('active')->boolean()->label('Active'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('country_en')
                    ->label('Country')
                    ->options(fn () => InternationalHotel::distinct()->pluck('country_en', 'country_en')->filter()->toArray()),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInternationalHotels::route('/'),
            'create' => Pages\CreateInternationalHotel::route('/create'),
            'edit' => Pages\EditInternationalHotel::route('/{record}/edit'),
        ];
    }
}
