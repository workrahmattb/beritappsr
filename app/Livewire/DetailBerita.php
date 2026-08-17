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
        abort_if(! $article->isPublished(), 404);

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

        $description = $this->resolveMetaDescription($article);

        $ogImage = $article->og_image
            ? asset('storage/'.$article->og_image)
            : ($article->image ? asset('storage/'.$article->image) : asset('gambar/ppsr logo.webp'));

        return view('livewire.detail-berita')
            ->layout('layouts.blank', [
                'title' => $article->title.' — Ponpes Kuansing',
                'metaDescription' => $description,
                'ogTitle' => $article->title.' — Pondok Pesantren Syafa\'aturrasul',
                'ogDescription' => $description,
                'ogImage' => $ogImage,
                'ogType' => 'article',
                'canonicalUrl' => route('berita.detail', $article->slug),
            ]);
    }

    /**
     * Resolve the meta description for the article.
     *
     * Priority: SEO meta_description → summary → konten (strip tags, 160 char) → judul.
     */
    protected function resolveMetaDescription(Article $article): string
    {
        $seoDescription = trim((string) $article->meta_description);
        if ($seoDescription !== '') {
            return mb_substr($seoDescription, 0, 160);
        }

        $summary = trim((string) $article->summary);
        if ($summary !== '') {
            return mb_substr($summary, 0, 160);
        }

        $contentPreview = trim(strip_tags((string) $article->content));
        if ($contentPreview !== '') {
            return mb_substr($contentPreview, 0, 160);
        }

        return $article->title;
    }
}
