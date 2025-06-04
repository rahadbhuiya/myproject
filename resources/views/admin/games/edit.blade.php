@extends('admin.layouts.admin')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Edit Product</h1>

    <form action="{{ route('admin.games.update', $game->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <!-- Game Name -->
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Product Name</label>
            <input type="text" name="name" id="name" 
                   value="{{ old('name', $game->name) }}" 
                   class="form-control @error('name') is-invalid @enderror" 
                   required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Category Dropdown -->
        <div class="mb-3">
            <label for="category" class="form-label fw-semibold">Category</label>
            <select name="category_id" id="category" 
                    class="form-select @error('category_id') is-invalid @enderror" 
                    required>
                <option value="" disabled selected>Select category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ $game->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label fw-semibold">Description</label>
            <textarea name="description" id="description" rows="5" 
                      class="form-control @error('description') is-invalid @enderror" 
                      required>{{ old('description', $game->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Logo Upload -->
        <div class="mb-4">
            <label for="logo" class="form-label fw-semibold">Product Logo</label>
            @if($game->logo)
                <div class="mb-3">
                    <img src="{{ $game->logo }}?v={{ time() }}" alt="Current Logo" 
                         class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                </div>
            @endif
            <input type="file" name="logo" id="logo" accept="image/*" 
                   class="form-control @error('logo') is-invalid @enderror">
            @error('logo')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary px-4">Update Product</button>
        <a href="{{ route('admin.games.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>

<script>
    // Bootstrap form validation
    (() => {
      'use strict';
      const forms = document.querySelectorAll('.needs-validation');
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();
</script>
@endsection
