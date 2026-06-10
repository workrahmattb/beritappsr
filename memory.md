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

### 4. Hero Sections (`/admin/hero-sections`)
| Item | Detail |
|------|--------|
| Model | `App\Models\HeroSection` |
| Icon | `heroicon-o-tv` |
| Label | Hero Section |
| Sort | #4 |

**Form**: title, subtitle, description, image, badge_text, button_text, button_url, overlay_opacity, is_active, sort_order

### 5. Instagram (`/admin/instagram-settings`)
| Item | Detail |
|------|--------|
| Model | `App\Models\InstagramSetting` |
| Icon | `heroicon-o-camera` |
| Label | Pengaturan Instagram |
| Sort | #5 |

**Form**: access_token (password revealable), user_id, username, is_active (toggle)
**Pattern**: Singleton — hanya 1 record.

### 6. Nomor WhatsApp (`/admin/contact-settings`)
| Item | Detail |
|------|--------|
| Model | `App\Models\ContactWhatsapp` (table: `contact_whatsapp_numbers`) |
| Icon | `heroicon-o-chat-bubble-left-ellipsis` |
| Label | Nomor WhatsApp |
| Sort | #6 |

**Form**: label, nomor_wa (required, tel), is_active (toggle), sort_order
**Pattern**: Multiple entries — bisa tambah banyak nomor WhatsApp.

### 7. Google Maps (`/admin/maps-settings`)
| Item | Detail |
|------|--------|
| Model | `App\Models\MapsSetting` |
| Icon | `heroicon-o-map` |
| Label | Google Maps |
| Sort | #7 |

**Form**: label, embed_code (textarea untuk iframe), is_active (toggle)
**Pattern**: Multiple entries — bisa tambah banyak peta.

### 8. Tentang (`/admin/about-settings`)
| Item | Detail |
|------|--------|
| Model | `App\Models\AboutSetting` |
| Icon | `heroicon-o-information-circle` |
| Label | Tentang |
| Sort | #8 |

**Form**: description (textarea), visi (textarea), misi (textarea), sejarah (textarea), image (FileUpload, public disk, directory `tentang`), is_active (toggle)
**Pattern**: Singleton — hanya 1 record.

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
| hero_sections | `2026_05_25_000002_create_hero_sections_table.php` | Hero carousel |
| school_facilities | `2026_05_26_000001_create_school_facilities_table.php` | Fasilitas (JSON images) |
| instagram_settings | `2026_05_26_000001_create_instagram_settings_table.php` | Instagram singleton |
| contact_whatsapp_numbers | `2026_06_11_000001_rebuild_contact_whatsapp.php` | WhatsApp numbers (multiple) |
| maps_settings | `2026_06_11_000002_create_maps_settings_table.php` | Google Maps (multiple) |
| about_settings | `2026_06_11_000003_create_about_settings_table.php` | Tentang (singleton) |

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

### Kolom contact_whatsapp_numbers
- `label` (nullable)
- `nomor_wa` (string, required)
- `is_active` (boolean)
- `sort_order` (integer)

### Kolom maps_settings
- `label` (nullable)
- `embed_code` (text, untuk iframe Google Maps)
- `is_active` (boolean)

### Kolom about_settings
- `description` (text, nullable)
- `visi` (text, nullable)
- `misi` (text, nullable)
- `sejarah` (text, nullable)
- `image` (string, nullable)
- `is_active` (boolean)

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

---

## 🏗️ Perubahan & Fitur yang Dibuat

### 1. 🔄 Navbar Mobile — Alpine.js untuk SPA

**File:** `resources/views/components/public/navbar.blade.php`

**Masalah:** Burger menu mobile tidak konsisten setelah navigasi `wire:navigate` karena JavaScript vanilla di `@push('scripts')` tidak jalan ulang.

**Solusi:** Konversi ke Alpine.js:
- `x-data` untuk state `mobileOpen` dan `scrolled`
- `:class` bindings untuk toggle class
- `@click` handlers untuk buka/tutup menu dan close otomatis saat link diklik
- `@scroll.window` untuk efek scroll (auto-cleanup, tidak ada memory leak)
- `x-cloak` agar menu tidak terlihat sebelum Alpine siap
- Hapus semua vanilla JS `@push('scripts')` — navbar kini konsisten di semua halaman SPA

---

### 2. 📄 Halaman Detail Pimpinan, Pengajar & Fasilitas

**File baru:**
- `app/Livewire/DetailTeacher.php` — Livewire component untuk detail Pimpinan & Pengajar
- `app/Livewire/DetailFasilitas.php` — Livewire component untuk detail Fasilitas
- `resources/views/livewire/detail-teacher.blade.php` — Halaman profil lengkap
- `resources/views/livewire/detail-fasilitas.blade.php` — Halaman fasilitas dengan galeri

