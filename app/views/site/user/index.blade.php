@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.settings') }}} ::
@parent
@stop

{{-- New Laravel 4 Feature in use --}}
@section('styles')
@parent
#order-list .table{
margin-bottom: 0px;
}
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h3>The Central Of User
        <small>用户中心</small>
    </h3>
</div>
<!-- Nav tabs -->
<ul class="nav nav-tabs nav-justified" style="margin-bottom: 15px;">
    <li class="active"><a href="#order" data-toggle="tab">My Orders<br>
            <small>我的订单</small>
        </a></li>
    <li><a href="#account" data-toggle="tab">My Account<br>
            <small>我的信息</small>
        </a></li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane fade in active" id="order">
        <div class="panel-group" id="order-list">
            @foreach($orderList as $order)
            <div class="panel {{$order->status >= 4?'panel-warning':'panel-info'}}">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="#order-{{$order->id}}" data-toggle="collapse">
                            {{$order->statusname}}
                            <small>(更新时间 : {{$order->updated_at}})</small>
                        <span class="pull-right">订单号 : {{$order->id}}
                            <small>({{$order->created_at}})</small>
                        </span>
                        </a>
                    </h4>
                </div>
                <div id="order-{{$order->id}}" class="panel-collapse collapse
                {{$order->status >= 4 ? '':' in';}}">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>
                                            Product<br>
                                            <small>(餐点)</small>
                                        </th>
                                        <th style="width: 100px;">
                                            Qty.<br>
                                            <small>(数量)</small>
                                        </th>
                                        <th>
                                            Price<br>
                                            <small>(单价)</small>
                                        </th>
                                    </tr>
                                    </thead>
                                    @foreach($order->orderMealList()->get() as $meal)
                                    <tr>
                                        <td>{{$meal->mealTable()->pluck('name_en')}}
                                        <br><small>{{$meal->mealTable()->pluck('name')}}</small></td>
                                        <td>{{$meal->pluck('number')}}</td>
                                        <td>¥{{$meal->mealTable()->pluck('price')}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4>
                                    <span class="label label-danger">订单金额 : ¥{{$order->price}}</span>
                                </h4>
                                <h4>
                                    <span class="label label-info">电话 ：{{$order->tel}}</span>
                                </h4>
                                <h4>
                                    <span class="label label-primary">地址 ：{{$order->address}}</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="tab-pane fade in" id="account">
        <form class="form-horizontal" method="post" action="{{ URL::to('user/' . $user->id . '/edit') }}"
              autocomplete="off">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
            <!-- ./ csrf token -->
            <!-- General tab -->
            <div class="tab-pane active" id="tab-general">
                <!-- Email -->
                <div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
                    <label class="col-md-3 control-label" for="email">Email <small>(电子邮箱)</small></label>

                    <div class="col-md-9">
                        <input class="form-control" type="text" name="email" id="email"
                               value="{{{ Input::old('email', $user->email) }}}" disabled/>
                        {{ $errors->first('email', '<span class="help-inline">:message</span>') }}
                    </div>
                </div>
                <!-- ./ email -->
                <!-- username -->
                <div class="form-group {{{ $errors->has('username') ? 'error' : '' }}}">
                    <label class="col-md-3 control-label" for="username">Name <small>(姓名)</small></label>

                    <div class="col-md-9">
                        <input class="form-control" type="text" name="username" id="username"
                               value="{{{ Input::old('username', $user->username) }}}"/>
                        {{ $errors->first('username', '<span class="help-inline">:message</span>') }}
                    </div>
                </div>
                <!-- ./ username -->

                <!-- Password -->
                <div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
                    <label class="col-md-3 control-label" for="password">Password <small>(密码)</small></label>

                    <div class="col-md-9">
                        <input placeholder="最小4位  留空则不更改" class="form-control" type="password" name="password" id="password" value=""/>
                        {{ $errors->first('password', '<span class="help-inline">:message</span>') }}
                    </div>
                </div>
                <!-- ./ password -->

                <!-- Password Confirm -->
                <div class="form-group {{{ $errors->has('password_confirmation') ? 'error' : '' }}}">
                    <label class="col-md-3 control-label" for="password_confirmation">Password Confirm <small>确认密码</small></label>

                    <div class="col-md-9">
                        <input placeholder="最小4位  留空则不更改 必须与密码一致" class="form-control" type="password" name="password_confirmation"
                               id="password_confirmation"
                               value=""/>
                        {{ $errors->first('password_confirmation', '<span class="help-inline">:message</span>') }}
                    </div>
                </div>
                <!-- ./ password confirm -->
            </div>
            <!-- ./ general tab -->

            <!-- Form Actions -->
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-success">Update <small>(确认修改)</small></button>
                </div>
            </div>
            <!-- ./ form actions -->
        </form>
    </div>
</div>

@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop
