<?php

namespace App\Http\Controllers;

use App\Models\Drying;
use App\Models\Procurement;
use App\Models\DryingFacility;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DryingController extends Controller
{
    public function index()
    {
        $dryings = Drying::with('procurement.farmer', 'facility', 'warehouse')->latest()->get();
        return view('dryings.index', compact('dryings'));
    }

    public function create()
    {
        $wetProcurements = Procurement::where('palay_type', 'Wet')
            ->whereDoesntHave('drying') // prevent re-drying
            ->with('farmer')
            ->get();

        $facilities = DryingFacility::all();
        $warehouses = Warehouse::all();

        return view('dryings.create', compact('wetProcurements', 'facilities', 'warehouses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'procurement_id' => 'required|exists:procurements,id',
            'drying_method' => 'required|in:Sun Drying,Mechanical',
            'drying_facility_id' => 'required|exists:drying_facilities,id',
            'date_issued' => 'required|date',
            'wsi_number' => 'required|string|max:255',
            'warehouse_id' => 'required|exists:warehouses,id',
        ]);

        Drying::create([
            'procurement_id' => $request->procurement_id,
            'drying_method' => $request->drying_method,
            'drying_facility_id' => $request->drying_facility_id,
            'date_issued' => $request->date_issued,
            'wsi_number' => $request->wsi_number,
            'warehouse_id' => $request->warehouse_id,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('dryings.index')->with('success', 'Drying issuance recorded. You can complete the receipt later.');
    }

    public function edit(Drying $drying)
    {
        $wetProcurements = Procurement::where('palay_type', 'Wet')->with('farmer')->get();
        $facilities = \App\Models\DryingFacility::all();
        $warehouses = \App\Models\Warehouse::all();

        return view('dryings.edit', compact('drying', 'wetProcurements', 'facilities', 'warehouses'));
    }

    public function update(Request $request, Drying $drying)
    {
        $request->validate([
            'procurement_id' => 'required|exists:procurements,id',
            'drying_method' => 'required|in:Sun Drying,Mechanical',
            'drying_facility_id' => 'required|exists:drying_facilities,id',
            'date_issued' => 'required|date',
            'wsi_number' => 'required|string|max:255', // ✅ Add this
            'warehouse_id' => 'required|exists:warehouses,id',
        ]);

        $drying->update([
            'procurement_id' => $request->procurement_id,
            'drying_method' => $request->drying_method,
            'drying_facility_id' => $request->drying_facility_id,
            'date_issued' => $request->date_issued,
            'wsi_number' => $request->wsi_number, // ✅ Make sure this line exists
            'warehouse_id' => $request->warehouse_id,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('dryings.index')->with('success', 'Drying record updated.');
    }

    public function complete(Drying $drying)
    {
        return view('dryings.complete', compact('drying'));
    }

    public function updateReceipt(Request $request, Drying $drying)
    {
        $request->validate([
            'date_received' => 'required|date|after_or_equal:' . $drying->date_issued,
            'bags' => 'required|integer|min:1',
            'final_weight' => 'required|numeric|min:0.01',
            'wsr_number' => 'required|string|max:255',
        ]);

        $drying->update([
            'date_received' => $request->date_received,
            'bags' => $request->bags,
            'final_weight' => $request->final_weight,
            'kilos_per_bag' => $request->final_weight / $request->bags,
            'wsr_number' => $request->wsr_number,
        ]);

        return redirect()->route('dryings.index')->with('success', 'Drying receipt recorded successfully.');
    }

    public function pending()
    {
        $dryings = \App\Models\Drying::with('procurement.farmer', 'facility', 'warehouse')
            ->whereNull('date_received')
            ->latest()
            ->get();

        return view('dryings.pending', compact('dryings'));
    }
}
