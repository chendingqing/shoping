<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mews\Captcha\Facades\Captcha;
use Mrgoon\AliSms\AliSms;

class MemberController extends Controller
{
    public function sms(Request $request)
    {

        $tel = $request->input('tel');
        $code = rand(1000, 9999);
        //把验证码存起来
//        存缓存验证码
        Cache::put("tel_".$tel, $code, 300);

        $config = [
            'access_key' => 'LTAIkutC9HFgfFDr',
            'access_secret' => 'WQeqwOPWwcuKhgMwdGF9BdbcyvfokR',
            'sign_name' => '陈定清',
        ];

        $aliSms = new AliSms();
        $response = $aliSms->sendSms($tel, 'SMS_140665163', ['code' => $code], $config);


        if ($response->Message === "OK") {
            return [
                "status" => "true",
                "message" => "获取短信验证码成功"
            ];
        } else {
            return [
                "status" => "false",
                "message" => $response->Message
            ];
        }
    }
//注册
    public function reg(Request $request)
    {

        //接收参数
        $data = $request->all();
        //创建一个验证规则
        $validate = Validator::make($data, [
            'username' => 'required|unique:members',
           'sms' => 'required|integer|min:1000|max:9999',
           'tel' => [
               'required',
               'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/',

           ],
          'password' => 'required|min:6'
                ]);
 //验证 如果有错
   if ($validate->fails()) {

           //返回错误
           return [
                'status' => "false",
                //获取错误信息
                "message" => $validate->errors()->first()
            ];
        }
        $data['password'] = bcrypt($request->input('password'));
        $sms = $request->input('sms');

        $redis= Cache::get("tel_".$data['tel']);

        if ($sms == $redis) {
            Member::create($data);
            return [
                "status" => "true",
                "message" => "注册成功"
            ];
        } else {
            return [
                "status" => "false",
                "message" => "注册失败"
            ];
        }

    }

    public function login(Request $request)
    {
        $name = $request->post('name');

        $user = Member::where('username', $name)->first();

        if (($user)) {
            if ($user && Hash::check($request->post('password'), $user->password)) {
                return [
                    'status' => 'true',
                    'message' => '登录成功',
                    'user_id' => $user->id,
                    'username' => $user->username
                ];
            }
        }
        return [
            'status' => 'false',
            'message' => '登录失败'
        ];


    }

    public function remember(Request $request)
    {
        $tel = $request->post('tel');
        $user = Member::where('tel', $tel)->first();
        if ($user) {
            $sms = $request->input('sms');
            if ($sms === Redis::get("tel_" . $user->tel)) {
                $date = $request->all();
                $date['password'] = bcrypt($request->post('password'));
                $user->update($date);
                return [
                    "status" => "true",
                    "message" => "重置成功"
                ];
            } else {
                return [
                    "status" => "true",
                    "message" => "重置失败"
                ];
            }

        }
    }

    public function update(Request $request)
    {
        $id = $request->post('id');
        $user = Member::findOrFail($id);
        if ($user && Hash::check($request->post('oldPassword'), $user->password)) {
            $date['password'] = bcrypt($request->post("newPassword"));
            if ($user->update($date)) {
                return [
                    'status' => 'true',
                    'message' => '修改成功',
                ];
            } else {
                return [
                    'status' => 'false',
                    'message' => '修改失败',
                ];
            }
        } else {
            return [
                'status' => 'false',
                'message' => '旧密码验证失败',
            ];
        }
    }

    public function index(Request $request)
    {
        $id = $request->get("user_id");
        $data = Member::findOrFail($id);
        return $data;
    }

}
