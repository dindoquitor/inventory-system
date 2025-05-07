<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'procurement_id',
        'inventory_type_id',
        'classification',
        'warehouse_id',
        'bags',
        'total_weight',
        'kilos_per_bag',
        'recorded_at',
        'created_by',
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function type()
    {
        return $this->belongsTo(InventoryType::class, 'inventory_type_id');
    }
    public function procurement()
    {
        return $this->belongsTo(Procurement::class);
    }
}
