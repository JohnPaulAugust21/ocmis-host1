@extends('layouts.clientnav')

@section('content')
<div class="container-fluid mb-5 mt-5" style="height: 100%">
    <div class="row h-100">
        <div class="col-lg-8 h-100">
            <div class="card h-100">
                <div class="card-body">
                    <img src="/images/candles.jpg" class="img-fluid" alt="Building Image"
                        style="height: 300px; width: 100%;">
                    <h3 class="card-title text-center">{{$memorial->deceasedname}}'s Memorial</h3>
                    <p class="card-text">
                        Welcome to {{$memorial->deceasedname}}'s memorial. This space is dedicated to the memory of
                        {{$memorial->deceasedname}}.
                        Share your thoughts, memories, and condolences with family and friends.
                    </p>

                    <p class="card-text">
                        Date of Event: {{ \Carbon\Carbon::parse($memorial->date_time)->format('Y-m-d') }}
                        <br>
                        Time: {{ \Carbon\Carbon::parse($memorial->date_time)->format('g:i A') }}

                    </p>

                    {{-- <p class="card-text">
                        Location: {{$memorial->location}}
                    </p> --}}

                    <p class="card-text">
                        Event Details: Join us in commemorating {{$memorial->deceasedname}}. Feel free to leave
                        messages, photos, and share your favorite memories.
                        We will also be hosting a Zoom meeting to connect virtually. The meeting details are as follows:
                    </p>

                    <p class="card-text">
                        Zoom Meeting:
                        @if(strtotime($memorial->date_time) > now()->timestamp)
                            <span>Meeting Has Not Started Yet</span>
                        @elseif(strtotime($memorial->date_time) < strtotime('-40 minutes', now()->timestamp))
                            <span>Zoom Meeting Ended</span>
                        @else
                            <a href="{{$memorial->link}}" target="_blank">Join Zoom Meeting</a>
                        @endif
                        <br>
                        Pass: {{ $memorial->password }}
                    </p>

                    <p class="card-text">
                        Please join us to celebrate the life of {{$memorial->deceasedname}} and share in the love and
                        support of friends and family.
                    </p>

                    <p class="card-text">
                        <strong>Note:</strong> The memorial Zoom link is valid for 40 minutes and expires thereafter.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 h-100">
            <div class="row h-50 mb-2">
                <div class="col-sm-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Photos</h5>
                            <div class="p-1" style="height: 100%">
                                <swiper-container class="mySwiper" pagination="true" effect="coverflow"
                                    grab-cursor="true" centered-slides="true" slides-per-view="auto"
                                    coverflow-effect-rotate="50" coverflow-effect-stretch="0"
                                    coverflow-effect-depth="100" coverflow-effect-modifier="1"
                                    coverflow-effect-slide-shadows="true">

                                    @foreach ($images as $img )
                                    <swiper-slide>
                                        <div class="swiper-slide d-flex justify-content-center align-items-center">
                                            <img src="/storage/{{$img->image}}" class="img-fluid" alt="Building Image"
                                                style="height: 200px; width: 250px;">

                                        </div>

                                    </swiper-slide>
                                    @endforeach




                                </swiper-container>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="row h-50">
                <div class="col-sm-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <!-- Content for the third card -->
                            <h5 class="card-title">Message from Event Organizer</h5>


                            <p class="card-text">
                                Dear friends and family,
                            </p>

                            <p class="card-text">
                                On behalf of the event organizer, we would like to express our gratitude for joining us
                                in celebrating {{$memorial->deceasedname}}'s life.
                                Your presence and support mean a lot to us and to the family during this time of
                                remembrance.
                            </p>

                            <p class="card-text">
                                If you have any questions or need assistance during the event, feel free to contact the
                                organizer.
                                We hope you find comfort and solace in the shared memories and stories that will be
                                cherished during this memorial.
                            </p>
                            <p class="card-text">P.S {{$memorial->message}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
