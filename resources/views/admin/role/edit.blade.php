

@extends('layouts.admin.default')
@section('title',"添加用户组权限路由")
@section('content')
<form action="" method="post" class="form-inline" enctype="multipart/form-data">
    {{ csrf_field() }}
    用户组名称：<input type="text" name="name" value="{{old('name',$role->name)}}" class="form-control"><br>

    权限分配：<br/>
    @foreach($pers as $per)
        <input type="checkbox" class="form-control" name="per[]"value="{{$per->name}}" @if(($role->hasPermissionTo($per->name))) checked @endif> {{$per->name}}<br/>
       @endforeach
    <br/>
        <input type="submit" class="btn btn-success" value="提交">

</form>
@endsection
