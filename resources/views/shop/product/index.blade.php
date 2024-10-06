@extends('layouts.header')
@section('title', 'OCMIS | Shop')
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

<div class="container" style="margin-left: 120px;">
    <h1>Products</h1>
    <div class="container" style="margin-left: 100px;">
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
        <div class="svg-container" style="margin-left: 1028px; margin-bottom: 20px">
            <a href="{{route('createProduct')}}" class="svg-link">
                <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512">
                    <path
                        d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344V280H168c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H280v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                </svg>
                <span>Add Product</span>
            </a>
        </div>

        <table id="productTable" class="table table-layout">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Seller</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div><br><br><br><br><br><br><br><br><br><br><br><br>
</div>