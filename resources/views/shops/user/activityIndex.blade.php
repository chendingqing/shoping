@extends('layouts.default')
@section("title","活动列表")
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-bordered">
                        <tbody>
                        <tr>
                            <th>id</th>
                            <th>活动标题</th>
                            <th>活动内容</th>
                            <th>活动开始时间</th>
                            <th>活动结束时间</th>
                        </tr>
                        @foreach($acts as $act)
                            <tr>
                                <td>{{$act->id}}</td>
                                <td>{{$act->title}}</td>
                                <td>{!! $act->content !!}</td>
                                <td>{{$act->start_time}}</td>
                                <td>{{$act->end_time}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

{{$acts->links()}}
@endsection