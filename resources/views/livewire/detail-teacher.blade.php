<div>

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <section class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-emerald-500 to-green-500 px-6 pb-[60px] pt-[120px] text-center [&>*]:relative [&>*]:z-[1] before:absolute before:inset-0 before:bg-[radial-gradient(circle,rgba(255,255,255,0.08)_1px,transparent_1px)] before:bg-[size:24px_24px] before:opacity-50">
        <div class="mx-auto max-w-[800px] px-6">
            <a href="{{ $backRoute }}" wire:navigate
                class="mb-5 inline-flex items-center gap-1.5 text-sm text-white/80 no-underline transition-colors hover:text-white">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12" /><polyline points="12 19 5 12 12 5" /></svg>
                Kembali ke {{ $teacher->category === 'pimpinan' ? 'Pimpinan' : 'Pengajar' }}
            </a>
        </div>
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- PROFILE CARD -->
    <!-- ════════════════════════════════════════════ -->
    <section class="relative z-10 mx-auto -mt-10 max-w-[960px] px-6 pb-[60px]">
        <div class="overflow-hidden rounded-3xl bg-white shadow-[0_4px_24px_rgba(0,0,0,0.06)]">
            <div class="relative h-[200px] bg-gradient-to-br from-green-100 via-green-200 to-green-300">
                <div class="absolute inset-0 opacity-15 [background:url('data:image/svg+xml,%3Csvg%20width=%2740%27%20height=%2740%27%20viewBox=%270%200%2040%2040%27%20xmlns=%27http://www.w3.org/2000/svg%27%3E%3Cg%20fill=%27%23ffffff%27%20fill-opacity=%270.4%27%3E%3Cpath%20d=%27M20%200v40M0%2020h40%27/%3E%3C/g%3E%3C/svg%3E')]"></div>
                <div class="absolute bottom-0 left-1/2 z-[2] flex h-[180px] w-[180px] -translate-x-1/2 translate-y-1/2 items-center justify-center overflow-hidden rounded-full border-[5px] border-white bg-gradient-to-br from-green-100 to-green-200 shadow-[0_8px_32px_rgba(0,0,0,0.12)] max-[480px]:h-[120px] max-[480px]:w-[120px] max-[768px]:h-[140px] max-[768px]:w-[140px]">
                    @if ($teacher->photo)
                        <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="h-full w-full object-cover">
                    @else
                        <div class="text-4xl font-bold text-emerald-600 opacity-50">
                            {{ strtoupper(substr($teacher->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="p-10 pb-10 pt-[110px] text-center max-[768px]:px-6 max-[768px]:pb-8 max-[768px]:pt-[100px]">
                <span class="mb-3 inline-block rounded-full px-3.5 py-1 text-[0.78rem] font-semibold {{ $teacher->category === 'pimpinan' ? 'bg-amber-500/10 text-amber-600' : ($teacher->category === 'pembina_asrama' ? 'bg-blue-500/10 text-blue-600' : 'bg-emerald-600/10 text-emerald-600') }}">
                    {{ $teacher->categoryLabel() }}
                </span>
                <h1 class="mb-1.5 text-[clamp(1.5rem,3vw,2rem)] font-extrabold text-gray-900">{{ $teacher->name }}</h1>
                @if ($teacher->position)
                    <div class="mb-6 text-base font-medium text-gray-500">{{ $teacher->position }}</div>
                @endif

                <div class="mx-auto mb-6 h-[3px] w-[60px] rounded bg-gradient-to-br from-emerald-600 to-green-500"></div>

                @if ($teacher->bio)
                    <div class="mx-auto max-w-[680px] text-left text-[1.05rem] leading-[1.85] text-gray-700 [&_p]:mb-4 [&_p:last-child]:mb-0">
                        @php
                            $paragraphs = preg_split('/\n\s*\n/', trim($teacher->bio));
                        @endphp
                        @foreach ($paragraphs as $para)
                            <p>{!! nl2br(e(trim($para))) !!}</p>
                        @endforeach
                    </div>
                @else
                    <div class="mx-auto max-w-[680px] text-center text-[1.05rem] leading-[1.85] text-gray-400">
                        <p>Belum ada deskripsi lengkap untuk {{ $teacher->name }}.</p>
                    </div>
                @endif
            </div>

            <div class="flex flex-wrap items-center justify-center gap-8 border-t border-gray-100 px-10 py-6 max-[768px]:flex-col max-[768px]:gap-3">
                <div class="flex items-center gap-2 text-[0.88rem] text-gray-500">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0 text-emerald-600"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" /><circle cx="12" cy="7" r="4" /></svg>
                    {{ $teacher->categoryLabel() }}
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- RELATED TEACHERS -->
    <!-- ════════════════════════════════════════════ -->
    @if ($this->relatedTeachers->isNotEmpty())
        <section class="mx-auto max-w-[1200px] px-6 pb-20">
            <div class="mb-10 text-center">
                <div class="mb-3 inline-block rounded-full bg-emerald-600/10 px-3.5 py-1 text-[0.8rem] font-semibold text-emerald-600">Lainnya</div>
                <h2 class="text-[clamp(1.3rem,2.5vw,1.75rem)] font-extrabold tracking-[-0.5px] text-gray-900">{{ $teacher->category === 'pimpinan' ? 'Pimpinan' : 'Pengajar' }} Lainnya</h2>
            </div>

            <div class="grid grid-cols-1 gap-6 max-[480px]:grid-cols-1 min-[480px]:grid-cols-2 md:grid-cols-[repeat(auto-fill,minmax(220px,1fr))]">
                @foreach ($this->relatedTeachers as $related)
                    <a href="{{ $related->category === 'pimpinan' ? route('profile.pimpinan.detail', $related->slug) : route('profile.pengajar.detail', $related->slug) }}"
                       wire:navigate class="group block overflow-hidden rounded-2xl border border-emerald-500/10 bg-white text-center text-inherit no-underline shadow-[0_1px_3px_rgba(0,0,0,0.04)] transition-all duration-300 hover:-translate-y-1 hover:border-emerald-500/20 hover:shadow-[0_12px_40px_rgba(22,163,74,0.12)]">
                        <div class="flex aspect-square w-full items-center justify-center overflow-hidden bg-gradient-to-br from-green-100 to-green-200">
                            @if ($related->photo)
                                <img src="{{ asset('storage/' . $related->photo) }}" alt="{{ $related->name }}" class="block h-full w-full object-cover transition-transform duration-400 group-hover:scale-[1.05]" loading="lazy">
                            @else
                                <div class="text-[2.5rem] font-bold text-emerald-600 opacity-50">
                                    {{ strtoupper(substr($related->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="px-4 pb-5 pt-4">
                            <div class="mb-0.5 text-[0.95rem] font-bold text-gray-900 transition-colors group-hover:text-emerald-600">{{ $related->name }}</div>
                            @if ($related->position)
                                <div class="text-[0.78rem] font-medium text-gray-400">{{ $related->position }}</div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

</div>
