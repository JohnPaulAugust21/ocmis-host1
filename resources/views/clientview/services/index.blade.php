@extends('layouts.clientnav')

@section('content')
    <header class="py-5 bg-dark-2">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">OCMIS Services</h1>
                <p class="lead fw-normal text-white-50 mb-0">Guiding You Through Moments of Remembrance</p>
            </div>
        </div>
    </header>

    <section class="py-5">


        <div class="container px-4 px-lg-5 mt-1">
            <div id="services" class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($services->chunk(8) as $itemChunk)
                    @foreach ($itemChunk as $item)
                        <a href="{{ route('servicePayment', ['id' => $item->service_id]) }}"
                            class="text-decoration-none text-dark">
                            <div class="col mb-5">
                                <div class="card card-1">
                                    <img class="card-img-top img-fluid w-100 h-50"
                                        src="{{ asset('/storage/' . $item->image) }}" alt="Product Image" />
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <h5 class="fw-bolder">{{ $item->name }}</h5>
                                            <h6 class="fw-bold">₱{{ $item->price }}</h5>
                                        </div>
                                    </div>

                                    <!-- Product actions -->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center">
                                            {{-- <a class="btn btn-outline-dark mt-auto" --}} {{--
                                    href="{{ route('item.addToCart', ['id'=>$item->id]) }}">Add To Cart</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endforeach

            </div>
        </div>
    </section>
@endsection
