<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ShopCategoryController extends BaseController
{
    /**
     * 商家分类
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $shops=ShopCategory::paginate(3);
        return view("admin.shop_category.index",compact('shops'));
    }

    /**
     * 添加商家
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request){
        //判断接收方式
    if ($request->isMethod('post')){
        //添加健壮性
    $this->validate($request,[
        "name" => "required|min:2",
        "shop_intro" => "required",
        "status" => "required"
    ]);
       //接收数据
        $data=$request->all();
        //添加保存数据
        ShopCategory::create($data);
        //添加成功返回首页
        $request->session()->flash("success","添加成功");
        return redirect("/shop_category/index");
    }
         return view("admin.shop_category.add");
    }

    /**
     * 编辑
     * @param Request $request
     * @param ShopCategory $shopCategory
     */
    public function edit(Request $request,ShopCategory $shopCategory){
        //判断接收方式
        if ($request->isMethod('post')) {
            //添加健壮性
            $this->validate($request, [
                "name" => "required|min:2",
                "shop_intro" => "required",
            ]);
            //接收数据
            $data = $request->all();
            //添加保存数据
            $shopCategory->update($data);
            //添加成功返回首页
            $request->session()->flash("success", "编辑成功");
            return redirect("/shop_category/index");
        }
        //显示视图
        return view("admin.shop_category.edit",compact('shopCategory'));
    }
    public function del(Request $request,$id){

        $shopCategory=ShopCategory::find($id);
      $shop=Shop::where("shop_category_id",$shopCategory->id)->count();
      if($shop){
          return back()->with("danger","当前分类下有店铺，不能删除该分类");
      }
        $shopCategory->delete();

        File::delete(public_path($shopCategory->shop_img));

        $request->session()->flash("success","删除成功");

        return redirect("/shop_category/index");
    }
    public function upload(Request $request){
        $fileName= $request->file('file')->store('shop','oss');
        $date=[
            'status'=>1,
            'url'=>env('ALIYUN_OSS_URL').$fileName
        ];
        return $date;

    }
}
