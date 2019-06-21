<?php
namespace app\index\controller;
use think\Controller;
/*
 * 排行榜
 * */
class Row extends Base
{
    public function top(){
        $story=model('Story')->getNormalStory();
        $storyares = model('StoryAres')->getStoryAresByCreate('',1);
        $storyclick=model('StoryAres')-> getStoryAresByClick('',1);
        $storycollect=model('StoryAres')-> getStoryAresByCollect('',1);
        $storyArrs=[];
        foreach($story as $city) {
            $storyArrs[$city->id] = $city->story_tle;
        }
        return $this->fetch('',[
            'storyares'=> $storyares,
            'storyArrs'=>$storyArrs,
            'storyclick'=>$storyclick,
            'storycollect'=>$storycollect,
        ]);
    }
}