<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Post;

class InitialDataSeeder extends Seeder
{
    public function run()
    {
        // Create Services
        $services = [
            [
                'name' => 'Software Development',
                'description' => 'Custom software solutions tailored to your business needs',
                'icon' => 'fas fa-laptop-code',
                'features' => json_encode(['Web Applications', 'Mobile Apps', 'Desktop Software', 'API Integration']),
                'benefits' => json_encode(['Increased Efficiency', 'Cost Reduction', 'Improved Customer Experience'])
            ],
            [
                'name' => 'IT Consulting',
                'description' => 'Expert guidance for your technology decisions',
                'icon' => 'fas fa-brain',
                'features' => json_encode(['Technology Assessment', 'Digital Strategy', 'Process Optimization']),
                'benefits' => json_encode(['Better Decision Making', 'Risk Reduction', 'Strategic Advantage'])
            ],
            [
                'name' => 'Cloud Solutions',
                'description' => 'Secure and scalable cloud infrastructure services',
                'icon' => 'fas fa-cloud',
                'features' => json_encode(['Cloud Migration', 'AWS/Azure Services', 'Cloud Security']),
                'benefits' => json_encode(['Scalability', 'Cost Optimization', 'Enhanced Security'])
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // Create Portfolio Items
        $portfolios = [
            [
                'title' => 'E-Commerce Platform',
                'description' => 'A full-featured online shopping platform for a retail client',
                'work_done' => 'Built a custom e-commerce solution with inventory management, payment processing, and customer analytics',
                'image' => 'portfolios/ecommerce.jpg'
            ],
            [
                'title' => 'Healthcare Management System',
                'description' => 'Digital transformation project for a healthcare provider',
                'work_done' => 'Developed an integrated system for patient records, appointments, and billing',
                'image' => 'portfolios/healthcare.jpg'
            ],
            [
                'title' => 'Financial Analytics Dashboard',
                'description' => 'Real-time financial data visualization platform',
                'work_done' => 'Created an interactive dashboard for financial data analysis and reporting',
                'image' => 'portfolios/finance.jpg'
            ]
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::create($portfolio);
        }

        // Create Blog Posts
        $posts = [
            [
                'title' => 'The Future of AI in Business',
                'content' => 'Exploring how artificial intelligence is transforming modern business operations...',
                'image_url' => 'blog/ai-business.jpg',
                'excerpt' => 'A deep dive into AI applications in business',
                'user_id' => 1
            ],
            [
                'title' => 'Cybersecurity Best Practices',
                'content' => 'Essential security measures every business should implement...',
                'image_url' => 'blog/cybersecurity.jpg',
                'excerpt' => 'Protecting your business in the digital age',
                'user_id' => 1
            ],
            [
                'title' => 'Digital Transformation Guide',
                'content' => 'A comprehensive guide to successfully implementing digital transformation...',
                'image_url' => 'blog/digital-transformation.jpg',
                'excerpt' => 'Steps to modernize your business',
                'user_id' => 1
            ]
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
