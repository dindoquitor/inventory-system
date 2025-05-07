@extends('layouts.app')

@section('content')
<h2 class="mb-4">Add Drying Facility</h2>

<form method="POST" action="{{ route('drying-facilities.store') }}">
    @csrf

    <div class="mb-3">
        <label>Type of Facility</label>
        <select name="type" id="type" class="form-control" required onchange="toggleFields()">
            <option value="">-- Select Type --</option>
            <option value="Mechanical">Mechanical Dryer</option>
            <option value="Sun Drying">Sun Drying</option>
        </select>
    </div>

    <div class="mb-3 mechanical-only d-none">
        <label>Name of Machine</label>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="mb-3">
        <label>Location / Address</label>
        <input type="text" name="location" class="form-control" required>
    </div>

    <div class="mb-3 mechanical-only d-none">
        <label>Brand</label>
        <input type="text" name="brand" class="form-control">
    </div>

    <div class="mb-3">
        <label>Capacity (in bags or bags/hour)</label>
        <input type="number" name="capacity" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Accountable Officer</label>
        <input type="text" name="accountable_officer" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Save Facility</button>
</form>

<script>
    function toggleFields() {
        const type = document.getElementById('type').value;
        const mechanicalFields = document.querySelectorAll('.mechanical-only');
        mechanicalFields.forEach(el => {
            el.classList.toggle('d-none', type !== 'Mechanical');
        });
    }
</script>
@endsection