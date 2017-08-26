<?php
return array(

	//字符集
	 'DB_CHARSET'=> 'utf8', 

	 'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称

	 'DEFAULT_ACTION'        =>  'index', // 默认操作名称

	 'TMPL_ACTION_ERROR'     =>  'Public/error', // 默认错误跳转对应的模板文件

	 'TMPL_ACTION_SUCCESS'   =>  'Public/success', // 默认成功跳转对应的模板文件

	  'HTML_CACHE_ON'     =>    true, // 开启静态缓存
	 
	 'HTML_CACHE_TIME'   =>    60,   // 全局静态缓存有效期（秒）
	 
	 'HTML_FILE_SUFFIX'  =>    '.shtml', // 设置静态缓存文件后缀
	 
	 'HTML_CACHE_RULES'  =>     array(  // 定义静态缓存规则     // 定义格式1 数组方式     
	 
	 //'user:'=>array('User/{:action}_{id}','600')
	 '*'=>array('{$_SERVER.REQUEST_URI|md5}'),

	 )

	
);