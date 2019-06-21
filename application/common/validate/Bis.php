<?php
namespace app\common\validate;
use think\Validate;
class Bis extends Validate {
    protected $rule = [
        'name' => 'require|max:25',
        'email' => 'email',
        'logo' => 'require',
        'city_id' => 'require',
        'bank_info' => 'require',
        'bank_name' => 'require',
        'bank_user' => 'require',
        'faren' => 'require',
        'faren_tel' => 'require',
        'category_id' => 'require',
        'origin_price' => 'require',
        'current_price' => 'require',
        'total_count' => 'require',
        'coupons_begin_time' => 'require',
        'coupons_end_time' => 'require',
         'start_time' => 'require',
        'end_time' => 'require',

        'username','require|max:10','账号必须填写|账号不能超过10个字符',
        'password' => 'require',
        'repassword' => 'require',
        ['section','require'],
        ['zhang','require|GT:0','章节必须填写|你的章节小于0'],
        ['status','number|in:-1,0,1','状态必须是数字|状态范围不符合'],
        ['listorder','number'],
        ['title','require|max:15','小说名不能为空|小说名不能超过15个字'],
        ['fiel','require|^[A-Za-z0-9]+$','名称不能为空|名称缩写只能输入数字和字母'],
        ['image','require'],
        ['image1','require'],
        ['section','require'],
        ['zhang','require|GT:0','章节必须填写|你的章节小于0'],
        ['description1','max:70','你的介绍不能超过70个字'],
        ['description','require'],

    ];

    // 场景设置
    protected  $scene = [
     'user'=>['username','password','repassword','email'],
        'storycas' =>['image1','section','zhang'],//验证添加章节
        'story' =>['title','fiel','image','image1','description1','section'],//验证添加小说
        'name'=>['username'],
    ];
}