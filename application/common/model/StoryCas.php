<?php
namespace app\common\model;

use think\Model;

class StoryCas extends BaseModel
{
    /**
     * 通过状态获取商家数据
     * @param $status
     */
    public function updateById($data, $id) {
        // allowField 过滤data数组中非数据表中的数据
        return $this->allowField(true)->save($data, ['ares_id'=>$id]);
    }
    public function getStoryCasByStatus($data=[],$status) {
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
    
    public function getNormalStoryCas(){
        $data = [
            'status'=>['neq',-1],
        ];
        $order = ['id'=>'desc'];
    
        return $this->where($data)
        ->order($order)
        ->select();
    
    }
    //根据id查询书的内容和章节
    public function getNormalStoryCasID($id){
        $data = [
            'status'=>['neq',-1],
            'ares_id'=>$id
        ];
        $order = ['id'=>'desc'];
    
        return $this->where($data)
        ->order($order)
        ->select();
    
    }
    /*查询某本书*/
    public function getNormalListres($id){
        $data = [
            'status'=>['neq',-1],
            'ares_id' => $id,
        ];
        $order = ['name_zhang'=>'ares','id'=>'desc'];
    
        return $this->where($data)
        ->order($order)
        ->paginate(10);
    
    }
    
    /*查询某个章节*/
    public function getNormalIdzhang($id,$name_zhang){
        $data = [
            'status'=>['neq',-1],
            'ares_id' => $id,
            'name_zhang'=>$name_zhang
        ];
        $order = ['name_zhang'=>'ares','id'=>'desc'];
    
        return $this->where($data)
        ->order($order)
        ->select();
    
    }
    /*查询章节验证是否有章节是否一样*/
    public function getNormalByAres($id){
        $data = [
            'status'=>['neq',-1],
            'ares_id' => $id,
        ];
        $order = ['name_zhang'=>'ares','id'=>'desc'];
    
        return $this->where($data)
        ->order($order)
        ->find();
    
    }
    
}