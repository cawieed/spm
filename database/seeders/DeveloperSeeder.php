<?php

// LeadDeveloperSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Developer;

class DeveloperSeeder extends Seeder
{
  public function run()
  {
    // Adjust the number of developers you want to seed
    $numberOfLeadDevelopers = 3;

    for ($i = 0; $i < $numberOfLeadDevelopers; $i++) {
      Developer::create([
        'developer_id' => $i + 1,
        'name' => 'Developer ' . ($i + 1)
        // Add other fields if needed
      ]);
    }
  }
}
