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
                <li class="{{ request()->is('admin/niches/building*') ? 'active' : '' }}">
                    <a href="{{ route('buildings') }}">Buildings
                    </a>
                </li>
                <li class="{{ request()->is('admin/niches/index*') ? 'active' : '' }}">
                    <a href="{{ route('niches') }}">Niches
                    </a>
                </li>
                <li class="{{ request()->is('admin/niches/urn*') ? 'active' : '' }}">
                    <a href="{{ route('urns') }}">Urn
                    </a>
                </li>
                <li class="{{ request()->is('admin/niches/sale*') ? 'active' : '' }}">
                    <a href="{{ route('nichesSales') }}">Sales
                    </a>
                </li>
            </ul>
        </div>
        <div class="  " style="height: 100vh;width:100%;top:20rem;max-height: 70svh;overflow-y: scroll ">
            <div class="   " style="padding: 3rem">
                <div class="d-flex justify-content-center">
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card custom-card">
                            <div class="card-body">
                                <h4 class="card-title">Niche Status</h4>
                                <canvas id="nicheStatus" class="custom-chart" style="height:10px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div>
                    <div class="  bg-white" style="width: 100%;padding: 1rem;max-width: 100%;overflow-x: auto">
                        <div>

                            <table id="myNichesTables" class="table  table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Receipt No</th>
                                        <th>Niche No.</th>
                                        <th>Building</th>
                                        <th>Price</th>
                                        <th>Due</th>
                                        <th>Downpayment</th>
                                        <th>Installment</th>

                                        <th>Payment Type</th>
                                        <th>Status</th>
                                    </tr>

                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>

    </div>
@endsection
@push('jss')
    <script>
        $(document).ready(function() {
            var table = $("#myNichesTables").DataTable({
                "bFilter": false,
                "bLengthChange": false,
                layout: {
                    topStart: {
                        buttons: [{
                                extend: 'copyHtml5',
                                footer: true
                            },
                            {
                                extend: 'excelHtml5',
                                footer: true
                            },
                            {
                                extend: 'csvHtml5',
                                footer: true
                            },
                            {
                                extend: 'pdfHtml5',
                                footer: true
                            }
                        ]
                    }
                },
                // orderCellsTop: true,
                // fixedHeader: true,

                ajax: {
                    url: "/admin/transactions/adminNiches",
                    dataSrc: "",
                },

                "ordering": true, // Enable sorting
                "order": [
                    [0, "desc"]
                ],
                dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
                columns: [{
                        data: "niche_id",

                    },
                    {
                        data: "receipt_id",

                    },
                    {
                        data: "niche_number",

                    },

                    {
                        data: "name",

                    },
                    {
                        data: "price",

                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            if (row.paymenttype === 'installment') {
                                var currentDate = new Date(row.date);
                                currentDate.setMonth(currentDate.getMonth() + 3);
                                var formattedDate = currentDate.toISOString().split('T')[0];
                                return formattedDate;
                            } else {
                                return '';
                            }
                        }
                    },

                    {
                        data: 'downpayment',
                        render: function(data, type, row) {
                            if (row.paymenttype === 'installment') {
                                return row.downpayment;
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            if (row.paymenttype === 'installment') {
                                return row.monthly;
                            } else {
                                return '';
                            }
                        }
                    },

                    {
                        data: "paymenttype",

                    },
                    {
                        data: "status",

                    },


                ],
                initComplete: function(settings, json) {
                    // Calculate and add total row
                    var totalDownpayment = table
                        .column(6, {
                            search: 'applied'
                        })
                        .data()
                        .reduce(function(a, b) {

                            if (b !== null && b !== undefined) {
                                return parseFloat(a) + parseFloat(b);
                            } else {
                                return a; // Return 'a' without adding if downpayment is null or undefined
                            }

                        }, 0);
                    console.log(totalDownpayment)
                    //
                    table.rows('.total-row').remove();
                    table.row.add({
                        niche_id: '',
                        receipt_id: '',
                        niche_number: '',
                        name: '',
                        price: '',
                        paymenttype: '<strong>Total<strong>',
                        downpayment: totalDownpayment.toFixed(2),
                        data: null,
                        date: '',
                        status: `<strong>${totalDownpayment.toFixed(2)}</strong>`,



                    }).draw().node().classList.add('total-row');;
                }
                // footerCallback: function(row, data, start, end, display) {
                //     var api = this.api(),
                //         data;

                //     // Total Downpayment
                //     var totalDownpayment = api
                //         .column(6, {
                //             search: 'applied'
                //         }) // Change the column index to 6 for the "Downpayment" column
                //         .data()
                //         .reduce(function(a, b) {
                //             return parseFloat(a) + parseFloat(b.downpayment);

                //         }, 0);

                //     $('#totalNiche').html(totalDownpayment.toFixed(2));
                // }
            });




        })
    </script>
@endpush
