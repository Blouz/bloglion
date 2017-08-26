<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    //用户登录 
    public function login(){

          if(IS_POST)
          {
             $data = I('post.');
             if(!isset($data['username']) || !isset($data['us_pwd']))
             {
                $this->error('账号或密码为空',U('Login/login'));
             }
             $are = M('User')->where(['username'=>$data['username']])->find();
             if($are)
             {
                if(empty($are['us_salt']))
                {
                    if($are['us_pwd'] == md5($data['us_pwd']))
                    {
                        $number = rand(0,9999);
                        $us_pwd = md5(md5($data['us_pwd']).$number);
                        $add = M('User')->where(['us_id'=>$are['us_id']])->save(['us_pwd'=>$us_pwd,"us_salt"=>$number]);
                        update_user($are['us_id']);
                        session('ok',$are);
                        $this->redirect('Index/index');
                    }
                    else
                    {
                        $this->error('密码错误!请重新登录',U('Login/login'));
                    }
                    
                     
                }
                else
                {
                    if($are['us_pwd'] == md5(md5($data['us_pwd']).$are['us_salt']))
                    {
                         update_user($are['us_id']);
                         session('ok',$are);
                         $this->redirect('Index/index');
                    }
                    else
                    {
                         $this->error('密码错误!请重新登录',U('Login/login'));
                    }
                }
             }
             else
             {
                $this->error('账号错误!请重新登录',U('Login/login'));
             }
           
          }
          else
          {
              $this->display();
          }

    }
    //用户注册
    public function login_Adm()
    {

    	  if(IS_POST)
    	  {
    	  	    $data = I('post.');
                $data['us_pwd'] = md5($data['us_pwd']);
                $data['us_creat_time'] = time();
                $data['us_last_time'] =  time();
                $data['us_ip'] =  get_client_ip();
                unset($data['tow_pwd']);
        	      if(empty($data['username']) || empty($data['us_pwd']))
                {
                    $this->error('账号或密码为空',U('Login/login_adm'));
                }
                $are = M('user')->where(array("username"=>$data['username']))->find();
                if($are)
                {
                    $this->error('账号已存在!请登录',U('Login/login'));
                }
                else
                {
                    $res = M('User')->add($data); 
                    if($res)
                    {
                        $this->success('注册成功!请登录',U('Login/login'));
                    }
                    else
                    {
                        $this->error('添加失败!请先注册',U('Login/login_adm'));
                    }
                }
    	  }
        else
    	  {
    	  	 $this->display();
    	  }

    }

      //验证码
     function verify()
        {
            $config =    array
            (  
            'fontSize'    =>    30,    // 验证码字体大小    
            'length'      =>    3,     // 验证码位数    
            'useNoise'    =>    false, // 关闭验证码杂点
            );
            $Verify =     new \Think\Verify($config);
            ob_clean();
            $Verify->entry();
        }

        public function code_Number()
        {
           $data = I('get.');
           if(!$this->check_Code($data['code']))
           {
              echo "1";exit;
           }
            if(!empty($data['number']))
           {
               $this->number_Test($data['number']);
           }else
           {
              echo "2";exit;
           }
        }
        //判断验证码是否正确
         public function check_Code($code,$id="")
        {
            $moodel = new \Think\Verify();
            return $moodel ->check($code,$id);
        }
        //验证手机短信
        public function number_Test($tel)
        {
             $rand = rand(11,9999);
             $code = urlencode("code=".$rand);
             session("code",$code);
             session("tel",$tel);
             $url = "http://api.k780.com/?app=sms.send&tempid=50926&param=$code&phone=$tel&appkey=20001&sign=9d94b2c4e0e5ecca4fad6a9729430116&format=json";
             $code_url = file_get_contents($url);
             echo json_decode(code_url);exit;
        }


        public function number_Tel()
        {
             $tel = I('get.number');
             $le = session('code');
             if($le != $tel)
             {
                 echo "2";exit;
             }
        }
    	 
}