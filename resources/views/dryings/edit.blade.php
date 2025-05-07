@extends('layouts.app')

@section('content')
<h2 class="mb-4">Edit Drying Record</h2>

<form method="POST" action="{{ route('dryings.update', $drying) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Wet Palay Procurement</label>
        <select name="procurement_id" class="form-control" required>
            @foreach ($wetProcurements as $p)
            <option value="{{ $p->id }}" {{ $drying->procurement_id == $p->id ? 'selected' : '' }}>
                {{ $p->date }} - {{ $p->farmer->name }} ({{ $p->bags }} bags)
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Drying Method</label>
        <select name="drying_method" class="form-control" required>
            <option value="Sun Drying" {{ $drying->drying_method == 'Sun Drying' ? 'selected' : '' }}>Sun Drying</option>
            <option value="Mechanical" {{ $drying->drying_method == 'Mechanical' ? 'selected' : '' }}>Mechanical</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Drying Facility</label>
        <select name="drying_facility_id" class="form-control" required>
            @foreach ($facilities as $facility)
            <option value="{{ $facility->id }}" {{ $drying->drying_facility_id == $facility->id ? 'selected' : '' }}>
                {{ $facility->type }} - {{ $facility->location }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Date Issued</label>
        <input type="date" name="date_issued" class="form-control" value="{{ $drying->date_issued }}" required>
    </div>

    <div class="mb-3">
        <label>Date Received</label>
        <input type="date" name="date_received" class="form-control" value="{{ $drying->date_received }}">
    </div>

    <div class="mb-3">
        <label>Final Dry Weight (kg)</label>
        <input type="number" step="0.01" name="final_weight" class="form-control" value="{{ $drying->final_weight }}">
    </div>

    <div class="mb-3">
        <label>Warehouse</label>
        <select name="warehouse_id" class="form-control" required>
            @foreach ($warehouses as $wh)
            <option value="{{ $wh->id }}" {{ $drying->warehouse_id == $wh->id ? 'selected' : '' }}>
                {{ $wh->name }}
            </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Record</button>
</form>
@endsection