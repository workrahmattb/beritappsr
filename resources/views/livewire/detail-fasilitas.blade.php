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
        .page-header-inner { max-width: 900px; margin: 0 auto; }
        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            color: rgba(255,255,255,0.8); text-decoration: none;
            font-size: 0.9rem; margin-bottom: 20px; transition: color .2s;
        }
        .back-link:hover { color: white; }

        /* ── Facility Detail ── */
        .facility-section {
            max-width: 960px; margin: -30px auto 0;
            padding: 0 24px 60px; position: relative; z-index: 10;
        }
        .facility-card {
            background: white; border-radius: 24px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
            overflow: hidden;
        }

        /* ── Gallery ── */
        .gallery {
            position: relative; width: 100%;
            background: #f3f4f6; overflow: hidden;
        }
        .gallery-main {
            position: relative; width: 100%;
            aspect-ratio: 16/9; overflow: hidden;
        }
        .gallery-main .slide {
            position: absolute; inset: 0;
            opacity: 0; transition: opacity 0.5s ease;
        }
        .gallery-main .slide.active { opacity: 1; }
        .gallery-main .slide img {
            width: 100%; height: 100%; object-fit: cover;
        }

        .gallery-nav {
            position: absolute; top: 50%; transform: translateY(-50%);
            z-index: 5; width: 44px; height: 44px; border: none;
            border-radius: 50%; background: rgba(255,255,255,0.9);
            cursor: pointer; display: flex; align-items: center;
            justify-content: center; color: #374151;
            transition: all .2s; opacity: 0;
            pointer-events: none; backdrop-filter: blur(4px);
        }
        .gallery:hover .gallery-nav {
            opacity: 1; pointer-events: auto;
        }
        .gallery-nav:hover { background: #16a34a; color: white; }
        .gallery-nav.prev { left: 16px; }
        .gallery-nav.next { right: 16px; }

        .gallery-dots {
            position: absolute; bottom: 16px; left: 50%;
            transform: translateX(-50%); display: flex; gap: 8px;
            z-index: 5;
        }
        .gallery-dot {
            width: 10px; height: 10px; border-radius: 50%;
            background: rgba(255,255,255,0.5); border: none;
            cursor: pointer; transition: all .3s; padding: 0;
        }
        .gallery-dot.active { background: white; width: 28px; border-radius: 6px; }
        .gallery-dot:hover { background: rgba(255,255,255,0.8); }

        .gallery-count {
            position: absolute; top: 16px; right: 16px; z-index: 5;
            display: flex; align-items: center; gap: 4px;
            padding: 6px 12px; background: rgba(0,0,0,0.5);
            border-radius: 20px; color: white; font-size: 0.78rem;
            font-weight: 600; backdrop-filter: blur(4px);
        }

        .gallery-placeholder {
            width: 100%; aspect-ratio: 16/9;
            background: linear-gradient(135deg, #e0f2e9, #d1fae5);
            display: flex; align-items: center; justify-content: center;
            color: #16a34a; font-size: 3rem;
        }

        /* ── Thumbnail Strip ── */
        .thumbnail-strip {
            display: flex; gap: 8px; padding: 12px 16px;
            background: #fafafa; border-top: 1px solid #f3f4f6;
            overflow-x: auto;
        }
        .thumbnail-strip::-webkit-scrollbar { height: 4px; }
        .thumbnail-strip::-webkit-scrollbar-track { background: transparent; }
        .thumbnail-strip::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
        .thumbnail-btn {
            flex-shrink: 0; width: 72px; height: 48px; border-radius: 8px;
            overflow: hidden; border: 2px solid transparent; cursor: pointer;
            padding: 0; transition: all .2s; background: #f3f4f6;
        }
        .thumbnail-btn:hover { border-color: #16a34a; }
        .thumbnail-btn.active { border-color: #16a34a; }
        .thumbnail-btn img {
            width: 100%; height: 100%; object-fit: cover;
        }

        /* ── Facility Body ── */
        .facility-body { padding: 32px 40px 40px; }
        .facility-body .section-label {
            display: inline-block; padding: 4px 14px;
            background: rgba(22,163,74,0.1); border-radius: 50px;
            color: #16a34a; font-size: 0.8rem; font-weight: 600;
            margin-bottom: 12px;
        }
        .facility-body h1 {
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 800; color: #111827; margin-bottom: 20px;
            letter-spacing: -0.5px;
        }
        .facility-divider {
            width: 50px; height: 3px;
            background: linear-gradient(135deg, #16a34a, #22c55e);
            border-radius: 4px; margin-bottom: 24px;
        }
        .facility-body .description {
            font-size: 1.05rem; line-height: 1.85; color: #374151;
        }
        .facility-body .description p { margin-bottom: 1.2em; }
        .facility-body .description p:last-child { margin-bottom: 0; }

        /* ── Related Facilities ── */
        .related-section {
            max-width: 1200px; margin: 0 auto;
            padding: 0 24px 80px;
        }
        .related-header {
            text-align: center; margin-bottom: 40px;
        }
        .related-header .section-label {
            display: inline-block; padding: 4px 14px;
            background: rgba(22,163,74,0.1);
            border-radius: 50px; color: #16a34a;
            font-size: 0.8rem; font-weight: 600; margin-bottom: 12px;
        }
        .related-header h2 {
            font-size: clamp(1.3rem, 2.5vw, 1.75rem);
            font-weight: 800; color: #111827;
            letter-spacing: -0.5px;
        }

        .facility-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }

        .facility-card-sm {
            background: white; border-radius: 16px; overflow: hidden;
            border: 1px solid rgba(22,163,74,0.08);
            transition: all .3s; box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            text-decoration: none; display: block; color: inherit;
        }
        .facility-card-sm:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(22,163,74,0.12);
            border-color: rgba(22,163,74,0.2);
        }
        .facility-card-sm .thumb {
            width: 100%; height: 180px; object-fit: cover;
            background: #f3f4f6; display: block;
        }
        .facility-card-sm .thumb-placeholder {
            width: 100%; height: 180px;
            background: linear-gradient(135deg, #e0f2e9, #d1fae5);
            display: flex; align-items: center; justify-content: center;
            color: #16a34a; font-size: 2rem;
        }
        .facility-card-sm .body { padding: 16px 20px 20px; }
        .facility-card-sm h3 {
            font-size: 1rem; font-weight: 700; color: #111827; margin-bottom: 4px;
        }
        .facility-card-sm:hover h3 { color: #16a34a; }
        .facility-card-sm p {
            font-size: 0.85rem; color: #6b7280; line-height: 1.5;
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
        }

        /* ── Animations ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fadeUp 0.6s ease-out forwards; }
        .animate-delay-1 { animation-delay: 0.1s; opacity: 0; }
        .animate-delay-2 { animation-delay: 0.2s; opacity: 0; }

        @media (max-width: 768px) {
            .facility-body { padding: 24px; }
            .facility-grid { grid-template-columns: 1fr; }
            .gallery-main { aspect-ratio: 4/3; }
        }
        @media (max-width: 480px) {
            .gallery-main { aspect-ratio: 1/1; }
        }
    </style>
    @endpush

    <x-public.navbar />

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <section class="page-header">
        <div class="page-header-inner" style="padding:0 24px;">
            <a href="{{ route('fasilitas') }}" wire:navigate class="back-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Kembali ke Fasilitas
            </a>
        </div>
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- FACILITY DETAIL -->
    <!-- ════════════════════════════════════════════ -->
    @php
        $images = $facility->images ?? [];
        $hasImages = count($images) > 0;
    @endphp

    <section class="facility-section">
        <div class="facility-card animate-fade-up"
             x-data="{
                 currentSlide: 0,
                 images: {{ json_encode($images) }},
                 get totalSlides() { return this.images.length },
                 prev() { this.currentSlide = this.currentSlide > 0 ? this.currentSlide - 1 : this.totalSlides - 1 },
                 next() { this.currentSlide = this.currentSlide < this.totalSlides - 1 ? this.currentSlide + 1 : 0 },
                 goTo(i) { this.currentSlide = i }
             }">

            {{-- Gallery --}}
            @if ($hasImages)
                <div class="gallery">
                    <div class="gallery-main">
                        <template x-for="(img, index) in images" :key="index">
                            <div class="slide" :class="{ 'active': currentSlide === index }">
                                <img :src="'/storage/' + img" :alt="'{{ $facility->name }} - ' + (index + 1)">
                            </div>
                        </template>

                        <button class="gallery-nav prev" x-show="totalSlides > 1" @click="prev">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                        </button>
                        <button class="gallery-nav next" x-show="totalSlides > 1" @click="next">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                        </button>

                        <div class="gallery-dots" x-show="totalSlides > 1">
                            <template x-for="(dot, index) in images" :key="index">
                                <button class="gallery-dot" :class="{ 'active': currentSlide === index }" @click="goTo(index)"></button>
                            </template>
                        </div>

                        <div class="gallery-count" x-show="totalSlides > 1">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            <span x-text="(currentSlide + 1) + '/' + totalSlides"></span>
                        </div>
                    </div>

                    {{-- Thumbnails --}}
                    <div class="thumbnail-strip" x-show="totalSlides > 1">
                        <template x-for="(img, index) in images" :key="index">
                            <button class="thumbnail-btn" :class="{ 'active': currentSlide === index }" @click="goTo(index)">
                                <img :src="'/storage/' + img" :alt="'Thumbnail ' + (index + 1)">
                            </button>
                        </template>
                    </div>
                </div>
            @else
                <div class="gallery-placeholder">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
            @endif

            {{-- Content --}}
            <div class="facility-body">
                <div class="section-label">Fasilitas</div>
                <h1>{{ $facility->name }}</h1>
                <div class="facility-divider"></div>

                @if ($facility->description)
                    <div class="description">
                        @php
                            $paragraphs = preg_split('/\n\s*\n/', trim($facility->description));
                        @endphp
                        @foreach ($paragraphs as $para)
                            <p>{!! nl2br(e(trim($para))) !!}</p>
                        @endforeach
                    </div>
                @else
                    <div class="description" style="text-align:center;color:#9ca3af;">
                        <p>Belum ada deskripsi lengkap untuk {{ $facility->name }}.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- RELATED FACILITIES -->
    <!-- ════════════════════════════════════════════ -->
    @if ($this->relatedFacilities->isNotEmpty())
        <section class="related-section">
            <div class="related-header">
                <div class="section-label">Lainnya</div>
                <h2>Fasilitas Lainnya</h2>
            </div>

            <div class="facility-grid">
                @foreach ($this->relatedFacilities as $related)
                    <a href="{{ route('fasilitas.detail', $related->slug) }}" wire:navigate class="facility-card-sm">
                        @php $firstImg = $related->first_image; @endphp
                        @if ($firstImg)
                            <img src="{{ asset('storage/' . $firstImg) }}" alt="{{ $related->name }}" class="thumb" loading="lazy">
                        @else
                            <div class="thumb-placeholder">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            </div>
                        @endif
                        <div class="body">
                            <h3>{{ $related->name }}</h3>
                            @if ($related->description)
                                <p>{{ $related->description }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    <x-public.footer />
</div>
