@extends('layouts.appOwner')

@section('title', 'Edit Product - MagatsuStore')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Product</h1>

        <form action="{{ route('owner.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="100">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
@endsection
