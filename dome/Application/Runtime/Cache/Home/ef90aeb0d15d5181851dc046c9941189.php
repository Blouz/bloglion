<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>显示</title>
</head>
<body>
<center>
<form action="/php3/TPS/thinkphp_3.2.3_full/index.php/Home/Index/suo" method="get">
	name<input type="text" name="name" >
	type<input type="text" name="type" >
	<input type="submit" value="搜索">
</form>
	   <table border="1">
	   	<tr>
	   		<td>name</td>
	   		<td>file</td>
	   		<td>type</td>
	   	</tr>
	   	<?php if(is_array($acc)): foreach($acc as $key=>$v): ?><tr>
	   	    <td><?php echo ($v["name"]); ?></td>
	   		<td><img src="/php3/TPS/thinkphp_3.2.3_full/Public<?php echo ($v["one"]); ?>" width="150px" alt=""></td>
	   		<td><?php echo ($v["t"]); ?></td>
	   	</tr><?php endforeach; endif; ?>
	   </table>
	   <?php echo ($page); ?>
	   </center>
</body>
</html>