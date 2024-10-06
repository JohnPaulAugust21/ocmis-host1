@extends('layouts.clientnav')

@section('content')

<div class="center-container mt-5 mb-5 d-flex justify-content-center align-items-center">
    <div class="card w-50 rounded-3">
        <div class="card-body">
            <h2>Create Memorial</h2>

            <form method="POST" action="{{ route('storeMemorial') }}" enctype="multipart/form-data">
                @csrf
                {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif --}}


                <div class="form-group">
                    <label for="deceasedName">Deceased Name:</label>
                    <input type="text" class="form-control" id="deceasedName" name="deceasedName" required>
                </div>

                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                </div>

                {{-- <div class="form-group">
                    <label for="startDateTime">Start Date and Time:</label>
                    <input type="datetime-local" class="form-control" id="startDateTime" name="startDateTime" required>
                </div> --}}

                <div class="form-group">
                    <label for="endDateTime"> Date and Time:</label>
                    <input type="datetime-local" class="form-control" id="endDateTime" name="date_time" required>
                </div>

                {{-- <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div> --}}



                <div class="form-group">
                    <label for="images">Images: (can be multiple)</label>
                    <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple required>
                </div>


                <div class="mb-3">
                    <label class="form-label">PAYMENT METHOD:</label>
                    <div class="form-check">
                        <input type="radio" id="CASH" name="paymentmethodMemorial" value="CASH"
                            class="form-check-input" checked>
                        <label for="CASH" class="form-check-label">Cash</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="GCASH" name="paymentmethodMemorial" value="GCASH"
                            class="form-check-input">
                        <label for="GCASH" class="form-check-label">GCash</label>
                    </div>
                </div>

                <div id="additionalContentMemorial" class="mb-3" style="display: none;">
                    <img src="/images/gcash.jpg" class="h-50 w-50 mx-auto d-block" alt="GCash Image"><br>
                    <label for="refImage" class="form-check-label">Image for Gcash receipt</label>
                    <input type="file" class="form-control" id="refImage" name="refImage" accept="image/*" >
                    
                </div>

                <!-- <button type="submit" class="btn btn-primary mt-3 pr-5 pl-5" style="width: 100%">Create Memorial</button> -->
                <button type="submit" class="btn btn-primary mt-3 pr-5 pl-5" style="width: 100%">Create Memorial</button>


            </form>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Initially hide the additionalContentMemorial div
        $("#additionalContentMemorial").hide();

        // Listen for change event on radio buttons
        $("input[name='paymentmethodMemorial']").change(function () {
            // Check if GCASH radio button is selected
            if ($(this).val() === "GCASH") {
                // Show the additionalContentMemorial div
                $("#additionalContentMemorial").css('display', 'block');
                $("#refImage").attr('required', 'required');
                // $('#officialSelectOrgDiv').css('display', 'block');
            } else {
                // Hide the additionalContentMemorial div
                $("#refImage").removeAttr('required');
                $("#additionalContentMemorial").css('display', 'none');
            }
        });

        // Trigger change event on radio buttons to initialize the visibility
        // $("input[name='paymentmethod']:checked").trigger("change");
    });
</script>
@endsection
