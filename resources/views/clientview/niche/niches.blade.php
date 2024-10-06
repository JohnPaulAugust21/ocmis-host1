@extends('layouts.clientnav')

@section('content')
    <header class="py-5 bg-dark-2">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Ocmis Niches</h1>
                <p class="lead fw-normal text-white-50 mb-0">Guiding You Through Moments of Remembrance</p>
            </div>
        </div>
    </header>

    <div class="container">

        <div class="container mt-5 mb-5">
            <div class="col-md-12 text-center mb-5">
                <h1>{{ $building->name }}</h1>
                <div class="legend mt-3">
                    <span class="badge bg-success">Available</span>
                    <span class="badge bg-secondary">Pending</span>
                    <span class="badge bg-danger">Occupied</span>
                </div>
            </div>
            <div class="row mt-1">
                @if ($niches->isEmpty())
                    <div class="col-md-12 text-center">
                        <h2>No niches available.</h2>
                    </div>
                @else
                    @foreach ($niches as $niche)
                        <div class="col-md-3 mb-4">
                            @if ($niche->status === 'Available')
                                <a href="{{ route('nicheNo', ['id' => $niche->niche_id]) }}"
                                    class="text-reset text-decoration-none">
                                    <div class="p-card bg-success h-100 p-2 rounded px-3">
                                        <div class="d-flex align-items-center credits"><img
                                                src="/storage/{{ $niche->image }}" width="70px">
                                        </div>
                                        <h5 class="mt-2 text-light">Level {{ $niche->level }}-{{ $niche->niche_number }}
                                        </h5>
                                        <span class="d-block mb-5 text-light">Urn capacity: {{ $niche->capacity }}</span>

                                    </div>
                                </a>
                            @elseif ($niche->status === 'Pending')
                                <div class="p-card bg-secondary h-100 p-2 rounded px-3">
                                    <div class="d-flex align-items-center credits"><img src="/storage/{{ $niche->image }}"
                                            width="70px">
                                    </div>
                                    <h5 class="mt-2 text-light">Level {{ $niche->level }}-{{ $niche->niche_number }}</h5>
                                    <span class="d-block mb-5 text-light">Urn capacity: {{ $niche->capacity }}</span>

                                </div>
                            @else

                                <a href="{{ route('nicheView',['id' => $niche->niche_id]) }}" class="text-reset  position-relative text-decoration-none" style="position: relative">


                                    <div class="p-card bg-danger h-100 p-2 rounded px-3 position-relative">
                                        @if (Auth::check() && Auth::id() == $niche->user_id)
                                        <span class="badge bg-secondary" style="position: absolute;top:4px;right:4px ">Owned</span>
                                        @endif

                                        <div class="d-flex align-items-center credits"><img src="/storage/{{ $niche->image }}"
                                                width="70px">
                                        </div>
                                        <h5 class="mt-2 text-light">Level
                                            {{ $niche->level }}-{{ $niche->niche_number }}</h5>
                                        <span class="d-block mb-5 text-light">Urn capacity: {{ $niche->capacity }}</span>

                                    </div>
                                </a>

                                {{-- <div class="p-card bg-danger h-100 p-2 rounded px-3">
                                    <div class="d-flex align-items-center credits"><img src="/storage/{{ $niche->image }}"
                                            width="70px">
                                    </div>
                                    <h5 class="mt-2 text-light">Level
                                        {{ $niche->level }}-{{ $niche->niche_number }}</h5>
                                    <span class="d-block mb-5 text-light">Urn capacity: {{ $niche->capacity }}</span>

                                </div>
                                @endif --}}
                            @endif

                        </div>
                    @endforeach
                @endif


            </div>
        </div>
    </div>
@endsection
