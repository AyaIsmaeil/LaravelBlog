<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Post::create([
        //     'title' => 'Post 1',
        //     'content' => 'Content 1',
        //     'user_id' => 1,
        //     'category_id' => 1
        // ]);

        Post::factory()->count(10)->create();
        
    }
}
