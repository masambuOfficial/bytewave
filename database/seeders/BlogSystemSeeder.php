<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;

class BlogSystemSeeder extends Seeder
{
    public function run()
    {
        // Create default author
        Author::create([
            'name' => 'BYTEWAVE Editorial',
            'slug' => 'bytewave-editorial',
            'email' => 'editorial@bytewave.com',
            'bio' => 'The BYTEWAVE editorial team brings you the latest in technology and multimedia.',
            'avatar' => '/bytewave_icon.jpg'
        ]);

        // Create categories
        $categories = [
            ['name' => 'Technology', 'slug' => 'technology', 'color' => '#3B82F6', 'description' => 'Latest tech news and trends'],
            ['name' => 'Web Development', 'slug' => 'web-development', 'color' => '#10B981', 'description' => 'Web development tutorials and tips'],
            ['name' => 'Mobile Apps', 'slug' => 'mobile-apps', 'color' => '#8B5CF6', 'description' => 'Mobile app development and reviews'],
            ['name' => 'Design', 'slug' => 'design', 'color' => '#F59E0B', 'description' => 'UI/UX design and trends'],
            ['name' => 'AI & Machine Learning', 'slug' => 'ai-machine-learning', 'color' => '#EF4444', 'description' => 'Artificial intelligence and ML'],
            ['name' => 'Multimedia', 'slug' => 'multimedia', 'color' => '#EC4899', 'description' => 'Video, audio, and multimedia content']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create tags
        $tags = [
            'Laravel', 'React', 'Vue.js', 'PHP', 'JavaScript', 'Python',
            'AI', 'Machine Learning', 'Cloud Computing', 'DevOps',
            'Mobile Development', 'iOS', 'Android', 'UI/UX', 'Design',
            'Video Editing', 'Audio Production', 'Podcasting'
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'slug' => Str::slug($tag)
            ]);
        }
    }
}
