@extends('layouts.admin.default')
@section("title","店铺详情列表")
@section('content')


          会员名称: <input type="text" value="{{$member->username}}" class="form-group"><br/>
          会员电话:<input type="text" value="{{$member->tel}}"class="form-group"><br/>
          会员余额:<input type="text" value="{{$member->money}}"class="form-group"><br/>



@endsection