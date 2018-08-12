<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validate = Validator::make($data, [
                'name' => 'required',
                'tel' => [
                    'required',
                    'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/'
                ],
                'provence' => 'required',
                'city' => 'required',
                'area' => 'required',
                'detail_address' => 'required',
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
            $address = Address::create($data);
            if ($address) {
                return [
                    'status' => "true",
                    //获取错误信息
                    "message" => "添加成功"
                ];
            }
        }

    }

    public function list(Request $request)
    {
        $id = $request->post('user_id');

        $address = Address::where("user_id", $id)->get();

        return $address;

    }

    public function editAddress(Request $request)
    {
        $id = $request->post("id");
        $address = Address::where('id', $id)->first();
        return $address;

    }

    public function edit(Request $request)
    {
        $id = $request->post("id");
        $address = Address::findOrFail($id);
        if ($request->isMethod('post')) {
            $data = $request->all();
            $address->update($data);
            return [
                'status' => "true",
                //获取错误信息
                "message" => "编辑成功"
            ];
        }
    }
}
