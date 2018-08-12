@extends('layouts.admin.default')
@section("title","店铺详情列表")
@section('content')


    <form action="" method="post" class="form-inline" enctype="multipart/form-data">
        {{ csrf_field() }}
        充值会员名称: {{$member->username}}<br/>
        充值金额:<input type="text" name="money"class="form-group"><br/>
        <input type="submit" class=" form-group btn-info" value="充值">

    </form>




@endsection