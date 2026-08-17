<?php

namespace App\Filament\Resources\LessonSchedules\Pages;

use App\Filament\Resources\LessonSchedules\LessonScheduleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLessonSchedule extends CreateRecord
{
    protected static string $resource = LessonScheduleResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
