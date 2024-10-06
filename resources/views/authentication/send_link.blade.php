@extends('layouts.header')

@section('content')
    <div class="container text-light" style="height: 100svh;margin-top: 5rem">
        <div class="col-4 p-2 " style="top: 50px;background: rgba(253, 247, 191, 0.17);margin: 0 auto;">
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

            <p class="fw-bold text-center" style="font-size: 2rem">Submitted Successfully!
            </p>
            <p class="text-light text-wrap ">Check your email for a link to reset your password. If it doesn’t appear within a few minutes, check your spam folder

            </p>
            <a href="{{ route('login') }}" class="btn bg-dark text-light">return to sign in</a>
    </div>
    {{-- Check your email for a link to reset your password. If it doesn’t appear within a few minutes, check your spam folder. --}}
@endsection
