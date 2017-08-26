<?php
namespace Admin\Controller;
use Think\Controller;
class LinkController extends ComnController {
	//友情链接添加
    public function link()
    {
      	if(IS_POST)
      	{
      			$data = I('post.');
            $adm = session('ok');
      			$are = M('Link')->add($data);
      			if($are)
      			{
              $move = $adm['adm_name'] . "用户添加了友情链接".$data['link_name'];
              operate_com($adm['adm_name'],$move);
      				$this->success('友情链接添加成功',U('Link/link_Show'));
      			}else
      			{
      				$this->error('错误',U('Link/link'));
      			}
      	}else
      	{
      		$this->display();
      	}
    }

    //友情链接显示
    public function link_Show()
    {
    	if(IS_AJAX)
    	{
    		 $page = I('get.page');//当前页
             if($page == 'undefined'){$page = 1;}
             $size = I('get.size');//每页显示
             if($size == 'undefined'){$size = $this->config['PAGE_SIZE'];}
             $p = ($page-1)*$size;//偏移量
             $sum = M('Link')->where(array("link_status"=>0))->count();
             $number = ceil($sum/$size);//总页数
             $are = M('Link')->where(array("link_status"=>0))->limit($p,$size)->select();
             //p($are);die;
             echo json_encode(array("are"=>$are,"number"=>$number));  
    	}else
    	{
	    	$this->display();
    	}
    	
    }
    //友情链接删除 
    public function link_Del(){
       $adm = session('ok');
    	 $id = I('get.id');
    	 $are = M('Link')->where(array("link_id"=>$id))->delete();
       $move = $adm['adm_name'] . "用户删除了友情链接"."ID".$id;
       operate_com($adm['adm_name'],$move);
    	 echo $are?1:0;
    }
    //友情链接名称修改
    public function link_Update()
    {
    	$id = I('get.id');
    	$val = I('get.val');
    	$are = link_update($id,$val);
    	echo $are;
    }
    //友情链接地址修改
    public function link_Url()
    {
    	$id = I('get.id');
    	$val = I('get.val');
    	$are = link_update($id,$val);
    	echo $are;
    }


}