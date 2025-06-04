@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2>Exchange Rate</h2>
        @if($exchangeRate)
            <p>Current Rate: <strong>{{ $exchangeRate->rate }}</strong></p>
        @else
            <p>No exchange rate available.</p>
        @endif
    </div>
@endsection
