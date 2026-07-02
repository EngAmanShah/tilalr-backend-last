<?php

namespace App\Filament\Resources;


use App\Filament\Resources\InternetPackageRequestResource\Pages;
use App\Models\InternetPackageRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InternetPackageRequestResource extends Resource
{
    protected static ?string $model = InternetPackageRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-wifi';

    protected static ?string $navigationGroup = 'International Services';

    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return 'Internet Package Request';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Internet Package Requests';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Request Details')
                ->schema([
                    Forms\Components\TextInput::make('country')
                        ->required()
                        ->label('Country')
                        ->placeholder('e.g. Saudi Arabia')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('mobile_number')
                        ->required()
                        ->label('Mobile Number')
                        ->placeholder('e.g. +966501234567')
                        ->maxLength(20),

                    Forms\Components\Select::make('package')
                        ->required()
                        ->label('Package')
                        ->options([
                            '1GB' => '1GB',
                            '2GB' => '2GB',
                            '3GB' => '3GB',
                            '5GB' => '5GB',
                            '10GB' => '10GB',
                            '20GB' => '20GB',
                            '50GB' => '50GB',
                            '100GB' => '100GB',
                        ])
                        ->placeholder('Select a package'),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('country')
                ->label('Country')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('mobile_number')
                ->label('Mobile Number')
                ->searchable()
                ->copyable(),

            Tables\Columns\TextColumn::make('package')
                ->label('Package')
                ->badge()
                ->color('info')
                ->sortable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Submitted At')
                ->dateTime('M d, Y - H:i')
                ->sortable(),
        ])->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('package')
                    ->label('Package')
                    ->options([
                        '1GB' => '1GB',
                        '2GB' => '2GB',
                        '3GB' => '3GB',
                        '5GB' => '5GB',
                        '10GB' => '10GB',
                        '20GB' => '20GB',
                        '50GB' => '50GB',
                        '100GB' => '100GB',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListInternetPackageRequests::route('/'),
            'view' => Pages\ViewInternetPackageRequest::route('/{record}'),
            'create' => Pages\CreateInternetPackageRequest::route('/create'),
            'edit' => Pages\EditInternetPackageRequest::route('/{record}/edit'),
        ];
    }
}
