<?php

namespace App\Models;

use App\StardewWatcher\Enums\CheckupType;
use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
{
    protected $fillable = [
        'type',
        'website_id',
        'interval',
        'next_checkup',
        'checkup_data'
    ];

    protected $casts = [
        'interval' => 'integer',
        'next_checkup' => 'datetime',
        'type' => CheckupType::class,
        'checkup_data' => 'array'
    ];


    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
