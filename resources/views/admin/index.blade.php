@extends('layouts.app')

@section('title', 'Admin')
@section('css')
    <style>
        .manager-options {
            display: inline-block;
            text-align: center;
            padding: 20px
        }
        .manager-options a {
            color: orangered;
        }
        .manager-options-image {
            width: 150px;
            height: 150px;
            margin: auto;
        }
        .manager-options-image img {
            width: 100%;
            height: 100%;
        }
        .manager-options-title {
            margin-top: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="container" style="margin-top: 50px">
        <div class="manager-options">
            <a href="{{ route('book.index') }}">
                <div class="manager-options-image">
                    <img src="{{ asset('/images/admin/book.png') }}" alt="books manager">
                </div>
                <div class="manager-options-title">
                    <span>Books Manager</span>
                </div>
            </a>
        </div>
        <div class="manager-options">
            <a href="{{ route('categories.index') }}">
                <div class="manager-options-image">
                    <img src="{{ asset('/images/admin/category.svg') }}" alt="categories manager">
                </div>
                <div class="manager-options-title">
                    <span>Categories Manager</span>
                </div>
            </a>
        </div>
        <div class="manager-options">
            <a href="{{ route('employees.index') }}">
                <div class="manager-options-image">
                    <img src="{{ asset('/images/admin/employee.png') }}" alt="employees manager">
                </div>
                <div class="manager-options-title">
                    <span>Employees Manager</span>
                </div>
            </a>
        </div>
        <div class="manager-options">
            <a href="{{ route('positions.index') }}">
                <div class="manager-options-image">
                    <img src="{{ asset('/images/admin/position.png') }}" alt="positions manager">
                </div>
                <div class="manager-options-title">
                    <span>Positions Manager</span>
                </div>
            </a>
        </div>
        <div class="manager-options">
            <a href="{{ route('users.index') }}">
                <div class="manager-options-image">
                    <img src="{{ asset('/images/admin/customer.png') }}" alt="customers manager">
                </div>
                <div class="manager-options-title">
                    <span>Customers Manager</span>
                </div>
            </a>
        </div>
        <div class="manager-options">
            <a href="{{ route('order.index') }}">
                <div class="manager-options-image">
                    <img src="{{ asset('/images/admin/order.png') }}" alt="orders manager">
                </div>
                <div class="manager-options-title">
                    <span>Orders Manager</span>
                </div>
            </a>
        </div>
        <div class="manager-options">
            <a href="{{ route('bills.index') }}">
                <div class="manager-options-image">
                    <img src="{{ asset('/images/admin/bill.png') }}" alt="bills manager">
                </div>
                <div class="manager-options-title">
                    <span>Bills Manager</span>
                </div>
            </a>
        </div>
        <div class="manager-options">
            <a href="javascript:document.getElementById('logout').submit()">
                <div class="manager-options-image">
                    <img src="{{ asset('/images/admin/logout.png') }}" alt="Logout">
                </div>
                <div class="manager-options-title">
                    <span> Logout</span>
                </div>
            </a>
            <form action="{{ route('logout') }}" method="POST" id="logout">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection