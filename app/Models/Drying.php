<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drying extends Model
{
    use HasFactory;

    protected $fillable = [
        'procurement_id',
        'drying_method',
        'drying_facility_id',
        'date_issued',
        'date_received',
        'final_weight',
        'warehouse_id',
        'created_by',
        'wsi_number', // ✅ add this
        'wsr_number', // optional for receipt later
        'bags',       // optional for receipt later
        'kilos_per_bag', // optional for receipt later
    ];

    public function procurement()
    {
        return $this->belongsTo(Procurement::class);
    }

    public function facility()
    {
        return $this->belongsTo(DryingFacility::class, 'drying_facility_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
