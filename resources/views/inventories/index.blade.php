@extends('layouts.app')

@section('content')
<h2>Current Inventory</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Type</th>
            <th>Classification</th>
            <th>Warehouse</th>
            <th>Bags</th>
            <th>Total Weight (kg)</th>
            <th>Kilos/Bag</th>
            <th>Recorded At</th>
            <th>Encoded By</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inventories as $item)
        <tr>
            <td>{{ $item->type->name ?? '-' }}</td>
            <td>{{ $item->classification ?? '-' }}</td>
            <td>{{ $item->warehouse->name }}</td>
            <td>{{ $item->bags }}</td>
            <td>{{ $item->total_weight }}</td>
            <td>{{ number_format($item->kilos_per_bag, 2) }}</td>
            <td>{{ $item->recorded_at }}</td>
            <td>{{ $item->user->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection