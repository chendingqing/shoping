@extends('layouts.default')
@section('title',"添加菜品分类")
@section('content')
<form action="" method="post" class="form-inline" enctype="multipart/form-data">
    {{ csrf_field() }}
    菜品分类名称：<input type="text" name="name" value="{{old('name')}}" class="form-control"><br>
    菜品分类编号：<input type="text" name="type_accumulation"  value="{{old('type_accumulation')}}" class="form-control"><br>
    菜品分类描述：<input type="text" name="description" class="form-control" value="{{old('description')}}"><br>
    是否是默认分类：<label>
        <input type="checkbox" value="1" name="is_selected">是

    </label>
    <label>
        <input type="checkbox" value="0" name="is_selected">否
    </label><br>
        <input type="submit" class="btn  btn-success" value="添加">

</form>
@endsection