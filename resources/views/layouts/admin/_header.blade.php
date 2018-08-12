<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">点餐平台</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @auth('admin')
            <ul class="nav navbar-nav">

                {{--<li><a href="http://admin.elm.com/shop/index">商铺管理</a></li>--}}
                {{--<li><a href="/shop_category/index">商铺分类管理</a></li>--}}
                {{--<li><a href="http://admin.elm.com/admin/index">管理员管理</a></li>--}}
                {{--<li><a href="{{route('admin.userIndex')}}">商户管理</a></li>--}}
                {{--<li><a href="{{route('activity.index')}}">活动管理</a></li>--}}



                @foreach(\App\Models\Nav::where("pid",0)->get() as $k=>$v)
                <li class="dropdown">
                    <a href="{{route($v->url)}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">{{$v->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach(\App\Models\Nav::where("pid",$v->id)->get() as $k1=>$v1)
                            @if(\Illuminate\Support\Facades\Auth::guard('admin')->user()->can($v1->url))
                        <li><a href="{{route($v1->url)}}">{{$v1->name}}</a></li>
                            @endif
                        @endforeach

                    </ul>
                </li>

    @endforeach




                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"--}}
                       {{--aria-expanded="false">菜品统计<span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                {{--<li><a href="{{route('orders.cartAll')}}">所有菜品总点击量统计</a></li>--}}
                {{--<li><a href="{{route("orders.cartDay")}}">商家菜品每日点击量统计</a></li>--}}
                {{--<li><a href="{{route("orders.cartMoth")}}">商家菜品每月点击量统计</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li><a href="{{route("member.index")}}">会员管理</a></li>--}}
            </ul>

            <ul class="nav navbar-nav navbar-right" >

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false">{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}<span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <li><a href="update/{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->id}}">修改密码</a></li>

                            <li role="separator" class="divider"></li>
                            <li><a href="{{route('admin.logout')}}">注销</a></li>
                        </ul>
                    </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    @endauth
    @guest('admin')
        <ul class="nav navbar-nav navbar-right" >
            <li><a href="{{route("admin.login")}}">登录</a></li>
        </ul>
    @endguest
</nav>

