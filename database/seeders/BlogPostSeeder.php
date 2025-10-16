<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('email', 'admin@bytewave.com')->first();

        $posts = [
            [
                'title' => 'The Future of Digital Transformation',
                'content' => 'Digital transformation is revolutionizing how businesses operate...',
                'image' => 'blog/digital-transformation.jpg',
                'published_at' => now(),
                'user_id' => $admin->id
            ],
            [
                'title' => 'Cybersecurity Best Practices for 2025',
                'content' => 'As cyber threats evolve, businesses must stay ahead with robust security measures...',
                'image' => 'blog/cybersecurity.jpg',
                'published_at' => now(),
                'user_id' => $admin->id
            ],
            [
                'title' => 'Cloud Computing Trends',
                'content' => 'Cloud computing continues to transform business operations and scalability...',
                'image' => 'blog/cloud-computing.jpg',
                'published_at' => now(),
                'user_id' => $admin->id
            ]
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
