<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    public function run(): void
    {
        HeroSection::create([
            'title' => 'Selamat Datang di ',
            'subtitle' => 'Berita Apps',
            'description' => 'Temukan informasi terkini, artikel menarik, dan berita terpercaya dalam satu platform. Kami menyajikan berita dengan akurat dan cepat.',
            'badge_text' => 'Portal Berita Terpercaya',
            'button_text' => 'Lihat Berita',
            'button_url' => '#berita',
            'overlay_opacity' => 50,
            'is_active' => true,
            'sort_order' => 0,
        ]);
    }
}
