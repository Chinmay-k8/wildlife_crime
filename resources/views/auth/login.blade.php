<!-- resources/views/auth/login.blade.php -->

@extends('layouts.auth')

@section('title', 'Login')

@section('page-title', 'Log In')
@section('page-description', 'Enter your email and password to access your account.')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="user_name" class="form-label">User Name:</label>
            <input type="user_name" id="user_name" name="user_name" class="form-control" value="{{ old('user_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <div class="text-center d-grid">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
@endsection
