@extends('layouts.app')

@section('content')
<h2 class="mb-4">Drying Transactions</h2>

<a href="{{ route('dryings.create') }}" class="btn btn-primary mb-3">+ New Drying</a>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Farmer</th>
            <th>Method</th>
            <th>Facility</th>
            <th>Issued</th>
            <th>Received</th>
            <th>Dry Weight</th>
            <th>Warehouse</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dryings as $d)
        <tr>
            <td>{{ $d->procurement->farmer->name }}</td>
            <td>{{ $d->drying_method }}</td>
            <td>{{ $d->facility->location }}</td>
            <td>{{ $d->date_issued }}</td>
            <td>{{ $d->date_received ?? '-' }}</td>
            <td>{{ $d->final_weight ?? '-' }}</td>
            <td>{{ $d->warehouse->name }}</td>

            <td>
                <a href="{{ route('dryings.edit', $d) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection