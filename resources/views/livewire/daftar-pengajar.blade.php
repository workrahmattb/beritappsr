<div>

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <div class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-emerald-500 to-green-500 px-6 pb-[60px] pt-[120px] text-center [&>*]:relative [&>*]:z-[1] before:absolute before:inset-0 before:bg-[radial-gradient(circle,rgba(255,255,255,0.08)_1px,transparent_1px)] before:bg-[size:24px_24px] before:opacity-50">
        <div class="mb-3 inline-block rounded-full bg-white/15 px-3.5 py-1 text-[0.8rem] font-semibold text-white/90 backdrop-blur">
            {{ $category === 'pimpinan' ? 'Pimpinan' : 'Pengajar' }}
        </div>
        <h1 class="mb-3 text-[clamp(2rem,5vw,3rem)] font-extrabold tracking-[-0.5px] text-white">{{ $title }}</h1>
        <p class="mx-auto max-w-[500px] text-[1.05rem] leading-relaxed text-white/85">Mengenal lebih dekat para {{ strtolower($title) }} di Pondok Pesantren Syafa'aturrasul</p>
    </div>

    <!-- ════════════════════════════════════════════ -->
    <!-- TEACHER GRID -->
    <!-- ════════════════════════════════════════════ -->
    <div class="mx-auto max-w-[1200px] px-6 pb-20 pt-[60px]">
        @if ($this->teachers->isNotEmpty())
            <div class="grid grid-cols-1 gap-7 min-[480px]:grid-cols-[repeat(auto-fill,minmax(240px,1fr))] md:grid-cols-[repeat(auto-fill,minmax(280px,1fr))]">
                @foreach ($this->teachers as $teacher)
                    @php
                        $detailRoute = match ($teacher->category) {
                            'pimpinan' => route('profile.pimpinan.detail', $teacher->slug),
                            'guru'     => route('profile.pengajar.detail', $teacher->slug),
                            default    => url('/'),
                        };
                    @endphp
                    <a href="{{ $detailRoute }}" wire:navigate class="group block overflow-hidden rounded-2xl border border-emerald-500/10 bg-white text-center text-inherit no-underline shadow-[0_1px_3px_rgba(0,0,0,0.04)] transition-all duration-300 hover:-translate-y-1 hover:border-emerald-500/20 hover:shadow-[0_12px_40px_rgba(22,163,74,0.12)]">
                        <div class="flex aspect-square w-full items-center justify-center overflow-hidden bg-gradient-to-br from-green-100 to-green-200">
                            @if ($teacher->photo)
                                <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="block h-full w-full object-cover transition-transform duration-400 group-hover:scale-[1.05]" loading="lazy">
                            @else
                                <div class="text-[3.5rem] font-bold text-emerald-600 opacity-50">
                                    {{ strtoupper(substr($teacher->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="px-5 pb-6 pt-5">
                            <div class="mb-1 text-[1.1rem] font-bold text-gray-900 transition-colors group-hover:text-emerald-600">{{ $teacher->name }}</div>
                            @if ($teacher->position)
                                <div class="mb-3 text-[0.85rem] font-medium text-gray-500">{{ $teacher->position }}</div>
                            @endif
                            <span class="inline-block rounded-full bg-emerald-600/10 px-3 py-0.5 text-[0.75rem] font-semibold text-emerald-600 {{ $teacher->category === 'pimpinan' ? 'bg-amber-500/10 text-amber-600' : '' }} {{ $teacher->category === 'pembina_asrama' ? 'bg-blue-500/10 text-blue-600' : '' }}">
                                {{ $teacher->categoryLabel() }}
                            </span>
                            @if ($teacher->bio)
                                <div class="mt-3 line-clamp-3 border-t border-gray-100 pt-3 text-[0.85rem] leading-relaxed text-gray-500">{{ $teacher->bio }}</div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="py-15 text-center text-gray-400">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-4 opacity-40">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
                <p class="text-[1.1rem]">Belum ada data {{ strtolower($title) }}.</p>
            </div>
        @endif
    </div>

</div>
