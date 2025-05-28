@extends('admin.layouts.admin')

@section('title', 'Exchange Rates')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Exchange Rates List</h2>
        <a href="{{ route('admin.exchange_rate.create') }}" class="btn btn-success">Add / Update Rate</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($exchangeRates->isEmpty())
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
            No exchange rates found.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="table-auto w-full border border-gray-300 shadow-sm rounded">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Rate (USD to BDT)</th>
                        <th class="border border-gray-300 px-4 py-2">Created At</th>
                        <th class="border border-gray-300 px-4 py-2">Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exchangeRates as $rate)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">{{ $rate->id }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-green-700 font-bold">{{ number_format($rate->rate, 2) }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $rate->created_at->format('Y-m-d H:i') }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $rate->updated_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
