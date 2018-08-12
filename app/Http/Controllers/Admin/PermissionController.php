<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    //显示权限
    public function index(Request $request){
      $permissions=Permission::paginate(10);
      return view('admin.permission.index',compact('permissions'));

   }
//   添加权限
    public function add(Request $request){


        $routes=Route::getRoutes();
        $route[]='';
       foreach ($routes as $k=>$v){

    if (isset($v->action['namespace']) && $v->action['namespace']=="App\Http\Controllers\Admin"){
        $route[]= $v->action['as'];
    }
       }

        if ($request->isMethod('post')){
          $dates=$request->post('per');
          foreach ($dates as $k=>$v){
            $data['name']=$v;
            $data['guard_name']='admin';
            Permission::create($data);
          }
            $request->session()->flash("success","添加成功");
            return redirect()->route("permission.index");
        }




      return view("admin.permission.add",compact("route"));
    }
//    删除权限
    public function del(Request $request,$id){
        $data=Permission::find($id);
        $data->delete();
        $request->session()->flash("success","删除成功");
        return redirect()->route("permission.index");
    }

}
