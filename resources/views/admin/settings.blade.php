@extends('admin.layouts.admin') {{-- admin layout --}}

@section('content')
<div class="container">
    <h2>Account Settings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email address</label>
            <input 
                type="email" 
                name="email" 
                id="email"
                class="form-control @error('email') is-invalid @enderror" 
                value="{{ old('email', auth()->user()->email) }}" 
                required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="current_password">Current Password <small>(Required to change email or password)</small></label>
            <input 
                type="password" 
                name="current_password" 
                id="current_password"
                class="form-control @error('current_password') is-invalid @enderror" 
                required>
            @error('current_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">New Password <small>(Leave blank if you don't want to change)</small></label>
            <input 
                type="password" 
                name="password" 
                id="password"
                class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input 
                type="password" 
                name="password_confirmation" 
                id="password_confirmation"
                class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Settings</button>
    </form>
</div>
@endsection
