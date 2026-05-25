# 🧠 Project Memory — BeritaAppSR

> Proyek LMS/website sekolah berbasis **Laravel 13 + Filament v5 + Livewire**.

---

## 📦 Stack

| Layer       | Teknologi                   |
| ----------- | --------------------------- |
| Framework   | Laravel 13                  |
| Admin Panel | **Filament v5** (schemas-based) |
| Frontend    | Livewire, Blade, Tailwind CSS |
| Build Tool  | Vite                        |
| Database    | MySQL                       |
| Auth        | Laravel Fortify             |

---

## 🧱 Struktur Filament Resource

Setiap resource dipisah per direktori (bukan satu file besar).

```
app/Filament/Resources/
├── {Nama}/
│   ├── {Nama}Resource.php       # Resource utama
│   ├── Schemas/
│   │   └── {Nama}Form.php       # Form definition (dipanggil via form())
│   ├── Tables/
│   │   └── {Nama}Table.php      # Table definition (dipanggil via table())
│   └── Pages/
│       ├── List{Nama}.php       # Daftar
│       ├── Create{Nama}.php     # Buat
│       └── Edit{Nama}.php       # Edit + Delete
```

> **PENTING**: Semua resource menggunakan form/table class terpisah yang dipanggil via static method `::configure()`.

---

## 📋 Resource Tersedia

### 1. Users (`/admin/users`)
| Item | Detail |
|------|--------|
| Model | `App\Models\User` |
| Icon | `heroicon-o-users` |
| Label | Users |
| Sort | #1 |

**Form**: name, email, email_verified_at, password + confirm password.
**Password**: Opsional saat edit (dikosongi jika tidak diganti). Hashing otomatis via `'hashed'` cast di model User.
**Table**: name, email, verified badge (icon), 2FA status, join date. Filter by verified/unverified.

### 2. Berita / Articles (`/admin/articles`)
| Item | Detail |
|------|--------|
| Model | `App\Models\Article` (SoftDeletes) |
| Icon | `heroicon-o-newspaper` |
| Label | Berita |
| Sort | #2 |

**Form sections:**
- **Informasi Dasar**: judul, slug (auto dari judul via `afterStateUpdated` + `Str::slug`), status (draft/published/archived), ringkasan
- **Thumbnail**: FileUpload image 16:9, image editor
- **Konten Berita**: RichEditor dengan upload gambar via `fileAttachmentsDirectory('berita/images')`
- **Pengaturan SEO** (collapsible, collapsed): focus_keyword, meta_title, meta_description, og_image

**Table**: thumbnail (square), judul, status badge (success/gray/warning), penulis, tanggal terbit. Filter by status, published, scheduled, trashed.

**Create**: auto-assign `author_id` = auth user, auto-set `published_at` if status = published.
**Edit**: auto-set `published_at` only if previously null.

### 3. Pengajar / Teachers (`/admin/teachers`)
| Item | Detail |
|------|--------|
| Model | `App\Models\Teacher` |
| Icon | `heroicon-o-academic-cap` |
| Label | Pengajar |
| Sort | #3 |

**Kategori**: Pimpinan (🟡 warning), Guru (🔵 primary), Pembina Asrama (🟢 success)

**Form sections:**
- **Informasi Dasar**: nama, slug (auto dari nama), kategori (select), jabatan
- **Foto**: FileUpload image, image editor (1:1, 4:3, 3:2), disk public, directory `pengajar/foto`
- **Biografi**: textarea
- **Urutan**: sort_order numeric (ascending)

**Table**: foto (circular, disk public), nama, kategori badge, jabatan, urutan. Filter by kategori. Default sort by sort_order.

---

## 🧩 Filament v5 — Pola Penting

### Namespace yang berubah dari v3

| Komponen | Namespace v3 (SALAH) | Namespace v5 (BENAR) |
|----------|---------------------|---------------------|
| Section | `Filament\Forms\Components\Section` | `Filament\Schemas\Components\Section` |
| Set (callback) | `Filament\Forms\Set` | `Filament\Schemas\Components\Utilities\Set` |
| Schema param | `Forms\Form` / `getForm()` | `Filament\Schemas\Schema` |
| Navigation icon type | `?string` | `string\|BackedEnum\|null` |

