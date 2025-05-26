@extends('admin.layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Category</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input 
                    type="text" 
                    name="name" 
                    class="form-control" 
                    value="{{ old('name', $category->name) }}" 
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea 
                    name="description" 
                    class="form-control">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
                @if ($category->image)
                    <img src="{{ $category->image }}" class="mt-2" width="120" alt="Category Image">
                @endif
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
@endsection
