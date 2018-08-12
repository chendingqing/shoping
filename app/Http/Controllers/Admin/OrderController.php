<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderGood;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
//    所有订单
    public function index(Request $request)
    {
        $shop_id=$request->get("shop_id");
        $minDate=$request->get("minDate");
        $maxDate=$request->get("maxDate");
        $shops=Shop::all();
        $query = Order::orderBy('id');
        if ($shop_id!==null){
            $query->where("shop_id",$shop_id);
        }
        if ($minDate!==null){
            $query->where("created_at",'>=',$minDate);
        }
        if ($maxDate!==null){
            $query->where("created_at",'<=',$minDate);
        }
        $orders=$query->paginate(5);
        $search=$request->query;
        return view("admin.order.index", compact("orders",'shops','search'));
    }
    public function day(Request $request){
        $users=User::where('status',"!=",0)->get();

        $shop_id=$request->get("shop_id");
        $start=$request->get("start");
        $end=$request->get("end");
        $query=Order::orderBy("id")

            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date,sum(total) as money,count(*) as count'))
            ->groupBy(DB::raw('date'))
            ->orderBy('date','desc')
            ->limit(30);

        $shopId="";
        if($shop_id!==null){
            $query->where('shop_id',$shop_id);
            $shopId=Order::where('shop_id',$shop_id)->first()->shop_id;
        }
        if($start!==null){
            $query->where('created_at','>=',$start);
        }
        if($end!==null){
            $query->where('created_at','<=',$end);
        }
        $orders=$query->get();

        return view("admin.order.day",compact("orders","users",'shopId','shop_id'));
    }
//    每月点单量


    public function moth(Request $request){
        $users=User::where('status',"!=",0)->get();

        $shop_id=$request->get("shop_id");
        $start=$request->get("start");
        $end=$request->get("end");
        $query=Order::orderBy("id")
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date,sum(total) as money,count(*) as count'))
            ->groupBy(DB::raw('date'))
            ->orderBy('date','desc')
            ->limit(30);
        $shopId="";
        if($shop_id!==null){
            $query->where('shop_id',$shop_id);
            $shopId=Order::where('shop_id',$shop_id)->first()->shop_id;
        }
        if($start!==null){
            $query->where('created_at','>=',$start);
        }
        if($end!==null){
            $query->where('created_at','<=',$end);
        }
        $orders=$query->get();

        return view("admin.order.moth",compact("orders","users",'shopId','shop_id'));
    }
//    菜品每日销量
    public function cartDay(Request $request){
        $shopId="";
        $shop_id=$request->get("shop_id");
        $users=User::where('status',"!=",0)->get();
        $query=OrderGood::orderBy('id');
        if($shop_id!==null) {
            $orders = Order::where("shop_id", $shop_id)->select(DB::raw('id'))->get();
            $order_id = [];
            foreach ($orders as $order) {
                $order_id[] = $order->id;
            }
            $query->whereIn('order_id', $order_id);
            $shopId=Order::where('shop_id',$shop_id)->first()->shop_id;
        }
        $query->select(DB::raw('DATE_FORMAT(created_at,"%Y-%m-%d") as date,goods_id,goods_name,goods_img,sum(amount) as nums'))
            ->groupBy(DB::raw('date,goods_id'))
             ->orderBy('date','desc');
           $order_goods=$query ->get();
        return view("admin.order.cartDay",compact("order_goods",'users','shop_id','shopId'));
    }
    public function cartMoth(Request $request){
        $shopId="";
        $shop_id=$request->get("shop_id");
        $users=User::where('status',"!=",0)->get();
        $query=OrderGood::orderBy('id');
        if($shop_id!==null) {
            $orders = Order::where("shop_id", $shop_id)->select(DB::raw('id'))->get();
            $order_id = [];
            foreach ($orders as $order) {
                $order_id[] = $order->id;
            }
            $query->whereIn('order_id', $order_id);
            $shopId=Order::where('shop_id',$shop_id)->first()->shop_id;
        }
        $query->select(DB::raw('DATE_FORMAT(created_at,"%Y-%m") as date,goods_id,goods_name,goods_img,sum(amount) as nums'))
            ->groupBy(DB::raw('date,goods_id'))
            ->orderBy('date','desc');
        $order_goods=$query ->get();
        return view("admin.order.cartMoth",compact("order_goods",'users','shop_id','shopId'));
    }

//    菜品总点击量
    public function cartAll(Request $request){
        $shopId="";
        $shop_id=$request->get("shop_id");
        $users=User::where('status',"!=",0)->get();
        $query=OrderGood::orderBy('goods_id');
        if($shop_id!==null) {
            $orders = Order::where("shop_id", $shop_id)->select(DB::raw('id'))->get();
            $order_id = [];
            foreach ($orders as $order) {
                $order_id[] = $order->id;
            }
            $query->whereIn('order_id', $order_id);
            $shopId=Order::where('shop_id',$shop_id)->first()->shop_id;
        }

            $query ->select(DB::raw('goods_id,goods_name,goods_img,sum(amount) as nums'))
                   ->groupBy(DB::raw('goods_id'));
           $order_goods=$query->get();
        return view("admin.order.cartAll",compact("order_goods",'shopId',"shop_id","users"));
    }

}
