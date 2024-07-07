<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckupResult extends Model
{
    protected $fillable = [
        'checkup_id',
        'website_id',
        'passed'
    ];

    protected $casts = [
        'passed' => 'bool'
    ];
}
