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
            <div class="   " style="padding: 3rem">

                <div>
                    <div class="  bg-white" style="width: 100%;padding: 1rem;max-width: 100%;overflow-x: auto">
                        <div>
                            <h2 class="text-dark">SALES BY NICHE</h2>
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
                </div>

                <div class="mt-5">
                    <div class="  bg-white" style="width: 100%;padding: 1rem;max-width: 100%;overflow-x: auto">
                        <div>
                            <h2 class="text-dark">SALES BY SERVICE</h2>
                            <table id="myServicesTables" class="table  table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Deceased Name</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Priest</th>
                                        <th>Payment Status</th>
                                        <th>Status</th>

                                    </tr>

                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="  bg-white" style="width: 100%;padding: 1rem;max-width: 100%;overflow-x: auto">
                        <div>
                            <h2 class="text-dark">SALES BY SHOP</h2>
                            <table id="myShopTables" class="table  table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Receipt No</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Date</th>
                                        <th>Pending</th>

                                    </tr>

                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('jss')
    <script>
        $(document).ready(function() {
            function xdate() {
                var datex = new Date();

                const year = datex.getFullYear();
                const month = String(datex.getMonth() + 1).padStart(2,
                    '0'); // Months are zero-based
                const day = String(datex.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }
            var table = $("#myNichesTables").DataTable({
                "bFilter": false,
                "bLengthChange": false,
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'print',
                        title: `SALES BY NICHE <br>
                        DATE: ${xdate()}`,

                    }, {
                        extend: 'csv',
                        title: `SALES BY NICHE -
                        DATE: ${xdate()}`,

                    },
                    {
                        extend: 'excel',
                        title: `SALES BY NICHE -
                        DATE: ${xdate()}`,
                    }
                ],
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
                   if(json.length > 0)
                   {
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
                        paymenttype: '<strong>Total = <strong>',
                        downpayment: '',
                        data: null,
                        date: '',
                        status: `<strong>${totalDownpayment.toFixed(2)}</strong>`,



                    }).draw().node().classList.add('total-row');;
                   }
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


            var serviceTable = $("#myServicesTables").DataTable({
                "bFilter": false,
                "bLengthChange": false,
                buttons: [{
                        extend: 'print',
                        title: `SALES BY SERVICE <br>
                        DATE: ${xdate()}
                        `,

                    }, {
                        extend: 'csv',
                        title: `SALES BY SERVICE -
                        DATE: ${xdate()}
                        `,

                    },
                    {
                        extend: 'excel',
                        title: `SALES BY SERVICE -
                        DATE: ${xdate()}
                        `,

                    }
                ],
                ajax: {
                    url: "/admin/forecast/services/sales",
                    dataSrc: "",
                },
                "ordering": true, // Enable sorting
                "order": [
                    [0, "desc"]
                ], // Sort the first column in ascending order by default

                dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
                columns: [{
                        data: "id",

                    },
                    {
                        data: "name",
                        render: function(data, type, row) {

                            if (row?.category_info) {
                                return row?.category_info?.name;
                            } else {
                                return '';
                            }


                        },
                    },
                    {
                        data: "deceasedname",

                    },
                    {
                        data: "price",
                        render: function(data, type, row) {
                            if (row?.category_info) {
                                return row?.category_info?.price;
                            } else {
                                return '';
                            }


                        },
                    },
                    {
                        data: "date",
                        render: function(data, type, row) {

                            if (row?.schedule_info) {
                                return row?.schedule_info?.date
                            } else if (!!row.date) {
                                var date = new Date(row.date);

                                const year = date.getFullYear();
                                const month = String(date.getMonth() + 1).padStart(2,
                                    '0'); // Months are zero-based
                                const day = String(date.getDate()).padStart(2, '0');
                                return `${year}-${month}-${day}`;

                            } else {
                                return '';
                            }


                        },
                    },
                    {
                        data: "time",
                        render: function(data, type, row) {
                            // Parse the date-time string
                            if (row?.schedule_info) {
                                return row?.schedule_info?.start_time
                            } else if (!!row.date) {
                                var date = new Date(row.date);

                                const hours = String(date.getHours()).padStart(2, '0');
                                const minutes = String(date.getMinutes()).padStart(2, '0');
                                const seconds = String(date.getSeconds()).padStart(2, '0');
                                return `${hours}:${minutes}:${seconds}`;
                            } else {

                                return data;
                            }
                        },
                    },

                    {
                        data: "priest",
                        render: function(data, type, row) {
                            // Parse the date-time string
                            if (row?.priest_info) {
                                return row?.priest_info?.name
                            } else if (row.own_priest) {
                                return 'Own Priest'
                            } else {
                                return '';
                            }
                        },

                    },
                    {
                        data: "status",

                    },
                    {
                        data: 'mstatus',
                        render: function(data, type, row) {

                            var start = new Date(row.start);
                            var currentDate = new Date();

                            // Set the desired timezone offset (GMT+8)
                            var timezoneOffsetInMinutes = -480; // 8 hours * 60 minutes
                            currentDate.setMinutes(currentDate.getMinutes() -
                                timezoneOffsetInMinutes);

                            var durationInSeconds = Math.floor((start - currentDate) / 1000);

                            // Check if the start date is less than one day away and the status is not paid
                            var isLessThanOneDay = durationInSeconds < 24 * 60 *
                                60; // Less than 24 hours
                            var isNotPaid = row.status !== 'Paid';

                            // Set the value of status2 based on the conditions
                            var status2 = isLessThanOneDay && isNotPaid ? 'Denied' : 'Pending';

                            // If the status is 'Paid', set status2 to 'Approved'
                            if (row.status === 'Paid') {
                                status2 = 'Approved';
                                return status2;
                            }

                            if (row.status === 'Cancelled') {
                                status2 = 'Denied';
                                return status2;
                            }

                            if (row.status === 'Pending') {
                                status2 = 'Pending';
                                return status2;
                            }
                            return data;

                        },
                    },




                ],
                initComplete: function(settings, json) {
                  if(json.length > 0)
                  {
                    var total = 0;
                    json.forEach(element => {
                        total += parseFloat(element.category_info.price);
                    });

                    serviceTable.rows('.total-row').remove();
                    serviceTable.row.add({
                        id: '',
                        price: '',
                        deceasedname: '',
                        category: '',
                        date: '',
                        time: '',
                        priest: '',
                        mstatus: `<strong>${total.toFixed(2)}</strong>`,

                        status: '<strong>Total = <strong>',



                    }).draw().node().classList.add('total-row');;
                  }
                }

            });

            var shopTable = $("#myShopTables").DataTable({
                "bFilter": false,
                "bLengthChange": false,
                buttons: [{
                        extend: 'print',
                        title: `SALES BY SHOP <br>
                        DATE: ${xdate()}
                        `,

                    }, {
                        extend: 'csv',
                        title: `SALES BY SHOP -
                        DATE: ${xdate()}
                        `,

                    },
                    {
                        extend: 'excel',
                        title: `SALES BY SHOP -
                        DATE: ${xdate()}
                        `,

                    }
                ],

                ajax: {
                    url: "/admin/forecast/shop/sales",
                    dataSrc: "",
                },
                "ordering": true, // Enable sorting
                "order": [
                    [0, "desc"]
                ],
                dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
                columns: [{
                        data: "orderline_id",

                    },
                    {
                        data: "receipt_number",

                    },
                    {
                        data: "name",

                    },
                    {
                        data: "price",

                    },
                    {
                        data: "qty",

                    },
                    {
                        data: "created_at",

                    },
                    {
                        data: "status",

                    },

                ],
                initComplete: function(settings, json) {
                    if(json.length > 0)
                    {
                        var total = 0;
                    json.forEach(element => {

                        total += parseFloat(element.price);
                    });

                    shopTable.rows('.total-row').remove();
                    shopTable.row.add({
                        orderline_id:'',
                        receipt_number:'',
                        name:'',
                        price:'',
                        qty:'',
                        status: `<strong>${total.toFixed(2)}</strong>`,

                        created_at: '<strong>Total = <strong>',



                    }).draw().node().classList.add('total-row');;
                    }
                }
            });

        })
    </script>
@endpush
