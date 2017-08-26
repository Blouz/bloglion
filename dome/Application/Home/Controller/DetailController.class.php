<?php
namespace Home\Controller;
use Think\Controller;
class DetailController extends Controller {
    public function detail_Show(){
            $id = I('get.id');
            $are = M('Article')->where(['blog_id'=>$id])->find();   
            // $this->config = con_fig();
            // $con_fig = $this->config['WEB_CON'];
            // if( $con_fig == 1)
            // {
            //     $mem=new Memcache;
            //     $data = $mem->connect('127.0.0.1',11211);
            //     p($data);die;
            //     $val = $mem->get($id);
            //     if(empty($val))
            //     {   
            //         //echo "666";
            //         $are = M('Article')->where(['blog_id'=>$id])->find();
            //         $val = $mem->set($id,$are);
            //     }else
            //     {
                    
            //     }
            // }else
            // {
               
            // }
    		$this->assign('id',$id);
    		$this->assign('are',$are);
            $this->display();

    }   

    public function article_Sum()
    {
    	$id = I('get.id');
    	M('Article')->where(['blog_id'=>$id])->setInc("blog_sum");
    }
    public function Session()
    {
       session_destroy();
       $this->redirect('Index/index');
    } 
}