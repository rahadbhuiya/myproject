@extends('admin.layouts.admin')
@section('title', 'Top-Up Products')
@section('content')

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Top-Up Products</h5>
    <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">Add New Product</a>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Game</th>
            <th>Product Name</th>
            <th>Amount</th>
            <th>Price</th>
            <th>Delivery Time</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($topUpProducts as $topUpProduct)
          <tr>
            <td>{{ $topUpProduct->game->name ?? 'N/A' }}</td>
            <td>{{ $topUpProduct->product_name }}</td>
            <td>{{ $topUpProduct->amount }}</td>
            <td>{{ $topUpProduct->price }} BDT</td>
            <td>{{ $topUpProduct->delivery_time }}</td>
            <td>
              <a href="{{ route('products.edit', $topUpProduct->id) }}" class="btn btn-sm btn-info">Edit</a>
              <form action="{{ route('products.destroy', $topUpProduct->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this product?')">
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
