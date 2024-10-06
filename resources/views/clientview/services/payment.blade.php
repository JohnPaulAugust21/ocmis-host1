@extends('layouts.clientnav')

@section('content')
    <header class="py-5 bg-dark-2">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">

                <h1 class="display-4 fw-bolder">Ocmis Services</h1>

                <p class="lead fw-normal text-white-50 mb-0">Guiding You Through Moments of Remembrance</p>
            </div>
        </div>
    </header>
    <section x-data="dropdown({{ $schedules }})" class="py-5">
        <div class="row gx-4 gx-lg-5 row-cols-1 justify-content-center">

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('servicePostPayment', ['id' => $service->service_id]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                           <p> <strong>Reminder: </strong>Please note that if payment is not received within one day, your transaction will be canceled by the admin.</p><br>
                            <div class="card mb-3 text-center d-flex justify-content-center align-items-center">
                                <img src="/storage/{{ $service->image }}" class="card-img-top h-25 w-25"
                                    alt="Image Alt Text">
                            </div>

                            <div class="card mb-3 text-center d-flex justify-content-center align-items-center">
                                <h2>{{ $service->name }}</h2>
                            </div>

                            <div class="mb-3">
                                <label for="deceasedname" class="form-label">DECEASED NAME:</label>
                                <input type="text" id="deceasedname" name="deceasedname" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">MESSAGE:</label>
                                <input type="text" id="message" name="message" class="form-control"
                                    style="width: 100%; height: 114px;" required>
                            </div>
                            {{--
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_datetime" class="form-label">START DATE:</label>
                                <input type="datetime-local" id="start_datetime" name="start_datetime"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="end_datetime" class="form-label">END DATE:</label>
                                <input type="datetime-local" id="end_datetime" name="end_datetime" class="form-control"
                                    required>
                            </div>
                        </div> --}}

                            {{-- <div class="mb-3">
                                <label for="image" class="form-label">IMAGE OF YOUR LOVED ONE:</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*"
                                    required>
                            </div> --}}

                            <div class="mb-3">
                                <label>Own Priest: </label>
                                <input type="checkbox" x-model="own_priest" class="form-check-input" name="own_priest">
                            </div>
                            <div x-show="own_priest" class="mb-3">
                                <label>Schedule: </label>
                                <input type="datetime-local" :name="own_priest == true ? 'date' : ''" class="form-control" >
                            </div>

                            <div x-show="own_priest == false" class="mb-3" id="priestDropdown">
                                <label for="priest" class="form-label">Priest</label>
                                <select x-model="priest" :name="own_priest == false ? 'priest_id' : ''" id="priest" class="form-select" :required="own_priest == false ? true : false">
                                    <option value="">-- Select --</option>
                                    @foreach ($priests as $priest)
                                        <option value="{{ $priest->priest_id }}">Fr. {{ $priest->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div x-show="showSched && own_priest == false" class="mb-3" id="priestDropdown">
                                <label for="priest" class="form-label">Priest Schedules <span class="text-secondary">(Date -- Start Time TO End Time)</span></label>
                                <select class="form-select" :name="own_priest == false ? 'schedule' : ''" id="priest" :required="own_priest == false ? true : false">
                                    <option value="" selected>-- Select --</option>


                                    <template x-for="(v,i) in sched || []" x-key="i">
                                        <option :value="v.id" x-text="changeName(v.date,v.start_time,v.end_time)"></option>
                                    </template>
                                </select>
                            </div>
                            {{-- <div class="mb-3" id="manualPriestInput" style="display:block;">
                                <label for="manualPriest" class="form-label">Priest:</label>
                                <input type="text" name="manualPriest" id="manualPriest" class="form-control">
                            </div> --}}

                            <div class="mb-3">
                                <label class="form-label">PAYMENT METHOD:</label>
                                <div class="form-check">
                                    <input type="radio" id="CASH" name="paymentmethod" value="CASH"
                                        class="form-check-input" checked>
                                    <label for="CASH" class="form-check-label">Cash</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="GCASH" name="paymentmethod" value="GCASH"
                                        class="form-check-input">
                                    <label for="GCASH" class="form-check-label">GCash</label>
                                </div>
                            </div>

                            <div id="additionalContent" class="mb-3">
                            </div>
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-primary w-100">Login First</a>
                            @else
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            @endguest
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
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
