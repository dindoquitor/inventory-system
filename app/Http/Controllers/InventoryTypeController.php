<?php

namespace App\Http\Controllers;

use App\Models\InventoryType;
use Illuminate\Http\Request;

class InventoryTypeController extends Controller
{
    public function index()
    {
        $types = InventoryType::all();
        return view('inventory-types.index', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:inventory_types,name',
        ]);

        InventoryType::create(['name' => $request->name]);

        return redirect()->route('inventory-types.index')->with('success', 'Inventory type added successfully.');
    }
}
