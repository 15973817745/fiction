<?php
namespace app\common\model;

use think\Model;

class AuthorLocation extends BaseModel
{

    public function getNormalLocationByBisId($bisId) {
        $data = [
            'bis_id' => $bisId,
            'status' => ['neq',-1],
        ];

        $result = $this->where($data)
            ->order('id', 'desc')
            ->select();
            // print_r($data);
            // echo $this->getLastSql();exit;
        return $result;
    }

     public function getFirstLocation($bisId = 0) {
        $data = [
            'bis_id' => $bisId,
            'status' => ['neq',-1],
        ];

        $order =[
            'listorder' => 'desc',
            'id' => 'desc',
        ];
        $result = $this->where($data)
            ->order($order)
            ->paginate();
        // echo $this->getLastSql();exit;

        return $result;

    }

    public function getNormalLocationsInId($ids) {
        $data = [
            'id' => ['in', $ids],
            'status' => 1,
        ];
        return $this->where($data)
            ->select();
    }

}