<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IslandDestinationResource\Pages;
use App\Filament\Resources\Concerns\HasResourcePermissions;
use App\Models\IslandDestination;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class IslandDestinationResource extends Resource
{
    use HasResourcePermissions;

    protected static ?string $model = IslandDestination::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.nav.local_destinations');
    }

    public static function getModelLabel(): string
    {
        return __('admin.resources.island_destination');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.island_destinations');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.island_destinations');
    }

    public static function getPermissionKey(): string
    {
        return 'island_destinations';
    }

    // Filter query to only show local islands
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'local');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('title_en')
                            ->required()
                            ->label('Title (English)'),
                        Forms\Components\TextInput::make('title_ar')
                            ->required()
                            ->label('Title (Arabic)')
                            ->extraAttributes(['dir' => 'rtl']),
                        Forms\Components\TextInput::make('title_zh')
                            ->label('Title (Chinese)'),
                        
                        Forms\Components\Hidden::make('type')
                            ->default('local'),
                    ])->columns(2),

                Forms\Components\Section::make('Description & Location')
                    ->schema([
                        Forms\Components\Textarea::make('description_en')
                            ->label('Description (English)')
                            ->rows(3),
                        Forms\Components\Textarea::make('description_ar')
                            ->label('Description (Arabic)')
                            ->rows(3)
                            ->extraAttributes(['dir' => 'rtl']),
                        Forms\Components\Textarea::make('description_zh')
                            ->label('Description (Chinese)')
                            ->rows(3),
                        Forms\Components\TextInput::make('location_en')
                            ->label('Location (English)'),
                        Forms\Components\TextInput::make('location_ar')
                            ->label('Location (Arabic)')
                            ->extraAttributes(['dir' => 'rtl']),
                        Forms\Components\TextInput::make('location_zh')
                            ->label('Location (Chinese)'),
                    ])->columns(2),

                Forms\Components\Section::make('Duration & Group Size')
                    ->schema([
                        Forms\Components\TextInput::make('duration_en')
                            ->label('Duration (English)'),
                        Forms\Components\TextInput::make('duration_ar')
                            ->label('Duration (Arabic)')
                            ->extraAttributes(['dir' => 'rtl']),
                        Forms\Components\TextInput::make('duration_zh')
                            ->label('Duration (Chinese)'),
                        Forms\Components\TextInput::make('groupSize_en')
                            ->label('Group Size (English)'),
                        Forms\Components\TextInput::make('groupSize_ar')
                            ->label('Group Size (Arabic)')
                            ->extraAttributes(['dir' => 'rtl']),
                        Forms\Components\TextInput::make('groupSize_zh')
                            ->label('Group Size (Chinese)'),
                    ])->columns(2),

                Forms\Components\Section::make('Features')
                    ->schema([
                        Forms\Components\TagsInput::make('features_en')
                            ->label('Features (English)')
                            ->placeholder('Enter features and press Enter'),
                        Forms\Components\TagsInput::make('features_ar')
                            ->label('Features (Arabic)')
                            ->placeholder('أدخل الميزات واضغط Enter')
                            ->extraAttributes(['dir' => 'rtl']),
                        Forms\Components\TagsInput::make('features_zh')
                            ->label('Features (Chinese)')
                            ->placeholder('Enter features and press Enter'),
                    ])->columns(3),

                Forms\Components\Section::make('Highlights')
                    ->schema([
                        Forms\Components\TagsInput::make('highlights_en')
                            ->label('Highlights (English)')
                            ->placeholder('Enter highlights and press Enter'),
                        Forms\Components\TagsInput::make('highlights_ar')
                            ->label('Highlights (Arabic)')
                            ->placeholder('أدخل أبرز النقاط واضغط Enter')
                            ->extraAttributes(['dir' => 'rtl']),
                        Forms\Components\TagsInput::make('highlights_zh')
                            ->label('Highlights (Chinese)')
                            ->placeholder('Enter highlights and press Enter'),
                    ])->columns(3),

                Forms\Components\Section::make("What's Included")
                    ->schema([
                        Forms\Components\TagsInput::make('includes_en')
                            ->label('Includes (English)')
                            ->placeholder('Enter what is included and press Enter'),
                        Forms\Components\TagsInput::make('includes_ar')
                            ->label('Includes (Arabic)')
                            ->placeholder('أدخل ما يشمله البرنامج واضغط Enter')
                            ->extraAttributes(['dir' => 'rtl']),
                        Forms\Components\TagsInput::make('includes_zh')
                            ->label('Includes (Chinese)')
                            ->placeholder('Enter what is included and press Enter'),
                    ])->columns(3),

                Forms\Components\Section::make('Itinerary / Schedule')
                    ->schema([
                        Forms\Components\Textarea::make('itinerary_en')
                            ->label('Itinerary (English)')
                            ->placeholder('Enter the full trip schedule/itinerary...')
                            ->rows(10),
                        Forms\Components\Textarea::make('itinerary_ar')
                            ->label('Itinerary (Arabic)')
                            ->placeholder('أدخل جدول الرحلة الكامل...')
                            ->rows(10)
                            ->extraAttributes(['dir' => 'rtl']),
                        Forms\Components\Textarea::make('itinerary_zh')
                            ->label('Itinerary (Chinese)')
                            ->placeholder('Enter the full trip schedule/itinerary...')
                            ->rows(10),
                    ])->columns(3),

                Forms\Components\Section::make('Pricing & Rating')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->label('Price (USD)'),
                        Forms\Components\TextInput::make('rating')
                            ->required()
                            ->default(4.5)
                            ->numeric()
                            ->step(0.1)
                            ->minValue(0)
                            ->maxValue(5)
                            ->label('Rating (0-5)'),
                    ])->columns(2),

                Forms\Components\Section::make('Media & Status')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('islands')
                            ->label('Island Image'),
                        Forms\Components\Toggle::make('active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'local' => 'success',
                        'international' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'local' => 'Local',
                        'international' => 'International',
                        default => $state,
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title_en')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location_en')
                    ->label('Location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('usd', true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->label('Active'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'local' => 'Local',
                        'international' => 'International',
                    ])
                    ->label('Destination Type'),
                Tables\Filters\TernaryFilter::make('active')
                    ->label('Active'),
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
            'index' => Pages\ListIslandDestinations::route('/'),
            'create' => Pages\CreateIslandDestination::route('/create'),
            'edit' => Pages\EditIslandDestination::route('/{record}/edit'),
        ];
    }
}
