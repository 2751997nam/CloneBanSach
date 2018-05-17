@extends('layouts.user')
@section('title', 'Thông tin tài khoản')

@section('style')
    <style>
        .invalid-feedback {
            color: red;
        }
    </style>
@endsection
@section('usercontent')
<div class="col-md-8 offset-md-2">
    {!! Form::model($user,['url' => route('users.update', ['id' => $user->id]),'method'=>'put','id'=>'frm']) !!}
    <div class="form-group row required">
        {!! Form::label("name","Họ và Tên",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
        <div class="col-md-8">
            {!! Form::text("name",null,["class"=>"form-control".($errors->has('name')?" is-invalid":""),"autofocus",'placeholder'=>'Full Name']) !!}
            <span id="error-name" class="invalid-feedback">{{ $errors->has('name') ? $errors->first('name') : "" }}</span>
        </div>
    </div>

    {{--<div class="form-group row required">--}}
        {{--{!! Form::label("email","Email",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}--}}
        {{--<div class="col-md-8">--}}
            {{--{!! Form::text("email",null,["class"=>"form-control".($errors->has('email')?" is-invalid":""),"autofocus",'placeholder'=>'Email']) !!}--}}
            {{--<span id="error-email" class="invalid-feedback">{{ $errors->has('email') ? $errors->first('email')  : "" }}</span>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="form-group row">
        <label class="col-form-label col-md-3 col-lg-2">Email</label>
        <div class="col-md-8">
            <span> {{ $user->email }}</span>
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label("phone","SĐT",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
        <div class="col-md-8">
            {!! Form::text("phone", $information->phone ,["class"=>"form-control".($errors->has('phone')?" is-invalid":""),"autofocus",'placeholder'=>'Phone Number']) !!}
            <span id="error-phone" class="invalid-feedback">{{ $errors->has('phone') ? $errors->first('phone')  : "" }}</span>
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label("dob","Ngày Sinh",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
        <div class="col-md-8">
            {!! Form::date("dob", $information->dob,["class"=>"form-control".($errors->has('dob')?" is-invalid":"")]) !!}
            <span id="error-email" class="invalid-feedback">{{ $errors->has('dob') ? $errors->first('dob')  : "" }}</span>
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label("gender", "Giới Tính", ["class" => "col-form-label col-md-3 col-lg-2"]) !!}
        <div class="col-md-8">
            Nam
            {!! Form::radio('gender', 'nam', $information->gender === "nam" ? true : false) !!}
            Nu
            {!! Form::radio('gender', 'nu', $information->gender === "nam" ? false : true) !!}
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3 col-lg-2"></div>
        <div class="col-md-4">
            {!! Form::button("Lưu",["type" => "submit","class"=>"btn btn-primary btn-xs"])!!}
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection

@section('script')
    <script>
        @if(session()->has('message'))
        alert('{{ session()->get('message') }}');
        @endif
    </script>
@endsection