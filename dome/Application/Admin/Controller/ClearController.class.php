<?php
namespace Admin\Controller;
use Think\Controller;
class ClearController extends Controller {
	//清除缓存
    public function aw_Ay()
    {
    	 if(crat_aw_ay(HTML_PATH))
    	 {
    	 	$this->success('清除缓存成功',U('Index/main'));
    	 }else
    	 {
			$this->error('清除缓存失败',U('Index/main'));
    	 }
    }


}