<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate the public sitemap.xml for search and AI crawlers';

    public function handle()
    {
        $sitemap = Sitemap::create();

        // route name => [priority, change frequency]
        $pages = [
            'home'                  => [1.0, Url::CHANGE_FREQUENCY_WEEKLY],
            'services.index'        => [0.9, Url::CHANGE_FREQUENCY_MONTHLY],
            'products.index'        => [0.9, Url::CHANGE_FREQUENCY_MONTHLY],
            'portfolios.index'      => [0.9, Url::CHANGE_FREQUENCY_MONTHLY],
            'services.audio-visual' => [0.8, Url::CHANGE_FREQUENCY_MONTHLY],
            'about'                 => [0.8, Url::CHANGE_FREQUENCY_MONTHLY],
            'contact'               => [0.8, Url::CHANGE_FREQUENCY_YEARLY],
            'blog.index'            => [0.7, Url::CHANGE_FREQUENCY_DAILY],
            'faqs'                  => [0.6, Url::CHANGE_FREQUENCY_MONTHLY],
            'help'                  => [0.5, Url::CHANGE_FREQUENCY_MONTHLY],
            'privacy-policy'        => [0.3, Url::CHANGE_FREQUENCY_YEARLY],
            'terms'                 => [0.3, Url::CHANGE_FREQUENCY_YEARLY],
        ];

        foreach ($pages as $routeName => [$priority, $frequency]) {
            $sitemap->add(
                Url::create(route($routeName))
                    ->setPriority($priority)
                    ->setChangeFrequency($frequency)
            );
        }

        Blog::published()->get()->each(function (Blog $blog) use ($sitemap) {
            $sitemap->add(
                Url::create(route('blog.show', $blog->slug))
                    ->setLastModificationDate($blog->updated_at)
                    ->setPriority(0.6)
            );
        });

        Service::all()->each(function (Service $service) use ($sitemap) {
            $sitemap->add(
                Url::create(route('services.show', $service->id))
                    ->setLastModificationDate($service->updated_at)
                    ->setPriority(0.8)
            );
        });

        Product::all()->each(function (Product $product) use ($sitemap) {
            $sitemap->add(
                Url::create(route('products.show', $product->slug))
                    ->setLastModificationDate($product->updated_at)
                    ->setPriority(0.8)
            );
        });

        Portfolio::all()->each(function (Portfolio $portfolio) use ($sitemap) {
            $sitemap->add(
                Url::create(route('portfolios.show', $portfolio->slug))
                    ->setLastModificationDate($portfolio->updated_at)
                    ->setPriority(0.5)
            );
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated at public/sitemap.xml');
    }
}
