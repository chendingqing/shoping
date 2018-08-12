@extends('layouts.default')
@section("title","订单列表")
@section('content')

    <table class="table table-bordered">
        <tr>
            <th>订单id</th>
            <th>商品名称</th>
            <th>商品图片</th>
            <th>商品价格</th>
            <th>商品数量</th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->order_id}}</td>
                <td>{{$order->goods_name}}</td>

                <td>
                    @if($order->goods_img)
                    <img src="{{$order->goods_img}}" height="50" width="50">
                    @endif
                </td>
                <td>{{$order->goods_price}}</td>
                <td>{{$order->amount}}</td>
            </tr>
        @endforeach
    </table>

@endsection