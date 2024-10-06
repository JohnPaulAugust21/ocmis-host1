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
        <h2>CREATE BUILDING</h2>
        <form action="{{route('postCreateBuilding')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label>BUILDING NAME: <input type="text" id="name" name="name" required></label>
            <label for="image">CHOOSE AN IMAGE:
                <input type="file" name="image" id="image" accept="image/*" required>
            </label>

            <button class="submit-button" type="submit" style="margin-left: 100px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="189" height="63" viewBox="0 0 189 63" fill="none">
                    <path d="M0 0H189V63H0V0Z" fill="url(#paint0_linear_104_94)" />
                    <defs>
                        <linearGradient id="paint0_linear_104_94" x1="109.941" y1="-2.26211e-08" x2="109.941" y2="63"
                            gradientUnits="userSpaceOnUse">
                            <stop offset="0.911458" stop-color="#23231F" />
                            <stop offset="1" stop-color="#6A4D4D" stop-opacity="0" />
                        </linearGradient>
                    </defs>
                </svg><span>CREATE</span>
            </button>
    </div>
    </form>
</div>
</div>

<br><br>