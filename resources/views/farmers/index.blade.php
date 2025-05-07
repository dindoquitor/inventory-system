@extends('layouts.app')

@section('content')
<h2 class="mb-4">Farmer Masterlist</h2>

<a href="{{ route('farmers.create') }}" class="btn btn-primary mb-3">+ Add Farmer</a>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr class="text-center">
            <th>Name</th>
            <th>Sex</th>
            <th>Age</th>
            <th>Hectares</th>
            <th>Address</th>
            <th>Farm Location</th>
            <th>Registered By</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($farmers as $farmer)
        <tr>
            <td>{{ $farmer->name }}</td>
            <td>{{ $farmer->sex }}</td>
            <td>{{ $farmer->age }}</td>
            <td>{{ $farmer->hectares }}</td>
            <td>{{ $farmer->address }}</td>
            <td>{{ $farmer->farm_location }}</td>
            <td>{{ $farmer->user->name ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('farmers.edit', $farmer) }}" class="btn btn-sm btn-outline-primary">Edit</a>

                <form action="{{ route('farmers.destroy', $farmer) }}" method="POST" style="display:inline-block;"
                    onsubmit="return confirm('Are you sure you want to delete this farmer?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection