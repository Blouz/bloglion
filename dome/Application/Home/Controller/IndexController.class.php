<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	// 显示首页
    public function index(){
        
    		add_access();
    		$are = M('Article')->where(array("status"=>0))->select();
    		$id =  i_array_column($are,"blog_id");
    		$where = where_id($id,"ar_id");
    		$res = M('Src')->where($where)->select();
    		$rec_id = i_array_column($res,"la_id");
    		$flip = is_array_flip($rec_id);
    		$la_id = where_id($flip,"la_id");
    		$lable = M('Label')->where($la_id)->select();   //标签表查询
    		$Flip = array_combine($flip,$lable);	//标签
    		$Article = array_combine(i_array_column($are,"blog_id"),$are);  //文章数组
    		foreach ($res as $value) {
 		      $Article[$value['ar_id']]['la_name'][] = $Flip[$value['la_id']]['la_name'];
 		    }
            //p($lable);die;
    		$this->assign('are',$Article);
            $this->display();
    }
    
    	 
}