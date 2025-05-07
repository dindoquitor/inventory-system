@extends('layouts.app')

@section('content')
<h2 class="mb-4">Drying Facilities</h2>

<a href="{{ route('drying-facilities.create') }}" class="btn btn-primary mb-3">+ Add Facility</a>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Type</th>
            <th>Name</th>
            <th>Location</th>
            <th>Brand</th>
            <th>Capacity (bags/hour)</th>
            <th>Accountable Officer</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($facilities as $facility)
        <tr>
            <td>{{ $facility->type }}</td>
            <td>{{ $facility->name ?? '-' }}</td>
            <td>{{ $facility->location }}</td>
            <td>{{ $facility->brand ?? '-' }}</td>
            <td>{{ $facility->capacity }}</td>
            <td>{{ $facility->accountable_officer }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection