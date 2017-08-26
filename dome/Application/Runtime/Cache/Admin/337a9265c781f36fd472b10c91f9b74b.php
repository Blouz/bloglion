<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<style>
     .error{
         color: red;
     }

</style>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台模板</title>
    <link rel="stylesheet" href="/dome/Public/Admin/css2/amazeui.css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/dome/Public/Admin/css2/core.css" />
    <link rel="stylesheet" href="/dome/Public/Admin/css2/menu.css" />
    <link rel="stylesheet" href="/dome/Public/Admin/css2/index.css" />
    <link rel="stylesheet" href="/dome/Public/Admin/css2/admin.css" />
    <!-- <link rel="stylesheet" href="/dome/Public/Admin/css2/typography.css" /> -->
    <link rel="stylesheet" href="/dome/Public/Admin/css2/page/form.css" />
</head>
<body>
<div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="card-box">
                <!-- Row start -->
                <div class="am-g">
                    <div class="am-u-sm-12 am-u-md-6">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                               <span class="am-icon-plus am-btn am-btn-default"><a href="<?php echo U('Article/article_label');?>">返回列表</a> </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="am-g">
                    <div class="am-u-sm-12">
                        <form class="am-form" action="<?php echo U('Article/article_labeladd');?>" id="signupForm" method="post">
                            <table class="am-table am-table-striped am-table-hover table-main">
                                <thead>
                                <tr>
                                    <th class="table-title"><input type="text" id="la_name" name="la_name" placeholder="标签名称"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="submit" value="添加此标签" /></td>
                                </tr>
                                </tbody>
                            </table>
                     </form>
                    </div>
                </div>
            </div>
        </div>
</div>
<script type="text/javascript" src="/dome/Public/validation/jq.js"></script>
<script type="text/javascript" src="/dome/Public/validation/jquery.validate.js"></script>
<script type="text/javascript" src="/dome/Public/validation/messages_zh.js"></script>
<script>
         $("#signupForm").validate({

                      rules: {
                        la_name: {
                        required: true,
                        minlength: 2,
                        remote:{
                          url:"<?php echo U('Article/la_name');?>",
                          type:'post',
                          data:{
                            la_name:function(){
                              return $("#la_name").val();
                            }
                          }
                        }
                        
        
                      },
                    },

                  messages:{
                         la_name:{
                        required:'请输入标签',
                        minlength:'标签最少输入俩位',
                        remote:'标签已存在',
                        
                         },
                  }



         })
</script>