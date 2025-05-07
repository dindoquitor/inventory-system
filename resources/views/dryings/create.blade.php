@extends('layouts.app')

@section('content')
<h2 class="mb-4">Record Drying Transaction</h2>

<form method="POST" action="{{ route('dryings.store') }}">
    @csrf

    <div class="mb-3">
        <label>Wet Palay Procurement</label>
        <select name="procurement_id" class="form-control" required>
            <option value="">-- Select Procurement --</option>
            @foreach ($wetProcurements as $p)
            <option value="{{ $p->id }}">
                {{ $p->date }} - {{ $p->farmer->name }} ({{ $p->bags }} bags)
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Drying Method</label>
        <select name="drying_method" class="form-control" required>
            <option value="Sun Drying">Sun Drying</option>
            <option value="Mechanical">Mechanical</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Drying Facility</label>
        <select name="drying_facility_id" class="form-control" required>
            <option value="">-- Select Facility --</option>
            @foreach ($facilities as $facility)
            <option value="{{ $facility->id }}">
                {{ $facility->type }} - {{ $facility->location }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Date Issued</label>
        <input type="date" name="date_issued" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>WSI Number</label>
        <input type="text" name="wsi_number" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Warehouse to Store</label>
        <select name="warehouse_id" class="form-control" required>
            <option value="">-- Select Warehouse --</option>
            @foreach ($warehouses as $wh)
            <option value="{{ $wh->id }}">{{ $wh->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Save Transaction</button>
</form>
@endsection