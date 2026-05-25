<?php

namespace App\Filament\Resources\Teachers\Schemas;

use App\Models\Teacher;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([

                // ── Basic Info ──
                Section::make('Informasi Dasar')
                    ->description('Nama, kategori, dan jabatan pengajar')
                    ->icon('heroicon-o-identification')
                    ->columnSpan(8)
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->placeholder('Masukkan nama lengkap')
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
                            ->unique(Teacher::class, 'slug', ignoreRecord: true)
                            ->helperText('URL slug, otomatis dibuat dari nama'),

                        Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'pimpinan'       => 'Pimpinan',
                                'guru'           => 'Guru',
                                'pembina_asrama' => 'Pembina Asrama',
                            ])
                            ->default('guru')
                            ->native(false)
                            ->required(),

                        TextInput::make('position')
                            ->label('Jabatan')
                            ->placeholder('Contoh: Kepala Sekolah, Wali Kelas, dll')
                            ->maxLength(255),
                    ]),

                // ── Photo ──
                Section::make('Foto')
                    ->description('Foto profil pengajar')
                    ->icon('heroicon-o-camera')
                    ->columnSpan(4)
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1:1',
                                '4:3',
                                '3:2',
                            ])
                            ->directory('pengajar/foto')
                            ->disk('public')
                            ->visibility('public')
                            ->helperText('Ukuran optimal: 400×400px (1:1)'),
                    ]),

                // ── Bio ──
                Section::make('Biografi')
                    ->description('Tentang pengajar')
                    ->icon('heroicon-o-document-text')
                    ->columnSpan(12)
                    ->schema([
                        Textarea::make('bio')
                            ->label('Biografi')
                            ->placeholder('Tulis biografi singkat pengajar...')
                            ->rows(5)
                            ->columnSpanFull(),
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
