@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.login') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h1>登陆小恶魔</h1>
</div>
<form class="form-horizontal" method="POST" action="{{ URL::to('user/login') }}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <fieldset>
        <div class="form-group">
            <label class="col-md-2 control-label" for="email">Email</label>
            <div class="col-md-10">
                <input class="form-control" tabindex="1" placeholder="请输入您的Email地址" type="text" name="email" id="email" value="{{ Input::old('email') }}" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="password">
                密码
            </label>
            <div class="col-md-10">
                <input class="form-control" tabindex="2" placeholder="请输入您的密码" type="password" name="password" id="password">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <div class="checkbox">
                    <label for="remember">记住我
                        <input type="hidden" name="remember" value="0">
                        <input tabindex="4" type="checkbox" name="remember" id="remember" value="1">
                    </label>
                </div>
            </div>
        </div>

        @if ( Session::get('error') )
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        @if ( Session::get('notice') )
        <div class="alert">{{ Session::get('notice') }}</div>
        @endif

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <button tabindex="3" type="submit" class="btn btn-primary">进入小恶魔</button>
                <a class="btn btn-default" href="forgot">忘记密码 ?</a>
            </div>
        </div>
    </fieldset>
</form>

@stop
