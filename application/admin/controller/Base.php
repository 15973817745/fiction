<?php
namespace app\admin\controller;
use think\Controller;
class Base extends  Controller {
    public $account;
	public function _initialize(){
		//用户是否登入
		$isLogin=$this->isLogin();
		if(!$isLogin){
		    return $this->success('你已经退出登录了','login/index');
		}
        //获取信息
        $this->assign('ret',$this->getLoginUser());
	
		
	}
	//判定是否登录
	public function isLogin(){
		//获取session
		$ret = $this->getLoginUser();
		if($ret && empty($ret->id)){
			return true;
		}
		return false;
	}
	public function getLoginUser(){
		if(!$this->account){
		$this->account =session('loginAccount','','bis');
		}
		return $this->account;
	}

    public function status() {
        // 获取值
        $data = input('get.');
        // 利用tp5 validate 去做严格检验  id  status
        if(empty($data['id'])) {
            $this->error('id不合法');
        }
        if(!is_numeric($data['status'])) {
            $this->error('status不合法');
        }

        // 获取控制器
        $model = request()->controller();
        //echo $model;exit;
        $res = model($model)->save(['status'=>$data['status']], ['id'=>$data['id']]);
        if($res) {
            $this->success('更新成功');
        }else {
            $this->error('更新失败');
        }
    }
    //根据时间和名字查询
    /**
     * @param  $data 获得的属性
     */
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
        if(!empty($data['story_tle'])) {
            $sdata['story_tle'] = ['like', '%'.$data['story_tle'].'%'];
        }
   
        if(!empty($data['username'])) {
            $sdata['username'] = ['like', '%'.$data['username'].'%'];
        }
        if(!empty($data['tel_name'])) {
            $sdata['tle_name'] = ['like', '%'.$data['tel_name'].'%'];
        }
       
        return $sdata;
    }
    // 排序功能 也放到 base

    public function listorder($id,$listorder){
      $data = input('post.');
       if(empty($data['id'])) {
            $this->error('id不合法');
        }
        if(!is_numeric($data['listorder'])) {
            $this->error('listorder不合法');
        }
          // 获取控制器
         $model = request()->controller();
         
model($model)->save(['listorder'=>$listorder],['id'=>$id]);

      if($id){
        $this->result($_SERVER['HTTP_REFERER'],1,'success');
      }else{
        $this->result($_SERVER['HTTP_REFERER'],0,'更新失败');
      }
    }

}