<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends BaseController
{
    public function index(Request $request)
    {

        $query = Activity::orderBy("id");
        $date = date(now());
        $time = $request->get('status');
        if ($time == -1) {
            $query->where("start_time", '>=', $date);
        }
        if ($time == 1) {
            $query->where("start_time", '<=', $date)->where("end_time", '>=', $date);
        }
        if ($time == 2) {
            $query->where("end_time", '<=', $date);
        }
        $acts = $query->paginate(3);

        return view("admin.activity.index", compact('acts'));
    }

    public function add(Request $request)
    {

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'title' => 'required|min:2',
                'content' => 'required',
            ]);
            $data = $request->post();

            if (Activity::create($data)) {
                session()->flash("success", "添加成功");
                return redirect()->route("activity.index");
            }
        }


        return view("admin.activity.add");
    }

    public function edit(Request $request, $id)
    {
        $act = Activity::findOrFail($id);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'title' => 'required|min:2',
                'content' => 'required',
            ]);
            $data = $request->post();

            if ($act->update($data)) {
                session()->flash("success", "编辑成功");
                return redirect()->route("activity.index");
            }
        }
        return view("admin.activity.edit", compact('act'));
    }

    public function del(Request $request, $id)
    {
        $act = Activity::findOrFail($id);
        if ($act->delete()) {
            session()->flash("success", "删除成功");
            return redirect()->route("activity.index");
        }

    }
}

