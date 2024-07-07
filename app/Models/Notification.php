<?php

namespace App\Models;

use App\StardewWatcher\Enums\NotificationType;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'name',
        'type',
        'credentials'
    ];

    protected $casts = [
        'type' => NotificationType::class,
        'credentials' => 'array'
    ];

    public function website()
    {
        return $this->belongsToMany(Website::class);
    }
}
