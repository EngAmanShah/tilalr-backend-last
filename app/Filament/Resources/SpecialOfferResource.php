<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpecialOfferResource\Pages;
use App\Models\SpecialOffer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class SpecialOfferResource extends Resource
{
    protected static ?string $model = SpecialOffer::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'Special Offers';

    protected static ?string $modelLabel = 'Special Offer';

    protected static ?string $pluralModelLabel = 'Special Offers';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Special Offer Image')
                ->schema([
                    Forms\Components\FileUpload::make('image')
                        ->image()
                        ->imageEditor()
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('840:1160')
                        ->directory('special-offers')
                        ->disk('public')
                        ->required()
                        ->label('Offer Image')
                        ->helperText('Upload an image for the special offer. Recommended size: 840 x 1160 pixels'),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Active')
                        ->default(true)
                        ->required(),

                    Forms\Components\TextInput::make('order_position')
                        ->label('Display Order')
                        ->numeric()
                        ->default(0)
                        ->helperText('Lower numbers appear first'),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->width(100)
                    ->height(138)
                    ->rounded(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('order_position')
                    ->label('Order')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y')
                    ->sortable(),
            ])
            ->defaultSort('order_position', 'asc')
            ->reorderable('order_position')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function ($record) {
                        if ($record->image) {
                            Storage::disk('public')->delete($record->image);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                if ($record->image) {
                                    Storage::disk('public')->delete($record->image);
                                }
                            }
                        }),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpecialOffers::route('/'),
            'create' => Pages\CreateSpecialOffer::route('/create'),
            'edit' => Pages\EditSpecialOffer::route('/{record}/edit'),
        ];
    }
}