### Form Pattern (Filament v5)

```php
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;

public static function configure(Schema $schema): Schema
{
    return $schema
        ->columns(12)
        ->components([
            Section::make('Judul')
                ->columnSpan(8)
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                ]),
        ]);
}
```

### Resource Pattern

```php
use BackedEnum;

protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-...';
protected static ?string $navigationLabel = '...';
protected static ?string $modelLabel = '...';
protected static ?string $pluralModelLabel = '...';
protected static ?int $navigationSort = ...;

public static function form(Schema $schema): Schema
{
    return NamaForm::configure($schema);
}

public static function table(Table $table): Table
{
    return NamaTable::configure($table);
}
```

### Image Upload & Preview

- **Upload**: `FileUpload::make('photo')->disk('public')->directory('pengajar/foto')`
- **Preview di Table**: `ImageColumn::make('photo')->disk('public')` — **wajib** tambah `->disk('public')` agar path di-resolve ke `/storage/...`
- **Storage symlink**: `php artisan storage:link`
- **RichEditor gambar**: `->fileAttachmentsDirectory('berita/images')->fileAttachmentsDisk('public')` — otomatis aktifkan tombol `attachFiles`

### RichEditor Toolbar Buttons Valid (v5)

```
bold, italic, underline, strike,
blockquote, codeBlock,
bulletList, orderedList,
h1, h2, h3,
link, attachFiles,
undo, redo
```

> **Catatan**: `image` dan `media` **bukan** toolbar button yang valid. Upload gambar di-handle oleh `attachFiles` yang aktif otomatis via `fileAttachmentsDirectory()`.

### Custom Slug & Route Name

Di Filament v5, jika ingin URL kustom (misal `/admin/berita`), perlu menggunakan metode yang tepat agar route name tetap konsisten. Jika tidak, biarkan Filament menggunakan slug default dari nama tabel.

---

## 🗄️ Database Migrations

| Tabel | File | Keterangan |
|-------|------|-----------|
| users | `0001_01_01_000000_create_users_table.php` | Default Laravel |
| articles | `2026_04_03_163550_create_articles_table.php` | Berita dengan soft deletes |
| teachers | `2026_05_25_000001_create_teachers_table.php` | Pengajar |

### Kolom teachers
- `name`, `slug` (unique)
- `category` (enum: pimpinan, guru, pembina_asrama)
- `position` (jabatan, nullable)
- `photo` (nullable)
- `bio` (text, nullable)
- `sort_order` (integer, default 0)

### Kolom articles
- `title`, `slug` (unique)
- `content` (longText), `summary` (nullable)
- `image` (nullable), `status` (enum)
- `published_at`, `scheduled_at` (nullable datetime)
- `author_id` (FK ke users)
- `meta_title`, `meta_description`, `og_image`, `focus_keyword` (nullable — SEO)

---

## ⚙️ Perintah Penting

```bash
php artisan migrate              # Jalankan migration
php artisan optimize:clear       # Bersihkan semua cache
php artisan filament:clear-cached-components  # Bersihkan cache Filament
php artisan storage:link         # Symlink storage
php artisan route:list --path=admin  # Cek route admin
php artisan make:filament-resource Nama --generate  # Generate resource
```

---

## 🧠 Kesimpulan Penting untuk AI Agent

1. **Filament v5** — namespace `Schemas\Components` bukan `Forms\Components` untuk Section
2. **Set** — import dari `Filament\Schemas\Components\Utilities\Set`
3. **Form** — parameter type `Schema`, bukan `Form`
4. **Password** — biarkan `'hashed'` cast di model yang handle hashing, jangan double-hash
5. **ImageColumn** — selalu tambah `->disk('public')` agar preview path benar
6. **Toolbar RichEditor** — tidak ada button `image` atau `media`, gunakan `attachFiles`
7. **Navigation icon** — type hint `string|BackedEnum|null` (import `BackedEnum`)
8. **Custom slug** — jika error route name, hapus custom slug dan pakai default

---

*Terakhir diperbarui: 25 Mei 2026*
