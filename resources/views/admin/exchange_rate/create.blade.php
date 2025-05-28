@extends('admin.layouts.admin')
@section('title', 'Exchange Rate')
@section('content')

<h2 class="text-xl font-bold mb-4">Currency Exchange Rate</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.exchange_rate.store') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="rate" class="block">Exchange Rate (USD to BDT)</label>
        <input 
            type="number" 
            name="rate" 
            id="rate" 
            class="form-control" 
            value="{{ old('rate', $exchangeRate?->rate) }}" 
            step="0.01"
            required
        >
        @error('rate')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update Rate</button>
</form>

@endsection