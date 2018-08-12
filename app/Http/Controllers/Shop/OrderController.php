<?php

namespace App\Http\Controllers\Shop;

use App\Models\Member;
use App\Models\Order;
use App\Models\orderGood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    //订单列表
    public function index()
    {
        $shop_id=Auth::user()->shop_id;
        $orders = Order::where('shop_id',$shop_id)->get();
        return view("shops.order.index", compact("orders"));
    }

    //查看订单详情
    public function list(Request $request, $id)
    {
        $orders = OrderGood::where('order_id', $id)->get();
        return view("shops.order.list", compact('orders'));
    }

    //发货
    public function send(Request $request, $id)
    {
        $result = Order::findOrFail($id);
        $date['status'] = 3;
        $result->update($date);
        $request->session()->flash("success", "发货成功,等待用户确认");
        return redirect()->route("order.index");
    }

    //取消订单
    public function change(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $member = Member::findOrFail($order->user_id);
        $order->status = '0';
        if ($order->save()) {
            $member->money += $order->total;
            $member->save();
            $request->session()->flash("success", "订单取消成功,金额已返回用余额");
            return redirect()->route("order.index");
        }
    }
    //每日订单
    public function orderList(Request $request){
        $shop_id=Auth::user()->shop_id;

            $query=Order::where("shop_id",$shop_id)
                          ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date,sum(total) as money,count(*) as count'))
                          ->groupBy(DB::raw('date'))
                          ->orderBy('date','desc')
                         ->limit(30);
            $start=$request->get('start');
            $end=$request->get('end');

            if($start!==null){
            $query->where('created_at','>=',$start);
        }
        if($end!==null){
            $query->where('created_at','<=',$end);
        }
                 $orders=$query->get();
          return view("shops.order.orderList",compact("orders"));
      }
      //每月订单
    public function moth(Request $request){
        $shop_id=Auth::user()->shop_id;
        $query=Order::where("shop_id",$shop_id)
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date,sum(total) as money,count(*) as count'))
            ->groupBy(DB::raw('date'))
            ->orderBy('date','desc')
            ->limit(30);
        $orders=$query->get();
        return view("shops.order.moth",compact("orders"));
    }
    //总订单
    public function all(Request $request){
        $shop_id=Auth::user()->shop_id;
        $query=Order::where("shop_id",$shop_id)
            ->select(DB::raw('sum(total) as money,count(*) as count'))
            ->limit(30);
        $orders=$query->get();
        return view("shops.order.all",compact("orders"));
    }
    //菜品统计
//    每日
    public function cartLIst(Request $request){
        $shop_id=Auth::user()->shop_id;
        $orders=Order::where("shop_id",$shop_id)->select(DB::raw('id'))->get();
       $order_id=[];
        foreach ($orders as $order){
            $order_id[]=$order->id;
        }

       $order_goods=OrderGood::whereIn('order_id', $order_id)
                ->select(DB::raw('DATE_FORMAT(created_at,"%Y-%m-%d") as date,goods_id,goods_name,sum(amount) as nums'))
                ->groupBy(DB::raw('date,goods_id'))
                ->orderBy('date','desc')
                 ->get();
     return view("shops.order.cartList",compact("order_goods"));
    }
//    每月菜品点击量
    public function mothLIst(Request $request){
        $shop_id=Auth::user()->shop_id;
        $orders=Order::where("shop_id",$shop_id)->select(DB::raw('id'))->get();
        $order_id=[];
        foreach ($orders as $order){
            $order_id[]=$order->id;
        }

        $order_goods=OrderGood::whereIn('order_id', $order_id)
            ->select(DB::raw('DATE_FORMAT(created_at,"%Y-%m") as date,goods_id,goods_name,sum(amount) as nums'))
            ->groupBy(DB::raw('date,goods_id'))
            ->orderBy('date','desc')
            ->get();
        return view("shops.order.mothList",compact("order_goods"));
    }
    //菜品总订点击量
    public function allLIst(Request $request){
        $shop_id=Auth::user()->shop_id;
        $orders=Order::where("shop_id",$shop_id)->select(DB::raw('id'))->get();
        $order_id=[];
        foreach ($orders as $order){
            $order_id[]=$order->id;
        }

        $order_goods=OrderGood::whereIn('order_id', $order_id)
            ->select(DB::raw('goods_id,goods_name,sum(amount) as nums'))
            ->groupBy(DB::raw('goods_id'))
            ->get();
        return view("shops.order.allList",compact("order_goods"));
    }
}
