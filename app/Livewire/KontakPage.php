<?php

namespace App\Livewire;

use App\Models\ContactWhatsapp;
use App\Models\MapsSetting;
use Livewire\Component;

class KontakPage extends Component
{
    public function render()
    {
        $waNumbers = ContactWhatsapp::getActive();
        $maps = MapsSetting::getActive();

        return view('livewire.kontak-page', [
            'waNumbers' => $waNumbers,
            'mapsList' => $maps,
        ])->layout('layouts.blank', [
            'title'      => 'Kontak — Ponpes Kuansing',
            'metaDescription' => 'Hubungi Pondok Pesantren Syafa\'aturrasul Kuantan Singingi (Ponpes Kuansing) via WhatsApp. Dapatkan informasi pendaftaran santri baru, lokasi pondok, dan kontak resmi pesantren.',
            'ogTitle'    => 'Kontak Pondok Pesantren Syafa\'aturrasul — Ponpes Kuansing',
        ]);
    }
}
