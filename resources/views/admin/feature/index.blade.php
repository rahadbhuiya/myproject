@extends('admin.layouts.admin')
@section('title', 'Feature Banners')
@section('content')

<div class="card mt-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Feature Banners</h5>
    <a href="{{ route('features.create') }}" class="btn btn-sm btn-primary">
      <i class="bi bi-plus-circle"></i> Add Banner
    </a>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Title</th>
            <th>Description</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($features as $feature)
          <tr>
            <td>{{ $feature->title }}</td>
            <td>{{ $feature->description }}</td>
            <td class="text-center">
              <form action="{{ route('features.destroy', $feature->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feature?');" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="3" class="text-center">No features found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
