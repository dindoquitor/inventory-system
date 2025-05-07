<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Region;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::with('region')->get();
        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        $regions = Region::all();
        return view('branches.create', compact('regions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:branches,name',
            'region_id' => 'required|exists:regions,id',
        ]);

        Branch::create($request->only('name', 'region_id'));

        return redirect()->route('branches.index')->with('success', 'Branch added.');
    }
}
