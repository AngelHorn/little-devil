@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

{{-- Edit Blog Form --}}
<form class="form-horizontal" method="post"
      action="@if (isset($post)){{ URL::to('admin/classes/' . $post->id . '/edit') }}@endif" autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
    <!-- ./ csrf token -->

    <!-- Tabs Content -->
    <div class="tab-content">
        <!-- General tab -->
        <div class="tab-pane active" id="tab-general">
            <!-- Post Title -->
            <div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
                <div class="col-md-12">
                    <label class="control-label" for="name">分类名称</label>
                    <input class="form-control" type="text" name="name" id="name"
                           value="{{{ Input::old('title', isset($class) ? $class->name : null) }}}"/>
                    {{{ $errors->first('title', '<span class="help-block">:message</span>') }}}
                </div>
                <div class="col-md-12">
                    <label class="control-label" for="name">分类名称 (英)</label>
                    <input class="form-control" type="text" name="name" id="name"
                           value="{{{ Input::old('title', isset($class) ? $class->name_en : null) }}}"/>
                    {{{ $errors->first('title', '<span class="help-block">:message</span>') }}}
                </div>
            </div>
            <!-- ./ post title -->
        </div>
        <!-- ./ general tab -->
    </div>
    <!-- ./ tabs content -->

    <!-- Form Actions -->
    <div class="form-group">
        <div class="col-md-12">
            <button type="reset" class="btn btn-default">重置</button>
            <button type="submit" class="btn btn-success">提交</button>
        </div>
    </div>
    <!-- ./ form actions -->
</form>
@stop
