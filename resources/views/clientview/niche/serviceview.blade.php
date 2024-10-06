@extends('layouts.clientnav')


@section('content')

<div class="container-fluid mb-5 mt-3">
    <div class="row h-100 vh-100 ">
        <!-- Left Panel (Half Screen) -->
        <div class="col-md-6">
            <div class="card h-75">
                <div class="card-body d-flex flex-column align-items-center justify-content-center h-100">
                    <img id="serviceImgPrev" src="/storage/" class="h-50 w-50">
                    <h1> Niche <span id="nichePrev"> </span> </h1>
                    <h3>₱<span id="pricePrev"> </span></h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row h-50">

                {{-- <div class="col-md-6 h-100">
                    <div class="card h-75">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div id="urnCard" class="text-center">
                                <h2> Urns </h2>
                                <a data-bs-toggle="modal" data-bs-target="#urnModal"
                                    class="text-reset text-decoration-none">
                                    <i class="fa fa-plus fa-3x" style="color: #448bef; aria-hidden=" true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="col-md-6 h-100 mb-4">
                    <div class="card h-75">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#cartModal"
                                class="text-reset text-decoration-none">

                                {{-- <p class="fw-bolder">Total Price: ₱<span id="cartTotalPrice"> </span></p>
                                <button id="checkoutBtn" class="btn btn-primary">Checkout</button> --}}
                                <i class="fa fa-shopping-cart fa-3x" style="color: #448bef; aria-hidden=" true"></i>
                            </a>

                        </div>
                    </div>
                </div>


                <div class="col-md-6 h-100">
                    <div class="card h-75">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div id="serviceCard" class="text-center">
                                <h2> Service </h2>
                                <a data-bs-toggle="modal" data-bs-target="#tranServiceModal"
                                    class="text-reset text-decoration-none">
                                    <i class="fa fa-plus fa-3x" style="color: #448bef; aria-hidden=" true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 h-100">
                    <div class="card h-75">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div id="productCard" class="text-center">
                                <h2> Products </h2>
                                <a data-bs-toggle="modal" data-bs-target="#tranProductModal"
                                    class="text-reset text-decoration-none">
                                    <i class="fa fa-plus fa-3x" style="color: #448bef; aria-hidden=" true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Urn Modal --}}
<div class="modal fade" id="urnModal" tabindex="-1" role="dialog" aria-labelledby="urnModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Urn</h5>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img class="img-fluid h-50 w-50 mb-3" src="/images/urn.jpg">
                </div>
                <div class="form-group">
                    <label for="urnQty">Quantity</label>
                    <input id="urnQty" class="form-control" name="urnQty" type="number" value="1" max="4" min="0">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="btnUrnAdd" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
{{--End Urn Modal --}}


{{-- Service Modal --}}
<div x-data="dropdown({{ $schedules }})" class="modal fade" id="tranServiceModal" tabindex="-1" role="dialog" aria-labelledby="tranServiceModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
            </div>
            <div class="modal-body">
                <div class="row gx-4 gx-lg-5 row-cols-1 justify-content-center">
                    <div class="mb-4 px-4">
                        <div class="card-body">
                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <form action="#" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3" id="serviceDropdown">
                                    <label for="service_id" class="form-label">Service</label>
                                    <select name="service_id" id="service_id" class="form-select">
                                        @foreach($services as $service)
                                        <option value="{{$service->service_id}}" img="{{$service->image}}"
                                            prc="{{$service->price}}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="deceasedname" class="form-label">DECEASED NAME:</label>
                                    <input type="text" id="deceasedname" name="deceasedname" class="form-control"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="message" class="form-label">MESSAGE:</label>
                                    <input type="text" id="message" name="message" class="form-control"
                                        style="width: 100%; height: 114px;" required>
                                </div>

                                {{-- <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="start_datetime" class="form-label">START DATE:</label>
                                        <input type="datetime-local" id="start_datetime" name="start_datetime"
                                            class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="end_datetime" class="form-label">END DATE:</label>
                                        <input type="datetime-local" id="end_datetime" name="end_datetime"
                                            class="form-control" required>
                                    </div>
                                </div> --}}

