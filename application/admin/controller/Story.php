<?php
namespace app\admin\controller;
use think\Controller;
use phpmailer\Phpmailer;
use phpmailer\Smtp; 
class Story extends Base
{
    //小说列表
    public function index()
    {
     $data = input('get.');
        
        $sdata=$this->getByDatabase($data);
        
        $storyArrs =$storycasArr=$authorArr=[];
        $story = model("Story")->getNormalStory();
        $author = model('Author')->getAuthorByStatus('',1);
        $storycas = model("StoryCas")->getNormalStoryCas();
        foreach($story as $city) {
            $storyArrs[$city->id] = $city->story_tle;
        }
        foreach($storycas as $cit) {
            $storycasArr[$cit->ares_id] = $cit->name_zhang;
        }
        foreach($author as $ciy) {
            $authorArr[$ciy->id] = $ciy->username;
        }
        $storyares= model('StoryAres')->getStoryAresByStatus($sdata,['neq',-1]);
        return $this->fetch('',
            ['storyares'=>$storyares,
                'zang'=>'现在还没人上传这本书',
                'story'=>$story,
                'storycas'=>$storycas,
                'storyArrs'=>$storyArrs,
                'storycasArr'=>$storycasArr,
                'author'=>$author,
                'authorArr'=>$authorArr
            ]);
    }
    //添加
    public function add(){
        if(request()->isPost()){
            //做下严格校验
            $data = input('post.','','htmlentities');
            $validate = validate('Category');
            if(!$validate->scene('story')->check($data)){
                $this->error($validate->getError());
            }
             //名字信息校验
            $storyResult=Model('StoryAres')->get(['tle_name'=>$data['title']]);
            if($storyResult){
                $this->error('该小说标题存在，请重新填写');
            }

            //小说基本数据入库
            $aresData = [
                'tle_name'=>$data['title'],
                'uname'=>$data['fiel'],
                'pm_id'=>$data['pm_id'],
                'parent_id'=>$data['parent_id'],
                'logo' => $data['image'],
                'sids' =>$data['description1'],
                'create_time'=>strtotime(time()),
                'status'=>1,
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
                $this->success('添加成功',url('Story/add'));
            }else{
                $this->error('添加失败');
            }

        }else{
            $data = input('get.');
            $stroy = model('Story')->getStoryByStatus('',1);
            $author = model('Author')->getAuthorByStatus('',1);
        
            return $this->fetch('',[
                   'story' =>$stroy,
                'author'=>$author,
                'tid'=>!empty($data['id'])?$data['id']:'',
            ]);
        }
        }
        //添加章节
        public function zhangadd(){
            if(request()->isPost()){
                //做下严格校验
                $data = input('post.','','htmlentities');
                $validate = validate('Category');
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
                    'status'=>1,
                ];
                $id = model('StoryCas')->add($cas);
                if($id){
                    $this->success('添加成功',url('Story/index'));
                }else{
                    $this->error('添加失败');
                }
        
            }else{
                $data = input('get.');
                $stroy = model('Story')->getStoryByStatus('',1);
                $author = model('Author')->getAuthorByStatus('',1);
                $storycas = model("StoryCas")->getNormalStoryCasID($data['id']);
                $storycasArr=[];
                foreach($storycas as $cit) {
                    $storycasArr[$cit->id] = $cit->name_zhang;
                }
                return $this->fetch('',[
                    'story' =>$stroy,
                    'author'=>$author,
                    'tid'=>!empty($data['id'])?$data['id']:'',
                    'storycasArr'=>max($storycasArr),//获取最大的章节
                ]);
            }
        }
        //分类列表
        public function dellist()
        {       $data = input('get.');
            $sdata=$this->getByDatabase($data);
            $story= model('Story')->getStoryByStatus($sdata,['neq',-1]);
            return $this->fetch('',
                ['story'=>$story,
                    'zang'=>'现在还没有这个分类，您可以添加咯',
                ]);
        }
        
        //修改分类名称
        public function editdellist()
        {  
           if(request()->isPost()){
               $data = input('post.','','htmlentities');
               $validate = validate('Category');
               if(!$validate->scene('tel')->check($data)){
                   $this->error($validate->getError());
               }
                //小说列表入库
                $id = model('Story')->updateById(['story_tle'=>$data['story_tle'],'update_time'=>strtotime(time())],$data['id']);
                if($id){
                    $this->success('修改成功',url('Story/editdellist'));
                }else{
                    $this->error('修改失败');
                }
            }else{
            $data = input('get.');
            $story= model('Story')->getStoryByStatus('',['neq',-1]);
            $storyArrs=[];
            foreach($story as $city) {
                $storyArrs[$city->id] = $city->story_tle;
            }
            return $this->fetch('',
                [
                    'id'=>!empty($data['id'])?$data['id']:'',
                  'storyArrs'=>$storyArrs,
                ]);
            }
        }
        //添加分类
        public function adddellist()
        {
            if(request()->isPost()){
                $data = input('post.','','htmlentities');
                $validate = validate('Category');
                if(!$validate->scene('tel')->check($data)){
                    $this->error($validate->getError());
                }
                $story=[
                    'story_tle'=>$data['story_tle'],
                    'sids'=>$data['description1'],
                    'create_time'=>strtotime(time()),
                    'update_time'=>strtotime(time()),
                      'status'=>1,
                ];
                //小说列表入库
                $id = model('Story')->add($story);
                if($id){
                    $this->success('修改成功',url('Story/editdellist'));
                }else{
                    $this->error('修改失败');
                }
            }else{
                return $this->fetch();
            }
        }
        /*修改小说*/
     public function editadd(){
            if(request()->isPost()){
                //做下严格校验
                $data = input('post.','','htmlentities');
                $validate = validate('Category');
                if(!$validate->scene('story')->check($data)){
                    $this->error($validate->getError());
                }
                //名字信息校验
                $storyResult=Model('StoryAres')->get(['tle_name'=>$data['title'],'id'=>['neq',$data['id']]]);
                if($storyResult){
                    $this->error('该小说标题存在，请重新填写');
                }
            
                //小说基本数据入库
                $aresData = [
                    'tle_name'=>$data['title'],
                    'uname'=>$data['fiel'],
                    'parent_id'=>$data['parent_id'],
                    'logo' => $data['image'],
                    'update_time'=>strtotime(time()),
                ];
                $id=model('StoryAres')->updateById($aresData,$data['id']);
                //小说内容数据入库
                $cas=[
                    'tle_name'=>$data['section'],
                    'content'=>$data['image1'],
                    'name_zhang'=>$data['zhang'],
                    'update_time'=>strtotime(time()),
                ];
                $cas_id = model('StoryCas')->updateById($cas,$data['id']);
                if($id && $cas_id){
                    $this->redirect('story/editadd');
                }else{
                    $this->error('修改失败');
                }
            
            }else{
                $data = input('get.');
                $author = model('Author')->getAuthorByStatus('',1);
                $storycas = model("StoryCas")->getNormalStoryCas();
                $storyares= model('StoryAres')->get($data['id']);
                $storycasArr=$storycass=$storycasname=[];
                //将和内容用数组包裹起来  
                foreach($storycas as $cit) {
                    $storycasArr[$cit->ares_id] = $cit->content;
                }
                foreach($storycas as $cit) {
                    $storycass[$cit->ares_id] = $cit->name_zhang;
                }
                foreach($storycas as $cit) {
                    $storycasname[$cit->ares_id] = $cit->tle_name;
                }
                return $this->fetch('',[
                    'author'=>$author,
                    'storycasArr'=>$storycasArr,
                    'storyares'=>$storyares,
                    'storycass'=>$storycass,
                    'storycasname'=>$storycasname,
                ]);
            }
        }
        /*修改小说列表分类*/
        public function edit(){
            if(request()->isPost()){
                $data = input('post.','','htmlentities');
                //小说列表入库
                $id = model('StoryAres')->updateById(['parent_id'=>$data['parent_id'],'update_time'=>strtotime(time())],$data['id']);
                if($id){
                    $this->success('修改成功',url('Story/edit'));
                }else{
                    $this->error('修改失败');
                }
            }else{
            $data = input('get.');
            $story= model('Story')->getStoryByStatus('',['neq',-1]);
            $storyArrs=[];
            foreach($story as $city) {
                $storyArrs[$city->id] = $city->story_tle;
            }
            return $this->fetch('',
                ['story'=>$story,
                    'id'=>!empty($data['id'])?$data['id']:'',
                    'bid'=>$data['bid'],
                  'storyArrs'=>$storyArrs,
                ]);
            }
        }
        /*修改小说介绍*/
        public function edittle(){
            if(request()->isPost()){
                $data = input('post.','','htmlentities');
                //小说介绍入库
                $id = model('StoryAres')->save(['sids' =>$data['description1']],[ 'update_time'=>strtotime(time())]);
                if($id){
                    $this->success('修改成功',url('Story/edittle'));
                }else{
                    $this->error('修改失败');
                }
            }else{
            $data = input('get.');
              $storyares= model('StoryAres')->getStoryAresByStatus('',['neq',-1]);
              $storyaresArrs=[];
              foreach($storyares as $city) {
                  $storyaresArrs[$city->id] = $city->sids;
              }

            return $this->fetch('',
                ['storyares'=>$storyares,
                    'id'=>!empty($data['id'])?$data['id']:'',
                    'storyaresArrs'=>$storyaresArrs,
                ]);
            }
        }
        /*修改状态*/
        public function status(){
            $data = input('get.');
            if(empty($data)) {
                return $this->error('ID错误');
            }
            $res=$rb=$story=$ares='';
            if(!empty($data['id'])){
            $res = model('StoryAres')->save(['status'=>$data['status']], ['id'=>$data['id']]);
            $rb = model('StoryCas')->save(['status'=>$data['status']], ['ares_id'=>$data['id']]);
            }else{
            $story= model('Story')->save(['status'=>$data['status']], ['id'=>$data['did']]);
            $ares =model('StoryAres')->save(['status'=>$data['status']], ['parent_id'=>$data['did']]);
            }

            if(empty($story && $res &&  $rb  && $ares)) {
                // 发送邮件
                // status 1  status 2  status -1
                // \phpmailer\Email::send($data['email'],$title, $content);
                $this->success('状态更新成功');
            }else {
                $this->error('状态更新失败');
            }
        }
        
        public function listorder($id,$listorder){
            $data = input('post.');
            if(empty($data['id'])) {
                $this->error($data);
            }
              if(!is_numeric($data['listorder'])) {
            $this->error('listorder不合法');
        }
            // 获取控制器
            if(empty($data['did'])){
                model('StoryAres')->save(['listorder'=>$listorder],['id'=>$id]);
            }else{
            model('Story')->save(['listorder'=>$data['listorder']],['id'=>$data['id']]);
            }
            if($id){
                $this->result($_SERVER['HTTP_REFERER'],1,'success');
            }else{
                $this->result($_SERVER['HTTP_REFERER'],0,'更新失败');
            }
        }
}