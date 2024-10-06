@extends('layouts.header')
@section('title', 'OCMIS | Services')

<style>
    .center-container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .transparent-box {
        /* Add any additional styling you want for the transparent box */
        background-color: #fff;
        padding: 20px;
    }
</style>
<div class="sidebar">
    <ul class="sidebar-nav">
        <li class="{{ request()->is('admin/services/category*') ? 'active' : '' }}">
            <a href="{{ route('services') }}">Category
            </a>
        </li> 
        <li class="{{ request()->is('admin/services/priest*') ? 'active' : '' }}">
            <a href="{{ route('priests') }}">Priest
            </a>
        </li>
        <li class="{{ request()->is('admin/services/service*') ? 'active' : '' }}">
            <a href="{{ route('serviceList') }}">Service Transactions
            </a>
        </li>
        <li class="{{ request()->is('admin/services/sale*') ? 'active' : '' }}">
            <a href="{{ route('serviceSales') }}">Sales
            </a>
        </li>
    </ul>
</div>
<div class="center-container">
    <div class="transparent-box">
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

        <div class="container"
            style="display: flex;flex-direction: column;align-items: center; justify-content: center; height: 100vh;">
            <h2>EDIT SERVICE</h2>
            <form action="{{ route('updateServiceList', ['id' => $servicelist->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
               
               
                <label for="status">STATUS: 
                    <select id="status" name="status">
                        <option value="Not Paid" @if ($servicelist->status == 'Not Paid') selected @endif>Not Paid</option>
                        <option value="Paid" @if ($servicelist->status == 'Paid') selected @endif>Paid</option>
                        <option value="Cancelled" @if ($servicelist->status == 'Cancelled') selected @endif>Cancelled</option>
                    </select>
                </label>
            
                <button class="submit-button" type="submit" style="margin-left: 100px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="189" height="63" viewBox="0 0 189 63" fill="none">
                        <path d="M0 0H189V63H0V0Z" fill="url(#paint0_linear_104_94)"/>
                        <defs>
                            <linearGradient id="paint0_linear_104_94" x1="109.941" y1="-2.26211e-08" x2="109.941" y2="63" gradientUnits="userSpaceOnUse">
                                <stop offset="0.911458" stop-color="#23231F"/>
                                <stop offset="1" stop-color="#6A4D4D" stop-opacity="0"/>
                            </linearGradient>
                        </defs>
                    </svg><span>UPDATE</span>
                </button>
            </form>
            

        </div>
    </div>
</div>