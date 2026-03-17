<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Symfony\Component\Clock\now;

class BundleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bundles = [
            'name' => 'Basic Powerlifting',
            'start_time' => '',
            'duration' => 40,
            'description' => '2-hour daily access to heavy racks',
            'category_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
