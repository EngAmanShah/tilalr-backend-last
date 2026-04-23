<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpecialOfferResource\Pages;
use App\Filament\Resources\Concerns\HasResourcePermissions;
use App\Models\Offer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SpecialOfferResource extends Resource
{
    use HasResourcePermissions;

    protected static ?string $model = Offer::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.nav.content');
    }

    public static function getModelLabel(): string
    {
        return 'Special Offer';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Special Offers';
    }

    public static function getNavigationLabel(): string
    {
        return 'Special Offers';
    }

    /**
     * Override permission key to match seeder
     */
    public static function getPermissionKey(): string
    {
        return 'special_offers';
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('is_special_offer', true);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Special Offer Image')
                ->schema([
                    Forms\Components\FileUpload::make('image')
                        ->image()
                        ->disk('public')
                        ->directory('offers')
                        ->required()
                        ->label(__('admin.form.image'))
                        ->helperText('Any image size is allowed. Frontend displays images in an 840 x 1160 layout.'),

                    // Keep required DB fields hidden and auto-filled.
                    Forms\Components\Hidden::make('title_en')->default('Special Offer'),
                    Forms\Components\Hidden::make('title_ar')->default('عرض خاص'),
                    Forms\Components\Hidden::make('is_special_offer')->default(true),
                    Forms\Components\Hidden::make('is_active')->default(true),
                ])->columns(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('image')->label(__('admin.form.image')),
            Tables\Columns\IconColumn::make('is_active')->boolean()->label(__('admin.table.active')),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->label(__('admin.table.created_at'))->sortable(),
        ])->actions([
            Tables\Actions\EditAction::make()->label(__('admin.actions.edit')),
            Tables\Actions\DeleteAction::make()->label(__('admin.actions.delete')),
        ])->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make()->label(__('admin.actions.bulk_delete')),
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
