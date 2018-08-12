<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\Menu_categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MenuController extends BaseController
{
  public function index(Request $request){
      $minMoney=$request->input("minMoney");
      $maxMoney=$request->input("maxMoney");
      $keywords=$request->input("keywords");
      $menuId=$request->input("menu_id");
      $id=Auth::user()->shop_id;
      $query=Menu::orderBy("id")->where("shop_id",$id);

     if ($minMoney!==null){
         $query->where("goods_price",'>=',$minMoney);
     }
      if ($maxMoney!==null){
          $query->where("goods_price",'<=',$maxMoney);
      }
      if ($keywords!==null){
          $query->where("goods_name",'like',"%{$keywords}%");
      }
      if ($menuId!==null){
          $query->where("category_id",'=',"$menuId");
      }

      $menus=$query->paginate(3);

      $menuCategorys=Menu_categories::all();
return view("shops.menu.index",compact("menus","menuCategorys"));
  }



  public function add(Request $request){
      $id=Auth::user()->shop_id;
   $cates=Menu_categories::where('shop_id',$id)->get();

   if($request->isMethod("post")){

       $data=$request->all();
       $file=  $request->file("goods_img");
       if ($file!==null){
       $data['goods_img']=$file->store("menus","oss");
       }
       $data['shop_id']=Auth::user()->shop_id;

      $data['category_id']=$request->post('category_id');
       if (Menu::create($data)) {
           session()->flash("success","添加成功");
           return redirect()->route('menu.index');
       }
   }
return view("shops.menu.add",compact("cates"));
  }
  public function edit(Request $request,$id){
      $cates=Menu_categories::all();
      $menu=Menu::findOrFail($id);
      if($request->isMethod("post")){

          $data=$request->all();
          $data['goods_img']=  $request->file("goods_img")->store("goods", "images");
          $data['shop_id']=Auth::user()->shop_id;

          $data['category_id']=$request->post('category_id');

          if ($menu->save($data)) {
              session()->flash("success","编辑成功");
              return redirect()->route('menu.index');
          }
      }
      return view("shops.menu.edit",compact("cates",'menu'));
  }
public function del(Request $request,$id){
   $menu=Menu::findOrFail($id);

        $menu->delete();
        session()->flash("success","删除成功");
        return redirect()->route('menu.index');



}



public function upload(Request $request){
   $fileName= $request->file('file')->store('menus','oss');
   $date=[
       'status'=>1,
       'url'=>env("ALIYUN_OSS_URL").$fileName
   ];

   return $date;

}

}
