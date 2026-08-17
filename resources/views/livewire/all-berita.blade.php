<div>

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <section class="relative overflow-hidden bg-gradient-to-br from-emerald-900 via-emerald-700 to-emerald-500 px-6 pb-[60px] pt-[120px] text-center [&>*]:relative [&>*]:z-[1] before:absolute before:inset-0 before:bg-[radial-gradient(circle,rgba(255,255,255,0.08)_1px,transparent_1px)] before:bg-[size:24px_24px] before:opacity-50">
        <div class="mx-auto max-w-[1200px] px-6">
            <a href="/" wire:navigate
                class="mb-4 inline-flex items-center gap-1.5 text-sm text-white/80 no-underline transition-colors hover:text-white">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12" /><polyline points="12 19 5 12 12 5" /></svg>
                Kembali ke Beranda
            </a>
            <h1 class="mb-2 text-[clamp(1.75rem,4vw,2.5rem)] font-extrabold tracking-[-0.5px] text-white">Semua Berita</h1>
            <p class="text-[1.05rem] text-white/80">Jelajahi seluruh artikel dan berita terkini</p>
        </div>
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- SEARCH -->
    <!-- ════════════════════════════════════════════ -->
    <div class="relative z-10 mx-auto -mt-7 mb-10 max-w-[500px] px-6">
        <svg class="pointer-events-none absolute left-[42px] top-1/2 -translate-y-1/2 text-gray-400" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" /></svg>
        <input
            type="text"
            class="w-full rounded-[14px] border-[1.5px] border-emerald-600/15 bg-white py-4 pl-12 pr-5 text-[0.95rem] text-gray-800 shadow-[0_4px_20px_rgba(0,0,0,0.06)] outline-none transition-all duration-200 placeholder:text-gray-400 focus:border-emerald-600 focus:shadow-[0_4px_24px_rgba(22,163,74,0.15)]"
            placeholder="Cari berita..."
            wire:model.live.debounce.300ms="search"
        >
    </div>

    <!-- ════════════════════════════════════════════ -->
    <!-- BERITA GRID -->
    <!-- ════════════════════════════════════════════ -->
    <section class="mx-auto max-w-[1200px] px-6 pb-20">
        @if($this->articles->isNotEmpty())
            <div class="grid grid-cols-1 gap-7 md:grid-cols-[repeat(auto-fill,minmax(340px,1fr))]">
                @foreach($this->articles as $article)
                    <article class="group overflow-hidden rounded-2xl border border-emerald-500/10 bg-white shadow-[0_1px_3px_rgba(0,0,0,0.04)] transition-all duration-300 hover:-translate-y-1 hover:border-emerald-500/20 hover:shadow-[0_12px_40px_rgba(22,163,74,0.12)]">
                        @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="h-[200px] w-full bg-gray-100 object-cover" loading="lazy">
                        @else
                            <div class="flex h-[200px] w-full items-center justify-center bg-gradient-to-br from-emerald-100 to-green-100 text-4xl font-bold text-emerald-600">B</div>
                        @endif
                        <div class="px-6 pb-6 pt-5">
                            <div class="mb-2 flex items-center gap-1.5 text-[0.8rem] font-medium text-gray-400">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2" /><line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" /><line x1="3" y1="10" x2="21" y2="10" /></svg>
                                {{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}
                            </div>
                            <h3 class="mb-2 line-clamp-2 text-[1.1rem] font-bold leading-snug text-gray-900 transition-colors group-hover:text-emerald-600">{{ $article->title }}</h3>
                            <p class="line-clamp-2 text-[0.88rem] leading-relaxed text-gray-500">{{ $article->summary ?? Str::limit(strip_tags($article->content), 120) }}</p>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-100 px-6 py-4">
                            <span class="text-[0.8rem] text-gray-400">{{ $article->author->name ?? 'Admin' }}</span>
                            <a href="{{ route('berita.detail', $article->slug) }}" wire:navigate class="inline-flex items-center gap-1 text-[0.88rem] font-semibold text-emerald-600 no-underline transition-all hover:gap-2">
                                Baca Selengkapnya
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12" /><polyline points="12 5 19 12 12 19" /></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $this->articles->links() }}
            </div>
        @else
            <div class="py-15 text-center text-gray-400">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-4 opacity-40">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" /><polyline points="14 2 14 8 20 8" /><line x1="16" y1="13" x2="8" y2="13" /><line x1="16" y1="17" x2="8" y2="17" /><polyline points="10 9 9 9 8 9" />
                </svg>
                <p class="text-[1.1rem]">
                    @if($search)
                        Berita dengan kata kunci "{{ $search }}" tidak ditemukan.
                    @else
                        Belum ada berita yang dipublikasikan.
                    @endif
                </p>
                @if($search)
                    <a href="/berita" wire:navigate class="mt-4 inline-block font-semibold text-emerald-600 no-underline">
                        &larr; Tampilkan Semua
                    </a>
                @endif
            </div>
        @endif
    </section>

</div>
