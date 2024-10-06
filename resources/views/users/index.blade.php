@extends('layouts.header')
@section('title', 'OCMIS | Users')
<div class="sidebar">
    <ul class="sidebar-nav">
        <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
            <a href="{{ route('users') }}">USERS
            </a>
        </li>
    </ul>
</div>

<div class="container" style="margin-left: 120px;">

    <h1>USERS</h1>

    <div class="container" style="margin-left: 100px;">

        <table id="userTable" class="table table-layout" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div><br><br><br><br><br><br><br><br><br><br><br><br>
</div>


