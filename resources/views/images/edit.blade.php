@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Image</h2>
        <form action="{{ route('images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="name">Image Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $image->name }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="image">Choose New Image (optional):</label>
                <input type="file" name="image" class="form-control mb-3">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
