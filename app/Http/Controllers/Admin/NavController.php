<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class NavController extends Controller
{

    public function add(Request $request){
        $routes=Route::getRoutes();
        $route[]='';
        foreach ($routes as $k=>$v){
            if (isset($v->action['namespace']) && $v->action['namespace']=="App\Http\Controllers\Admin"){
                $route[]= $v->action['as'];
            }
        }
        $urls=Nav::where('pid',0)->orderBy('sort')->get();
        if ($request->isMethod('post')){
           $data=$request->post();
//           dd($data);
           Nav::create($data);
            $request->session()->flash("success","添加成功");
           return redirect()->route("nav.add");
        }

return     view("admin.nav.add",compact("route",'urls'));
    }
}
