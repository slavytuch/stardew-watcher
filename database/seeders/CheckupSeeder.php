<?php

namespace Database\Seeders;

use App\Models\Checkup;
use App\Models\Notification;
use App\Models\Website;
use App\StardewWatcher\Enums\CheckupType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CheckupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $firstWebsite = Website::first();
        Checkup::create([
            'type' => CheckupType::IsAvailable,
            'website_id' => $firstWebsite->id
        ]);
    }
}
