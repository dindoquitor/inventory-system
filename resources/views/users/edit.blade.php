@extends('layouts.app')

@section('content')
<h2 class="mb-4">Edit User</h2>

<form method="POST" action="{{ route('users.update', $user) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="mb-3">
        <label>Position</label>
        <input type="text" name="position" class="form-control" value="{{ old('position', $user->position) }}" required>
    </div>

    <div class="mb-3">
        <label>Assign Branch</label>
        <select name="branch_id" class="form-control">
            <option value="">-- No Branch --</option>
            @foreach ($branches as $branch)
            <option value="{{ $branch->id }}" {{ $user->branch_id == $branch->id ? 'selected' : '' }}>
                {{ $branch->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Assign Role</label>
        <select name="role" class="form-control" required>
            @foreach ($roles as $role)
            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                {{ $role->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>New Password <small>(leave blank if not changing)</small></label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Update User</button>
</form>
@endsection