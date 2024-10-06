@extends('layouts.header')
@section('title', 'OCMIS | Shop')

<style>
    .center-container {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .transparent-box {
        /* Add any additional styling you want for the transparent box */
        background-color: #fff;
        padding: 20px;
    }

    .custom-card {
        background-color: #fff;
        padding: 20px;
        border-radius: 20px;
        width: 600px;
        height: 500px;
        margin-left: 100px;
        margin-right: 100px;

    }

    .white-bg {
        background-color: #fff;
    }

    .row {
        display: flex;
    }

    .col-lg-6 {
        flex: 0 0 50%;
    }

    .custom-card {
        margin: 0 20px 20px 0;
    }
    .custom-chart {
            height: 80% !important;
    }
</style>
@section('content')
    <div class="d-flex ">
        <div class="shadow-xl" style="min-width:14rem;border-right: 2px solid #224256   ">
            <ul class="sidebar-nav">
                <li class="{{ request()->is('admin/forecast*') ? 'active' : '' }}">
                    <a href="{{ route('forecast') }}">Forecast
                    </a>
                </li>

                <li class="{{ request()->is('admin/forecast/sale*') ? 'active' : '' }}">
                    <a href="{{ route('forecastSale') }}">Sales
                    </a>
                </li>
            </ul>
        </div>
        <div class="  " style="height: 100vh;width:100%;top:20rem;max-height: 70svh;overflow-y: scroll ">
            <div class="  " style="padding: 3rem">

                <div class="row">
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card custom-card" style="width: 80vw;">
                            <div class="card-body">
                                <h1 class="card-title">Projected Sales</h1>
                                <canvas id="forecasting" class="custom-chart" style="height:10px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

{{-- <div class="center-container" style="height: 100vh;">


</div> --}}

@push('jss')
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
