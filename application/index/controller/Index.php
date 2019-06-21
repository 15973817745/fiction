<?php
namespace app\index\controller;
use think\Controller;
/*
 * 首页
 * */
class Index extends Base
{
    public function index()
    {
    $storyare = model('StoryAres')->getStoryAresByLimit('',['eq',1]);
        $storyareclick = model('StoryAres')->getStoryAresByClick('',['eq',1]);
        $storyarecreate= model('StoryAres')->getStoryAresByCreate('',['eq',1]);
        $story = model("Story")->getNormalStory();
        $storyArrs=[];
        foreach($story as $city) {
            $storyArrs[$city->id] = $city->story_tle;
        }
       return $this->fetch('',[
           'storyare'=>$storyare,
           'storyArrs'=>$storyArrs,
           'storyareclick'=>$storyareclick ,
           'storyarecreate'=>$storyarecreate,
       ]);  
    }
  //查询页面  
    public function sle(){
        $data = input('get.');
        $sdata=$this->getByDatabase($data);
        $storyareclick = model('StoryAres')->getStoryAresByClick('',['eq',1]);
        $story = model("Story")->getNormalStory();
        $storyArrs=[];
        foreach($story as $city) {
            $storyArrs[$city->id] = $city->story_tle;
        }
       
        try{
             $storyares = model('StoryAres')->getStoryAresByStatus($sdata,['eq',1]);
        }catch(\Exception $e){
            $this->error($e->getMessage());
        }
        return $this->fetch('',[
            'storyares' => $storyares,
            'storyArrs'=>$storyArrs,
            'storyareclick'=>$storyareclick,
            'add'=>'您查询的数据不存在',
      
        ]);
    }
}
