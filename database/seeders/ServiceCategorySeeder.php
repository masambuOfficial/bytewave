<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Direct service name to category mapping
        $serviceCategoryMap = [
            // Multimedia Production
            'Graphics Design' => 'Multimedia Production',
            'Photography' => 'Multimedia Production',
            'Audio-Visual Productions' => 'Multimedia Production',
            
            // Web & Software Development
            'Web Hosting and Development' => 'Web & Software Development',
            'Mobile App Development' => 'Web & Software Development',
            
            // Digital Marketing
            'Digital Marketing' => 'Digital Marketing',
            
            // ICT Solutions & Support
            'ICT and Multimedia Supplies' => 'ICT Solutions & Support',
        ];

        // Update services based on mapping
        foreach ($serviceCategoryMap as $serviceName => $category) {
            $service = Service::where('name', 'LIKE', "%{$serviceName}%")->first();
            
            if ($service) {
                $service->update(['category' => $category]);
                $this->command->info("Assigned '{$service->name}' to category: {$category}");
            } else {
                $this->command->warn("Service '{$serviceName}' not found in database");
            }
        }

        $this->command->info('Service categories updated successfully!');
    }
}
