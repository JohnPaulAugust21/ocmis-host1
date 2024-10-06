@extends('layouts.header')
@section('title', 'OCMIS | Shop')

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
        <li class="{{ request()->is('admin/shop/transaction*') ? 'active' : '' }}">
            <a href="{{ route('shopTransactionView') }}">Transaction
            </a>
        </li>
        <li class="{{ request()->is('admin/shop/categor*') ? 'active' : '' }}">
            <a href="{{ route('shopCategories') }}">Category
            </a>
        </li>
        <li class="{{ request()->is('admin/shop/sellers*') ? 'active' : '' }}">
            <a href="{{ route('sellers') }}">Seller
            </a>
        </li>
        <li class="{{ request()->is('admin/shop/product*') ? 'active' : '' }}">
            <a href="{{ route('products') }}">Products
            </a>
        </li>
        <li class="{{ request()->is('admin/shop/sales*') ? 'active' : '' }}">
            <a href="{{ route('shopSales') }}">Sales
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
            <h2>EDIT CATEGORY</h2>
            <form action="{{ route('updateShopCategory', ['id' => $shopcategory->category_id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <label for="name">CATEGORY NAME: <input type="text" id="name" name="name" value ="{{$shopcategory->name}}" required></label>
                
                <label for="status">STATUS:
                    <select id="status" name="status">
                        <option value="Active" @if($shopcategory->status == 'Active') selected @endif>ACTIVE</option>
                        <option value="Inactive" @if($shopcategory->status == 'Inactive') selected @endif>INACTIVE</option>
                    </select>
                </label>
                
                <label for="image">CHOOSE AN IMAGE: 
                    <input type="file" name="image" id="image" accept="image/*" required>
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