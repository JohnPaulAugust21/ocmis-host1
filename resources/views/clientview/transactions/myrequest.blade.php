@extends('layouts.clientnav')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <section class="py-5">
                <div class="container mt-5">
                    <div class="card" style="min-height: 650px">
                        <div class="card-header bg-warning text-white">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active fs-5 fw-bold  text-dark" id="tab1" data-bs-toggle="tab"
                                        href="#content1">My Service Requests</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fs-5 fw-bold  text-dark" id="tab2" data-bs-toggle="tab"
                                        href="#content2">My Products Purchases</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fs-5 fw-bold  text-dark" id="tab3" data-bs-toggle="tab"
                                        href="#content3">My Niches</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fs-5 fw-bold  text-dark" id="tab4" data-bs-toggle="tab"
                                        href="#content4">My Memorial</a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane fade show active" id="content1">
                                    <div>
                                        <table id="myRequestTable" class="table table-layout table-striped"
                                            style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Category</th>
                                                    <th>Deceased Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Priest</th>
                                                    <th>Payment Status</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Your table content for Tab 1 goes here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content">

                                <div class="tab-pane fade show" id="content2">
                                    <div>
                                        <table id="shopTransactionTablePurchases" class="table table-layout table-striped"
                                            style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Receipt No</th>
                                                    <th>Product Name</th>
                                                    <th>Qty</th>
                                                    <th>Date</th>
                                                    <th>Pending</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-content">

                                <div class="tab-pane fade show" id="content3">
                                    <div>
                                        <table id="myNichesTable" class="table table-layout table-striped"
                                            style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Receipt No</th>
                                                    <th>Niche No.</th>
                                                    <th>Building</th>
                                                    <th>Price</th>
                                                    <th>Payment Type</th>
                                                    <th>Downpayment</th>
                                                    <th>Installment</th>
                                                    <th>Due</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>


                            <div class="tab-content">

                                <div class="tab-pane fade show" id="content4">
                                    <div>
                                        <table id="myMemorialsTable" class="table table-layout table-striped"
                                            style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Deceased Name</th>
                                                    <th>Message</th>
                                                    <th>Price</th>
                                                    <th>Payment Mode</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
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
            </section>
        </div>

        <div class="modal fade" id="editUrnModal" tabindex="-1" role="dialog" aria-labelledby="editUrnModallabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUrnModalLabel">Add Deceased Information</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form id="myUrnForm" action="#" method="#" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="urn_id" id="urn_id">
                            <div class="form-group">
                                <label for="deceasedName">Deceased Name:</label>
                                <input type="text" class="form-control" id="deceasedName" name="deceasedName"
                                    placeholder="Enter Deceased Name">
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Enter Message"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image:</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="btnMyUrnUpdate" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <script>
        $(document).ready(function() {
            // Retrieve last active tab from local storage
            var lastActiveTab = localStorage.getItem('lastActiveTab');

            // Show the last active tab
            if (lastActiveTab) {
                $('.nav-tabs a[href="#' + lastActiveTab + '"]').tab('show');
            }

            // Store the active tab on tab change
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                var targetTab = $(e.target).attr('href').substr(1);
                localStorage.setItem('lastActiveTab', targetTab);
            });


            //MyRequests

            $("#myRequestTable").DataTable({


                ajax: {
                    url: "/me/transactions/myRequestList",
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

                            return row?.category_info?.name;


                        },
                    },
                    {
                        data: "deceasedname",

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
                    // {
                    //     data: null,
                    //     render: function (data, type, row) {
                    //         // Parse the date-time strings
                    //         var start = new Date(row.start);
                    //         var end = new Date(row.end);

                    //         // Calculate the duration between start and end
                    //         var durationInSeconds = Math.floor((end - start) / 1000);

                    //         // Format the duration as "3:00 hrs"
                    //         var hours = Math.floor(durationInSeconds / 3600);
                    //         var minutes = Math.floor((durationInSeconds % 3600) / 60);

                    //         var formattedDuration = hours + ":" + (minutes < 10 ? '0' : '') + minutes + " hrs";

                    //         // Return the formatted duration
                    //         return formattedDuration;
                    //     },
                    // },
                    {
                        data: "priest",
                        render: function(data, type, row) {
                            // Parse the date-time string
                            if (row?.priest_info) {
                                return row?.priest_info?.name
                            } else {
                                return 'Own Priest'
                            }
                        },

                    },
                    {
                        data: "status",

                    },
                    {
                        data: 'xx',
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
                            }

                            if (row.status === 'Cancelled') {
                                status2 = 'Denied';
                            }

                            return status2;


                        },
                    },
                    {
                        data: 'action',
                        render: function(data, type, row) {


                            return `<a href='${'/me/transactions/myRequests/'+row.id+'/cancel'}' class='text-danger' id='cuseditbtn' data-id=" +
                                data +
                                ">Cancel</a>`;


                        },
                    },




                ],
            });

            $("#shopTransactionTablePurchases").DataTable({


                ajax: {
                    url: "/me/transactions/myPurchases",
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
                        data: "qty",

                    },
                    {
                        data: "created_at",

                    },
                    {
                        data: "status",

                    },{
                        data: 'action',
                        render: function(data, type, row) {


                            return `<a href='${'/me/transactions/myPurchases/'+row.orderline_id+'/cancel'}' class='text-danger' id='cuseditbtn' data-id=" +
                                data +
                                ">Cancel</a>`;


                        },
                    },

                ],
            });

            $("#myNichesTable").DataTable({


                ajax: {
                    url: "/me/transactions/myNiches",
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
                        data: "paymenttype",

                    },

                    {
                        "data": null,
                        "render": function(data, type, row) {
                            if (row.paymenttype === 'installment') {
                                return row.downpayment;
                            } else {
                                return 'N/A';
                            }
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            if (row.paymenttype === 'installment') {
                                return row.monthly;
                            } else {
                                return 'N/A';
                            }
                        }
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
                                return 'N/A';
                            }
                        }
                    },

                    {
                        data: "status",

                    },{
                        data: 'action',
                        render: function(data, type, row) {


                            return `<a href='${'/me/transactions/myNiches/'+row.niche_id+'/cancel'}' class='text-danger' id='cuseditbtn' data-id=" +
                                data +
                                ">Cancel</a>`;


                        },
                    },


                ],
            });

            $("#myMemorialsTable").DataTable({
                ajax: {
                    url: "/me/transactions/myMemorials",
                    dataSrc: "",
                },
                "ordering": true, // Enable sorting
                "order": [
                    [0, "desc"]
                ],
                dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
                columns: [{
                        data: "memorial_id",

                    },
                    {
                        data: "deceasedname",

                    },
                    {
                        data: "message",

                    },

                    {
                        data: "price",

                    },
                    {
                        data: "payment_mode",

                    },
                    {
                        data: "status",

                    },{
                        data: 'action',
                        render: function(data, type, row) {


                            return `<a href='${'/me/transactions/myMemorials/'+row.memorial_id+'/cancel'}' class='text-danger' id='cuseditbtn' data-id=" +
                                data +
                                ">Cancel</a>`;
                        },
                    },
                ],
            });


        });
    </script>
@endsection
