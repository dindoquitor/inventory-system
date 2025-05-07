@extends('layouts.app')

@section('content')
<h2 class="mb-4">Dashboard</h2>

<div class="card mb-4">
    <div class="card-body">
        <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Position:</strong> {{ Auth::user()->position ?? 'N/A' }}</p>
        <p><strong>Role:</strong> {{ Auth::user()->getRoleNames()->first() ?? 'N/A' }}</p>
        <p><strong>Branch:</strong> {{ Auth::user()->branch->name ?? 'N/A' }}</p>
    </div>
</div>

<h4>Available Modules</h4>
<ul class="list-group">
    @role('Admin')
    <li class="list-group-item"><a href="{{ route('regions.index') }}" class="btn btn-outline-primary">Regions</a></li>
    <li class="list-group-item"><a href="{{ route('branches.index') }}" class="btn btn-outline-primary">Branches</a></li>
    <li class="list-group-item"><a href="{{ route('warehouses.index') }}" class="btn btn-outline-primary">Warehouses</a></li>
    <li class="list-group-item"><a href="{{ route('farmers.index') }}" class="btn btn-outline-primary">Farmer Masterlist</a></li>
    <li class="list-group-item"><a href="{{ route('users.index') }}" class="btn btn-outline-primary">Users</a></li>
    <li class="list-group-item"><a href="{{ route('procurements.index') }}" class="btn btn-outline-primary">Procurement Module</a></li>
    <li class="list-group-item">
        <a href="{{ route('drying-facilities.index') }}" class="btn btn-outline-primary">Drying Facilities</a>
    </li>
    <li class="list-group-item"><a href="{{ route('dryings.index') }}" class="btn btn-outline-primary">Drying Transactions</a></li>
    <li class="list-group-item"><a href="{{ route('dryings.pending') }}" class="btn btn-outline-primary">Pending Drying Receipts</a></li>
    <li class="list-group-item"><a href="{{ route('inventory-types.index') }}" class="btn btn-outline-primary">Manage Inventory Types</a></li>


    @endrole

    @role('Staff')
    <li class="list-group-item"><a href="{{ route('warehouses.index') }}">Warehouses</a></li>
    <li class="list-group-item"><a href="{{ route('farmers.index') }}">Farmer Masterlist</a></li>
    <li class="list-group-item"><a href="{{ route('procurements.index') }}">Procurement Module</a></li>
    <li class="list-group-item">
        <a href="{{ route('drying-facilities.index') }}">Drying Facilities</a>
    </li>
    <li class="list-group-item"><a href="{{ route('dryings.index') }}">Drying Transactions</a></li>
    <li class="list-group-item">
        <a href="{{ route('dryings.pending') }}">Pending Drying Receipts</a>
    </li>

    @endrole

    @role('Viewer')
    <li class="list-group-item">Reports access (coming soon)</li>
    @endrole
</ul>
@endsection