<?php 

			function con_fig()
			{
				$are = M('Deploy')->select();
	    		$arr = [];
	    		foreach ($are as $key => $value) {
    	        $arr[$value['dep_key']] = $value['dep_value'];
    		     }
    		    return $arr;

			}

			//array_column()
    

 ?>