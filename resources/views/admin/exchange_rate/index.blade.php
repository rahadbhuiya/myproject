@extends('admin.layouts.admin')
@section('title', 'Exchange Rate')
@section('content')

<h2 class="text-xl font-bold mb-4">Currency Exchange Rate</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.exchange_rate.update') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="rate" class="block">Exchange Rate (USD to BDT)</label>
        <input type="number" name="rate" id="rate" class="form-control" value="{{ $exchangeRate?->rate }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Rate</button>
</form>

@endsection