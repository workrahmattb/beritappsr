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
            ->layout('layouts.blank');
    }
}
