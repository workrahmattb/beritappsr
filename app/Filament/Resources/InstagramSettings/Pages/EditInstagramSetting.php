<?php

namespace App\Filament\Resources\InstagramSettings\Pages;

use App\Filament\Resources\InstagramSettings\InstagramSettingResource;
use App\Services\InstagramService;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInstagramSetting extends EditRecord
{
    protected static string $resource = InstagramSettingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterSave(): void
    {
        // Clear cached feed when settings change
        app(InstagramService::class)->clearCache();
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus'),
        ];
    }
}
