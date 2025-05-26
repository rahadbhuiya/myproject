@extends('admin.layouts.admin')
@section('title', 'Add New Top-Up Product')
@section('content')

<div class="card">
  <div class="card-header">
    <h5>Add New Top-Up Product</h5>
  </div>

  <div class="card-body">
    <form action="{{ route('admin.topups.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="game_id" class="form-label">Game</label>
        <select name="game_id" id="game_id" class="form-select" required>
          <option value="" selected disabled>Select Game</option>
          @foreach ($games as $game)
            <option value="{{ $game->id }}">{{ $game->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="product_name" class="form-label">Product Name</label>
        <input type="text" name="product_name" id="product_name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="amount" class="form-label">Amount</label>
        <input type="number" name="amount" id="amount" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">Price (BDT)</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="delivery_time" class="form-label">Delivery Time</label>
        <input type="text" name="delivery_time" id="delivery_time" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="instructions" class="form-label">Instructions</label>
        <textarea name="instructions" id="instructions" class="form-control" rows="3" required></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
  </div>
</div>

@endsection
