<div align="center">

# 🌿 Portal Berita & Profil — Pondok Pesantren Syafa'aturrasul

**Website resmi Pondok Pesantren Syafa'aturrasul Kuantan Singingi (Ponpes Kuansing)**

Berita terkini, profil pimpinan & pengajar, fasilitas sekolah, jadwal pelajaran, informasi kontak, dan halaman profil lengkap pesantren — dalam satu aplikasi web modern berbasis **Laravel + Livewire + Filament + Tailwind CSS**.

</div>

---

## 📖 Daftar Isi

- [✨ Fitur Utama](#-fitur-utama)
- [🛠️ Teknologi & Tools](#️-teknologi--tools)
- [📂 Struktur Project](#-struktur-project)
- [⚙️ Persiapan & Instalasi](#️-persiapan--instalasi)
- [🚀 Menjalankan Project](#-menjalankan-project)
- [🏗️ Alur Aplikasi (Architecture Flow)](#️-alur-aplikasi-architecture-flow)
  - [1. Alur Publik (Pengunjung)](#1-alur-publik-pengunjung)
  - [2. Alur Admin (Filament)](#2-alur-admin-filament)
  - [3. Alur SPA Navigation (Livewire Navigate)](#3-alur-spa-navigation-livewire-navigate)
- [🗄️ Database & Model](#️-database--model)
- [🔒 Keamanan](#-keamanan)
- [🧪 Testing](#-testing)
- [🧰 Command yang Sering Dipakai](#-command-yang-sering-dipakai)
- [📜 Lisensi](#-lisensi)

---

## ✨ Fitur Utama

### 🌐 Halaman Publik (SPA — tanpa reload)

| Halaman | Route | Keterangan |
|---|---|---|
| Beranda | `/` | Hero carousel, berita terbaru, CTA |
| Berita | `/berita` | Daftar artikel + pencarian + pagination |
| Detail Berita | `/berita/{slug}` | Isi artikel lengkap + SEO meta |
| Pimpinan & Pengajar | `/profile/pimpinan`, `/profile/pengajar` | Daftar guru/pimpinan per kategori |
| Detail Profil | `/profile/{kategori}/{slug}` | Bio lengkap + foto + profil terkait |
| Fasilitas | `/fasilitas` | Grid fasilitas + galeri gambar (carousel) |
| Detail Fasilitas | `/fasilitas/{slug}` | Galeri + thumbnails + fasilitas terkait |
| Tentang | `/tentang` | Deskripsi, visi & misi, sejarah |
| Kontak | `/kontak` | Kartu WhatsApp + Google Maps embed |

**Perilaku SPA:**
- Navigasi antar halaman via `wire:navigate` — **tanpa reload penuh**
- Navbar, footer & tombol WhatsApp **persisten** (`x-persist`) — hanya dirender sekali
- Transisi fade-in halus antar halaman
- Tidak ada progress bar / animasi pop-up yang mengganggu

### 🔐 Panel Admin (Filament)

Akses di **`/admin`** — CRUD lengkap berbasis Filament v5:

| Resource | Fungsi |
|---|---|
| **Articles** | Kelola berita (draft/publish/archive), penjadwalan, SEO meta, editor rich-text TipTap |
| **Teachers** | Data pimpinan, guru & pembina asrama |
| **School Facilities** | Fasilitas sekolah + galeri multi-gambar |
| **Hero Sections** | Slideshow hero beranda |
| **Lesson Schedules** | Jadwal pelajaran |
| **Instagram Settings** | Konfigurasi feed Instagram |
| **Contact / WhatsApp / Maps** | Nomor WhatsApp, alamat, embed Google Maps |
| **About Settings** | Deskripsi, visi-misi, sejarah pesantren |
| **Users** | Manajemen pengguna admin |

### 🛡️ Keamanan

- **XSS Protection** — konten HTML di-sanitasi dengan **HTML Purifier** (`mews/purifier`) sebelum disimpan/ditampilkan
- Autentikasi bawaan Laravel (starter kit) + **Fortify** (2FA, verifikasi email)
- Route admin dilindungi middleware `auth` + `verified`
- Output HTML user-generated di-escape dengan `e()` / di-sanitasi via `ContentSanitizer`

---

## 🛠️ Teknologi & Tools

### Backend

| Tools | Versi | Kegunaan |
|---|---|---|
| **PHP** | ^8.3 | Bahasa pemrograman |
| **Laravel** | ^13.0 | Framework backend (MVC, Eloquent, Blade) |
| **Livewire** | ^4.1 | Komponen interaktif + SPA mode (`wire:navigate`) |
| **Filament** | ^5.0 | Panel admin (CRUD otomatis) |
| **Laravel Fortify** | ^1.34 | Autentikasi (login, 2FA, verifikasi email) |
| **Livewire Flux** | ^2.12 | Komponen UI (button, form, dsb.) |
| **mews/purifier** | ^3.4 | Sanitasi HTML (anti-XSS) |
| **Laravel Pint** | ^1.27 | Code formatter (dev) |
| **PHPUnit** | ^12.5 | Testing (dev) |

### Frontend

| Tools | Versi | Kegunaan |
|---|---|---|
| **Tailwind CSS** | v4 | Utility CSS untuk seluruh UI (publik + admin) |
| **Alpine.js** | ^3 | Interaktivitas ringan (carousel, menu mobile, state) |
| **Vite** | ^8 | Build tool & dev server (HMR) |
| **@tailwindcss/vite** | — | Plugin Tailwind untuk Vite |
| **TipTap** | — | Rich-text editor (digunakan Filament untuk artikel) |

### Lainnya

| Tools | Kegunaan |
|---|---|
| **MySQL** | Database utama |
| **Composer** | Manajemen dependency PHP |
| **NPM / Node** | Manajemen dependency frontend |
| **Laravel Sail** (dev) | Docker environment (opsional) |

---

## 📂 Struktur Project

```
beritappsr/
├── app/
│   ├── Filament/                    # Panel admin
│   │   └── Resources/               # 10+ CRUD resources
│   │       ├── Articles/            #   Kelola berita
│   │       ├── Teachers/            #   Pimpinan & pengajar
│   │       ├── SchoolFacilities/    #   Fasilitas
│   │       └── ...                  #   Hero, jadwal, kontak, dsb.
│   ├── Livewire/                    # Komponen halaman publik
│   │   ├── HomePage.php             #   Beranda
│   │   ├── AllBerita.php            #   Daftar berita (search + paginate)
│   │   ├── DetailBerita.php         #   Detail artikel
│   │   ├── DaftarPengajar.php       #   Pimpinan / pengajar
│   │   ├── DetailTeacher.php        #   Detail profil
│   │   ├── FasilitasSekolah.php     #   Fasilitas
│   │   ├── DetailFasilitas.php      #   Detail fasilitas (galeri)
│   │   ├── KontakPage.php           #   Kontak
│   │   └── TentangPage.php          #   Tentang
│   ├── Models/                      # Eloquent models
│   │   ├── Article.php
│   │   ├── Teacher.php
│   │   ├── SchoolFacility.php
│   │   ├── HeroSection.php
│   │   ├── LessonSchedule.php
│   │   ├── ContactWhatsapp.php
│   │   ├── MapsSetting.php
│   │   ├── AboutSetting.php
│   │   ├── InstagramSetting.php
│   │   └── User.php
│   ├── Providers/                   # Service providers (Filament panel dll.)
│   └── Services/                    # Business logic
│       ├── ArticleService.php       #   CRUD & publish artikel
│       ├── ContentSanitizer.php     #   Sanitasi HTML (anti-XSS)
│       └── InstagramService.php     #   Ambil & cache feed Instagram
├── config/
│   ├── purifier.php                 # Konfigurasi HTML Purifier
│   └── livewire.php                 # Konfigurasi Livewire (progress bar off)
├── database/
│   └── migrations/                  # 15+ migrasi skema database
├── public/
│   └── build/                       # Hasil build Vite (assets)
├── resources/
│   ├── css/
│   │   └── app.css                  # Tailwind + base styles
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── blank.blade.php      # Layout publik (navbar/footer persist)
│   │   │   ├── app.blade.php        # Layout autentikasi (dashboard)
│   │   │   └── auth.blade.php       # Layout halaman login
│   │   ├── components/
│   │   │   ├── public/              #   navbar, footer (persisten)
│   │   │   └── whatsapp-float.blade.php
│   │   └── livewire/                # Blade tiap halaman publik
├── routes/
│   └── web.php                      # Definisi semua route
├── tests/
│   ├── Feature/                     # Test render halaman, sanitizer, SEO
│   └── Unit/
├── composer.json
├── package.json
└── vite.config.js
```

---

## ⚙️ Persiapan & Instalasi

### Prasyarat

- **PHP** ≥ 8.3 (dengan ekstensi: `pdo_mysql`, `mbstring`, `xml`, `gd`, `fileinfo`)
- **Composer** ≥ 2.x
- **Node.js** ≥ 20 (disarankan 22+) & **NPM**
- **MySQL** ≥ 8.0 (atau MariaDB ≥ 10.4)

### Langkah Instalasi

```bash
# 1. Clone repository
git clone <url-repository> beritappsr
cd beritappsr

# 2. Install dependency PHP & frontend
composer install
npm install

# 3. Siapkan environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di .env
#    DB_CONNECTION=mysql
#    DB_HOST=127.0.0.1
#    DB_PORT=3306
#    DB_DATABASE=beritappsr
#    DB_USERNAME=root
#    DB_PASSWORD=your_password

# 5. Jalankan migrasi
php artisan migrate

# 6. (Opsional) Buat user admin
#    Jalankan aplikasi lalu register via /register, atau:
#    php artisan tinker --execute="App\Models\User::create(['name'=>'Admin','email'=>'admin@example.com','password'=>bcrypt('password')])"

# 7. Publish storage link (untuk upload gambar)
php artisan storage:link
```

> ⚠️ **Catatan:** Jika menggunakan email verifikasi, pastikan mailer sudah dikonfigurasi di `.env` (`MAIL_MAILER`, dll.) atau nonaktifkan sementara dengan `APP_ENV=local` + `MAIL_MAILER=log`.

---

## 🚀 Menjalankan Project

### Development (dengan hot-reload)

```bash
# Terminal 1 — server Laravel
php artisan serve
# → http://127.0.0.1:8000

# Terminal 2 — Vite dev server (HMR untuk CSS/JS)
npm run dev
```

### Production

```bash
# 1. Build assets
npm run build

# 2. Optimasi
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Jalankan (via web server / artisan)
php artisan serve
```

---

## 🏗️ Alur Aplikasi (Architecture Flow)

### 1. Alur Publik (Pengunjung)

```
Browser
  │
  ├─ GET /                     → Livewire HomePage → Blade home-page
  ├─ GET /berita               → Livewire AllBerita → query articles
  │                              (search + paginate 9/halaman)
  ├─ GET /berita/{slug}        → Livewire DetailBerita → tampil artikel + SEO
  ├─ GET /fasilitas            → Livewire FasilitasSekolah → grid + carousel
  └─ ... (route lain)
        │
        ▼
   layouts/blank.blade.php
        │
        ├─ <x-public.navbar />   ← persisten (x-persist)
        ├─ {{ $slot }}           ← konten halaman (Livewire)
        ├─ <x-public.footer />   ← persisten (x-persist)
        └─ <x-whatsapp-float />  ← persisten
```

**Alur request detail:**

1. Browser meminta route (mis. `/berita`)
2. `routes/web.php` memetakan ke Livewire component (`AllBerita`)
3. Livewire component query database via Eloquent (eager loading `with('author')`, pagination)
4. View Blade (`livewire/all-berita.blade.php`) di-render di dalam layout `blank`
5. Layout menambahkan navbar/footer/SEO meta/JSON-LD
6. HTML dikirim ke browser; interaktivitas (search, pagination, carousel) ditangani Livewire/Alpine tanpa reload

### 2. Alur Admin (Filament)

```
Admin login di /admin
        │
        ▼
   Filament Panel (auth + verified)
        │
        ├─ Articles        → create/update → ArticleService → sanitize → DB
        ├─ Teachers        → CRUD langsung → tabel teachers
        ├─ Hero Sections   → CRUD → slideshow beranda
        └─ ... (resource lain)
        │
        ▼
   Halaman publik otomatis ter-update (tanpa deploy ulang)
```

**Alur publish artikel (via `ArticleService`):**

1. Admin menulis artikel di Filament (editor TipTap)
2. `ContentSanitizer` membersihkan HTML (hapus tag/atribut berbahaya)
3. Artikel disimpan dengan status `draft` / `published`
4. Jika `scheduled_at` diisi → artikel otomatis publish oleh scheduler
5. Artikel `published` + `published_at` terisi → muncul di halaman publik

### 3. Alur SPA Navigation (Livewire Navigate)

```
Klik link navbar (wire:navigate)
        │
        ▼
   Livewire fetch halaman baru (AJAX, header X-LiveWire-Navigate)
        │
        ▼
   Body di-swap via morph; head (CSS) TIDAK di-sentuh → tanpa reflow
        │
        ▼
   Elemen [x-persist] (navbar/footer/whatsapp) dipertahankan
        │
        ▼
   Link aktif di-update via Alpine (livewire:navigated)
        │
        ▼
   Fade-in halus pada konten baru (280ms)
```

**Kenapa terasa mulus?**
- Semua CSS terkonsolidasi dalam **satu file statis** (Vite build) → tidak ada style swap per halaman
- Navbar/footer persisten → browser tidak pernah membuat ulang elemen itu
- Progress bar & animasi pop-up dihilangkan
- Scroll-to-top halus (`scroll-behavior: smooth`)

---

## 🗄️ Database & Model

| Tabel | Model | Isi Utama |
|---|---|---|
| `articles` | `Article` | Judul, slug, konten, summary, gambar, status (draft/published/archived), SEO meta, jadwal publish, author |
| `teachers` | `Teacher` | Nama, slug, kategori (pimpinan/guru/pembina_asrama), posisi, foto, bio |
| `school_facilities` | `SchoolFacility` | Nama, slug, deskripsi, galeri gambar (JSON) |
| `hero_sections` | `HeroSection` | Judul, subtitle, gambar, badge, tombol, overlay, urutan |
| `lesson_schedules` | `LessonSchedule` | Jadwal pelajaran |
| `contact_whatsapp_numbers` | `ContactWhatsapp` | Nomor WhatsApp + label + urutan |
| `maps_settings` | `MapsSetting` | Label + embed code Google Maps |
| `about_settings` | `AboutSetting` | Deskripsi, visi, misi, sejarah, gambar |
| `instagram_settings` | `InstagramSetting` | Konfigurasi feed Instagram |
| `users` | `User` | Akun admin (dengan kolom 2FA) |

**Konvensi yang dipakai:**
- Nama tabel `snake_case` jamak, model singular
- Semua tabel punya `timestamps()`
- Relasi memakai `foreignId` + `constrained`
- Query publik memakai **eager loading** (`with()`) untuk hindari N+1

---

## 🔒 Keamanan

| Risiko | Mitigasi |
|---|---|
| **XSS** (konten admin) | `ContentSanitizer` + HTML Purifier — semua HTML di-sanitasi sebelum disimpan & ditampilkan |
| **XSS** (data user) | Blade `{{ }}` otomatis escape; output HTML mentah hanya untuk konten tersanitasi |
| **Akses admin** | Panel Filament di `/admin` dilindungi `auth` + `verified` middleware |
| **CSRF** | Token CSRF bawaan Laravel di semua form |
| **2FA** | Laravel Fortify (two-factor authentication) |

---

## 🧪 Testing

```bash
# Jalankan semua test
php artisan test

# Jalankan test tertentu
php artisan test --filter=PublicPagesRenderTest
php artisan test --filter=ContentSanitizerTest
```

Test yang tersedia:

| Test | Fungsi |
|---|---|
| `PublicPagesRenderTest` | Semua halaman publik render tanpa error, tanpa vanilla JS |
| `HomePageRenderTest` | Beranda render + SPA transition (`page-shell`, `livewire:navigated`) |
| `DetailBeritaMetaDescriptionTest` | SEO meta & OG description detail berita |
| `ContentSanitizerTest` | Sanitasi HTML anti-XSS |
| `DashboardTest` | Dashboard admin |
| `Auth/*` | Login, registrasi, 2FA, reset password |

---

## 🧰 Command yang Sering Dipakai

```bash
# Development
npm run dev            # Vite HMR
php artisan serve      # Server Laravel

# Production build
npm run build          # Build assets produksi

# Database
php artisan migrate    # Jalankan migrasi
php artisan migrate:fresh --seed   # Reset DB (hati-hati!)

# Kualitas kode
vendor/bin/pint       # Format kode otomatis (Laravel Pint)

# Cache & optimasi
php artisan view:cache
php artisan config:cache
php artisan route:cache
```

---

## 📜 Lisensi

Project ini dikembangkan untuk internal Pondok Pesantren Syafa'aturrasul. Dibangun di atas [Laravel](https://laravel.com) (MIT License), [Livewire](https://livewire.laravel.com), dan [Filament](https://filamentphp.com).

---

<div align="center">

**Syafa'aturrasul — Ponpes Kuansing** 🌿
*Pondok Pesantren Syafa'aturrasul, Kuantan Singingi, Riau*

</div>
