$(document).ready(function () {
    $("#userTable").DataTable({
        ajax: {
            url: "/api/all-users",
            dataSrc: "",
        },
        // dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',

        columns: [{
            data: "id",

        },
        {
            data: "lastname",

        },
        {
            data: "firstname",

        },
        {
            data: "middlename",

        },
        {
            data: "address",

        },
        {
            data: "email",

        },
        {
            data: "contactnumber",

        },
        {
            data: "username",

        },

        ],
    });
    //Building
    $("#buildingTable").DataTable({


        ajax: {
            url: "/api/all-buildings",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        columns: [{
            data: "building_id",

        },
        {
            data: "name",

        },
        {
            data: null,
            class: "preview-img-lg",
            render: function (data, type, JsonResultRow, row) {
                return '<img src="/storage/' + JsonResultRow.image + '" height="70%" width="70%">';
            }
        },
        {

            data: null,

            render: function (data, type, row) {
                return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
                    data.building_id +
                    "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.building_id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
            },
        },


        ],
    });


    $("#buildingTable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        // alert(id);
        var editUrl = "/admin/niches/building-edit/:id".replace(':id', id);
        // alert(editUrl);
        window.location.href = editUrl;
    });

    $("#buildingTable tbody").on("click", 'a.deletebtn', function (e) {



        var table = $('#buildingTable').DataTable();
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
                    url: "/api/delete-building/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {

                        // bootbox.alert('success');
                        $row.fadeOut(4000, function () {
                            table.row($row).remove().draw(false);
                        });
                        Swal.fire(
                            'Deleted!',
                            'Building Deleted',
                            'success'
                        )
                    },
                    error: function (error) {
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

    //End Building

    //Niche
    $("#nicheTable").DataTable({


        ajax: {
            url: "/api/all-niches",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        columns: [{
            data: "niche_id",

        },
        {
            data: "name",

        },
        {
            data: "niche_number",

        },
        {
            data: "capacity",

        },
        {
            data: "status",

        },
        {
            data: "user_id",

        },
        {
            data: null,
            class: "preview-img-lg",
            render: function (data, type, JsonResultRow, row) {
                return '<img src="/storage/' + JsonResultRow.image + '" height="100px" width="100px">';
            }
        },
        {
            data: "price",

        },
        {

            data: null,

            render: function (data, type, row) {
                return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
                    data.niche_id +
                    "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.niche_id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
            },
        },


        ],
    });

    $("#nicheTable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var editUrl = "/admin/niches/niche-edit/:id".replace(':id', id);
        window.location.href = editUrl;
    });

    $("#nicheTable tbody").on("click", 'a.deletebtn', function (e) {



        var table = $('#nicheTable').DataTable();
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
                    url: "/api/delete-niche/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {

                        // bootbox.alert('success');
                        $row.fadeOut(4000, function () {
                            table.row($row).remove().draw(false);
                        });
                        Swal.fire(
                            'Deleted!',
                            'Niche Deleted',
                            'success'
                        )
                    },
                    error: function (error) {
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
    //End Niche

    //Urn
    $("#urnTable").DataTable({


        ajax: {
            url: "/api/all-urns",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        columns: [{
            data: "urn_id",

        },
        {
            data: "niche_id",

        },
        {
            data: "urn_number",

        },
        {
            data: "name",

        },
        {
            data: null,
            class: "preview-img-lg",
            render: function (data, type, JsonResultRow, row) {
                var imageUrl = JsonResultRow.urn_image ? '/storage/' + JsonResultRow.urn_image : '/path/to/default-image.jpg';
                return JsonResultRow.urn_image ? '<img src="' + imageUrl + '" height="100px" width="100px">' : 'No Image';
            }
        },
        {
            data: "message",

        },
        {

            data: null,

            render: function (data, type, row) {
                return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
                    data.urn_id +
                    "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.urn_id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
            },
        },


        ],
    });

    $("#urnTable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var editUrl = "/admin/niches/urn-edit/:id".replace(':id', id);
        window.location.href = editUrl;
    });
    $("#urnTable tbody").on("click", 'a.deletebtn', function (e) {



        var table = $('#urnTable').DataTable();
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
                    url: "/api/delete-urn/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {

                        $row.fadeOut(4000, function () {
                            table.row($row).remove().draw(false);
                        });
                        Swal.fire(
                            'Deleted!',
                            'Urn Deleted',
                            'success'
                        )
                    },
                    error: function (error) {
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
    //End Urn

    //Service Category

    $("#serviceCategoryTable").DataTable({


        ajax: {
            url: "/api/all-services",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        columns: [{
            data: "service_id",

        },
        {
            data: "name",

        },
        {
            data: "price",

        },
        {
            data: "status",

        },
        {
            data: null,
            class: "preview-img-lg",
            render: function (data, type, JsonResultRow, row) {
                var imageUrl = JsonResultRow.image ? '/storage/' + JsonResultRow.image : '/path/to/default-image.jpg';
                return JsonResultRow.image ? '<img src="' + imageUrl + '" height="100px" width="100px">' : 'No Image';
            }
        },
        {

            data: null,

            render: function (data, type, row) {
                return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
                    data.service_id +
                    "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.service_id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
            },
        },


        ],
    });

    $("#serviceCategoryTable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var editUrl = "/admin/services/category-edit/:id".replace(':id', id);
        window.location.href = editUrl;
    });

    $("#serviceCategoryTable tbody").on("click", 'a.deletebtn', function (e) {



        var table = $('#serviceCategoryTable').DataTable();
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
                    url: "/api/delete-service/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {

                        $row.fadeOut(4000, function () {
                            table.row($row).remove().draw(false);
                        });
                        Swal.fire(
                            'Deleted!',
                            'Service Deleted',
                            'success'
                        )
                    },
                    error: function (error) {
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

    //End Service Category



    //Priest


    $("#priestTable").DataTable({


        ajax: {
            url: "/api/all-priests",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        columns: [{
            data: "priest_id",

        },
        {
            data: "name",

        },
        {
            data: "contactnumber",

        },
        {
            data: "address",

        },
        {
            data: "status",

        },
        {

            data: null,

            render: function (data, type, row) {
                return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
                    data.priest_id +
                    "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.priest_id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
            },
        },


        ],
    });

    $("#priestTable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var editUrl = "/admin/services/priest-edit/:id".replace(':id', id);
        window.location.href = editUrl;
    });



    $("#priestTable tbody").on("click", 'a.deletebtn', function (e) {



        var table = $('#priestTable').DataTable();
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
                    url: "/api/delete-priest/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {

                        $row.fadeOut(4000, function () {
                            table.row($row).remove().draw(false);
                        });
                        Swal.fire(
                            'Deleted!',
                            'Priest Deleted',
                            'success'
                        )
                    },
                    error: function (error) {
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

    //End Priest

    //Shop Categories

    $("#shopCategoryTable").DataTable({


        ajax: {
            url: "/api/all-shopcategories",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        columns: [{
            data: "category_id",

        },
        {
            data: "name",

        },
        {
            data: "status",

        },
        {
            data: null,
            class: "preview-img-lg",
            render: function (data, type, JsonResultRow, row) {
                var imageUrl = JsonResultRow.image ? '/storage/' + JsonResultRow.image : '/path/to/default-image.jpg';
                return JsonResultRow.image ? '<img src="' + imageUrl + '" height="100px" width="100px">' : 'No Image';
            }
        },
        {

            data: null,

            render: function (data, type, row) {
                return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
                    data.category_id +
                    "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.category_id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
            },
        },


        ],
    });

    $("#shopCategoryTable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var editUrl = "/admin/shop/category-edit/:id".replace(':id', id);
        window.location.href = editUrl;
    });

    $("#shopCategoryTable tbody").on("click", 'a.deletebtn', function (e) {



        var table = $('#shopCategoryTable').DataTable();
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
                    url: "/api/delete-shopcategory/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {

                        $row.fadeOut(4000, function () {
                            table.row($row).remove().draw(false);
                        });
                        Swal.fire(
                            'Deleted!',
                            'Category Deleted',
                            'success'
                        )
                    },
                    error: function (error) {
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

    //End Shop Categories

    //Seller

    $("#sellerTable").DataTable({


        ajax: {
            url: "/api/all-sellers",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        columns: [{
            data: "seller_id",

        },
        {
            data: "name",

        },
        {
            data: "contactnumber",

        },
        {
            data: "address",

        },
        {
            data: "status",

        },
        {

            data: null,

            render: function (data, type, row) {
                return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
                    data.seller_id +
                    "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.seller_id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
            },
        },


        ],
    });

    $("#sellerTable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var editUrl = "/admin/shop/seller-edit/:id".replace(':id', id);
        window.location.href = editUrl;
    });



    $("#sellerTable tbody").on("click", 'a.deletebtn', function (e) {



        var table = $('#sellerTable').DataTable();
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
                    url: "/api/delete-seller/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {

                        $row.fadeOut(4000, function () {
                            table.row($row).remove().draw(false);
                        });
                        Swal.fire(
                            'Deleted!',
                            'Seller Deleted',
                            'success'
                        )
                    },
                    error: function (error) {
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
    //End Seller

    //Product

    $("#productTable").DataTable({


        ajax: {
            url: "/api/all-products",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        columns: [{
            data: "product_id",

        },
        {
            data: "cname",

        },
        {
            data: "name",

        },
        {
            data: "description",

        },
        {
            data: "sname",

        },
        {
            data: "stock",

        },
        {
            data: "price",

        },
        {
            data: "status",

        },
        {
            data: null,
            class: "preview-img-lg",
            render: function (data, type, JsonResultRow, row) {
                var imageUrl = JsonResultRow.image ? '/storage/' + JsonResultRow.image : '/path/to/default-image.jpg';
                return JsonResultRow.image ? '<img src="' + imageUrl + '" height="100px" width="100px">' : 'No Image';
            }
        },
        {

            data: null,

            render: function (data, type, row) {
                return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
                    data.product_id +
                    "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.product_id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
            },
        },


        ],
    });

    $("#productTable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var editUrl = "/admin/shop/product-edit/:id".replace(':id', id);
        window.location.href = editUrl;
    });

    $("#productTable tbody").on("click", 'a.deletebtn', function (e) {
        var table = $('#productTable').DataTable();
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
                    url: "/api/delete-product/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {

                        $row.fadeOut(4000, function () {
                            table.row($row).remove().draw(false);
                        });
                        Swal.fire(
                            'Deleted!',
                            'Product Deleted',
                            'success'
                        )
                    },
                    error: function (error) {
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

    //End Product

    //Shop Transactions
    $("#shopTransactionTable").DataTable({


        ajax: {
            url: "/api/shop-transaction-list",
            dataSrc: "",
        },
        "ordering": true,      // Enable sorting
        "order": [[0, "desc"]],
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

        },
        {
            data: null,
            render: function(data, type, row) {
                if (data.status === 'Pending') {
                    return `<button class="btn btn-success editBtn" data-id="${data.orderline_id}">Approve</button>`;
                } else if (data.status === 'Completed') {
                    return ``;
                } else {
                    return '';
                }
            },
        },

        ],
    });

    $("#shopTransactionTable tbody").on("click", 'button.editBtn', function (e) {
        var table = $('#shopTransactionTable').DataTable();
        var id = $(this).data("id");
        console.log(id);
        var $row = $(this).closest("tr");
        e.preventDefault();
        Swal.fire({
            title: "Are you sure you want to complete this transaction??",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, approve it!"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "/api/switch-status/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {
                        table.ajax.reload();
                        Swal.fire({
                            title: "Completed!",
                            text: "Your file has been deleted.",
                            icon: "success"
                          });
                    },
                    error: function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',

                        })

                    },
                });
            }
          });
                

    });

    $("#shopTransactionTable tbody").on("click", 'a.revertBtn', function (e) {
        var table = $('#shopTransactionTable').DataTable();
        var id = $(this).data("id");
        console.log(id);
        var $row = $(this).closest("tr");
        e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "/api/switch-status/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {
                        table.ajax.reload();
                        Swal.fire(
                            'Changed!',
                            'Status Updated',
                            'success'
                        )
                    },
                    error: function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',

                        })

                    },
                });

    });

    $("#shopTransactionTable tbody").on("click", 'a.cancelBtn', function (e) {
        var table = $('#shopTransactionTable').DataTable();
        var id = $(this).data("id");
        console.log(id);
        var $row = $(this).closest("tr");
        e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "/api/switch-status/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {
                        table.ajax.reload();
                        Swal.fire(
                            'Changed!',
                            'Status Updated',
                            'success'
                        )
                    },
                    error: function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',

                        })

                    },
                });

    });
    //End Transactions




    //End My Requests

    //My Purchases



    //End My Purchases

    //My Niches

    //End My Niches

    //My Urns
    $("#myUrnsTable").DataTable({


        ajax: {
            url: "/me/transactions/myUrns",
            dataSrc: "",
        },
        "ordering": true, // Enable sorting
        "order": [
            [0, "desc"]
        ],
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        columns: [{
                data: "urn_id",

            },
            {
                data: "bname",

            },
            {
                data: "niche_number",

            },

            {
                data: "name",

            },
            {
                data: "message",

            },
            {
                data: null,
                class: "preview-img-lg",
                render: function(data, type, JsonResultRow, row) {
                    var imageUrl = JsonResultRow.deceased_image ? '/storage/' +
                        JsonResultRow.deceased_image : '/path/to/default-image.jpg';
                    return JsonResultRow.deceased_image ? '<img src="' + imageUrl +
                        '" height="100px" width="100px">' : 'No Image';
                }
            },
            {

                data: null,

                render: function(data, type, row) {
                    return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
                        data.urn_id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" +
                        data.urn_id +
                        "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
                },
            },

        ],
    });

    $("#myUrnsTable tbody").on("click", 'a.deletebtn', function (e) {



        var table = $('#urnTable').DataTable();
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
                    url: "/api/delete-urn/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {

                        $row.fadeOut(4000, function () {
                            table.row($row).remove().draw(false);
                        });
                        Swal.fire(
                            'Deleted!',
                            'Urn Deleted',
                            'success'
                        )
                    },
                    error: function (error) {
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


    $("#myUrnsTable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        $('#editUrnModal').modal('show');
        var id = $(this).data("id");
        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/me/transactions/edit-urn/" + id,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) {

                $('#urn_id').val(data.urn_id);
                $('#deceasedName').val(data.name);
                $('#message').val(data.message);

            },
            error: function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',

                })
            },
        });
    });

    $("#btnMyUrnUpdate").on("click", function (e) {
        var id = $("#urn_id").val();
        e.preventDefault();
        var data = $('#myUrnForm')[0];

        let formData = new FormData(data);

        for (var pair of formData.entries()) {
            console.log(pair[0] + ',' + pair[1]);
        }
        $.ajax({
            type: "POST",
            url: "/api/me/transactions/update-urn/" + id,
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data) {

                $('#editUrnModal').modal("hide");

                $('#myUrnsTable').DataTable().ajax.reload();

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '<h3 class="text-light">Urn Updated Succesfully</h3>',
                    showConfirmButton: false,
                    timer: 2000

                })

            },
            error: function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',

                })
            }


        })

    });
    //End Urns

    $("#memorialTransactionTable").DataTable({
        ajax: {
            url: "/api/all-memorials",
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
                data: "message",

            },
            {
                data: "deceasedname",

            },

            {
                data: "date_time",

            },
            {
                data: "price",

            },
            {
                data: "payment_mode",

            },
            {
                data: "status",

            },
            {
                data: null,
                class: "preview-img-lg",
                render: function(data, type, JsonResultRow, row) {
                    var imageUrl = JsonResultRow.ref ? '/storage/' +
                        JsonResultRow.ref : '/path/to/default-image.jpg';
                    return JsonResultRow.ref ? '<img src="' + imageUrl +
                        '" height="100px" width="100px">' : 'No Image';
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    if (row.status === 'Completed') {
                        return `<button class="btn btn-info cancelBtn" data-id="${data.memorial_id}">Refund</button>`;
                    } else if (row.status === 'Pending') {
                        return `<button class="btn btn-success approveBtn" data-id="${data.memorial_id}">Approve</button>
                                <button class="btn btn-danger cancelBtn" data-id="${data.memorial_id}">Cancel</button>`;
                    } else {
                        return '';
                    }
                },
            },

        ],
    });
    // $("#serviceListTable tbody").on("click", 'a.editBtn', function(e) {
    //     e.preventDefault();
    //     var id = $(this).data("id");
    //     var editUrl = "/admin/services/servicelist-edit/:id".replace(':id', id);
    //     window.location.href = editUrl;
    // });

    $("#memorialTransactionTable tbody").on("click", 'button.approveBtn', function (e) {
        var id = $(this).data("id");
        console.log(id);
        Swal.fire({
            title: "Are you sure you want to approve this transaction?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, approve it!"
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "GET",
                    url: "/api/memorial-update/" + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    processData: false,
                    contentType: 'application/json; charset=utf-8',
                    success: function (data) {
    
                        console.log(data)
                        Swal.fire({
                            title: "Aprroved!",
                            text: "Transaction has been completed.",
                            icon: "success"
                          });
                          setTimeout(function () {
                            window.location.href = '/admin/services/memorial';
                        }, 1500);
                    },
                    error: function (error) {
                       console.log(error)
        
                    }
                });
              
            }
          });
    });

    $("#memorialTransactionTable tbody").on("click", 'button.cancelBtn', function (e) {
        var id = $(this).data("id");
        console.log(id);
        Swal.fire({
            title: "Are you sure you want to cancel this transaction?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, CANCEL it!"
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "GET",
                    url: "/api/memorial-cancel/" + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    processData: false,
                    contentType: 'application/json; charset=utf-8',
                    success: function (data) {
    
                        console.log(data)
                        Swal.fire({
                            title: "Aprroved!",
                            text: "Transaction has been completed.",
                            icon: "success"
                          });
                          setTimeout(function () {
                            window.location.href = '/admin/services/memorial';
                        }, 1500);
                    },
                    error: function (error) {
                       console.log(error)
        
                    }
                });
              
            }
          });
    });

});
