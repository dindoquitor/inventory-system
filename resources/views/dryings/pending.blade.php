@extends('layouts.app')

@section('content')
<h2 class="mb-4">Pending Drying Receipts</h2>

@if ($dryings->isEmpty())
<p>No pending receipts.</p>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Farmer</th>
            <th>Method</th>
            <th>Issued</th>
            <th>Facility</th>
            <th>Warehouse</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dryings as $d)
        <tr>
            <td>{{ $d->procurement->farmer->name }}</td>
            <td>{{ $d->drying_method }}</td>
            <td>{{ $d->date_issued }}</td>
            <td>{{ $d->facility->location }}</td>
            <td>{{ $d->warehouse->name }}</td>
            <td>
                <a href="{{ route('dryings.complete', $d) }}" class="btn btn-sm btn-warning">Receive</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection