<?php
namespace app\common\model;

use think\Model;

class Story extends BaseModel
{
    /**
     * 通过状态获取分类数据
     * @param $status
     */
    public function updateById($data, $id) {
        // allowField 过滤data数组中非数据表中的数据
        return $this->allowField(true)->save($data, ['id'=>$id]);
    }
    public function getStoryByStatus($data=[],$status) {
        $order = [
          
            'listorder' => 'desc',
            'id' => 'desc',
        ];
    
        $data[ 'status'] =$status;
    
        $result = $this->where($data)
        ->order($order)
        ->paginate(8);
        // echo $this->getLastSql();
        return $result;
    }
    public function getNormalStory(){
        $data = [
            'status'=>['neq',-1],
        ];
        $order = ['id'=>'desc'];
    
        return $this->where($data)
        ->order($order)
        ->select();
    
    }
    public function getNormalStoryId($id){
        $data = [
            'status'=>1,
            'id'=>$id,
        ];
        $order = ['id'=>'desc'];
    
        return $this->where($data)
        ->order($order)
        ->select();
    
    }
    
    public function getStoryByClick($data=[],$status) {
        $order = [
            'click' => 'desc',
            'listorder' => 'desc',
            'id' => 'desc',
        ];
    
        $data[ 'status'] =$status;
    
        $result = $this->where($data)
        ->order($order)
        ->limit(3)
        ->select();
        // echo $this->getLastSql();
        return $result;
    }
    
}