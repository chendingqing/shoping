@extends('layouts.admin.default')
@section('title',"添加权限路由")
@section('content')
<form action="" method="post" class="form-inline" enctype="multipart/form-data" >
    {{ csrf_field() }}
   名称：<input type="text" name="name" class="form-control"><br/>
    路由：<select name="url" class="form-control">
        @foreach($route as $k=>$v)
        <option value="{{$v}}">{{$v}}</option>
            @endforeach
    </select>
    <br/>
    上级菜单：<select name="pid" class="form-control">
        <option value="0">顶级分类</option>
        @foreach($urls as $url)
            <option value="{{$url->id}}">{{$url->name}}</option>
        @endforeach
    </select>
    <br>
     排序：<input type="text" name="sort" class="form-control">
    <br>
        <input type="submit" class="btn btn-success" value="添加">

</form>
@endsection