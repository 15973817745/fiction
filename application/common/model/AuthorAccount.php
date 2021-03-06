<?php
namespace app\common\model;

use think\Model;

class AuthorAccount extends BaseModel
{

    public function updateById($data, $id) {
        // allowField 过滤data数组中非数据表中的数据
        return $this->allowField(true)->save($data, ['id'=>$id]);
    }
    public function getAuthorByStatus($data=[]) {
        $order = [
      
            'listorder' => 'desc',
            'id' => 'desc',
        ];
    
        $data[ 'status'] =1;
    
        $result = $this->where($data)
        ->order($order)
        ->paginate();
        // echo $this->getLastSql();
        return $result;
    }
    
}