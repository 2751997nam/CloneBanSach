@extends('layouts.master')

@section('css')
    <style>
        li {
            padding: 5px 0;
            list-style: none;
            text-decoration: none;
        }
        .sidebar {
            float: left;
        }
        .content {
            width: 85%;
            margin-left: 20px;
            /*background-color: white;*/
            float: top;
            display: inline-block;
        }
        .chose {
            color: orangered;
        }
    </style>
    @yield('style')
@endsection

@section('content')
    <div class="sidebar">
        <ul>
            <li><a href="{{ route('user.profile') }}">
                    <i class="fas fa-user-circle "></i> Thông Tin Tài Khoản</a></li>
            <li><a href="{{ route('user.showOrder') }}">
                    <i class="fas fa-list-ul"></i> Đơn Hàng</a></li>
            <li><a href="{{ route('user.changePassword') }}">
                    <i class="fas fa-key"></i> Đổi Mật Khẩu</a></li>
            <li><a href="javascript:document.getElementById('logout').submit()">
                    <i class="fas fa-sign-out-alt"></i> Đăng Xuất</a></li>
        </ul>
    </div>
    <div class="content">
        @yield('usercontent')
    </div>
@endsection