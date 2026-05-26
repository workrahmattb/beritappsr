<div>
    @push('styles')
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f9fafb;
            color: #1f2937;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Alpine x-cloak ── */
        [x-cloak] { display: none !important; }

        /* ── Navbar ── */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(22,163,74,0.1);
            transition: box-shadow .3s;
        }
        .navbar.scrolled {
            box-shadow: 0 4px 24px rgba(22,163,74,0.08);
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
        .nav-links a:hover { color: #16a34a; }
        .nav-links a:hover::after { transform: scaleX(1); }
        .nav-links a.active { color: #16a34a; }
        .nav-links a.active::after { transform: scaleX(1); }

        /* ── Nav Dropdown ── */
        .nav-dropdown { position: relative; }
        .nav-dropdown-trigger {
            text-decoration: none; font-size: 0.88rem; font-weight: 500;
            color: #6b7280; cursor: pointer; transition: color .2s;
            display: flex; align-items: center; gap: 4px;
            position: relative; background: none; border: none; font-family: inherit; padding: 0;
        }
        .nav-dropdown-trigger::after {
            content: ''; position: absolute; bottom: -4px; left: 0; right: 0;
            height: 2px; background: #16a34a; border-radius: 2px;
            transform: scaleX(0); transition: transform .2s;
        }
        .nav-dropdown-trigger:hover { color: #16a34a; }
        .nav-dropdown-trigger:hover::after { transform: scaleX(1); }
        .nav-dropdown-trigger.active { color: #16a34a; }
        .nav-dropdown-trigger.active::after { transform: scaleX(1); }
        .nav-dropdown-arrow { transition: transform .2s; }
        .nav-dropdown:hover .nav-dropdown-arrow { transform: rotate(180deg); }
        .nav-dropdown-menu {
            position: absolute; top: 100%; left: 50%;
            transform: translateX(-50%) translateY(8px);
            background: white; border-radius: 12px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.12);
            border: 1px solid rgba(22,163,74,0.1);
            min-width: 200px; padding: 6px;
            opacity: 0; visibility: hidden;
            transition: all .2s; z-index: 100;
        }
        .nav-dropdown:hover .nav-dropdown-menu {
            opacity: 1; visibility: visible;
            transform: translateX(-50%) translateY(4px);
        }
        .nav-dropdown-menu a {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 14px; border-radius: 8px;
            text-decoration: none; font-size: 0.85rem; font-weight: 500;
            color: #4b5563; transition: all .15s;
        }
        .nav-dropdown-menu a:hover { background: rgba(22,163,74,0.08); color: #16a34a; }
        .nav-dropdown-menu a::after { display: none; }
        .nav-dropdown-menu a.active { background: rgba(22,163,74,0.1); color: #16a34a; }

        .mobile-sub-label {
            font-size: 0.8rem; font-weight: 600; color: #9ca3af;
            padding: 6px 0 2px; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .mobile-sub-item { padding-left: 16px !important; }

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
        .mobile-menu a.active { color: #16a34a; }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .menu-toggle { display: flex; }
        }

        /* ── Page Header ── */
        .page-header {
            background: linear-gradient(135deg, #064e3b, #047857, #16a34a);
            padding: 120px 24px 40px;
            position: relative;
            overflow: hidden;
        }
        .page-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.3;
        }
        .page-header > * { position: relative; z-index: 1; }
        .page-header-inner {
            max-width: 800px;
            margin: 0 auto;
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 0.9rem;
            margin-bottom: 20px;
            transition: color .2s;
        }
        .back-link:hover { color: white; }
        .page-header .article-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }
        .page-header .article-meta span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: rgba(255,255,255,0.75);
            font-size: 0.85rem;
        }
        .page-header h1 {
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: white;
            letter-spacing: -0.5px;
            line-height: 1.2;
            margin-bottom: 0;
        }

        /* ── Article Content ── */
        .article-section {
            max-width: 800px;
            margin: -30px auto 0;
            padding: 0 24px 60px;
            position: relative;
            z-index: 10;
        }
        .article-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .article-card .article-body {
            padding: 40px;
        }
        .article-card .article-summary {
            font-size: 1.1rem;
            color: #4b5563;
            line-height: 1.7;
            margin-bottom: 32px;
            padding-bottom: 24px;
            border-bottom: 1px solid #f3f4f6;
            font-weight: 500;
        }
        .article-card .article-content {
            font-size: 1.05rem;
            line-height: 1.85;
            color: #374151;
        }
        .article-card .article-content p {
            margin-bottom: 1.2em;
        }
        .article-card .article-content h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 2em;
            margin-bottom: 0.6em;
            color: #111827;
        }
        .article-card .article-content h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 1.5em;
            margin-bottom: 0.5em;
            color: #111827;
        }
        .article-card .article-content ul,
        .article-card .article-content ol {
            margin-bottom: 1.2em;
            padding-left: 1.5em;
        }
        .article-card .article-content li {
            margin-bottom: 0.4em;
        }
        .article-card .article-content blockquote {
            border-left: 4px solid #16a34a;
            padding: 12px 20px;
            margin: 1.5em 0;
            background: #f0fdf4;
            border-radius: 0 8px 8px 0;
            color: #166534;
            font-style: italic;
        }
        .article-card .article-content a {
            color: #16a34a;
            text-decoration: underline;
            text-underline-offset: 2px;
        }
        .article-card .article-content a:hover { color: #15803d; }
        .article-card .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 1.5em auto;
            display: block;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }
        .article-card .article-content pre {
            background: #1f2937;
            color: #e5e7eb;
            padding: 16px 20px;
            border-radius: 12px;
            overflow-x: auto;
            margin: 1.5em 0;
            font-size: 0.9rem;
        }
        .article-card .article-content code {
            background: #f3f4f6;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.9em;
        }
        .article-card .article-content pre code {
            background: none;
            padding: 0;
        }
        .article-card .article-content hr {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 2em 0;
        }

        /* ── Article Hero Image ── */
        .article-hero-img {
            width: 100%;
            max-height: 450px;
            object-fit: cover;
            background: #f3f4f6;
        }
        .article-hero-placeholder {
            width: 100%;
            height: 250px;
            background: linear-gradient(135deg, #e0f2e9, #d1fae5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #16a34a;
            font-size: 3rem;
            font-weight: 700;
        }

        /* ── Article Footer Info ── */
        .article-footer-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            padding: 20px 40px;
            border-top: 1px solid #f3f4f6;
            background: #fafafa;
        }
        .article-footer-info .author-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .article-footer-info .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #16a34a, #15803d);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
        }
        .article-footer-info .author-details {
            display: flex;
            flex-direction: column;
        }
        .article-footer-info .author-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: #111827;
        }
        .article-footer-info .author-label {
            font-size: 0.8rem;
            color: #9ca3af;
        }
        .article-footer-info .share-buttons {
            display: flex;
            gap: 8px;
        }
        .article-footer-info .share-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s;
            border: 1px solid #e5e7eb;
            color: #4b5563;
            background: white;
        }
        .article-footer-info .share-btn:hover {
            border-color: #16a34a;
            color: #16a34a;
            background: #f0fdf4;
        }

        /* ── Related Articles ── */
        .related-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px 80px;
        }
        .related-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .related-header .section-label {
            display: inline-block;
            padding: 4px 14px;
            background: rgba(22,163,74,0.1);
            border-radius: 50px;
            color: #16a34a;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 12px;
        }
        .related-header h2 {
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 800;
            color: #111827;
            letter-spacing: -0.5px;
        }

        .berita-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 28px;
        }
        .berita-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(22,163,74,0.08);
            transition: all .3s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .berita-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(22,163,74,0.12);
            border-color: rgba(22,163,74,0.2);
        }
        .berita-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: #f3f4f6;
        }
        .berita-img-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #e0f2e9, #d1fae5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #16a34a;
            font-size: 2.5rem;
            font-weight: 700;
        }
        .berita-body {
            padding: 20px 24px 24px;
        }
        .berita-date {
            font-size: 0.8rem;
            color: #9ca3af;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 8px;
        }
        .berita-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #111827;
            line-height: 1.4;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .berita-card:hover .berita-title { color: #16a34a; }
        .berita-summary {
            font-size: 0.88rem;
            color: #6b7280;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .berita-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            border-top: 1px solid #f3f4f6;
        }
        .berita-readmore {
            color: #16a34a;
            font-weight: 600;
            font-size: 0.88rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: gap .2s;
        }
        .berita-readmore:hover { gap: 8px; }

        /* ── Footer ── */
        .footer {
            background: #111827;
            padding: 48px 24px 32px;
            color: rgba(255,255,255,0.7);
        }
        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
        }
        .footer-brand { font-size: 0.9rem; line-height: 1.7; }
        .footer-brand strong { color: white; font-size: 1.1rem; }
        .footer-col h4 {
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 16px;
        }
        .footer-col a {
            display: block;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.85rem;
            margin-bottom: 10px;
            transition: color .2s;
        }
        .footer-col a:hover { color: #4ade80; }
        .footer-bottom {
            max-width: 1200px;
            margin: 32px auto 0;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.08);
            text-align: center;
            font-size: 0.82rem;
            color: rgba(255,255,255,0.4);
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .berita-grid { grid-template-columns: 1fr; }
            .article-card .article-body { padding: 24px; }
            .article-footer-info { padding: 16px 24px; flex-direction: column; align-items: flex-start; }
            .footer-inner { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 480px) {
            .footer-inner { grid-template-columns: 1fr; }
        }

        /* ── Animation ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up {
            animation: fadeUp 0.6s ease-out forwards;
        }
        .animate-delay-1 { animation-delay: 0.1s; opacity: 0; }
        .animate-delay-2 { animation-delay: 0.2s; opacity: 0; }
    </style>
    @endpush

    <!-- ════════════════════════════════════════════ -->
    <!-- NAVBAR -->
    <!-- ════════════════════════════════════════════ -->
    <nav class="navbar" id="navbar">
        <div class="navbar-inner">
            <a href="/" class="nav-logo" wire:navigate>
                <img src="{{ asset('gambar/ppsr logo.webp') }}" alt="PPSR Logo" class="logo-img">
            </a>

            <div class="nav-links">
                <a href="/" class="{{ request()->is('/') ? 'active' : '' }}" wire:navigate>Beranda</a>
                <div class="nav-dropdown">
                    <span class="nav-dropdown-trigger {{ request()->is('profile*') ? 'active' : '' }}">
                        Profile
                        <svg class="nav-dropdown-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </span>
                    <div class="nav-dropdown-menu">
                        <a href="{{ route('profile.pimpinan') }}" wire:navigate class="{{ request()->routeIs('profile.pimpinan') ? 'active' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Pimpinan Pondok
                        </a>
                        <a href="{{ route('profile.pengajar') }}" wire:navigate class="{{ request()->routeIs('profile.pengajar') ? 'active' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            Pengajar
                        </a>
                    </div>
                </div>
                <a href="{{ route('fasilitas') }}" wire:navigate class="{{ request()->routeIs('fasilitas') ? 'active' : '' }}">Fasilitas</a>
                <a href="/berita" class="{{ request()->is('berita*') ? 'active' : '' }}" wire:navigate>Berita</a>
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
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}" wire:navigate>Beranda</a>
            <div class="mobile-sub-label">Profile</div>
            <a href="{{ route('profile.pimpinan') }}" wire:navigate class="mobile-sub-item">Pimpinan Pondok</a>
            <a href="{{ route('profile.pengajar') }}" wire:navigate class="mobile-sub-item">Pengajar</a>
            <a href="{{ route('fasilitas') }}" wire:navigate class="{{ request()->routeIs('fasilitas') ? 'active' : '' }}">Fasilitas</a>
            <a href="/berita" class="{{ request()->is('berita*') ? 'active' : '' }}" wire:navigate>Berita</a>
            <a href="#">Tentang</a>
            <a href="#">Kontak</a>
        </div>
    </nav>

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <section class="page-header">
        <div class="page-header-inner" style="padding:0 24px;">
            <a href="{{ url()->previous() === url()->current() ? url('/berita') : url()->previous() }}" class="back-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Kembali
            </a>

            <div class="article-meta">
                <span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    {{ $article->published_at ? $article->published_at->format('d F Y') : '-' }}
                </span>
                <span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    {{ $article->author->name ?? 'Admin' }}
                </span>
                @if($article->focus_keyword)
                    <span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        {{ $article->focus_keyword }}
                    </span>
                @endif
            </div>

            <h1 class="animate-fade-up">{{ $article->title }}</h1>
        </div>
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- ARTICLE CONTENT -->
    <!-- ════════════════════════════════════════════ -->
    <section class="article-section">
        <article class="article-card animate-fade-up animate-delay-1">
            @if($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="article-hero-img">
            @endif

            <div class="article-body">
                @if($article->summary)
                    <div class="article-summary">
                        {{ $article->summary }}
                    </div>
                @endif

                <div class="article-content">
                    {!! $article->content !!}
                </div>
            </div>

            <div class="article-footer-info">
                <div class="author-info">
                    <div class="author-avatar">
                        {{ strtoupper(substr($article->author->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="author-details">
                        <span class="author-name">{{ $article->author->name ?? 'Admin' }}</span>
                        <span class="author-label">Penulis</span>
                    </div>
                </div>

                <div class="share-buttons">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="share-btn" title="Bagikan ke Facebook">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="share-btn" title="Bagikan ke Twitter">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        X
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}" target="_blank" rel="noopener" class="share-btn" title="Bagikan ke WhatsApp">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        WhatsApp
                    </a>
                </div>
            </div>
        </article>
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- RELATED ARTICLES -->
    <!-- ════════════════════════════════════════════ -->
    @if($this->relatedArticles->isNotEmpty())
        <section class="related-section">
            <div class="related-header">
                <div class="section-label">Artikel Terkait</div>
                <h2>Berita Lainnya</h2>
            </div>

            <div class="berita-grid">
                @foreach($this->relatedArticles as $related)
                    <article class="berita-card animate-fade-up">
                        <a href="{{ route('berita.detail', $related->slug) }}" style="text-decoration:none;color:inherit;" wire:navigate>
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}" class="berita-img" loading="lazy">
                            @else
                                <div class="berita-img-placeholder">B</div>
                            @endif
                            <div class="berita-body">
                                <div class="berita-date">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    {{ $related->published_at ? $related->published_at->format('d M Y') : '-' }}
                                </div>
                                <h3 class="berita-title">{{ $related->title }}</h3>
                                <p class="berita-summary">{{ $related->summary ?? Str::limit(strip_tags($related->content), 120) }}</p>
                            </div>
                        </a>
                        <div class="berita-footer">
                            <span style="font-size:0.8rem;color:#9ca3af;">{{ $related->author->name ?? 'Admin' }}</span>
                            <a href="{{ route('berita.detail', $related->slug) }}" class="berita-readmore" wire:navigate>
                                Baca Selengkapnya
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <!-- ════════════════════════════════════════════ -->
    <!-- FOOTER -->
    <!-- ════════════════════════════════════════════ -->
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <strong style="display:flex;align-items:center;gap:8px;margin-bottom:12px;">
                    <span style="width:28px;height:28px;background:#16a34a;border-radius:8px;display:flex;align-items:center;justify-content:center;color:white;font-size:14px;font-weight:800;">B</span>
                    {{ config('app.name', 'Berita Apps') }}
                </strong>
                <p>{{ config('app.name', 'Berita Apps') }} adalah platform berita terpercaya yang menyajikan informasi terkini dan akurat untuk Anda.</p>
            </div>
            <div class="footer-col">
                <h4>Menu</h4>
                <a href="/" wire:navigate>Beranda</a>
                <a href="{{ route('fasilitas') }}" wire:navigate>Fasilitas Sekolah</a>
                <a href="/berita" wire:navigate>Berita</a>
                <a href="#">Tentang</a>
                <a href="#">Kontak</a>
            </div>
            <div class="footer-col">
                <h4>Lainnya</h4>
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat & Ketentuan</a>
                <a href="#">FAQ</a>
            </div>
            <div class="footer-col">
                <h4>Kontak</h4>
                <a href="mailto:info@beritapps.com">info@beritapps.com</a>
                <a href="#">+62 123 4567 890</a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} {{ config('app.name', 'Berita Apps') }}. All rights reserved.
        </div>
    </footer>

    @push('scripts')
    <script>
        // Navbar scroll effect
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

        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        if (menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', function() {
                this.classList.toggle('active');
                mobileMenu.classList.toggle('open');
            });
        }
    </script>
    @endpush
</div>
