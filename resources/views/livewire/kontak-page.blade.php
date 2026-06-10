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
        [x-cloak] { display: none !important; }

        /* ── Page Header ── */
        .page-header {
            background: linear-gradient(135deg, #064e3b, #047857, #16a34a);
            padding: 120px 24px 50px;
            position: relative; overflow: hidden;
        }
        .page-header::before {
            content: ''; position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.3;
        }
        .page-header > * { position: relative; z-index: 1; }
        .page-header-inner { max-width: 800px; margin: 0 auto; text-align: center; }
        .page-header .section-label {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 16px; background: rgba(255,255,255,0.15);
            border-radius: 50px; color: white; font-size: 0.8rem; font-weight: 600;
            margin-bottom: 16px; backdrop-filter: blur(10px);
        }
        .page-header h1 {
            font-size: clamp(2rem, 5vw, 3rem); font-weight: 800; color: white;
            letter-spacing: -1px; line-height: 1.15; margin-bottom: 16px;
        }
        .page-header p {
            color: rgba(255,255,255,0.85); font-size: 1.05rem;
            max-width: 600px; margin: 0 auto; line-height: 1.7;
        }

        /* ── Contact Section ── */
        .contact-section {
            max-width: 1200px; margin: 0 auto;
            padding: 60px 24px 80px;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: start;
        }

        /* ── WhatsApp Cards ── */
        .wa-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .wa-card {
            background: white;
            border-radius: 20px;
            padding: 28px;
            border: 1px solid rgba(37, 211, 102, 0.12);
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            transition: all .3s;
            text-decoration: none;
            display: block;
            color: inherit;
        }

        .wa-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 32px rgba(37, 211, 102, 0.12);
            border-color: rgba(37, 211, 102, 0.25);
        }

        .wa-card .card-icon {
            width: 48px; height: 48px;
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            color: #25D366;
            margin-bottom: 16px;
        }

        .wa-card h3 {
            font-size: 0.85rem;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .wa-card .card-value {
            font-size: 1rem;
            font-weight: 600;
            color: #111827;
            line-height: 1.5;
            word-break: break-word;
        }

        .wa-card .wa-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-top: 12px;
            padding: 4px 10px;
            background: rgba(37, 211, 102, 0.1);
            border-radius: 50px;
            color: #16a34a;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .wa-card .wa-badge svg {
            width: 12px;
            height: 12px;
        }

        /* ── Maps Section ── */
        .maps-section {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(22, 163, 74, 0.08);
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }

        .maps-section .maps-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .maps-section .maps-header svg {
            color: #16a34a;
            flex-shrink: 0;
        }

        .maps-section .maps-header h3 {
            font-size: 0.95rem;
            font-weight: 700;
            color: #111827;
        }

        .maps-section .maps-container {
            width: 100%;
        }

        .maps-section .maps-container iframe {
            display: block;
            width: 100%;
            height: 380px;
            border: none;
        }

        .maps-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 24px;
            background: #f3f4f6;
            color: #9ca3af;
            text-align: center;
            gap: 12px;
        }

        .maps-placeholder p {
            font-size: 0.9rem;
        }

        /* ── CTA Section ── */
        .cta-section {
            background: linear-gradient(135deg, #059669, #16a34a, #22c55e);
            padding: 80px 24px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cta-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.5;
        }
        .cta-section > * { position: relative; z-index: 1; }
        .cta-section h2 {
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 800; color: white;
            letter-spacing: -0.5px; margin-bottom: 12px;
        }
        .cta-section p {
            color: rgba(255,255,255,0.85);
            font-size: 1.05rem; max-width: 500px;
            margin: 0 auto 24px; line-height: 1.6;
        }
        .cta-section .btn-outline-light {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 14px 32px; background: transparent; color: white;
            text-decoration: none; border-radius: 12px; font-weight: 600;
            font-size: 1rem; border: 1.5px solid rgba(255,255,255,0.3);
            transition: all .25s;
        }
        .cta-section .btn-outline-light:hover {
            border-color: white; background: rgba(255,255,255,0.1);
        }

        /* ── Animations ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fadeUp 0.6s ease-out forwards; }
        .animate-delay-1 { animation-delay: 0.1s; opacity: 0; }
        .animate-delay-2 { animation-delay: 0.2s; opacity: 0; }
        .animate-delay-3 { animation-delay: 0.3s; opacity: 0; }

        /* ── Responsive ── */
        @media (max-width: 1024px) {
            .contact-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .wa-grid { grid-template-columns: 1fr; }
            .maps-section .maps-container iframe { height: 280px; }
        }
        @media (max-width: 480px) {
            .wa-card { padding: 20px; }
        }
    </style>
    @endpush

    <x-public.navbar />

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <section class="page-header">
        <div class="page-header-inner">
            <div class="section-label animate-fade-up">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                Hubungi Kami
            </div>
            <h1 class="animate-fade-up animate-delay-1">Kontak &amp; Lokasi</h1>
            <p class="animate-fade-up animate-delay-2">Silakan hubungi kami melalui WhatsApp atau kunjungi langsung pondok pesantren.</p>
        </div>
    </section>

    @if ($waNumbers->isNotEmpty() || $mapsList->isNotEmpty())
        <!-- ════════════════════════════════════════════ -->
        <!-- CONTACT SECTION -->
        <!-- ════════════════════════════════════════════ -->
        <section class="contact-section">
            <div class="contact-grid">
                {{-- Left: WhatsApp Numbers --}}
                <div>
                    @if ($waNumbers->isNotEmpty())
                        <div class="wa-grid">
                            @foreach ($waNumbers as $wa)
                                <a href="https://wa.me/{{ $wa->nomor_wa }}?text=Assalamualaikum%20Warohmatullahi%20Wabarokatuh%2C%20Saya%20Ingin%20Daftar"
                                   target="_blank" rel="noopener noreferrer"
                                   class="wa-card animate-fade-up {{ $loop->index > 0 ? 'animate-delay-' . min($loop->index, 3) : '' }}">
                                    <div class="card-icon">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                    </div>
                                    <h3>{{ $wa->label ?: 'WhatsApp' }}</h3>
                                    <div class="card-value">{{ $wa->nomor_wa }}</div>
                                    <span class="wa-badge">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                                        Klik untuk chat
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="maps-placeholder" style="border-radius:20px;">
                            <p>Belum ada nomor WhatsApp.</p>
                        </div>
                    @endif
                </div>

                {{-- Right: Maps List --}}
                <div class="animate-fade-up animate-delay-2" style="display:flex;flex-direction:column;gap:24px;">
                    @if ($mapsList->isNotEmpty())
                        @foreach ($mapsList as $mapItem)
                            <div class="maps-section">
                                <div class="maps-header">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    <h3>{{ $mapItem->label ?: 'Lokasi' }}</h3>
                                </div>
                                <div class="maps-container">
                                    {!! $mapItem->embed_code !!}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="maps-section">
                            <div class="maps-header">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <h3>Lokasi Kami</h3>
                            </div>
                            <div class="maps-placeholder">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <p>Peta belum tersedia. Silakan atur Google Maps di panel admin.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @else
        {{-- Empty State --}}
        <section class="contact-section">
            <div style="text-align:center;padding:60px 24px;color:#9ca3af;">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="margin:0 auto 16px;opacity:0.4;">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
                <p style="font-size:1.1rem;">Info kontak belum tersedia.</p>
                <p style="font-size:0.9rem;margin-top:8px;">Silakan isi data WhatsApp dan Google Maps di panel admin terlebih dahulu.</p>
            </div>
        </section>
    @endif

    <!-- ════════════════════════════════════════════ -->
    <!-- CTA SECTION -->
    <!-- ════════════════════════════════════════════ -->
    <section class="cta-section">
        <h2>Kunjungi Pondok Pesantren Syafa'aturrasul</h2>
        <p>Datang langsung dan saksikan suasana belajar yang nyaman dan islami</p>
        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
            @if ($waNumbers->isNotEmpty())
                <a href="https://wa.me/{{ $waNumbers->first()->nomor_wa }}?text=Assalamualaikum%20Warohmatullahi%20Wabarokatuh%2C%20Saya%20Ingin%20Daftar"
                   target="_blank" rel="noopener noreferrer"
                   style="display:inline-flex;align-items:center;gap:10px;padding:16px 36px;background:white;color:#16a34a;text-decoration:none;border-radius:14px;font-weight:700;font-size:1.05rem;transition:all .3s;box-shadow:0 4px 20px rgba(0,0,0,0.15);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    Hubungi via WhatsApp
                </a>
            @endif
            <a href="{{ route('fasilitas') }}" wire:navigate class="btn-outline-light">
                Lihat Fasilitas
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </section>

    <x-public.footer />

    @push('scripts')
    <script>
        // Page-specific scripts here
    </script>
    @endpush
</div>
