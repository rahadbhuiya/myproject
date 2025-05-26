@extends('admin.layouts.admin')
@section('title', 'Order Details')
@section('content')

<div class="card">
  <div class="card-header">
    <h5>Order #{{ $order->id }} Details</h5>
  </div>
  <div class="card-body">
    <p><strong>User:</strong> {{ $order->user->name ?? 'N/A' }}</p>
    <p><strong>User Email:</strong> {{ $order->email ?? 'N/A' }}</p>
    <p><strong>Game:</strong> {{ $order->game->name ?? 'N/A' }}</p>
    <p><strong>Game UID:</strong> {{ $order->game_uid ?? 'N/A' }}</p>
    <p><strong>Product:</strong> {{ $order->product->product_name ?? 'N/A' }}</p>
    <p><strong>Amount:</strong> {{ $order->amount ?? $order->price ?? 'N/A' }} BDT</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <p><strong>Payment Method:</strong> {{ $order->payment_method ?? 'N/A' }}</p>
    <p><strong>Sender Number:</strong> {{ $order->sender_number ?? 'N/A' }}</p>
    <p><strong>Transaction ID:</strong> {{ $order->transaction_id ?? 'N/A' }}</p>
    <p><strong>Created At:</strong> {{ $order->created_at ? $order->created_at->format('d M Y, h:i A') : 'N/A' }}</p>
  </div>
  <div class="card-footer">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
  </div>
</div>

@endsection
