@extends('layouts.app')

@section('content')
<h2 class="mb-4">Create User</h2>

<form method="POST" action="{{ route('users.store') }}">
    @csrf
    <div class="mb-3">
        <label>Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" required>
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Assign Role</label>
        <select name="role" class="form-control" required>
            @foreach ($roles as $role)
            <option value="{{ $role->name }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Assign Branch (optional)</label>
        <select name="branch_id" class="form-control">
            <option value="">-- No Branch --</option>
            @foreach ($branches as $branch)
            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Position <span class="text-danger">*</span></label>
        <input type="text" name="position" class="form-control" required>
        @error('position')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Create</button>
</form>
@endsection