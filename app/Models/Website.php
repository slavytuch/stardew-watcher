<?php

namespace App\Models;

use App\StardewWatcher\Enums\WebsiteStatus;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $fillable = [
        'active',
        'url',
        'status',
        'basic_login',
        'basic_pass'
    ];

    protected $casts = [
        'active' => 'boolean',
        'status' => WebsiteStatus::class
    ];

    public function checkups()
    {
        return $this->hasMany(Checkup::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
