<?php

namespace App\Livewire;

use App\Models\SchoolFacility;
use Livewire\Component;

class FasilitasSekolah extends Component
{
    public function render()
    {
        return view('livewire.fasilitas-sekolah', [
            'facilities' => SchoolFacility::orderBy('sort_order')->get(),
        ])
            ->layout('layouts.blank', [
                'title'      => 'Fasilitas — Ponpes Kuansing',
                'metaDescription' => 'Lihat fasilitas lengkap Pondok Pesantren Syafa\'aturrasul Kuantan Singingi (Ponpes Kuansing). Asrama, ruang kelas, laboratorium, masjid, dan sarana pendukung lainnya.',
                'ogTitle'    => 'Fasilitas Pondok Pesantren Syafa\'aturrasul — Ponpes Kuansing',
            ]);
    }
}
