<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends BaseController
{
    public function index(Request $request){
      $members=Member::paginate(10);
      $query=$request->query;

      return view("admin.member.index",compact("members",'query'));
    }
    public function fill(Request $request,$id){

        $member=Member::find($id);

        if ($request->isMethod('post')){

            $member->money+=$request->post("money");
            $member->save();
            $request->session()->flash("success","充值成功");
            return redirect()->route("member.index");
        }
    return view("admin.member.fill",compact('member'));
    }
    public function change(Request $request,$id){
        $member=Member::find($id);
        $member->status = -1;
        $member->save();
        $request->session()->flash("danger","会员已禁用");
        return redirect()->route("member.index");
    }
    public function find(Request $request,$id){
        $member=Member::find($id);
        return view("admin.member.find",compact("member"));

    }

}
