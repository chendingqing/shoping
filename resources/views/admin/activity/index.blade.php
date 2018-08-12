@extends('layouts.admin.default')
@section("title","活动管理列表")
@section('content')

    <div class="box-header">

        <div class="box-tools">
            <a class="btn btn-success" href="{{route("activity.add")}}">添加</a>
            <form class="navbar-form navbar-right"action="" method="get">
                <select name="status" class="form-control">
                    <option value="">请选择</option>

                        <option value="-1">未开始</option>
                        <option value="1">已开始</option>
                        <option value="2">已结束</option>

                </select>

        <button type="submit" class="btn btn-default">搜索</button>
            </form>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>活动标题</th>
            <th>活动内容</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>操作</th>
        </tr>
    @foreach($acts as $act)
            <tr>
                <td>{{$act->id}}</td>
                <td>{{$act->title}}</td>
                <td>{!! $act->content !!}</td>
                <td>{{$act->start_time}}</td>
                <td>{{$act->end_time}}</td>


                <td>
                    <a href="{{route("activity.edit",$act->id)}}" class="btn btn-warning">修改活动信息</a>
                    <a href="{{route("activity.del",$act->id)}}" class="btn btn-danger">删除活动信息</a>

                </td>
            </tr>
@endforeach
    </table>
{{$acts->links()}}
@endsection