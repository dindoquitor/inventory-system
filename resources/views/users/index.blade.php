@extends('layouts.app')

@section('content')
<h2 class="mb-4">Users</h2>

<a href="{{ route('users.create') }}" class="btn btn-primary mb-3">+ Add User</a>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<ul class="list-group">
    @foreach ($users as $user)
    <li class="list-group-item">
        <strong>{{ $user->name }}</strong> — {{ $user->email }}<br>
        Role: {{ $user->getRoleNames()->first() ?? 'None' }}<br>
        Branch: {{ $user->branch->name ?? 'N/A' }}<br>
        Position: {{ $user->position ?? 'N/A' }} <br>
        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary mt-1">Edit</a>
    </li>
    @endforeach
</ul>
@endsection