<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        
    	 $this->display();
    }

        public  function log_in()
        {
                $data  = I("get.");
                //判断密码跟账号是否为空
                if(!isset($data['adm_pwd']) || !isset($data['adm_name']))
                {
                    $this->error('账号或密码为空',U('Login/login'));
                }
                $are = M('admin')->where(array("adm_name"=>$data['adm_name']))->find();
                //p($are);die;
                //查询账号是否有盐
                if($are)
                {
                if(empty($are['adm_salt']))
                {    //判断密码是否正确
                    if($are['adm_pwd'] == md5($data['adm_pwd']))
                    {   //随机数 拼接一个新的密码
                        $ran = rand(1,9999);
                        $sum = md5(md5($data['adm_pwd']).$ran);
                        M('admin')->where(array("id"=>$are['id']))->save(array("adm_pwd"=>$sum,"adm_salt"=>$ran));
                        //修改登录信息
                        update_adm($are['id']);
                        session('ok',$are);
                        $this->redirect('Index/main');
                    }
                    else
                    {   
                        $this->error("密码错误",U('Login/login'));
                    }

                }else
                {
                    
                    if($are['adm_pwd'] == md5(md5($data['adm_pwd']).$are['adm_salt']))
                    {    
                         //更新信息时间--ip
                         update_adm($are['id']);
                         session('ok',$are);
                         $this->redirect('Index/main');
                    }
                    else
                    {
                         $this->error("密码错误",U('Login/login'));
                    }
                  }
                }
                else
                    {
                        $this->error('账号不正确',U('Login/login'));   
                    }
        }


    //管理员添加
    public function register()
    {
    	if(IS_POST)
    	{      
    		$data = I('post.');
            $adm = session('ok');
            if(empty($data['adm_pwd']))
            {
                $this->error('密码为空',U('Login/register'));
            }
            unset($data['adm_tow_pwd']);
    		$data['adm_pwd'] = md5($data['adm_pwd']);//密码
    		$data['adm_creat_time'] = date("Y-m-d H:i:s",time());//创建时间
    		$data['adm_last_time'] = date("Y-m-d H:i:s",time());//最后登录时间
    		$data['adm_ip'] = get_client_ip();
            if(empty($data['adm_pwd']) || empty($data['adm_name']))
            {
                $this->error('账号或密码为空',U('Login/register'));
            }
            else
            {
                  //判断账号是否存在
                  $res = M("Admin")->where(array("adm_name"=>$data['adm_name']))->find();
                  if($res)
                  {
                       $this->error('账号已存在',U('Login/register'));
                  }
                  else
                  {
                    //添加                  
                    $move = "用户添加了管理员：" . $data['adm_name'];
                    operate_com($adm['adm_name'],$move);
                    $add = M('admin')->add($data);
                    if($add)
                    {
                        $this->success("Ok",U('Login/adm_show'));
                    }
                    else
                    {
                        $this->error('添加失败',U('Login/register'));
                    }
                  } 
            }
    	}
        else
    	{
            //视图
			$this->display();
    	}
    	
    }


    public function adm_show()
    {
        if(IS_AJAX)
        {
            $page = I('get.page');
            $size = I('get.size');
            $p = ($page-1)*$size;
            $are = M('Admin')->limit($p,$size)->select();
            $count = M('Admin')->count();
            $number = ceil($count/$size);
            echo json_encode(array("number"=>$number,"are"=>$are));
        }
        else
        {
            $this->display();
        }
    }
    //验证账号是否重复
    public function name_one()
    {
        $name = I('post.adm_name');
        $are = M('Admin')->where(array("adm_name"=>$name))->find();
        echo $are? 'false': 'true';
    }
    public function adm_del()
    {
        $id = I('get.id');
        $admin = session('ok');
        if($admin['id'] == '1')
        {
            $are = M('Admin')->where(array("id"=>$id))->delete();
            echo $are?1:0;
        }else
        {
            echo '0';  
        }
    }
        //修改管理员名称
        public function update()
        {
            $id = I('get.id');
            $val = I('get.val');
            //操作日志
            $adm = session('ok');
            $move = "用户修改了管理员账号：" . $val;
            operate_com($adm['adm_name'],$move);
            $are = M('Admin')->where(array("id"=>$id))->save(array("adm_name"=>$val));
            echo $are?1:2;
        }

        //密码修改
        public function adm_update()
        {
            if(IS_POST)
            {
                $data = I('post.');
                $id = session('ok');
                if(empty($data['old']) ||empty($data['adm_pwd']) ||empty($data['adm_tow_pwd']))
                {
                    $this->error('原密码或新密码为空！请重新填写',U('Login/adm_update'));
                }
                $adm = M('Admin')->where(array("id"=>$data['id']))->find();
                if($id['id'] == 1)//判断是否root总管理
                {
                  if(empty($adm['adm_salt']))//判断盐字段是否为空
                  {
                   //判断原密码是否跟数据库一致
                   $old = md5($data['old']);
                   if($adm['adm_pwd'] == $old)
                   {
                      //修改
                      $old_adm = M('Admin')->where(array("id"=>$data['id']))->save(array("adm_pwd"=>$old));
                      if($old_adm){
                        //操作日志
                        $move = $id['adm_name'] . "用户修改了"."ID为".$data['id']."的管理员密码：";
                        operate_com($adm['adm_name'],$move);
                        $this->success('密码修改成功!',U('Login/adm_show'));
                      }else
                      {
                        $this->error('密码修改失败！',U('Login/adm_update'));
                      }
                   }else
                   {
                     $this->error('原密码不正确！',U('Login/adm_update'));
                   }

                }else
                {
                    //有盐  原密码+盐字段
                    $new = md5(md5($data['old']).$adm['adm_salt']);
                    $ol = md5(md5($data['adm_pwd']).$adm['adm_salt']);
                    if($new  == $adm['adm_pwd'])
                    {
                      $old_adm = M('Admin')->where(array("id"=>$data['id']))->save(array("adm_pwd"=>$ol));
                      if($old_adm){
                        $move = $id['adm_name'] . "用户修改了"."ID为".$data['id']."的管理员密码：";
                        operate_com($adm['adm_name'],$move);
                        $this->success('密码修改成功',U('Login/adm_show'));
                      }else
                      {
                        $this->error('密码修改失败！',U('Login/adm_update'));
                      }
                    }else
                    {
                        $this->error('原密码不正确！',U('Login/adm_update'));
                    }
                }
                }else
                {
                    //只有home有权限
                    $this->error('没有修改权限！',U('Login/adm_show'));
                }
            }
            else
            {   
                //用户的id
                $id = I('get.id');
                $this->assign('id',$id);
                $this->display();
            }
        }



    	  
}