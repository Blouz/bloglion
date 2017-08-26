<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>  
<head>
<style>
    
      .error{
          color:red;
      }
</style>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<meta name="keywords" content="Flat Dark Web Login Form Responsive Templates, Iphone Widget Template, Smartphone login forms,Login form, Widget Template, Responsive Templates, a Ipad 404 Templates, Flat Responsive Templates" />
<link href="/Public/hcss/css/style.css" rel='stylesheet' type='text/css' />
<!--webfonts-->
<link href='http://fonts.useso.com/css?family=PT+Sans:400,700,400italic,700italic|Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.useso.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
<!--//webfonts-->
<script src="/Public/auto/jq.js"></script>
<script type="text/javascript" src="/Public/auto/jq.js"></script>
<script type="text/javascript" src="/Public/validation/jquery.validate.js"></script>
<script type="text/javascript" src="/Public/validation/messages_zh.js"></script>
</head>
<body>
<script>$(document).ready(function(c) {
    $('.close').on('click', function(c){
        $('.login-form').fadeOut('slow', function(c){
            $('.login-form').remove();
        });
    });   
});
</script>
 <!--SIGN UP-->
 <h1>klasikal Login Form</h1>
<div class="login-form">
    <div class="close"> </div>
        <div class="head-info">
            <label class="lbl-1"> </label>
            <label class="lbl-2"> </label>
            <label class="lbl-3"> </label>
        </div>
            <div class="clear"> </div>
    <div class="avtar">
        <img src="/Public/hcss/images/avtar.png" />
    </div>
            <form action="<?php echo U('Login/login');?>" id="signupForm" method="post">
                    <input type="text" class="text" name="username"  placeholder="home" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'home';}" >
                        <div class="key">
                    <input type="password" name="us_pwd" placeholder="Password" >
                        </div>
                            <div class="signin">
        <input type="submit" value="Login" >
    </div>
            </form>

</div>
 <div class="copy-rights">
                    <p>Copyright &copy; 2015.Company name All rights reserved.More Templates <a href="<?php echo U('Login/login_Adm');?>" target="_blank" title="注册">注册</a> - Collect from <a href="http://www.cssmoban.com/" title="Zy" target="_blank">Zy</a></p>
            </div>

</body>
</html>
<script>
    $("#signupForm").validate({

                      rules: {
                         username: {
                        required: true,
                        minlength: 2,                 
                      },
                        us_pwd: {
                        required: true,
                        minlength: 3,                 
                      },
                      
                    },

                  messages:{
                        username:{
                        required:"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+'请输入账号',
                        minlength:"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+'账号最好俩位',
                         },
                         us_pwd:{
                        required:"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+'请输入密码',
                        minlength:"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+'密码最少输入三位',
                         },
            
                        
                  }
         })
    
</script>