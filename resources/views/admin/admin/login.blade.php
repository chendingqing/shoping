@extends('layouts.admin.default')
@section("title","登录")
@section("content")
    <h2 align="center">平台登录</h2>
    <form action="" method="post" class="form-inline" enctype="multipart/form-data" align="center">
        {{ csrf_field() }}
        管理员姓名： <input type="text" name="name" placeholder="用户名" value="{{old('name')}}"><br/>
        管理员密码： <input type="password" name="password" placeholder="密码" value="{{old('password')}}"><br/>
        <input type="checkbox" name="remember">记住密码<br/>
        <input type="submit" value="登录" class="btn btn-success">
    </form>

@endsection

