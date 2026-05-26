<?php

namespace App\Filament\Resources\HeroSections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HeroSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([

                // ── Main Content ──
                Section::make('Konten Utama')
                    ->description('Judul, subtitle, dan deskripsi hero')
                    ->icon('heroicon-o-pencil-square')
                    ->columnSpan(8)
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->placeholder('Contoh: Pondok Pesantren Syafa\'aturrasul')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('subtitle')
                            ->label('Subtitle')
                            ->placeholder('Contoh: Syafa\'aturrasul')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->placeholder('Deskripsi singkat hero section...')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ]),

                // ── Background Image ──
                Section::make('Gambar Background')
                    ->description('Gambar latar hero section')
                    ->icon('heroicon-o-photo')
                    ->columnSpan(4)
                    ->schema([
                        FileUpload::make('image')
                            ->label('Background Image')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '21:9',
                                '4:3',
                            ])
                            ->directory('hero/backgrounds')
                            ->disk('public')
                            ->visibility('public')
                            ->helperText('Ukuran optimal: 1920×1080px (16:9)'),

                        TextInput::make('overlay_opacity')
                            ->label('Opacity Overlay (%)')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->default(50)
                            ->suffix('%')
                            ->helperText('Gelapkan background agar teks lebih terbaca (0 = transparan, 100 = hitam pekat)'),
                    ]),

                // ── Badge ──
                Section::make('Badge')
                    ->description('Label kecil di atas judul')
                    ->icon('heroicon-o-tag')
                    ->columnSpan(6)
                    ->columns(2)
                    ->schema([
                        TextInput::make('badge_text')
                            ->label('Teks Badge')
                            ->placeholder('Contoh: Terbaru, Hot, Trending')
                            ->maxLength(255),
                    ]),

                // ── Button ──
                Section::make('Tombol CTA')
                    ->description('Tombol ajakan di hero')
                    ->icon('heroicon-o-cursor-arrow-rays')
                    ->columnSpan(6)
                    ->columns(2)
                    ->schema([
                        TextInput::make('button_text')
                            ->label('Teks Tombol')
                            ->placeholder('Contoh: Baca Selengkapnya')
                            ->maxLength(255),

                        TextInput::make('button_url')
                            ->label('URL Tombol')
                            ->placeholder('Contoh: /berita')
                            ->maxLength(255)
                            ->helperText('Bisa URL internal (/berita) atau eksternal (https://...)'),
                    ]),

                // ── Settings ──
                Section::make('Pengaturan')
                    ->description('Status dan urutan tampilan')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->columnSpan(12)
                    ->columns(3)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->helperText('Nonaktifkan untuk menyembunyikan hero section sementara')
                            ->default(true)
                            ->required(),

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
