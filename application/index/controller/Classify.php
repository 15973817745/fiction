<?php
namespace app\index\controller;
use think\Controller;
/*
 * 分类页面逻辑
 * */
class Classify extends Base
{
    public function index()
    {
        $story=model('Story')->getStoryByStatus('',1);
       $storyclick = model('Story')->getStoryByClick('',1);
     return $this->fetch('',[
         'story'=>$story,
         'storyclick'=>$storyclick,
     ]);
    }
    public function ify()
    {
        $data=input('get.');
        $story=model('Story')->getNormalStoryId($data['id']);
        $storyares = model('StoryAres')->getStoryAresByParent($data['id']);
        $author= model('Author')->getAuthorByStatus('',1);
        $authorArr=[];
         foreach($author as $aut){
             $authorArr[$aut->id]=$aut->username;
         }
        return $this->fetch('',[
            'authorArr'=>$authorArr,
            'story'=>$story[0],
            'storyares'=> $storyares ,
        ]);
    }
}