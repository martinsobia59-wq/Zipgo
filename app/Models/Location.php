<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['package_id', 'message'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
