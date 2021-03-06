<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <style>
     .error{
         color:red;
     }
   </style>
  <head>
    <meta charset="utf-8">
    <title>文章标题</title>

    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    
    <link rel="stylesheet" href="/Public/bluo/plugin/layui/css/layui.css" media="all" />
    <link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">
  </head>

  <body>
    <div style="margin: 15px;">
      <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>管理员添加</legend>
      </fieldset>

      <form class="layui-form" action="<?php echo U('Login/register');?>" id="signupForm"  method="post">
        <div class="layui-form-item">
          <label class="layui-form-label">账号</label>
          <div class="layui-input-block">
            <input type="text" name="adm_name" id="adm_name" lay-verify="title" autocomplete="off" placeholder="请输入账号" class="layui-input">
          </div>
        </div>
        

              <div class="layui-form-item">
          <label class="layui-form-label">密码</label>
          <div class="layui-input-block">
            <input type="password"  name="adm_pwd"  placeholder="请输入密码" lay-verify="title" autocomplete="off" id="password" class="layui-input">
          </div>
        </div>

                <div class="layui-form-item">
          <label class="layui-form-label">确认密码</label>
          <div class="layui-input-block">
            <input type="password" name="adm_tow_pwd" lay-verify="title" autocomplete="off" placeholder="请确认密码" class="layui-input">
          </div>
        </div>

        <div class="layui-form-item">
          <div class="layui-input-block">
            <button class="layui-btn" type="submit" lay-submit="" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
          </div>
        </div>
      </form>
    </div>
   
  </body>

</html>
<script type="text/javascript" src="/Public/validation/jq.js"></script>
<script type="text/javascript" src="/Public/validation/jquery.validate.js"></script>
<script type="text/javascript" src="/Public/validation/messages_zh.js"></script>
<script>
         $("#signupForm").validate({

                      rules: {
                        adm_name: {
                        required: true,
                        minlength: 2,
                        remote:{
                          url:"<?php echo U('Login/name_one');?>",
                          type:'post',
                          data:{
                            adm_name:function(){
                              return $("#adm_name").val();
                            }
                          }
                        }
                        
        
                      },
                      adm_pwd: {
                        required: true,
                        minlength: 6
                      },
                      adm_tow_pwd: {
                        required: true,
                        equalTo: "#password"
                       },
                    },

                  messages:{
                         adm_name:{
                        required:'请输入账号',
                        minlength:'账号最少输入俩位',
                        remote:'账号已存在',
                        
                         },
                        adm_pwd:{
                        required:'请输入密码',
                        minlength:'密码最少输入六位',
                         },
                        adm_tow_pwd:{
                        required:'请输入确认密码',
                        equalTo:'俩次密码不符！',
                         },
                  }

                  // showError:function(errorMap,errorList){
                  //    console.log(errorMap);
                  //   // $.each(errorList,function(k,v){

                  //   //       msg +=(v);
                  //   // })
                  //   // console.log(msg);
                  //   // if(msg!="")
                  //   // {
                  //   //    layer.alert(msg.{
                  //   //        skin:'layui-layer-lan',
                  //   //        closeBth:0,
                  //   //        anim:4,
                  //   //    })
                  //   // }
                  //      //onfocusot false;
                  // }



         })
</script>