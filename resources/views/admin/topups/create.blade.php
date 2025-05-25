@extends('admin.layouts.admin')
@section('title', 'Create Top-Up Product')
@section('content')

<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Add New Top-Up Product</div>
                <hr>

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- First Column (50%) -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="game_id">Game</label>
                                <select name="game_id" id="game_id" class="form-control" required>
                                    <option value="" disabled selected>Select a Game</option>
                                    @foreach ($games as $game)
                                        <option value="{{ $game->id }}" {{ old('game_id') == $game->id ? 'selected' : '' }}>{{ $game->name }}</option>
                                    @endforeach
                                </select>
                                @error('game_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" name="product_name" id="product_name" class="form-control" required value="{{ old('product_name') }}">
                                @error('product_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" name="amount" id="amount" class="form-control" required value="{{ old('amount') }}">
                                @error('amount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Second Column (50%) -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" class="form-control" required value="{{ old('price') }}">
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="delivery_time">Delivery Time</label>
                                <input type="text" name="delivery_time" id="delivery_time" class="form-control" required value="{{ old('delivery_time') }}">
                                @error('delivery_time')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="instructions">Instructions</label>
                                <textarea name="instructions" id="instructions" class="form-control" required>{{ old('instructions') }}</textarea>
                                @error('instructions')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group py-2">
                        <div class="icheck-material-white">
                            <input type="checkbox" id="agree_terms" name="agree_terms" checked=""/>
                            <label for="agree_terms">I Agree to the Terms & Conditions</label>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-light px-5"><i class="icon-lock"></i> Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
