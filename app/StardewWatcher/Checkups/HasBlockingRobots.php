<?php

namespace App\StardewWatcher\Checkups;

use App\Models\Website;
use App\StardewWatcher\Checkups\Abstracts\BaseCheckupAbstract;

class HasBlockingRobots extends BaseCheckupAbstract
{
    public function run(Website $website): bool
    {
        $url = $website->url;

        if (!str_ends_with($url, '/')) {
            $url .= '/';
        }

        $url .= 'robots.txt';

        $pendingRequest = $this->createPendingRequest($website);

        $response = $pendingRequest->get($url);

        return $response->successful() && mb_strpos($response->body(), 'User-Agent: * ' . PHP_EOL . 'Disallow: /');
    }
}
