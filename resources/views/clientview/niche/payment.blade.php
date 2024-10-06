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
    <div class="row gx-4 gx-lg-5 row-cols-1 justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                        <div class="card mb-3 text-center d-flex justify-content-center align-items-center">
                            <img id="serviceImg" src="/storage/{{$niche->image}}" class="card-img-top h-25 w-25" alt="Image Alt Text">
                        </div>

                        <div class="card mb-3 text-center d-flex justify-content-center align-items-center">
                            <h2 id="nicheLevel">Level {{$niche->level}}-{{$niche->niche_number}}</h2>
                        </div>

                        <div class="card mb-3 text-center d-flex justify-content-center align-items-center">
                            <h2 id="nichePriceLabel" value="{{$niche->price}}">₱{{$niche->price}}</h2>
                        </div>
                        <input type="hidden" id="niche_id" name="niche_id" value="{{$niche->niche_id}}">
                        <input type="hidden" id="niche_capacity" name="niche_capacity" value="{{$niche->capacity}}">

                        <input type="hidden" id="nichePrice" name="nichePrice" value="{{$niche->price}}">

                        <div class="mb-3">
                            <label class="form-label">PAYMENT TYPE</label>
                            <div class="form-check">
                                <input type="radio" id="fullPayment" name="paymenttype" value="fullpayment"
                                    class="form-check-input" checked>
                                <label for="fullPayment" class="form-check-label">Full</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="installment" name="paymenttype" value="installment"
                                    class="form-check-input">
                                <label for="installment" class="form-check-label">Installment</label>
                            </div>
                        </div>

                        <div id="additionalValues" class="mb-3">
                        </div>
                        @guest
                        <a href="{{ route('login') }}" class="btn btn-primary w-100">Login First</a>
                        @else
                        <button id="proceedButton" class="btn btn-primary w-100">Proceed</button>
                        @endguest
                </div>
            </div>
        </div>

            <div class="col-12 " style="padding: 3rem">

                <div class="">
                    <div class=" grid-margin stretch-card">
                        <div class="card custom-card" style="width: 90vw;">
                            <div class="card-body">
                                <h1 class="card-title">Forecast</h1>
                                <canvas id="forecasting" class="custom-chart" style="height:10px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>

</section>
@endsection

@push('js')
    <script>
        $(document).ready(function()
        {
               //Forecasting
    $.ajax({
        type: "GET",
        url: "/api/charts/forecasting",
        dataType: "json",
        success: function (data) {
            console.log(data);
            var ctx = $("#forecasting");
            const chartAreaBorder = {
                id: 'chartAreaBorder',
                beforeDraw(chart, args, options) {
                    const {
                        ctx,
                        chartArea: {
                            left,
                            top,
                            width,
                            height
                        }
                    } = chart;
                    ctx.save();
                    ctx.strokeStyle = options.borderColor;
                    ctx.lineWidth = options.borderWidth;
                    ctx.setLineDash(options.borderDash || []);
                    ctx.lineDashOffset = options.borderDashOffset;
                    ctx.strokeRect(left, top, width, height);
                    ctx.restore();
                }
            };
            var myBarChart = new Chart(ctx, {
                type: 'line',
                data: {

                    labels: @js($labels),
                    datasets: [{
                        label: 'Projected Sale',
                        data: @js($datas),
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgb(255,0,0)',
                            'rgb(255,0,255)',
                            'rgb(255,165,0)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        chartAreaBorder: {
                            borderColor: 'blue',
                            borderWidth: 3,
                            borderDash: [0, 0],
                            borderDashOffset: 2,
                        }
                    }
                },
                plugins: [chartAreaBorder]
            });
        },
        error: function (error) {
            console.log(error);
        }
    });
    //End forecasting
        })
    </script>
@endpush
