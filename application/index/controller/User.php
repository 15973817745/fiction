<?php
namespace app\index\controller;
use think\Controller;
/*
 *用户操作
 * */
class User extends Base
{
    public function index(){

        if(!empty($this->account)){
         try{
        $user=model('User')->getUserByUsername($this->account->username);

         }catch(\Exception $e){
            $this->error();
        }
        return $this->fetch('',[
            'user'=>$user,
            'ur'=>1,
        ]);
        }else{
            $suiji=rand(1,10) ;
         return $this->fetch('',[
             'ur'=>0,
             'suiji'=>$suiji,
         ]);
        }
    }
    /*查看作者的书*/
    public function book(){
        $data=input('get.');
        if(empty($data)){
            $this->error('ID错误');
        }
        try{
         $authoraccount=Model('AuthorAccount')->get(['user_id'=>$data['id']]);
         $author=Model('Author')->get(['id'=>$authoraccount->author_id]);
        $storyaresct = model('StoryAres')->getStoryAresByPm($author->id);
        $story = model("Story")->getNormalStory();
        }catch(\Exception $e){
            $this->error();//$e->getMessage()错误信息不要显示在前端页面
        }
        $storyArrs=[];
        foreach($story as $city) {
            $storyArrs[$city->id] = $city->story_tle;
        }
 
        return $this->fetch('',[
            'storyArrs'=>$storyArrs,
            'storyaresct'=>$storyaresct,
            'add'=>'您暂时没有写任何书本',
      
        ]);
    }
    /*添加章节*/
    public function editadd(){
       if(request()->isPost()){
                //做下严格校验
                $data = input('post.','','htmlentities');
                $validate = validate('Bis');
                if(!$validate->scene('storycas')->check($data)){
                    $this->error($validate->getError());
                }
                $storycas=model('StoryCas')->getNormalByAres($data['id']);
                if($data['zhang']==$storycas->name_zhang){
                    $this->error('章节相同');
                }
                //小说内容数据入库
                $cas=[
                    'ares_id'=>$data['id'],
                    'tle_name'=>$data['section'],
                    'content'=>$data['image1'],
                    'name_zhang'=>$data['zhang'],
                    'create_time'=>strtotime(time()),
                ];
                try{
                          $id = model('StoryCas')->add($cas);
                }catch(\Exception $e){
                    $this->error();//$e->getMessage()错误信息不要显示在前端页面
                }
                if($id){
                    $this->success('添加成功',url('User/book',['id'=>$data['id']]));
                }else{
                    $this->error('添加失败');
                }
        
            }else{
                $data = input('get.');
                try{
                $stroy = model('Story')->getStoryByStatus('',1);
                $author = model('Author')->getAuthorByStatus('',1);
                $storycas = model("StoryCas")->getNormalStoryCasID($data['id']);
                }catch(\Exception $e){
                    $this->error();//$e->getMessage()错误信息不要显示在前端页面
                }
                $storycasArr=$authorArr=[];
                foreach($storycas as $cit) {
                    $storycasArr[$cit->id] = $cit->name_zhang;
                }
                foreach($author as $cit) {
                    $authorArr[$cit->id] = $cit->id;
                }

                return $this->fetch('',[
                    'story' =>$stroy,
                    'author'=>$author,
                    'authorArr'=>$authorArr,
                    'storycasArr'=>max($storycasArr),
                ]);
            }
    }
    //添加小说
    public function add(){
        if(request()->isPost()){
            //做下严格校验
            $data = input('post.','','htmlentities');
            $validate = validate('Bis');
            if(!$validate->scene('story')->check($data)){
                $this->error($validate->getError());
            }
            //名字信息校验
            $storyResult=Model('StoryAres')->get(['tle_name'=>$data['title']]);
            if($storyResult){
                $this->error('该小说标题存在，请重新填写');
            }
        $authoraccount=Model('AuthorAccount')->get(['user_id'=>$data['id']]);
        $author=Model('Author')->get(['id'=>$authoraccount->author_id]);
            //小说基本数据入库
            $aresData = [
                'tle_name'=>$data['title'],
                'uname'=>$data['fiel'],
                'pm_id'=>$author->id,
                'parent_id'=>$data['parent_id'],
                'logo' => $data['image'],
                'sids' =>$data['description1'],
                'create_time'=>strtotime(time()),
            ];
            $id=model('StoryAres')->add($aresData);
            //小说内容数据入库
            $cas=[
                'ares_id'=>$id,
                'tle_name'=>$data['section'],
                'content'=>$data['image1'],
                'name_zhang'=>$data['zhang'],
                'create_time'=>strtotime(time()),
            ];
            $cas_id = model('StoryCas')->add($cas);
            if($id){
                $this->success('添加成功',url('User/index'));
            }else{
                $this->error('添加失败');
            }
        
        }else{
            $data = input('get.');
            if(empty($data)){
                $this->error();
            }
            $stroy = model('Story')->getStoryByStatus('',1);
            return $this->fetch('',[
                'story' =>$stroy,
                'tid'=>!empty($data['id'])?$data['id']:'',
            ]);
        }
    }
    //用户升级为作者
    public function author(){
     if(request()->isPost()){
                //做下严格校验
                $data = input('post.','','htmlentities');
                $validate = validate('Bis');
                if(!$validate->scene('name')->check($data)){
                    $this->error($validate->getError());
                }
                $author=Model('Author')->get(['username'=>$data['username']]);
                if($author){
                    $this->error('该作者名称已存在，请重新填写');
                }
                try{
                    $user=model('User')->get(['id'=>$data['id']]);
                   
                    $auh=[
                        'username'=>$data['username'],
                        'email'=>$data['email'],
                        'logo'=>$data['logo'],
                        'city_id'=>$data['city_id'],
                        'city_path'=>$data['city_path']+','+$data['city_id'],
                        'tel'=>$data['tel'],
                       'create_time'=>strtotime(time()),
                        'updata_time'=>strtotime(time()),
                    ];
                          $id = model('Author')->add($auh);
                          //用户内容数据入库
                          $cas=[
                              'user_id'=>$data['id'],
                              'username'=>$user->username,
                              'password'=>$user->password,
                              'code'=>$user->code,
                              'author_id'=>$id,
                              'create_time'=>strtotime(time()),
                              'updata_time'=>strtotime(time()),
                          ];
                          $account=model('AuthorAccount')->add($cas);
                          model('User')->save(['gexing'=>$data['gexing']],['id'=>$data['id']]);
                }catch(\Exception $e){
                    $this->error();//$e->getMessage()错误信息不要显示在前端页面
                }
                if($account){
                    $this->success('添加成功',url('User/book',['id'=>$data['id']]));
                }else{
                    $this->error('添加失败');
                }
        
    
        }else{
            $data = input('get.');
            if(empty($data)){
                $this->error();
            }
          
        $cityArrs =$cityArr=[];
        $citys = model("City")->getNormalCitys();
      
        foreach($citys as $city) {
            if($city->parent_id>0){
            $cityArrs[$city->id] = $city->name;
           }else{
             $cityArr[$city->id] = $city->name;
           }
        }
            return $this->fetch('',[
                'tid'=>!empty($data['id'])?$data['id']:'',
                'citys' =>$citys,
                'cityArrs'=>$cityArrs,
                'cityArr'=>$cityArr
            ]);
        }
    }
}