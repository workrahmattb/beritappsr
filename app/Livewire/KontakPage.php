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
        ])->layout('layouts.blank', ['title' => 'Kontak']);
    }
}
