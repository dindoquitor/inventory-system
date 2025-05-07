@extends('layouts.app')

@section('content')
<h2 class="mb-4">Add New Farmer</h2>

<form method="POST" action="{{ route('farmers.store') }}">
    @csrf

    <div class="mb-3">
        <label>Full Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Sex</label>
        <select name="sex" class="form-control" required>
            <option value="">-- Select --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Age</label>
        <input type="number" name="age" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Number of Hectares</label>
        <input type="number" name="hectares" class="form-control" step="0.01" required>
    </div>

    <div class="mb-3">
        <label>Address</label>
        <input type="text" name="address" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Farm Location</label>
        <input type="text" name="farm_location" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Save Farmer</button>
</form>
@endsection