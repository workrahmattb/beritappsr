<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Computed;
use Livewire\Component;

class DetailBerita extends Component
{
    public Article $article;

    public function mount(Article $article): void
    {
        abort_if(!$article->isPublished(), 404);

        $this->article = $article->load('author');
    }

    #[Computed]
    public function relatedArticles()
    {
        return Article::with('author')
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('id', '!=', $this->article->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
    }

    public function render()
    {
        $article = $this->article;
        $summary = $article->summary ?: strip_tags($article->content);
        $summary = mb_strlen($summary) > 160 ? mb_substr($summary, 0, 157).'...' : $summary;
        $ogImage = $article->og_image 
            ? asset('storage/'.$article->og_image) 
            : ($article->image ? asset('storage/'.$article->image) : asset('gambar/ppsr logo.webp'));

        return view('livewire.detail-berita')
            ->layout('layouts.blank', [
                'title'      => $article->title.' — Ponpes Kuansing',
                'metaDescription' => $summary,
                'ogTitle'    => $article->title.' — Pondok Pesantren Syafa\'aturrasul',
                'ogDescription' => '',
                'ogImage'    => $ogImage,
                'ogType'     => 'article',
                'canonicalUrl' => route('berita.detail', $article->slug),
            ]);
    }
}
