@extends('layouts.simple')

@section('title', 'Order Successful')

@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #4a90e2, #50e3c2);
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        h2 {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            text-shadow: 1px 1px 5px rgba(0,0,0,0.3);
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }
        .container {
            max-width: 600px;
            margin: 150px auto;
            background: rgba(255, 255, 255, 0.15);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            backdrop-filter: blur(10px);
        }
    </style>

    <div class="container text-center">
        <h2>Order Successful!</h2>
        <p>You will be redirected to the home page shortly...</p>
    </div>

    <script>
        setTimeout(() => {
            window.location.href = "{{ route('home') }}";
        }, 3000);
    </script>
@endsection
