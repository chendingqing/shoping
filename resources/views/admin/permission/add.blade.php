@extends('layouts.admin.default')
@section('title',"添加权限路由")
@section('content')
<form action="" method="post" class="form-inline" enctype="multipart/form-data">
    {{ csrf_field() }}
    权限路由： @foreach($route as $k=>$v)
        <input type="checkbox" class="form-control" name="per[]"value="{{$v}}"> {{$v}}
        @endforeach
    <br/>
        <input type="submit" class="btn btn-success" value="提交">

</form>
@endsection