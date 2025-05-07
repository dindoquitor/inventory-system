<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DryingFacility;
use Illuminate\Support\Facades\Auth;

class DryingFacilityController extends Controller
{
    public function index()
    {
        $facilities = DryingFacility::latest()->get();
        return view('drying_facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('drying_facilities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:Mechanical,Sun Drying',
            'name' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1',
            'accountable_officer' => 'required|string|max:255',
        ]);

        DryingFacility::create([
            'type' => $request->type,
            'name' => $request->type === 'Mechanical' ? $request->name : null,
            'location' => $request->location,
            'brand' => $request->type === 'Mechanical' ? $request->brand : null,
            'capacity' => $request->capacity,
            'accountable_officer' => $request->accountable_officer,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('drying-facilities.index')->with('success', 'Drying facility added.');
    }
}
