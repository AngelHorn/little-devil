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
<form class="form-horizontal" method="POST" action="/user" accept-charset="UTF-8">
    {{Form::token()}}
    <div class="form-group">
        <label class="col-md-3 control-label" for="email"><span class="text-danger">*</span>Email
            <small>(电子邮箱)</small>
        </label>

        <div class="col-md-9">
            <input class="form-control" placeholder="请输入您的Email地址 找回密码以及登陆时使用" type="text" name="email" id="email"
                   value="{{Input::old('email')}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="password"><span class="text-danger">*</span>Password
            <small>(密码)</small>
        </label>

        <div class="col-md-9">
            <input class="form-control" placeholder="请输入您的密码 最小4位" type="password" name="password" id="password">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="password_confirmation"><span
                class="text-danger">*</span>Password Confirm
            <small>(确认密码)</small>
        </label>

        <div class="col-md-9"><input class="form-control" placeholder="请再输入一次您的密码以便确认 最小4位" type="password"
                                     name="password_confirmation"
                                     id="password_confirmation">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="username"><span class="text-danger">*</span>Name
            <small>(姓名)</small>
        </label>

        <div class="col-md-9">
            <input class="form-control" placeholder="请输入您的姓名 不可为空" type="text" name="username" id="username"
                   value="{{Input::old('name')}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="tel">Tel
            <small>(手机号码)</small>
        </label>

        <div class="col-md-9">
            <input class="form-control" placeholder="手机号码会自动录入到订单信息 推荐填写" type="text" name="tel" id="tel"
                   value="{{Input::old('tel')}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="address">Address
            <small>(地址)</small>
        </label>

        <div class="col-md-9">
            <input class="form-control" placeholder="地址会自动录入到订单信息 推荐填写" type="text" name="address" id="address"
                   value="{{Input::old('address')}}">
        </div>
    </div>


    <div class="form-actions form-group">
        <div class="col-md-offset-3 col-md-9">
            <button type="submit" class="btn btn-success">Sign Up <small>(创建账户)</small></button>
        </div>
    </div>

</form>
@stop
