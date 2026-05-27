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
        return view('livewire.detail-fasilitas')
            ->layout('layouts.blank', ['title' => $this->facility->name]);
    }
}