**File diubah:**
- `routes/web.php` — 3 route baru: `profile.pimpinan.detail`, `profile.pengajar.detail`, `fasilitas.detail` (slug binding)
- `resources/views/livewire/daftar-pengajar.blade.php` — kartu jadi link `wire:navigate` ke detail
- `resources/views/livewire/fasilitas-sekolah.blade.php` — kartu jadi link `wire:navigate` ke detail

**Fitur Detail Teacher:**
- Gradient header + foto profile (fallback inisial) + badge kategori warna
- Bio otomatis dipecah per paragraf (double newline)
- Related teachers grid (filter by same category, exclude current)
- Back link otomatis (Pimpinan/Pengajar sesuai kategori)

**Fitur Detail Fasilitas:**
- Galeri gambar Alpine.js: prev/next, dots, thumbnails strip, image counter
- Placeholder jika tidak ada gambar
- Deskripsi dengan paragraf
- Related facilities grid (max 3)

---

### 3. 🎨 Hero Section — Font Size Mobile

**File:** `resources/views/livewire/home-page.blade.php`

**Perubahan CSS:**
- Ukuran `.hero-title` dan `.hero-subtitle` dikurangi untuk mobile (media queries)
- **Perbaikan cascade**: Media queries dipindahkan ke **akhir CSS** karena sebelumnya ditempatkan sebelum base declarations, sehingga base style menimpa override mobile

**Font Size di Filament (ditambahkan lalu di-revert):**
- Migration `add_font_size_to_hero_sections_table` — ditambahkan lalu di-rollback & dihapus
- Form section "Ukuran Font Mobile" dengan input `title_font_size_mobile` dan `subtitle_font_size_mobile`
- CSS variables `--hero-title-font-size-mobile`, `--hero-subtitle-font-size-mobile`
- **Reverted** atas permintaan user

---

### 4. 🐛 Fix Error Icon Filament

**File:** `app/Filament/Resources/HeroSections/Schemas/HeroSectionForm.php`

**Error:** `Svg by name "o-computer-phone" from set "heroicons" not found`

**Fix:** Ganti `heroicon-o-computer-phone` → `heroicon-o-device-phone-mobile`

---

### 5. 🐛 Fix Double Escaping (`&#039;`)

**File diubah:**
- `resources/views/livewire/detail-teacher.blade.php`
- `resources/views/livewire/detail-fasilitas.blade.php`

**Masalah:** `{{ nl2br(e(trim($para))) }}` menyebabkan double-escape. `e()` mengubah `'` → `&#039;`, lalu `{{ }}` meng-escape `&` → `&amp;`, hasilnya `&amp;#039;` yang tampil sebagai `&#039;`.

**Fix:** `{{ nl2br(e(trim($para))) }}` → `{!! nl2br(e(trim($para))) !!}`
- `e()` tetap melindungi dari XSS
- `nl2br()` menambahkan `<br>` untuk newline
- `{!! !!}` merender output tanpa escape ulang

---

---

## 🏗️ Perubahan & Fitur yang Dibuat (10 Juni 2026)

### 6. 📞 Resource Nomor WhatsApp (Admin Filament)

**Masalah:** ContactSetting sebelumnya terlalu banyak field (alamat, telepon, email, WA, jam, maps).

**Solusi:** Simplifikasi menjadi hanya kelola nomor WhatsApp.

**File:**
- `database/migrations/2026_06_11_000001_rebuild_contact_whatsapp.php` — Drop `contact_settings`, buat `contact_whatsapp_numbers`
- `app/Models/ContactWhatsapp.php` — Model baru, `getActive()` return Collection
- `app/Filament/Resources/ContactSettings/` — Update semua file (form hanya label + nomor_wa, table sederhana, list tanpa singleton)
- `app/Models/ContactSetting.php` — ❌ Dihapus (tidak dipakai)

**Fitur:**
- Bisa tambah **banyak** nomor WhatsApp
- Masing-masing: label (opsional) + nomor_wa + is_active + sort_order

---

### 7. 🗺️ Resource Google Maps (Admin Filament)

**File baru:**
- `database/migrations/2026_06_11_000002_create_maps_settings_table.php`
- `app/Models/MapsSetting.php` — Awal singleton, lalu diubah jadi multiple entries
- `app/Filament/Resources/MapsSettings/` — Resource lengkap (form, table, pages)

**Fitur:**
- Awal singleton, lalu diubah jadi **multiple entries** (bisa tambah banyak peta)
- Field: label + embed_code (textarea untuk paste iframe) + is_active

---

### 8. ℹ️ Resource Tentang (Admin Filament)

**File baru:**
- `database/migrations/2026_06_11_000003_create_about_settings_table.php`
- `app/Models/AboutSetting.php` — Singleton (`getActive()` return single)
- `app/Filament/Resources/AboutSettings/` — Resource lengkap (form, table, pages)

**Form:** Deskripsi, Visi, Misi, Sejarah (textarea), Foto (FileUpload, public disk, directory `tentang`)

