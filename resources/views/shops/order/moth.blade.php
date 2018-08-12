
@extends('layouts.default')
@section("title","每月订单量统计")
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{route("order.orderList")}}" class="btn btn-success">每日订单量</a>
                    <a href="{{route("order.moth")}}" class="btn btn-success">每月订单量</a>
                    <a href="{{route("order.all")}}" class="btn btn-success">总订单量</a>

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
                        <h2 align="center">月订单量</h2>
                        <tr>
                            <th>时间</th>
                            <th>盈利金额</th>
                            <th>订单数量</th>
                        </tr>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->date}}</td>
                                <td>{{$order->money}}</td>
                                <td>{{$order->count}}</td>
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