{{--
                                <div class="mb-3">
                                    <label for="manualInput">Own Priest: </label>
                                    <input type="checkbox" id="manualInput" class="form-check-input" name="manualInput">
                                </div>
                                <div class="mb-3" id="priestDropdown">
                                    <label for="priest" class="form-label">Priest</label>
                                    <select name="priest" id="priest" class="form-select">
                                        @foreach($priests as $priest)
                                        <option value="{{ $priest->name }}">Fr. {{ $priest->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="mb-3">
                                    <label>Own Priest: </label>
                                    <input type="checkbox" id="own_priest" x-model="own_priest" class="form-check-input" name="own_priest">
                                </div>
                                <div x-show="own_priest" class="mb-3">
                                    <label>Schedule: </label>
                                    <input type="datetime-local" id="dates" :name="own_priest == true ? 'dates' : ''" class="form-control" >
                                </div>

                                <div x-show="own_priest == false" class="mb-3" id="priestDropdown">
                                    <label for="priest" class="form-label">Priest</label>
                                    <select x-model="priest" :name="own_priest == false ? 'priest' : ''" id="priest" class="form-select" :required="own_priest == false ? true : false">
                                        <option value="">-- Select --</option>
                                        @foreach ($priests as $priest)
                                            <option value="{{ $priest->priest_id }}">Fr. {{ $priest->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div x-show="showSched && own_priest == false" class="mb-3" id="priestDropdown">
                                    <label for="priest" class="form-label">Priest Schedules <span class="text-secondary">(Date -- Start Time TO End Time)</span></label>
                                    <select id="schedule" class="form-select" :name="own_priest == false ? 'schedule' : ''" id="priest" :required="own_priest == false ? true : false">
                                        <option value="" selected>-- Select --</option>


                                        <template x-for="(v,i) in sched || []" x-key="i">
                                            <option :value="v.id" x-text="changeName(v.date,v.start_time,v.end_time)"></option>
                                        </template>
                                    </select>
                                </div>
                                <div class="mb-3" id="manualPriestInput" style="display:none;">
                                    <label for="manualPriest" class="form-label">Priest:</label>
                                    <input type="text" name="manualPriest" id="manualPriest" class="form-control">
                                </div>

                                <div id="additionalContent" class="mb-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="btnServiceAdd" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
{{-- End Service Modal --}}

{{-- Products Modal --}}
<div class="modal fade" id="tranProductModal" tabindex="-1" role="dialog" aria-labelledby="tranServiceModal"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
            </div>
            <div class="modal-body">
                <div class="container px-4 px-lg-5 mt-1">
                    <div id="productsContainer"
                        class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Product Modal--}}

{{-- Cart Modal --}}
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="tranServiceModal"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
            </div>
            <div class="card ">
                <div class="card-body p-4">
                    <div id="urnCartContent">
                        <table id="receiptTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="bg-warning">Item/Service</th>
                                    <th class="bg-warning">Quantity</th>
                                    <th class="bg-warning">Price</th>
                                    <th class="bg-warning">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Your table body content here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PAYMENT METHOD</label>
                        <div class="form-check">
                            <input type="radio" id="cash" name="cartpaymentmethod" value="CASH" class="form-check-input" checked>
                            <label for="cash" class="form-check-label">CASH</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="gcash" name="cartpaymentmethod" value="GCASH" class="form-check-input">
                            <label for="gcash" class="form-check-label">GCASH</label>
                        </div>
                        <div id="cartadditionalValues" class="mb-3 h-25 max-height-100">
                        </div>
                    </div>
                    <p class="fw-bolder text-dark">Total Price: ₱<span id="cartTotalPrice"> </span></p>
                </div>
            </div>




            <input type="hidden" value="{{auth()->id()}}" id="cartUserId">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @if(auth()->check())
                <button id="nicheCheckout" type="button" class="btn btn-primary">Checkout</button>
                @else
                <button type="button" class="btn btn-primary" id="loginbtn"
                    onclick="window.location='{{ route('login') }}'">Login First</button>
                @endif
            </div>
        </div>
    </div>
</div>
{{-- End Cart Modal --}}

{{-- Receipt --}}
<div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiptModalLabel">Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="content">
                        <div class="main text-center">
                            <div class="content-wrap">
                                <div class="content-block">
                                    <h2>Receipt</h2>
                                </div>
                                <div class="content-block">
                                    <table class="table">
                                        <tr class="text-start">
                                            <td>
                                                <span id="customerName">Anna Smith</span>
                                                <br>
                                                <span id="invoiceNo">Invoice #12345</span>
                                                <br>
                                                <span id="date">June 01 2015</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="receipItemsTable" class="table">
                                                    <thead>
                                                        <tr class="table-active">
                                                            <td class="text-center">Item</td>
                                                            <td class="text-center">Price</td>
                                                            <td class="text-center">Qty</td>
                                                            <td class="text-center">Subtotal</td>
                                                        </tr>
                                                        <thead>
                                                        <tbody id="receipItemsTableBody">

                                                    <tbody>
                                                    <tfoot>
                                                        <tr class="table-active">
                                                            <td class="text-center fw-bolder">Payment Type</td>
                                                            <td class="text-center fw-bold" colspan="2"></td>
                                                            <td id="rpaymenttype" class="text-center fw-bold">₱36.00
                                                            </td>
                                                        </tr>


                                                        <tr class="table-active">
                                                            <td class="text-center fw-bolder">Payment Method</td>
                                                            <td class="text-center fw-bold" colspan="2"></td>
                                                            <td id="rpaymentmethod" class="text-center fw-bold">₱36.00
                                                            </td>
                                                        </tr>

                                                        <tr class="table-active">
                                                            <td class="text-center fw-bolder">Total</td>
                                                            <td class="text-center fw-bold" colspan="2"></td>
                                                            <td id="totalPrice" class="text-center fw-bold">₱36.00
                                                            </td>
                                                        </tr>
                                                        <tfoot>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="content-block">
                                    OCMIS 2023
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- End Receipt --}}
@endsection
@push('js')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dropdown', (schedules) => ({
                open: false,
                schedules: schedules,
                own_priest: false,
                priest: '',
                sched: [],
                showSched: false,
                changeName(date, start, end) {

                    return `${date} -- ${this.changeTIme(start)} TO ${this.changeTIme(end)}`;
                },
                changeTIme(time) {
                    var timeArray = time.split(':');
                    var hours = parseInt(timeArray[0], 10);
                    var minutes = parseInt(timeArray[1], 10);

                    // Determining AM or PM
                    var period = (hours >= 12) ? "PM" : "AM";

                    // Converting hours to 12-hour format
                    hours = (hours > 12) ? hours - 12 : hours;
                    hours = (hours == 0) ? 12 : hours;

                    // Creating the 12-hour time string
                    var time12Hour = hours.toString().padStart(2, '0') + ':' + minutes.toString()
                        .padStart(2, '0') + ' ' + period;

                    return time12Hour;
                },
                init() {
                    var self = this;
                    this.$watch('priest', (value) => {
                        if (!!value) {
                            self.showSched = [];

                            var x = self.schedules.filter((val) => {
                                return val.priest_id == value;
                            })
                            self.sched = x;
                            self.showSched = true;

                        } else {
                            self.showSched = [];
                            self.showSched = false;

                        }
                    })



                }
            }))
        })
    </script>
@endpush
