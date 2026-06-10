<?php

namespace App\Filament\Resources\ContactSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([

                Section::make('Nomor WhatsApp')
                    ->description('Label dan nomor WhatsApp untuk ditampilkan di halaman publik')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->columnSpan(8)
                    ->columns(2)
                    ->schema([
                        TextInput::make('label')
                            ->label('Label')
                            ->placeholder('Contoh: Pendaftaran Santri Baru, Sekretariat, dll')
                            ->helperText('Nama atau keterangan untuk nomor ini')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('nomor_wa')
                            ->label('Nomor WhatsApp')
                            ->placeholder('Contoh: 6285259875754')
                            ->helperText('Nomor dengan kode negara, tanpa + atau spasi')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                    ]),

                Section::make('Pengaturan')
                    ->description('Status aktif dan urutan tampilan')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->columnSpan(4)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->helperText('Tampilkan nomor ini di halaman publik')
                            ->default(true),

                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->helperText('Semakin kecil, semakin atas')
                            ->numeric()
                            ->default(0),
                    ]),

            ]);
    }
}
