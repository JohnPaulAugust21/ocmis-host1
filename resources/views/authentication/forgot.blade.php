@extends('layouts.header')

@section('content')
    <div class="container text-light" style="height: 100svh;margin-top: 5rem">
        <div class="d-grid p-2" style=" top: 50px;background: rgba(253, 247, 191, 0.17);width: fit-content;margin: 0 auto">
            @if (session('success'))
                <div class="alert alert-success"
                    style="background-color: #dff0d8; border-color: #d0e9c6; color: #3c763d; padding: 10px;">
                    {{ session('status') }}
                </div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger"
                    style="background-color: #f2dede; border-color: #ebccd1; color: #a94442; padding: 10px;">
                    Email address is not registered.

                </div>
            @endif

            <p class="fw-bold text-start" style="font-size: 2rem">Forgot password?
            </p>
            <p class="text-light">Enter your registered email address to reset the password

            </p>
            <form method="POST" action="{{ route('checkEmail') }}" class="d-grid p-3 gap-3">
                @csrf
                <div>
                    <label style="font-size: 1rem">Email Address:</label>
                    <input type="email" id="username" name="email" value="{{ old('email') }}">
                </div>

                <button style="background: #23231f;width: fit-content;margin:0 auto" class="btn px-5 py-2 text-light text-center" type="submit" >
                   <span>SUBMIT</span>
                </button>

        </form>
    </div>
    {{-- Check your email for a link to reset your password. If it doesn’t appear within a few minutes, check your spam folder. --}}
@endsection
