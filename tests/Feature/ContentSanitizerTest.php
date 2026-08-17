<?php

namespace Tests\Feature;

use App\Services\ContentSanitizer;
use Tests\TestCase;

class ContentSanitizerTest extends TestCase
{
    private ContentSanitizer $sanitizer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sanitizer = app(ContentSanitizer::class);
    }

    public function test_removes_script_tags(): void
    {
        $this->assertSame(
            '<p>Hello</p>',
            $this->sanitizer->sanitize('<p>Hello</p><script>alert(1)</script>')
        );
    }

    public function test_removes_event_handler_attributes(): void
    {
        $result = $this->sanitizer->sanitize('<img src="x" onerror="alert(1)">');

        $this->assertStringNotContainsString('onerror', $result);
    }

    public function test_removes_iframes_and_embeds(): void
    {
        $this->assertSame(
            '<p>ok</p>',
            $this->sanitizer->sanitize('<iframe src="https://evil.com"></iframe><p>ok</p>')
        );
    }

    public function test_preserves_rich_editor_markup(): void
    {
        $html = '<h2>Judul</h2><p><strong>Bold</strong> dan <em>italic</em></p><ul><li>item</li></ul>';

        $result = $this->sanitizer->sanitize($html);

        $this->assertStringContainsString('<h2>Judul</h2>', $result);
        $this->assertStringContainsString('<strong>Bold</strong>', $result);
        $this->assertStringContainsString('<em>italic</em>', $result);
        $this->assertStringContainsString('<ul><li>item</li></ul>', $result);
    }

    public function test_preserves_valid_links_and_images(): void
    {
        $result = $this->sanitizer->sanitize(
            '<a href="https://example.com" target="_blank">link</a> <img src="/storage/berita/a.jpg" alt="foto">'
        );

        $this->assertStringContainsString('href="https://example.com"', $result);
        $this->assertStringContainsString('src="/storage/berita/a.jpg"', $result);
        $this->assertStringContainsString('target="_blank"', $result);
    }
}
