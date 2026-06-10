<?php

namespace App\Filament\Resources\AboutSettings\Pages;

use App\Filament\Resources\AboutSettings\AboutSettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAboutSetting extends CreateRecord
{
    protected static string $resource = AboutSettingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
