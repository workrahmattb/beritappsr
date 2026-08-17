<div x-data="{
        smoothScrollTo(event) {
            const anchor = event.target.closest('a');

            if (!anchor) return;

            const href = anchor.getAttribute('href') ?? '';

            if (!href.startsWith('#')) return;

            const target = document.querySelector(href);

            if (target) {
                event.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    }" @click="smoothScrollTo">

    <!-- ════════════════════════════════════════════ -->
    <!-- HERO SECTION -->
    <!-- ════════════════════════════════════════════ -->
    @php
        $heroes = $this->heroSections;
        $heroCount = $heroes->count();
    @endphp

    <section id="hero"
        class="relative flex min-h-screen items-center overflow-hidden pt-[72px]"
        x-data="{
            currentSlide: 0,
            totalSlides: {{ $heroCount }},
            autoplayTimer: null,
            init() {
                if (this.totalSlides > 1) this.startAutoplay();
            },
            goTo(index) {
                if (index < 0) index = this.totalSlides - 1;
                if (index >= this.totalSlides) index = 0;
                this.currentSlide = index;
                this.resetAutoplay();
            },
            next() { this.goTo(this.currentSlide + 1); },
            prev() { this.goTo(this.currentSlide - 1); },
            startAutoplay() {
                this.stopAutoplay();
                this.autoplayTimer = setInterval(() => this.next(), 4000);
            },
            stopAutoplay() {
                if (this.autoplayTimer) { clearInterval(this.autoplayTimer); this.autoplayTimer = null; }
            },
            resetAutoplay() { this.startAutoplay(); }
        }"
        @mouseenter="stopAutoplay()"
        @mouseleave="startAutoplay()"
        @keydown.window.arrow-left="
            const rect = $el.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) { $event.preventDefault(); prev(); }
        "
        @keydown.window.arrow-right="
            const rect = $el.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) { $event.preventDefault(); next(); }
        ">
        {{-- Slides --}}
        @foreach ($heroes as $index => $hero)
            <div class="pointer-events-none absolute inset-0 z-0 flex items-center opacity-0 transition-opacity duration-700"
                :class="{ 'pointer-events-auto z-[1] opacity-100': currentSlide === {{ $index }} }">
                @if ($hero->image)
                    <div class="absolute inset-0 -z-[1] bg-cover bg-center"
                        style="background-image: url('{{ asset('storage/' . $hero->image) }}');">
                    </div>
                    <div class="absolute inset-0 -z-[1]"
                        style="background: linear-gradient(135deg, rgba(0,0,0,{{ $hero->overlay_opacity / 100 }}), rgba(0,0,0,{{ ($hero->overlay_opacity - 10) / 100 }}));">
                    </div>
                @else
                    <div class="absolute inset-0 -z-[1] bg-gradient-to-br from-emerald-900 via-emerald-800 to-emerald-700">
                    </div>
                    <div class="absolute inset-0 -z-[1] opacity-0"></div>
                @endif

                <div class="relative z-[2] mx-auto w-full max-w-[1200px] px-6">
                    <div class="max-w-[680px]">
                        <div class="mb-5 inline-flex items-center gap-1.5 rounded-full border border-emerald-600/30 bg-emerald-600/15 px-4 py-1.5 text-[0.8rem] font-semibold text-emerald-600 backdrop-blur">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                            </svg>
                            {{ $hero->badge_text ?? 'Portal Berita Terpercaya' }}
                        </div>

                        <h1 class="mb-4 text-[clamp(1rem,5vw,1.15rem)] font-extrabold leading-[1.1] tracking-[-1px] text-white max-[480px]:text-[clamp(1rem,5vw,1.15rem)] max-[768px]:text-[clamp(1.15rem,4.5vw,1.5rem)] md:text-[clamp(2.5rem,6vw,4.5rem)]">
                            {{ $hero->title ?? 'Pondok Pesantren' }}<span class="text-green-400">{{ $hero->subtitle ?? "Syafa'aturrasul" }}</span>
                        </h1>

                        <p class="mb-8 max-w-[560px] text-[clamp(0.68rem,2.5vw,0.72rem)] leading-[1.7] text-white/85 max-[480px]:text-[clamp(0.68rem,2.5vw,0.72rem)] max-[768px]:text-[clamp(0.72rem,2.2vw,0.85rem)] md:text-[clamp(1rem,2vw,1.25rem)]">
                            {{ $hero->description ?? 'Temukan informasi terkini, artikel menarik, dan berita terpercaya dalam satu platform.' }}
                        </p>

                        <div class="flex flex-wrap gap-4">
                            <a href="{{ $hero->button_url ?? '#berita' }}"
                                class="btn-hero-cta relative inline-flex cursor-pointer items-center gap-2.5 rounded-[14px] border-none bg-gradient-to-br from-emerald-600 to-green-500 px-9 py-4 text-[1.05rem] font-bold tracking-[0.3px] text-white no-underline shadow-[0_4px_20px_rgba(22,163,74,0.3)] transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] before:pointer-events-none before:absolute before:inset-0 before:rounded-[14px] before:bg-gradient-to-br before:from-white/15 before:to-transparent after:absolute after:-inset-1 after:z-[-1] after:rounded-[18px] after:bg-gradient-to-br after:from-emerald-600 after:via-green-500 after:to-green-400 after:opacity-0 after:blur-[12px] after:transition-opacity hover:-translate-y-[3px] hover:scale-[1.02] hover:bg-gradient-to-br hover:from-green-800 hover:to-emerald-600 hover:shadow-[0_12px_36px_rgba(22,163,74,0.45)] hover:after:opacity-60 active:scale-[0.98] active:translate-y-0 max-[480px]:px-5 max-[480px]:py-2.5 max-[480px]:text-[0.85rem]">
                                {{ $hero->button_text ?? 'Lihat Berita' }}
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                    <polyline points="12 5 19 12 12 19" />
                                </svg>
                            </a>
                            <a href="{{ route('tentang') }}" wire:navigate
                                class="inline-flex items-center gap-2 rounded-xl border-[1.5px] border-white/30 bg-transparent px-8 py-3.5 text-base font-semibold text-white no-underline transition-all duration-200 hover:border-white hover:bg-white/10 max-[480px]:px-4 max-[480px]:py-2 max-[480px]:text-[0.8rem]">
                                Tentang Kami
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 16 16 12 12 8" />
                                    <line x1="8" y1="12" x2="16" y2="12" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if ($heroCount > 1)
            <div class="absolute bottom-10 left-1/2 z-10 flex -translate-x-1/2 items-center gap-3 max-[768px]:bottom-6">
                @foreach ($heroes as $index => $hero)
                    <button class="h-3 w-3 cursor-pointer rounded-full border-2 border-white/60 bg-transparent p-0 transition-all duration-300"
                        :class="{ 'border-green-400 bg-green-400 shadow-[0_0_12px_rgba(74,222,128,0.5)]': currentSlide === {{ $index }} }"
                        @click="goTo({{ $index }})"
                        aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>

            <button class="absolute top-1/2 z-10 h-12 w-12 -translate-y-1/2 cursor-pointer border-none bg-transparent p-0 opacity-0 left-6 max-[768px]:h-9 max-[768px]:w-9 max-[768px]:left-3"
                @click="prev" aria-label="Previous slide">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="hidden">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
            </button>
            <button class="absolute top-1/2 z-10 h-12 w-12 -translate-y-1/2 cursor-pointer border-none bg-transparent p-0 opacity-0 right-6 max-[768px]:h-9 max-[768px]:w-9 max-[768px]:right-3"
                @click="next" aria-label="Next slide">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="hidden">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
            </button>
        @endif
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- WAVE DIVIDER -->
    <!-- ════════════════════════════════════════════ -->
    <div class="relative z-[2] -mt-0.5">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
            class="block h-auto w-full">
            <path d="M0 40C240 0 360 80 720 40C1080 0 1200 80 1440 40V80H0V40Z" fill="white" />
        </svg>
    </div>

    <!-- ════════════════════════════════════════════ -->
    <!-- BERITA SECTION -->
    <!-- ════════════════════════════════════════════ -->
    <section class="mx-auto max-w-[1200px] px-6 py-20" id="berita">
        <div class="mb-12 text-center">
            <div class="mb-3 inline-block rounded-full bg-emerald-600/10 px-3.5 py-1 text-[0.8rem] font-semibold text-emerald-600">Berita Terkini</div>
            <h2 class="mb-3 text-[clamp(1.75rem,4vw,2.5rem)] font-extrabold tracking-[-0.5px] text-gray-900">Berita Terbaru</h2>
            <p class="mx-auto max-w-[500px] text-[1.05rem] leading-relaxed text-gray-500">Ikuti perkembangan berita terbaru dan informasi menarik lainnya</p>
        </div>

        @if ($this->articles->isNotEmpty())
            <div class="grid grid-cols-1 gap-7 md:grid-cols-[repeat(auto-fill,minmax(340px,1fr))]">
                @foreach ($this->articles as $article)
                    <article class="group overflow-hidden rounded-2xl border border-emerald-500/10 bg-white shadow-[0_1px_3px_rgba(0,0,0,0.04)] transition-all duration-300 hover:-translate-y-1 hover:border-emerald-500/20 hover:shadow-[0_12px_40px_rgba(22,163,74,0.12)]">
                        @if ($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                class="h-[200px] w-full bg-gray-100 object-cover" loading="lazy">
                        @else
                            <div class="flex h-[200px] w-full items-center justify-center bg-gradient-to-br from-emerald-100 to-green-100 text-4xl font-bold text-emerald-600">B</div>
                        @endif
                        <div class="px-6 pb-6 pt-5">
                            <div class="mb-2 flex items-center gap-1.5 text-[0.8rem] font-medium text-gray-400">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                    <line x1="16" y1="2" x2="16" y2="6" />
                                    <line x1="8" y1="2" x2="8" y2="6" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                </svg>
                                {{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}
                            </div>
                            <h3 class="mb-2 line-clamp-2 text-[1.1rem] font-bold leading-snug text-gray-900 transition-colors group-hover:text-emerald-600">{{ $article->title }}</h3>
                            <p class="line-clamp-2 text-[0.88rem] leading-relaxed text-gray-500">
                                {{ $article->summary ?? Str::limit(strip_tags($article->content), 120) }}</p>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-100 px-6 py-4">
                            <span class="text-[0.8rem] text-gray-400">{{ $article->author->name ?? 'Admin' }}</span>
                            <a href="{{ route('berita.detail', $article->slug) }}" wire:navigate
                                class="inline-flex items-center gap-1 text-[0.88rem] font-semibold text-emerald-600 no-underline transition-all hover:gap-2">
                                Baca Selengkapnya
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                    <polyline points="12 5 19 12 12 19" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-10 text-center">
                <a href="/berita" wire:navigate
                    class="relative inline-flex cursor-pointer items-center gap-2.5 rounded-[14px] border-none bg-gradient-to-br from-emerald-600 to-green-500 px-9 py-4 text-[1.05rem] font-bold tracking-[0.3px] text-white no-underline shadow-[0_4px_20px_rgba(22,163,74,0.3)] transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] hover:-translate-y-[3px] hover:scale-[1.02] hover:from-green-800 hover:to-emerald-600 hover:shadow-[0_12px_36px_rgba(22,163,74,0.45)] active:scale-[0.98]">
                    Lihat Semua Berita
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                    </svg>
                </a>
            </div>
        @else
            <div class="py-15 text-center text-gray-400">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                    class="mx-auto mb-4 opacity-40">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                    <line x1="16" y1="13" x2="8" y2="13" />
                    <line x1="16" y1="17" x2="8" y2="17" />
                    <polyline points="10 9 9 9 8 9" />
                </svg>
                <p class="text-[1.1rem]">Belum ada berita yang dipublikasikan.</p>
            </div>
        @endif
    </section>

    @if ($this->instagramActive)
        <!-- ════════════════════════════════════════════ -->
        <!-- INSTAGRAM SECTION -->
        <!-- ════════════════════════════════════════════ -->
        <section class="mx-auto max-w-[1200px] px-6 pb-10">
            <div class="mb-12 text-center">
                <div class="mb-3 inline-block rounded-full bg-emerald-600/10 px-3.5 py-1 text-[0.8rem] font-semibold text-emerald-600">Instagram</div>
                <h2 class="mb-3 text-[clamp(1.75rem,4vw,2.5rem)] font-extrabold tracking-[-0.5px] text-gray-900">Ikuti Kami di Instagram</h2>
                <p class="mx-auto max-w-[500px] text-[1.05rem] leading-relaxed text-gray-500">Lihat kegiatan dan momen terbaru dari Pondok Pesantren Syafa'aturrasul</p>
            </div>

            @if (!empty($this->instagramPosts))
                <div class="grid grid-cols-[repeat(auto-fill,minmax(280px,1fr))] gap-5">
                    @foreach ($this->instagramPosts as $post)
                        <a href="{{ $post['permalink'] }}" target="_blank" rel="noopener noreferrer"
                            class="group block overflow-hidden rounded-[14px] border border-emerald-500/10 bg-white shadow-[0_1px_3px_rgba(0,0,0,0.04)] transition-all duration-300 hover:-translate-y-1 hover:border-purple-500/20 hover:shadow-[0_12px_40px_rgba(131,58,180,0.12)] no-underline">
                            <div class="relative aspect-square w-full overflow-hidden bg-gray-100">
                                @if ($post['is_video'])
                                    <div class="absolute right-3 top-3 z-[2] flex h-9 w-9 items-center justify-center rounded-full bg-black/60 text-white backdrop-blur">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <polygon points="5 3 19 12 5 21 5 3" />
                                        </svg>
                                    </div>
                                @endif
                                <img src="{{ $post['image_url'] }}" alt="{{ $post['caption'] ?: 'Instagram Post' }}"
                                    class="block h-full w-full object-cover transition-transform duration-400 group-hover:scale-[1.08]" loading="lazy"
                                    onerror="this.parentElement.classList.add('img-error')">
                                <div class="absolute inset-0 flex items-end justify-center bg-gradient-to-t from-black/50 to-transparent pb-5 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="h-[22px] w-[22px] text-white/90">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                    </svg>
                                </div>
                            </div>
                            @if ($post['caption'])
                                <p class="m-0 line-clamp-2 px-4 pb-4 pt-3 text-[0.82rem] leading-relaxed text-gray-500">{{ $post['caption'] }}</p>
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif

            <div class="mt-10 text-center">
                <a href="https://www.instagram.com/{{ $this->instagramUsername }}" target="_blank"
                    rel="noopener noreferrer"
                    class="relative inline-flex cursor-pointer items-center gap-2.5 rounded-[14px] border-none px-9 py-4 text-[1.05rem] font-bold tracking-[0.3px] text-white no-underline shadow-[0_4px_20px_rgba(22,163,74,0.3)] transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] hover:-translate-y-[3px] hover:scale-[1.02] hover:shadow-[0_12px_36px_rgba(22,163,74,0.45)] active:scale-[0.98]"
                    style="background:linear-gradient(135deg,#833ab4,#fd1d1d,#f77737);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                    </svg>
                    Ikuti Kami
                </a>
            </div>
        </section>
    @endif

    <!-- ════════════════════════════════════════════ -->
    <!-- CTA SECTION -->
    <!-- ════════════════════════════════════════════ -->
    <section class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-emerald-500 to-green-500 px-6 py-20 text-center [&>*]:relative [&>*]:z-[1] before:absolute before:inset-0 before:bg-[radial-gradient(circle,rgba(255,255,255,0.08)_1px,transparent_1px)] before:bg-[size:24px_24px] before:opacity-50">
        <div class="mb-12">
            <h2 class="mb-3 text-[clamp(1.75rem,4vw,2.5rem)] font-extrabold tracking-[-0.5px] text-white">Daftar Di Pondok Pesantren Syafa'aturrasul</h2>
            <p class="mx-auto max-w-[600px] text-[1.05rem] leading-relaxed text-white/85">Mari bergabung menjadi Generasi Penurus Ber Akhlak Mulia
            </p>
        </div>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="https://data.syafaaturrasul.com/pendaftaran"
                class="relative inline-flex cursor-pointer items-center gap-2.5 rounded-[14px] border-none bg-white px-9 py-4 text-[1.05rem] font-bold tracking-[0.3px] text-emerald-600 no-underline shadow-[0_4px_20px_rgba(22,163,74,0.3)] transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] hover:-translate-y-[3px] hover:scale-[1.02] hover:shadow-[0_12px_36px_rgba(22,163,74,0.45)] active:scale-[0.98]">
                Daftar Sekarang
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <polyline points="12 5 19 12 12 19" />
                </svg>
            </a>
            <a href="#berita"
                class="inline-flex items-center gap-2 rounded-xl border-[1.5px] border-white/30 bg-transparent px-8 py-3.5 text-base font-semibold text-white no-underline transition-all duration-200 hover:border-white hover:bg-white/10">Jelajahi
                Berita</a>
        </div>
    </section>

</div>
