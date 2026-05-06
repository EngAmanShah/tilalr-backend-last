<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Evisa extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'E Visa';
    protected static ?string $title = 'E Visa Applications';
    protected static ?string $slug = 'e_visa'; // Changed from 'e-visa' to 'e_visa'
    protected static ?string $navigationGroup = 'International Destinations';
    protected static ?int $navigationSort = 10;
    protected static string $view = 'filament.pages.evisa';
}
