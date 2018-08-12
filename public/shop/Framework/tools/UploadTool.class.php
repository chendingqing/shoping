<?php
/**
 * Created by PhpStorm.
 * User: ShengSheng
 * Date: 2018/5/18
 * Time: 19:56
 */

class UploadTool
{
//上传图片
public $error;
public function upload($file){
//    var_dump($file);exit;
    //类名

    if($file['error']!==0){
        $this->error="文件上传失败";
        return false;
    }
    //限制文件大小
    if($file['size']>2*1024*1024){
        $this->error="文件超过2M";
        return false;
    }
    //限定文件类型
    $allowType=['image/png', 'image/jpeg', 'image/gif','image/jpg'];
    //判断文件类型是否正确
    if(!in_array($file['type'],$allowType)){
        $this->error="文件类型不是图片类型";
        return false;
    }

    //得到图片后缀名 后面的字符串必须是唯一的
    $ext=strrchr($file['name'],'.');
    $file['name']=uniqid("goods");
    $dir="Uploads/";
    if(!is_dir($dir)){
        mkdir($dir,777,true);
    }
    $filePath=$dir.$file['name'].$ext;
    if(!is_uploaded_file($file['tmp_name'])){
        $this->error="文件不是浏览器上传";
        return false;
    }
    if(move_uploaded_file($file['tmp_name'],$filePath)){

   return $filePath;
    }
}

}