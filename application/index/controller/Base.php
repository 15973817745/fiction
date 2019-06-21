<?php
namespace app\index\controller;
use think\Controller;

class Base extends Controller
{

	public $account='';

    public function _initialize(){
  
    	//用户数据
    	//获取首页分类的数据
        $this->assign('user',$this->getLoginUser());
    }
    
    public function getByDatabase($data){
        //判断输入的字段
        $sdata=[];
        if(!empty($data['start_time']) && !empty($data['end_time']) && strtotime($data['end_time']) >= strtotime($data['start_time'])) {
            $sdata['create_time'] = [
                ['gt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])],
            ];
        }
        if(!empty($data['city_id'])) {
            $sdata['city_path'] = ['like', '%'.$data['city_id'].'%'];
        }
        if(!empty($data['story_id'])) {
            $sdata['parent_id'] = ['like', '%'.$data['story_id'].'%'];
        }
        if(!empty($data['username'])) {
            $sdata['username'] = ['like', '%'.$data['username'].'%'];
        }
        if(!empty($data['tel_name'])) {
            $sdata['tle_name'] = ['like', '%'.$data['tel_name'].'%'];
        }
         
        return $sdata;
    }
    //检测是否登录
    public function getLoginUser(){
		if(!$this->account){
			$this->account =session('fic_user','','fic');
		}
		return $this->account;
	}


}