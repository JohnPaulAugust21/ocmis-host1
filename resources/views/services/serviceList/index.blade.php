@extends('layouts.header')
@section('title', 'OCMIS | Services')
<div class="sidebar">
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
<div class="container" style="margin-left: 120px;">

    <h1>Service List</h1>



    <div class="container" style="margin-left: 100px;">
        @if (session('success'))
            <div class="alert alert-success"
                style="background-color: #dff0d8; border-color: #d0e9c6; color: #3c763d; padding: 10px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger"
                style="background-color: #f2dede; border-color: #ebccd1; color: #a94442; padding: 10px; margin-bottom: 20px">
                {{ session('error') }}
            </div>
        @endif
        {{-- <div class="svg-container" style="margin-left: 1028px; margin-bottom: 20px">
            <a href="{{route('createServiceList')}}" class="svg-link">
                <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512">
                    <path
                        d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344V280H168c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H280v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                </svg>
                <span>Add Service</span>
            </a>
        </div> --}}

        <table id="serviceListTable" class="table table-layout">
            <thead>
                <tr>
                    {{-- <th>ID</th> --}}
                    <th>Category</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Time</th>
                    {{-- <th>Duration</th> --}}
                    <th>Payment Status</th>
                    <th>Status</th>
                    <th>Receipt</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

@push('jss')
    <script>
        $(document).ready(function() {
            //Service List

            $("#serviceListTable").DataTable({


                ajax: {
                    url: "/api/all-serviceList",
                    dataSrc: "",
                },
                "ordering": true, // Enable sorting
                "order": [
                    [0, "desc"]
                ], // Sort the first column in ascending order by default

                dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
                columns: [
                // {
                //         data: "id",

                //     },
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
                        data: 'user',
                        render: function(data, type, row) {
                            console.log('s:')
                            console.log(row)
                            var fullName = row.user_info?.firstname + ' ' + row.user_info?.lastname;
                            return fullName;
                        }
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

                                return '';
                            }
                        },
                    },
                    // {
                    //     data: null,
                    //     render: function(data, type, row) {
                    //         // Parse the date-time strings
                    //         var start = new Date(row.start);
                    //         var end = new Date(row.end);

                    //         // Calculate the duration between start and end
                    //         var durationInSeconds = Math.floor((end - start) / 1000);

                    //         // Format the duration as "3:00 hrs"
                    //         var hours = Math.floor(durationInSeconds / 3600);
                    //         var minutes = Math.floor((durationInSeconds % 3600) / 60);

                    //         var formattedDuration = hours + ":" + (minutes < 10 ? '0' : '') +
                    //             minutes + " hrs";

                    //         // Return the formatted duration
                    //         return formattedDuration;
                    //     },
                    // },
                    {
                        data: "status",

                    },
                    {
                        data: null,
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
            data: null,
            class: "preview-ref-lg",
            render: function (data, type, JsonResultRow, row) {
                    
                    var showReciept = "<a href='#' class='showRecieptbtn' data-id=" + data.id +
                        "><strong><u>Show Receipt</u></strong></a>";

                            // Combine both buttons
                            if (data.payment_mode === 'CASH'){
                                return"CASH";
                            }
                            else{
                                return showReciept;
                            }
                            
            }
        },
                    {
                        data: null,
                        render: function(data, type, row) {
                            // Your existing logic to determine status2
                            var start = new Date(row.start);
                            var currentDate = new Date();

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

                            // Conditionally render the edit button based on the status2 condition
                            var editBtnHtml = status2 !== 'Denied' ?
                                "<a href='#' class='editBtn' id='cuseditbtn' data-id=" + data.id +
                                "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a>" :
                                "";

                            // Common part for the delete button
                            var deleteBtnHtml = "<a href='#' class='deletebtn' data-id=" + data.id +
                                "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></i></a>";

                            // Combine both buttons
                            return editBtnHtml;
                        },
                    },



                ],
            });

            $("#serviceListTable tbody").on("click", 'a.editBtn', function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                var editUrl = "/admin/services/servicelist-edit/:id".replace(':id', id);
                window.location.href = editUrl;
            });

            $("#serviceListTable tbody").on("click", 'a.deletebtn', function(e) {



                var table = $('#serviceListTable').DataTable();
                var id = $(this).data("id");
                var $row = $(this).closest("tr");
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "/api/delete-serviceList/" + id,
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                    "content"
                                ),
                            },
                            dataType: "json",
                            success: function(data) {

                                $row.fadeOut(4000, function() {
                                    table.row($row).remove().draw(false);
                                });
                                Swal.fire(
                                    'Deleted!',
                                    'Service Deleted',
                                    'success'
                                )
                            },
                            error: function(error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',

                                })

                            },
                        });




                    }
                })

            });

            $("#serviceListTable tbody").on("click", 'a.showRecieptbtn', function(e) {

            var table = $('#serviceListTable').DataTable();
            var id = $(this).data("id");
            var $row = $(this).closest("tr");
            e.preventDefault();

            $.ajax({
                        type: "GET",
                        url: "/api/all-serviceList-getPhoto/" + id,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function(data) {
                            console.log(data.ref);
                            var imageUrl = window.location.origin + "/storage/public/images/" + data.ref;
                            Swal.fire({
                                title: "GCash",
                                text: "Receipt",
                                imageUrl: imageUrl,
                                imageWidth: 400,
                                imageHeight: 900,
                                imageAlt: "Custom image"
                            });
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',

                            })

                        },
                    });
            });
            //End Service List
        })
    </script>
@endpush
