@extends('layouts.clientnav')

@section('content')
    <section class="py-5 " style="min-height: 80svh" x-data="main({{ $errors }})">

        <form action="{{ route('userSettingUpdate') }}" method="POST">
            @csrf
            <div class="d-flex flex-wrap justify-content-around gap-1">
                @if (Session::has('success'))
                    <div class="alert alert-success col-11" role="alert">
                        Updated Successfully!
                    </div>
                @endif
                @if (Session::has('password_success'))
                    <div class="alert alert-success col-11" role="alert">
                        Password Updated Successfully!
                    </div>
                @endif
                <div class="col-lg-5 col-sm-5 col-11">
                    <label>LAST NAME: </label>
                    <input type="text" id="lastname" class="form-control " name="lastname"
                        value="{{ Auth::user()->lastname }}" :readonly="edit ? false : true"
                        :style="edit ? '' : ' background:#D3D3D3;cursor:not-allowed;'" required>
                </div>

                <div class="col-lg-5 col-sm-5  col-11">
                    <label>FIRST NAME: </label>
                    <input type="text" id="firstname" class="form-control" :readonly="edit ? false : true"
                        :style="edit ? '' : ' background:#D3D3D3;cursor:not-allowed;'" name="firstname"
                        value="{{ Auth::user()->firstname }}" required>
                </div>

                <div class="col-lg-5 col-sm-5  col-11">
                    <label>MIDDLE NAME:</label>
                    <input type="text" id="middlename" class="form-control" :readonly="edit ? false : true"
                        :style="edit ? '' : ' background:#D3D3D3;cursor:not-allowed;'" name="middlename"
                        value="{{ Auth::user()->middlename }}">
                </div>

                <div class="col-lg-5 col-sm-5  col-11">
                    <label>ADDRESS:</label>
                    <input type="text" id="address " class="form-control" :readonly="edit ? false : true"
                        :style="edit ? '' : ' background:#D3D3D3;cursor:not-allowed;'" name="address" required
                        value="{{ Auth::user()->address }}">
                </div>

                <div class="col-lg-5 col-sm-5  col-11">
                    <label>EMAIL:</label>
                    <input type="email" id="email" class="form-control" :readonly="edit ? false : true"
                        :style="edit ? '' : ' background:#D3D3D3;cursor:not-allowed;'" name="email" required
                        value="{{ Auth::user()->email }}">
                </div>

                <div class="col-lg-5 col-sm-5  col-11">
                    <label>CONTACT NUMBER:</label>
                    <input type="text" id="contactnumber" class="form-control" :readonly="edit ? false : true"
                        :style="edit ? '' : ' background:#D3D3D3;cursor:not-allowed;'" name="contactnumber" required
                        value="{{ Auth::user()->contactnumber }}">
                </div>
                <div class="d-flex justify-content-end mt-4 gap-2 col-11 ">
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" x-ref="passwords" x-show="edit == false" class="btn btn-danger col-lg-2">
                        <span>Change password</span>
                    </button>
                    <button type="button" x-show="edit == false" x-on:click="edit = !edit"
                        class="btn btn-success col-lg-2">
                        <span>Edit</span>
                    </button>
                    <button x-show="edit" x-on:click="edit = !edit" class="btn btn-success col-lg-2" type="submit">
                        <span>Update</span>
                    </button>
                </div>
            </div>
            {{-- <div>
                <label>USERNAME: <input type="text" id="username" class="form-control"  name="username" required></label>
            </div> --}}
            {{-- <label>PASSWORD: <input type="password" id="password" class="form-control"  name="password"></label>
            <label>CONFIRM PASSWORD: <input type="password" class="form-control"  id="confirmpassword" name="confirmpassword"></label> --}}

        </form>



        <!-- Modal -->
        <div class="modal fade "  id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('userSettingUpdatePassword') }}" method="POST" class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Password</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            @csrf
                            <div class="d-flex flex-wrap justify-content-around gap-2">





                                <div class="col-11">
                                    <label>PASSWORD:</label>
                                    <input type="password" class="form-control"  name="password" required value="{{ old('password') }}"
                                        >
                                    @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-11">
                                    <label>CONFIRM PASSWORD:</label>
                                    <input type="password"  class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}"  required
                                       >
                                       @error('password_confirmation')
                                       <small class="text-danger">{{ $message }}</small>
                                       @enderror
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Change password</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('main', (err) => ({
                edit: false,
                errors: err,
                init()
                {
                    if(this.errors.password || this.errors.password_confirmation)
                    {
 this.$refs.passwords.click()
                    }

                }
            }))
        })
    </script>
@endpush
