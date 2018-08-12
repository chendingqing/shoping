<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\Menu_categories;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuCategoriesController extends BaseController
{
    public function index(Request $request){
     $id=Auth::user()->shop_id;

       $menus=Menu_categories::where('shop_id',$id)->get();

       return view('shops.menuCategories.index',compact("menus"));
    }
    public function add(Request $request){
    if ($request->isMethod('post')){
        //接收当前登录商户id
        $id=Auth::user()->shop->id;

        if($request->post('is_selected')==1){
            Menu_categories::where('is_selected','1')->where("shop_id",$id)->update(['is_selected'=>0]);
        }
        $data=$request->all();
        $data['shop_id']=$id;
         Menu_categories::create($data);
         session()->flash("success","菜品添加成功");
         return redirect()->route('menuCategories.index');
    }
        return view("shops.menuCategories.add");
    }
    public function edit(Request $request,$id){
        $menu=Menu_categories::findOrFail($id);
        $shop_id=Auth::user()->shop->id;

        if ($request->isMethod('post')){
            //接收当前登录商户id
            if($request->post('is_selected')==1){
                $menu::where('is_selected','1')->where("shop_id",$shop_id)->update(['is_selected'=>0]);
            }
            $data=$request->all();
           $menu->update($data);
            session()->flash("success","菜品分类编辑成功");
            return redirect()->route('menuCategories.index');
        }
        return view("shops.menuCategories.edit",compact("menu"));
    }
    public function del(Request $request,$id){
        $menu=Menu_categories::findOrFail($id);
        $id=Auth::user()->id;
        if ($menu->is_selected==1){
            session()->flash("danger","菜品为默认分类不能删除");
            return redirect()->back()->withInput();
        }
        $shop=Menu::where("category_id",$menu->id)->count();
        if ($shop){
            session()->flash("danger","菜品分类下有菜品，不能删除");
            return redirect()->back()->withInput();
        }
        $menu->delete();
        session()->flash("success","删除成功");
        return redirect()->route('menuCategories.index');
    }
}
