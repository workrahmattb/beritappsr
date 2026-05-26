<?php

namespace App\Filament\Resources\InstagramSettings\Pages;

use App\Filament\Resources\InstagramSettings\InstagramSettingResource;
use App\Services\InstagramService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateInstagramSetting extends CreateRecord
{
    protected static string $resource = InstagramSettingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        // Clear cached feed when settings change
        app(InstagramService::class)->clearCache();
    }
}
