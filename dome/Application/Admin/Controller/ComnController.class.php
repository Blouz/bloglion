<?php
namespace Admin\Controller;
use Think\Controller;
class ComnController extends Controller {
    public function __construct()
    {
       parent::__construct();
       $iset = session('ok');
       if(!isset($iset))
       {
          $this->error('请选登录',U('Login/login'));
       }
       //配置
       $this->config = con_fig();
    }


}