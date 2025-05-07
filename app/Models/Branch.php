<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name', 'region_id'];

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function warehouses(){
        return $this->hasMany(Warehouse::class);
    }
}
