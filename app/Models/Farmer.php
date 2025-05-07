<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    protected $fillable = [
        'name',
        'sex',
        'age',
        'hectares',
        'address',
        'farm_location',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function procurements()
    {
        return $this->hasMany(\App\Models\Procurement::class);
    }
}
