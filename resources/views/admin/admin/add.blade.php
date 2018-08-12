@extends('layouts.admin.default')
@section('title',"添加管理员账号")
@section('content')
<form action="" method="post" class="form-inline" enctype="multipart/form-data">
    {{ csrf_field() }}
    管理员名称：<input type="text" name="name" value="{{old('name')}}" class="form-control"><br>
    管理员邮箱：<input type="email" name="email"  value="{{old('email')}}" class="form-control"><br>
    管理员密码：<input type="password" name="password" class="form-control"><br>
    确认密码    ：<input type="password" name="password_confirmation" class="form-control"><br>
    管理员用户组分配：<br/>
    @foreach($roles as $role)
        <input type="checkbox" class="form-control" name="per[]"value="{{$role->name}}"> {{$role->name}}<br/>
    @endforeach
    <br/>


        <input type="submit" value="提交">

</form>
@endsection