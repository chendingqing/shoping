@extends('layouts.admin.default')
@section('title',"添加管理员账号")
@section('content')
<form action="" method="post" class="form-inline" enctype="multipart/form-data" >
    {{ csrf_field() }}

    管理员旧密码：<input type="password" name="password" class="form-control"><br>
    输入新密码    ：<input type="password" name="re_password" class="form-control"><br>
        <input type="submit" value="修改密码">

</form>
@endsection