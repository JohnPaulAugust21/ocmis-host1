@extends('layouts.header')

@section('title', 'OCMIS | Shop')
@section('dt')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>
@endsection
<style>
    @media print {
        #myNichesTables tfoot {
            display: table-row-group;
        }
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
@section('content')
    <div class="d-flex ">
        <div class="shadow-xl" style="min-width:14rem;border-right: 2px solid #224256   ">
            <ul class="sidebar-nav">
                <li class="{{ request()->is('admin/forecast') ? 'active' : '' }}">
                    <a href="{{ route('forecast') }}">Forecast
                    </a>
                </li>

                <li class="{{ request()->is('admin/forecast/sale') ? 'active' : '' }}">
                    <a href="{{ route('forecastSale') }}">Sales
                    </a>
                </li>
            </ul>
        </div>
        <div class="  " style="height: 100vh;width:100%;top:20rem;max-height: 70svh;overflow-y: scroll ">
            <div class="  " style="padding: 3rem">

                <div class="mb-4   row gap-1   justify-content-evenly">
                    @forelse ($buildings as $building)
                    <a href="{{ route('forecastBuilding',['id' => $building->building_id]) }}" class="text-reset text-decoration-none  col-3" >
                        <div class=" bg-success h-100 p-5 rounded ">

                            <h5 class="mt-2 text-light ">{{ $building->name }}
                            </h5>

                        </div>
                    </a>

                    @empty
                    @endforelse
                </div>
            </div>
        </div>

    </div>
@endsection
