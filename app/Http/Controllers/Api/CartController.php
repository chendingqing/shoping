<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $goods = $request->post("goodsList");
        $goodsCounts = $request->post('goodsCount');
        $data['user_id'] = $request->post('user_id');

        Cart::where("user_id", $data['user_id'])->delete();
            foreach ($goods as $k => $good) {
                $data['amount'] = $goodsCounts[$k];
                $data['goods_id'] = $good;
                $goods = Cart::create($data);
            }

        return [
            'status' => "true",
            //获取错误信息
            "message" => "添加成功"
        ];
    }

    public function list(Request $request)
    {
        $id = $request->input('user_id');
        $carts = Cart::where('user_id', $id)->get();
//        dd($carts);
        $goods_list = [];
        $totalCost = "";
        foreach ($carts as $cart) {
            $goods = $cart->goods_id;
            $goods = Menu::where("id", $goods)->first(['goods_name', 'goods_img', 'goods_price']);
            $goods->amount = $cart->amount;
            $goods->goods_id = "{$goods['id']}";
            $totalCost += $goods->amount * $goods->goods_price;
            $goods_list[] = $goods;
        }
        return [
            'goods_list' => $goods_list,
            'totalCost' => $totalCost
        ];
    }

}
