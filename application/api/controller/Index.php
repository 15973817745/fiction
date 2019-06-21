<?php
namespace app\api\controller;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
       return $this->fetch();
    }
    public function test(){
    	return 'singwa';
    }
    public function welcome(){
    	//return $this->fetch();
    	return "欢迎来到o2o商家后台";
    }
}
