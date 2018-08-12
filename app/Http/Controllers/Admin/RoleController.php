<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
     $roles=Role::all();
     return view("admin.role.index",compact("roles"));
    }
    public function add(Request $request){
        //接收权限路由
        $pers=Permission::all();
        if ($request->isMethod('post')){
            //接收值
            $date['name']=$request->post("name");
            $date['guard_name']="admin";

            //添加用户组
            $role=Role::create($date);
            //同时添加用户组权限管理
            $role->syncPermissions($request->post('per'));
          //添加返回

            $request->session()->flash("success","添加成功");
            return redirect()->route("role.index");
        }
        //显示视图 传递路由权限
     return view("admin.role.add",compact("pers"));
    }
    public function edit(Request $request,$id){
        $role=Role::find($id);
         $pers=Permission::all();
         if ($request->isMethod('post')){
             $date['name']=$request->post("name");
             $date['guard_name']="admin";
             $role->update($date);
             //同时添加用户组权限管理
             $role->syncPermissions($request->post('per'));
             //编辑返回
             $request->session()->flash("success","编辑成功");
             return redirect()->route("role.index");

         }
         return view("admin.role.edit",compact("role","pers"));
    }
    public function del(Request $request,$id){

        if($id=="6"){
            $request->session()->flash("danger","超级管理员不能删除");
            return redirect()->route("role.index");
        }else{
            $role=Role::findOrFail($id);
            $role->delete();
            $request->session()->flash("success","删除成功");
            return redirect()->route("role.index");

        }

    }
}
