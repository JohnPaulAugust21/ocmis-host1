@extends('layouts.clientnav')

@section('content')
    <section class="py-5 bg-dark-2">
        <div class="row gx-4 gx-lg-5 row-cols-1 justify-content-center ">
            <div class="col-md-9">
                <div class="card mb-4 text-white" style="background-color:rgba(253, 247, 191, .17);">
                    <div class="card-body">

                        <div class="p-2">

                            <p style="line-height: 0%" class="fw-bold fs-5">Niche {{ $niche->level }}-{{ $niche->niche_number }}</p>
                            <p  class="fw-bold fs-5">Locaton: {{ $niche->buildingInfo?->name }} - niche {{ $niche->level }}-{{ $niche->niche_number }}</p>
                            <div class="py-5 d-flex gap-5">
                                {{-- left --}}
                                <div class="d-flex flex-column align-items-center">
                                    <p style="line-height: 0%" class="fs-5 text-center fw-bold">Urn {{ $niche->urnInfo?->urn_number }}</p>
                                    @if ($niche->ownerInfo && $niche->ownerInfo?->owner_photo )

                                    @else
                                    <img src="{{ asset('images/urn.jpg') }}" alt="">
                                    @endif
                                    <p class="fs-5 text-center">[Firstname ,Lastname]</p>
                                    <p style="line-height: 3px" class=" text-center">[Birth Date]</p>
                                    <p style="line-height: 0%" class=" text-center">[Death Date]</p>

                                </div>

                                {{-- right --}}
                                <div style="width: 100%;">
                                    <form action="{{ route('postNicheUpdate',['id'=>$niche->niche_id]) }}" method="POST" enctype="multipart/form-data" class="row gap-3">
                                        @csrf
                                        <div class="d-flex align-items-center justify-content-end gap-4">
                                            <label for="" class="whitespace-nowrap fs-5 fw-bold" style="white-space: nowrap">LAST NAME:</label>
                                            <input type="text" class="form-control" required name="lastname" value="{{ $niche->ownerInfo?->lastname }}">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end  gap-4">
                                            <label for="" class="whitespace-nowrap fs-5 fw-bold" style="white-space: nowrap">FIRST NAME:</label>
                                            <input type="text" class="form-control" required name="firstname" value="{{ $niche->ownerInfo?->firstname }}">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end  gap-4">
                                            <label for="" class="whitespace-nowrap fs-5 fw-bold" style="white-space: nowrap">BIRTHDATE:</label>
                                            <input type="date" class="form-control" required name="birthdate" value="{{ $niche->ownerInfo?->birth_date }}">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end  gap-4">
                                            <label for="" class="whitespace-nowrap fs-5 fw-bold" style="white-space: nowrap">DEATHDATE:</label>
                                            <input type="date" class="form-control" required name="deathdate" value="{{ $niche->ownerInfo?->death_date }}">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end  gap-4">
                                            <label for="" class="whitespace-nowrap fs-5 fw-bold" style="white-space: nowrap">MESSAGE:</label>
                                            <textarea name="biography" class="form-control" required value="{{ $niche->ownerInfo?->biography }}"  rows="2">{{ $niche->ownerInfo?->biography }}</textarea>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end  gap-4">
                                            <label for="" class="whitespace-nowrap fs-5 fw-bold" style="white-space: nowrap">Photo:</label>
                                            <input type="file" name="owner_photo" class="form-control" >
                                        </div>
                                       <div class="d-flex align-items-center justify-content-center  gap-4">
                                        <button type="submit" class="text-decoration-none bg-dark py-2 px-5 text-white rounded-2 "
                                            style="width: fit-content">Update Urn Slot</button>
                                       </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
