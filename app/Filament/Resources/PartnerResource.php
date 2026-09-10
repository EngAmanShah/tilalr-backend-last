<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;

class PartnerResource extends Resource
{
    use Concerns\HasResourcePermissions;
    use Concerns\HasTranslations;

    protected static ?string $model = Partner::class;
    protected static ?string $permissionKey = 'partners';
    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $label = 'Partner Logo';
    protected static ?string $pluralLabel = 'Partner Logos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Partner Details')
                    ->schema([
                        TextInput::make('name')
                            ->label('Partner Name')
                            ->required()
                            ->maxLength(255),

                        FileUpload::make('logo')
                            ->label('Partner Logo')
                            ->image()
                            ->directory('partners')
                            ->visibility('public')
                            ->required()
                            ->maxSize(2048)
                            ->helperText('Upload the partner logo (transparent PNG recommended)'),

                        Toggle::make('active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->square()
                    ->width(80),

                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                ToggleColumn::make('active')
                    ->label('Active')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('active'),
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
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
