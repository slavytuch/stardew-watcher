<?php

namespace App\StardewWatcher\Enums;

enum CheckupType: string
{
    case IsAvailable = 'is-available';
    case HasBasicAuth = 'has-basic-auth';
    case HasHtml = 'has-html';
    case HasBlockingRobots = 'has-blocking-robots';
}
