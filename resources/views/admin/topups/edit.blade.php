@extends('admin.layouts.admin')

@section('title', 'Edit Top-Up Product')

@section('content')
<div class="card">
  <div class="card-header">
    <h5>Edit Top-Up Product</h5>
  </div>
  <div class="card-body">
    <form action="{{ route('admin.topups.update', $topUpProduct->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="game_id" class="form-label">Game</label>
        <select name="game_id" class="form-control" required>
          @foreach ($games as $game)
            <option value="{{ $game->id }}" {{ $topUpProduct->game_id == $game->id ? 'selected' : '' }}>
              {{ $game->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="product_name" class="form-label">Product Name</label>
        <input type="text" name="product_name" class="form-control" value="{{ $topUpProduct->product_name }}" required>
      </div>

      <div class="mb-3">
        <label for="amount" class="form-label">Amount</label>
        <input type="number" name="amount" class="form-control" value="{{ $topUpProduct->amount }}" required>
      </div>

      <div class="mb-3">
        <label for="discount" class="form-label">Discount (%)</label>
        <input type="number" name="discount" class="form-control" min="0" max="100" value="{{ old('discount', $topUpProduct->discount) }}" required>
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">Price (BDT)</label>
        <input type="number" name="price" class="form-control" value="{{ $topUpProduct->price }}" required>
      </div>

      <div class="mb-3">
        <label for="delivery_time" class="form-label">Delivery Time</label>
        <input type="text" name="delivery_time" class="form-control" value="{{ $topUpProduct->delivery_time }}" required>
      </div>

      <div class="mb-3">
        <label for="instructions" class="form-label">Instructions</label>
        <textarea name="instructions" id="instructions" class="form-control" rows="3" required>{{ old('instructions', $topUpProduct->instructions) }}</textarea>
      </div>

      <button type="submit" class="btn btn-primary">Update Product</button>
      <a href="{{ route('admin.topups.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>
@endsection
