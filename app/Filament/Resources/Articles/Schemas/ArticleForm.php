<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Article;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([

                // ── Basic Info ──
                Section::make('Informasi Dasar')
                    ->description('Judul, thumbnail, dan status publikasi')
                    ->icon('heroicon-o-information-circle')
                    ->columnSpan(8)
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->placeholder('Masukkan judul berita')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->placeholder('otomatis-dari-judul')
                            ->required()
                            ->maxLength(255)
                    ->unique(Article::class, 'slug', ignoreRecord: true)
                    ->helperText('URL slug, otomatis dibuat dari judul'),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'draft'     => 'Draft',
                                'published' => 'Published',
                                'archived'  => 'Archived',
                            ])
                            ->default('draft')
                            ->native(false)
                            ->required()
                            ->live(),

                        DateTimePicker::make('published_at')
                            ->label('Tanggal Terbit')
                            ->helperText('Tanggal dan jam publikasi. Otomatis terisi hari ini.')
                            ->default(now())
                            ->seconds(false)
                            ->displayFormat('d M Y H:i')
                            ->native(false)
                            ->visible(fn ($get) => $get('status') === 'published'),

                        Textarea::make('summary')
                            ->label('Ringkasan')
                            ->placeholder('Ringkasan singkat berita (opsional)')
                            ->maxLength(500)
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                // ── Thumbnail ──
                Section::make('Thumbnail')
                    ->description('Gambar utama berita')
                    ->icon('heroicon-o-photo')
                    ->columnSpan(4)
                    ->schema([
                        FileUpload::make('image')
                            ->label('Thumbnail')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->directory('berita/thumbnails')
                            ->disk('public')
                            ->visibility('public')
                            ->helperText('Ukuran optimal: 1200×675px (16:9)'),
                    ]),

                // ── Content ──
                Section::make('Konten Berita')
                    ->description('Tulis berita lengkap dengan editor rich text. Bisa upload gambar langsung.')
                    ->icon('heroicon-o-document-text')
                    ->columnSpan(12)
                    ->schema([
                        RichEditor::make('content')
                            ->label('Isi Berita')
                            ->fileAttachmentsDirectory('berita/images')
                            ->fileAttachmentsDisk('public')
                            ->required()
                            ->placeholder('Mulai menulis berita...')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike',
                                'blockquote', 'codeBlock',
                                'bulletList', 'orderedList',
                                'h1', 'h2', 'h3',
                                'link',
                                'undo', 'redo',
                            ]),
                    ]),

                // ── SEO ──
                Section::make('Pengaturan SEO')
                    ->description('Optimasi untuk mesin pencari')
                    ->icon('heroicon-o-magnifying-glass-circle')
                    ->columnSpan(12)
                    ->collapsible()
                    ->collapsed()
                    ->columns(2)
                    ->schema([
                        TextInput::make('focus_keyword')
                            ->label('Kata Kunci Utama')
                            ->placeholder('Contoh: berita politik, teknologi')
                            ->maxLength(255),

                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->placeholder('Judul untuk hasil pencarian (max 60 karakter)')
                            ->maxLength(255),

                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->placeholder('Deskripsi untuk hasil pencarian (max 160 karakter)')
                            ->maxLength(500)
                            ->rows(3),

                        FileUpload::make('og_image')
                            ->label('OG Image')
                            ->image()
                            ->imageEditor()
                            ->directory('berita/og-images')
                            ->disk('public')
                            ->visibility('public')
                            ->helperText('Gambar untuk preview di media sosial (1200×630px)'),
                    ]),

            ]);
    }
}
