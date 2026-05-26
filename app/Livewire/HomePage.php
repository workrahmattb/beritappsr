<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\HeroSection;
use App\Services\InstagramService;
use Livewire\Attributes\Computed;
use Livewire\Component;

class HomePage extends Component
{
    #[Computed]
    public function heroSections()
    {
        return HeroSection::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    #[Computed]
    public function articles()
    {
        return Article::with('author')
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
    }

    #[Computed]
    public function instagramPosts()
    {
        return app(InstagramService::class)->getFeed();
    }

    #[Computed]
    public function instagramActive()
    {
        return app(InstagramService::class)->isActive();
    }

    #[Computed]
    public function instagramUsername()
    {
        return app(InstagramService::class)->getUsername();
    }

    public function render()
    {
        return view('livewire.home-page')
            ->layout('layouts.blank', ['title' => "Syafa'aturrasul"]);
    }
}
