<footer x-persist="footer" class="bg-gray-900 px-6 pb-8 pt-12 text-white/70">
    <div class="mx-auto grid max-w-[1200px] grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-[2fr_1fr_1fr_1fr]">
        <div class="text-sm leading-relaxed">
            <strong class="mb-3 flex items-center gap-3 text-lg text-white">
                <img src="{{ asset('gambar/ppsr logo.webp') }}" alt="PPSR Logo" class="h-10 w-auto">
            </strong>
            <p>Portal berita resmi dari Pondok Pesantren Syafa'aturrasul. Menyajikan informasi terkini, artikel
                menarik, dan berita terpercaya seputar kegiatan pesantren dan dunia pendidikan Islam.</p>
        </div>
        <div>
            <h4 class="mb-4 text-sm font-semibold text-white">Menu</h4>
            <a href="/" wire:navigate
                class="mb-2.5 block text-sm text-white/60 no-underline transition-colors hover:text-green-400">Beranda</a>
            <a href="{{ route('profile.pimpinan') }}" wire:navigate
                class="mb-2.5 block text-sm text-white/60 no-underline transition-colors hover:text-green-400">Pimpinan
                Pondok</a>
            <a href="{{ route('profile.pengajar') }}" wire:navigate
                class="mb-2.5 block text-sm text-white/60 no-underline transition-colors hover:text-green-400">Pengajar</a>
            <a href="{{ route('fasilitas') }}" wire:navigate
                class="mb-2.5 block text-sm text-white/60 no-underline transition-colors hover:text-green-400">Fasilitas</a>
            <a href="/berita" wire:navigate
                class="mb-2.5 block text-sm text-white/60 no-underline transition-colors hover:text-green-400">Berita</a>
            <a href="https://lws.syafaaturrasul.com" target="_blank" rel="noopener noreferrer"
                class="mb-2.5 block text-sm font-semibold text-yellow-500 no-underline transition-colors hover:text-yellow-400">Wakaf</a>
        </div>
        <div>
            <h4 class="mb-4 text-sm font-semibold text-white">Lainnya</h4>
            <a href="#" class="mb-2.5 block text-sm text-white/60 no-underline transition-colors hover:text-green-400">Kebijakan
                Privasi</a>
            <a href="#" class="mb-2.5 block text-sm text-white/60 no-underline transition-colors hover:text-green-400">Syarat
                & Ketentuan</a>
            <a href="#" class="mb-2.5 block text-sm text-white/60 no-underline transition-colors hover:text-green-400">FAQ</a>
        </div>
        <div>
            <h4 class="mb-4 text-sm font-semibold text-white">Kontak</h4>
            <a href="http://wa.me/6285259875754" target="_blank" rel="noopener noreferrer"
                class="mb-2.5 block text-sm text-white/60 no-underline transition-colors hover:text-green-400">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="mr-1 inline align-middle">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                </svg>
                Call Center WA
            </a>
            <a href="https://www.instagram.com/ponpessyafaaturrasul_official/" target="_blank" rel="noopener noreferrer"
                class="mb-2.5 block text-sm text-white/60 no-underline transition-colors hover:text-green-400">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="mr-1 inline align-middle">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                </svg>
                Instagram
            </a>
        </div>
    </div>
    <div class="mx-auto mt-8 max-w-[1200px] border-t border-white/10 pt-6 text-center text-[0.82rem] text-white/40">
        &copy; {{ date('Y') }} {{ config('app.name', 'Berita Apps') }}. All rights reserved.
    </div>
</footer>
