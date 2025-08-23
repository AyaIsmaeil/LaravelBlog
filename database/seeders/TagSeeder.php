<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::factory()->count(10)->create();
        Tag::create([
            'name' => 'Tag 1',
        ]);

    }
}
