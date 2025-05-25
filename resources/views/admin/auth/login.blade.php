<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" action="{{ route('admin.login.submit') }}" class="bg-white p-6 rounded shadow-md w-96">
        @csrf
        <h2 class="text-xl font-bold mb-4 text-center">Admin Login</h2>

        @if($errors->any())
            <div class="mb-3 text-red-600">{{ $errors->first() }}</div>
        @endif

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label>Password</label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Login</button>
    </form>
</body>
</html>
