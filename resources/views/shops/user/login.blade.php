<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>@yield("title","用户登录")</title>

    <!-- Bootstrap -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <link rel="stylesheet" type="text/css" href="/webuploader/main.css">
    <link rel="stylesheet" type="text/css" href="/webuploader/style.css">


    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

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
            <a class="navbar-brand" href="#">店铺平台</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @auth('admin')
                <ul class="nav navbar-nav">

                    <li><a href="http://admin.elm.com/shop/index">商铺管理</a></li>
                    <li><a href="/shop_category/index">商铺分类管理</a></li>
                    <li><a href="http://admin.elm.com/admin/index">管理员管理</a></li>
                    <li><a href="{{route('admin.userIndex')}}">商户管理</a></li>
                    <li><a href="{{route('activity.index')}}">活动管理</a></li>

                </ul>

                <ul class="nav navbar-nav navbar-right" >

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">查看个人信息</a></li>
                            <li><a href="update/{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->id}}">修改密码</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route('admin.logout')}}">注销</a></li>
                        </ul>
                    </li>
                </ul>
                {{--<form class="navbar-form navbar-right">--}}
                {{--<div class="form-group">--}}
                {{--<input type="text" class="form-control" placeholder="Search">--}}
                {{--</div>--}}
                {{--<button type="submit" class="btn btn-default">Submit</button>--}}
                {{--</form>--}}
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    @endauth
    @guest('admin')
        <ul class="nav navbar-nav navbar-right" >
            <li><a href="{{route('user.login')}}">登录</a></li>
            <li><a href="{{route('shops.reg')}}">注册</a></li>
        </ul>
    @endguest
</nav>
@include("layouts._errors")
@include("layouts._msg")
<div class="container-fluid">


    <div class="container-fluid">
        <h2 align="center">用户登录</h2>
        <form action="" method="post" class="form-inline" enctype="multipart/form-data" align="center">
            {{ csrf_field() }}
            用户姓名： <input type="text" name="name" placeholder="用户名" value="{{old('name')}}"><br/>
            用户密码： <input type="password" name="password" placeholder="密码" value="{{old('password')}}"><br/>
            <input type="checkbox" name="remember">记住密码<br/>
            <input type="submit" value="登录" class="btn btn-success">
        </form>

        {{--@include('vendor.ueditor.assets')--}}

    </div>

</div>




<script type="text/javascript">

    var ue = UE.getEditor('container');
    ue.ready(function () {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });
</script>
<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="/bootstrap/js/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="/webuploader/webuploader.js"></script>
@yield("js")

@include("layouts.admin._footer")
</body>

</html>



























