<?php

namespace App\Filament\Resources\SchoolFacilities;

use App\Filament\Resources\SchoolFacilities\Pages\CreateSchoolFacility;
use App\Filament\Resources\SchoolFacilities\Pages\EditSchoolFacility;
use App\Filament\Resources\SchoolFacilities\Pages\ListSchoolFacilities;
use App\Filament\Resources\SchoolFacilities\Schemas\SchoolFacilityForm;
use App\Filament\Resources\SchoolFacilities\Tables\SchoolFacilitiesTable;
use App\Models\SchoolFacility;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class SchoolFacilityResource extends Resource
{
    protected static ?string $model = SchoolFacility::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationLabel = 'Fasilitas Sekolah';

    protected static ?string $modelLabel = 'Fasilitas';

    protected static ?string $pluralModelLabel = 'Fasilitas Sekolah';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return SchoolFacilityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchoolFacilitiesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSchoolFacilities::route('/'),
            'create' => CreateSchoolFacility::route('/create'),
            'edit' => EditSchoolFacility::route('/{record}/edit'),
        ];
    }
}
