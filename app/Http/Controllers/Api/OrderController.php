<?php

namespace App\Http\Controllers\Api;

use App\Mail\OrderShipped;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderGood;
use App\Models\Shop;
use App\Models\User;
use EasyWeChat\Foundation\Application;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Mrgoon\AliSms\AliSms;

class OrderController extends Controller
{
    public function add(Request $request)
    {
        $user_id = $request->post('user_id');
        $address_id = $request->post('address_id');
        if ($address_id == null) {
            return [
                "status" => "false",
                "message" => "请选择地址"
            ];
        }
        $data = [];
        $goods = Cart::where("user_id", $user_id)->get();
        $total = '';
        foreach ($goods as $k => $v) {
            $good = Menu::where("id", $v->goods_id)->first();
            $shop_id = $good->shop_id;
            $total += $v->amount * $good->goods_price;
        }
        $address = Address::where("id", $address_id)->first(['provence', 'city', 'area', 'detail_address', 'tel', 'name']);
        $data['shop_id'] = $shop_id;
        $data['user_id'] = $user_id;
        $data['sn'] = date('ymdHis') . rand(1000, 9999);
        $data['province'] = $address->provence;
        $data['city'] = $address->city;
        $data['area'] = $address->area;
        $data['detail_address'] = $address->detail_address;
        $data['tel'] = $address->tel;
        $data['name'] = $address->name;
        $data['status'] = 0;
        $data['total'] = $total;
        //开启事务
        DB::beginTransaction();

        try {
            $order = Order::create($data);

            foreach ($goods as $a => $b) {
                $good = Menu::find($b->goods_id);
                $date['order_id'] = $order->id;
                $date['goods_id'] = $good->id;
                $date['amount'] = $b->amount;
                $date['goods_name'] = $good->goods_name;
                $date['goods_img'] = $good->goods_img;
                $date['goods_price'] = $good->goods_price;
                  OrderGood::create($date);

            }
            DB::commit();
        } catch (QueryException $exception) {
            //回滚
            DB::rollBack();
            //返回数据
            return [
                "status" => "false",
                "message" => $exception->getMessage(),
            ];
        }

        return [
            "status" => "true",
            "message" => "添加成功",
            "order_id" => $order->id
        ];

        $config = [
            'access_key' => 'LTAIkutC9HFgfFDr',
            'access_secret' => 'WQeqwOPWwcuKhgMwdGF9BdbcyvfokR',
            'sign_name' => '陈定清',
        ];

        $aliSms = new AliSms();
        $response = $aliSms->sendSms($users->tel, 'SMS_141645188', ['product' =>$moneys->sn], $config);

    }
//列出具体的订单
    public function find(Request $request)
    {

        $order = Order::find($request->input('id'));
        $data['id'] = $order->id;
        $data['order_code'] = $order->sn;
        $data['order_birth_time'] = (string)$order->created_at;
        $data['order_status'] = $order->order_status;
        $data['shop_id'] = "$order->shop_id";
        $data['shop_name'] = $order->shop->shop_name;
        $data['shop_img'] = $order->shop->shop_img;
        $data['order_price'] = $order->total;
        $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;
        $data['goods_list'] = $order->goods;
        return $data;
    }
//支付
    public function pay(Request $request)
    {
        $id = $request->post("id");

        $moneys = Order::where("id", $id)->first();
        $amount = $moneys->total;
        $user_id = $moneys->user_id;
        $users = Member::where("id", $user_id)->first();
        $user_money = $users->money;
        if ($user_money > $amount) {
            $user_money = $user_money - $amount;
            $data['money'] = $user_money;
            $users->update($data);
            $date['status'] = 1;
            $moneys->update($date);

//            $config = [
//                'access_key' => 'LTAIkutC9HFgfFDr',
//                'access_secret' => 'WQeqwOPWwcuKhgMwdGF9BdbcyvfokR',
//                'sign_name' => '陈定清',
//            ];
//            $aliSms = new AliSms();
//            $response = $aliSms->sendSms($users->tel, 'SMS_141645188', ['product' =>$moneys->sn], $config);

            return [
                'status' => "true",
                "message" => "支付成功"
            ];

        } else {
            return [
                'status' => "false",
                "message" => "余额不足"
            ];
        }

    }

    public function list(Request $request)
    {
        $orders = Order::where("user_id", $request->input('user_id'))->get();
        $datas = [];
        foreach ($orders as $order) {

            $goods=OrderGood::where('order_id',$order->id)->get(['goods_id','goods_name','goods_img','amount','goods_price']);
            $data['id'] = "$order->id";
            $data['order_code'] = $order->sn;
            $data['order_birth_time'] = (string)$order->created_at;
            $data['order_status'] = $order->order_status;
            $data['shop_id'] = (string)$order->shop_id;
            $data['shop_name'] = $order->shop->shop_name;
            $data['shop_img'] = $order->shop->shop_img;
            $data['order_price'] = $order->total;
            $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;
            $data['goods_list'] =$goods ;
            $datas[] = $data;
        }


        return $datas;
    }


 //微信支付
    public function wxPay(Request $request){

        $order=Order::find($request->input('id'));
         //创建微信操作对象
        $app = new Application(config('wechat'));
         //得到支付对象
        $payment = $app->payment;
        //生成订单
        $attributes = [
            'trade_type'       => 'NATIVE', // JSAPI，NATIVE，APP...
            'body'             => '清哥收款',
            'detail'           => '清哥收款',
            'out_trade_no'     => time(),
            'total_fee'        => $order->total*100, // 单位：分
            'notify_url'       => 'http://www.elm.com/api/order/ok', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
//            'openid'           => '当前用户的 openid', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
//订单生成
        $order = new \EasyWeChat\Payment\Order($attributes);
        //统一下单
        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $payUrl=  $result->code_url;
            //把支付链接生成二维码


            // Create a basic QR code
            $qrCode = new QrCode($payUrl);
            $qrCode->setSize(300);

// Set advanced options
            $qrCode->setWriterByName('png');
            $qrCode->setMargin(10);
            $qrCode->setEncoding('UTF-8');
            $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);
            $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
            $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
            $qrCode->setLabel('扫码支付', 16, public_path().'/assets/noto_sans.otf', LabelAlignment::CENTER);
            $qrCode->setLogoPath(public_path().'/assets/11.png');
            $qrCode->setLogoWidth(50);
//            $qrCode->setRoundBlockSize(true);
            $qrCode->setValidateResult(false);

// Directly output the QR code
            header('Content-Type: '.$qrCode->getContentType());
            echo $qrCode->writeString();

// Save it to a file
            $qrCode->writeFile(__DIR__.'/qrcode.png');

// Create a response object
            $response = new QrCodeResponse($qrCode);
        }
    }
    //微信异步通知方法
    public function ok(){
        //1.创建操作微信的对象
        $app = new Application(config('wechat'));
        //2.处理微信通知信息
        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            //  $order = 查询订单($notify->out_trade_no);
            $order=Order::where("sn",$notify->out_trade_no)->first();
            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->status!==0) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                // $order->paid_at = time(); // 更新支付时间为当前时间
                $order->status = 1;//更新订单状态
            }
            $order->save(); // 保存订单
            return true; // 返回处理完成
        });
        return $response;
    }
    //订单状态
    public function status(Request $request)
    {
        return [
            'status'=>Order::find($request->input('id'))->status
        ];
    }
}
