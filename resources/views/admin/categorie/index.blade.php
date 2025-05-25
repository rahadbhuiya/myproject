@extends('admin.layouts.admin')
@section('title', 'Banner')
@section('content')

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Categories</h5>
    <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">Add New Category</a>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
          <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>
              @if ($category->image)
                <img src="{{ $category->image }}" alt="Category Image" width="80">
              @else
                <span class="text-muted">No Image</span>
              @endif
            </td>
            <td>
              <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-info">Edit</a>
              <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this category?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
