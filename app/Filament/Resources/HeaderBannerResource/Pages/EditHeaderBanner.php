<?php

namespace App\Filament\Resources\HeaderBannerResource\Pages;

use App\Filament\Resources\HeaderBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHeaderBanner extends EditRecord
{
    protected static string $resource = HeaderBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
