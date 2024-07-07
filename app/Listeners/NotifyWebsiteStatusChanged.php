<?php

namespace App\Listeners;

use App\Events\WebsiteStatusChanged;
use App\StardewWatcher\Enums\NotificationType;
use Illuminate\Support\Facades\Notification;

class NotifyWebsiteStatusChanged
{
    public function __construct()
    {
    }

    public function handle(WebsiteStatusChanged $event): void
    {
        $websiteNotifications = $event->website->notifications()->get();

        if ($websiteNotifications->isEmpty()) {
            return;
        }

        $notification = new \App\Notifications\WebsiteStatusChanged($event);

        foreach ($websiteNotifications as $websiteNotification) {
            switch ($websiteNotification->type) {
                case NotificationType::Email:
                    if (empty($websiteNotification->credentials['email'])) {
                        break;
                    }
                    Notification::route('mail', $websiteNotification->credentials['email'])->notify($notification);
                    break;
            }
        }
    }
}
