<?php
return array(
	//'配置项'=>'配置值'
	//数据库配置信息
	//数据库类型
	'DB_TYPE'   => 'mysql',
	//服务器地址 
	'DB_HOST'   => '127.0.0.1',
	//数据库名 
	'DB_NAME'   => 'blogs', 
	//用户名
	'DB_USER'   => 'root', 
	//密码
	'DB_PWD'    => '419479', 
	//端口
	'DB_PORT'   => 3306, 
	//数据库表前缀
	'DB_PREFIX' => 'blog_', 
	//字符集
	 'DB_CHARSET'=> 'utf8', 

	 'DEFAULT_CONTROLLER'    =>  'Login', // 默认控制器名称

	 'DEFAULT_ACTION'        =>  'login', // 默认操作名称

	 'TMPL_ACTION_ERROR'     =>  'Public/error', // 默认错误跳转对应的模板文件

	 'TMPL_ACTION_SUCCESS'   =>  'Public/success', // 默认成功跳转对应的模板文件

	 //'TMPL_EXCEPTION_FILE'   =>  '',// 异常页面的模板文件

	
);