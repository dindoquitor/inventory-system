@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Warehouses</h2>

    <a href="{{ route('warehouses.create') }}" class="btn btn-primary mb-3">+ Add Warehouse</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="list-group">
        @foreach ($warehouses as $warehouse)
            <li class="list-group-item">
                <strong>{{ $warehouse->name }}</strong> <br>
                Branch: {{ $warehouse->branch->name }} <br>
                Supervisor: {{ $warehouse->supervisor_name ?? 'N/A' }} <br>
                Location: {{ $warehouse->location ?? 'N/A' }} <br>
                Design Capacity: {{ $warehouse->design_capacity ?? 'N/A' }} bags <br>
                Effective Capacity: {{ $warehouse->effective_capacity ?? 'N/A' }} bags <br>
                Usage Type: {{ $warehouse->usage_type ?? 'N/A' }}
            </li>
        @endforeach
    </ul>
@endsection
