<div>

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <section class="relative overflow-hidden bg-gradient-to-br from-emerald-950 via-emerald-800 to-emerald-600 px-6 pb-[50px] pt-[120px] [&>*]:relative [&>*]:z-[1] before:absolute before:inset-0 before:bg-[radial-gradient(circle,rgba(255,255,255,0.05)_1px,transparent_1px)] before:bg-[size:26px_26px] before:opacity-40">
        <div class="mx-auto max-w-[900px] px-6">
            <a href="{{ route('fasilitas') }}" wire:navigate
                class="mb-5 inline-flex items-center gap-1.5 text-[0.9rem] text-white/80 no-underline transition-colors hover:text-white">
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

    <section class="relative z-10 mx-auto -mt-[30px] max-w-[960px] px-6 pb-[60px]">
        <div class="overflow-hidden rounded-3xl bg-white shadow-[0_4px_24px_rgba(0,0,0,0.06)]"
             x-data="{
                 currentSlide: 0,
                 images: @js($images),
                 get totalSlides() { return this.images.length },
                 prev() { this.currentSlide = this.currentSlide > 0 ? this.currentSlide - 1 : this.totalSlides - 1 },
                 next() { this.currentSlide = this.currentSlide < this.totalSlides - 1 ? this.currentSlide + 1 : 0 },
                 goTo(i) { this.currentSlide = i }
             }">

            {{-- Gallery --}}
            @if ($hasImages)
                <div class="group relative w-full overflow-hidden bg-gray-100">
                    <div class="relative aspect-video w-full overflow-hidden max-[480px]:aspect-square max-[768px]:aspect-[4/3]">
                        <template x-for="(img, index) in images" :key="index">
                            <div class="absolute inset-0 opacity-0 transition-opacity duration-500 [&.active]:opacity-100" :class="{ 'active': currentSlide === index }">
                                <img :src="'/storage/' + img" :alt="'{{ $facility->name }} - ' + (index + 1)" class="h-full w-full object-cover">
                            </div>
                        </template>

                        <button class="absolute left-4 top-1/2 z-[5] flex h-11 w-11 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full border-0 bg-white/90 text-gray-700 opacity-0 backdrop-blur transition-all duration-200 hover:bg-emerald-600 hover:text-white group-hover:pointer-events-auto group-hover:opacity-100" x-show="totalSlides > 1" @click="prev">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                        </button>
                        <button class="absolute right-4 top-1/2 z-[5] flex h-11 w-11 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full border-0 bg-white/90 text-gray-700 opacity-0 backdrop-blur transition-all duration-200 hover:bg-emerald-600 hover:text-white group-hover:pointer-events-auto group-hover:opacity-100" x-show="totalSlides > 1" @click="next">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                        </button>

                        <div class="absolute bottom-4 left-1/2 z-[5] flex -translate-x-1/2 gap-2" x-show="totalSlides > 1">
                            <template x-for="(dot, index) in images" :key="index">
                                <button class="h-2.5 w-2.5 cursor-pointer rounded-full border-0 bg-white/50 p-0 transition-all duration-300 hover:bg-white/80 [&.active]:w-7 [&.active]:rounded-md [&.active]:bg-white" :class="{ 'active': currentSlide === index }" @click="goTo(index)"></button>
                            </template>
                        </div>

                        <div class="absolute right-4 top-4 z-[5] flex items-center gap-1 rounded-full bg-black/50 px-3 py-1.5 text-[0.78rem] font-semibold text-white backdrop-blur" x-show="totalSlides > 1">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            <span x-text="(currentSlide + 1) + '/' + totalSlides"></span>
                        </div>
                    </div>

                    {{-- Thumbnails --}}
                    <div class="flex gap-2 overflow-x-auto border-t border-gray-100 bg-gray-50 px-4 py-3" x-show="totalSlides > 1">
                        <template x-for="(img, index) in images" :key="index">
                            <button class="h-12 w-[72px] flex-shrink-0 cursor-pointer overflow-hidden rounded-lg border-2 border-transparent bg-gray-100 p-0 transition-all duration-200 hover:border-emerald-600 [&.active]:border-emerald-600" :class="{ 'active': currentSlide === index }" @click="goTo(index)">
                                <img :src="'/storage/' + img" :alt="'Thumbnail ' + (index + 1)" class="h-full w-full object-cover">
                            </button>
                        </template>
                    </div>
                </div>
            @else
                <div class="flex aspect-video w-full items-center justify-center bg-gradient-to-br from-green-100 to-green-200 text-emerald-600">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
            @endif

            {{-- Content --}}
            <div class="px-10 py-8 pb-10 max-[768px]:p-6">
                <div class="mb-3 inline-block rounded-full bg-emerald-600/10 px-3.5 py-1 text-[0.8rem] font-semibold text-emerald-600">Fasilitas</div>
                <h1 class="mb-5 text-[clamp(1.5rem,3vw,2rem)] font-extrabold tracking-[-0.5px] text-gray-900">{{ $facility->name }}</h1>
                <div class="mb-6 h-[3px] w-[50px] rounded bg-gradient-to-br from-emerald-600 to-green-500"></div>

                @if ($facility->description)
                    <div class="text-[1.05rem] leading-[1.85] text-gray-700 [&_p]:mb-[1.2em] [&_p:last-child]:mb-0">
                        @php
                            $paragraphs = preg_split('/\n\s*\n/', trim($facility->description));
                        @endphp
                        @foreach ($paragraphs as $para)
                            <p>{!! nl2br(e(trim($para))) !!}</p>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-[1.05rem] leading-[1.85] text-gray-400">
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
        <section class="mx-auto max-w-[1200px] px-6 pb-20">
            <div class="mb-10 text-center">
                <div class="mb-3 inline-block rounded-full bg-emerald-600/10 px-3.5 py-1 text-[0.8rem] font-semibold text-emerald-600">Lainnya</div>
                <h2 class="text-[clamp(1.3rem,2.5vw,1.75rem)] font-extrabold tracking-[-0.5px] text-gray-900">Fasilitas Lainnya</h2>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-[repeat(auto-fill,minmax(300px,1fr))]">
                @foreach ($this->relatedFacilities as $related)
                    <a href="{{ route('fasilitas.detail', $related->slug) }}" wire:navigate class="group block overflow-hidden rounded-2xl border border-emerald-500/10 bg-white text-inherit no-underline shadow-[0_1px_3px_rgba(0,0,0,0.04)] transition-all duration-300 hover:-translate-y-1 hover:border-emerald-500/20 hover:shadow-[0_12px_40px_rgba(22,163,74,0.12)]">
                        @php $firstImg = $related->first_image; @endphp
                        @if ($firstImg)
                            <img src="{{ asset('storage/' . $firstImg) }}" alt="{{ $related->name }}" class="block h-[180px] w-full bg-gray-100 object-cover" loading="lazy">
                        @else
                            <div class="flex h-[180px] w-full items-center justify-center bg-gradient-to-br from-green-100 to-green-200 text-emerald-600">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            </div>
                        @endif
                        <div class="px-5 pb-5 pt-4">
                            <h3 class="mb-1 text-base font-bold text-gray-900 transition-colors group-hover:text-emerald-600">{{ $related->name }}</h3>
                            @if ($related->description)
                                <p class="line-clamp-2 text-[0.85rem] leading-[1.5] text-gray-500">{{ $related->description }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

</div>
