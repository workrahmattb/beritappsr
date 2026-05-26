<?php

namespace App\Filament\Resources\InstagramSettings;

use App\Filament\Resources\InstagramSettings\Pages\CreateInstagramSetting;
use App\Filament\Resources\InstagramSettings\Pages\EditInstagramSetting;
use App\Filament\Resources\InstagramSettings\Pages\ListInstagramSettings;
use App\Filament\Resources\InstagramSettings\Schemas\InstagramSettingForm;
use App\Filament\Resources\InstagramSettings\Tables\InstagramSettingsTable;
use App\Models\InstagramSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class InstagramSettingResource extends Resource
{
    protected static ?string $model = InstagramSetting::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-camera';

    protected static ?string $navigationLabel = 'Instagram';

    protected static ?string $modelLabel = 'Pengaturan Instagram';

    protected static ?string $pluralModelLabel = 'Pengaturan Instagram';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return InstagramSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InstagramSettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInstagramSettings::route('/'),
            'create' => CreateInstagramSetting::route('/create'),
            'edit' => EditInstagramSetting::route('/{record}/edit'),
        ];
    }
}
