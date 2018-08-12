@extends('layouts.admin.default')
@section("title","店铺详情列表")
@section('content')

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>会员名称</th>
            <th>会员电话</th>
            <th>会员余额</th>
            <th>状态</th>
            <th>操作</th>
        </tr>

            <tr>
                @foreach($members as $member)
                <td>{{$member->id}}</td>
                <td>{{$member->username}}</td>
                <td>{{$member->tel}}</td>
                <td>{{$member->money}}</td>
                <td>
                    @if($member->status===1)
                        <a href="#" class="btn btn-success">正常</a>
                    @elseif($member->status===-1)
                        <a href="#" class="btn btn-danger">禁用</a>
                    @endif
                </td>
                <td>
                    <a href="{{route('member.fill',$member->id)}}"class="btn btn-success">充值</a>
                    <a href="{{route('member.find',$member->id)}}"class="btn btn-info">查看详情</a>
                    @if($member->status!==-1)
                    <a href="{{route('member.change',$member->id)}}"class="btn btn-danger">禁用</a>
                     @endif
                </td>

            </tr>
        @endforeach
    </table>
    {{$members->appends("query")->links()}}

@endsection