<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php
        $siteName = config('app.name', 'Pondok Pesantren Syafa\'aturrasul');
        $defaultDescription = 'Portal berita resmi Pondok Pesantren Syafa\'aturrasul Kuantan Singingi (Ponpes Kuansing). Didirikan oleh DR. KH. Hamdani Purba, Lc., MA. Informasi terkini, artikel pendidikan, profil pengajar, fasilitas, dan kegiatan pesantren.';
        $defaultKeywords = 'Ponpes Kuansing, Pondok Pesantren Syafaaturrasul, Pondok Pesantren Syafa\'aturrasul, Pondok Pesantren Kuantan Singingi, Pondok Pesantren Kuansing, Kiyai Kuansing, Kiyai Hamdani, DR. KH. Hamdani Purba, Lc., MA, Pesantren Kuansing, Pendidikan Islam, Pondok Pesantren Riau';

        $pageTitle = filled($title ?? null) ? $title.' - '.$siteName : $siteName;
        $metaDescription = $metaDescription ?? $defaultDescription;
        $metaKeywords  = $metaKeywords ?? $defaultKeywords;
        $ogTitle       = $ogTitle ?? $pageTitle;
        $ogDescription = $ogDescription ?? $metaDescription;
        $ogImage       = $ogImage ?? asset('gambar/ppsr logo.webp');
        $ogType        = $ogType ?? 'website';
        $canonicalUrl  = $canonicalUrl ?? url()->current();
    @endphp

    <title>{{ $pageTitle }}</title>
    <link rel="canonical" href="{{ $canonicalUrl }}">

    {{-- Meta --}}
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $ogTitle }}">
    @filled($ogDescription)
        <meta property="og:description" content="{{ $ogDescription }}">
    @endfilled
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    @filled($ogDescription)
        <meta name="twitter:description" content="{{ $ogDescription }}">
    @endfilled
    <meta name="twitter:image" content="{{ $ogImage }}">

    {{-- Google Search Console --}}
    <meta name="google-site-verification" content="{{ env('GOOGLE_VERIFICATION', '') }}">

    {{-- Favicon — PPSR Logo --}}
    <link rel="icon" href="{{ asset('gambar/favicon.png') }}" type="image/png" sizes="32x32">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml" sizes="any">
    <link rel="apple-touch-icon" href="{{ asset('gambar/favicon.png') }}" sizes="180x180">
    <link rel="mask-icon" href="{{ asset('favicon.svg') }}" color="#16a34a">
    <meta name="msapplication-TileImage" content="{{ asset('gambar/favicon.png') }}">
    <meta name="msapplication-TileColor" content="#16a34a">
    <meta name="theme-color" content="#16a34a">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])
    @livewireStyles
    @stack('styles')

    @php
        $ldOrganization = [
            '@context' => 'https://schema.org',
            '@type' => 'EducationalOrganization',
            'name' => 'Pondok Pesantren Syafa\'aturrasul',
            'alternateName' => [
                'Ponpes Syafa\'aturrasul',
                'Ponpes Kuansing',
                'Pondok Pesantren Kuantan Singingi',
            ],
            'description' => $defaultDescription,
            'url' => url('/'),
            'logo' => asset('gambar/ppsr logo.webp'),
            'foundingDate' => '2024',
            'founder' => [
                '@type' => 'Person',
                'name' => 'DR. KH. Hamdani Purba, Lc., MA',
                'alternateName' => 'Kiyai Hamdani',
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Kuantan Singingi',
                'addressRegion' => 'Riau',
                'addressCountry' => 'ID',
            ],
            'sameAs' => [
                'https://www.instagram.com/ponpessyafaaturrasul_official/',
            ],
        ];
    @endphp

    {{-- JSON-LD Structured Data --}}
    <script type="application/ld+json">
        @json($ldOrganization, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
    </script>
</head>
<body>
    {{ $slot }}

    <x-whatsapp-float />

    @livewireScripts
    @stack('scripts')
</body>
</html>
