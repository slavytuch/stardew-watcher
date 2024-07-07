<?php

namespace App\StardewWatcher\Checkups\Abstracts;

use App\Models\Website;

interface CheckupInterface
{
    public function run(Website $website): bool;
}
