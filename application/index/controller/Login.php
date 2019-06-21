<?php
namespace app\index\controller;
use think\Controller;
/*
 * 登录注册页面逻辑
 * */
class Login extends Controller
{
    public function index()
    {   	//获取session
    	$user = session('fic_user','','fic');
    	if($user && $user->id){
    		$this->redirect(url('index/index'));
    	}
       return $this->fetch();
    }
    public function login()
    {if(request()->isPost()){
    		$data = input('post.');
    		
    		 if(captcha_check($data['verifycode'])){
				//校验失败
				$this->error('验证码不正确');
			}
			//严格校验
			$validate = validate('Bis');
		if(!$validate->scene('user')->check($data)){
			$this->error($validate->getError());
		 	}
		 if($data['password'] != $data['repassword']){
		 	$this->error('两次输入的密码不一样');
		 }
		 	//自动生成密码的加盐字符串
			$data['code']=mt_rand(100,10000);
			$data['password']=md5($data['password'].$data['code']);
			try{
		      $res=model('User')->add($data);
		     }catch(\Exception $e){
    			$this->error();
    		}
		      if($res){
		      	$this->success('注册成功',url('login/index'));
		      }else{
		      	$this->error('注册失败');
		      }
    		
    	}else{
       return $this->fetch();
    	}
    }
    public function logincheck(){
        //判定
        if(!request()->isPost()){
            $this->error('提交不合法');
        }
        $data=input('post.');
        //严格检验 tp5 validta
        try{
            $user = model('User')->getUserByUsername($data['username']);
        }catch(\Exception $e){
            $this->error();//$e->getMessage()错误信息不要显示在前端页面
        }
        if(!$user || $user->status!=1){
            $this->error('该用户不存在');
        }
        //判定密码是否合理
        $ui=$data['password'].$user->code;
        if(md5($ui)!=$user->password){
            $this->error('密码不正确');
        }
    
        //登入成功
        model('User')->updateById(['last_login_time'=>time()],$user->id);
        //把用户信息记录到session
        session('fic_user',$user,'fic');
    
        $this->success('登录成功',url('index/index'));
    }
    public function logout(){
        session(null,'fic');
        $this->redirect(url('login/index'));
    }
}
