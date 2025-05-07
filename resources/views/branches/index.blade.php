@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Branches</h2>

    <a href="{{ route('branches.create') }}" class="btn btn-primary mb-3">+ Add Branch</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="list-group">
        @foreach ($branches as $branch)
            <li class="list-group-item">
                {{ $branch->name }} (Region: {{ $branch->region->name }})
            </li>
        @endforeach
    </ul>
@endsection
