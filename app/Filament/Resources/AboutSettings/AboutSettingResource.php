<?php

namespace App\Filament\Resources\AboutSettings;

use App\Filament\Resources\AboutSettings\Pages\CreateAboutSetting;
use App\Filament\Resources\AboutSettings\Pages\EditAboutSetting;
use App\Filament\Resources\AboutSettings\Pages\ListAboutSettings;
use App\Filament\Resources\AboutSettings\Schemas\AboutSettingForm;
use App\Filament\Resources\AboutSettings\Tables\AboutSettingsTable;
use App\Models\AboutSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class AboutSettingResource extends Resource
{
    protected static ?string $model = AboutSetting::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationLabel = 'Tentang';

    protected static ?string $modelLabel = 'Tentang';

    protected static ?string $pluralModelLabel = 'Tentang';

    protected static ?int $navigationSort = 8;

    public static function form(Schema $schema): Schema
    {
        return AboutSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AboutSettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAboutSettings::route('/'),
            'create' => CreateAboutSetting::route('/create'),
            'edit' => EditAboutSetting::route('/{record}/edit'),
        ];
    }
}
