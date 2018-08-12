@extends('layouts.default')
@section("title","店铺信息编辑")
@section('content')
    <form action="" method="post" class="form-inline col-sm-8 control-label" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            菜品名称：<input type="text" class="form-control" placeholder="name" name="goods_name" value="{{old('goods_name',$menu->goods_name)}}" >
        </div>
        <br/>
        <div class="form-group">
            菜品评分： <input type="text" class="form-control"  name="rating"  value="{{old('rating',$menu->rating)}}">
        </div>
        <br/>
        所属分类:<select name="category_id" >
            @foreach($cates as $cate)
                <option value="{{$cate->id}}"@if($menu->category_id===$cate->id) selected @endif>{{$cate->name}}</option>
            @endforeach
        </select>
        <br/>
        <div class="form-group">
            商品价格 : <input type="text" class="form-control" name="goods_price" value="{{old('goods_price',$menu->goods_price)}}">
        </div>
        <br/>
        <div class="form-group">
            菜品 描述 ： <input type="text" class="form-control" name="description" value="{{old('description',$menu->description)}}">
        </div>
        <br/>
        <div class="form-group">
            菜品销量：  <input type="text" class="form-control" name="month_sales" value="{{old('month_sales',$menu->month_sales)}}">
        </div>
        <br/>
        <div class="form-group">
            评分数量 ： <input type="text" class="form-control" name="rating_count" value="{{old('rating_count',$menu->rating_count)}}">
        </div>
        <br/>
        <div class="form-group">
            提示信息:<input type="text" class="form-control" name="tips" value="{{old('tips',$menu->tips)}}">
        </div>
        <br/>
        <div class="form-group">
            满意数量:<input type="text" class="form-control" name="satisfy_count" value="{{old('satisfy_count',$menu->satisfy_count)}}">
        </div>
        <br/>
        <div class="form-group">
            满意评分:<input type="text" class="form-control" name="satisfy_rate" value="{{old('satisfy_rate',$menu->satisfy_rate)}}">
        </div>
        <br/>
        <div class="form-group">

            菜品图片: <img src="/uploads/{{$menu->goods_img}}" height="50" width="50">
            <input type="file" name="goods_img">
        </div>
        <br/>
        <div class="checkbox">
            菜品状态:<label>
                <input type="checkbox" value="1"{{$menu->status?"checked":""}} name="status">是
            </label>
            <label>
                <input type="checkbox" value="2"{{$menu->status?"":"checked"}} name="status">否
            </label>
        </div>
        <br/>
        <button type="submit" class="btn btn-success">编辑菜品</button>
    </form>

@endsection