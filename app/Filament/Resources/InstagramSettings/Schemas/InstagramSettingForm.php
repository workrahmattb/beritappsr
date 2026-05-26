<?php

namespace App\Filament\Resources\InstagramSettings\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class InstagramSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([

                Section::make('Kredensial API')
                    ->description('Token akses dan ID user dari Meta Developers Console')
                    ->icon('heroicon-o-key')
                    ->columnSpan(8)
                    ->columns(2)
                    ->schema([
                        TextInput::make('access_token')
                            ->label('Access Token')
                            ->placeholder('Masukkan Instagram Long-Lived Access Token')
                            ->password()
                            ->revealable()
                            ->helperText('Dapatkan dari Meta Developers Console. Token berlaku 60 hari.')
                            ->columnSpanFull(),

                        TextInput::make('user_id')
                            ->label('Instagram User ID')
                            ->placeholder('Contoh: 17841400000000000')
                            ->helperText('ID user Instagram Business/Creator')
                            ->required(),

                        TextInput::make('username')
                            ->label('Username Instagram')
                            ->placeholder('Contoh: syafaaturrasul')
                            ->helperText('Digunakan untuk link ke profil Instagram di footer')
                            ->required()
                            ->maxLength(255),
                    ]),

                Section::make('Status')
                    ->description('Aktifkan untuk menampilkan feed Instagram di halaman utama')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->columnSpan(4)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Tampilkan di Halaman Utama')
                            ->helperText('Nonaktifkan untuk menyembunyikan feed Instagram sementara')
                            ->default(false)
                            ->required(),
                    ]),

            ]);
    }
}
