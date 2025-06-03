@extends('admin.layouts.admin')

@section('title', 'Orders')

@section('styles')
<style>
  .pagination {
    display: flex !important;
    justify-content: center !important;
    gap: 0.3rem;
    padding: 1rem 0;
  }

  .pagination li a,
  .pagination li span {
    display: inline-block;
    padding: 0.25rem 0.6rem;
    width: 34px;
    height: 34px;
    line-height: 30px;
    text-align: center;
    font-size: 0.85rem;
    color: #343a40;
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    transition: all 0.2s ease;
  }

  .pagination li a:hover,
  .pagination li a:focus {
    background-color: #0d6efd;
    color: #fff;
    text-decoration: none;
  }

  .pagination li.active span {
    background-color: #0a58ca;
    color: #fff;
    border-color: #0a58ca;
    cursor: default;
  }

  .pagination li.disabled span {
    background-color: #e9ecef;
    color: #adb5bd;
    cursor: not-allowed;
  }
</style>
@endsection

@section('content')

<div class="card">
  <div class="card-header">
    <h5 class="mb-0">Orders</h5>
  </div>

  <div class="card-body">
    <!-- Search Section -->
    <div class="d-flex justify-content-between mb-3">
      <div>
        <!-- <a href="{{ route('admin.orders.create') }}" class="btn btn-primary btn-sm">
          <i class="bi bi-plus-circle"></i> Add New Order
        </a> -->
      </div>

      <div>
        <form action="{{ route('admin.orders.index') }}" method="GET" class="d-flex">
          <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Search Orders...">
          <button type="submit" class="btn btn-sm btn-outline-secondary ms-2">
            <i class="bi bi-search"></i> Search
          </button>
        </form>
      </div>
    </div>

    <!-- Orders Table -->
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>User</th>
            <th>Game</th>
            <th>Product</th>
            <th>Amount</th>
            <th>Discount</th>
            <th>Final Amount</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($orders as $order)
          <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user ? $order->user->name : 'Guest' }}</td>
            <td>{{ $order->game->name ?? 'N/A' }}</td>
            <td>{{ $order->product->product_name ?? 'N/A' }}</td>
            <td>{{ number_format($order->price, 2) }} BDT</td>
            <td>{{ $order->discount ? $order->discount . '%' : 'N/A' }}</td>
            <td>{{ number_format($order->final_price, 2) }} BDT</td>
            <td>
              <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'completed' ? 'success' : 'secondary') }}">
                {{ ucfirst($order->status) }}
              </span>
            </td>
            <td>
              <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="View Order">
                <i class="bi bi-eye"></i>
              </a>
              <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this order?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Order">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="9" class="text-center">No orders found</td>
          </tr>
          @endforelse
        </tbody>
      </table>

      <!-- Pagination with arrows -->
      <div class="d-flex justify-content-between mt-3 align-items-center">
        <div>
          Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} orders
        </div>
        <div>
          {{-- Custom pagination view --}}
          @php
              $pagination = $orders->onEachSide(1)->links('vendor.pagination.custom');
          @endphp
          {!! $pagination !!}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
  // Enable Bootstrap tooltips
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
</script>
@endsection
