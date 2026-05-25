<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Berita',
            'email' => 'admin@berita.com',
            'password' => bcrypt('password'),
        ]);

        $this->call([
            ArticleSeeder::class,
            HeroSectionSeeder::class,
        ]);
    }
}
