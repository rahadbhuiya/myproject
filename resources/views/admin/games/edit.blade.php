@extends('layouts.app')

@section('content')
<h1>Edit Game</h1>

<form action="{{ route('admin.games.update', $game->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="{{ old('name', $game->name) }}" required>

    <label for="category">Category:</label>
    <select name="category_id" id="category" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $game->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <label for="image">Game Image:</label>
    @if($game->image)
        <div>
            <img src="{{ $game->image }}" alt="Current Image" style="max-width: 200px; max-height: 200px;">
        </div>
    @endif
    <input type="file" name="image" id="image" accept="image/*">

    <!-- Add other game fields as needed -->

    <button type="submit">Update Game</button>
</form>
@endsection
