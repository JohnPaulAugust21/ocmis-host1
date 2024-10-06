@extends('layouts.header')

@section('content')
    <div class="container text-light" style="height: 100svh;margin-top: 5rem">
        <div class="d-grid p-2 col-11 col-sm-7 col-md-10 col-lg-4"
            style=" top: 50px;background: rgba(253, 247, 191, 0.17);margin: 0 auto">
            @if (session('success'))
                <div class="alert alert-success"
                    style="background-color: #dff0d8; border-color: #d0e9c6; color: #3c763d; padding: 10px;">
                    {{ session('status') }}
                </div>
            @endif

            @if (Session::has('expired'))
                <div>
                    <p class="fw-bold " style="font-size: 2rem">
                        Unsuccessful Verification
                    </p>
                    <p>
                        The link you're trying to access is invalid or has expired. Kindly recheck your email or re-enter
                        your email address in the <a href="{{ route('forgotPassword') }}">Forgot Password</a> page.</p>
                </div>
            @else
                <p class="fw-bold text-start" style="font-size: 2rem">Reset password?
                </p>

                <form method="POST" action="{{ route('change_password',['id'=> Request::segment(2)]) }}" class="d-grid p-3 gap-3">
                    @csrf
                    <div class="d-grid ">
                        <label style="font-size: 1rem">Password:</label>
                        <input type="password" id="username" name="password" style="  border-radius: 28px;
                        border: none;width: inherit" value="{{ old('password') }}">
                        @error('password')
                            <small class="text-start" style="color: rgb(255, 161, 161)">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-grid " >
                        <label style="font-size: 1rem">Confirm Password:</label>
                        <input type="password"  name="password_confirmation" style="  border-radius: 28px;
                        border: none;width: inherit"  value="{{ old('password_confirmation') }}">
                        @error('password_confirmation')
                        <small class="text-start" style="color: rgb(255, 161, 161)">{{ $message }}</small>
                    @enderror
                    </div>

                    <button style="background: #23231f;width: fit-content;margin:0 auto"
                        class="btn px-5 py-2 text-light text-center" type="submit">
                        <span>SUBMIT</span>
                    </button>

                </form>
            @endif


        </div>
        {{-- Check your email for a link to reset your password. If it doesn’t appear within a few minutes, check your spam folder. --}}
    @endsection
