@extends('layouts.admin.default')
@section("title","商家账号列表")
@section('content')

   <table class="table table-bordered">
       <tr>
           <th>id</th>
           <th>账号</th>
           <th>电子邮箱</th>

           <th>是否启用</th>
           <th>操作</th>
       </tr>
       @foreach($users as $user)
       <tr>
           <td>{{$user->id}}</td>
           <td>{{$user->name}}</td>
           <td>{{$user->email}}</td>

           <td>{{$user->status===1?"启用":"禁用"}}</td>
           <td>
               <a href="{{route("admin.modify",$user->id)}}" class="btn btn-warning">重置密码</a>

           </td>
       </tr>
        @endforeach
   </table>
{{$users->links()}}
@endsection