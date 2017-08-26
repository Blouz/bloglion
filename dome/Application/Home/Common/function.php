<?php 

	function p($data)
     {	
     	echo "<pre>";
     	print_r( $data);
     }

           // function con_fig()
           //  {
           //      $are = M('Deploy')->select();
           //      $arr = [];
           //      foreach ($are as $key => $value) {
           //      $arr[$value['dep_key']] = $value['dep_value'];
           //       }
           //      return $arr;

           //  }

     //添加来访信息
     function add_access()
     {
        $user = session('ok');
        $name = isset($user)?$user['username']:' ';
        $data = array(
             "ac_ip"=>get_client_ip(),//ip
             "ac_time"=>time(),//时间
             "user_agent"=>$_SERVER['HTTP_USER_AGENT'],
             "ac_url"=>$_SERVER['REQUEST_URI'],
             "user_name"=>$name
            );
        M("Access")->add($data);
     }

     //修改登录信息
     function update_user($id)
     {
          $arr = array("us_last_time"=>time());
          M('User')->where(['us_id'=>$id])->save($arr);
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