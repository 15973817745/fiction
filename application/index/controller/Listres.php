<?php
namespace app\index\controller;
use think\Controller;
/*
 * 小说详情页面逻辑和内容页面
 * */
class Listres extends Base
{
    public function index()
    {
       
        $data=input('get.');
        if(empty($data['id'])&&empty($data['pm_id'])) {
            return $this->error('ID错误');
        }
        //每次加载，都会加一次点击率
        model('StoryAres')->where('id='.$data['id'])->setInc('click');
         $storycas=model('StoryCas')->  getNormalListres($data['id']);
         $storyarespm=model('StoryAres')-> getStoryAresByPm($data['pm_id']);
       $storyares = model('StoryAres')-> getStoryAresByListres($data['id']);
       $story = model("Story")->getNormalStory();
       $storyArrs=$storyCas=$storyzhang=$storytle= $authorArr=[];;
       $author= model('Author')->getAuthorById($data['pm_id']);
    

       foreach($story as $city) {
           $storyArrs[$city->id] = $city->story_tle;
       }
       foreach($storycas as $city) {
           $storyCas[$city->ares_id] = $city->where('ares_id='.$data['id'])->sum('words');
       }
       //章节
       foreach($storycas as $city) {
           $storyzhang[$city->ares_id] = $city->where('ares_id='.$data['id'])->max('name_zhang');
       }
       //章节名称
       foreach($storycas as $city) {
           $storytle[$city->ares_id] = $city->where('ares_id='.$data['id'])->min('tle_name');
       }
        return $this->fetch('',[
            'author'=>$author,
            'storycas'=>$storycas,
            'storyares'=>$storyares[0],
            'storyArrs'=>$storyArrs,
            'storyCas'=>$storyCas,
            'storyzhang'=>$storyzhang,
            'storytle'=>$storytle,
            'storyarespm'=>$storyarespm,
        ]);
    }
    public function cont(){
        $data=input('get.');
        if(empty($data['id'])&&empty($data['name_zhang'])) {
            return $this->error('ID错误');
        }
        $storycas=model('StoryCas')->  getNormalIdzhang($data['id'],$data['name_zhang']);
        $storyares = model('StoryAres')-> getStoryAresByListres($data['id']);
        $storyzhang=[];
        //最大章节
        foreach($storycas as $city) {
            $storyzhang[$city->ares_id] = $city->where('ares_id='.$data['id'])->max('name_zhang');
        }
        return $this->fetch('',[
            'storycas'=>$storycas[0],
            'storyares'=>$storyares[0],
            'storyzhang'=>$storyzhang,
        ]);
    }
    //加入收藏
    public function collect(){
        $data=input('get.');
       if(!empty($this->account)){
       try{
           $id=model('StoryAres')->save(['collect'=>$data['collect']],['id'=>$data['id']]);
       }catch(\Exception $e){
           $this->error($e->getMessage());
       }
        if($id){
            model('StoryAres')->where('id='.$data['id'])->setInc('collect_ren');
            $this->success('收藏成功',url('listres/index',['id'=>$data['id'],'pm_id'=>$data['pm_id']]));
        }else{
            $this->error('收藏失败');
        }
     }else{
         $this->error('你没有登录不能收藏');
     }
    }
}