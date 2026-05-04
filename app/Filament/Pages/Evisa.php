<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Evisa extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'E Visa';

    protected static ?string $title = 'E Visa Applications';

    protected static ?string $slug = 'e-visa';

    // Add under International section
    protected static ?string $navigationGroup = 'International Destinations';

    protected static ?int $navigationSort = 10; // After International Islands

    protected static string $view = 'filament.pages.evisa';
}
