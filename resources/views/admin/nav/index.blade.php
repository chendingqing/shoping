@extends('layouts.admin.default')
@section("title","权限列表")
@section('content')

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>路由名</th>
            <th>url</th>
            <th>操作</th>
        </tr>
        @foreach($permissions as $permission)
            <tr>
                <td>{{$permission->id}}</td>
                <td>{{$permission->name}}</td>

                <td>{{$permission->guard_name}}</td>

                <td>
                    <a href="{{route("permission.add")}}" class="btn btn-warning">添加</a>
                    <a href="{{route("permission.del",$permission->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
{{--{{$shops->links()}}--}}
@endsection