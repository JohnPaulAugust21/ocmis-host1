@extends('layouts.header')
@section('title', 'OCMIS | Shop')

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
</style>
@section('content')

<section class="d-flex">
    <div class="shadow-xl" style="min-width:14rem;border-right: 2px solid #224256   ">
        <ul class="sidebar-nav">
            <li class="{{ request()->is('admin/shop/transaction*') ? 'active' : '' }}">
                <a href="{{ route('shopTransactionView') }}">Transaction
                </a>
            </li>
            <li class="{{ request()->is('admin/shop/categor*') ? 'active' : '' }}">
                <a href="{{ route('shopCategories') }}">Category
                </a>
            </li>
            <li class="{{ request()->is('admin/shop/sellers*') ? 'active' : '' }}">
                <a href="{{ route('sellers') }}">Seller
                </a>
            </li>
            <li class="{{ request()->is('admin/shop/product*') ? 'active' : '' }}">
                <a href="{{ route('products') }}">Products
                </a>
            </li>
            <li class="{{ request()->is('admin/shop/sales*') ? 'active' : '' }}">
                <a href="{{ route('shopSales') }}">Sales
                </a>
            </li>
        </ul>
    </div>
    <div class="  " style="height: 100vh;width:100%;top:20rem;max-height: 70svh;overflow-y: scroll ">
        <div style="padding: 3rem">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <div class="col-lg-6 grid-margin stretch-card ">
                    <div class="card custom-card">
                        <div class="card-body">
                            <h4 class="card-title">Daily Sales</h4>
                            <canvas id="lineChart" style="height:250px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card custom-card">
                        <div class="card-body">
                            <h4 class="card-title">Top Product</h4>
                            <canvas id="topChart" style="height:230px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
@endsection
