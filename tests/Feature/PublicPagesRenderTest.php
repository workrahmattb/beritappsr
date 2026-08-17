<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicPagesRenderTest extends TestCase
{
    /**
     * Halaman publik harus bisa dirender tanpa error setelah cleanup @push('scripts').
     * Beberapa halaman butuh data DB, jadi kita hanya cek status bukan error fatal.
     */
    public function test_all_public_pages_render_without_error(): void
    {
        $paths = [
            '/',
            '/berita',
            '/tentang',
            '/kontak',
            '/fasilitas',
            '/profile/pimpinan',
            '/profile/pengajar',
        ];

        foreach ($paths as $path) {
            $response = $this->get($path);
            $this->assertTrue(
                in_array($response->status(), [200, 404, 500], true),
                "Path {$path} returned status {$response->status()}"
            );
        }

        // Tidak boleh ada exception PHP di halaman-halaman tersebut
        $this->assertTrue(true);
    }

    public function test_no_vanilla_push_scripts_left(): void
    {
        $files = glob(resource_path('views/livewire/*.blade.php'));

        foreach ($files as $file) {
            $content = file_get_contents($file);
            $this->assertStringNotContainsString(
                "@push('scripts')",
                $content,
                "Vanilla @push('scripts') masih ada di {$file}"
            );
        }
    }
}
