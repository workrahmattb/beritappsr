<?php

namespace App\Filament\Resources\SchoolFacilities\Schemas;

use App\Models\SchoolFacility;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SchoolFacilityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([

                // ── Basic Info ──
                Section::make('Informasi Dasar')
                    ->description('Nama dan deskripsi fasilitas')
                    ->icon('heroicon-o-information-circle')
                    ->columnSpan(8)
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Fasilitas')
                            ->placeholder('Contoh: Laboratorium Komputer')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->placeholder('otomatis-dari-nama')
                            ->required()
                            ->maxLength(255)
                            ->unique(SchoolFacility::class, 'slug', ignoreRecord: true)
                            ->helperText('URL slug, otomatis dibuat dari nama'),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->placeholder('Tulis deskripsi fasilitas...')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                // ── Images (Gallery) ──
                Section::make('Galeri Foto')
                    ->description('Upload beberapa foto fasilitas')
                    ->icon('heroicon-o-camera')
                    ->columnSpan(4)
                    ->schema([
                        FileUpload::make('images')
                            ->label('Foto')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->appendFiles()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->directory('fasilitas/foto')
                            ->disk('public')
                            ->visibility('public')
                            ->helperText('Upload beberapa foto. Bisa diurutkan dengan drag & drop. Ukuran optimal: 800×600px'),
                    ]),

                // ── Sort ──
                Section::make('Urutan')
                    ->description('Urutan tampilan di halaman publik')
                    ->icon('heroicon-o-arrows-up-down')
                    ->columnSpan(12)
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->helperText('Semakin kecil angka, semakin atas posisinya')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ]),

            ]);
    }
}
