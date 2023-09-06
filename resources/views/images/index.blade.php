@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('images.create') }}" class="btn btn-primary">Upload Image</a>
        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <table class="table mt-4 border">
            <thead>
                <tr>
                    <th class="text-success">ID</th>
                    <th class="text-success">Name</th>
                    <th class="text-success">Image</th>
                    <th class="text-success">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($images as $image)
                    <tr>
                        <td>{{ $image->id }}</td>
                        <td>{{ $image->name }}</td>
                        <td>
                            <img src="{{ $image->fullUrl }}" alt="{{ $image->name }}" class="img-thumbnail" width="100">
                        </td>
                        <td>
                            <a href="{{ route('images.edit', $image->id) }}" class="text-success"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('images.destroy', $image->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-danger bg-light border-0" onclick="return confirm('Are you sure you want to delete this image?')"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
