@extends("layouts.admin.default")
@section("title","商家管理")
@section("content")
    <a href="/shop_category/add" class="btn btn-info">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>分类名称</th>
            <th>商家分类简介</th>
            <th>商家图片</th>
            <th>商家状态</th>
            <th>操作</th>
        </tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>
                <td>{{$shop->name}}</td>
                <td>{{$shop->shop_intro}}</td>
                <td>
                    @if($shop->shop_img)
                        <img src="{{$shop->shop_img}}" height="50" width="50">
                    @endif()
                </td>
                <td>
                    @if($shop->status===1)
                        <a href="#" class=" btn btn-success glyphicon glyphicon-ok"></a>
                    @else
                        <a href="#" class=" btn btn-danger glyphicon glyphicon-remove"></a>
                     @endif
                </td>
                <td>
                    <a href="/shop_category/edit/{{$shop->id}}" class="btn btn-success">编辑</a>
                    <a href="/shop_category/del/{{$shop->id}}" class="btn btn-danger">删除</a>
                </td>

            </tr>
        @endforeach
    </table>
    {{$shops->links()}}
@endsection