<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

    protected function afterCreate(): void
    {
        $state = $this->form->getRawState();
        $selectedPermissions = [];

        foreach (array_keys(\App\Providers\Filament\AdminPanelProvider::getNavigationMap()) as $key) {
            $fieldKey = "perm_{$key}";
            if (isset($state[$fieldKey]) && is_array($state[$fieldKey])) {
                foreach ($state[$fieldKey] as $id) {
                    if ($id) {
                        $selectedPermissions[] = (int) $id;
                    }
                }
            }
        }

        $this->record->permissions()->sync(array_unique($selectedPermissions));
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
