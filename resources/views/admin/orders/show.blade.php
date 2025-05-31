@extends('admin.layouts.admin')
@section('title', 'Order Details')
@section('content')

<div class="card">
  <div class="card-header">
    <h5>Order #{{ $order->id }} Details</h5>
  </div>

  <div class="card-body">
    <!-- User Information -->
    <p><strong>User:</strong> {{ $order->user->name ?? 'N/A' }}</p>
    <p><strong>User Email:</strong> {{ $order->email ?? 'N/A' }}</p>

    <!-- Game Information -->
    <p><strong>Game:</strong> {{ $order->game->name ?? 'N/A' }}</p>
    <p><strong>Game UID:</strong> {{ $order->game_uid ?? 'N/A' }}</p>

    <!-- Product Information -->
    <p><strong>Product:</strong> {{ $order->product->product_name ?? 'N/A' }}</p>

    <!-- Pricing and Discount Information -->
    <p><strong>Original Amount:</strong> {{ $order->priceFormatted ?? 'N/A' }}</p>
    <p><strong>Discount Applied:</strong> {{ $order->discountFormatted ?? 'No Discount' }}</p>
    <p><strong>Final Amount:</strong> {{ $order->finalPriceFormatted ?? 'N/A' }}</p>

    <!-- Order Status and Payment Information -->
    <p><strong>Status:</strong> 
        <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'completed' ? 'success' : 'secondary') }}">
            {{ ucfirst($order->status) }}
        </span>
    </p>
    <p><strong>Payment Method:</strong> {{ $order->payment_method ?? 'N/A' }}</p>
    <p><strong>Sender Number:</strong> {{ $order->sender_number ?? 'N/A' }}</p>
    <p><strong>Transaction ID:</strong> {{ $order->transaction_id ?? 'N/A' }}</p>
    <p><strong>Created At:</strong> {{ $order->created_at ? $order->created_at->format('d M Y, h:i A') : 'N/A' }}</p>
  </div>

  <!-- Footer Section with Actions -->
  <div class="card-footer d-flex justify-content-between align-items-center">
    <!-- Back to Orders Button -->
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>

    <!-- Mark as Complete Button -->
    @if(strtolower($order->status) === 'pending')
      <form action="{{ route('admin.orders.complete', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to mark this order as complete?');">
        @csrf
        <button type="submit" class="btn btn-success">Mark as Complete</button>
      </form>
    @endif
  </div>
</div>

@endsection
