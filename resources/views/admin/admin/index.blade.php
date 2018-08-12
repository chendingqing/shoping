@extends('layouts.admin.default')
@section("title","管理员账号列表")
@section('content')
    <a href="{{route("admin.add")}}" class="btn btn-info">添加</a>
   <table class="table table-bordered">
       <tr>
           <th>id</th>
           <th>管理员账号</th>
           <th>电子邮箱</th>
           <th>管理用户组</th>
           <th>操作</th>
       </tr>
       @foreach($admins as $admin)
       <tr>
           <td>{{$admin->id}}</td>
           <td>{{$admin->name}}</td>
           <td>{{$admin->email}}</td>
           <td>
              {{str_replace(['[',']','"'],'',json_encode($admin->getRoleNames(),JSON_UNESCAPED_UNICODE))}}

           </td>
           <td>
               <a href="{{route("admin.edit",$admin->id)}}" class="btn btn-warning">编辑</a>
               @if($admin->id!==1)
               <a href="{{route("admin.del",$admin->id)}}" class="btn btn-danger">删除</a>
               @endif
               <a href="{{route("admin.update",$admin->id)}}" class="btn btn-info">修改密码</a>
            </td>
       </tr>
        @endforeach
   </table>
{{--{{$admins->links()}}--}}
@endsection