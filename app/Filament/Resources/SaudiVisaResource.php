<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaudiVisaResource\Pages;
use App\Models\VisaApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Filters\SelectFilter;

class SaudiVisaResource extends Resource
{
    protected static ?string $model = VisaApplication::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Saudi Visa Applications';
    protected static ?string $modelLabel = 'Saudi Visa Application';
    protected static ?string $pluralModelLabel = 'Saudi Visa Applications';
    protected static ?string $navigationGroup = 'Visa Services';
    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('application_type', 'saudi_visa');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
                    ->schema([
                        TextInput::make('full_name')
                            ->required()
                            ->maxLength(255)
                            ->label('Full Name'),
                        TextInput::make('phone')
                            ->required()
                            ->tel()
                            ->maxLength(20)
                            ->label('Phone Number'),
                        TextInput::make('email')
                            ->required()
                            ->email()
                            ->maxLength(255)
                            ->label('Email Address'),
                        TextInput::make('nationality')
                            ->required()
                            ->maxLength(100)
                            ->label('Nationality'),
                        TextInput::make('passport_number')
                            ->required()
                            ->maxLength(50)
                            ->label('Passport Number'),
                    ])->columns(2),

                Forms\Components\Section::make('Visa Details')
                    ->schema([
                        Select::make('visa_type')
                            ->required()
                            ->options([
                                'electronic' => 'Electronic Visa',
                                'arrival' => 'Visa on Arrival',
                                'transit' => 'Transit Visa',
                                'embassy' => 'Embassy/Consulate Visa',
                            ])
                            ->label('Visa Type'),
                        DatePicker::make('travel_date')
                            ->label('Expected Travel Date'),
                        Textarea::make('notes')
                            ->maxLength(65535)
                            ->columnSpanFull()
                            ->label('Additional Notes'),
                    ])->columns(2),

                Forms\Components\Section::make('Uploaded Documents')
                    ->schema([
                        FileUpload::make('passport_copy_path')
                            ->label('Passport Copy')
                            ->disk('public')
                            ->directory('visa-applications/passports')
                            ->visibility('public')
                            ->downloadable()
                            ->openable()
                            ->previewable(true)
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                            ->maxSize(5120),
                        FileUpload::make('photo_path')
                            ->label('Recent Photo')
                            ->disk('public')
                            ->directory('visa-applications/photos')
                            ->visibility('public')
                            ->downloadable()
                            ->openable()
                            ->previewable(true)
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->maxSize(2048),
                        FileUpload::make('other_documents_path')
                            ->label('Other Documents')
                            ->disk('public')
                            ->directory('visa-applications/others')
                            ->visibility('public')
                            ->downloadable()
                            ->openable()
                            ->previewable(true)
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                            ->maxSize(5120),
                    ])->columns(1),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Select::make('status')
                            ->required()
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'completed' => 'Completed',
                                'rejected' => 'Rejected',
                            ])
                            ->default('pending')
                            ->label('Application Status'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('full_name')
                    ->label('Full Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),
                TextColumn::make('nationality')
                    ->label('Nationality')
                    ->searchable(),
                TextColumn::make('visa_type')
                    ->label('Visa Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'electronic' => 'success',
                        'arrival' => 'info',
                        'transit' => 'warning',
                        'embassy' => 'primary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'electronic' => 'Electronic Visa',
                        'arrival' => 'Visa on Arrival',
                        'transit' => 'Transit Visa',
                        'embassy' => 'Embassy/Consulate',
                        default => $state,
                    }),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'completed' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('locale')
                    ->label('Language')
                    ->badge(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'completed' => 'Completed',
                        'rejected' => 'Rejected',
                    ]),
                SelectFilter::make('visa_type')
                    ->options([
                        'electronic' => 'Electronic Visa',
                        'arrival' => 'Visa on Arrival',
                        'transit' => 'Transit Visa',
                        'embassy' => 'Embassy/Consulate',
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
                    Tables\Actions\BulkAction::make('change_status')
                        ->label('Change Status')
                        ->form([
                            Select::make('status')
                                ->options([
                                    'pending' => 'Pending',
                                    'processing' => 'Processing',
                                    'completed' => 'Completed',
                                    'rejected' => 'Rejected',
                                ])
                                ->required(),
                        ])
                        ->action(function ($records, $data) {
                            foreach ($records as $record) {
                                $record->update(['status' => $data['status']]);
                            }
                        }),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSaudiVisas::route('/'),
            'create' => Pages\CreateSaudiVisa::route('/create'),
            'view' => Pages\ViewSaudiVisa::route('/{record}'),
            'edit' => Pages\EditSaudiVisa::route('/{record}/edit'),
        ];
    }
}
