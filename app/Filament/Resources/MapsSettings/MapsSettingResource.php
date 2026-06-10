<?php

namespace App\Filament\Resources\MapsSettings;

use App\Filament\Resources\MapsSettings\Pages\CreateMapsSetting;
use App\Filament\Resources\MapsSettings\Pages\EditMapsSetting;
use App\Filament\Resources\MapsSettings\Pages\ListMapsSettings;
use App\Filament\Resources\MapsSettings\Schemas\MapsSettingForm;
use App\Filament\Resources\MapsSettings\Tables\MapsSettingsTable;
use App\Models\MapsSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class MapsSettingResource extends Resource
{
    protected static ?string $model = MapsSetting::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationLabel = 'Google Maps';

    protected static ?string $modelLabel = 'Google Maps';

    protected static ?string $pluralModelLabel = 'Google Maps';

    protected static ?int $navigationSort = 7;

    public static function form(Schema $schema): Schema
    {
        return MapsSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MapsSettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMapsSettings::route('/'),
            'create' => CreateMapsSetting::route('/create'),
            'edit' => EditMapsSetting::route('/{record}/edit'),
        ];
    }
}
