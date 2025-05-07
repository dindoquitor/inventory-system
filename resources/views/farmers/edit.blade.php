@extends('layouts.app')

@section('content')
<h2 class="mb-4">Edit Farmer Information</h2>

<form method="POST" action="{{ route('farmers.update', $farmer) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Full Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $farmer->name) }}" required>
    </div>

    <div class="mb-3">
        <label>Sex</label>
        <select name="sex" class="form-control" required>
            <option value="Male" {{ $farmer->sex == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ $farmer->sex == 'Female' ? 'selected' : '' }}>Female</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Age</label>
        <input type="number" name="age" class="form-control" value="{{ old('age', $farmer->age) }}" required>
    </div>

    <div class="mb-3">
        <label>Number of Hectares</label>
        <input type="number" step="0.01" name="hectares" class="form-control" value="{{ old('hectares', $farmer->hectares) }}" required>
    </div>

    <div class="mb-3">
        <label>Address</label>
        <input type="text" name="address" class="form-control" value="{{ old('address', $farmer->address) }}" required>
    </div>

    <div class="mb-3">
        <label>Farm Location</label>
        <input type="text" name="farm_location" class="form-control" value="{{ old('farm_location', $farmer->farm_location) }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Farmer</button>
</form>
@endsection