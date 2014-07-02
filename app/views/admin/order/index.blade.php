@extends('admin.layouts.default')
<?php
function transformStatus($status)
{
    switch ($status) {
        case 1:
            return '订单已生成, 等待确认';
        case 2:
            return '订单已确认, 正在配餐';
        case 3:
            return '正在配送中';
        case 4:
            return '交易已完成';
        case 5:
            return '交易已取消';
    }
}
?>
{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')Blogs administration @stop
@section('author')Laravel 4 Bootstrap Starter SIte @stop
@section('description')Blogs administration index @stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h3>
        {{{ $title }}}

        <div class="pull-right">
            <a href="{{{ URL::to('admin/order/create') }}}" class="btn btn-small btn-info iframe"><span
                    class="glyphicon glyphicon-plus-sign"></span> 添加分类</a>
        </div>
    </h3>
</div>

<table id="orders" class="table table-hover">
    <thead>
    <tr>
        <th class="col-md-2">订单状态</th>
        <th class="col-md-2">收货人</th>
        <th class="col-md-5">地址</th>
        <th class="col-md-2">提交时间</th>
        <th class="col-md-1">操作</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@stop

{{-- Scripts --}}
@section('scripts')
<script type="text/javascript">
    var oTable;
    $(document).ready(function () {
        oTable = $('#orders').dataTable({
            "sDom": "<'row'<'col-md-6'l><'col-md-6'>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ 条每页"
            },
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "{{ URL::to('admin/order/data') }}",
            "fnDrawCallback": function (oSettings) {
                $(".iframe").colorbox({iframe: true, width: "80%", height: "80%"});
            }
        });
    });
</script>
@stop