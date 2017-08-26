<?php
namespace Admin\Controller;
use Think\Controller;
class LogController extends ComnController {
    public function log_show(){
         if(IS_AJAX)
         {
            $page = I('get.page');
            $size = I('get.size');
            $p = ($page-1)*$size;
            $are = M('AdmCom')->limit($p,$size)->select();
            $count = M('AdmCom')->count();
            $number = ceil($count/$size);
            echo json_encode(array("number"=>$number,"are"=>$are));
         }
         else
         {
            $onetime = time()-30*24*3600;//一月
            $towtime = time()-60*24*3600;//二月
            $theetime = time()-90*24*3600;//三月
            $this->assign('onetime',$onetime);
            $this->assign('towtime',$towtime);
            $this->assign('theetime',$theetime);
            $this->display();
         }
        

    }
    //根据时间批删操作日志数据
    public function log_Del()
    {
        $stotime =  I('post.time_type');
        if($stotime =='1')
        {
            $this->error('请选择日期',U('Log/log_show'));
        }
         $are = M("adm_com")->where("adm_time < $stotime")->delete();
        if($are)
        {
             $this->success('删除成功',U('Log/log_show'));
        }else
        {
             $this->error('没有数据可删除!',U('Log/log_show'));
        }
    }
    	  
}
