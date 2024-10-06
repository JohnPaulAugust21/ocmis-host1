@extends('layouts.clientnav')

@section('content')
    <header class="py-5 bg-dark-2">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">OCMIS Memorial</h1>
                <p class="lead fw-normal text-white-50 mb-0">Guiding You Through Moments of Remembrance</p>
            </div>
        </div>
    </header>

    <div class="container">

        <div class="container mt-5 mb-5">
            <div class="col-md-12 text-center mb-5">
                <h1>Memorials</h1>
                <a href="{{ route('createMemorial') }}" class="btn btn-primary p-2 w-25">Add Memorial</a>
            </div>
            <div class="row mt-1">

                @if ($memorials->isEmpty())
                    <div class="col-md-12 text-center">
                        <h2>No memorials available.</h2>
                    </div>
                @else
                    @auth
                        @foreach ($memorials as $memo)
                           @if ($memo->user_id == Auth::id())
                           <div class="col-md-3 mb-4 ">

                            <a href="{{ route('memorialView', ['id' => $memo->memorial_id]) }}"
                                class="text-reset text-decoration-none">
                                <div class="p-card bg-success h-100 px-2 pb-4 pt-2 rounded px-3">
                                    <div class="d-flex align-items-center credits">
                                    </div>
                                    <h5 class="mt-2 text-light">{{ $memo->deceasedname }}'s Memorial</h5>
                                    <span class="d-block mb-1 text-light">Date:
                                        {{ \Carbon\Carbon::parse($memo->date_time)->format('Y-m-d') }}</span>
                                    <span class="d-block mb-1 text-light">Start:
                                        {{ \Carbon\Carbon::parse($memo->date_time)->format('g:i A') }}</span>
                                </div>
                            </a>
                        </div>
                           @endif
                        @endforeach
                    @else
                    <div class="col-md-12 text-center">
                        <h2>No memorials available.</h2>
                    </div>
                    @endauth
                @endif


            </div>
        </div>
    </div>
@endsection
