<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class shopController extends BaseController
{
   //    店铺管理
    public function index(){
   $shops=Shop::all();
  return view("shops.shops.index",compact('shops'));
    }
//    商家注册
    public function reg(Request $request){

     $cates=ShopCategory::where("status",'1')->get();
//判断接受方式
        if ($request->isMethod('post')){
            //健壮性
            $this->validate($request,[
                "name" => "required|min:2",
                "password" => "required",
                "email" => "required|email",
                "start_send" => "required",
                "send_cost" => "req uired",
            ]);
//     接受数据
            DB::transaction(function () use($request){
                $date['shop_name']=$request->post('shop_name');
                $date['shop_category_id']=$request->post('shop_category_id');
                $date['shop_img']=$request->post('shop_img');
                $date['brand']=$request->post('brand');
                $date['on_time']=$request->post('on_time');
                $date['fengniao']=$request->post('fengniao');
                $date['bao']=$request->post('bao');
                $date['piao']=$request->post('piao');
                $date['zhun']=$request->post('zhun');
                $date['start_send']=$request->post('start_send');
                $date['send_cost']=$request->post('send_cost');
                if ($shop=Shop::create($date)) {
                    $data['name']=$request->post('name');
                    $data['password']=bcrypt($request->post('password'));
                    $data['email']=$request->post('email');
                    $data['shop_id']=$shop->id;
                    User::create($data);

                }
            });
            $request->session()->flash("success","注册成功,等待管理员审核");
            return redirect()->route("user.login");
            }
//   显示视图
        return view("shops.shops.reg",compact("cates"));
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     *
     */
    public function edit(Request $request,$id)
    {
//        找到数据
        $cates=ShopCategory::all();
        $shop=Shop::findOrFail($id);
        $user=User::where("shop_id",$id)->first();
//        判断接收方式
        if ($request->isMethod('post')) {
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
                $date['shops_name'] = $request->post('shops_name');
                $date['shop_category_id'] = $request->post('shop_category_id');
                $date['shop_img'] = $request->post('shop_img');
                $date['brand'] = $request->post('brand');
                $date['on_time'] = $request->post('on_time');
                $date['fengniao'] = $request->post('fengniao');
                $date['bao'] = $request->post('bao');
                $date['piao'] = $request->post('piao');
                $date['zhun'] = $request->post('zhun');
                $date['start_send'] = $request->post('start_send');
                $date['send_cost'] = $request->post('send_cost');
            if ($shop->update($date)) {
                $data['name'] = $request->post('name');
                $data['password'] = $request->post('password');
                $data['email'] = $request->post('email');
                $data['shop_id']=$shop->id;
                $request->session()->flash("success", "编辑成功,等待管理员审核");
                return redirect()->route("shops.shops.index");
                }
            }

//显示视图并传递数据
  return view("shops.shops.edit",compact("cates","shop","user"));
    }
    public function defaultIndex(){

return view('shops.index');

    }

    public function upload(Request $request){
        $fileName= $request->file('file')->store('shops','oss');
        $date=[
            'status'=>1,
            'url'=>env('ALIYUN_OSS_URL').$fileName
        ];
        return $date;

    }
}
