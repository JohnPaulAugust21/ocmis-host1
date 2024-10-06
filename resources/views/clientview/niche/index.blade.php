@extends('layouts.clientnav')

@section('content')
<header class="py-5 bg-dark-2">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">OCMIS Niches</h1>
            <p class="lead fw-normal text-white-50 mb-0">Guiding You Through Moments of Remembrance</p>
        </div>
    </div>
</header>

<section class="py-5">
    <swiper-container class="mySwiper" pagination="true" effect="coverflow" grab-cursor="true" centered-slides="true"
        slides-per-view="auto" coverflow-effect-rotate="50" coverflow-effect-stretch="0" coverflow-effect-depth="100"
        coverflow-effect-modifier="1" coverflow-effect-slide-shadows="true">


        @foreach($buildings as $build )

        <swiper-slide>
            <a href="{{ route('buildingNo', ['id'=>$build->building_id]) }}" class="text-decoration-none text-dark">
                <div class="swiper-slide d-flex justify-content-center align-items-center">
                    <img src="/storage/{{$build->image}}" class="img-fluid fixed-size-img" alt="Building Image">

                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <h3> {{$build->name}} </h3>
                </div>
            </a>
        </swiper-slide>
        @endforeach


    </swiper-container>
</section>
@endsection