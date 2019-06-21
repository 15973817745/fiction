<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use think\File;
class Image extends Controller
{
    //保存图片路径使用uploadify插件
    public function upload() {
        $file = Request::instance()->file('file');
        // 给定一个目录
        $info = $file->move('upload');
   
        if($info && $info->getPathname()) {
            return show(1, 'success','/'.$info->getPathname());
        }
        return show(0,'upload error');
    }
    
    //保存图片使用file-Upload插件
    public function setFile() {
        $file = Request::instance()->file('logo');
        // 给定一个目录
        $info = $file->move('upload');
         
        if($info && $info->getPathname()) {
            return show(1, 'success','/'.$info->getPathname());
        }
        return show(0,'upload error');
    }
}