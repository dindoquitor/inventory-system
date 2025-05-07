<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = [
        'name',
        'branch_id',
        'supervisor_name',
        'location',
        'design_capacity',
        'effective_capacity',
        'usage_type',
    ];
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function procurements()
    {
        return $this->hasMany(\App\Models\Procurement::class);
    }
}
