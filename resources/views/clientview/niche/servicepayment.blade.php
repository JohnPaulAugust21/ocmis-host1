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

<section class="py-5">
    <div class="row gx-4 gx-lg-5 row-cols-1 justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
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

                    <form action="{{ route('postAddServicePayment', ['id' => $service->service_id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card mb-3 text-center d-flex justify-content-center align-items-center">
                            <img src="/storage/{{$service->image}}" class="card-img-top h-25 w-25" alt="Image Alt Text">
                        </div>

                        <div class="card mb-3 text-center d-flex justify-content-center align-items-center">
                            <h2>{{$service->name}}</h2>
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
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">IMAGE OF YOUR LOVED ONE:</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                        </div>

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
                        </div>

                        <div class="mb-3" id="manualPriestInput" style="display:none;">
                            <label for="manualPriest" class="form-label">Priest:</label>
                            <input type="text" name="manualPriest" id="manualPriest" class="form-control">
                        </div>

                        <div id="additionalContent" class="mb-3">
                        </div>
                        @guest
                        <a href="{{ route('login') }}" class="btn btn-primary w-100">Login First</a>
                        @else
                        <button type="submit" class="btn btn-primary w-100">Proceed</button>
                        @endguest
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection