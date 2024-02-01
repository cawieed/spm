<?php

// LeadDeveloperSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LeadDeveloper;

class LeadDeveloperSeeder extends Seeder
{
    public function run()
    {
        // Adjust the number of developers you want to seed
        $numberOfLeadDevelopers = 3;

        for ($i = 0; $i < $numberOfLeadDevelopers; $i++) {
            LeadDeveloper::create([
                'lead_developer_id' => $i + 1,
                'name' => 'Lead Developer ' . ($i + 1)
                // Add other fields if needed
            ]);
        }
    }
}
