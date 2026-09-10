<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    public function mount($record): void
    {
        parent::mount($record);

        if ($this->record->name === 'super_admin') {
            $this->redirect($this->getResource()::getUrl('index'));
        }
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $rolePermissions = $this->record->permissions()->get(['permissions.id', 'permissions.group']);
        
        foreach (\App\Providers\Filament\AdminPanelProvider::getNavigationMap() as $key => $config) {
            $data["perm_{$key}"] = $rolePermissions
                ->whereIn('group', $config['groups'])
                ->pluck('id')
                ->map(fn ($id) => (string) $id)
                ->toArray();
        }

        return $data;
    }

    protected function afterSave(): void
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

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function () {
                    if ($this->record->name === 'super_admin') {
                        throw new \Exception('Cannot delete the Super Admin role.');
                    }
                }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
