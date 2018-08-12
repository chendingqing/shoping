
@extends('layouts.default')
@section("title","订单列表")
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{route("order.orderList")}}" class="btn btn-success">每日订单量</a>
                    <a href="{{route("order.moth")}}" class="btn btn-success">每月订单量</a>
                    <a href="{{route("order.all")}}" class="btn btn-success">总订单量</a>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding" >
                    <table class="table table-hover table-bordered">
                        <tbody>
                        <tr>
                            <th>id</th>
                            <th>订单编号</th>
                            <th>收货地址</th>
                            <th>收货人姓名</th>
                            <th>收货人电话</th>
                            <th>商品价格</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->sn}}</td>
                                <td>{{$order->province . $order->city . $order->area . $order->detail_address}}</td>


                                <td>{{$order->name}}</td>
                                <td>{{$order->tel}}</td>
                                <td>{{$order->total}}</td>
                                <td>
                                    @if($order->status===0)
                                        <a href="#" class="btn btn-success">已取消</a>
                                    @elseif($order->status===1)
                                        <a href="#" class="btn btn-danger">待付款</a>
                                    @elseif($order->status===2)
                                        <a href="#" class="btn btn-danger">待发货</a>
                                    @elseif($order->status===3)
                                        <a href="#" class="btn btn-info">待确认</a>
                                    @elseif($order->status===4)
                                        <a href="#" class="btn btn-info">完成</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="/order/list/{{$order->id}}" class="btn btn-info">查看订单</a>
                                    @if($order->status>0&& $order->status!=3)
                                        <a href="/order/change/{{$order->id}}" class="btn btn-danger">取消订单</a>
                                    @endif
                                    @if($order->status!==3 && $order->status!==0)
                                        <a href="/order/send/{{$order->id}}" class="btn btn-success">发货</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    {{--{{$orders->links()}}--}}
@endsection


