<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\Website;
use App\StardewWatcher\Enums\NotificationType;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notification = Notification::create([
            'type' => NotificationType::Email,
            'credentials' => ['email' => 'admin@email.com']
        ]);

        $notification->website()->attach(Website::first()->id);
    }
}
