$(document).ready(function () {

    $('input[name="paymentmethod"]').change(function () {
        var selectedPaymentMethod = $('input[name="paymentmethod"]:checked').val();
        handlePaymentMethod(selectedPaymentMethod);
    });


    $('input[name="cartpaymentmethod"]').change(function () {
        var selectedPaymentMethod = $('input[name="cartpaymentmethod"]:checked').val();
        handlePaymentMethodCart(selectedPaymentMethod);
    });

    var initialPaymentMethod = $('input[name="paymentmethod"]:checked').val();
    handlePaymentMethod(initialPaymentMethod);

    $('#manualInput').change(function () {
        if ($(this).is(':checked')) {
            $('#priestDropdown').hide();
            $('#manualPriestInput').show();
        } else {
            $('#manualPriestInput').hide();
            $('#priestDropdown').show();
        }
    });

    $('input[name="paymenttype"]').change(function () {
        var selectedPaymentType = $('input[name="paymenttype"]:checked').val();
        handlePaymentType(selectedPaymentType);
    });

    var initialPaymentType = $('input[name="paymenttype"]:checked').val();
    handlePaymentType(initialPaymentType);


    function handlePaymentType(paymentType) {
        $('#additionalValues').empty();
        var nichePrice = parseFloat($("#nichePrice").attr("value"));
        var downpayment = nichePrice * 0.2;
        var monthlyDues = (nichePrice * 0.8) / 3;
        if (paymentType === 'installment') {
            $('#additionalValues').append('<div class="mb-3"><label for="ref" class="form-label">Down Payment</label><input type="text" id="ref" disabled value="' + downpayment + '" name="downpayment" class="form-control" required></div>');
            $('#additionalValues').append('<div class="mb-3"><label for="ref" class="form-label">Montly Dues for 3 Months</label><input type="text" id="ref" disabled value="' + monthlyDues.toFixed(2) + '" name="montlydues" class="form-control" required></div>');
        } else {

        }
    }




    $('#proceedButton').on('click', function (e) {
        e.preventDefault();
        localStorage.clear();
        var paymentType = $('input[name="paymenttype"]:checked').val();
        var imageSrc = $('#serviceImg').attr('src');
        var niche_id = $('#niche_id').val();
        var nichePrice = $('#nichePrice').val();
        var niche_capacity = $('#niche_capacity').val();
        var nicheLevel = $('#nicheLevel').text();
        var dataToStore = {
            paymentType: paymentType,
            serviceImg: imageSrc,
            niche_id: niche_id,
            nicheLevel: nicheLevel,
            nichePrice: nichePrice,
            niche_capacity: niche_capacity
        };

        var jsonString = JSON.stringify(dataToStore);
        localStorage.setItem('ocmisFormData', jsonString);
        window.location.href = "/niches/service-view";
    });

    var storedData = localStorage.getItem('ocmisFormData') || [];

    updateTotalPrice();
    var parsedData = JSON.parse(storedData);
    console.log(parsedData)
    if (parsedData) {
        $('#serviceImgPrev').attr('src', parsedData.serviceImg);
        $('#pricePrev').text(parsedData.nichePrice);
        $('#nichePrev').text(parsedData.nicheLevel);



        $('#urnQty').prop('max', parsedData.niche_capacity);

        $('#urnQty').on('change', function () {
            var enteredValue = $(this).val();
            var parsedValue = parseFloat(enteredValue);
            if (!isNaN(parsedValue)) {
                // Enforce the minimum and maximum values
                var newValue = Math.min(parsedData.niche_capacity, Math.max(0, parsedValue));
                $(this).val(newValue);
            } else {
                $(this).val(0);
            }
        });
    }




    $('#btnUrnAdd').on('click', function () {
        var urnQty = $('#urnQty').val();
        var urnData = {
            quantity: urnQty,
            imageUrl: '/images/urn.jpg'
        };
        var urnDataJson = JSON.stringify(urnData);
        localStorage.setItem('urnData', urnDataJson);
        updateUrnCardContent(urnData);
        updateTotalPrice();
        $('#urnModal').modal('hide');
    });

    function updateUrnCardContent() {
        var urnCard = $('#urnCard');
        var storedUrnData = localStorage.getItem('urnData');
        if (storedUrnData) {
            var urnData = JSON.parse(storedUrnData);
            urnCard.html(`

                <div class="text-center">
                <a data-bs-toggle="modal" data-bs-target="#urnModal" class="text-reset text-decoration-none">
                    <img class="img-fluid h-75 w-75 mb-1" src="${urnData.imageUrl}" alt="Urn Image">
                    </a>
                    <p>Quantity: ${urnData.quantity}</p>
                    <button id="removeUrnData" class="btn btn-danger">Remove</button>
                </div>
            `);
            $('#removeUrnData').on('click', function () {

                localStorage.removeItem('urnData');
                updateTotalPrice();
                urnCard.html(`<h2> Urns </h2><a data-bs-toggle="modal" data-bs-target="#urnModal" class="text-reset text-decoration-none">
                <i class="fa fa-plus fa-3x" style="color: #448bef; aria-hidden="true"></i>
            </a>`);
            });
        } else {

            urnCard.html(`<h2> Urns </h2><a data-bs-toggle="modal" data-bs-target="#urnModal" class="text-reset text-decoration-none">
            <i class="fa fa-plus fa-3x" style="color: #448bef; aria-hidden="true"></i>
        </a>`);
        }
    }

    updateUrnCardContent();


    function updateTotalPrice() {
        var storedNicheData = localStorage.getItem('ocmisFormData');
        var storedUrnData = localStorage.getItem('urnData');
        var storedServiceData = localStorage.getItem('serviceFormData');
        var productCartItems = localStorage.getItem('productCartItems') ? JSON.parse(localStorage.getItem('productCartItems')) : [];

        var nicheData = storedNicheData ? JSON.parse(storedNicheData) : null;
        var urnData = storedUrnData ? JSON.parse(storedUrnData) : null;
        var serviceData = storedServiceData ? JSON.parse(storedServiceData) : null;

        var totalPrice = nicheData ? parseFloat(nicheData.nichePrice) : 0;

        if (urnData) {
            var urnPrice = parseFloat(urnData.quantity) * 50000; // Assuming urn price is 50000
            totalPrice += urnPrice;
        }

        if (serviceData) {
            var servicePrice = parseFloat(serviceData.price) || 0;
            totalPrice += servicePrice;
        }
        $('#receiptTable tbody').empty();
        $('#receiptTable tbody').append(`
        <tr>
            <td>Niche Price</td>
            <td></td>
            <td>₱${parseFloat(nicheData.nichePrice).toFixed(2)}</td>
            <td></td>

        </tr>
        ${urnData ? `
        <tr>
            <td>Urn</td>
            <td>${urnData.quantity}</td>
            <td>₱${urnPrice.toFixed(2)}</td>
            <td><button id="removeUrnDataCart" class="btn btn-danger">Remove</button></>
        </tr>` : ''}
        ${serviceData ? `
        <tr>
            <td>Service: ${serviceData.serviceName}</td>
            <td></td>
            <td>₱${servicePrice.toFixed(2)}</td>
            <td><button id="removeServiceDataCart" class="btn btn-danger">Remove</button></td>
        </tr>` : ''}
    `);
        // Append product rows to the receipt table
        productCartItems.forEach(function (product) {
            var productPrice = parseFloat(product.price) || 0;
            totalPrice += productPrice * product.quantity;
            console.log(product.name)
            // Append the product row to the receipt table
            $('#receiptTable tbody').append(`
                <tr>
                    <td>${product.name}</td>
                    <td><input type="number" value="${product.quantity}"></td>
                    <td>₱${productPrice.toFixed(2)}</td>
                    <td><button class="btn btn-danger remove-product" data-product-id="${product.product_id}">Remove</button></td>
                </tr>
            `);
        });


        $('input[type="number"]').on('change', function () {
            var productId = $(this).closest('tr').find('.remove-product').data('product-id');
            var newQuantity = parseInt($(this).val());
            var foundProduct = productCartItems.find(product => product.product_id === productId);

            if (foundProduct) {
                foundProduct.quantity = newQuantity;
                localStorage.setItem('productCartItems', JSON.stringify(productCartItems));
            }
            updateTotalPrice();
        });


        $('#cartTotalPrice').text(totalPrice.toFixed(2));
        console.log('Total Price:', totalPrice);

        $('.remove-product').on('click', function () {
            var productIdToRemove = $(this).data('product-id');
            productCartItems = productCartItems.filter(item => item.product_id !== productIdToRemove);
            localStorage.setItem('productCartItems', JSON.stringify(productCartItems));
            updateTotalPrice();
        });
        $('#removeUrnDataCart').on('click', function () {
            localStorage.removeItem('urnData');
            updateTotalPrice();
            updateUrnCardContent();
        });

        $('#removeServiceDataCart').on('click', function () {
            localStorage.removeItem('serviceFormData');
            updateTotalPrice();
            updateServiceCardContent();
        });


    }









    $('#btnServiceAdd').on('click', function (e) {
        e.preventDefault();
        if (validateForm()) {
            var service_id = $('#service_id').val();
            var serviceName = $('#service_id option:selected').text();
            var selectedOption = $('#service_id option:selected');
            var imgValue = selectedOption.attr('img');
            var price = selectedOption.attr('prc');
            var deceasedname = $('#deceasedname').val();
            var message = $('#message').val();
            var dates = $('#dates').val();
            // var startDatetime = $('#start_datetime').val();
            // var endDatetime = $('#end_datetime').val();
            // var manualInput = $('#manualInput').is(':checked');
            // var priest = manualInput ? $('#manualPriest').val() : $('#priest').val();

            var schedule = $('#schedule').val();
            var own_priest = $('#own_priest').is(':checked');
            var priest = $('#priest').val();

            // var formData = {
            //     service_id: service_id,
            //     serviceName, serviceName,
            //     deceasedname: deceasedname,
            //     message: message,
            //     startDatetime: startDatetime,
            //     endDatetime: endDatetime,
            //     manualInput: manualInput,
            //     priest: priest,
            //     image: imgValue,
            //     price: price
            // };
            var formData = {
                service_id: service_id,
                serviceName, serviceName,
                deceasedname: deceasedname,
                message: message,
                schedule: schedule,
                dates: dates,
                own_priest: own_priest,
                priest: priest,
                image: imgValue,
                price: price
            };
            localStorage.setItem('serviceFormData', JSON.stringify(formData));
            updateServiceCardContent();
            updateTotalPrice();
            $('#tranServiceModal').modal('hide');
        }
    });

    function updateServiceCardContent() {
        var serviceCard = $('#serviceCard');
        var storedServiceData = localStorage.getItem('serviceFormData');
        if (storedServiceData) {
            var serviceData = JSON.parse(storedServiceData);
            serviceCard.html(`

                <div class="text-center h-75">
                <a data-bs-toggle="modal" data-bs-target="#tranServiceModal" class="text-reset text-decoration-none">
                    <img class="img-fluid h-50 w-75 mb-1" src="/storage/${serviceData.image}" alt="Service Image">
                    </a>
                    <p>Service: ${serviceData.serviceName}</p>
                    <p>Price: ₱${serviceData.price}</p>
                    <button id="removeServiceData" class="btn btn-danger">Remove</button>
                </div>
            `);
            $('#removeServiceData').on('click', function () {

                localStorage.removeItem('serviceFormData');
                updateTotalPrice();
                serviceCard.html(`<h2> Services </h2><a data-bs-toggle="modal" data-bs-target="#tranServiceModal" class="text-reset text-decoration-none">
                <i class="fa fa-plus fa-3x" style="color: #448bef; aria-hidden="true"></i>
            </a>`);
            });
        } else {

            serviceCard.html(`<h2> Services </h2><a data-bs-toggle="modal" data-bs-target="#tranServiceModal" class="text-reset text-decoration-none">
            <i class="fa fa-plus fa-3x" style="color: #448bef; aria-hidden="true"></i>
        </a>`);
        }
    }

    updateServiceCardContent();


    function validateForm() {
        var isValid = true;

        if ($('#deceasedname').val().trim() === '') {
            isValid = false;
            alert('Please enter the deceased name.');
        }

        if ($('#message').val().trim() === '') {
            isValid = false;
            alert('Please enter the message.');
        }

        // if ($('#start_datetime').val().trim() === '') {
        //     isValid = false;
        //     alert('Please enter start time.');
        // }
        // if ($('#end_datetime').val().trim() === '') {
        //     isValid = false;
        //     alert('Please end time.');
        // }

        // if ($('#manualPriest').val().trim() === '' && $('#priest').val().trim() === '' ) {
        //     isValid = false;
        //     alert('Please choose or enter Priest.');
        // }
    //   if ($('#manualPriest').val().trim() === '' && $('#priest').val().trim() === '' ) {
    //         isValid = false;
    //         alert('Please choose or enter Priest.');
    //     }

        return isValid;
    }




    $.ajax({
        type: "GET",
        url: "/api/all-items",
        dataType: 'json',
        success: function (data) {
            console.log(data);

            $.each(data, function (key, value) {
                var productHtml = "<div class='product mb-5' data-id='" + value.product_id + "'>" +
                    "<div class='card card-1'>" +
                    "<img class='card-img-top img-fluid w-100 h-50' src='/storage/" + value.image + "' alt='...' />" +
                    "<div class='card-body'>" +
                    "<div class='text-center'>" +
                    "<h5 class='fw-bolder'>" + value.name + "</h5>" +
                    "<h6 >" + value.category + "</h5>" +
                    "₱<span class='price'>" + value.price + "</span>" +
                    "</div>" +
                    "</div>" +
                    "<div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>" +
                    "<div class='text-center'><button type='button' class='btn btn-outline-dark add-to-cart'>Add To Cart</button></div>" +
                    "</div>" +
                    "</div>" +
                    "</div>";

                $("#productsContainer").append(productHtml);





            });
            $("#productsContainer").on('click', '.add-to-cart', function () {
                var $product = $(this).closest('.product');
                var productId = $product.data('id');
                var selectedItem = data.find(product => product.product_id === productId);
                addToProductCart(selectedItem);
                // Call the function to update the total price and display the receipt
                updateTotalPrice();
            });
        },
        error: function () {
            console.log('AJAX load did not work');
            alert("error");
        }
    });



    function addToProductCart(product) {

        Swal.fire({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: 'success',
            title: 'Item Added to Cart',
            customClass: {
                popup: 'colored-toast',
            },
        });
        var productCartItems = localStorage.getItem('productCartItems') ? JSON.parse(localStorage.getItem('productCartItems')) : [];

        // Check if the product is already in the cart
        var existingProduct = productCartItems.find(item => item.product_id === product.product_id);

        if (existingProduct) {
            // Product is already in the cart, update the quantity
            existingProduct.quantity += 1;
        } else {
            // Product is not in the cart, add a new item
            product.quantity = 1;
            productCartItems.push(product);
        }

        localStorage.setItem('productCartItems', JSON.stringify(productCartItems));
    }

    $("#nicheCheckout").on('click', function () {

        var urnData = localStorage.getItem('urnData') ? JSON.parse(localStorage.getItem('urnData')) : null;
        var ocmisFormData = localStorage.getItem('ocmisFormData') ? JSON.parse(localStorage.getItem('ocmisFormData')) : null;
        var productCartItems = localStorage.getItem('productCartItems') ? JSON.parse(localStorage.getItem('productCartItems')) : null;
        var serviceFormData = localStorage.getItem('serviceFormData') ? JSON.parse(localStorage.getItem('serviceFormData')) : null;
        var cartUserId = $('#cartUserId').val();
        var paymentMethod = $('input[name="cartpaymentmethod"]:checked').val();
        var cartRef = $('#cartRef').val();
        var checkoutData = {
            urnData: urnData,
            ocmisFormData: ocmisFormData,
            productCartItems: productCartItems,
            serviceFormData: serviceFormData,
            user_id: cartUserId,
            paymentMethod,
            cartRef
        };


        var data = JSON.stringify(checkoutData);
        $.ajax({
            type: "POST",
            url: "/api/niches/checkout",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            processData: false,
            contentType: 'application/json; charset=utf-8',
            success: function (data,status) {

                    $("#cartModal").modal("hide");
                $('#receipItemsTableBody').empty();
                $("#customerName").text(`${data.customer.firstname} ${data.customer.lastname}`);
                $("#invoiceNo").text(`Invoice No: ${data.receipt_id}`);
                $("#date").text(data.date);
                var totalAmount = 0;

                // Function to append a row to the receipt table
                function appendRow(name, price, quantity) {
                    var row = $('<tr>');
                    row.append($('<td>').text(name));
                    row.append($('<td class="text-center">').text('₱' + price));
                    row.append($('<td class="text-center">').text(quantity));
                    row.append($('<td class="text-center">').text('₱' + (parseFloat(price) * quantity).toFixed(2)));
                    var subtotal = parseFloat(price) * quantity;
                    totalAmount += subtotal;
                    $('#receipItemsTableBody').prepend(row); // Use prepend to add rows at the top
                }

                if (data.cartItems && data.cartItems.length > 0) {
                    $.each(data.cartItems, function (index, item) {
                        appendRow(item.name, item.price, item.quantity);
                    });
                }
                if (data.service) {
                    appendRow(`Service: ${data.service.serviceName}`, data.service.price, 1); // Assuming quantity is always 1 for services
                }

                if (data.urns) {
                    appendRow(`Urns`, 50000, data.urns.quantity);
                }


                if (data.niches) {
                    appendRow(`Niche - ${data.niches.nicheLevel}`, data.niches.nichePrice, 1);
                }


                $("#totalPrice").text(`₱${totalAmount.toFixed(2)}`);
                $("#rpaymenttype").text(data.paymenttype.charAt(0).toUpperCase() + data.paymenttype.slice(1));
                $("#rpaymentmethod").text(data.paymentmethod);
                $("#receiptModal").modal("show");
                localStorage.removeItem('productCartItems');
                localStorage.removeItem('urnData');
                localStorage.removeItem('serviceFormData');
                updateTotalPrice();
                updateServiceCardContent();
                updateUrnCardContent();

            },
            error: function (error) {
               alert(error.responseJSON.data)

            }
        });


    });


});

function handlePaymentMethod(paymentMethod) {
    // Clear existing content
    $('#additionalContent').empty();

    if (paymentMethod === 'GCASH') {
        $('#additionalContent').append('<div class="text-center"><img src="/images/gcash.jpg" class="h-50 w-50" alt="GCash Image"></div>');
        $('#additionalContent').append('<div class="mb-3"><label for="ref" class="form-label">IMAGE OF GCASH RECEIPT:</label><input type="file" id="ref" name="ref" accept="image/*" class="form-control" required></div>');
    } else {
        // Handle other payment methods or remove content
    }
}


function handlePaymentMethodCart(paymentMethod) {
    // Clear existing content
    $('#cartadditionalValues').empty();

    if (paymentMethod === 'GCASH') {
        $('#cartadditionalValues').append('<div class="text-center"><img src="/images/gcash.jpg" class="h-25 w-25" alt="GCash Image"></div>');
        $('#cartadditionalValues').append('<div class="mb-3"><label for="ref" class="form-label">REFERENCE NUMBER:</label><input type="text" id="cartRef" name="cartRef" class="form-control" required></div>');
    } else {
        // Handle other payment methods or remove content
    }
}
