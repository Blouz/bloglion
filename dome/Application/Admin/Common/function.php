<?php 
     
     function p($data)
     {	
     	echo "<pre>";
     	print_r( $data);
     }
     //递归删除缓存
     function crat_aw_ay($path)
     {
        
          if(file_exists($path))
         {
             $open = opendir($path);
             while (($file = readdir($open)) !== false) {
               if($file =='.' || $file =='..' )
                 {
                     continue;
                 }
                    if(is_dir($path.$file))
                    {
                       crat_aw_ay($path.$file."/");
                    }else
                    {
                        $return = unlink($path.$file);
                        if(!$return)
                        {
                            return false;
                           
                        }     
                    }  
             } 
             return true; 
         }
     }

     //修改友情链接
     function link_update($id,$val)
     {
        $are = M('Link')->where(array("link_id"=>$id))->save(array("link_name"=>$val));
        return $are?1:2;
     }


     //管理员操作日志
     function operate_com($adm,$move)
     {

        $info = array("adm_admin"=>$adm,"adm_time"=>time(),"adm_operate"=>$move);
        M('Adm_com')->add($info);

     }

     //更新用户信息
     function update_adm($id)
     {
     	$data['adm_last_time'] = date("Y-m-d H:i:s",time());;
     	$data['adm_ip'] = get_client_ip();
     	M('admin')->where(array("id"=>$id))->save($data);
     }

     //上传图片
     function updole_file($file_name)
     {
         $name = $_FILES[$file_name]['name'];
         //截取.后面的格式
         $png = strstr( $name, '.');
         $url = time().$png;
         $link = "./Public/updat/";
         $url_link = "http://blog.com/Public/updat/".$url;
         //判断是否有文件
         if(!file_exists($link))
         {
           //创建
           mkdir($link,0777,true);
         }
         $da = $link.$url;
         //把图片存储在地址里
         move_uploaded_file($_FILES['blog_img']['tmp_name'],$da);
         return $url_link;
     }

     //array_column()
      function i_array_column($input, $columnKey, $indexKey=null){
        if(!function_exists('array_column')){ 
            $columnKeyIsNumber  = (is_numeric($columnKey))?true:false; 
            $indexKeyIsNull            = (is_null($indexKey))?true :false; 
            $indexKeyIsNumber     = (is_numeric($indexKey))?true:false; 
            $result                         = array(); 
            foreach((array)$input as $key=>$row){ 
                if($columnKeyIsNumber){ 
                    $tmp= array_slice($row, $columnKey, 1); 
                    $tmp= (is_array($tmp) && !empty($tmp))?current($tmp):null; 
                }else{ 
                    $tmp= isset($row[$columnKey])?$row[$columnKey]:null; 
                } 
                if(!$indexKeyIsNull){ 
                    if($indexKeyIsNumber){ 
                      $key = array_slice($row, $indexKey, 1); 
                      $key = (is_array($key) && !empty($key))?current($key):null; 
                      $key = is_null($key)?0:$key; 
                    }else{ 
                      $key = isset($row[$indexKey])?$row[$indexKey]:0; 
                    } 
                } 
                $result[$key] = $tmp; 
            } 
            return $result; 
        }else{
            return array_column($input, $columnKey, $indexKey);
        }
    }

 //拼接or条件
    function where_id($id,$ar)
    {
        $arr = [];
        foreach ($id as $key => $value) {
             $arr[] = " $ar " . "= ". $value;
        }
        $or = implode($arr," or ");
        return $or;
    }
    //去除重复
        function is_array_flip($cou)
        {
             $qu  = array_flip($cou);
             $lai = array_flip($qu);
             return $lai;
        }

 ?>