---

### 9. 🌐 Halaman Publik Kontak (`/kontak`)

**File baru:**
- `app/Livewire/KontakPage.php` — Livewire component
- `resources/views/livewire/kontak-page.blade.php` — Halaman dengan WA cards + Maps embed

**File diubah:**
- `routes/web.php` — Route `/kontak`
- `resources/views/components/public/navbar.blade.php` — Link Kontak (desktop & mobile)

**Fitur:**
- Header gradient hijau
- Semua nomor WhatsApp aktif dalam kartu hijau (klik → chat WA dengan pesan otomatis)
- Semua Google Maps embed ditampilkan vertikal
- CTA section WhatsApp
- Empty state jika belum ada data

---

### 10. 💬 WhatsApp Floating Button

**File baru:**
- `resources/views/components/whatsapp-float.blade.php` — Blade component

**File diubah:**
- `resources/views/layouts/blank.blade.php` — Include `<x-whatsapp-float />`

**Fitur:**
- Tombol bulat hijau fixed pojok kanan bawah
- Pulse animation, tooltip hover, badge online
- Link WA dengan pesan otomatis: *"Assalamualaikum Warohmatullahi Wabarokatuh, Saya Ingin Daftar"*
- Nomor WA dari database (ambil pertama, fallback `6285259875754`)
- Tooltip teks: "Assalamualaikum Warohmatullahi Wabarokatuh"
- Responsive (mengecil di mobile)

---

### 11. 🌐 Halaman Publik Tentang (`/tentang`)

**File baru:**
- `app/Livewire/TentangPage.php` — Livewire component
- `resources/views/livewire/tentang-page.blade.php` — Halaman dengan hero, deskripsi, visi-misi, sejarah

**File diubah:**
- `routes/web.php` — Route `/tentang`
- `resources/views/components/public/navbar.blade.php` — Link Tentang (ganti dari `href="#"` ke route)

**Fitur:**
- Header gradient hijau
- Hero image (jika ada)
- Deskripsi dengan paragraf
- Visi & Misi dalam kartu hijau (2 kolom)
- Sejarah dalam section terpisah
- Empty state jika belum ada data

---

## 📁 Daftar File yang Dibuat/Dimodifikasi (10 Juni 2026)

| File | Status | Keterangan |
|------|--------|-----------|
| `resources/views/components/public/navbar.blade.php` | 🔧 Diubah | Link Kontak & Tentang aktif |
| `resources/views/layouts/blank.blade.php` | 🔧 Diubah | Include `<x-whatsapp-float />` |
| `routes/web.php` | 🔧 Diubah | + route /kontak, /tentang |
| `resources/views/components/whatsapp-float.blade.php` | ✅ Dibuat | WhatsApp floating button |
| `app/Livewire/KontakPage.php` | ✅ Dibuat | Livewire halaman kontak |
| `resources/views/livewire/kontak-page.blade.php` | ✅ Dibuat | Blade halaman kontak |
| `app/Livewire/TentangPage.php` | ✅ Dibuat | Livewire halaman tentang |
| `resources/views/livewire/tentang-page.blade.php` | ✅ Dibuat | Blade halaman tentang |
| `database/migrations/2026_06_11_000001_rebuild_contact_whatsapp.php` | ✅ Dibuat | Drop contact_settings + create contact_whatsapp_numbers |
| `database/migrations/2026_06_11_000002_create_maps_settings_table.php` | ✅ Dibuat | Migration maps_settings |
| `database/migrations/2026_06_11_000003_create_about_settings_table.php` | ✅ Dibuat | Migration about_settings |
| `app/Models/ContactWhatsapp.php` | ✅ Dibuat | Model WhatsApp numbers |
| `app/Models/MapsSetting.php` | ✅ Dibuat | Model Maps (multiple) |
| `app/Models/AboutSetting.php` | ✅ Dibuat | Model Tentang (singleton) |
| `app/Models/ContactSetting.php` | ❌ Dihapus | Diganti ContactWhatsapp |
| `app/Filament/Resources/ContactSettings/ContactSettingResource.php` | 🔧 Diubah | Update ke ContactWhatsapp |
| `app/Filament/Resources/ContactSettings/Schemas/ContactSettingForm.php` | 🔧 Diubah | Form hanya label + nomor_wa |
| `app/Filament/Resources/ContactSettings/Tables/ContactSettingsTable.php` | 🔧 Diubah | Table sederhana |
| `app/Filament/Resources/ContactSettings/Pages/ListContactSettings.php` | 🔧 Diubah | Hapus singleton restriction |
| `app/Filament/Resources/MapsSettings/` | ✅ Dibuat | 6 file resource Maps |
| `app/Filament/Resources/AboutSettings/` | ✅ Dibuat | 6 file resource Tentang |

---

*Terakhir diperbarui: 10 Juni 2026*
