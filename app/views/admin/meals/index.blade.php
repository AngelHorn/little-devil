@extends('admin.layouts.default')

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
            <div class="btn-group">
                <a href="{{{ URL::to('admin/meals/1/all-status') }}}" class="btn btn-small btn-success iframe"><span
                        class="glyphicon glyphicon-plus-sign"></span> 全部在售</a>
                <a href="{{{ URL::to('admin/meals/2/all-status') }}}" class="btn btn-small btn-warning iframe"><span
                        class="glyphicon glyphicon-plus-sign"></span> 全部关闭</a>
                <a href="{{{ URL::to('admin/meals/create') }}}" class="btn btn-small btn-info iframe"><span
                        class="glyphicon glyphicon-plus-sign"></span> 添加餐点</a>
            </div>
        </div>
    </h3>
</div>

<table id="meals" class="table table-hover">
    <thead>
    <tr>
        <th class="col-md-2">餐点名称</th>
        <th class="col-md-2">单价</th>
        <th>更新时间</th>
        <th class="col-md-2">操作</th>
        <th class="col-md-2">分类名称</th>
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
        oTable = $('#meals').dataTable({
            "sDom": "<'row'<'col-md-6'l><'col-md-6'>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ 条每页"
            },
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "{{ URL::to('admin/meals/data') }}",
            "fnDrawCallback": function (oSettings) {
                $(".iframe").colorbox({iframe: true, width: "80%", height: "80%"});
            }
        });
    });
</script>
@stop