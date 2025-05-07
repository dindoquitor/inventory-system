@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Regions</h2>

    <a href="{{ route('regions.create') }}" class="btn btn-primary mb-4">+ Add Region</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="list-group">
        @foreach ($regions as $region)
            <li class="list-group-item">{{ $region->name }}</li>
        @endforeach
    </ul>
@endsection
