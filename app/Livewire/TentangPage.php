<?php

namespace App\Livewire;

use App\Models\AboutSetting;
use Livewire\Component;

class TentangPage extends Component
{
    public function render()
    {
        $about = AboutSetting::getActive();
        $description = $about && $about->description 
            ? mb_substr(strip_tags($about->description), 0, 160) 
            : 'Profil Pondok Pesantren Syafa\'aturrasul Kuantan Singingi (Ponpes Kuansing) — didirikan oleh DR. KH. Hamdani Purba, Lc., MA. Visi, misi, sejarah, dan informasi lengkap pesantren.';
        $ogImage = $about && $about->image 
            ? asset('storage/'.$about->image) 
            : asset('gambar/ppsr logo.webp');

        return view('livewire.tentang-page', [
            'about' => $about,
        ])->layout('layouts.blank', [
            'title'      => 'Tentang — Ponpes Kuansing',
            'metaDescription' => $description,
            'ogTitle'    => 'Tentang Pondok Pesantren Syafa\'aturrasul — Ponpes Kuansing',
            'ogDescription' => $description,
            'ogImage'    => $ogImage,
        ]);
    }
}
