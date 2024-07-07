<?php

namespace App\StardewWatcher\Checkups\Abstracts;

use App\Models\Website;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

abstract class BaseCheckupAbstract implements CheckupInterface
{
    protected function createPendingRequest(Website $website): PendingRequest
    {
        return ($website->basic_login && $website->basic_pass) ?
            Http::withBasicAuth($website->basic_login, $website->basic_pass) :
            Http::createPendingRequest();
    }
}
