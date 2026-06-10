<?php

namespace App\Filament\Resources\AboutSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AboutSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([

                Section::make('Konten')
                    ->description('Deskripsi, Visi, Misi, dan Sejarah pondok')
                    ->icon('heroicon-o-document-text')
                    ->columnSpan(8)
                    ->columns(2)
                    ->schema([
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->placeholder('Tulis deskripsi tentang pondok pesantren...')
                            ->rows(4)
                            ->columnSpanFull(),

                        Textarea::make('visi')
                            ->label('Visi')
                            ->placeholder('Tulis visi pondok pesantren...')
                            ->rows(3)
                            ->columnSpanFull(),

                        Textarea::make('misi')
                            ->label('Misi')
                            ->placeholder('Tulis misi pondok pesantren...')
                            ->rows(5)
                            ->columnSpanFull(),

                        Textarea::make('sejarah')
                            ->label('Sejarah')
                            ->placeholder('Tulis sejarah berdirinya pondok pesantren...')
                            ->rows(6)
                            ->columnSpanFull(),
                    ]),

                Section::make('Foto')
                    ->description('Foto atau gambar pendukung')
                    ->icon('heroicon-o-camera')
                    ->columnSpan(4)
                    ->schema([
                        FileUpload::make('image')
                            ->label('Foto')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->directory('tentang')
                            ->disk('public')
                            ->visibility('public')
                            ->helperText('Ukuran optimal: 1200×675px (16:9)'),
                    ]),

                Section::make('Status')
                    ->description('Aktifkan untuk menampilkan di halaman publik')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->columnSpan(12)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Tampilkan di Halaman Publik')
                            ->helperText('Nonaktifkan untuk menyembunyikan halaman Tentang sementara')
                            ->default(true),
                    ]),

            ]);
    }
}
