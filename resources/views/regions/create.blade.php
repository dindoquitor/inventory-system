@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Add Region</h2>

    <form method="POST" action="{{ route('regions.store') }}">
        @csrf
        <div class="mb-3">
            <label>Region Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
