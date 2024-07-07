<?php

namespace App\StardewWatcher\Checkups;

use App\Models\Website;
use App\StardewWatcher\Checkups\Abstracts\CheckupInterface;
use Illuminate\Support\Facades\Http;

class HasBasicAuth implements CheckupInterface
{
    public function run(Website $website): bool
    {
        $response = Http::get($website->url);

        return $response->status() === 401;
    }
}
