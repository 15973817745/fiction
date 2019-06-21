<?php
namespace app\admin\controller;
use think\Controller;

class Login extends Controller
{
    public function index()
    {
        if(request()->isPost()){
            //后台登录逻辑代码
            $data=input('post.');
            //做下严格校验
            $validate = validate('Category');
            
             if(!$validate->scene('login')->check($data)){
            $this->error($validate->getError());
        }
        //通过用户名 获取 用户相关信息
        $ret=model('User')->get(['username'=>$data['name']]);
        if(!$ret || $ret->status !=1){
            $this->error("该用户不存在，获取用户不通过");
        }
        if($ret->per_id!=1){
            $this->error('账号不存在');
        }
        $ui=$data['password'].$ret->code;
        if($ret->password!= md5($ui)){
            $this->error('密码不正确');
        }
        
        model('User')->updateById(['last_login_time'=>time()],$ret->id);
        
        //保存用户信息 bis是作用域
        session('loginAccount',$ret,'bis');
        return $this->success('登录成功',url('index/index'));
        }else{
            //获取session
            $account = session('loginAccount','','bis');
            if($account && $account->id){
                return $this->redirect(url('index/index'));
            }
            return $this->fetch();
        }    
    }
        
        public function logout(){
            //清除session
            session('你已经退出登录了','bis');
            //跳出
            $this->redirect('login/index');
        }
  }
            
  