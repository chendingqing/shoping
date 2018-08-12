@extends('layouts.default')
@section("title","菜品管理")
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{route('menu.add')}}" class="btn btn-success">添加</a>


                    <div class="box-tools">




                        <form class="navbar-form navbar-right"action="" method="get">
                            <div class="form-group">
                            <select name="menu_id" class="form-control">
                                <option value="">请选择分类</option>
                                @foreach($menuCategorys as $menuCategory)
                                    <option value="{{$menuCategory->id}}"@if(request()->input('menu_id')==$menuCategory->id) selected @endif>{{$menuCategory->name}}</option>
                                @endforeach
                            </select>
                    </div>



                            <input type="text" name="minMoney" class="form-control" size="2" placeholder="最低价格" value="{{request()->input('minMoney')}}">——
                            <input type="text" name="maxMoney" class="form-control" size="2" placeholder="最高价格"  value="{{request()->input('maxMoney')}}">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="菜品名" name="keywords" value="{{request()->input('keywords')}}">
                            </div>
                            <button type="submit" class="btn btn-default">搜索</button>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding" >
                    <table class="table table-hover table-bordered">
                        <tbody>
                        <tr>
                            <th height="">id</th>
                            <th>菜品名称</th>
                            <th>菜品图片</th>
                            <th>菜品评分</th>
                            <th>所属商家ID</th>
                            <th>菜品分类</th>
                            <th>价格</th>
                            <th>描述</th>
                            <th>月销量</th>
                            <th>评分数量</th>
                            <th>提示信息</th>
                            <th>满意度数量</th>
                            <th>满意度评分</th>
                            <th>菜品状态</th>
                            <th>操作</th>
                        </tr>
                        <tr>
                            @foreach($menus as $menu)
                                <td>{{$menu->id}}</td>
                                <td>{{$menu->goods_name}}</td>
                                <td>
                                    @if($menu->goods_img)
                                        <img src="{{$menu->goods_img}}" height="50"width="50">
                                    @endif
                                </td>
                                <td>{{$menu->rating}}</td>
                                <td>{{$menu->shop_id}}</td>
                                <td>{{$menu->menu_category->name}}</td>
                                <td>{{$menu->goods_price}}</td>
                                <td>{{$menu->description}}</td>
                                <td>{{$menu->month_sales}}</td>
                                <td>{{$menu->rating_count}}</td>
                                <td>{{$menu->tips}}</td>
                                <td>{{$menu->satisfy_count}}</td>
                                <td>{{$menu->satisfy_rate}}</td>

                                <td>
                                    @if($menu->status==1)
                                        <a href="#" class="btn btn-success">销售中</a>
                                    @elseif($menu->status==0)
                                        <a href="#" class="btn btn-info">下架了</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route("menu.edit",$menu->id)}}" class="btn btn-warning">编辑菜品</a>
                                    <a href="{{route("menu.del",$menu->id)}}" class="btn btn-danger">删除菜品</a>

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
    {{$menus->links()}}
@endsection