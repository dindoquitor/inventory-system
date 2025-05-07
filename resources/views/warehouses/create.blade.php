@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Add Warehouse</h2>

    <form method="POST" action="{{ route('warehouses.store') }}">
        @csrf
        <div class="mb-3">
            <label>Warehouse Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Select Branch</label>
            <select name="branch_id" class="form-control" required>
                <option value="">-- Choose Branch --</option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            </select>
            @error('branch_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
    <label>Warehouse Supervisor</label>
    <input type="text" name="supervisor_name" class="form-control">
</div>

<div class="mb-3">
    <label>Location / Address</label>
    <input type="text" name="location" class="form-control">
</div>

<div class="mb-3">
    <label>Design Capacity (in bags)</label>
    <input type="number" name="design_capacity" class="form-control">
</div>

<div class="mb-3">
    <label>Effective Capacity (in bags)</label>
    <input type="number" name="effective_capacity" class="form-control">
</div>

<div class="mb-3">
    <label>Usage Type</label>
    <select name="usage_type" class="form-control">
        <option value="">-- Select Usage Type --</option>
        <option value="Buying Station">Buying Station</option>
        <option value="Food Security">Food Security</option>
        <option value="Both">Both</option>
    </select>
</div>


        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
