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

<div class="container" style="margin-left: 120px;">

    <h1>Buildings</h1>



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
            <a href="{{route('createBuilding')}}" class="svg-link">
                <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512">
                    <path
                        d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344V280H168c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H280v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                </svg>
                <span>Add Building</span>
            </a>
        </div>

        <table id="buildingTable" class="table table-layout">
            <thead>
                <tr>
                    <th>Building ID</th>
                    <th>Building Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div><br><br><br><br><br><br><br><br><br><br><br><br>
</div>