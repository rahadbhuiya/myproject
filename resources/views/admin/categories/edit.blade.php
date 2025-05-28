@extends('admin.layouts.admin')

@section('title', 'Edit Category')

@push('styles')
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        border: none;
    }
    .card-header h4 {
        font-weight: 700;
        color: #333;
    }
    .form-label {
        font-weight: 600;
        color: #444;
    }
    .form-control {
        border-radius: 8px;
        border: 1.5px solid #ddd;
        padding: 10px 12px;
        transition: border-color 0.3s ease;
        font-size: 1rem;
    }
    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 8px rgba(40, 167, 69, 0.4);
        outline: none;
    }
    button.btn-success {
        background-color: #28a745;
        border-color: #28a745;
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }
    button.btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
    img {
        border-radius: 8px;
        border: 1px solid #ddd;
    }
    .mb-3 {
        margin-bottom: 1.25rem !important;
    }
</style>
@endpush

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
