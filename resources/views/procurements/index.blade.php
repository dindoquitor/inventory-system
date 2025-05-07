@extends('layouts.app')

@section('content')
<h2 class="mb-4">Procurement Records</h2>

<a href="{{ route('procurements.create') }}" class="btn btn-primary mb-3">+ New Record</a>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>Farmer</th>
            <th>Sex</th>
            <th>Age</th>
            <th>Type</th>
            <th>Bags</th>
            <th>Total (kg)</th>
            <th>Per Bag (kg)</th>
            <th>WSR</th>
            <th>Warehouse</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($procurements as $p)
        <tr>
            <td>{{ $p->date }}</td>
            <td>{{ $p->farmer->name }}</td>
            <td>{{ $p->farmer->sex }}</td>
            <td>{{ $p->farmer->age }}</td>
            <td>{{ $p->palay_type }}</td>
            <td>{{ $p->bags }}</td>
            <td>{{ $p->total_weight }}</td>
            <td>{{ number_format($p->weight_per_bag, 2) }}</td>
            <td>{{ $p->wsr_number }}</td>
            <td>{{ $p->warehouse->name }}</td>
            <td>
                <a href="{{ route('procurements.edit', $p) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection