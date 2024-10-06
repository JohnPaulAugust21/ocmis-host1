@extends('layouts.header')
@section('title', 'OCMIS | Shop')

@section('content')
    <style>
        .center-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
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
        }

        .white-bg {
            background-color: #fff;
        }

        .row {
            display: flex;
            margin-left: 220px
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
    <section class="d-flex">
        <div class="shadow-xl" style="min-width:14rem;border-right: 2px solid #224256   ">
            <ul class="sidebar-nav">
                <li class="{{ request()->is('admin/services/category*') ? 'active' : '' }}">
                    <a href="{{ route('services') }}">Category
                    </a>
                </li>
                <li class="{{ request()->is('admin/services/priest*') ? 'active' : '' }}">
                    <a href="{{ route('priests') }}">Priest
                    </a>
                </li>
                <li class="{{ request()->is('admin/services/service*') ? 'active' : '' }}">
                    <a href="{{ route('serviceList') }}">Service Transactions
                    </a>
                </li>
                <li class="{{ request()->is('admin/services/sale*') ? 'active' : '' }}">
                    <a href="{{ route('serviceSales') }}">Sales
                    </a>
                </li>
            </ul>
        </div>
        <div class="  " style="height: 100vh;width:100%;top:20rem;max-height: 70svh;overflow-y: scroll ">
            <div style="padding: 3rem">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card custom-card">
                            <div class="card-body ">
                                <h4 class="card-title">Top Service</h4>
                                <canvas id="topServiceChart" class="custom-chart" style="height:10px"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card custom-card">
                            <div class="card-body">
                                <h4 class="card-title">Daily Sales</h4>
                                <canvas id="dailyServiceSales" class="custom-chart" style="height:230px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
