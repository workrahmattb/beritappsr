<?php

namespace App\Livewire;

use App\Models\AboutSetting;
use Livewire\Component;

class TentangPage extends Component
{
    public function render()
    {
        $about = AboutSetting::getActive();

        return view('livewire.tentang-page', [
            'about' => $about,
        ])->layout('layouts.blank', ['title' => 'Tentang']);
    }
}
