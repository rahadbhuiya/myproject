@extends('admin.layouts.admin')
@section('title', 'Banner')
@section('content')

<div class="card mt-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Banners</h5>
    <a href="{{ route('banners.create') }}" class="btn btn-sm btn-primary">
      <i class="bi bi-plus-circle"></i> Add Banner
    </a>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Price</th>
            <th>Short Title</th>
            <th>Title</th>
            <th>Subtitle</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($banners as $banner)
          <tr>
            <td>{{ $banner->id }}</td>
            <td><img src="{{ $banner->hero_image }}" alt="Banner Image" width="100"></td>
            <td>{{ $banner->price }}</td>
            <td>{{ $banner->cta_button_text }}</td>
            <td>{{ $banner->hero_title }}</td>
            <td>{{ $banner->hero_subtitle }}</td>
            <td class="text-center">
              <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Banner?');" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center">No banners found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
