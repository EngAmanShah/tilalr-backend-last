<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourismDestinationResource\Pages;
use App\Models\TourismDestination;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TourismDestinationResource extends Resource
{
    protected static ?string $model = TourismDestination::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-americas';

    protected static ?string $navigationGroup = 'Tourism';

    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return 'Tourism Destination';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Tourism Destinations';
    }

    public static function getNavigationLabel(): string
    {
        return 'Tourism Destinations';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('title_en')
                            ->required()
                            ->label('Title (English)')
                            ->maxLength(255)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('title_ar')
                            ->required()
                            ->label('Title (Arabic)')
                            ->maxLength(255)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->columnSpan(1),
                        Forms\Components\Select::make('region')
                            ->options([
                                'europe' => 'Europe',
                                'asia' => 'Asia',
                                'africa' => 'Africa',
                                'australia' => 'Australia & New Zealand',
                                'america' => 'America', // ✅ ADDED AMERICA
                            ])
                            ->required()
                            ->columnSpan(1),
                    ])->columns(2),

                Forms\Components\Section::make('Description')
                    ->schema([
                        Forms\Components\Textarea::make('description_en')
                            ->label('Description (English)')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description_ar')
                            ->label('Description (Arabic)')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Location & Duration')
                    ->schema([
                        Forms\Components\TextInput::make('location_en')
                            ->label('Location (English)')
                            ->maxLength(255)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('location_ar')
                            ->label('Location (Arabic)')
                            ->maxLength(255)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('duration_en')
                            ->label('Duration (English)')
                            ->maxLength(255)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('duration_ar')
                            ->label('Duration (Arabic)')
                            ->maxLength(255)
                            ->columnSpan(1),
                    ])->columns(2),

                Forms\Components\Section::make('Features')
                    ->schema([
                        Forms\Components\TagsInput::make('features_en')
                            ->label('Features (English)')
                            ->placeholder('Add features...')
                            ->columnSpan(1),
                        Forms\Components\TagsInput::make('features_ar')
                            ->label('Features (Arabic)')
                            ->placeholder('أضف الميزات...')
                            ->columnSpan(1),
                    ])->columns(2),

                Forms\Components\Section::make('Pricing & Rating')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->label('Price (SAR)')
                            ->prefix('SAR')
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('rating')
                            ->required()
                            ->default(4.5)
                            ->numeric()
                            ->step(0.1)
                            ->minValue(0)
                            ->maxValue(5)
                            ->label('Rating (0-5)')
                            ->columnSpan(1),
                    ])->columns(2),

                Forms\Components\Section::make('Media & Status')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1200')
                            ->imageResizeTargetHeight('675')
                            ->maxSize(5120)
                            ->directory('tourism')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->columnSpan(1)
                            ->helperText('Upload a destination image. Recommended size: 1200x675px (16:9)')
                            ->loadingIndicatorPosition('left')
                            ->panelLayout('grid')
                            ->uploadingMessage('Uploading image...'),
                        Forms\Components\Toggle::make('active')
                            ->label('Active')
                            ->default(true)
                            ->columnSpan(1),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->square()
                    ->size(50)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('title_en')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('title_ar')
                    ->label('Title (Arabic)')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('region')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'europe' => 'info',
                        'asia' => 'warning',
                        'africa' => 'success',
                        'australia' => 'primary',
                        'america' => 'danger', // ✅ ADDED AMERICA COLOR
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'europe' => 'Europe',
                        'asia' => 'Asia',
                        'africa' => 'Africa',
                        'australia' => 'Australia & NZ',
                        'america' => 'America', // ✅ ADDED AMERICA
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('location_en')
                    ->label('Location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('SAR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => '' . $state),
                Tables\Columns\TextColumn::make('duration_en')
                    ->label('Duration')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->label('Active'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('region')
                    ->options([
                        'europe' => 'Europe',
                        'asia' => 'Asia',
                        'africa' => 'Africa',
                        'australia' => 'Australia & New Zealand',
                        'america' => 'America', // ✅ ADDED AMERICA
                    ])
                    ->label('Region'),
                Tables\Filters\TernaryFilter::make('active')
                    ->label('Active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->modalWidth('lg'),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListTourismDestinations::route('/'),
            'create' => Pages\CreateTourismDestination::route('/create'),
            'edit' => Pages\EditTourismDestination::route('/{record}/edit'),
        ];
    }
}
