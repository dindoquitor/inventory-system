@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Add Branch</h2>

    <form method="POST" action="{{ route('branches.store') }}">
        @csrf
        <div class="mb-3">
            <label>Branch Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Select Region</label>
            <select name="region_id" class="form-control" required>
                <option value="">-- Choose Region --</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            </select>
            @error('region_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
