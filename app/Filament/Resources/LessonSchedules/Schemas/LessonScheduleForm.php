<?php

namespace App\Filament\Resources\LessonSchedules\Schemas;

use App\Models\LessonSchedule;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LessonScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([

                // ── Informasi Jadwal ──
                Section::make('Informasi Jadwal')
                    ->description('Hari, jam, dan status aktif')
                    ->icon('heroicon-o-clock')
                    ->columnSpan(6)
                    ->columns(2)
                    ->schema([
                        Select::make('day')
                            ->label('Hari')
                            ->options(array_combine(LessonSchedule::getDays(), LessonSchedule::getDays()))
                            ->native(false)
                            ->required(),

                        DateTimePicker::make('time_start')
                            ->label('Jam Mulai')
                            ->withoutDate()
                            ->format('H:i')
                            ->displayFormat('H:i')
                            ->seconds(false)
                            ->native(false)
                            ->required(),

                        DateTimePicker::make('time_end')
                            ->label('Jam Selesai')
                            ->withoutDate()
                            ->format('H:i')
                            ->displayFormat('H:i')
                            ->seconds(false)
                            ->native(false)
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->inline(false),
                    ]),

                // ── Detail Pelajaran ──
                Section::make('Detail Pelajaran')
                    ->description('Mata pelajaran, pengajar, dan kelas')
                    ->icon('heroicon-o-book-open')
                    ->columnSpan(6)
                    ->columns(2)
                    ->schema([
                        TextInput::make('subject')
                            ->label('Mata Pelajaran')
                            ->placeholder('Contoh: Matematika, Bahasa Indonesia')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('teacher')
                            ->label('Guru Pengajar')
                            ->placeholder('Nama guru pengampu')
                            ->maxLength(255),

                        TextInput::make('class')
                            ->label('Kelas')
                            ->placeholder('Contoh: VII A, VIII B, IX C')
                            ->maxLength(255),
                    ]),

                // ── Deskripsi ──
                Section::make('Deskripsi')
                    ->description('Catatan tambahan tentang jadwal (opsional)')
                    ->icon('heroicon-o-document-text')
                    ->columnSpan(12)
                    ->schema([
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->placeholder('Deskripsi atau catatan tambahan...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                // ── Urutan ──
                Section::make('Urutan')
                    ->description('Urutan tampilan dalam satu hari')
                    ->icon('heroicon-o-arrows-up-down')
                    ->columnSpan(12)
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->helperText('Semakin kecil angka, semakin atas posisinya dalam satu hari')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ]),

            ]);
    }
}
