@extends('layouts.clientnav')

@section('content')
<header class="py-5 bg-dark-2">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">OCMIS: Online Columbarium Management and Information System</h1>
            <p class="lead fw-normal text-white-50 mb-0">Guiding You Through Moments of Remembrance</p>
        </div>
    </div>
</header>

<section class="py-5">
    <swiper-container class="mySwiper" pagination="true" effect="coverflow" grab-cursor="true" centered-slides="true"
        slides-per-view="auto" coverflow-effect-rotate="50" coverflow-effect-stretch="0" coverflow-effect-depth="100"
        coverflow-effect-modifier="1" coverflow-effect-slide-shadows="true">



        <swiper-slide>
            <div class="swiper-slide d-flex justify-content-center align-items-center">
                <img src="/images/columbarium1.png" class="img-fluid fixed-size-img" alt="Building Image">
            </div>

        </swiper-slide>

        
        <swiper-slide>
            <div class="swiper-slide d-flex justify-content-center align-items-center">
                <img src="/images/columbarium2.png" class="img-fluid fixed-size-img" alt="Building Image">
            </div>

        </swiper-slide>
        
        <swiper-slide>
            <div class="swiper-slide d-flex justify-content-center align-items-center">
                <img src="/images/columbarium3.png" class="img-fluid fixed-size-img" alt="Building Image">
            </div>

        </swiper-slide>

        <swiper-slide>
            <div class="swiper-slide d-flex justify-content-center align-items-center">
                <img src="/images/columbarium1.png" class="img-fluid fixed-size-img" alt="Building Image">
            </div>

        </swiper-slide>

        
        <swiper-slide>
            <div class="swiper-slide d-flex justify-content-center align-items-center">
                <img src="/images/columbarium2.png" class="img-fluid fixed-size-img" alt="Building Image">
            </div>

        </swiper-slide>
        
        <swiper-slide>
            <div class="swiper-slide d-flex justify-content-center align-items-center">
                <img src="/images/columbarium3.png" class="img-fluid fixed-size-img" alt="Building Image">
            </div>

        </swiper-slide>



    </swiper-container>
</section>
@endsection
