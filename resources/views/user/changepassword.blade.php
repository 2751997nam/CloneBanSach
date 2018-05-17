@extends('layouts.user')

@section('title', 'Đổi mật khẩu')

@section('style')
<style>
    .invalid-feedback {
        color: red;
    }
</style>
@endsection

@section('usercontent')
<div class="col-md-8 offset-md-2">
    {!! Form::model($user,['url' => route('user.storePassword', ['id' => $user->id]),'method'=>'put','id'=>'frm']) !!}
    <div class="form-group row required">
        {!! Form::label("oldPassword","Mật khẩu cũ",["class"=>"col-form-label col-md-4 col-lg-3"]) !!}
        <div class="col-md-7">
            {!! Form::password("oldPassword",["class"=>"form-control"]) !!}
            <span id="error-name" class="invalid-feedback">{{ session()->has('oldPassword') ? session()->get('oldPassword') : "" }}</span>
        </div>
    </div>

    <div class="form-group row required">
        {!! Form::label("newPassword","Mật khẩu mới",["class"=>"col-form-label col-md-4 col-lg-3"]) !!}
        <div class="col-md-7">
            {!! Form::password("newPassword",["class"=>"form-control"]) !!}
            <span id="error-name" class="invalid-feedback">{{ session()->has('newPassword') ? session()->get('newPassword') : "" }}</span>
        </div>
    </div>

    <div class="form-group row required">
        {!! Form::label("comfirmPassword","Nhập lại mật khẩu mới",["class"=>"col-form-label col-md-4 col-lg-3"]) !!}
        <div class="col-md-7">
            {!! Form::password("comfirmPassword",["class"=>"form-control"]) !!}
            <span id="error-name" class="invalid-feedback">{{ session()->has('comfirmPassword') ? session()->get('comfirmPassword') : "" }}</span>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-4 col-lg-3"></div>
        <div class="col-md-4">
            {!! Form::button("Save",["type" => "submit","class"=>"btn btn-primary btn-xs"])!!}
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