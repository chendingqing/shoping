<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends BaseController
{
    public function index()
    {
        $admins = Admin::all();

//        dd($roles);
        return view("admin.admin.index", compact("admins"));
    }

    public function add(Request $request)
    {
        $roles=Role::all();
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|min:2',
                'email' => 'required|email',
                'password' => 'required|confirmed',
            ]);
            $data = $request->post();
            $data['password'] = bcrypt($data['password']);
            $admin=Admin::create($data);
            if ($admin) {
                // 所有当前角色将从用户中删除，并替换为给定的数组中的角色
                $admin->syncRoles($request->post('per'));
                session()->flash("success", "添加成功");
                return redirect()->route("admin.index");
            }
        }
        return view("admin.admin.add",compact('roles'));
    }

    public function edit(Request $request, $id)
    {
        $roles=Role::all();
        $admin = Admin::findOrFail($id);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|min:2',
                'email' => 'required|email',
                'password' => 'required|confirmed',
            ]);
            $data = $request->post();
            $data['password'] = bcrypt($data['password']);
            if ($admin->update($data)) {
                $admin->syncRoles($request->post('per'));
                session()->flash("success", "编辑成功");
                return redirect()->route("admin.index");
            }
        }
        return view("admin.admin.edit", compact("admin",'roles'));
    }

    public function del(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        if ($admin->id == 1) {
            session()->flash("danger", "管理员不可删除");
            return redirect()->back()->withInput();
        } elseif ($admin->delete()) {
            session()->flash("success", "删除成功");
            return redirect()->route("admin.index");
        }
    }

    public function login(Request $request)
    {

        if ($request->isMethod("post")) {
            $this->validate($request, [
                "name" => "required|min:2",
                "password" => "required",
            ]);
            if (Auth::guard('admin')->attempt(['name' => $request->post('name'), 'password' => $request->post('password')], $request->has('remember'))) {
                //提示
                $request->session()->flash("success", "登录成功");
                //echo "登录成功";
                //跳转
                return redirect()->route('admin.index');

            } else {
                //提示
                $request->session()->flash("danger", "账号或密码错误");
                //跳转
                return redirect()->back()->withInput();
            }
        }
        return view("admin.admin.login");
    }

    public function update(Request $request, $id)
    {
        $admin = Auth::guard('admin')->user();
        if ($request->isMethod('post')) {
            if (Hash::check($request->post('password'), $admin->password)) {
                $request->user()->fill([
                    'password' => Hash::make($request->post('re_password'))
                ])->save();
                session()->flash("success", "密码修改成功");
                return redirect()->route('admin.index');
            } else {
                session()->flash("success", "旧密码不正确");
                return redirect()->back()->withInput();
            }
        }
        return view("admin.admin.update");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flash('success', '注销成功');
        return redirect()->route('admin.login');
    }

    public function userIndex()
    {
        $users = User::paginate(3);
        return view('admin.admin.userIndex', compact("users"));
    }

    public function modify(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user['password'] = bcrypt("123456");
        $user->save();
        return back()->with("success", "重置成功");
    }
    public function out(){
        return view("admin.admin.out");
    }
}
