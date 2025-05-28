@extends('admin.layouts.admin')

@section('content')
<h1>Edit Game</h1>

<form action="{{ route('admin.games.update', $game->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Game Name -->
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="{{ old('name', $game->name) }}" required>

    <!-- Category Dropdown -->
    <label for="category">Category:</label>
    <select name="category_id" id="category" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $game->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <!-- Description -->
    <label for="description">Description:</label>
    <textarea name="description" id="description" required>{{ old('description', $game->description) }}</textarea>

    <!-- Logo Upload -->
    <label for="logo">Game Logo:</label>
    @if($game->logo)
        <div>
            <img src="{{ $game->logo }}?v={{ time() }}" alt="Current Logo" style="max-width: 200px; max-height: 200px;">
        </div>
    @endif
    <input type="file" name="logo" id="logo" accept="image/*">

    <br><br>
    <button type="submit">Update Game</button>
</form>
@endsection
