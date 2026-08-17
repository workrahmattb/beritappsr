<div>

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <section class="relative overflow-hidden bg-gradient-to-br from-emerald-950 via-emerald-800 to-emerald-600 px-6 pb-[50px] pt-[120px] [&>*]:relative [&>*]:z-[1] before:absolute before:inset-0 before:bg-[radial-gradient(circle,rgba(255,255,255,0.05)_1px,transparent_1px)] before:bg-[size:26px_26px] before:opacity-40">
        <div class="mx-auto max-w-[800px] text-center">
            <div class="mb-4 inline-flex items-center gap-1.5 rounded-full bg-white/15 px-4 py-1.5 text-[0.8rem] font-semibold text-white backdrop-blur">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                Tentang Kami
            </div>
            <h1 class="mb-4 text-[clamp(2rem,5vw,3rem)] font-extrabold leading-[1.15] tracking-[-1px] text-white">Tentang Pondok Pesantren</h1>
            <p class="mx-auto max-w-[600px] text-[1.05rem] leading-[1.7] text-white/85">Mengenal lebih dekat Pondok Pesantren Syafa'aturrasul</p>
        </div>
    </section>

    @if ($about)
        <section class="mx-auto max-w-[960px] px-6 pb-20 pt-[60px]">
            <div class="overflow-hidden rounded-3xl bg-white shadow-[0_4px_24px_rgba(0,0,0,0.06)]">
                {{-- Hero Image --}}
                @if ($about->image)
                    <img src="{{ asset('storage/' . $about->image) }}" alt="Tentang Pondok Pesantren" class="max-h-[400px] w-full bg-gray-100 object-cover">
                @endif

                <div class="p-10 max-[768px]:p-6">
                    {{-- Description --}}
                    @if ($about->description)
                        <div class="mb-12 text-[1.05rem] leading-[1.85] text-gray-700 [&_p]:mb-4">
                            @php
                                $paragraphs = preg_split('/\n\s*\n/', trim($about->description));
                            @endphp
                            @foreach ($paragraphs as $para)
                                <p>{!! nl2br(e(trim($para))) !!}</p>
                            @endforeach
                        </div>
                    @endif

                    {{-- Visi & Misi --}}
                    @if ($about->visi || $about->misi)
                        <div class="mb-12 grid grid-cols-1 gap-8 md:grid-cols-2">
                            @if ($about->visi)
                                <div class="rounded-[20px] border border-emerald-600/10 bg-gradient-to-br from-green-50 to-green-100 p-8">
                                    <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-600 to-green-500 text-white">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                    </div>
                                    <h3 class="mb-3 text-[1.15rem] font-bold text-gray-900">Visi</h3>
                                    <p class="text-[0.95rem] leading-[1.7] text-gray-600">{!! nl2br(e($about->visi)) !!}</p>
                                </div>
                            @endif

                            @if ($about->misi)
                                <div class="rounded-[20px] border border-emerald-600/10 bg-gradient-to-br from-green-50 to-green-100 p-8">
                                    <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-600 to-green-500 text-white">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                                    </div>
                                    <h3 class="mb-3 text-[1.15rem] font-bold text-gray-900">Misi</h3>
                                    <p class="text-[0.95rem] leading-[1.7] text-gray-600">{!! nl2br(e($about->misi)) !!}</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Sejarah --}}
                    @if ($about->sejarah)
                        <div class="rounded-[20px] border border-gray-100 bg-gray-50 p-10 max-[768px]:p-6">
                            <div class="mb-5 flex items-center gap-2.5">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0 text-emerald-600"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                <h3 class="text-[1.15rem] font-bold text-gray-900">Sejarah</h3>
                            </div>
                            <div class="text-base leading-[1.85] text-gray-600 [&_p]:mb-4">
                                @php
                                    $paragraphs = preg_split('/\n\s*\n/', trim($about->sejarah));
                                @endphp
                                @foreach ($paragraphs as $para)
                                    <p>{!! nl2br(e(trim($para))) !!}</p>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @else
        {{-- Empty State --}}
        <section class="mx-auto max-w-[960px] px-6 pb-20 pt-[60px]">
            <div class="px-6 py-[60px] text-center text-gray-400">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-4 opacity-40">
                    <circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                <p class="text-[1.1rem]">Halaman Tentang belum tersedia.</p>
                <p class="mt-2 text-[0.9rem]">Silakan isi data di panel admin terlebih dahulu.</p>
            </div>
        </section>
    @endif

</div>
