<?php

namespace App\StardewWatcher\Checkups;

use App\Models\Website;
use App\StardewWatcher\Checkups\Abstracts\BaseCheckupAbstract;

class IsAvailableCheckup extends BaseCheckupAbstract
{
    public function run(Website $website): bool
    {
        $pendingRequest = $this->createPendingRequest($website);
        $response = $pendingRequest->get($website->url);

        return $response->successful();
    }
}
