@extends('layouts.default')
@section('title',"编辑分类菜品")
@section('content')
<form action="" method="post" class="form-inline" enctype="multipart/form-data">
    {{ csrf_field() }}
    菜品分类名称：<input type="text" name="name" value="{{old('name',$menu->name)}}" class="form-control"><br>
    菜品分类编号：<input type="text" name="type_accumulation"  value="{{old('type_accumulation',$menu->type_accumulation)}}" class="form-control"><br>
    菜品分类描述：<input type="text" name="description" class="form-control" value="{{old('description',$menu->description)}}"><br>
    是否是默认分类：<label>
        <input type="checkbox" value="1"{{$menu->is_selected==1?"checked":""}} name="is_selected">是

    </label>
    <label>
        <input type="checkbox" value="0"{{$menu->is_selected==0?"":"checked"}} name="is_selected">否
    </label><br>
        <input type="submit" class="btn  btn-success" value="编辑">

</form>
@endsection