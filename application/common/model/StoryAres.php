<?php
namespace app\common\model;

use think\Model;

class StoryAres extends BaseModel
{
    /**
     * 通过状态获取商家数据
     * @param $status
     */
    public function updateById($data, $id) {
        // allowField 过滤data数组中非数据表中的数据
        return $this->allowField(true)->save($data, ['id'=>$id]);
    }
    public function getStoryAresByStatus($data=[],$status) {
        $order = [
       
            'listorder' => 'desc',
            'parent_id'=>'desc',
            'id' => 'desc',
        ];
    
        $data[ 'status'] =$status;
    
        $result = $this->where($data)
        ->order($order)
        ->paginate(8);
        // echo $this->getLastSql();
        return $result;
    }
    //按分类查询
    public function getStoryAresById($data=[],$status,$parent) {
        $order = [
             
            'listorder' => 'desc',
            'parent_id'=>'desc',
            'id' => 'desc',
        ];
    
        $data[ 'status'] =$status;
        $data[ 'parent_id'] =$parent;
    
        $result = $this->where($data)
        ->order($order)
        ->select();
        // echo $this->getLastSql();
        return $result;
    }
    //控制导航栏上只让显示四条
    public function getStoryAresByLimit($data=[],$status) {
        $order = [
             
            'listorder' => 'desc',
            'parent_id'=>'desc',
            'id' => 'desc',
        ];
    
        $data[ 'status'] =$status;
    
        $result = $this->where($data)
        ->order($order)
        ->limit(4)
        ->select();
        // echo $this->getLastSql();
        return $result;
    }
    //按点击率查询
    public function getStoryAresByClick($data=[],$status) {
        $order = [
             'click'=>'desc',
            'listorder' => 'desc',
            'parent_id'=>'desc',
            'id' => 'desc',
        ];
    
        $data[ 'status'] =$status;
    
        $result = $this->where($data)
        ->order($order)
        ->limit(8)
        ->select();
        // echo $this->getLastSql();
        return $result;
    }
    //按最新时间查询
    public function getStoryAresByCreate($data=[],$status) {
        $order = [
            'create_time'=>'desc',
            'listorder' => 'desc',
            'parent_id'=>'desc',
            'id' => 'desc',
        ];
    
        $data[ 'status'] =$status;
    
        $result = $this->where($data)
        ->order($order)
        ->limit(8)
        ->select();
        // echo $this->getLastSql();
        return $result;
    }
    //按收藏人数查询
    public function getStoryAresByCollect($data=[],$status) {
        $order = [
            'collect'=>'desc',
            'listorder' => 'desc',
            'parent_id'=>'desc',
            'id' => 'desc',
        ];
    
        $data[ 'status'] =$status;
    
        $result = $this->where($data)
        ->order($order)
        ->limit(8)
        ->select();
        // echo $this->getLastSql();
        return $result;
    }
    //查询某本书
    public function getStoryAresByListres($id) {
        $order = [
            'click'=>'desc',
            'listorder' => 'desc',
            'id' => 'desc',
        ];
    
        $data=[ 
            'status' =>1,
            'id'=>$id
        ];
    
        $result = $this->where($data)
        ->order($order)
        ->limit(5)
        ->select();
        // echo $this->getLastSql();
        return $result;
    }
    //查询某个作者的书
    public function getStoryAresByPm($id) {
        $order = [
            'listorder' => 'desc',
            'id' => 'desc',
        ];
    
        $data=[
            'status' =>1,
            'pm_id'=>$id
        ];
    
        $result = $this->where($data)
        ->order($order)
        ->select();
        // echo $this->getLastSql();
        return $result;
    }
    //按分类查询书
    public function getStoryAresByParent($id) {
        $order = [
            'click'=>'desc',
            'listorder' => 'desc',
            'id' => 'desc',
        ];
    
        $data=[
            'status' =>1,
            'parent_id'=>$id
        ];
    
        $result = $this->where($data)
        ->order($order)
        ->paginate(8);;
        // echo $this->getLastSql();
        return $result;
    }
//查询收藏的书籍
    public function getStoryAresByCt() {
        $order = [
            'listorder' => 'desc',
            'id' => 'desc',
        ];
    
        $data=[
            'status' =>1,
            'collect'=>1
        ];
    
        $result = $this->where($data)
        ->order($order)
        ->select();
        // echo $this->getLastSql();
        return $result;
    }
    
}