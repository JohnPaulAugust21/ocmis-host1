@extends('layouts.clientnav')

@section('content')
<header class="py-5 bg-dark-2">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Ocmis Services</h1>
            <p class="lead fw-normal text-white-50 mb-0">Guiding You Through Moments of Remembrance</p>
        </div>
    </div>
</header>

<section class="py-5">

    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 400px; height: 400px">
            <div class="card-header bg-success text-white text-center">
                <h5 class="card-title mb-0">Service Requested</h5>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <p class="card-text lead text-center">Check Status Later</p>

            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <p class="card-text ">Check <a href={{route('myRequests')}}>MyRequests</a></p>
            </div>
        </div>
    </div>


</section>
@endsection