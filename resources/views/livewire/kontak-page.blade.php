<div>

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <section class="bg-gradient-to-br from-emerald-950 via-emerald-800 to-emerald-600 px-6 pb-[50px] pt-[120px] text-center">
        <div class="mx-auto max-w-[800px] text-center">
            <div class="mb-4 inline-flex items-center gap-1.5 rounded-full bg-white/15 px-4 py-1.5 text-[0.8rem] font-semibold text-white backdrop-blur">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                Hubungi Kami
            </div>
            <h1 class="mb-4 text-[clamp(2rem,5vw,3rem)] font-extrabold leading-[1.15] tracking-[-1px] text-white">Kontak &amp; Lokasi</h1>
            <p class="mx-auto max-w-[600px] text-[1.05rem] leading-[1.7] text-white/85">Silakan hubungi kami melalui WhatsApp atau kunjungi langsung pondok pesantren.</p>
        </div>
    </section>

    @if ($waNumbers->isNotEmpty() || $mapsList->isNotEmpty())
        <!-- ════════════════════════════════════════════ -->
        <!-- CONTACT SECTION -->
        <!-- ════════════════════════════════════════════ -->
        <section class="mx-auto max-w-[1200px] px-6 pb-20 pt-[60px]">
            <div class="grid grid-cols-1 items-start gap-10 lg:grid-cols-2">
                {{-- Left: WhatsApp Numbers --}}
                <div>
                    @if ($waNumbers->isNotEmpty())
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            @foreach ($waNumbers as $wa)
                                <a href="https://wa.me/{{ $wa->nomor_wa }}?text=Assalamualaikum%20Warohmatullahi%20Wabarokatuh%2C%20Saya%20Ingin%20Daftar"
                                   target="_blank" rel="noopener noreferrer"
                                   class="block rounded-[20px] border border-[#25D366]/10 bg-white p-7 text-inherit no-underline shadow-[0_1px_3px_rgba(0,0,0,0.04)] transition-all duration-300 hover:-translate-y-[3px] hover:border-[#25D366]/25 hover:shadow-[0_8px_32px_rgba(37,211,102,0.12)] max-[480px]:p-5">
                                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-[14px] bg-gradient-to-br from-green-100 to-green-200 text-[#25D366]">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                    </div>
                                    <h3 class="mb-1 text-[0.85rem] font-bold uppercase tracking-[0.5px] text-gray-400">{{ $wa->label ?: 'WhatsApp' }}</h3>
                                    <div class="break-words text-base font-semibold leading-[1.5] text-gray-900">{{ $wa->nomor_wa }}</div>
                                    <span class="mt-3 inline-flex items-center gap-1 rounded-full bg-[#25D366]/10 px-2.5 py-1 text-[0.72rem] font-semibold text-emerald-600">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                                        Klik untuk chat
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center gap-3 rounded-[20px] bg-gray-100 px-6 py-[60px] text-center text-gray-400">
                            <p class="text-[0.9rem]">Belum ada nomor WhatsApp.</p>
                        </div>
                    @endif
                </div>

                {{-- Right: Maps List --}}
                <div class="flex flex-col gap-6">
                    @if ($mapsList->isNotEmpty())
                        @foreach ($mapsList as $mapItem)
                            <div class="overflow-hidden rounded-[20px] border border-emerald-500/10 bg-white shadow-[0_1px_3px_rgba(0,0,0,0.04)]">
                                <div class="flex items-center gap-2.5 border-b border-gray-100 px-6 py-5">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0 text-emerald-600"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    <h3 class="text-[0.95rem] font-bold text-gray-900">{{ $mapItem->label ?: 'Lokasi' }}</h3>
                                </div>
                                <div class="w-full [&_iframe]:block [&_iframe]:h-[380px] [&_iframe]:w-full [&_iframe]:border-0 max-[768px]:[&_iframe]:h-[280px]">
                                    {!! $mapItem->embed_code !!}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="overflow-hidden rounded-[20px] border border-emerald-500/10 bg-white shadow-[0_1px_3px_rgba(0,0,0,0.04)]">
                            <div class="flex items-center gap-2.5 border-b border-gray-100 px-6 py-5">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0 text-emerald-600"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <h3 class="text-[0.95rem] font-bold text-gray-900">Lokasi Kami</h3>
                            </div>
                            <div class="flex flex-col items-center justify-center gap-3 bg-gray-100 px-6 py-[60px] text-center text-gray-400">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <p class="text-[0.9rem]">Peta belum tersedia. Silakan atur Google Maps di panel admin.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @else
        {{-- Empty State --}}
        <section class="mx-auto max-w-[1200px] px-6 pb-20 pt-[60px]">
            <div class="px-6 py-[60px] text-center text-gray-400">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-4 opacity-40">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
                <p class="text-[1.1rem]">Info kontak belum tersedia.</p>
                <p class="mt-2 text-[0.9rem]">Silakan isi data WhatsApp dan Google Maps di panel admin terlebih dahulu.</p>
            </div>
        </section>
    @endif

    <!-- ════════════════════════════════════════════ -->
    <!-- CTA SECTION -->
    <!-- ════════════════════════════════════════════ -->
    <section class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-emerald-500 to-green-500 px-6 py-20 text-center [&>*]:relative [&>*]:z-[1] before:absolute before:inset-0 before:bg-[radial-gradient(circle,rgba(255,255,255,0.05)_1px,transparent_1px)] before:bg-[size:26px_26px] before:opacity-50">
        <h2 class="mb-3 text-[clamp(1.5rem,3vw,2rem)] font-extrabold tracking-[-0.5px] text-white">Kunjungi Pondok Pesantren Syafa'aturrasul</h2>
        <p class="mx-auto mb-6 max-w-[500px] text-[1.05rem] leading-[1.6] text-white/85">Datang langsung dan saksikan suasana belajar yang nyaman dan islami</p>
        <div class="flex flex-wrap items-center justify-center gap-3">
            @if ($waNumbers->isNotEmpty())
                <a href="https://wa.me/{{ $waNumbers->first()->nomor_wa }}?text=Assalamualaikum%20Warohmatullahi%20Wabarokatuh%2C%20Saya%20Ingin%20Daftar"
                   target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2.5 rounded-[14px] bg-white px-9 py-4 text-[1.05rem] font-bold text-emerald-600 no-underline shadow-[0_4px_20px_rgba(0,0,0,0.15)] transition-all duration-300 hover:-translate-y-0.5">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    Hubungi via WhatsApp
                </a>
            @endif
            <a href="{{ route('fasilitas') }}" wire:navigate
               class="inline-flex items-center gap-2 rounded-xl border-[1.5px] border-white/30 px-8 py-3.5 text-base font-semibold text-white no-underline transition-all duration-250 hover:border-white hover:bg-white/10">
                Lihat Fasilitas
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </section>

</div>
