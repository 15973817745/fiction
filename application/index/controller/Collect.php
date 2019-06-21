<?php
namespace app\index\controller;
use think\Controller;
/*
 *已收藏的书本
 * */
class Collect extends Base
{
   public function index(){
       if(!empty($this->account)){
        $storyaresct = model('StoryAres')->getStoryAresByCt();
        $story = model("Story")->getNormalStory();
        $storyArrs=[];
        foreach($story as $city) {
            $storyArrs[$city->id] = $city->story_tle;
        }
 
        return $this->fetch('',[
            'da'=>1,
            'storyArrs'=>$storyArrs,
            'storyaresct'=>$storyaresct,
            'add'=>'您暂时没有收藏任何书本',
      
        ]);
       }else{
           return $this->fetch('',[
              'da'=>0,
            'add'=>'您还没登录没有收藏',
           ]);
        }
    
   } 
   public function edit(){
       $data=input('get.');
      
        try{
              $id=model('StoryAres')->save(['collect'=>$data['collect']],['id'=>$data['id']]);
        }catch(\Exception $e){
            $this->error();
        }
        if($id){
        model('StoryAres')->where('id='.$data['id'])->setDec('collect_ren');
       $this->success('取消收藏',url('collect/index'));
        }else{
            $this->error('错误');
        }
     }
}