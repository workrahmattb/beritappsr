<div>
    @push('styles')
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', sans-serif;
                background: #f9fafb;
                color: #1f2937;
                -webkit-font-smoothing: antialiased;
            }



            /* ── Page Header ── */
            .page-header {
                background: linear-gradient(135deg, #059669, #16a34a, #22c55e);
                padding: 120px 24px 60px;
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .page-header::before {
                content: '';
                position: absolute;
                inset: 0;
                background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
                opacity: 0.5;
            }

            .page-header > * {
                position: relative;
                z-index: 1;
            }

            .page-header .section-label {
                display: inline-block;
                padding: 4px 14px;
                background: rgba(255, 255, 255, 0.15);
                border-radius: 50px;
                color: rgba(255, 255, 255, 0.9);
                font-size: 0.8rem;
                font-weight: 600;
                margin-bottom: 12px;
                backdrop-filter: blur(4px);
            }

            .page-header h1 {
                font-size: clamp(2rem, 5vw, 3rem);
                font-weight: 800;
                color: white;
                letter-spacing: -0.5px;
                margin-bottom: 12px;
            }

            .page-header p {
                color: rgba(255, 255, 255, 0.85);
                font-size: 1.05rem;
                max-width: 500px;
                margin: 0 auto;
                line-height: 1.6;
            }

            /* ── Teacher Grid ── */
            .section {
                padding: 60px 24px 80px;
                max-width: 1200px;
                margin: 0 auto;
            }

            .teacher-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 28px;
            }

            .teacher-card {
                background: white;
                border-radius: 16px;
                overflow: hidden;
                border: 1px solid rgba(22, 163, 74, 0.08);
                transition: all .3s;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
                text-align: center;
            }

            .teacher-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 40px rgba(22, 163, 74, 0.12);
                border-color: rgba(22, 163, 74, 0.2);
            }

            .teacher-photo-wrap {
                width: 100%;
                aspect-ratio: 1;
                overflow: hidden;
                background: linear-gradient(135deg, #d1fae5, #a7f3d0);
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .teacher-photo {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                transition: transform .4s;
            }

            .teacher-card:hover .teacher-photo {
                transform: scale(1.05);
            }

            .teacher-photo-placeholder {
                font-size: 3.5rem;
                font-weight: 700;
                color: #16a34a;
                opacity: 0.5;
            }

            .teacher-body {
                padding: 20px 20px 24px;
            }

            .teacher-name {
                font-size: 1.1rem;
                font-weight: 700;
                color: #111827;
                margin-bottom: 4px;
            }

            .teacher-card:hover .teacher-name {
                color: #16a34a;
            }

            .teacher-position {
                font-size: 0.85rem;
                color: #6b7280;
                font-weight: 500;
                margin-bottom: 12px;
            }

            .teacher-badge {
                display: inline-block;
                padding: 3px 12px;
                background: rgba(22, 163, 74, 0.1);
                border-radius: 50px;
                color: #16a34a;
                font-size: 0.75rem;
                font-weight: 600;
            }

            .teacher-badge.pimpinan {
                background: rgba(245, 158, 11, 0.12);
                color: #d97706;
            }

            .teacher-badge.pembina_asrama {
                background: rgba(59, 130, 246, 0.12);
                color: #2563eb;
            }

            .teacher-bio {
                font-size: 0.85rem;
                color: #6b7280;
                line-height: 1.6;
                margin-top: 12px;
                padding-top: 12px;
                border-top: 1px solid #f3f4f6;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* ── Empty State ── */
            .empty-state {
                text-align: center;
                padding: 60px 0;
                color: #9ca3af;
            }

            .empty-state svg {
                margin: 0 auto 16px;
                opacity: 0.4;
            }

            .empty-state p {
                font-size: 1.1rem;
            }

            @media (max-width: 768px) {
                .teacher-grid {
                    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                }
            }

            @media (max-width: 480px) {
                .teacher-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    @endpush

    <x-public.navbar />

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <div class="page-header">
        <div class="section-label">
            {{ $category === 'pimpinan' ? 'Pimpinan' : 'Pengajar' }}
        </div>
        <h1>{{ $title }}</h1>
        <p>Mengenal lebih dekat para {{ strtolower($title) }} di Pondok Pesantren Syafa'aturrasul</p>
    </div>

    <!-- ════════════════════════════════════════════ -->
    <!-- TEACHER GRID -->
    <!-- ════════════════════════════════════════════ -->
    <div class="section">
        @if ($this->teachers->isNotEmpty())
            <div class="teacher-grid">
                @foreach ($this->teachers as $teacher)
                    @php
                        $detailRoute = match ($teacher->category) {
                            'pimpinan' => route('profile.pimpinan.detail', $teacher->slug),
                            'guru'     => route('profile.pengajar.detail', $teacher->slug),
                            default    => url('/'),
                        };
                    @endphp
                    <a href="{{ $detailRoute }}" wire:navigate class="teacher-card" style="text-decoration:none;color:inherit;display:block;">
                        <div class="teacher-photo-wrap">
                            @if ($teacher->photo)
                                <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="teacher-photo" loading="lazy">
                            @else
                                <div class="teacher-photo-placeholder">
                                    {{ strtoupper(substr($teacher->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="teacher-body">
                            <div class="teacher-name">{{ $teacher->name }}</div>
                            @if ($teacher->position)
                                <div class="teacher-position">{{ $teacher->position }}</div>
                            @endif
                            <span class="teacher-badge {{ $teacher->category }}">
                                {{ $teacher->categoryLabel() }}
                            </span>
                            @if ($teacher->bio)
                                <div class="teacher-bio">{{ $teacher->bio }}</div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
                <p>Belum ada data {{ strtolower($title) }}.</p>
            </div>
        @endif
    </div>

    <x-public.footer />

    @push('scripts')
        <script>
            // Page-specific scripts here
        </script>
    @endpush
</div>
