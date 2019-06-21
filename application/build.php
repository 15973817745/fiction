<?php
return [
	//生成应用公共文件
	'__file__' => ['common.php','config.php','database.php'],
	//定义demo模块的自动生成（按照实际定义的文件名生成）
	'common' =>[
		'__dir__' => ['model'],
		'model'=>['Category','Admin'],
	],
	'admin' =>[
		'__dir__' => ['controller','view'],
		'controller'=>['Index'],
		'view' =>['index/index'],
	],
	'api' =>[
		'__dir__' => ['controller','view'],
		'controller' => ['Index','Image'],
	],
	'bis'=>[
		'__dir__' => ['controller','view'],
		'controller'=>['Register','Login'],
	],
	//其他更多的模块定义
];