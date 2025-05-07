@extends('layouts.app')

@section('content')
<h2 class="mb-4">Receive Dried Palay</h2>

<form method="POST" action="{{ route('dryings.updateReceipt', $drying) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Date Received</label>
        <input type="date" name="date_received" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Number of Bags</label>
        <input type="number" name="bags" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Final Weight (kg)</label>
        <input type="number" step="0.01" name="final_weight" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>WSR Number</label>
        <input type="text" name="wsr_number" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Submit Receipt</button>
</form>
@endsection