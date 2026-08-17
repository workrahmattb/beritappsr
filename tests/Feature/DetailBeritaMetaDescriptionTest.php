<?php

namespace Tests\Feature;

use App\Livewire\DetailBerita;
use App\Models\Article;
use ReflectionMethod;
use Tests\TestCase;

class DetailBeritaMetaDescriptionTest extends TestCase
{
    private function resolveDescription(Article $article): string
    {
        $method = new ReflectionMethod(DetailBerita::class, 'resolveMetaDescription');

        return $method->invoke(new DetailBerita, $article);
    }

    public function test_uses_summary_when_available(): void
    {
        $article = new Article([
            'title' => 'Judul Artikel',
            'summary' => 'Ini ringkasan artikel yang bagus untuk SEO',
            'content' => '<p>Isi konten</p>',
            'meta_description' => null,
        ]);

        $this->assertSame(
            'Ini ringkasan artikel yang bagus untuk SEO',
            $this->resolveDescription($article)
        );
    }

    public function test_truncates_summary_to_160_characters(): void
    {
        $article = new Article([
            'title' => 'Judul Artikel',
            'summary' => str_repeat('a', 200),
            'content' => '<p>Isi konten</p>',
            'meta_description' => null,
        ]);

        $this->assertSame(160, mb_strlen($this->resolveDescription($article)));
    }

    public function test_falls_back_to_stripped_content(): void
    {
        $article = new Article([
            'title' => 'Judul Artikel',
            'summary' => null,
            'content' => '<p>Konten artikel tanpa summary</p>',
            'meta_description' => null,
        ]);

        $this->assertSame(
            'Konten artikel tanpa summary',
            $this->resolveDescription($article)
        );
    }

    public function test_prefers_seo_meta_description(): void
    {
        $article = new Article([
            'title' => 'Judul Artikel',
            'summary' => 'Ringkasan biasa',
            'content' => '<p>Isi konten</p>',
            'meta_description' => 'Deskripsi SEO khusus dari admin',
        ]);

        $this->assertSame(
            'Deskripsi SEO khusus dari admin',
            $this->resolveDescription($article)
        );
    }

    public function test_falls_back_to_title_when_empty(): void
    {
        $article = new Article([
            'title' => 'Judul Terakhir',
            'summary' => null,
            'content' => null,
            'meta_description' => null,
        ]);

        $this->assertSame('Judul Terakhir', $this->resolveDescription($article));
    }
}
