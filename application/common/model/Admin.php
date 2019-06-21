<?php
namespace app\common\model;

use think\Model;

class Admin extends Model
{
    /**
     * 通过状态获取用户数据
     * @param $status
     */
    
    //只获取超级用户的数据
 public function updateById($data, $id) {
        // allowField 过滤data数组中非数据表中的数据
        return $this->allowField(true)->save($data, ['id'=>$id]);
    }
}