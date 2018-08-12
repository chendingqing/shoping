<?php

namespace App\Http\Controllers\Admin;

use App\Mail\OrderShipped;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class ShopController extends BaseController
{
    public function index(){
        $shops=Shop::all();
        return view("admin.shops.index",compact('shops'));
    }
    public function add(Request $request){
        $cates=ShopCategory::where("status",'1')->get();
//判断接受方式
        if ($request->isMethod('post')){
            //健壮性
            $this->validate($request,[
                "name" => "required|min:2",
                "password" => "required",
                "email" => "required|email",
                "shops_name" => "required|min:2",
                "start_send" => "required",
                "send_cost" => "required",
            ]);
//     接受数据
            $date['shops_name']=$request->post('shops_name');
            $date['shop_category_id']=$request->post('shop_category_id');
            $date[]=$request->post('shop_category_id');
            $date['shop_img']=$request->post('shop_img');
            $date['brand']=$request->post('brand');
            $date['on_time']=$request->post('on_time');
            $date['fengniao']=$request->post('fengniao');
            $date['bao']=$request->post('bao');
            $date['piao']=$request->post('piao');
            $date['zhun']=$request->post('zhun');
            $date['start_send']=$request->post('start_send');
            $date['send_cost']=$request->post('send_cost');
            $date['status']=1;
            if ($shop=Shop::create($date)) {
                $data['name']=$request->post('name');
                $data['password']=$request->post('password');
                $data['email']=$request->post('email');
                $data['shop_id']=$shop->id;
                if (User::create($data)) {
                    $request->session()->flash("success","添加成功，审核通过");
                    return redirect()->route("shop.index");
                }
            }
        }
//   显示视图
        return view("admin.shops.add",compact("cates"));
    }
    public function change(Request $request,$id){
     $shop=Shop::findOrFail($id);
     $shop->status=1;
    $shop->save();
    return back()->with("success","审核成功");
    }
    public function del(Request $request,$id){

        $shop=Shop::find($id);

        $shop->delete();

        File::delete(public_path($shop->shops_img));
            $request->session()->flash("success","删除成功");
            return redirect("/shop_category/index");

    }
}
