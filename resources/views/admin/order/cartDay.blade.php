
@extends('layouts.admin.default')
@section("title","菜品每日订单量统计")
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <form class="navbar-form navbar-right"action="" method="get">
                                <select name="shop_id" class="form-control">
                                    <option value="">请选择商户</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->shop_id}}"@if(request()->input('shop_id')==$user->shop_id) selected @endif>{{$user->name}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-default">搜索</button>
                            </form>
                        </div><!-- /.navbar-collapse -->

                    </nav>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding" >
                    <table class="table table-hover table-bordered">
                        <tbody>
                        @if($shopId=="")
                            <h2 align="center" >所有商铺菜品每日订单量</h2>
                        @elseif($shopId==$shop_id)
                            <h2 align="center" >搜索商家每日菜品订单量</h2>
                        @endif

                        <tr>
                            <th>日期</th>
                            <th>菜品ID</th>
                            <th>菜品名</th>
                            <th>菜品图片</th>
                            <th>菜品数量</th>
                        </tr>
                        @foreach($order_goods as $order_good)
                            <tr>
                                <td>{{$order_good->date}}</td>
                                <td>{{$order_good->goods_id}}</td>
                                <td>{{$order_good->goods_name}}</td>
                                <td>
                                    <img src="{{$order_good->goods_img}}" height="50" width="50">
                                </td>
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


