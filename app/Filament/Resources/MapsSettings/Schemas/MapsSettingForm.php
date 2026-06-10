<?php

namespace App\Filament\Resources\MapsSettings\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MapsSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([

                Section::make('Embed Google Maps')
                    ->description('Kode embed iframe dari Google Maps untuk ditampilkan di halaman publik')
                    ->icon('heroicon-o-code-bracket')
                    ->columnSpan(8)
                    ->schema([
                        TextInput::make('label')
                            ->label('Label')
                            ->placeholder('Contoh: Lokasi Pondok Pesantren')
                            ->helperText('Nama atau keterangan untuk peta ini')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('embed_code')
                            ->label('Kode Embed')
                            ->placeholder('Paste kode embed iframe Google Maps di sini...')
                            ->helperText('Dapatkan dari Google Maps > Bagikan > Sematkan peta. Contoh: <iframe src="..."></iframe>')
                            ->rows(8)
                            ->columnSpanFull()
                            ->required(),
                    ]),

                Section::make('Status')
                    ->description('Aktifkan untuk menampilkan peta di halaman publik')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->columnSpan(4)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Tampilkan di Halaman Publik')
                            ->helperText('Nonaktifkan untuk menyembunyikan peta sementara')
                            ->default(true),
                    ]),

            ]);
    }
}
