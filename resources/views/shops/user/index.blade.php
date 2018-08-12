@extends('layouts.default')
@section("title","店铺详情列表")
@section('content')

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>店铺类型</th>
            <th>店铺名称</th>
            <th>店铺图片</th>
            <th>评分</th>
            <th>起送金额</th>
            <th>配送费</th>
            <th>状态</th>
            <th>操作</th>
        </tr>

            <tr>
                <td>{{$shop->id}}</td>
                <td>{{$shop->shop_category->name}}</td>
                <td>{{$shop->shop_name}}</td>

                <td>
                    @if($shop->shop_img)
                        <img src="{{$shop->shop_img}}" width="50">
                    @endif
                </td>
                <td>{{$shop->shop_rating}}</td>
                <td>{{$shop->start_send}}</td>
                <td>{{$shop->send_cost}}</td>
                <td>
                    @if($shop->status===1)
                        <a href="#" class="btn btn-success">正常</a>
                    @elseif($shop->status===-1)
                        <a href="#" class="btn btn-danger">禁用</a>
                    @elseif($shop->status===0)
                        <a href="#" class="btn btn-info">待审核</a>
                    @endif
                </td>
                <td>

                </td>
            </tr>

    </table>

@endsection