<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DryingFacility extends Model
{
    protected $fillable = [
        'type',
        'name',
        'location',
        'brand',
        'capacity',
        'accountable_officer',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
