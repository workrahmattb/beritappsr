@push('styles')
<style>
    /* ── Shared Footer ── */
    .footer {
        background: #111827;
        padding: 48px 24px 32px;
        color: rgba(255, 255, 255, 0.7);
    }

    .footer-inner {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 40px;
    }

    .footer-brand {
        font-size: 0.9rem;
        line-height: 1.7;
    }

    .footer-brand strong {
        color: white;
        font-size: 1.1rem;
    }

    .footer-col h4 {
        color: white;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .footer-col a {
        display: block;
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        font-size: 0.85rem;
        margin-bottom: 10px;
        transition: color .2s;
    }

    .footer-col a:hover {
        color: #4ade80;
    }

    .footer-bottom {
        max-width: 1200px;
        margin: 32px auto 0;
        padding-top: 24px;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        text-align: center;
        font-size: 0.82rem;
        color: rgba(255, 255, 255, 0.4);
    }

    @media (max-width: 768px) {
        .footer-inner {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 480px) {
        .footer-inner {
            grid-template-columns: 1fr;
        }
    }

    .footer-logo {
        height: 40px;
        width: auto;
    }

    .footer-brand-icon {
        width: 28px;
        height: 28px;
        background: #16a34a;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 14px;
        font-weight: 800;
    }
</style>
@endpush

<footer class="footer">
    <div class="footer-inner">
        <div class="footer-brand">
            <strong style="display:flex;align-items:center;gap:12px;margin-bottom:12px;">
                <img src="{{ asset('gambar/ppsr logo.webp') }}" alt="PPSR Logo" style="height:40px;width:auto;">
            </strong>
            <p>Portal berita resmi dari Pondok Pesantren Syafa'aturrasul. Menyajikan informasi terkini, artikel
                menarik, dan berita terpercaya seputar kegiatan pesantren dan dunia pendidikan Islam.</p>
        </div>
        <div class="footer-col">
            <h4>Menu</h4>
            <a href="/" wire:navigate>Beranda</a>
            <a href="{{ route('profile.pimpinan') }}" wire:navigate>Pimpinan Pondok</a>
            <a href="{{ route('profile.pengajar') }}" wire:navigate>Pengajar</a>
            <a href="{{ route('fasilitas') }}" wire:navigate>Fasilitas</a>
            <a href="/berita" wire:navigate>Berita</a>
        </div>
        <div class="footer-col">
            <h4>Lainnya</h4>
            <a href="#">Kebijakan Privasi</a>
            <a href="#">Syarat & Ketentuan</a>
            <a href="#">FAQ</a>
        </div>
        <div class="footer-col">
            <h4>Kontak</h4>
            <a href="http://wa.me/6285259875754" target="_blank" rel="noopener noreferrer">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline;vertical-align:middle;margin-right:4px;">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
                Call Center WA
            </a>
            <a href="https://www.instagram.com/ponpessyafaaturrasul_official/" target="_blank" rel="noopener noreferrer">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline;vertical-align:middle;margin-right:4px;">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                </svg>
                Instagram
            </a>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; {{ date('Y') }} {{ config('app.name', 'Berita Apps') }}. All rights reserved.
    </div>
</footer>
