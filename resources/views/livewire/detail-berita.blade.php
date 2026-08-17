<div>

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <section class="relative overflow-hidden bg-gradient-to-br from-emerald-900 via-emerald-700 to-emerald-500 px-6 pb-10 pt-[120px] [&>*]:relative [&>*]:z-[1] before:absolute before:inset-0 before:bg-[radial-gradient(circle,rgba(255,255,255,0.08)_1px,transparent_1px)] before:bg-[size:24px_24px] before:opacity-50">
        <div class="mx-auto max-w-[800px] px-6">
            <a href="{{ url()->previous() === url()->current() ? url('/berita') : url()->previous() }}"
                class="mb-5 inline-flex items-center gap-1.5 text-sm text-white/80 no-underline transition-colors hover:text-white">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12" /><polyline points="12 19 5 12 12 5" /></svg>
                Kembali
            </a>

            <div class="mb-4 flex flex-wrap items-center gap-4">
                <span class="inline-flex items-center gap-1.5 text-[0.85rem] text-white/75">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2" /><line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" /><line x1="3" y1="10" x2="21" y2="10" /></svg>
                    {{ $article->published_at ? $article->published_at->format('d F Y') : '-' }}
                </span>
                <span class="inline-flex items-center gap-1.5 text-[0.85rem] text-white/75">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" /><circle cx="12" cy="7" r="4" /></svg>
                    {{ $article->author->name ?? 'Admin' }}
                </span>
            </div>

            <h1 class="mb-0 text-[clamp(1.75rem,4vw,2.5rem)] font-extrabold leading-[1.2] tracking-[-0.5px] text-white">{{ $article->title }}</h1>
        </div>
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- ARTICLE CONTENT -->
    <!-- ════════════════════════════════════════════ -->
    <section class="relative z-10 mx-auto -mt-[30px] max-w-[800px] px-6 pb-[60px]">
        <article class="overflow-hidden rounded-[20px] bg-white shadow-[0_4px_24px_rgba(0,0,0,0.06)]">
            @if($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="max-h-[450px] w-full bg-gray-100 object-cover">
            @endif

            <div class="p-6 md:p-10">

                <div class="text-[1.05rem] leading-[1.85] text-gray-700 [&_p]:mb-[1.2em] [&_h2]:mt-[2em] [&_h2]:mb-[0.6em] [&_h2]:text-[1.5rem] [&_h2]:font-bold [&_h2]:text-gray-900 [&_h3]:mt-[1.5em] [&_h3]:mb-[0.5em] [&_h3]:text-[1.25rem] [&_h3]:font-semibold [&_h3]:text-gray-900 [&_ul]:mb-[1.2em] [&_ul]:list-disc [&_ul]:pl-[1.5em] [&_ol]:mb-[1.2em] [&_ol]:list-decimal [&_ol]:pl-[1.5em] [&_li]:mb-[0.4em] [&_blockquote]:my-[1.5em] [&_blockquote]:rounded-r-lg [&_blockquote]:border-l-4 [&_blockquote]:border-emerald-600 [&_blockquote]:bg-green-50 [&_blockquote]:px-5 [&_blockquote]:py-3 [&_blockquote]:italic [&_blockquote]:text-green-800 [&_a]:text-emerald-600 [&_a]:underline [&_a]:underline-offset-2 [&_img]:mx-auto [&_img]:my-[1.5em] [&_img]:block [&_img]:h-auto [&_img]:max-w-full [&_img]:rounded-xl [&_img]:shadow-[0_2px_12px_rgba(0,0,0,0.08)] [&_pre]:my-[1.5em] [&_pre]:overflow-x-auto [&_pre]:rounded-xl [&_pre]:bg-gray-800 [&_pre]:px-5 [&_pre]:py-4 [&_pre]:text-[0.9rem] [&_pre]:text-gray-200 [&_code]:rounded [&_code]:bg-gray-100 [&_code]:px-1.5 [&_code]:py-0.5 [&_code]:text-[0.9em] [&_pre_code]:bg-transparent [&_pre_code]:p-0 [&_hr]:my-[2em] [&_hr]:border-t [&_hr]:border-gray-200">
                    {!! $article->content !!}
                </div>
            </div>

            <div class="flex flex-col flex-wrap items-start gap-4 border-t border-gray-100 bg-gray-50 px-6 py-4 md:flex-row md:items-center md:justify-between md:px-10 md:py-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-emerald-600 to-green-700 text-sm font-bold text-white">
                        {{ strtoupper(substr($article->author->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[0.9rem] font-semibold text-gray-900">{{ $article->author->name ?? 'Admin' }}</span>
                        <span class="text-[0.8rem] text-gray-400">Penulis</span>
                    </div>
                </div>

                <div class="flex gap-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-4 py-2 text-[0.8rem] font-semibold text-gray-600 no-underline transition-all hover:border-emerald-600 hover:bg-green-50 hover:text-emerald-600" title="Bagikan ke Facebook">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" /></svg>
                        Facebook
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-4 py-2 text-[0.8rem] font-semibold text-gray-600 no-underline transition-all hover:border-emerald-600 hover:bg-green-50 hover:text-emerald-600" title="Bagikan ke WhatsApp">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" /></svg>
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
        <section class="mx-auto max-w-[1200px] px-6 pb-20">
            <div class="mb-10 text-center">
                <div class="mb-3 inline-block rounded-full bg-emerald-600/10 px-3.5 py-1 text-[0.8rem] font-semibold text-emerald-600">Artikel Terkait</div>
                <h2 class="text-[clamp(1.5rem,3vw,2rem)] font-extrabold tracking-[-0.5px] text-gray-900">Berita Lainnya</h2>
            </div>

            <div class="grid grid-cols-1 gap-7 md:grid-cols-[repeat(auto-fill,minmax(340px,1fr))]">
                @foreach($this->relatedArticles as $related)
                    <article class="group overflow-hidden rounded-2xl border border-emerald-500/10 bg-white shadow-[0_1px_3px_rgba(0,0,0,0.04)] transition-all duration-300 hover:-translate-y-1 hover:border-emerald-500/20 hover:shadow-[0_12px_40px_rgba(22,163,74,0.12)]">
                        <a href="{{ route('berita.detail', $related->slug) }}" class="block no-underline" wire:navigate>
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}" class="h-[200px] w-full bg-gray-100 object-cover" loading="lazy">
                            @else
                                <div class="flex h-[200px] w-full items-center justify-center bg-gradient-to-br from-emerald-100 to-green-100 text-4xl font-bold text-emerald-600">B</div>
                            @endif
                            <div class="px-6 pb-6 pt-5">
                                <div class="mb-2 flex items-center gap-1.5 text-[0.8rem] font-medium text-gray-400">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2" /><line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" /><line x1="3" y1="10" x2="21" y2="10" /></svg>
                                    {{ $related->published_at ? $related->published_at->format('d M Y') : '-' }}
                                </div>
                                <h3 class="mb-2 line-clamp-2 text-[1.1rem] font-bold leading-snug text-gray-900 transition-colors group-hover:text-emerald-600">{{ $related->title }}</h3>
                                <p class="line-clamp-2 text-[0.88rem] leading-relaxed text-gray-500">{{ $related->summary ?? Str::limit(strip_tags($related->content), 120) }}</p>
                            </div>
                        </a>
                        <div class="flex items-center justify-between border-t border-gray-100 px-6 py-4">
                            <span class="text-[0.8rem] text-gray-400">{{ $related->author->name ?? 'Admin' }}</span>
                            <a href="{{ route('berita.detail', $related->slug) }}" class="inline-flex items-center gap-1 text-[0.88rem] font-semibold text-emerald-600 no-underline transition-all hover:gap-2" wire:navigate>
                                Baca Selengkapnya
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12" /><polyline points="12 5 19 12 12 19" /></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

</div>
