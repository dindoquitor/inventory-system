<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::with('branch')->get();
        return view('warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('warehouses.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:warehouses,name',
            'branch_id' => 'required|exists:branches,id',
            'supervisor_name' => 'nullable|string',
            'location' => 'nullable|string',
            'design_capacity' => 'nullable|integer',
            'effective_capacity' => 'nullable|integer',
            'usage_type' => 'nullable|string',
        ]);

        Warehouse::create($request->only([
            'name',
            'branch_id',
            'supervisor_name',
            'location',
            'design_capacity',
            'effective_capacity',
            'usage_type',
        ]));

        return redirect()->route('warehouses.index')->with('success', 'Warehouse added.');
    }
}
