<?php

namespace App\Livewire;

use App\Models\SchoolFacility;
use Livewire\Attributes\Computed;
use Livewire\Component;

class DetailFasilitas extends Component
{
    public SchoolFacility $facility;

    public function mount(SchoolFacility $facility): void
    {
        $this->facility = $facility;
    }

    #[Computed]
    public function relatedFacilities()
    {
        return SchoolFacility::where('id', '!=', $this->facility->id)
            ->orderBy('sort_order')
            ->take(3)
            ->get();
    }

    public function render()
    {
        $facility = $this->facility;
        $description = $facility->description 
            ? mb_substr(strip_tags($facility->description), 0, 160) 
            : 'Fasilitas '.$facility->name.' di Pondok Pesantren Syafa\'aturrasul Kuantan Singingi (Ponpes Kuansing).';
        $images = $facility->images ?? [];
        $ogImage = !empty($images) 
            ? asset('storage/'.$images[0]) 
            : asset('gambar/ppsr logo.webp');

        return view('livewire.detail-fasilitas')
            ->layout('layouts.blank', [
                'title'      => $facility->name.' — Fasilitas Ponpes Kuansing',
                'metaDescription' => $description,
                'ogTitle'    => $facility->name.' — Pondok Pesantren Syafa\'aturrasul',
                'ogDescription' => $description,
                'ogImage'    => $ogImage,
                'canonicalUrl' => route('fasilitas.detail', $facility->slug),
            ]);
    }
}
