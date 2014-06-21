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
            <!-- class -->
            <div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
                <div class="col-md-12">
                    <label class="control-label" for="name">所属分类</label>
                    <select class="form-control" name="class_id"
                            value="{{{ Input::old('title', isset($meal) ? $meal->class_id : null) }}}">
                        @foreach($classes as $class)
                        @if(isset($meal) && $class->id == $meal->class_id)
                        <option value="{{$class->id}}" selected>{{$class->name}}</option>
                        @else
                        <option value="{{$class->id}}">{{$class->name}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- ./ class -->
            <!-- name -->
            <div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
                <div class="col-md-12">
                    <label class="control-label" for="name">餐点名称</label>
                    <input class="form-control" type="text" name="name" id="name"
                           value="{{{ Input::old('title', isset($meal) ? $meal->name : null) }}}"/>
                    {{{ $errors->first('title', '<span class="help-block">:message</span>') }}}
                </div>
            </div>
            <!-- ./ name -->
            <!-- price -->
            <div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
                <div class="col-md-12">
                    <label class="control-label" for="price">餐点单价</label>
                    <input class="form-control" type="text" name="price" id="price"
                           value="{{{ Input::old('title', isset($meal) ? $meal->price : null) }}}"/>
                    {{{ $errors->first('title', '<span class="help-block">:message</span>') }}}
                </div>
            </div>
            <!-- ./ price -->
            <!-- Content -->
            <div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
                <div class="col-md-12">
                    <label class="control-label" for="description">餐点介绍</label>
                    <textarea class="form-control full-width wysihtml5" name="description" value="content"
                              rows="10">{{{ Input::old('content', isset($meal) ? $meal->description : null) }}}</textarea>
                    {{{ $errors->first('content', '<span class="help-block">:message</span>') }}}
                </div>
            </div>
            <!-- ./ content -->
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
