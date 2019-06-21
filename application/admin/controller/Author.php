<?php
namespace app\admin\controller;
use think\Controller;
use phpmailer\Phpmailer;
use phpmailer\Smtp; 
class Author extends Base
{
    //作者页面逻辑代码
    public function index()
    {
        $data = input('get.');
        
        $sdata=$this->getByDatabase($data);
        
        $cityArrs =$cityArr=[];
        $citys = model("City")->getNormalCitys();
      
        foreach($citys as $city) {
            if($city->parent_id>0){
            $cityArrs[$city->id] = $city->name;
           }else{
             $cityArr[$city->id] = $city->name;
           }
        }
        $author= model('Author')->getAuthorByStatus($sdata,1);
        return $this->fetch('',
            ['author'=> $author,
              'zang'=>'您查询的数据暂无',
                'city_id' => empty($data['city_id']) ? '' : $data['city_id'],
                'citys'=>$citys,
                'cityArr'=>$cityArr,
                'cityArrs'=>$cityArrs,
            ]);
    }
    //已删除用户
    public function del()
    {
        $data = input('get.');
        
        $sdata=$this->getByDatabase($data);
        
        $cityArrs =$cityArr=[];
        $citys = model("City")->getNormalCitys();
      
        foreach($citys as $city) {
            if($city->parent_id>0){
            $cityArrs[$city->id] = $city->name;
           }else{
             $cityArr[$city->id] = $city->name;
           }
        }
        $author= model('Author')->getAuthorByStatus($sdata,2);
        return $this->fetch('',
            ['author'=>$author,
                'zang'=>'现在没有被封用户',
                'citys'=>$citys,
                'cityArr'=>$cityArr,
                'cityArrs'=>$cityArrs,
            ]);
    }
    //待审用户
    public function dellist(){
       $data = input('get.');
        
        $sdata=$this->getByDatabase($data);
        
        $cityArrs =$cityArr=[];
        $citys = model("City")->getNormalCitys();
      
        foreach($citys as $city) {
            if($city->parent_id>0){
            $cityArrs[$city->id] = $city->name;
           }else{
             $cityArr[$city->id] = $city->name;
           }
        }
        $author= model('Author')->getAuthorByStatus($sdata,0);
        return $this->fetch('',
            ['author'=>$author,
                'zang'=>'现在并未有人需要审核',
                'citys'=>$citys,
                'cityArr'=>$cityArr,
                'cityArrs'=>$cityArrs,
            ]);
    
    }
    //作者查看代码
        public function detail(){
            $id = input('get.id');
        if(empty($id)) {
            return $this->error('ID错误');
        }
        // 获取用户数据
        $cityArrs=[];
        $citys = model("City")->getNormalCitys();
        
        foreach($citys as $city) {
                $cityArrs[$city->id] = $city->name; 
        }
        $author = model('Author')->get($id);
        $authoraccount = model('AuthorAccount')->get($id);
        return $this->fetch('',[
           'author' =>$author,
            'authoraccount' =>$authoraccount,
            'cityArrs'=>$cityArrs,
        ]);
       }
       /*修改状态*/
       public function status(){
           $data = input('get.');
           if(empty($data)) {
               return $this->error('ID错误');
           }
       
           $res = model('Author')->save(['status'=>$data['status']], ['id'=>$data['id']]);
           $rb = model('AuthorAccount')->save(['status'=>$data['status']], ['author_id'=>$data['id']]);
           if($res['status']==0){
               //发送邮件
               $url=request()->domain().url('admin/author/waiting',['id'=>$res['id']]);
               $title='o2o入驻申请通知';
               $content = "您的账号已解封，平台方审核，您可以通过<a href='"+$url+"' target='_blank'>点击链接</a> 解封";
               \phpmailer\Email::send($res['email'],$title,$content);
           }
           if($res && $rb) {
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