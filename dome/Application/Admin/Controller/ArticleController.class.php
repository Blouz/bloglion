<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends ComnController {

	//文章添加
    public function article_add()
    {
     	if(IS_POST)
     	{
         	$data = I('post.');
            $data['blog_contre'] =  I("post.blog_contre",'','stripslashes');
            //把data里面标签删掉
            unset($data['label_name']);
         	//上传图片函数
      	    $file = updole_file("blog_img"); 
      	    $data['blog_img'] = $file;
            $adm = session('ok');
     		    $data['blog_time'] = time();
     		    $are = M('article')->add($data);
            $arr = [];
            //循环标签入库
            foreach ($data['blog_label'] as $key => $value) {
                  $arr[] = array("ar_id"=>$are,"la_id"=>$value);
            }
            $label = M('Src')->addAll($arr);
            if(!$label){$this->error("标签添加失败",U('Article/article_add'));}
     		if($are)
     		{    
                //操作日志
                 $move = "添加了文章：" . $data['blog_title'];
                 operate_com($adm['adm_name'],$move);
                $this->success("文章添加成功",U('Article/article_show'));
     		}else
     		{
     			$this->error("添加失败",U('Article/article_add'));
     		}
     		
     	}else
     	{   
        //标签查询
        $label = M('Label')->select();
        //分类查询
     		$are = M('Sort')->select();
        $this->assign('are',$are);
     		$this->assign('label',$label);
     		$this->display();
     	}
    }
    //文章显示
    public function article_show()
    {
        if(IS_AJAX)
        {
             $page = I('get.page');//当前页
             $textkey = I('get.textkey');
             $type = I('get.type');
             $stime =strtotime(I('get.stime'));//开始时间
             $etime = strtotime(I('get.etime'));//结束时间
             if($type=="请选择分类"){ $type = "";}
             $where = "blog_status=0 ";
             if(!empty($type))
             {
                $where .=" and blog_sort = $type";
             }
                if(!empty($textkey))
             {
                $where .=" and blog_title like '%$textkey%' ";
             }
              if(!empty($stime))
             {
                $where .=" and blog_time >= $stime ";
             }
             if(!empty($etime))
             {
                $where .=" and blog_time <= $etime ";
             }
             if($page == 'undefined'){$page = 1;}
             $size = I('get.size');//每页显示
             if($size == 'undefined'){$size = $this->config['PAGE_SIZE'];}
             $p = ($page-1)*$size;//偏移量
             $sum = M('Article')->where($where)->count();
             $number = ceil($sum/$size);//总页数
             $are = M('Article a')->join("blog_sort s on a.blog_sort = s.sort_id")
             ->where($where)
             ->limit($p,$size)
             ->select();
             echo json_encode(array("are"=>$are,"number"=>$number));   
        }
        else
        {
             $type = M('Sort')->select();
             $this->assign('type',$type);
             $this->display();
        }
    }
       //分类添加
       public function article_sort()
    {
    	if(IS_POST)
    	{
    		$data = I('post.');
            $adm = session('ok');
    		//判断分类是否存在
    		$are = M('Sort')->where(array("sort_name"=>$data['sort_name']))->find();
    		if($are)
    		{
    			$this->error('分类已存在！请重新添加');
    		}
            else
    		{
    			$res = M('Sort')->add($data);
    			if($res)
    			{
                    //操作日志
                    $move = "用户添加了分类：" . $data['sort_name'];
                    operate_com($adm['adm_name'],$move);
    				$this->success("添加成功",U('Article/article_add'));
    			}
                else
    			{
    				$this->error("添加失败！");
    			}
    		}
    	}
        else
    	{
    		   $this->display();
    	}
    }
        //分类删除
        public function sort_Showdel()
        {
             $id = I('get.id');
             $are = M('Sort')->where(array("sort_id"=>$id))->delete();
             echo $are?1:2;
        }
        //分类修改
          public function sort_Update()
          {
            $id = I('get.id');
            $val = I('get.val');
            //操作日志
            $adm = session('ok');
            $move = "用户修改了分类：" . $val;
            operate_com($adm['adm_name'],$move);
            $are = M('Sort')->where(array("sort_id"=>$id))->save(array("sort_name"=>$val));
            echo $are?1:2;
          }



        //分类显示
        public function sort_Show()
        {
            $count = M('Sort')->count();// 查询满足要求的总记录数
            $Page = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
            $list = M('Sort')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('page',$show);
            $this->assign('are',$list);
            $this->display();
        }


    //标签显示
    public function article_label()
    {
            //查询标签表中的数据
    		if(IS_AJAX)
    		{
				$id = I("get.id");
				$are = M('Label')->where(array("la_id"=>$id))->delete();
				echo $are ?1:2;
					
    		}
    		else
    		{
                $count = M('Label')->count();// 查询满足要求的总记录数
                $Page = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
                $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
                $list = M('Label')->limit($Page->firstRow.','.$Page->listRows)->select();
                $this->assign('page',$show);
			    $this->assign('are',$list);
		    	$this->display();
    		}
	 		
	   
    }

    //标签添加
        public function article_labeladd()
    {
    	if(IS_POST)
    	{
    		$data = I('post.');
            $adm = session('ok');
    		$where = M('Label')->where(array("la_name"=>$data['la_name']))->find();
    		if($where)
    		{
    			$this->error('标签已存在！',U('Article/article_labeladd'));
    		}
    		else
    		{
    				$are = M('Label')->add($data);
		    		if($are)
		    		{
                        //操作日志添加
                        $move = "用户添加了标签：" . $data['la_name'];
                        operate_com($adm['adm_name'],$move);
		    			$this->redirect('Article/article_label');
		    		}
		    		else
		    		{
		    			$this->error('标签添加失败',U('Article/article_labeladd'));
		    		}
    		}
    	}
    	else
    	{

    	   $this->display();
    	}
    	
    }
    //验证标签是否存在
    public function la_name()
    {
        $la_name = I('post.la_name');
        //去除字符串俩段的空格
        $trim = trim($la_name);
        $are = M('Label')->where(array("la_name"=>$trim))->find();
        echo $are? 'false': 'true';
    }
    //删除博文回收站
    public function articleDelete()
    {
        $id = I('get.id');
        $are = M('Article')->where(array("blog_id"=>$id))->delete();
        echo $are?1:2;
    }


    //删除文章
    public function article_update()
    {
        $id = I('get.id');
        $sum = 1;
        //操作日志
        $adm = session('ok');
        $move = "用户删除了文章ID：" . $id;
        operate_com($adm['adm_name'],$move);
        $are = M('Article')->where(array("blog_id"=>$id))->save(array("blog_status"=>$sum));
        echo $are?1:2;
    }

    //验证分类是否存在
    public  function sort_name()
    {
        $sort_name = I('post.sort_name');
        //去除字符串俩段的空格
        $trim = trim($sort_name);
        $are = M('Sort')->where(array("sort_name"=>$trim))->find();
        echo $are? 'false': 'true';  
    }

    //博文回收站
    public function article_recy()
    {
        if(IS_AJAX)
        {
            $page = I('get.page');
            $size = I('get.size');
            $p = ($page-1)*$size;
            $are = M('Article')->where(array("blog_status"=>1))->limit($p,$size)->select();
            $count = M('Article')->where(array("blog_status"=>1))->count();
            $number = ceil($count/$size);
            echo json_encode(array("number"=>$number,"are"=>$are));
        }else
        {
          $this->display();
        }
        
    }

    public function recy_update()
    {
        $id = I('get.id');
        $sum = 0;
        //操作日志
        $adm = session('ok');
        $move = "用户恢复了文章ID：" . $id;
        operate_com($adm['adm_name'],$move);
        $are = M('Article')->where(array("blog_id"=>$id))->save(array("blog_status"=>$sum));
        echo $are?1:2;
    }
    public function ar_update()
    {
       if(IS_POST)
       {
          $data = I('POST.');
          $adm = session('ok');
          $data['blog_contre'] =  I("post.blog_contre",'','stripslashes');
          $file = updole_file("blog_img");
          M('Src')->where(array("ar_id"=>$data['id']))->delete();//删除原先的标签
          $arr = [];
          foreach ($data['blog_label'] as $key => $value) {
             $arr[] = array("ar_id"=>$data['id'],"la_id"=>$value);
          }
          $res = M('Src')->addAll($arr);//添加标签
          $data['blog_time'] = time();
          $data['blog_img'] = $file;
          unset($data['blog_label']);
          $are = M('Article')->where(array("blog_id"=>$data['id']))->save($data);
          if($are)
          {
             $move = "用户修改了了文章";
             operate_com($adm['adm_name'],$move);
             $this->success('文章修改成功',U('Article/article_show'));

          }else
          {
             $this->success('文章修改失败',U('Article/article_show'));
          }
          
       }else
       {
           $id = I('get.id');
           $are = M('Article')->where(array("blog_id"=>$id))->find();
           $sort = M('Sort')->select();
           $label = M('Label')->select();
           $label_id = M('Src')->where(array("ar_id"=>$id))->select();
           $ia_id = i_array_column($label_id,"la_id");
           $this->assign('ia_id',$ia_id);//标签id
           $this->assign('label',$label);//标签数据
           $this->assign('sort',$sort);//分类数据
           $this->assign('are',$are);
           $this->display();
       }
       
       
    }


}