<?php
namespace app\admin\controller;
use think\Controller;
use phpmailer\Phpmailer;
use phpmailer\Smtp; 
class User extends Base
{
    //用户页面逻辑代码
    public function index()
    {
        $data = input('get.');

       $sdata=$this->getByDatabase($data);
        
        $perId=input('per_id',0,'intval');
        $user = model('User')->getUserByname($sdata,$perId,1);
            return $this->fetch('',
                ['user'=>$user,
                    'zang'=>'您查询的数据暂无',
                ]);
        }
  
        //已删除用户
       public function del()
        {
            $data = input('get.');
        
            $sdata=$this->getByDatabase($data);
        
            $perId=input('per_id',0,'intval');
            $user = model('User')->getUserByname($sdata,$perId,2);
        
            return $this->fetch('',
                ['user'=>$user,
                    'zang'=>'现在没有被封用户',
                ]);
        }
        //待审用户
        public function dellist(){
            $data = input('get.');
         $sdata=$this->getByDatabase($data);
            $perId=input('per_id',0,'intval');
            $user = model('User')->getUserByname($sdata,$perId,0);

            return $this->fetch('',
                ['user'=>$user,
                    'zang'=>'现在并未有人需要审核',
                ]);
            
          }

        /*查看用户*/
        public function detail(){
            $id = input('get.id');
        if(empty($id)) {
            return $this->error('ID错误');
        }
        // 获取用户数据
        $userData = model('User')->get($id);
        return $this->fetch('',[
           'user' =>$userData,
        ]);
        }
        /*修改状态*/
        public function status(){
            $data = input('get.');
            if(empty($data)) {
                return $this->error('ID错误');
            } 
      
            $res = model('User')->save(['status'=>$data['status']], ['id'=>$data['id']]);
            if($res['status']==0){
                //发送邮件
                $url=request()->domain().url('admin/user/waiting',['id'=>$res['id']]);
                $title='o2o入驻申请通知';
                $content = "您的账号已解封，平台方审核，您可以通过<a href='"+$url+"' target='_blank'>点击链接</a> 解封";
                \phpmailer\Email::send($res['email'],$title,$content);
            }
            if($res ) {
                // 发送邮件
                // status 1  status 2  status -1
                // \phpmailer\Email::send($data['email'],$title, $content);
                $this->success('状态更新成功');
            }else {
                $this->error('状态更新失败');
            }
        }
        public function waiting($id){
            if(empty($id)){
                $this->error('error');
            }
            $detail = model('User')->get($id);
        
            return $this->fetch('',[
                'detail'=>$detail,
            ]);
        }

}