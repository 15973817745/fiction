<?php
namespace app\common\model;

use think\Model;

class Author extends BaseModel
{
    /**
     * 通过状态获取作者数据
     * @param $status
     */
    public function getAuthorByStatus($data=[],$status) {
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
    //单独查看作者
    public function getAuthorById($id) {
        $order = [
    
            'listorder' => 'desc',
            'id' => 'desc',
        ];
    
       $data=[
         'id'=>$id  
       ];
    
        $result = $this->where($data)
        ->order($order)
        ->find();
        // echo $this->getLastSql();
        return $result;
    }
}