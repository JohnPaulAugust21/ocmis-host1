@extends('layouts.header')

@section('content')

<div class="container"
    style="display: flex;flex-direction: column;align-items: center; justify-content: center; height: 100vh;">
    <div class="transparent-box" style=" top: 50px;">
        @if (session('success'))
        <div class="alert alert-success"
            style="background-color: #dff0d8; border-color: #d0e9c6; color: #3c763d; padding: 10px;">
            {{ session('status') }}
        </div>
        @endif
        @if (session('successcreate'))
        <div class="alert alert-info"
            style="background-color: #dff0d8; border-color: #d0e9c6; color: #3c763d; padding: 10px;">
            {{ session('successcreate') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger"
            style="background-color: #f2dede; border-color: #ebccd1; color: #a94442; padding: 10px;">
            {{ session('error') }}
        </div>
        @endif

        <h2>LOGIN</h2>
        <form method="POST" action="{{ route('postlogin') }}">
            @csrf
            <label>USERNAME: <input type="text" id="username" name="username"></label>
            <label>PASSWORD: <input type="password" id="password" name="password"></label>
            <a href="{{ route('forgotPassword') }}" style="color: rgb(141, 141, 255)">Forgot password?</a>
            <button class="submit-button" type="submit" style="margin-left: 60px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="189" height="63" viewBox="0 0 189 63" fill="none">
                    <path d="M0 0H189V63H0V0Z" fill="url(#paint0_linear_104_94)" />
                    <defs>
                        <linearGradient id="paint0_linear_104_94" x1="109.941" y1="-2.26211e-08" x2="109.941" y2="63"
                            gradientUnits="userSpaceOnUse">
                            <stop offset="0.911458" stop-color="#23231F" />
                            <stop offset="1" stop-color="#6A4D4D" stop-opacity="0" />
                        </linearGradient>
                    </defs>
                </svg><span>SUBMIT</span>
            </button>
            <h3 class="signup-header">Don't have an account? <a href="{{route('register')}}">Sign Up</a></h3>
    </div>
    </form>
</div>
</br> </br>
@endsection
