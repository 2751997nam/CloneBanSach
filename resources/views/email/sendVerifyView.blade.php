@extends('layouts.email')
@section('title', 'Xác nhận tài khoản Book.com')

@section('logo')
    <img src="{{ $message->embed('logo_2.png') }}" alt="Book.com" style="width: 100px; height: 100px">
@endsection

@section('content')
    <div>
        <h1 style="font-weight: bold"> Xin Chào {{ $user->name }}!</h1>
        <p>Bạn chỉ còn một bước nữa thôi để tạo tài khoản trên Book.com. Nhấn link phía dưới để xác nhận email của bạn.</p>
    </div>
<p><a href="{{ route('verify.verifyEmailDone', ['email' => $user->email, 'verifyToken' => $user->verifyToken]) }}">Xác nhận email</a></p>
@endsection