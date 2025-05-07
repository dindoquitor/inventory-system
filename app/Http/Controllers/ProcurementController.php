<?php

namespace App\Http\Controllers;

use App\Models\Procurement;
use App\Models\Farmer;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory;
use App\Models\InventoryType;

class ProcurementController extends Controller
{
    public function index()
    {
        $procurements = Procurement::with('farmer', 'warehouse', 'user')->latest()->get();
        return view('procurements.index', compact('procurements'));
    }

    public function create()
    {
        $farmers = Farmer::all();
        $warehouses = Warehouse::all();
        $types = InventoryType::all();

        return view('procurements.create', compact('farmers', 'warehouses', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'farmer_id' => 'required|exists:farmers,id',
            'date' => 'required|date',
            'palay_type' => 'required|in:Wet,Dry',
            'bags' => 'required|integer|min:1',
            'total_weight' => 'required|numeric|min:0.01',
            'warehouse_id' => 'required|exists:warehouses,id',
            'wsr_number' => 'required|string|max:255',
            'inventory_type_id' => 'required|exists:inventory_types,id',
        ]);

        // ✅ Check inventory type is "Palay"
        $type = InventoryType::findOrFail($request->inventory_type_id);
        if (strtolower($type->name) !== 'palay') {
            return back()->withErrors(['inventory_type_id' => 'Only Palay is allowed for procurement.']);
        }

        $weight_per_bag = $request->total_weight / $request->bags;

        $procurement = Procurement::create([
            'farmer_id' => $request->farmer_id,
            'date' => $request->date,
            'palay_type' => $request->palay_type,
            'bags' => $request->bags,
            'total_weight' => $request->total_weight,
            'weight_per_bag' => round($weight_per_bag, 2),
            'warehouse_id' => $request->warehouse_id,
            'wsr_number' => $request->wsr_number,
            'created_by' => Auth::id(),
        ]);

        // ✅ Add inventory entry
        Inventory::create([
            'procurement_id' => $procurement->id, // ✅ link inventory to procurement
            'inventory_type_id' => $request->inventory_type_id,
            'classification' => $request->palay_type, // 'Wet' or 'Dry'
            'warehouse_id' => $request->warehouse_id,
            'bags' => $request->bags,
            'total_weight' => $request->total_weight,
            'kilos_per_bag' => $request->total_weight / $request->bags,
            'recorded_at' => $request->date,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('procurements.index')->with('success', 'Procurement recorded successfully.');
    }

    public function edit(Procurement $procurement)
    {
        $farmers = Farmer::all();
        $warehouses = Warehouse::all();
        $types = InventoryType::all();
        return view('procurements.edit', compact('procurement', 'farmers', 'warehouses', 'types'));
    }

    public function update(Request $request, Procurement $procurement)
    {
        $request->validate([
            'date' => 'required|date',
            'palay_type' => 'required|in:Dry,Wet',
            'bags' => 'required|integer|min:1',
            'total_weight' => 'required|numeric|min:0.01',
            'wsr_number' => 'required|string|max:255',
            'farmer_id' => 'required|exists:farmers,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'inventory_type_id' => 'required|exists:inventory_types,id',
        ]);

        $weight_per_bag = $request->total_weight / $request->bags;

        // ✅ Update the linked inventory
        $inventory = Inventory::where('procurement_id', $procurement->id)->first();

        if ($inventory) {
            $inventory->update([
                'classification' => $request->palay_type,
                'bags' => $request->bags,
                'total_weight' => $request->total_weight,
                'kilos_per_bag' => round($weight_per_bag, 2),
                'recorded_at' => $request->date,
                'warehouse_id' => $request->warehouse_id,
                'inventory_type_id' => $request->inventory_type_id,
            ]);
        }


        return redirect()->route('procurements.index')->with('success', 'Procurement updated successfully.');
    }
}
