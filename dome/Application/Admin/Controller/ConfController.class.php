<?php
namespace Admin\Controller;
use Think\Controller;
class ConfController extends ComnController {
    public function conf()
    {	
    	if(IS_POST)
    	{
    		$data = I('post.');
    		//p($data);die;
    		foreach ($data as $key => $value) {
    		  $res = M('Deploy')->where(array("dep_key"=>$key))->save(array("dep_key"=>$key,"dep_value"=>$value));
    		  if($res === false)
    		  {
    		  	 $this->error('配置更新失败');
    		  }
    		}
    		     $this->success('配置更新Ok');

    	}else
    	{
    		$arr = con_fig();
    		$this->assign('are',$arr);
    		$this->display();
    	}
      	
    }


}