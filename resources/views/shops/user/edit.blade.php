@extends('layouts.default')
@section('title',"编辑账号")
@section('content')
<form action="" method="post" class="form-inline" enctype="multipart/form-data">
    {{ csrf_field() }}

    用户旧密码：<input type="password" name="password" class="form-control"><br>
    用户新密码：<input type="password" name="re_password" class="form-control"><br>
        <input type="submit" value="提交">
</form>
@endsection