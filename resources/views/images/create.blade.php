@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Upload Image</h2>
        <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Image Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="image">Choose Image:</label><br>
                <input type="file" name="image" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
@endsection
