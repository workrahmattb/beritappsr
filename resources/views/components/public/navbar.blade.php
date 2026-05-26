@push('styles')
<style>
    /* ── Shared Navbar ── */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 50;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(22, 163, 74, 0.1);
        transition: box-shadow .3s;
    }

    .navbar.scrolled {
        box-shadow: 0 4px 24px rgba(22, 163, 74, 0.08);
    }

    .navbar-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 72px;
    }

    .nav-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        font-weight: 800;
        font-size: 1.25rem;
        color: #16a34a;
        letter-spacing: -0.5px;
    }

    .logo-img {
        height: 40px;
        width: auto;
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 32px;
    }

    .nav-links a {
        text-decoration: none;
        font-size: 0.88rem;
        font-weight: 500;
        color: #6b7280;
        transition: color .2s;
        position: relative;
    }

    .nav-links a::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        right: 0;
        height: 2px;
        background: #16a34a;
        border-radius: 2px;
        transform: scaleX(0);
        transition: transform .2s;
    }

    .nav-links a:hover {
        color: #16a34a;
    }

    .nav-links a:hover::after {
        transform: scaleX(1);
    }

    .nav-links a.active {
        color: #16a34a;
    }

    .nav-links a.active::after {
        transform: scaleX(1);
    }

    /* ── Dropdown ── */
    .nav-dropdown {
        position: relative;
    }

    .nav-dropdown-trigger {
        text-decoration: none;
        font-size: 0.88rem;
        font-weight: 500;
        color: #6b7280;
        cursor: pointer;
        transition: color .2s;
        display: flex;
        align-items: center;
        gap: 4px;
        position: relative;
        background: none;
        border: none;
        font-family: inherit;
        padding: 0;
    }

    .nav-dropdown-trigger::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        right: 0;
        height: 2px;
        background: #16a34a;
        border-radius: 2px;
        transform: scaleX(0);
        transition: transform .2s;
    }

    .nav-dropdown-trigger:hover {
        color: #16a34a;
    }

    .nav-dropdown-trigger:hover::after {
        transform: scaleX(1);
    }

    .nav-dropdown-trigger.active {
        color: #16a34a;
    }

    .nav-dropdown-trigger.active::after {
        transform: scaleX(1);
    }

    .nav-dropdown-arrow {
        transition: transform .2s;
    }

    .nav-dropdown:hover .nav-dropdown-arrow {
        transform: rotate(180deg);
    }

    .nav-dropdown-menu {
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%) translateY(8px);
        background: white;
        border-radius: 12px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        border: 1px solid rgba(22, 163, 74, 0.1);
        min-width: 200px;
        padding: 6px;
        opacity: 0;
        visibility: hidden;
        transition: all .2s;
        z-index: 100;
    }

    .nav-dropdown:hover .nav-dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(4px);
    }

    .nav-dropdown-menu a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        color: #4b5563;
        transition: all .15s;
    }

    .nav-dropdown-menu a:hover {
        background: rgba(22, 163, 74, 0.08);
        color: #16a34a;
    }

    .nav-dropdown-menu a::after {
        display: none;
    }

    .nav-dropdown-menu a.active {
        background: rgba(22, 163, 74, 0.1);
        color: #16a34a;
    }

    .mobile-sub-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #9ca3af;
        padding: 6px 0 2px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .mobile-sub-item {
        padding-left: 16px !important;
    }

    .menu-toggle {
        display: none;
        flex-direction: column;
        gap: 5px;
        cursor: pointer;
        padding: 4px;
        background: transparent;
        border: none;
    }

    .menu-toggle span {
        display: block;
        width: 24px;
        height: 2.5px;
        background: #4b5563;
        border-radius: 4px;
        transition: all .3s;
    }

    .menu-toggle.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }

    .menu-toggle.active span:nth-child(2) {
        opacity: 0;
    }

    .menu-toggle.active span:nth-child(3) {
        transform: rotate(-45deg) translate(5px, -5px);
    }

    .mobile-menu {
        display: none;
        flex-direction: column;
        gap: 4px;
        padding: 0 24px 20px;
        background: white;
        max-width: 1200px;
        margin: 0 auto;
    }

    .mobile-menu.open {
        display: flex;
    }

    .mobile-menu a {
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        color: #4b5563;
        padding: 10px 0;
        transition: color .2s;
    }

    .mobile-menu a:hover,
    .mobile-menu a.active {
        color: #16a34a;
    }

    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }

        .menu-toggle {
            display: flex;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // ── Navbar scroll effect ──
    const navbar = document.getElementById('navbar');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    // ── Mobile menu toggle ──
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            mobileMenu.classList.toggle('open');
        });
    }

    // ── Smooth scroll for anchor links ──
    document.querySelectorAll('#navbar a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endpush

<nav class="navbar" id="navbar">
    <div class="navbar-inner">
        <a href="/" wire:navigate class="nav-logo">
            <img src="{{ asset('gambar/ppsr logo.webp') }}" alt="PPSR Logo" class="logo-img">
        </a>

        <div class="nav-links">
            <a href="/" wire:navigate class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>

            <div class="nav-dropdown">
                <span class="nav-dropdown-trigger {{ request()->is('profile*') ? 'active' : '' }}">
                    Profile
                    <svg class="nav-dropdown-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </span>
                <div class="nav-dropdown-menu">
                    <a href="{{ route('profile.pimpinan') }}" wire:navigate
                        class="{{ request()->routeIs('profile.pimpinan') ? 'active' : '' }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        Pimpinan Pondok
                    </a>
                    <a href="{{ route('profile.pengajar') }}" wire:navigate
                        class="{{ request()->routeIs('profile.pengajar') ? 'active' : '' }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        Pengajar
                    </a>
                </div>
            </div>

            <a href="{{ route('fasilitas') }}" wire:navigate
                class="{{ request()->routeIs('fasilitas') ? 'active' : '' }}">Fasilitas</a>

            <a href="/berita" wire:navigate
                class="{{ request()->is('berita*') && !request()->is('/') ? 'active' : '' }}">Berita</a>

            <a href="#">Tentang</a>
            <a href="#">Kontak</a>
        </div>

        <button class="menu-toggle" id="menuToggle" aria-label="Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <div class="mobile-menu" id="mobileMenu">
        <a href="/" wire:navigate class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
        <div class="mobile-sub-label">Profile</div>
        <a href="{{ route('profile.pimpinan') }}" wire:navigate class="mobile-sub-item">Pimpinan Pondok</a>
        <a href="{{ route('profile.pengajar') }}" wire:navigate class="mobile-sub-item">Pengajar</a>
        <a href="{{ route('fasilitas') }}" wire:navigate
            class="{{ request()->routeIs('fasilitas') ? 'active' : '' }}">Fasilitas</a>
        <a href="/berita" wire:navigate class="{{ request()->is('berita*') && !request()->is('/') ? 'active' : '' }}">Berita</a>
        <a href="#">Tentang</a>
        <a href="#">Kontak</a>
    </div>
</nav>
