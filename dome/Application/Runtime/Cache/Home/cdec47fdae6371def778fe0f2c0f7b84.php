<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
<style>
	
	  .error{
	  	  color:red;
	  }
</style>
		<meta charset="utf-8">
		<link href="/Public/login_adm/css/style.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<script type="text/javascript" src="/Public/auto/jq.js"></script>
<script type="text/javascript" src="/Public/validation/jquery.validate.js"></script>
<script type="text/javascript" src="/Public/validation/messages_zh.js"></script>
</head>
 
<body>
	<div class="main">
				 <h2>Or sign up with</h2>
				 <form action="<?php echo U('Login/login_adm');?>" id="signupForm" method="post">
		                    <div class="lable-2">
		                    <input type="text" class="text" placeholder="comncc@email.com" name="us_emaile" >
		                    </div>
		                    <div class="lable-2">
		                   <input type="text" class="text"  name="username"  placeholder="Username" >
		                      </div>
		                        <div class="lable-2">
		                   <input type="password"  id="password" name="us_pwd" class="text" placeholder="Password" >
		                   </div>
		                   <div class="lable-2">
		                 <input type="password"  name="tow_pwd" class="text"  placeholder="请输入密码">
		                 </div>
		                  <div class="lable-2">
		                 <input type="text"  placeholder="请输入验证码"  name="code" id="text">
		              	</div>
		              	<div class="lable-2">
		              	<h3><span>	<img src="<?php echo U('Login/verify');?>" id="add" width="160" height="40" alt="CAPTCHA" border="1"  style="cursor: pointer;" title="看不清？点击更换另一个验证码。" /></span></h3>
		              	</div>
		              	<div class="lable-2">
		                 <input type="text"   placeholder="请输入手机号"  name="number" id="number"><span id="te"></span>
							</div>
							<div class="lable-2">
							<h3><span><input  type="button" id="but" class="code" value="获取验证码"><span></h3>
						  	</div>
						  	<div class="lable-2">
				<input type="text" class="text" id="text"  placeholder="请输入手机号验证码"  name="number_sum" id="number">
							</div>
							<div class="submit">
									<input type="submit" id="tel" value="Blog_submit" >
								</div>
									<div class="clear"> </div>
							 </form>
		</div>
   					<div class="copy-right">
						<p>More Templates <a href="http://www.cssmoban.com/" target="_blank" title="Zy">Zy</a></p> 
					</div>
	 
</body>
</html>

<script type="text/javascript">

			 $(document).on('click','#tel',function(){
			 	  var number = $("#number").val();
			 	  $.get("<?php echo U('Login/number_Tel');?>",{'number':number},function(msg){
			 	  			if(msg == "2")
			 	  			{
			 	  				///alert('手机号不一致');
			 	  				return false;
			 	  			}
			 	  })	
			 })

  			 $(document).on('click','#add',function(){
	              var src = "<?php echo U('Login/verify');?>?ok="+Math.random();
	              $(this).attr("src",src);
              })
  			 $(".code").click(function() {
  			 	  var code = $("#text").val();
  			 	  var number = $("#number").val();
  			 	  $.get("<?php echo U('Login/code_Number');?>",{'code':code,'number':number},function(msg){
		 	  		if(msg == '1')
		 	  		{
		 	  			alert('验证码错误或失效');
		 	  		}
		 	  		if(msg == '2')
		 	  		{
		 	  			alert('手机号码错误');
		 	  		}
  			 	  })
  			 })
  			  

</script>
<script>
	$("#signupForm").validate({

                      rules: {
                      	 us_emaile: {
                        required: true,
                        minlength: 2,                 
                      },
                        username: {
                        required: true,
                        minlength: 2,                 
                      },
                       us_pwd: {
                        required: true,
                        minlength: 3,                 
        
                      },
                      tow_pwd: {
                      	required: true,
				        equalTo: "#password"
				      },
				       code: {
                      	required: true,
				        minlength: 3,  
				      },
				      number: {
                      	required: true,
				        minlength: 11,  
				      },
				       number_sum: {
                      	required: true,
				      },
                      
                    },

                  messages:{
                  		us_emaile:{
                        required:'请输入邮箱',
                        minlength:'邮箱五位',
                         },
                         username:{
                        required:'请输入账号',
                        minlength:'账号最少输入俩位',
                         },
                            us_pwd:{
                        required:'请输入密码',
                        minlength:'密码最少输入三位',
                        
                         },
                         tow_pwd: {
                         	required:'请输入确认密码',
					        equalTo: "两次密码输入不一致"
					      },
					        code: {
                         	required:'请输入验证码',
					        minlength:'验证码请输入三位',
					      },
					      code: {
                         	required:'请输入手机号',
					        minlength:'请输入11位手机号',
					      },
					       number_sum: {
                         	required:'请输入手机验证码',
					      },
                        
                  }
         })
	
</script>