<?php

namespace App\StardewWatcher\Enums;

enum WebsiteStatus: string
{
    case NotChecked = 'not-checked';
    case Ok = 'ok';
    case Fail = 'fail';
}
