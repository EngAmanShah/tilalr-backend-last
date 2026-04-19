<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InternationalDestinationResource\Pages;
use App\Filament\Resources\Concerns\HasResourcePermissions;
use App\Models\InternationalDestination;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InternationalDestinationResource extends Resource
{
    use HasResourcePermissions;

    protected static ?string $model = InternationalDestination::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.nav.international_destinations');
    }

    public static function getModelLabel(): string
    {
        return __('admin.resources.international_destination');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.international_destinations');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.international_destinations');
    }

    public static function getPermissionKey(): string
    {
        return 'international_destinations';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Destination Details')
                    ->schema([
                        Forms\Components\TextInput::make('name_en')->required()->label('Name (EN)'),
                        Forms\Components\TextInput::make('name_ar')->label('Name (AR)'),
                        Forms\Components\TextInput::make('name_zh')->label('Name (ZH)'),
                        Forms\Components\TextInput::make('country_en')->required()->label('Country (EN)'),
                        Forms\Components\TextInput::make('country_ar')->label('Country (AR)'),
                        Forms\Components\TextInput::make('country_zh')->label('Country (ZH)'),
                        Forms\Components\Textarea::make('description_en')->label('Description (EN)'),
                        Forms\Components\Textarea::make('description_ar')->label('Description (AR)'),
                        Forms\Components\Textarea::make('description_zh')->label('Description (ZH)'),
                        Forms\Components\FileUpload::make('image')->image()->directory('international')->disk('public')->preserveFilenames()->label('Image'),
                        Forms\Components\TextInput::make('price')->numeric()->prefix('SAR')->label('Price'),
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
                Tables\Columns\TextColumn::make('price')->label('Price')->money('SAR')->sortable(),
                Tables\Columns\IconColumn::make('active')->boolean()->label('Active'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('country_en')
                    ->label('Country')
                    ->options(fn () => InternationalDestination::distinct()->pluck('country_en', 'country_en')->filter()->toArray()),
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
            'index' => Pages\ListInternationalDestinations::route('/'),
            'create' => Pages\CreateInternationalDestination::route('/create'),
            'edit' => Pages\EditInternationalDestination::route('/{record}/edit'),
        ];
    }
}
