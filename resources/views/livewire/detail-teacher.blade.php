<div>
    @push('styles')
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #f9fafb;
            color: #1f2937;
            -webkit-font-smoothing: antialiased;
        }
        [x-cloak] { display: none !important; }

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
        .page-header > * { position: relative; z-index: 1; }
        .page-header-inner { max-width: 800px; margin: 0 auto; }
        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            color: rgba(255,255,255,0.8); text-decoration: none;
            font-size: 0.9rem; margin-bottom: 20px; transition: color .2s;
        }
        .back-link:hover { color: white; }

        /* ── Profile Section ── */
        .profile-section {
            max-width: 960px; margin: -40px auto 0;
            padding: 0 24px 60px; position: relative; z-index: 10;
        }
        .profile-card {
            background: white; border-radius: 24px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .profile-hero {
            position: relative; height: 200px;
            background: linear-gradient(135deg, #d1fae5, #a7f3d0, #6ee7b7);
        }
        .profile-hero .pattern-dots {
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.4'%3E%3Cpath d='M20 0v40M0 20h40'/%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.15;
        }
        .profile-photo-wrap {
            position: absolute; bottom: 0; left: 50%;
            transform: translate(-50%, 50%);
            width: 180px; height: 180px; border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            overflow: hidden;
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            display: flex; align-items: center; justify-content: center;
            z-index: 2;
        }
        .profile-photo {
            width: 100%; height: 100%; object-fit: cover;
        }
        .profile-photo-placeholder {
            font-size: 4rem; font-weight: 700; color: #16a34a; opacity: 0.5;
        }

        .profile-body {
            padding: 110px 40px 40px; text-align: center;
        }
        .profile-body .category-badge {
            display: inline-block;
            padding: 4px 14px; border-radius: 50px;
            font-size: 0.78rem; font-weight: 600; margin-bottom: 12px;
        }
        .category-badge.pimpinan {
            background: rgba(245,158,11,0.12); color: #d97706;
        }
        .category-badge.guru {
            background: rgba(22,163,74,0.1); color: #16a34a;
        }
        .category-badge.pembina_asrama {
            background: rgba(59,130,246,0.12); color: #2563eb;
        }
        .profile-body h1 {
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 800; color: #111827; margin-bottom: 6px;
        }
        .profile-body .position {
            font-size: 1rem; color: #6b7280; font-weight: 500; margin-bottom: 24px;
        }

        .profile-divider {
            width: 60px; height: 3px;
            background: linear-gradient(135deg, #16a34a, #22c55e);
            border-radius: 4px; margin: 0 auto 24px;
        }

        .profile-bio {
            max-width: 680px; margin: 0 auto;
            font-size: 1.05rem; line-height: 1.85;
            color: #374151; text-align: left;
        }
        .profile-bio p { margin-bottom: 1em; }
        .profile-bio p:last-child { margin-bottom: 0; }

        /* ── Teacher Meta ── */
        .profile-meta {
            display: flex; justify-content: center; gap: 32px;
            padding: 24px 40px; border-top: 1px solid #f3f4f6;
            flex-wrap: wrap;
        }
        .profile-meta-item {
            display: flex; align-items: center; gap: 8px;
            color: #6b7280; font-size: 0.88rem;
        }
        .profile-meta-item svg { color: #16a34a; flex-shrink: 0; }

        /* ── Related Teachers ── */
        .related-section {
            max-width: 1200px; margin: 0 auto;
            padding: 0 24px 80px;
        }
        .related-header {
            text-align: center; margin-bottom: 40px;
        }
        .related-header .section-label {
            display: inline-block; padding: 4px 14px;
            background: rgba(22,163,74,0.1);
            border-radius: 50px; color: #16a34a;
            font-size: 0.8rem; font-weight: 600; margin-bottom: 12px;
        }
        .related-header h2 {
            font-size: clamp(1.3rem, 2.5vw, 1.75rem);
            font-weight: 800; color: #111827;
            letter-spacing: -0.5px;
        }

        .teacher-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 24px;
        }
        .teacher-card {
            background: white; border-radius: 16px; overflow: hidden;
            border: 1px solid rgba(22,163,74,0.08);
            transition: all .3s; box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            text-align: center; text-decoration: none; display: block;
            color: inherit;
        }
        .teacher-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(22,163,74,0.12);
            border-color: rgba(22,163,74,0.2);
        }
        .teacher-photo-wrap {
            width: 100%; aspect-ratio: 1; overflow: hidden;
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            display: flex; align-items: center; justify-content: center;
        }
        .teacher-photo {
            width: 100%; height: 100%; object-fit: cover; display: block;
            transition: transform .4s;
        }
        .teacher-card:hover .teacher-photo { transform: scale(1.05); }
        .teacher-photo-placeholder {
            font-size: 2.5rem; font-weight: 700; color: #16a34a; opacity: 0.5;
        }
        .teacher-body { padding: 16px 16px 20px; }
        .teacher-name {
            font-size: 0.95rem; font-weight: 700; color: #111827;
            margin-bottom: 2px;
        }
        .teacher-card:hover .teacher-name { color: #16a34a; }
        .teacher-position {
            font-size: 0.78rem; color: #9ca3af; font-weight: 500;
        }

        /* ── Empty State ── */
        .empty-state {
            text-align: center; padding: 40px 0; color: #9ca3af;
        }
        .empty-state p { font-size: 0.95rem; }

        /* ── Animations ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fadeUp 0.6s ease-out forwards; }
        .animate-delay-1 { animation-delay: 0.1s; opacity: 0; }
        .animate-delay-2 { animation-delay: 0.2s; opacity: 0; }

        @media (max-width: 768px) {
            .profile-body { padding: 100px 24px 32px; }
            .profile-meta { flex-direction: column; align-items: center; gap: 12px; }
            .teacher-grid { grid-template-columns: repeat(2, 1fr); }
            .profile-photo-wrap { width: 140px; height: 140px; }
        }
        @media (max-width: 480px) {
            .teacher-grid { grid-template-columns: 1fr; }
            .profile-photo-wrap { width: 120px; height: 120px; }
        }
    </style>
    @endpush

    <x-public.navbar />

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <section class="page-header">
        <div class="page-header-inner" style="padding:0 24px;">
            <a href="{{ $backRoute }}" wire:navigate class="back-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Kembali ke {{ $teacher->category === 'pimpinan' ? 'Pimpinan' : 'Pengajar' }}
            </a>
        </div>
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- PROFILE CARD -->
    <!-- ════════════════════════════════════════════ -->
    <section class="profile-section">
        <div class="profile-card animate-fade-up">
            <div class="profile-hero">
                <div class="pattern-dots"></div>
                <div class="profile-photo-wrap">
                    @if ($teacher->photo)
                        <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="profile-photo">
                    @else
                        <div class="profile-photo-placeholder">
                            {{ strtoupper(substr($teacher->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="profile-body">
                <span class="category-badge {{ $teacher->category }}">
                    {{ $teacher->categoryLabel() }}
                </span>
                <h1>{{ $teacher->name }}</h1>
                @if ($teacher->position)
                    <div class="position">{{ $teacher->position }}</div>
                @endif

                <div class="profile-divider"></div>

                @if ($teacher->bio)
                    <div class="profile-bio">
                        @php
                            $paragraphs = preg_split('/\n\s*\n/', trim($teacher->bio));
                        @endphp
                        @foreach ($paragraphs as $para)
                            <p>{!! nl2br(e(trim($para))) !!}</p>
                        @endforeach
                    </div>
                @else
                    <div class="profile-bio" style="text-align:center;color:#9ca3af;">
                        <p>Belum ada deskripsi lengkap untuk {{ $teacher->name }}.</p>
                    </div>
                @endif
            </div>

            <div class="profile-meta">
                <div class="profile-meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    {{ $teacher->categoryLabel() }}
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- RELATED TEACHERS -->
    <!-- ════════════════════════════════════════════ -->
    @if ($this->relatedTeachers->isNotEmpty())
        <section class="related-section">
            <div class="related-header">
                <div class="section-label">Lainnya</div>
                <h2>{{ $teacher->category === 'pimpinan' ? 'Pimpinan' : 'Pengajar' }} Lainnya</h2>
            </div>

            <div class="teacher-grid">
                @foreach ($this->relatedTeachers as $related)
                    <a href="{{ $related->category === 'pimpinan' ? route('profile.pimpinan.detail', $related->slug) : route('profile.pengajar.detail', $related->slug) }}"
                       wire:navigate class="teacher-card">
                        <div class="teacher-photo-wrap">
                            @if ($related->photo)
                                <img src="{{ asset('storage/' . $related->photo) }}" alt="{{ $related->name }}" class="teacher-photo" loading="lazy">
                            @else
                                <div class="teacher-photo-placeholder">
                                    {{ strtoupper(substr($related->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="teacher-body">
                            <div class="teacher-name">{{ $related->name }}</div>
                            @if ($related->position)
                                <div class="teacher-position">{{ $related->position }}</div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    <x-public.footer />
</div>
