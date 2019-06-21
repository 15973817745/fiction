<?php
namespace app\admin\validate;
use think\Validate;
class Category extends Validate{
	protected $rule = [
		['name','require|max:10','账号必须填写|不存在的账号'],
	    ['password','require|min:6','密码必须填写|输入的密码错误'],
		['parent_id','number'],
		['id','number'],
		['status','number|in:-1,0,1','状态必须是数字|状态范围不符合'],
		['listorder','number'],
		['title','require|max:15','小说名不能为空|小说名不能超过15个字'],
	    ['fiel','require|^[A-Za-z0-9]+$','名称不能为空|名称缩写只能输入数字和字母'],
		['image','require'],
	    ['image1','require'],
	    ['section','require'],
	    ['zhang','require|GT:0','章节必须填写|你的章节小于0'],
	    ['description1','max:70','你的介绍不能超过70个字'],
        ['pm_id','require','注册作者没有选择无法上传'],
		['description','require'],
	    ['story_tle','require','分类名不能为空']

	];
	/*场景设置*/
	protected $scene=[
	   'login' =>['name','password'],//登录
	   'story' =>['title','fiel','image','image1','pm_id','description1','section'],//验证添加小说
	    'storycas' =>['image1','section','zhang'],//验证添加章节
	    'tel'=>['story_tle']
	];
}