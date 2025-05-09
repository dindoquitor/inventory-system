<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with('warehouse', 'user', 'type')->latest()->get();
        return view('inventories.index', compact('inventories'));
    }
}
