@extends('layouts.admin.default')
@section("title","权限列表")
@section('content')

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>用户组名</th>
            <th>拥有权限</th>
            <th>操作</th>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{ str_replace(['[',']','"'],'', $role->permissions()->pluck('name')) }}</td>

                <td>
                    <a href="{{route("role.add")}}" class="btn btn-warning">添加</a>
                    <a href="{{route("role.del",$role->id)}}" class="btn btn-danger">删除</a>
                    <a href="{{route("role.edit",$role->id)}}" class="btn btn-info">编辑</a>
                </td>
            </tr>
        @endforeach
    </table>
{{--{{$shops->links()}}--}}
@endsection