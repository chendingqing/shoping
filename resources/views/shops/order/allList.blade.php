
@extends('layouts.default')
@section("title","订单量统计")
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{route("order.cartList")}}" class="btn btn-success">每日订单量</a>
                    <a href="{{route("order.mothList")}}" class="btn btn-success">每月订单量</a>
                    <a href="{{route("order.allList")}}" class="btn btn-success">总订单量</a>

                    {{--<form class="navbar-form navbar-right"action="" method="get">--}}
                        {{--<input type="date" name="start" class="form-control" size="2" placeholder="" value="{{request()->input('start')}}">——--}}
                        {{--<input type="date" name="end" class="form-control" size="2" placeholder=""  value="{{request()->input('end')}}">--}}
                        {{--<button type="submit" class="btn btn-default">搜索</button>--}}
                    {{--</form>--}}
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding" >
                    <table class="table table-hover table-bordered">
                        <tbody>
                        <h2 align="center" >总订单量</h2>
                        <tr>
                            <th>菜品ID</th>
                            <th>菜品名</th>
                            <th>菜品数量</th>
                        </tr>
                        @foreach($order_goods as $order_good)
                            <tr>
                                <td>{{$order_good->goods_id}}</td>
                                <td>{{$order_good->goods_name}}</td>
                                <td>{{$order_good->nums}}</td>
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


