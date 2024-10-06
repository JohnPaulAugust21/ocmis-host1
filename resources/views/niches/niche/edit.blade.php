@extends('layouts.header')
@section('title', 'OCMIS | Niches')

<style>
    .center-container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .transparent-box {
        background-color: #fff;
        padding: 20px;
    }
</style>
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
            <h2>EDIT NICHE</h2>
            <form action="{{ route('updateNiche', ['id' => $niche->niche_id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <label>NICHE NUMBER: <input type="number" id="niche_number" name="niche_number"
                        value="{{ old('niche_number', $niche->niche_number) }}" required></label>

                <div style="display: flex; align-items: center; margin-bottom: 20px">
                    <label for="building_id" style="margin-right: 10px;">Building:</label>
                    <select name="building_id" id="building_id">
                        @forelse ($buildings as $building)
                        <option value="{{ $building->building_id }}" {{ old('building_id', $niche->building_id) ==
                            $building->building_id ? 'selected' : '' }}>
                            {{ $building->name }}</option>
                        @empty
                        <option value="">No Buildings available</option>
                        @endforelse
                    </select>
                </div>

                <label>CAPACITY: <input type="number" id="capacity" name="capacity"
                        value="{{ old('capacity', $niche->capacity) }}" required></label>

                <label for="status">STATUS:
                    <select id="status" name="status">
                        <option value="Available" {{ old('status', $niche->status) == 'Available' ? 'selected' : '' }}>
                            Available</option>
                        <option value="Occupied" {{ old('status', $niche->status) == 'Occupied' ? 'selected' : '' }}>
                            Occupied</option>
                            <option value="Pending" {{ old('status', $niche->status) == 'Pending' ? 'selected' : '' }}>
                                Pending</option>
                        
                    </select>
                </label>

                <label for="level_id">LEVEL:
                    <select id="level_id" name="level_id">
                        @for ($i = 1; $i <= 6; $i++) <option value="{{ $i }}" {{ old('level_id', $niche->level_id) == $i
                            ? 'selected' : '' }}>
                            Level {{ $i }}</option>
                            @endfor
                    </select>
                </label>

                <label for="image">CHOOSE AN IMAGE:
                    <input type="file" name="image" id="image" accept="image/*">
                </label>

                <button class="submit-button" type="submit" style="margin-left: 100px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="189" height="63" viewBox="0 0 189 63" fill="none">
                        <path d="M0 0H189V63H0V0Z" fill="url(#paint0_linear_104_94)" />
                        <defs>
                            <linearGradient id="paint0_linear_104_94" x1="109.941" y1="-2.26211e-08" x2="109.941"
                                y2="63" gradientUnits="userSpaceOnUse">
                                <stop offset="0.911458" stop-color="#23231F" />
                                <stop offset="1" stop-color="#6A4D4D" stop-opacity="0" />
                            </linearGradient>
                        </defs>
                    </svg><span>UPDATE</span>
                </button>
            </form>
        </div>
    </div>
</div>