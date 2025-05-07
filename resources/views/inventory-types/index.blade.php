@extends('layouts.app')

@section('content')
<h2 class="mb-4">Inventory Types</h2>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('inventory-types.store') }}" method="POST" class="mb-3">
    @csrf
    <div class="input-group">
        <input type="text" name="name" class="form-control" placeholder="New type (e.g., Corn)" required>
        <button type="submit" class="btn btn-primary">Add Type</button>
    </div>
</form>

<ul class="list-group">
    @foreach ($types as $type)
    <li class="list-group-item">{{ $type->name }}</li>
    @endforeach
</ul>
@endsection