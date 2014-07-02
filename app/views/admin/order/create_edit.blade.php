@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

{{-- Edit Blog Form --}}
<form class="form-horizontal" method="post" enctype="multipart/form-data"
      action="@if (isset($post)){{ URL::to('admin/order/' . $post->id . '/edit') }}@endif" autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
    <!-- ./ csrf token -->

    <!-- Tabs Content -->
    <div class="tab-content">
        <!-- General tab -->
        <div class="tab-pane active" id="tab-general">
            <!-- Post Title -->
            <div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
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
                    <div id="order-{{$order->id}}" class="panel-collapse collapse in">
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
                                                <br>
                                                <small>{{$meal->mealTable()->pluck('name')}}</small>
                                            </td>
                                            <td>{{$meal->number}}</td>
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
                                        <span class="label label-warning">收货人 ：{{$order->name}}</span>
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
            </div>
            <!-- ./ post title -->
        </div>
        <!-- ./ general tab -->
    </div>
    <!-- ./ tabs content -->
    <div class="form-group">
        <label class="col-md-1 control-label" for="formGroupInputSmall">订单状态</label>
        <div class="col-md-11">
            <select class="form-control" name="status">
                <option value="2">订单已确认, 正在配餐</option>
                <option value="3">正在配送中</option>
                <option value="4">交易已完成</option>
                <option value="1" disabled></option>
                <option value="5">交易已取消</option>
            </select>
        </div>
    </div>
    <!-- Form Actions -->
    <div class="form-group">
        <div class="col-md-offset-1 col-md-11">
            <button type="reset" class="btn btn-default">重置</button>
            <button type="submit" class="btn btn-success">提交</button>
        </div>
    </div>
    <!-- ./ form actions -->
</form>
@stop
