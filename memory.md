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

## 🌐 SEO (Search Engine Optimization)

Ditambahkan pada 11 Juni 2026 untuk mendongkrak peringkat Google.

### ✅ Perubahan yang Dilakukan

#### 1. Layout (`blank.blade.php`) — Meta Tags Universal

Semua halaman publik otomatis punya:
- `<title>` dinamis per halaman (`{judul} - Pondok Pesantren Syafa'aturrasul`)
- `<meta name="description">` — deskripsi spesifik per halaman
- `<meta name="keywords">` — semua keywords utama:
  - Ponpes Kuansing, Pondok Pesantren Syafaaturrasul, Pondok Pesantren Syafa'aturrasul
  - Pondok Pesantren Kuantan Singingi, Pondok Pesantren Kuansing
  - Kiyai Kuansing, Kiyai Hamdani, DR. KH. Hamdani Purba, Lc., MA
- `<link rel="canonical">` — setiap halaman punya canonical URL
- `<meta name="robots">` — index, follow
- **Open Graph (OG)** — og:title, og:description, og:image, og:url, og:type, og:site_name, og:locale
- **Twitter Card** — summary_large_image
- **Google Search Console** — placeholder `google-site-verification` (isi dari .env)
- **JSON-LD Structured Data** — `EducationalOrganization` Schema.org:
  - Nama, alternatif nama, deskripsi, URL, logo
  - Founder: DR. KH. Hamdani Purba, Lc., MA / Kiyai Hamdani
  - Alamat: Kuantan Singingi, Riau, Indonesia
  - SameAs: Instagram resmi

#### 2. Setiap Halaman Punya SEO Spesifik

| Halaman | Title Tag | Meta Description Khusus | OG Image |
|---------|-----------|------------------------|----------|
| Home | `Syafa'aturrasul — Ponpes Kuansing ...` | ✅ Deskripsi lengkap pesantren | Logo default |
| Berita | `Berita — Pondok Pesantren Syafa'aturrasul` | ✅ Kegiatan & berita pesantren | Logo default |
| Detail Berita | `{judul artikel} — Ponpes Kuansing` | ✅ Ringkasan artikel (160 char) | OG image → article image → logo |
| Pimpinan | `Pimpinan Pondok — Ponpes Kuansing` | ✅ Profil pimpinan & Kiyai Hamdani | Logo default |
| Pengajar | `Pengajar — Ponpes Kuansing` | ✅ Daftar guru/ustadz | Logo default |
| Detail Pengajar | `{nama} — {kategori} Ponpes Kuansing` | ✅ Bio (160 char) | Foto teacher → logo |
| Fasilitas | `Fasilitas — Ponpes Kuansing` | ✅ Sarana & prasarana pesantren | Logo default |
| Detail Fasilitas | `{nama} — Fasilitas Ponpes Kuansing` | ✅ Deskripsi fasilitas (160 char) | Gambar pertama → logo |
| Kontak | `Kontak — Ponpes Kuansing` | ✅ WhatsApp & info pendaftaran | Logo default |
| Tentang | `Tentang — Ponpes Kuansing` | ✅ Visi, misi, sejarah (160 char) | Foto tentang → logo |

### 🔧 Cara Menambahkan Google Search Console

