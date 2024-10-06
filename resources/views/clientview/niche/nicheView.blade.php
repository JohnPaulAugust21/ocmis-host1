@extends('layouts.clientnav')

@section('content')
    <section class="py-5 bg-dark-2">
        <div class="row gx-4 gx-lg-5 row-cols-1 justify-content-center ">
            <div class="col-md-9">
                <div class="card mb-4 text-white" style="background-color:rgba(253, 247, 191, .17);">
                    <div class="card-body">

                        <div class="p-2">
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    Updated Successfully!
                                </div>
                            @endif
                            <p style="line-height: 0%" class="fw-bold fs-5">Niche
                                {{ $niche->level }}-{{ $niche->niche_number }}</p>
                            <p class="fw-bold fs-5">Locaton: {{ $niche->buildingInfo?->name }} - niche
                                {{ $niche->level }}-{{ $niche->niche_number }}</p>
                            <div class="py-5 d-flex gap-5">
                                {{-- left --}}
                                <div class="d-flex flex-column align-items-center">
                                    <p style="line-height: 0%" class="fs-5 text-center fw-bold">Urn
                                        {{ $niche->urnInfo?->urn_number }}</p>

                                    <img src="{{ asset('images/urn.jpg') }}" alt="">
                                    <p class="fs-5 text-center">
                                        @if ($niche->ownerInfo && $niche->ownerInfo?->firstname)
                                            {{ $niche->ownerInfo?->firstname . ' ' . $niche->ownerInfo?->lastname }}
                                        @else
                                            [Firstname ,Lastname]
                                        @endif
                                    </p>
                                    <p style="line-height: 3px" class=" text-center">
                                        @if ($niche->ownerInfo && $niche->ownerInfo?->birth_date)
                                            {{ \Carbon\Carbon::parse($niche->ownerInfo?->birth_date)->isoFormat('MMMM D, Y') }}
                                        @else
                                            [Birth Date]
                                        @endif
                                    </p>
                                    <p style="line-height: 0%" class=" text-center">
                                        @if ($niche->ownerInfo && $niche->ownerInfo?->death_date)
                                            {{ \Carbon\Carbon::parse($niche->ownerInfo?->death_date)->isoFormat('MMMM D, Y') }}
                                        @else
                                            [Death Date]
                                        @endif
                                    </p>
                                    @if (Auth::check() && Auth::id() == $niche->user_id)
                                        <a href="{{ route('nicheUpdate', ['id' => $niche->niche_id]) }}"
                                            class="text-decoration-none bg-dark py-2 px-5 text-white rounded-2 "
                                            style="width: fit-content">Update</a>
                                    @endif
                                </div>

                                {{-- right --}}
                                <div style="width: 100%;">
                                    <p style="line-height: 0%" class="fw-bold fs-5">In Loving Memory of Jose Rizal</p>
                                    <div class="d-flex justify-content-center">

                                        @if ($niche->ownerInfo && $niche->ownerInfo?->owner_photo)
                                            <img src="{{ asset($niche->ownerInfo?->owner_photo) }}" class="rounded-5"
                                                style="min-height:10rem;max-height:10rem;min-width:10rem;max-width:10rem;object-fit: cover;"
                                                alt="">
                                        @else
                                            <img src="{{ asset('images/no_image.png') }}" class="rounded-5"
                                                style="min-height:10rem;max-height:10rem;min-width:10rem;max-width:10rem;object-fit: cover;"
                                                alt="">
                                        @endif
                                    </div>
                                    <hr>
                                    <p>
                                        @if ($niche->ownerInfo && $niche->ownerInfo?->firstname)
                                            As we hold this urn, we hold not just the remains, but the cherished memories of
                                            a life well-lived.
                                            {{ $niche->ownerInfo?->firstname . ' ' . $niche->ownerInfo?->lastname }}'s
                                            laughter, kindness, and love will forever resonate in our hearts.
                                        @else
                                            As we hold this urn, we hold not just the remains, but the cherished memories of
                                            a life well-lived. [Deceased Name]'s laughter, kindness, and love will forever
                                            resonate in our hearts.
                                        @endif

                                    </p>
                                    <p>
                                        @if ($niche->ownerInfo && $niche->ownerInfo?->firstname)
                                            Though we may part with the physical presence, the spirit of
                                            {{ $niche->ownerInfo?->firstname . ' ' . $niche->ownerInfo?->lastname }}
                                            remains a guiding light, illuminating our paths with warmth and wisdom.
                                        @else
                                            Though we may part with the physical presence, the spirit of [Deceased Name]
                                            remains a guiding light, illuminating our paths with warmth and wisdom.
                                        @endif

                                    </p>
                                    <p>May this urn serve as a vessel of remembrance, a sanctuary where love continues to
                                        bloom eternally.</p>
                                    <p>With deepest love and fondest memories,
                                        <br>
                                        [Client's Name]
                                    </p>
                                    <p>
                                        Message from the family:
                                        <br>
                                        @if ($niche->ownerInfo?->biography)
                                            <q>{!! $niche->ownerInfo?->biography !!}</q>
                                        @else
                                        [Message]
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
