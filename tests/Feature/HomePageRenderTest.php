<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageRenderTest extends TestCase
{
    public function test_home_page_renders_with_alpine_smooth_scroll(): void
    {
        $response = $this->get('/');

        $response->assertOk();

        // Verifikasi Alpine x-data + @click untuk smooth scroll ada di HTML
        $response->assertSee('smoothScrollTo', false);
        $response->assertSee('scrollIntoView', false);

        // Pastikan pola lama (selector anchor + listener per-link) sudah tidak ada
        $this->assertStringNotContainsString('a[href^="#"]', $response->getContent());

        // Transisi SPA (fade-in halaman) ada di layout
        $response->assertSee('page-shell', false);
        $response->assertSee('livewire:navigated', false);
    }
}
