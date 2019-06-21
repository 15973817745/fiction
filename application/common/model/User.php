<?php
namespace app\common\model;

use think\Model;

class User extends BaseModel
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

    //查询用户数据
    /**
     * @param $data 条件
     * @param $perId 查询用户的等级
     */
  public function getUserByname($data=[],$perId=0,$status) {
        $order = [
       
            'listorder' => 'desc',
            'id' => 'desc',
        ];
            $data['status'] = $status;
            $data['per_id'] = $perId;

        $result = $this->where($data)
            ->order($order)
            ->paginate(8);
        //echo $this->getLastSql();
        return $result;
    }
    
    public function add($data = []) {
        // 如果提交的数据不是数组
        if(!is_array($data)) {
            exception('传递的数据不是数组');
        }

        $data['status'] = 1;
        return $this->data($data)->allowField(true)
            ->save();
    }

    /**
     * 根据用户名获取用户信息
     * @param $username
     */

    public function getUserByUsername($username) {
        if(!$username) {
            exception('用户名不合法');
        }

        $data = ['username' => $username];
        return $this->where($data)->find();
    }

}