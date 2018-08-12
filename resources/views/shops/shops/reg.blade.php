
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>@yield("title","注册")</title>

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
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">   <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">减肥秘诀</a></li>
                            <li><a href="#">少吃肉，多吃蔬菜</a></li>
                            <li><a href="#">多敲代码，少抽烟</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">努力吧！肥仔@</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">期待更好的你，而不是自甘堕弱的你!加油！</a></li>
                        </ul>
                    </li>
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





<form action="" method="post" class="form-inline col-sm-8 control-label" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <input type="text" class="form-control" placeholder="name" name="name">
    </div>
    <br/>
    <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password">
    </div>
    <br/>
    <div class="form-group">
        <input type="email" class="form-control" placeholder="email" name="email">
    </div>
    <br/>
    <div class="form-group">
        <input type="text" class="form-control" placeholder="店铺名称" name="shop_name">
    </div>
    <br/>
    <div class="form-group">
        店铺分类:<select name="shop_category_id">
            @foreach($cates as $cate)
                <option value="{{$cate->id}}">{{$cate->name}}</option>
            @endforeach
        </select>
    </div>
    <br/>
    <div class="form-group">
        店铺图片:
        <div id="uploader-demo">
            <!--用来存放item-->
            <input type="hidden" name="shop_img" id="shop_img">
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>
        </div>
    </div>
    <br/>
    <div class="checkbox">
        是否品牌:<label>
            <input type="checkbox" value="1" name="brand">是
        </label>
        <label>
            <input type="checkbox" value="0" name="brand">否
        </label>
    </div>
    <br/>
    <div class="checkbox">
        是否准时送达:<label>
            <input type="checkbox" value="1" name="on_time">是
        </label>
        <label>
            <input type="checkbox" value="0" name="on_time">否
        </label>
    </div>
    <br/>
    <div class="checkbox">
        是否蜂鸟配送:<label>
            <input type="checkbox" value="1" name="fengniao">是
        </label>
        <label>
            <input type="checkbox" value="0" name="fengniao">否
        </label>
    </div>
    <br/>
    <div class="checkbox">
        是否保:<label>
            <input type="checkbox" value="1" name="bao">是
        </label>
        <label>
            <input type="checkbox" value="0" name="bao">否
        </label>
    </div>
    <br/>
    <div class="checkbox">
        是否票:<label>
            <input type="checkbox" value="1" name="piao">是
        </label>
        <label>
            <input type="checkbox" value="0" name="piao">否
        </label>
    </div>
    <br/>
    <div class="checkbox">
        是否准:<label>
            <input type="checkbox" value="1" name="zhun">是
        </label>
        <label>
            <input type="checkbox" value="0" name="zhun">否
        </label>
    </div>
    <br/>
    <div class="form-group">
        <input type="text" class="form-control" placeholder="起送金额" name="start_send">
    </div>
    <br/>
    <div class="form-group">
        <input type="text" class="form-control" placeholder="配送费" name="send_cost">
    </div>
    <br/>
    <button type="submit" class="btn btn-success">注册</button>
</form>
    {{--@include('vendor.ueditor.assets')--}}

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

<script>
    // 初始化Web Uploader
    var uploader = WebUploader.create({

        // 选完文件后，是否自动上传。
        auto: true,
        formData:{
            _token:'{{csrf_token()}}'
        },
        // swf文件路径
        swf:  '/webuploader/Uploader.swf',

        // 文件接收服务端。
        server:'{{route('shops.upload')}}',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',

        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }
    });
    // 当有文件被添加进队列的时候
    uploader.on( 'fileQueued', function( file ) {
        var $list=$('#fileList')
        $list.append( '<div id="' + file.id + '" class="item">' +
            '<h4 class="info">' + file.name + '</h4>' +
            '<p class="state">等待上传...</p>' +
            '</div>' );
    });

    uploader.on( 'uploadSuccess', function( file ,date) {
        $( '#'+file.id ).find('p.state').text('已上传');
        $("#shop_img").val(date.url);
    });

    uploader.on( 'uploadError', function( file ) {
        $( '#'+file.id ).find('p.state').text('上传出错');
    });

    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').fadeOut();
    });

</script>


@include("layouts.admin._footer")
</body>

</html>










































