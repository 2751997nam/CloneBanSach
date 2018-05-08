@extends('layouts.master')
@section('title', 'Thông Tin Tài Khoản')
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
@endsection

@section('content')
    <div class="sidebar">
        <ul>
        <li><div href="javascript:void(0)"  role="button" id="showInformation" class="{{
        session()->has('page') ? (session()->get('page') === "/user/profile" ? "chose" : "") : "" }}">
                <i class="fas fa-user-circle "></i> Thông Tin Tài Khoản</div></li>
        <li><div href="javascript:void(0)" role="button" id="showOrder" class="{{
        session()->has('page') ? (session()->get('page') === "/user/showorder" ? "chose" : "") : "" }}">
                <i class="fas fa-list-ul"></i> Đơn Hàng</div></li>
        <li><a href="javascript:void(0)" id="changePassword" class="{{
        session()->has('page') ? (session()->get('page') === "/user/changepassword" ? "chose" : "") : "" }}">
                <i class="fas fa-key"></i> Đổi Mật Khẩu</a></li>
        <li><a href="javascript:document.getElementById('logout').submit()">
                <i class="fas fa-sign-out-alt"></i> Đăng Xuất</a></li>
        </ul>
    </div>
    <div class="content">

    </div>
@endsection

@section('script')
    <script>
        @if(session()->has('message'))
            alert("{{ session()->get('message') }}");
        @endif
        $(document).on('click', 'a.page-link', function (event) {
            event.preventDefault();
            ajaxLoad($(this).attr('href'));
        });
        function ajaxLoad(filename, content) {
            content = typeof content !== 'undefined' ? content : 'content';
            $.ajax({
                type: "GET",
                url: filename,
                contentType: false,
                success: function (data) {
                    $("." + content).html(data);
                },
                error: function (xhr) {
                    alert(xhr.responseText);
                }
            });
        }
        var page = "{{ session()->has('page') ? session()->get('page') : "" }}";
        function showPage(p) {
            $.ajax({
                url: p,
                method: "GET",
                success: function (result) {
                    $('.content').html(result);
                }
            });
        }
        function hightLight(element) {
            console.log(element);
            element.parents('li').siblings().children('div').removeClass('chose');
            element.addClass('chose');
        }
        $(document).ready(function () {
            showPage(page);
        });
        $('#showInformation').click(function () {
            showPage("/user/profile");
            hightLight($(this));
        });
        $('#showOrder').click(function () {
            showPage("/user/showOrder");
            hightLight($(this));
        });
        $('#changePassword').click(function () {
            showPage("/user/changepassword");
            hightLight($(this));
        });

    </script>
@endsection