@extends('layouts.app')

@section('content')
<h2 class="mb-4">New Palay Procurement</h2>

<form method="POST" action="{{ route('procurements.store') }}">
    @csrf

    <div class="mb-3">
        <label>Date</label>
        <input type="date" name="date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Farmer</label>
        <select name="farmer_id" class="form-control" required>
            <option value="">-- Select Farmer --</option>
            @foreach ($farmers as $farmer)
            <option value="{{ $farmer->id }}">{{ $farmer->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- <div class="mb-3">
        <label>Palay Type</label>
        <select name="palay_type" class="form-control" required>
            <option value="Dry">Dry</option>
            <option value="Wet">Wet</option>
        </select>
    </div> -->

    <div class="mb-3">
        <label>Inventory Type</label>
        <select name="inventory_type_id" class="form-control" required>
            <option value="">-- Select Inventory Type --</option>
            @foreach ($types as $type)
            @if (strtolower($type->name) === 'palay')
            <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endif
            @endforeach
        </select>
        <label>Palay Type</label>
        <select name="palay_type" class="form-control" required>
            <option value="Dry">Dry</option>
            <option value="Wet">Wet</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Number of Bags</label>
        <input type="number" name="bags" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Total Weight (kg)</label>
        <input type="number" step="0.01" name="total_weight" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>WSR Number</label>
        <input type="text" name="wsr_number" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Warehouse</label>
        <select name="warehouse_id" class="form-control" required>
            <option value="">-- Select Warehouse --</option>
            @foreach ($warehouses as $warehouse)
            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Save Record</button>
</form>
@endsection