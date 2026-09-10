<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Models\City;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class CityResource extends Resource
{
    use Concerns\HasResourcePermissions;

    protected static ?string $model = City::class;
    protected static ?string $permissionKey = 'cities';

    protected static ?string $navigationIcon = 'heroicon-o-map';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.nav.cities');
    }

    public static function getModelLabel(): string
    {
        return __('admin.resources.city');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.cities');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.cities');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('City Translations')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('English')
                        ->schema([
                            TextInput::make('name.en')
                                ->label('Name (English)')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('best_time.en')
                                ->label('Best Time to Visit (English)')
                                ->maxLength(255),
                            Textarea::make('description.en')
                                ->label('Description (English)')
                                ->rows(3),
                            Forms\Components\TagsInput::make('activities.en')
                                ->label('Recommended Activities (English)')
                                ->placeholder('Add activity...'),
                            Forms\Components\Repeater::make('landmarks.en')
                                ->label('Landmarks (English)')
                                ->schema([
                                    TextInput::make('name')->required(),
                                    Textarea::make('description')->rows(2),
                                    FileUpload::make('image')->disk('public')->directory('cities/landmarks')->image(),
                                ])
                                ->columns(2)
                                ->createItemButtonLabel('Add Landmark'),
                        ]),
                    Forms\Components\Tabs\Tab::make('العربية')
                        ->schema([
                            TextInput::make('name.ar')
                                ->label('الاسم (العربية)')
                                ->required()
                                ->maxLength(255)
                                ->extraAttributes(['dir' => 'rtl']),
                            TextInput::make('best_time.ar')
                                ->label('أفضل وقت للزيارة (العربية)')
                                ->maxLength(255)
                                ->extraAttributes(['dir' => 'rtl']),
                            Textarea::make('description.ar')
                                ->label('الوصف (العربية)')
                                ->rows(3)
                                ->extraAttributes(['dir' => 'rtl']),
                            Forms\Components\TagsInput::make('activities.ar')
                                ->label('الأنشطة الموصى بها (العربية)')
                                ->placeholder('إضافة نشاط...'),
                            Forms\Components\Repeater::make('landmarks.ar')
                                ->label('المعالم (العربية)')
                                ->schema([
                                    TextInput::make('name')
                                        ->required()
                                        ->extraAttributes(['dir' => 'rtl']),
                                    Textarea::make('description')
                                        ->rows(2)
                                        ->extraAttributes(['dir' => 'rtl']),
                                    FileUpload::make('image')->disk('public')->directory('cities/landmarks')->image(),
                                ])
                                ->columns(2)
                                ->createItemButtonLabel('إضافة معلم'),
                        ]),
                ])
                ->columnSpanFull(),

            Section::make('General Settings & Media')
                ->schema([
                    TextInput::make('slug')
                        ->maxLength(255)
                        ->required()
                        ->unique(table: 'cities', ignorable: fn ($record) => $record),
                    TextInput::make('country')->maxLength(255)->default('Saudi Arabia'),
                    TextInput::make('order')->integer()->default(0),
                    Toggle::make('is_active')->default(true),
                    FileUpload::make('image')->disk('public')->directory('cities')->image()->columnSpanFull(),
                ])->columns(2),

            Section::make('Assigned Offers')
                ->schema([
                    Forms\Components\Select::make('tourismOffers')
                        ->options(\App\Models\TourismOffer::query()->where('active', true)->pluck('title_en', 'id'))
                        ->multiple()
                        ->preload()
                        ->label('Assigned Tourism Offers')
                        ->dehydrated(false)
                        ->afterStateHydrated(function (Forms\Components\Select $component, ?City $record) {
                            if ($record) {
                                $component->state($record->tourismOffers()->pluck('id')->toArray());
                            }
                        })
                        ->saveRelationshipsUsing(function (City $record, $state) {
                            // Remove assignment from offers currently assigned to this city
                            \App\Models\TourismOffer::where('city', $record->slug)->update(['city' => null]);
                            // Assign the selected offers to this city
                            if (!empty($state)) {
                                \App\Models\TourismOffer::whereIn('id', $state)->update(['city' => $record->slug]);
                            }
                        })
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Name')->searchable()->sortable(),
                TextColumn::make('country')->sortable(),
                IconColumn::make('is_active')->label('Active')->boolean(),
                TextColumn::make('created_at')->dateTime('M d, Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }
}
