<?php

namespace App\Filament\Resources\SchoolFacilities\Pages;

use App\Filament\Resources\SchoolFacilities\SchoolFacilityResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSchoolFacility extends EditRecord
{
    protected static string $resource = SchoolFacilityResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus'),
        ];
    }
}
