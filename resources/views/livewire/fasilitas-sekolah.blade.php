<div>

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <section class="relative overflow-hidden bg-gradient-to-br from-emerald-950 via-emerald-800 to-emerald-600 px-6 pb-[50px] pt-[120px] [&>*]:relative [&>*]:z-[1] before:absolute before:inset-0 before:bg-[radial-gradient(circle,rgba(255,255,255,0.05)_1px,transparent_1px)] before:bg-[size:26px_26px] before:opacity-40">
        <div class="mx-auto max-w-[800px] text-center">
            <div class="mb-4 inline-flex items-center gap-1.5 rounded-full bg-white/15 px-4 py-1.5 text-[0.8rem] font-semibold text-white backdrop-blur">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><line x1="9" y1="6" x2="15" y2="6"/><line x1="9" y1="10" x2="15" y2="10"/><line x1="9" y1="14" x2="13" y2="14"/></svg>
                Fasilitas Sekolah
            </div>
            <h1 class="mb-4 text-[clamp(2rem,5vw,3rem)] font-extrabold leading-[1.15] tracking-[-1px] text-white">Sarana &amp; Prasarana</h1>
            <p class="mx-auto max-w-[600px] text-[1.05rem] leading-[1.7] text-white/85">Berbagai fasilitas lengkap untuk menunjang kegiatan belajar mengajar dan pengembangan santri di Pondok Pesantren Syafa'aturrasul.</p>
        </div>
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- FACILITY LIST -->
    <!-- ════════════════════════════════════════════ -->
    <section class="mx-auto max-w-[1200px] px-6 pb-20 pt-[60px]">
        @if($facilities->isNotEmpty())
            <div class="grid grid-cols-1 gap-8 md:grid-cols-[repeat(auto-fill,minmax(380px,1fr))]">
                @foreach($facilities as $facility)
                    @php
                        $images = $facility->images ?? [];
                        $hasImages = count($images) > 0;
                    @endphp
                    <a href="{{ route('fasilitas.detail', $facility->slug) }}" wire:navigate class="group block overflow-hidden rounded-[20px] border border-emerald-500/10 bg-white text-inherit no-underline shadow-[0_1px_3px_rgba(0,0,0,0.04)] transition-all duration-300 hover:-translate-y-1 hover:border-emerald-500/20 hover:shadow-[0_12px_40px_rgba(22,163,74,0.12)]"
                         x-data="{ currentSlide: 0, images: @js($images), totalSlides: {{ count($images) > 0 ? count($images) : 1 }} }">
                        <div class="relative h-[240px] w-full overflow-hidden bg-gray-100 max-[480px]:h-[200px]">
                            @if($hasImages)
                                <template x-for="(img, index) in images" :key="index">
                                    <div class="absolute inset-0 opacity-0 transition-opacity duration-500 [&.active]:opacity-100" :class="{ 'active': currentSlide === index }">
                                        <img :src="'/storage/' + img" :alt="'{{ $facility->name }} - ' + (index + 1)" class="h-full w-full object-cover" loading="lazy">
                                    </div>
                                </template>

                                <button class="absolute left-2.5 top-1/2 z-[5] flex h-9 w-9 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full border-0 bg-white/90 text-gray-700 opacity-0 transition-all duration-200 hover:bg-emerald-600 hover:text-white group-hover:pointer-events-auto group-hover:opacity-100"
                                    x-show="totalSlides > 1"
                                    @click="currentSlide = currentSlide > 0 ? currentSlide - 1 : totalSlides - 1">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                                </button>
                                <button class="absolute right-2.5 top-1/2 z-[5] flex h-9 w-9 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full border-0 bg-white/90 text-gray-700 opacity-0 transition-all duration-200 hover:bg-emerald-600 hover:text-white group-hover:pointer-events-auto group-hover:opacity-100"
                                    x-show="totalSlides > 1"
                                    @click="currentSlide = currentSlide < totalSlides - 1 ? currentSlide + 1 : 0">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                                </button>

                                <div class="absolute bottom-2.5 left-1/2 z-[5] flex -translate-x-1/2 gap-1.5" x-show="totalSlides > 1">
                                    <template x-for="(dot, index) in images" :key="index">
                                        <button class="h-2 w-2 cursor-pointer rounded-full border-0 bg-white/50 p-0 transition-all duration-300 hover:bg-white/80 [&.active]:w-6 [&.active]:rounded [&.active]:bg-white" :class="{ 'active': currentSlide === index }"
                                            @click="currentSlide = index"></button>
                                    </template>
                                </div>

                                <div class="absolute right-3 top-3 z-[5] flex items-center gap-1 rounded-full bg-black/50 px-2.5 py-1 text-[0.75rem] font-semibold text-white backdrop-blur" x-show="totalSlides > 1">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                    <span x-text="(currentSlide + 1) + '/' + totalSlides"></span>
                                </div>
                            @else
                                <div class="flex h-[240px] w-full items-center justify-center bg-gradient-to-br from-green-100 to-green-200 text-emerald-600">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                </div>
                            @endif
                        </div>

                        <div class="p-6">
                            <h3 class="mb-2 text-[1.15rem] font-bold leading-[1.3] text-gray-900 transition-colors group-hover:text-emerald-600">{{ $facility->name }}</h3>
                            @if($facility->description)
                                <p class="line-clamp-3 text-[0.88rem] leading-[1.65] text-gray-500">{{ $facility->description }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="px-6 py-20 text-center text-gray-400">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-4 opacity-40"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <p class="mt-3 text-base">Belum ada data fasilitas.</p>
            </div>
        @endif
    </section>

</div>
