@extends('layouts.default')
@section("title","菜品分类管理")
@section('content')
    <a href="{{route('menuCategories.add')}}" class="btn btn-warning">添加菜品分类</a>
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>菜品分类名称</th>
            <th>菜品分类编号</th>
            <th>所属商家ID</th>
            <th>描述</th>
            <th>是否是默认分类</th>
            <th>操作</th>
        </tr>
            <tr>
                @foreach($menus as $menu)
                <td>{{$menu->id}}</td>
                <td>{{$menu->name}}</td>
                <td>{{$menu->type_accumulation}}</td>
                <td>{{$menu->shop_id}}</td>
                <td>{{$menu->description}}</td>


                <td>
                    @if($menu->is_selected==1)
                        <a href="#" class="btn btn-success">默认分类</a>
                    @elseif($menu->is_selected==0)
                        <a href="#" class="btn btn-info">非默认分类</a>
                    @endif
                </td>
                <td>
                    <a href="{{route("menuCategories.edit",$menu->id)}}" class="btn btn-warning">编辑分类菜品</a>
                    <a href="{{route("menuCategories.del",$menu->id)}}" class="btn btn-danger">删除分类菜品</a>

                </td>

            </tr>
        @endforeach
    </table>

@endsection