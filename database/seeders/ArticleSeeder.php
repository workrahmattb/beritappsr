<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::factory()->draft()->count(3)->create();
        Article::factory()->published()->count(5)->create();
        Article::factory()->archived()->count(2)->create();
    }
}