1. Dapatkan meta tag verifikasi dari [Google Search Console](https://search.google.com/search-console)
2. Tambahkan ke `.env`:
   ```
   GOOGLE_VERIFICATION=xxxxxxxxxxx
   ```
3. Verifikasi selesai

### 📝 Catatan

- Canonical URL otomatis menggunakan `url()->current()` jika tidak di-set manual
- OG Image punya **fallback chain**: halaman spesifik → logo default
- JSON-LD menggunakan `@json()` dengan `JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE` agar output valid
- Keywords sudah ditanam di `meta keywords` dan juga di `meta description` setiap halaman

---

## ⚡ Optimasi Performa & Code Quality (11 Juni 2026)

### 1. 🎨 CSS Refactoring — Shared CSS ke `app.css`

**Masalah:** Setiap file Blade mendefinisikan ulang CSS reset, body, x-cloak, dan animasi yang sama.

**Solusi:** Pindahkan CSS bersama ke `resources/css/app.css`:
- `* { margin: 0; padding: 0; box-sizing: border-box; }`
- `body { font-family: 'Inter', ... }` (default: `#f9fafb`)
- `[x-cloak] { display: none !important; }`
- `@keyframes fadeUp` + `.animate-fade-up`, `.animate-delay-1/2/3`

**File yang diubah:**
- `resources/css/app.css` — ✅ Ditambahkan shared styles
- `home-page.blade.php` — ✅ Hanya override `body { background: #ffffff }` yang tersisa
- `daftar-pengajar.blade.php` — ✅ Hapus reset + body
- `fasilitas-sekolah.blade.php` — ✅ Hapus reset + body + x-cloak
- `kontak-page.blade.php` — ✅ Hapus reset + body + x-cloak + animasi
- `tentang-page.blade.php` — ✅ Hapus reset + body + x-cloak + animasi
- `detail-berita.blade.php` — ✅ Hapus reset + body + x-cloak + animasi
- `detail-teacher.blade.php` — ✅ Hapus reset + body + x-cloak + animasi
- `detail-fasilitas.blade.php` — ✅ Hapus reset + body + x-cloak + animasi
- `all-berita.blade.php` — ✅ Hapus reset + body + x-cloak + animasi

**Manfaat:**
- ✅ File Blade lebih bersih dan fokus ke CSS spesifik halaman
- ✅ Vite compile CSS sekali, browser cache lebih optimal
- ✅ Maintenance mudah — ganti global style di 1 file

---

### 2. 🔄 Hero Carousel — Vanilla JS ke Alpine.js

**Masalah:** Hero carousel menggunakan vanilla JS di `@push('scripts')` yang tidak SPA-safe (tidak jalan ulang setelah `wire:navigate`).

**Solusi:** Konversi ke Alpine.js `x-data`:
- State: `currentSlide`, `totalSlides`, `autoplayTimer`
- Methods: `goTo()`, `next()`, `prev()`, `startAutoplay()`, `stopAutoplay()`, `resetAutoplay()`
- Events: `@mouseenter`, `@mouseleave`, `@keydown.window.arrow-left/right`
- Binding: `:class="{ 'active': currentSlide === index }"`

**File:** `resources/views/livewire/home-page.blade.php`

**Behavior same:**
- ✅ Auto-play 4 detik
- ✅ Dot navigation
- ✅ Prev/Next buttons
- ✅ Pause on hover
- ✅ Keyboard navigation (ArrowLeft/ArrowRight) — hanya jika hero di viewport
- ✅ SPA-safe — state bertahan setelah navigasi

---

### 3. ❌ Caching Data Publik — Dihapus (Error Unserialize)

**Masalah:** Awalnya ditambahkan `Cache::remember()` untuk cache data publik, tapi menyebabkan error:
```
The script tried to call a method on an incomplete object.
Class "Illuminate\Database\Eloquent\Collection" not loaded before unserialize()
```

**Penyebab:** Database cache driver (`CACHE_STORE=database`) tidak bisa meng-unserialize Eloquent models/collections dengan andal — class definitions belum di-load saat unserialize dipanggil.

**Solusi:** Hapus SEMUA `Cache::remember()` dari semua Livewire components:

| Komponen | Method | Status |
|----------|--------|--------|
| HomePage | `#[Computed] heroSections()` | ❌ Dihapus |
| HomePage | `#[Computed] articles()` | ❌ Dihapus |
| AllBerita | `#[Computed] articles()` | ❌ Dihapus |
| DetailBerita | `#[Computed] relatedArticles()` | ❌ Dihapus |
| DaftarPengajar | `getTeachersProperty()` (computed) | ❌ Dihapus |
| DetailTeacher | `#[Computed] relatedTeachers()` | ❌ Dihapus |
| DetailFasilitas | `#[Computed] relatedFacilities()` | ❌ Dihapus |
| FasilitasSekolah | `render()` | ❌ Dihapus |
| KontakPage | `render()` | ❌ Dihapus |
| TentangPage | `render()` | ❌ Dihapus |

**File yang diubah (semua revert ke query langsung):**
- `app/Livewire/HomePage.php`
- `app/Livewire/AllBerita.php`
- `app/Livewire/DetailBerita.php`
- `app/Livewire/DaftarPengajar.php`
- `app/Livewire/FasilitasSekolah.php`
- `app/Livewire/DetailFasilitas.php`
- `app/Livewire/DetailTeacher.php`
- `app/Livewire/KontakPage.php`
- `app/Livewire/TentangPage.php`

**✅ CACHE_STORE sekarang = `file` (12 Juni 2026)**
- `.env`: `CACHE_STORE=database` → `CACHE_STORE=file`
- `.env.example`: ikut diupdate

**Jika ingin caching Eloquent models di masa depan:**
- Cache data sebagai **array** (`->toArray()`) bukan Eloquent models langsung
- Atau set `'serializable_classes' => true` di `config/cache.php` (risiko keamanan)

**Catatan:** InstagramService sudah aman karena caching data sebagai array (bukan Eloquent models)

---

## 🔗 Navigasi & UI (11 Juni 2026)

### 1. 🖼️ Favicon — Ganti Logo Laravel ke Logo PPSR

**Masalah:** Logo Laravel muncul di Google Search dan browser tab karena:
- `public/favicon.ico` masih logo Laravel default
- `public/favicon.svg` masih logo Laravel (
#FF2D20)
- Layout merefer `gambar/favicon.ico` yang tidak ada (broken link)

**Solusi:**
- ✅ `public/favicon.ico` — ❌ Dihapus (browser fallback ke `<link rel="icon">`)
- ✅ `public/favicon.svg` — 🔧 Diganti dengan SVG yang render logo PPSR
- ✅ `public/gambar/favicon.png` — ✅ Dibuat baru (32x32, konversi dari `ppsr logo.webp` via PHP GD)
- ✅ `resources/views/layouts/blank.blade.php` — 🔧 Update semua referensi favicon:
  - `favicon.png` untuk icon utama (32x32)
  - `favicon.svg` sebagai fallback SVG
  - `apple-touch-icon` 180x180
  - `mask-icon` untuk Safari pinned tab
  - `msapplication-TileImage/Color` untuk Windows tiles
  - `theme-color` = `#16a34a` (hijau tema website)

### 2. 🔗 Link Wakaf — Navbar & Footer

**Link:** `https://lws.syafaaturrasul.com` (tab baru)

**Navbar Desktop:** Tombol emas gradient (`#b8860b → #daa520`) sebagai CTA
**Navbar Mobile:** Teks emas dengan font tebal + `@click="mobileOpen = false"`
**Footer:** Link emas di kolom "Menu" setelah Berita

**File diubah:**
- `resources/views/components/public/navbar.blade.php`
- `resources/views/components/public/footer.blade.php`

---

## 🛡️ Fix XSS — Sanitasi Konten Filament ArticleResource (17 Agustus 2026)

**Masalah:** `ContentSanitizer` (HTML Purifier) hanya dipakai oleh `ArticleService` (Livewire AdminBerita lama). Resource Filament `ArticleResource` (`/admin/articles`) menyimpan konten RichEditor **mentah tanpa sanitasi**, lalu dirender `{!! $article->content !!}` di `detail-berita.blade.php` → celah stored XSS.

**Solusi:** Tambah `dehydrateStateUsing` pada field `content` di `ArticleForm.php`:

```php
RichEditor::make('content')
    ->dehydrateStateUsing(fn (?string $state): string => app(ContentSanitizer::class)->sanitize($state ?? ''))
```

**Kenapa ini benar (urutan dehydrate Filament v5):**
1. `RichEditorStateCast::get()` dipanggil lebih dulu di `getStateToDehydrate()` → mengubah state JSON TipTap (`{"type":"doc",...}`) menjadi **string HTML**
2. **Baru** `dehydrateStateUsing` dievaluasi dengan `state` berupa HTML → sanitizer menerima HTML, bukan JSON

**Yang disanitasi (sesuai `config/purifier.php`):**
- ❌ Dihapus: `<script>`, `<iframe>`, `<embed>`, `<object>`, `<form>`, event handler (`onerror`, `onclick`, dll)
- ✅ Dipertahankan: p, br, strong, em, u, s, h1-h6, ul, ol, li, blockquote, pre, code, hr, a, img, span, div, table
- ✅ Link otomatis dapat `rel="noopener noreferrer"` (karena `HTML.TargetBlank=true`)

**File diubah:**
- `app/Filament/Resources/Articles/Schemas/ArticleForm.php` — ✅ `dehydrateStateUsing` + import `ContentSanitizer`
- `tests/Feature/ContentSanitizerTest.php` — ✅ Baru, 5 test unit sanitasi

**Catatan:** Test memakai `Tests\TestCase` (bukan `PHPUnit\Framework\TestCase`) karena `\Purifier` facade butuh aplikasi Laravel ter-boot. Letakkan di `tests/Feature/`.

---

### 🐛 Fix SEO — Meta & OG Description DetailBerita (17 Agustus 2026)

**Masalah di `app/Livewire/DetailBerita.php`:**
- `metaDescription` diisi `$article->title` (judul), bukan ringkasan artikel
- `ogDescription` diisi string kosong `''` → `@filled('')` = false di `blank.blade.php` → tag **og:description & twitter:description tidak dirender sama sekali**

**Solusi:** Method baru `resolveMetaDescription(Article $article)` dengan prioritas:
1. `meta_description` (SEO dari admin) → 160 char
2. `summary` (ringkasan artikel) → 160 char
3. `content` (strip tags) → 160 char
4. Judul artikel (fallback terakhir)

`ogDescription` sekarang memakai nilai yang sama dengan `metaDescription` → tag OG/Twitter description kembali dirender.

**File diubah:**
- `app/Livewire/DetailBerita.php` — method `resolveMetaDescription()` + update layout data
- `tests/Feature/DetailBeritaMetaDescriptionTest.php` — ✅ Baru, 5 test (summary, truncate 160, fallback content, prefer SEO, fallback title)

---

### 🧹 Bersihkan Duplikasi Admin Berita — Pakai Filament Saja (17 Agustus 2026)

**Masalah:** Ada 2 UI kelola berita: Livewire `AdminBerita` (`/admin/berita`) dan Filament `ArticleResource` (`/admin/articles`). Duplikasi membingungkan & bikin 2 jalur logic berbeda.

**Solusi:** Hapus UI Livewire lama, pertahankan Filament.

**File dihapus:**
- `app/Livewire/Admin/AdminBerita.php` + direktori `app/Livewire/Admin/` — Livewire component lama
- `resources/views/admin/berita.blade.php` + direktori `resources/views/admin/`
- `resources/views/livewire/admin/berita.blade.php` + direktori `resources/views/livewire/admin/`

**File diubah:**
- `routes/web.php` — hapus `Route::view('admin/berita', ...)` + unused import `AdminBerita`
- `resources/views/layouts/app/header.blade.php` — link "Artikel Berita" → `route('filament.admin.resources.articles.index')` (tanpa `wire:navigate` karena Filament panel terpisah)
- `resources/views/layouts/app/sidebar.blade.php` — sama

**Catatan:** `ArticleService` **tetap dipertahankan** karena masih dipakai `app:publish-scheduled-articles` command. `ContentSanitizer` tetap dipakai `ArticleService` + `ArticleForm`.

---

### 🔄 Smooth Scroll Anchor — Vanilla JS ke Alpine (17 Agustus 2026)

**File:** `resources/views/livewire/home-page.blade.php`

**Masalah:** Smooth scroll untuk anchor `#berita` (hero button & CTA "Jelajahi Berita") pakai vanilla JS di `@push('scripts')` yang **tidak SPA-safe** — tidak jalan ulang setelah `wire:navigate` (pola yang sama seperti navbar & hero carousel yang sudah dikonversi).

**Solusi:** Konversi ke Alpine.js di root div:
- `x-data` dengan method `smoothScrollTo(event)`
- Event delegation via `@click="smoothScrollTo"` — cek `event.target.closest('a[href^="#"]')`, scroll ke target jika ada
- Hapus blok `@push('scripts')` vanilla JS sepenuhnya

**Kenapa event delegation:** Handler di root div menangkap semua klik `a[href^="#"]` dalam satu tempat — SPA-safe karena Alpine re-init setiap render, dan tidak perlu bind per-anchor.

**File diubah:**
- `resources/views/livewire/home-page.blade.php` — ✅ Alpine `x-data` + `@click`, hapus vanilla JS
- `tests/Feature/HomePageRenderTest.php` — ✅ Baru, verifikasi halaman render + Alpine hadir + vanilla JS hilang

---

### 🧹 Cleanup `@push('scripts')` Kosong di Semua Halaman (17 Agustus 2026)

**Masalah:** Setelah konversi navbar/hero/smooth-scroll ke Alpine, 6 halaman masih menyisakan blok `@push('scripts')` yang **kosong** (hanya komentar placeholder "Page-specific scripts here") — tidak ada vanilla JS yang benar-benar berfungsi.

**Solusi:** Hapus semua blok kosong tersebut:
- `resources/views/livewire/all-berita.blade.php`
- `resources/views/livewire/daftar-pengajar.blade.php`
- `resources/views/livewire/detail-berita.blade.php`
- `resources/views/livewire/fasilitas-sekolah.blade.php`
- `resources/views/livewire/kontak-page.blade.php`
- `resources/views/livewire/tentang-page.blade.php`

**Hasil:** Seluruh `resources/views` kini **bebas vanilla JS** — tidak ada `@push('scripts')`, `addEventListener`, `querySelectorAll`, `getElementById`, atau `onclick=` inline. Semua interaktivitas ditangani Alpine (`x-data`) atau Livewire (`wire:navigate`, `wire:click`).

**Catatan:** Satu-satunya inline handler tersisa adalah `onerror="this.parentElement.classList.add('img-error')"` di home-page (fallback gambar Instagram) — itu aman karena di-render ulang server-side tiap Livewire render, jadi SPA-safe.

**File diubah:** 6 blade dihapus blok kosongnya + `tests/Feature/PublicPagesRenderTest.php` (baru, 2 test: semua halaman render OK + tidak ada `@push('scripts')` tersisa).

---

### 🐛 Fix: SyntaxError Alpine bikin SPA Navigate Gagal di Home (17 Agustus 2026)

**Gejala:** Navbar masih full reload meskipun semua link sudah `wire:navigate`.

**Diagnosis (via Chrome CDP headless):**
- `x-data` smoothScrollTo versi awal memakai selector `'a[href^=\"#\"]'` — mengandung `\"` di dalam atribut HTML yang dibatasi `"`, sehingga **memecah parsing atribut** → `SyntaxError: Invalid or unexpected token` di Alpine `safeAsyncFunction`
- Akibatnya Alpine gagal compile ekspresi di home page → `x-navigate` (plugin Alpine yang dipakai Livewire 4 untuk SPA) tidak ter-bind → **full reload**

**Solusi:** Hindari quote ganda di dalam `x-data`. Logika di-refactor: cek `anchor.getAttribute('href')` lalu `href.startsWith('#')` — tanpa selector string yang mengandung `"`:
```html
const anchor = event.target.closest('a');
if (!anchor) return;
const href = anchor.getAttribute('href') ?? '';
if (!href.startsWith('#')) return;
```

**Verifikasi browser (Chrome headless, viewport 1280x800):**
- ✅ JS errors di home: `[]` — SyntaxError hilang
- ✅ Alpine x-data processed: 4 — ekspresi ter-compile benar
- ✅ SPA navigate JALAN: event `alpine:navigate` + `livewire:navigate` fire, request `/berita` dengan header `X-LiveWire-Navigate`

**Pelajaran penting:**
- Livewire 4 menerjemahkan `wire:navigate` → `x-navigate` (Alpine plugin). Error JS apapun di halaman bisa memblokir SPA navigation.
- Jangan pernah taruh `"` (atau `\"`) di dalam atribut HTML yang dibatasi `"` — pakai single quote di dalamnya.
- Di Livewire 4, `Alpine.navigate()` tersedia, tapi saat `window.livewireScriptConfig` ter-set, `Livewire.start()` tidak otomatis dipanggil (harus dari app.js).

---

### 🎨 Konsolidasi CSS Per-Halaman → Global (17 Agustus 2026) — Fix Geter SPA Navigate

**Gejala:** Navbar SPA sudah jalan (tanpa reload) tapi perpindahan antar link **geter/jittery**.

**Diagnosis (via Chrome CDP + diff hash style tag):**
- Setiap halaman push `<style>` per-halaman via `@push('styles')` — total 11 blok / 2.251 baris CSS
- Livewire SPA **memindahkan `<style>` ke `<body>`** dan **men-swap blok per-halaman tiap navigasi**: home → /berita = −13.241 bytes +3.419 bytes CSS di-swap di tengah navigasi
- Browser harus re-parse & re-apply CSS → reflow seluruh layout → geter

**Solusi: Konsolidasi semua CSS ke `resources/css/public.css` (di-import Vite):**
1. Navbar / footer / whatsapp-float → **global unscoped** (identik di semua halaman)
2. CSS per-halaman → **di-scope di bawah class root unik** (`.page-home`, `.page-berita`, `.page-pengajar`, `.page-detail-*`, `.page-fasilitas`, `.page-kontak`, `.page-tentang`)
3. Setiap blade diberi class root (`<div class="page-xxx">`)
4. Semua blok `@push('styles')` / `<style>` inline **dihapus** dari 11 file

**Kenapa harus di-scope (bukan digabung polos):** Ada selector konflik antar halaman — `.carousel-dots` (home bottom:40px vs fasilitas bottom:10px), `.page-header h1`, `.section`, `.empty-state` (padding 60px vs 80px), `.teacher-grid`, `.facility-card` — menggabung polos akan merusak salah satu halaman. Scoping menyelesaikan konflik: `.page-pengajar .empty-state` = 60px, `.page-fasilitas .empty-state` = 80px (terverifikasi di browser).

**Parser CSS custom** (`scope_css`) menangani: selector multi-baris, rule satu-baris (`sel { props }`), `@media` nesting, komentar, dan `body { background }` di home → `.page-home`.

**Verifikasi:**
- ✅ **Style swap hilang total**: 6 style tags (27KB, 13KB di-swap) → 2 tags Livewire (3.2KB, **0 bytes di-swap**)
- ✅ **338 rule ter-preserve 100%** (9 halaman, cocok 1:1)
- ✅ Konflik `.empty-state` terselesaikan benar di browser
- ✅ Semua halaman render OK, 0 JS errors, build sukses, test lulus

**Bonus:** CSS sekarang satu file ter-cache (gzip 38KB) → first paint juga lebih cepat.

---

### 🚫 Hilangkan "Pop Up" Navigasi SPA (17 Agustus 2026)

**Keluhan user:** navigasi SPA masih ada "kejutan / pop up" — bar biru di atas layar + kartu yang muncul-muncul tiap pindah halaman.

**Penyebab:**
1. **Progress bar Livewire (nprogress)** — `config/livewire.php` (belum di-publish) default `show_progress_bar => true` dengan warna biru `#2299dd` → bar biru pop up di atas layar setiap `wire:navigate`
2. **Animasi `animate-fade-up` / `animate-delay-N`** (32 kemunculan di 8 halaman) — re-trigger setiap SPA navigate → elemen slide-up 30px = "pop up pop up"

**Perbaikan:**
1. **Publish & edit `config/livewire.php`**: `'navigate' => ['show_progress_bar' => false, 'progress_bar_color' => '#10b981']` → Livewire render `data-no-progress-bar`, bar hilang total
2. **`blank.blade.php`**: tambah wrapper `<div class="page-shell">` + script `data-navigate-once` yang dengar `livewire:navigating`/`livewire:navigated` → halaman baru **fade-in halus (280ms)**. Guard `navigating` flag supaya first load TIDAK fade (hindari flash)
3. **Hapus semua `animate-fade-up`/`animate-delay-N`** (32 kemunculan + 1 dinamis Blade di kontak-page) + bersihkan CSS-nya dari `app.css`
4. **`html { scroll-behavior: smooth }`** di app.css → scroll-to-top saat navigate jadi mulus
5. **Update `HomePageRenderTest`** — assertion lama `assertStringNotContainsString('addEventListener')` sudah basi (script transisi memang pakai addEventListener); diganti cek `page-shell` + `livewire:navigated` + pola lama `a[href^="#"]` hilang

**Verifikasi browser:** progress bar `#nprogress` tidak ada di semua halaman, `.page-fade-in` terpasang setelah navigate, `fadeAnimCount: 0` (tanpa pop up), first load tanpa fade. Semua 13 test lulus.

**Jawaban untuk user:**
- **Tailwind?** — Ya, Tailwind v4 terpasang & dipakai (admin/Flux + app.css `@import 'tailwindcss'`), TAPI halaman publik dibuat dengan **CSS custom handwritten** (2.251 baris di `resources/css/public.css`), bukan utility class Tailwind. Konsolidasi ke Tailwind penuh = pekerjaan besar tersendiri.
- **Navbar komponen?** — **Sudah**: `resources/views/components/public/navbar.blade.php`, dipakai semua halaman via `<x-public.navbar />`.

---

### 🎨 Konversi Penuh Halaman Publik → Tailwind Utilities (17 Agustus 2026)

**Permintaan user:** Konversi penuh semua halaman publik ke utility class Tailwind (bukan CSS custom handwritten), dan hapus semua animasi pop-up yang merusak.

**Yang dikonversi ke Tailwind penuh (9 halaman + 3 komponen):**
- `components/public/navbar.blade.php` (fixed, backdrop-blur, active link underline `after:`)
- `components/public/footer.blade.php`
- `components/whatsapp-float.blade.php`
- `livewire/home-page.blade.php` (hero, berita terbaru, CTA)
- `livewire/all-berita.blade.php` + `detail-berita.blade.php`
- `livewire/daftar-pengajar.blade.php` + `detail-teacher.blade.php`
- `livewire/fasilitas-sekolah.blade.php` + `detail-fasilitas.blade.php` (carousel/gallery Alpine + `@js()` utk images)
- `livewire/kontak-page.blade.php` + `tentang-page.blade.php`
- `vendor/pagination/tailwind.blade.php` (di-publish, kotak emerald 40px)

**File CSS custom dihapus total:**
- ❌ `resources/css/public.css` (2.251 baris) — **dihapus** + import-nya dari `app.css`
- ❌ Blok "PUBLIC SITE — SHARED STYLES" (berita-card, page-header, cta-section, dll.) dari `app.css`
- ✅ `app.css` kini hanya: Tailwind import + Flux + base minimal (`body` font Inter/bg #f9fafb, `[x-cloak]`, `html { scroll-behavior: smooth }`, `@keyframes page-fade-in` + `.page-fade-in` — dipindah dari public.css karena dipakai `blank.blade.php` SPA transition)
- Class root `.page-*` di blade juga dihapus (tidak perlu scoping lagi)

**Pola yang dipakai:**
- Header: `bg-gradient-to-br from-emerald-950 via-emerald-800 to-emerald-600` + `pt-[120px] pb-[50px]` + pattern `before:bg-[radial-gradient(...)]`
- Kartu: `rounded-2xl border border-emerald-500/10 bg-white shadow-[0_1px_3px_rgba(0,0,0,0.04)] hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(22,163,74,0.12)]`
- Alpine carousel state: `images: @js($images)` (bukan `{{ json_encode($images) }}` — `@js` escape aman di atribut `x-data` ber-quote ganda)
- Rich content: `[&_p]:mb-4` arbitrary variants utk styling isi dari DB

**Bonus fix:** `@filled(...)` di `blank.blade.php` **bukan directive Blade yang valid** → teks literal `@filled($ogDescription)` bocor ke body (browser re-parent stray head text). Diganti `@if (filled(...))`. Terverifikasi bodyText bersih.

**Verifikasi:**
- ✅ Build sukses (CSS 284.97 kB / gzip 37.83 kB — masih termasuk Flux+Filament)
- ✅ **Pixel diff vs baseline** (screenshot Chrome headless, threshold >30 RGB): home 0.73%, berita 2.00%, fasilitas 0.72%, pengajar 3.68%, kontak 0.72%, tentang 0.73% — desain tetap sama
- ✅ SPA navigate: URL berubah tanpa reload, style tags identik sebelum/sesudah (0 swap), `page-fade-in` aktif, 0 JS errors
- ✅ `php artisan view:cache` OK, semua test render lulus
- ⚠️ Test Auth (Authentication/PasswordReset/Registration/TwoFactor) gagal **419 CSRF** — **pre-existing** (terbukti gagal juga di tree bersih via `git stash`), bukan dari perubahan ini

---

### 🔒 Navbar & Footer PERSISTEN — Tidak Pernah Dibuat Ulang Saat SPA Navigate (17 Agustus 2026)

**Permintaan user:** Buat navbar/footer benar-benar persisten — tidak pernah di-render ulang saat `wire:navigate` (sebelumnya identity DOM berubah tiap navigasi karena berada di dalam `$slot` tiap halaman).

**Mekanisme resmi Livewire: `x-persist`** (di vendor `livewire.js` → `js/plugins/navigate/persist.js`, `enablePersist = true` default):
- Sebelum swap body: elemen `[x-persist]` disimpan (`storePersistantElementsForLater`) + di-remove dari DOM
- Setelah `document.body.replaceWith(newBody)`: elemen lama dikembalikan (`putPersistantElementsBack`) menggantikan stub baru → **identity DOM + state Alpine dipertahankan**

**Perubahan:**
1. **`blank.blade.php`**: `<x-public.navbar />` dipindah ke atas `$slot`, `<x-public.footer />` ke bawah — keduanya di luar konten halaman
2. **`navbar.blade.php`**: tambah `x-persist="navbar"`; link aktif **tidak lagi `request()->is()`** (server-side, basi karena navbar tak pernah re-render) → **Alpine**: state `path: window.location.pathname` + listener `livewire:navigated` update path + method `isActive(prefix)` → `:class="isActive('/berita') ? 'text-emerald-600 after:scale-x-100' : 'text-gray-500'"`
3. **`footer.blade.php`**: `x-persist="footer"`; **`whatsapp-float`**: `x-persist="whatsapp-float"` (konsisten, juga tak pernah dibuat ulang)
4. **9 halaman publik**: hapus `<x-public.navbar />` dan `<x-public.footer />` dari blade (sekarang dari layout)

**Verifikasi browser (Chrome CDP):**
- ✅ `navSame/footerSame/waSame = true` di 5 navigasi berurutan (home → berita → fasilitas → kontak → home) — identity DOM dipertahankan 100%
- ✅ Link aktif benar di semua halaman: `/berita`→Berita, `/fasilitas`→Fasilitas, `/tentang`→Tentang, `/kontak`→Kontak, `/profile/pengajar`→Pengajar+parent Profile, `/`→Beranda
- ✅ Mobile menu tetap jalan (x-cloak + Alpine state dipertahankan)
- ✅ 0 JS errors; SPA tetap tanpa reload; 15 test lulus
- ✅ **Pixel-perfect vs state Tailwind sebelumnya: 0.00% diff** (pembuktian via backup/restore + git — hati-hati: `git stash` mengembalikan ke HEAD CSS custom lama, bukan state Tailwind; perbandingan valid harus pakai snapshot file aktual)

**Pelajaran:** `x-persist` = cara resmi Livewire untuk elemen persisten lintas navigasi (state Alpine ikut dipertahankan). Link aktif di elemen persisten WAJIB dihitung client-side (Alpine + `livewire:navigated`), bukan server-side.

---

### 📝 README.md Profesional — Dokumentasi Lengkap Project (17 Agustus 2026)

**Permintaan user:** Perbaiki `README.md` (sebelumnya hanya `# beritappsr`) jadi profesional & lengkap — alur aplikasi, framework, tools, semuanya.

**Isi README baru (`README.md`, ~300 baris):**
- Header + daftar isi (12 section)
- Fitur utama: 9 halaman publik SPA + panel admin Filament (10 resources) + keamanan
- Tabel teknologi: PHP ^8.3, Laravel ^13, Livewire ^4.1, Filament ^5, Fortify, Flux, mews/purifier, Tailwind v4, Alpine ^3, Vite ^8, TipTap, MySQL, Sail
- Struktur project (pohon direktori lengkap)
- Persiapan & instalasi (prasyarat + langkah) + menjalankan dev/prod
- **Alur aplikasi 3 bagian**: alur publik, alur admin (ArticleService publish/schedule), alur SPA navigate (x-persist + fade-in)
- Database & model (9 tabel utama + konvensi)
- Keamanan (XSS/CSRF/2FA), testing (6 test), command sering dipakai, lisensi

**Verifikasi akurasi:** route publik (`/`, `/berita`, `/fasilitas`, `/profile/*`, `/tentang`, `/kontak`), nama tabel (`contact_whatsapp_numbers`), versi dependency dari `composer.json`/`package.json`, dan struktur Filament (`/admin`, `Color::Amber`) — semua dicek terhadap kode aktual.

---

### 🔗 Semua Tombol Publik SPA — Kembali, Pagination, Hero Button (17 Agustus 2026)

**Permintaan user:** Cari semua tombol/link di halaman publik yang belum SPA (`wire:navigate`), buatkan SPA semua — tanpa mengubah kode lain yang sudah berjalan baik.

**Temuan & perubahan:**
1. **Tombol "Kembali" di `detail-berita`** — belum SPA → sekarang `wire:navigate` + conditional Blade:
   ```blade
   @if (str_starts_with(url()->previous(), url('/')))
       <a href="{{ url()->previous() }}" wire:navigate ...>Kembali</a>
   @else
       <a href="{{ route('berita') }}" wire:navigate ...>Kembali</a>
   @endif
   ```
   Guard penting: `wire:navigate` meng-intercept SEMUA klik termasuk URL eksternal — jika `previous()` dari luar domain, fallback ke `/berita`.
2. **Pagination di `all-berita`** — ternyata Livewire memakai **view pagination MILIKNYA sendiri** (`livewire::tailwind`), bukan view Laravel yang di-publish!
   - ⚠️ **Pelajaran penting:** view `resources/views/vendor/pagination/tailwind.blade.php` (Laravel) **TIDAK dipakai** saat komponen pakai `WithPagination` — Livewire override via `Paginator::defaultView('livewire::tailwind')`.
   - Solusi: `php artisan vendor:publish --tag=livewire:pagination` → edit `resources/views/vendor/livewire/tailwind.blade.php` → gaya emerald konsisten (kotak `h-10 min-w-10 rounded-xl`, aktif `bg-emerald-600`, hover `hover:border-emerald-600`) + `wire:click` (AJAX Livewire, sudah tanpa reload).
   - **Hapus** `resources/views/vendor/pagination/` (dead code — view Laravel yang tidak pernah dipakai).
3. **Hero button di `home-page`** (`button_url` dari settings) — conditional: URL internal → `wire:navigate`, eksternal → link biasa, `#berita` → anchor smooth-scroll (jangan diubah).

**Yang sengaja TIDAK diubah:** anchor `#berita` (smooth-scroll), link eksternal (`target="_blank"`, Instagram, share, domain luar), navbar/footer (sudah SPA + `x-persist`).

**Verifikasi browser nyata (CDP):**
- ✅ Pagination `/berita?page=2`: 3 tombol `wire:click`, aktif emerald "2", klik "1" → URL `?page=1` tanpa reload, konten berganti
- ✅ Tombol Kembali: `wire:navigate` terpasang, href benar
- ✅ 15 test lulus (hanya 9 Auth CSRF 419 pre-existing yang gagal — sudah dibuktikan di tree bersih)
- ✅ Build sukses (CSS gzip 37.85 kB)

---

*Terakhir diperbarui: 17 Agustus 2026*
