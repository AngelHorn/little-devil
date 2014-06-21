@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.register') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1>注册小恶魔</h1>
</div>
<form method="POST" action="/user" accept-charset="UTF-8">
    {{Form::token()}}
    <fieldset>
        <div class="form-group">
            <label for="email">Email
                <small>找回密码以及登陆时使用</small>
            </label>
            <input class="form-control" placeholder="请输入您的Email地址" type="text" name="email" id="email" value="{{Input::old('email')}}">
        </div>
        <div class="form-group">
            <label for="password">密码</label>
            <input class="form-control" placeholder="请输入您的密码" type="password" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">确认密码</label>
            <input class="form-control" placeholder="请再输入一次您的密码以便确认" type="password" name="password_confirmation"
                   id="password_confirmation">
        </div>
        <div class="form-group">
            <label for="username">姓名</label>
            <input class="form-control" placeholder="请输入您的姓名" type="text" name="username" id="username" value="{{Input::old('name')}}">
        </div>
        <div class="form-group">
            <label for="tel">手机号码</label>
            <input class="form-control" placeholder="请输入手机号码" type="text" name="tel" id="tel" value="{{Input::old('tel')}}">
        </div>
        <div class="form-group">
            <label for="address">地址</label>
            <input class="form-control" placeholder="请输入您的地址" type="text" name="address" id="address" value="{{Input::old('address')}}">
        </div>


        <div class="form-actions form-group">
            <button type="submit" class="btn btn-primary">创建账户</button>
        </div>

    </fieldset>
</form>
@stop
