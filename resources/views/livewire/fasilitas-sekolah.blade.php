<div>
    @push('styles')
    <style>
        /* ── Reset & Base ── */
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

        /* ── Facility Grid ── */
        .facility-section { max-width: 1200px; margin: 0 auto; padding: 60px 24px 80px; }

        .facility-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 32px;
        }

        .facility-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            border: 1px solid rgba(22,163,74,0.08);
            transition: all .3s;
        }
        .facility-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(22,163,74,0.12);
            border-color: rgba(22,163,74,0.2);
        }

        /* ── Facility Image Carousel ── */
        .facility-carousel {
            position: relative;
            width: 100%;
            height: 240px;
            overflow: hidden;
            background: #f3f4f6;
        }
        .facility-carousel .carousel-slide {
            position: absolute; inset: 0;
            opacity: 0;
            transition: opacity 0.6s ease;
        }
        .facility-carousel .carousel-slide.active {
            opacity: 1;
        }
        .facility-carousel .carousel-slide img {
            width: 100%; height: 100%; object-fit: cover;
        }
        .facility-carousel .carousel-btn {
            position: absolute; top: 50%; transform: translateY(-50%);
            z-index: 5; width: 36px; height: 36px; border: none; border-radius: 50%;
            background: rgba(255,255,255,0.9); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: #374151; transition: all .2s;
            opacity: 0; pointer-events: none;
        }
        .facility-card:hover .carousel-btn {
            opacity: 1; pointer-events: auto;
        }
        .facility-carousel .carousel-btn:hover {
            background: #16a34a; color: white;
        }
        .facility-carousel .carousel-btn.prev { left: 10px; }
        .facility-carousel .carousel-btn.next { right: 10px; }

        .carousel-dots {
            position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%);
            display: flex; gap: 6px; z-index: 5;
        }
        .carousel-dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: rgba(255,255,255,0.5); border: none; cursor: pointer;
            transition: all .3s; padding: 0;
        }
        .carousel-dot.active {
            background: white; width: 24px; border-radius: 4px;
        }
        .carousel-dot:hover { background: rgba(255,255,255,0.8); }

        .facility-img-placeholder {
            width: 100%; height: 240px;
            background: linear-gradient(135deg, #e0f2e9, #d1fae5);
            display: flex; align-items: center; justify-content: center;
            color: #16a34a; font-size: 3rem;
        }
        .image-count-badge {
            position: absolute; top: 12px; right: 12px; z-index: 5;
            display: flex; align-items: center; gap: 4px;
            padding: 4px 10px; background: rgba(0,0,0,0.5);
            border-radius: 20px; color: white; font-size: 0.75rem; font-weight: 600;
            backdrop-filter: blur(4px);
        }

        .facility-body { padding: 24px; }
        .facility-name {
            font-size: 1.15rem; font-weight: 700; color: #111827;
            margin-bottom: 8px; line-height: 1.3;
        }
        .facility-card:hover .facility-name { color: #16a34a; }
        .facility-desc {
            font-size: 0.88rem; color: #6b7280; line-height: 1.65;
            display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
        }

        /* ── Empty State ── */
        .empty-state {
            text-align: center; padding: 80px 24px; color: #9ca3af;
        }
        .empty-state svg { margin: 0 auto 16px; }

        /* ── Animations ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fadeUp 0.6s ease-out forwards; }
        .animate-delay-1 { animation-delay: 0.1s; opacity: 0; }
        .animate-delay-2 { animation-delay: 0.2s; opacity: 0; }

        @media (max-width: 768px) {
            .facility-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 480px) {
            .facility-carousel { height: 200px; }
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
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><line x1="9" y1="6" x2="15" y2="6"/><line x1="9" y1="10" x2="15" y2="10"/><line x1="9" y1="14" x2="13" y2="14"/></svg>
                Fasilitas Sekolah
            </div>
            <h1 class="animate-fade-up animate-delay-1">Sarana &amp; Prasarana</h1>
            <p class="animate-fade-up animate-delay-2">Berbagai fasilitas lengkap untuk menunjang kegiatan belajar mengajar dan pengembangan santri di Pondok Pesantren Syafa'aturrasul.</p>
        </div>
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- FACILITY LIST -->
    <!-- ════════════════════════════════════════════ -->
    <section class="facility-section">
        @if($facilities->isNotEmpty())
            <div class="facility-grid">
                @foreach($facilities as $facility)
                    @php
                        $images = $facility->images ?? [];
                        $hasImages = count($images) > 0;
                    @endphp
                    <div class="facility-card animate-fade-up"
                         x-data="{ currentSlide: 0, images: {{ json_encode($images) }}, totalSlides: {{ count($images) > 0 ? count($images) : 1 }} }">
                        <div class="facility-carousel">
                            @if($hasImages)
                                <template x-for="(img, index) in images" :key="index">
                                    <div class="carousel-slide" :class="{ 'active': currentSlide === index }">
                                        <img :src="'/storage/' + img" :alt="'{{ $facility->name }} - ' + (index + 1)" loading="lazy">
                                    </div>
                                </template>

                                <button class="carousel-btn prev"
                                    x-show="totalSlides > 1"
                                    @click="currentSlide = currentSlide > 0 ? currentSlide - 1 : totalSlides - 1">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                                </button>
                                <button class="carousel-btn next"
                                    x-show="totalSlides > 1"
                                    @click="currentSlide = currentSlide < totalSlides - 1 ? currentSlide + 1 : 0">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                                </button>

                                <div class="carousel-dots" x-show="totalSlides > 1">
                                    <template x-for="(dot, index) in images" :key="index">
                                        <button class="carousel-dot" :class="{ 'active': currentSlide === index }"
                                            @click="currentSlide = index"></button>
                                    </template>
                                </div>

                                <div class="image-count-badge" x-show="totalSlides > 1">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                    <span x-text="(currentSlide + 1) + '/' + totalSlides"></span>
                                </div>
                            @else
                                <div class="facility-img-placeholder">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                </div>
                            @endif
                        </div>

                        <div class="facility-body">
                            <h3 class="facility-name">{{ $facility->name }}</h3>
                            @if($facility->description)
                                <p class="facility-desc">{{ $facility->description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <p style="margin-top:12px;font-size:1rem;">Belum ada data fasilitas.</p>
            </div>
        @endif
    </section>

    <x-public.footer />

    @push('scripts')
    <script>
        // Page-specific scripts here
    </script>
    @endpush
</div>
