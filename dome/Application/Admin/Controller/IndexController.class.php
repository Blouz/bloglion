<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends ComnController {
    public function main(){
            $adm = session("ok");
            $are = M('Admin')->where(array("id"=>$adm['id']))->find();
            $sum = M('Admin')->select();
            $unmber = count($sum);
            $article_sum = M('Article')->select();
            $ar_sum = count($article_sum);
            $ti = explode("-", date("Y-m-d"));
            $kaishi = mktime(0,0,0,intval($ti['1']),intval($ti['2']),intval($ti['0']));
            $number_sum = 0;
            $jeishu = strtotime(date("Y-m-d 23:59:59"));
            //今日注册::
            foreach ($sum as $key => $value) {
               if(strtotime($value['adm_creat_time']) > $kaishi && strtotime($value['adm_creat_time']) < $jeishu)
               {
                    $number_sum ++;
               }
            }
            //今日登陆
            $lu = 0;
            foreach ($sum as $key => $value) {
                if(strtotime($value['adm_last_time']) > $kaishi && strtotime($value['adm_last_time']) < $jeishu)
                {
                   $lu ++;  
                }
            }
            $this->assign('ar_sum',$ar_sum);//文章总数
            $this->assign('unmber',$unmber);//总用户数
            $this->assign('number_sum',$number_sum);//今日注册
            $this->assign('lu',$lu);//今日登陆
            $this->assign('are',$are);
    		$this->display();

    }	

    //清除SESSION
    public function unse()
    {
    	   session_destroy();
    	   $this->redirect('Login/login');
    }
    //统计PV UV
    public function count()
    {
        $str = "Day,访问量(PV),访问用户(UV)"."\n";
        for($a = 0; $a < 7; $a++)
        {
            $day = $a * 24 * 3600;
            $otime = strtotime(date("Y-m-d")) - $day;
            $ftime = strtotime(date("Y-m-d"))+3600*24 -1 - $day;
            $time[] = ['ac_time'=>['egt',$otime]];
            $time[] = ['ac_time'=>['elt',$ftime]];
            $Pv = M('Access')->where($time)->count();//pv
            $Uv = M("Access")->field("ac_ip")->where($time)->group("ac_ip")->select();
            $sum = count($Uv);//UV
            unset($time);
            $str.= date("Y/m/d",$otime) . ",". $Pv . "," . $sum ."\n"; 
        }
            echo $str;
    }
    	  
}