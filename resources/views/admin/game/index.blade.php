@extends('admin.layouts.admin')
@section('title', 'Banner')
@section('content')

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Games</h5>
    <a href="{{ route('games.create') }}" class="btn btn-primary btn-sm">Add New Game</a>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Logo</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($games as $game)
          <tr>
            <td>{{ $game->name }}</td>
            <td>{{ $game->category->name ?? 'N/A' }}</td>
            <td>
              @if ($game->logo)
                <img src="{{ $game->logo }}" alt="Game Logo" width="60">
              @else
                <span class="text-muted">No Logo</span>
              @endif
            </td>
            <td>{{ Str::limit($game->description, 80) }}</td>
            <td>
              <a href="{{ route('games.edit', $game->id) }}" class="btn btn-sm btn-info">Edit</a>
              <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this game?')">
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
