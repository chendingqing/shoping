<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class BaseController extends Controller
{
    public function __construct()
    {
        //添加保安 验证登录
        $this->middleware('auth:admin', [
            'except' => ['login', 'index'],
        ]);
        $this->middleware('guest:admin', [
            'only' => ['login'],
        ]);

        $this->middleware(function ($request, Closure $next) {
            $admin = Auth::guard('admin')->user();
            if (!in_array(Route::currentRouteName(), ["admin.login", "admin.logout"])) {
                if ($admin->can(Route::currentRouteName()) === false) {
                    exit(view('admin.admin.out'));
                }
            }
            return $next($request);

        });

    }
}
