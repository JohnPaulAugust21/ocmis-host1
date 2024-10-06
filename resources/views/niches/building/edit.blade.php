@extends('layouts.header')
@section('title', 'OCMIS | Niches')
<div class="sidebar">
    <ul class="sidebar-nav">
        <li class="{{ request()->is('admin/niches/building*') ? 'active' : '' }}">
            <a href="{{ route('buildings') }}">Buildings
            </a>
        </li>
        <li class="{{ request()->is('admin/niches/index*') ? 'active' : '' }}">
            <a href="{{ route('niches') }}">Niches
            </a>
        </li>
        <li class="{{ request()->is('admin/niches/urn*') ? 'active' : '' }}">
            <a href="{{ route('urns') }}">Urn
            </a>
        </li>
        <li class="{{ request()->is('admin/niches/sale*') ? 'active' : '' }}">
            <a href="{{ route('nichesSales') }}">Sales
            </a>
        </li>
    </ul>
</div>


<div style="align-items: center; justify-content: center; display: flex; margin-left: 180px;">

    <div class="transparent-box" style=" top: 30px;">
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
        <h2>EDIT BUILDING</h2>
        <form action="{{ route('updateBuilding', ['id' => $building->building_id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="name">Category Name:</label>
            <input type="text" id="name" name="name" value="{{$building->name}}">

            <label for="image">Current Image:</label>
            <img src="/storage/{{$building->image}}" alt="Current Image" class="table-image" />
            <label for="new_image">Upload New Image:</label>
            <input type="file" id="new_image" name="new_image" >


            <button class="submit-button" type="submit" style="margin-left: 100px;">
                <svg xmlns='http://www.w3.org/2000/svg' width='189' height='63' viewBox='0 0 189 63' fill='none'>
                    <path d='M0 0H189V63H0V0Z' fill='url(#paint0_linear_121_204)' />
                    <defs>
                        <linearGradient id='paint0_linear_121_204' x1='109.941' y1='0' x2='109.941' y2='63'
                            gradientUnits='userSpaceOnUse'>
                            <stop offset='0.911458' stop-color='#2C5C7C' stop-opacity='0.890625' />
                            <stop offset='1' stop-color='#6A4D4D' stop-opacity='0' />
                        </linearGradient>
                    </defs>
                </svg><span>UPDATE</span>
            </button>

        </form>
    </div>
</div>

<br><br>