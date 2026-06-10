<?php

namespace App\Filament\Resources\MapsSettings\Pages;

use App\Filament\Resources\MapsSettings\MapsSettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMapsSetting extends CreateRecord
{
    protected static string $resource = MapsSettingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
