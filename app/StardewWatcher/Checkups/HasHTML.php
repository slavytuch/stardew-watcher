<?php

namespace App\StardewWatcher\Checkups;

use App\Models\Website;
use App\StardewWatcher\Checkups\Abstracts\BaseCheckupAbstract;

class HasHTML extends BaseCheckupAbstract
{
    public function __construct(protected string $html)
    {
    }

    public function run(Website $website): bool
    {
        $pendingRequest = $this->createPendingRequest($website);
        $response = $pendingRequest->get($website->url);

        return $response->successful() && mb_strpos($response->body(), $this->html) !== false;
    }
}
