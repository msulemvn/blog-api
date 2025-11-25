<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostTableSeeder extends Seeder
{
    public function run()
    {
        Post::create([
            'title' => 'First Blog Post',
            'content' => 'This is the content of the first blog post.',
            'author_id' => 1,
            'status' => 'published',
            'published_at' => Carbon::now(),
        ]);

        Post::create([
            'title' => 'Second Blog Post',
            'content' => 'This is the content of the second blog post.',
            'author_id' => 1,
            'status' => 'draft',
            'published_at' => null,
        ]);
    }
}
