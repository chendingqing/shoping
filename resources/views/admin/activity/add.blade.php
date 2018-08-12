@extends('layouts.admin.default')
@section('title',"添加管理员账号")
@section('content')

    <form action="" method="post" class="form-inline" enctype="multipart/form-data">
        {{ csrf_field() }}
        活动名称：<input type="text" name="title" value="{{old('title')}}" class="form-control"><br>
        活动内容：

        <!-- 编辑器容器 -->
        <script id="container" name="content" type="text/plain" ></script>
        <br/>
        活动开始时间：<input type="date" name="start_time" class="form-control"><br>
        活动结束时间 ：<input type="date" name="end_time" class="form-control"><br>
        <input type="submit" value="添加">

    </form>
@endsection