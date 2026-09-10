<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeaderBannerResource\Pages;
use App\Models\HeaderBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;

class HeaderBannerResource extends Resource
{
    use Concerns\HasResourcePermissions;
    use Concerns\HasTranslations;

    protected static ?string $model = HeaderBanner::class;
    protected static ?string $permissionKey = 'header_banners';
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $label = 'Header Banner';
    protected static ?string $pluralLabel = 'Header Banners';

    public static function canCreate(): bool
    {
        return true;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Header Banner Page Assignment & Link')
                    ->schema([
                        Select::make('page')
                            ->label('Assigned Page')
                            ->options([
                                'home' => 'Home Page Header',
                                'jamoula' => 'Jamoula Offers Header (/jamoulaoffers)',
                                'offers' => 'Tourism Offers Header (/tousimoffers)',
                                'destinations' => 'Destinations Header (/destinations)',
                                'private-jet' => 'Private Jet Header (/international/private-jet)',
                                'internet-packages' => 'Internet Packages Header (/international/internet-packages)',
                                'visa' => 'Visas Header (/visa)',
                                'saudi-visa' => 'Saudi Visa Header (/saudi-visa)',
                                'evisa' => 'E-Visa Header (/E-visa)',
                                'about-us' => 'About Us Header (/about-us)',
                                'about-saudi' => 'About Saudi Header (/about-saudi)',
                                'contact-us' => 'Contact Us Header (/contact-us)',
                                'faq' => 'FAQ Header (/faq)',
                                'transportation' => 'Transportation Header (/transportation)',
                                'products' => 'Trips & Products Header (/products)',
                                'travel-basics' => 'Travel Basics Header (/Travel-Basics)',
                                'islands' => 'Islands Header (/islands)',
                                'terms' => 'Terms & Conditions Header (/terms)',
                                'privacy' => 'Privacy Policy Header (/privacy)',
                                'cancellation-policy' => 'Cancellation Policy Header (/cancellation-policy)',
                                'refund-policy' => 'Refund Policy Header (/refund-policy)',
                            ])
                            ->nullable()
                            ->searchable()
                            ->placeholder('Select assigned page or type custom page identifier'),

                        TextInput::make('url')
                            ->label('Redirect URL')
                            ->nullable()
                            ->maxLength(255)
                            ->placeholder('/tourism-offers or https://...'),

                        Toggle::make('active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(3),

                Section::make('Header Banner Image')
                    ->description('Upload single banner image optimized for responsive display across PC, Tablet, and Mobile devices.')
                    ->schema([
                        FileUpload::make('background_image')
                            ->label('Banner Image')
                            ->image()
                            ->directory('header-banners')
                            ->visibility('public')
                            ->nullable()
                            ->maxSize(5120)
                            ->helperText('Recommended aspect ratio: 16:5 (e.g. 1920x600px) - automatically responsive for all screen sizes.'),
                    ]),

                Section::make('Localization (English)')
                    ->schema([
                        TextInput::make('sentence_en')
                            ->label('Header Banner Text (English)')
                            ->nullable()
                            ->maxLength(255),

                        TextInput::make('button_text_en')
                            ->label('Button Text (English)')
                            ->nullable()
                            ->maxLength(100),
                    ])->columns(2),

                Section::make('Localization (Arabic)')
                    ->schema([
                        TextInput::make('sentence_ar')
                            ->label('Header Banner Text (Arabic)')
                            ->nullable()
                            ->maxLength(255),

                        TextInput::make('button_text_ar')
                            ->label('Button Text (Arabic)')
                            ->nullable()
                            ->maxLength(100),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('background_image')
                    ->label('Banner Image')
                    ->square()
                    ->width(60),

                TextColumn::make('page')
                    ->label('Page')
                    ->badge()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('sentence_en')
                    ->label('Text (EN)')
                    ->searchable()
                    ->limit(30),

                TextColumn::make('sentence_ar')
                    ->label('Text (AR)')
                    ->searchable()
                    ->limit(30),

                ToggleColumn::make('active')
                    ->label('Active'),
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
            'index' => Pages\ListHeaderBanners::route('/'),
            'create' => Pages\CreateHeaderBanner::route('/create'),
            'edit' => Pages\EditHeaderBanner::route('/{record}/edit'),
        ];
    }
}
