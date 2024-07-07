<?php

namespace App\Events;

use App\Models\Website;
use App\StardewWatcher\Enums\WebsiteStatus;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WebsiteStatusChanged
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public Website $website,
        public WebsiteStatus $oldWebsiteStatus,
        public WebsiteStatus $newWebsiteStatus
    ) {
    }
}
