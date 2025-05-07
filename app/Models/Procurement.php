<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    protected $fillable = [
        'date',
        'palay_type',
        'bags',
        'weight_per_bag',
        'total_weight',
        'wsr_number',
        'farmer_id',
        'warehouse_id',
        'created_by',
    ];

    public function farmer()
    {
        return $this->belongsTo(\App\Models\Farmer::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(\App\Models\Warehouse::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function drying()
    {
        return $this->hasOne(\App\Models\Drying::class);
    }
}
