<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Package extends Model
{
    protected $fillable = [
        'tracking_number',
        'recipient_name',
        'address',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($package) {
            $package->tracking_number = 'TRK-' . strtoupper(Str::random(10));
        });
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
