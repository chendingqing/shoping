@extends('layouts.default')
@section("title","店铺注册列表")
@section('content')

    <form action="" method="post" class="form-inline col-sm-8 control-label" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            菜品名称：<input type="text" class="form-control" placeholder="name" name="goods_name" >
        </div>
        <br/>
        <div class="form-group">
            菜品 评分： <input type="text" class="form-control"  name="rating">
        </div>
        <br/>
        所属分类:<select name="category_id" >
            @foreach($cates as $cate)
                <option value="{{$cate->id}}">{{$cate->name}}</option>
            @endforeach
        </select>
        <br/>
        <div class="form-group">
            商品价格 : <input type="text" class="form-control" name="goods_price">
        </div>
        <br/>
        <div class="form-group">
            菜品 描述 ： <input type="text" class="form-control" name="description">
        </div>
        <br/>
        <div class="form-group">
            菜品 销量：  <input type="text" class="form-control" name="month_sales">
        </div>
        <br/>
        <div class="form-group">
            评分数量 ： <input type="text" class="form-control" name="rating_count">
        </div>
        <br/>
        <div class="form-group">
            提示信息:<input type="text" class="form-control" name="tips">
        </div>
        <br/>
        <div class="form-group">
            满意数量:<input type="text" class="form-control" name="satisfy_count">
        </div>
        <br/>
        <div class="form-group">
            满意评分:<input type="text" class="form-control" name="satisfy_rate">
        </div>
        <br/>
        <div class="form-group">
            菜品图片:
            <input type="hidden" name="goods_img" id="goods_img">
            <!--dom结构部分-->
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
        </div>
        <br/>
        <div class="checkbox">
            菜品状态:<label>
                <input type="checkbox" value="1" name="status">是
            </label>
            <label>
                <input type="checkbox" value="0"name="status">否
            </label>
        </div>
  <br/>
        <button type="submit" class="btn btn-success">添加菜品</button>
    </form>
@endsection

@section('js')
    <script>
        // 图片上传demo
        jQuery(function() {
            var $ = jQuery,
                $list = $('#fileList'),
                // 优化retina, 在retina下这个值是2
                ratio = window.devicePixelRatio || 1,

                // 缩略图大小
                thumbnailWidth = 100 * ratio,
                thumbnailHeight = 100 * ratio,

                // Web Uploader实例
                uploader;

            // 初始化Web Uploader
            uploader = WebUploader.create({

                // 自动上传。
                auto: true,
          formData:{
                    _token:'{{csrf_token()}}'
          },

                // swf文件路径
                swf: 'webuploader/Uploader.swf',

                // 文件接收服务端。
                server: '{{route('menu.upload')}}',

                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: '#filePicker',

                // 只允许选择文件，可选。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                }
            });

            // 当有文件添加进来的时候
            uploader.on( 'fileQueued', function( file ) {
                var $li = $(
                    '<div id="' + file.id + '" class="file-item thumbnail">' +
                    '<img>' +
                    '<div class="info">' + file.name + '</div>' +
                    '</div>'
                    ),
                    $img = $li.find('img');

                $list.append( $li );

                // 创建缩略图
                uploader.makeThumb( file, function( error, src ) {
                    if ( error ) {
                        $img.replaceWith('<span>不能预览</span>');
                        return;
                    }

                    $img.attr( 'src', src );
                }, thumbnailWidth, thumbnailHeight );
            });

            // 文件上传过程中创建进度条实时显示。
            uploader.on( 'uploadProgress', function( file, percentage ) {
                var $li = $( '#'+file.id ),
                    $percent = $li.find('.progress span');

                // 避免重复创建
                if ( !$percent.length ) {
                    $percent = $('<p class="progress"><span></span></p>')
                        .appendTo( $li )
                        .find('span');
                }

                $percent.css( 'width', percentage * 100 + '%' );
            });

            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            uploader.on( 'uploadSuccess', function( file ,date) {
                $( '#'+file.id ).addClass('upload-state-done');
                $("#goods_img").val(date.url)
            });

            // 文件上传失败，现实上传出错。
            uploader.on( 'uploadError', function( file ) {
                var $li = $( '#'+file.id ),
                    $error = $li.find('div.error');

                // 避免重复创建
                if ( !$error.length ) {
                    $error = $('<div class="error"></div>').appendTo( $li );
                }

                $error.text('上传失败');
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            uploader.on( 'uploadComplete', function( file ) {
                $( '#'+file.id ).find('.progress').remove();
            });
        });
    </script>
    @endsection


