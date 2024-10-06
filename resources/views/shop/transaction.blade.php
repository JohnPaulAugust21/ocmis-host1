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

    <h1>Transactions</h1>



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
        <table id="shopTransactionTable" class="table table-layout">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Receipt No</th>
                    <th>Product Name</th>
                    <th>Qty</th>
                    <th>Date</th>
                    <th>Pending</th>
                    
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div><br><br><br><br><br><br><br><br><br><br><br><br>
</div>