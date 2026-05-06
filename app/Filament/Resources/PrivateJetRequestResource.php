<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrivateJetRequestResource\Pages;
use App\Models\PrivateJetRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PrivateJetRequestResource extends Resource
{
    protected static ?string $model = PrivateJetRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    protected static ?string $navigationGroup = 'International Services';

    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return 'Private Jet Request';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Private Jet Requests';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Client Information')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->label('Name')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('email')
                        ->required()
                        ->email()
                        ->label('Email')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('mobile_number')
                        ->required()
                        ->label('Mobile Number')
                        ->maxLength(20),

                    Forms\Components\Select::make('client_type')
                        ->required()
                        ->label('Client Type')
                        ->options([
                            'Businessman' => 'Businessman',
                            'Hajj' => 'Hajj',
                            'Football Team' => 'Football Team',
                            'Government Entity' => 'Government Entity',
                            'Medical Evacuation' => 'Medical Evacuation',
                            'Other' => 'Other',
                        ])
                        ->placeholder('Select client type'),
                ])->columns(2),

            Forms\Components\Section::make('Trip Details')
                ->schema([
                    Forms\Components\TextInput::make('destination')
                        ->required()
                        ->label('Destination')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('departure_airport')
                        ->required()
                        ->label('Departure Airport')
                        ->maxLength(255),

                    Forms\Components\DatePicker::make('departure_date')
                        ->required()
                        ->label('Departure Date'),

                    Forms\Components\DatePicker::make('return_date')
                        ->label('Return Date'),

                    Forms\Components\TextInput::make('number_of_people')
                        ->required()
                        ->numeric()
                        ->minValue(1)
                        ->label('Number of People'),
                ])->columns(2),

            Forms\Components\Section::make('Additional Information')
                ->schema([
                    Forms\Components\Textarea::make('special_requirements')
                        ->label('Special Requirements')
                        ->maxLength(5000)
                        ->rows(5),
                ])->columns(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Name')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('mobile_number')
                ->label('Mobile')
                ->searchable()
                ->copyable(),

            Tables\Columns\TextColumn::make('client_type')
                ->label('Client Type')
                ->badge()
                ->color('warning')
                ->sortable(),

            Tables\Columns\TextColumn::make('destination')
                ->label('Destination')
                ->searchable(),

            Tables\Columns\TextColumn::make('departure_date')
                ->label('Departure')
                ->date('M d, Y')
                ->sortable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Submitted At')
                ->dateTime('M d, Y - H:i')
                ->sortable(),
        ])->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('client_type')
                    ->label('Client Type')
                    ->options([
                        'Businessman' => 'Businessman',
                        'Hajj' => 'Hajj',
                        'Football Team' => 'Football Team',
                        'Government Entity' => 'Government Entity',
                        'Medical Evacuation' => 'Medical Evacuation',
                        'Other' => 'Other',
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
            'index' => Pages\ListPrivateJetRequests::route('/'),
            'view' => Pages\ViewPrivateJetRequest::route('/{record}'),
            'create' => Pages\CreatePrivateJetRequest::route('/create'),
            'edit' => Pages\EditPrivateJetRequest::route('/{record}/edit'),
        ];
    }
}
