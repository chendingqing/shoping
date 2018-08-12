<?php
/**
 * Created by PhpStorm.
 * User: ShengSheng
 * Date: 2018/5/21
 * Time: 16:34
 */

class ImageTool
{
    /**图片缩图功能
     * @param $fileName原文件名称
     * @param $dstWidth缩图宽度
     * @param $dstHeight缩图高度
     * @param int $isFile 是否存在文件 0直接浏览器显示 1表示文件存在
     */
    public  static function thumb($fileName, $dstWidth, $dstHeight,$isFile=1)
    {
        //图片的路径
        //$fileName ="500x400.png";
        //1. 打开原图 得到原图片尺寸 图片类型
        $srcImageInfo = getimagesize($fileName);
        //>>1.1 得到图片类型 取$srcImageInfo['mime']的值"image/jpeg" ====>["image","jpeg"]====>取数组第2个元素 图片文件的类型
        $ext = explode("/", $srcImageInfo['mime'])[1];
        //>>1.2 重新拼装打开图片函数
        $openFun = "imagecreatefrom{$ext}";
        //>>1.3 重新拼装输出图片函数
        $outFun = "image{$ext}";
        //>>1.4 得到原图片的宽和高
        //list($srcWidth,$srcHeight)=$srcImageInfo;
        $srcWidth = $srcImageInfo[0];//原图宽
        $srcHeight = $srcImageInfo[1];//原图高
        //>>1.5 打开原来图片
        $srcImage = $openFun($fileName);
//2.新建一张新图片用来存缩略图
//2.1 定义缩略的尺寸
//2.2 取出最大压缩比    取    原图宽/缩略图宽，原图高/缩略图高 中的最大值
        $max = max($srcWidth / $dstWidth, $srcHeight / $dstHeight);//20
//2.3 拿源图尺寸除最大压缩比，就得到等比例尺寸
        $dstWidth = $srcWidth / $max;//最终的宽
        $dstHeight = $srcHeight / $max;//最终的高
//2.4 新建缩略图
        $dstImage = imagecreatetruecolor($dstWidth, $dstHeight);

//3.复制原图片到新图片
        /*
        imagecopyresampled($缩略图,$原图片,$缩略图X坐标,$缩略图Y坐标,$原图X坐标,$原略图Y坐标,$缩略图宽,$缩略图高,$原图片宽$原图片高);
        */
        imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $dstWidth, $dstHeight, $srcWidth, $srcHeight);

//4.保存
        //判断是否存文件
        if ($isFile){
            //存文件路径
            //>>4.1.1 得到原图片文件相关信息
            $srcPathInfo=pathinfo($fileName);

            //缩略图路径
            $dstImagePath="{$srcPathInfo['dirname']}/{$srcPathInfo['filename']}_{$dstWidth}x{$dstHeight}.{$srcPathInfo['extension']}";
            //>>4.1.1 输出到文件中
            $outFun($dstImage,$dstImagePath);

            return $dstImagePath;


        }else{
            //>>4.1 设置header头
            header("Content-type:image/{$ext}");
            //>>4.2 输出到浏览
            $outFun($dstImage);
        }

    }
}