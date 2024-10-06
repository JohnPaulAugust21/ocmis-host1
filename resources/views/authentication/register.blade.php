@extends('layouts.header')

@section('content')
    <div class="container"
        style="display: flex;flex-direction: column;align-items: center; justify-content: center; height: 100vh;">
        <div class="transparent-box" style="top: 300px;">

            @if (session('status'))
                <div class="alert alert-success"
                    style="background-color: #dff0d8; border-color: #d0e9c6; color: #3c763d; padding: 10px;">
                    {{ session('status') }}
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h2>SIGN UP</h2>
            <form method="POST" action="{{ route('postregister') }}">
                @csrf
                <label>LAST NAME: <input type="text" id="lastname" name="lastname" required></label>
                <label>FIRST NAME: <input type="text" id="firstname" name="firstname" required></label>
                <label>MIDDLE NAME: <input type="text" id="middlename" name="middlename"></label>
                <label>ADDRESS: <input type="text" id="address" name="address" required></label>
                <label>EMAIL: <input type="email" id="email" name="email" required></label>
                <label>CONTACT NUMBER: <input type="text" id="contactnumber" name="contactnumber" required></label>
                <label>USERNAME: <input type="text" id="username" name="username" required></label>
                <label>PASSWORD: <input type="password" id="password" name="password"></label>
                <label>CONFIRM PASSWORD: <input type="password" id="confirmpassword" name="confirmpassword"></label>
                <button class="submit-button" type="submit" style="margin-left: 100px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="189" height="63" viewBox="0 0 189 63"
                        fill="none">
                        <path d="M0 0H189V63H0V0Z" fill="url(#paint0_linear_104_94)" />
                        <defs>
                            <linearGradient id="paint0_linear_104_94" x1="109.941" y1="-2.26211e-08" x2="109.941"
                                y2="63" gradientUnits="userSpaceOnUse">
                                <stop offset="0.911458" stop-color="#23231F" />
                                <stop offset="1" stop-color="#6A4D4D" stop-opacity="0" />
                            </linearGradient>
                        </defs>
                    </svg><span>SUBMIT</span>
                </button>
                <h3 class="signup-header">Have an account? <a href="{{ route('login') }}">Log In</a></h3>
        </div>
        </form>
    </div>
@endsection
