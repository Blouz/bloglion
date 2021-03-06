<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

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
				<button class="layui-btn" type="submit" lay-submit="" lay-filter="demo1"><a href="<?php echo U('Article/sort_Show');?>">分类列表</a></button>
			</fieldset>

			<form class="layui-form" action="<?php echo U('Article/article_sort');?>" id="signupForm" method="post">
				<div class="layui-form-item">
					<label class="layui-form-label">文章分类</label>
					<div class="layui-input-block">
						<input type="text" name="sort_name" id="sort_name" lay-verify="title" autocomplete="off" placeholder="请输入分类" class="layui-input">
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
		<script type="text/javascript" src="/Public/validation/jq.js"></script>
		<script type="text/javascript" src="/Public/validation/jquery.validate.js"></script>
		<script type="text/javascript" src="/Public/validation/messages_zh.js"></script>
		<script type="text/javascript" src="/Public/bluo/plugin/layui/layui.js"></script>
		<script>
		 $("#signupForm").validate({

                      rules: {
                        sort_name: {
                        required: true,
                        minlength: 2,
                        remote:{
                          url:"<?php echo U('Article/sort_name');?>",
                          type:'post',
                          data:{
                            sort_name:function(){
                              return $("#sort_name").val();
                            }
                          }
                        }
                        
        
                      },
                    },

                  messages:{
                         sort_name:{
                        required:'请输入分类',
                        minlength:'标签最少输入俩位',
                        remote:'分类已存在',
                        
                         },
                  }



         })
			layui.use(['form', 'layedit', 'laydate'], function() {
				
				var form = layui.form(),
					layer = layui.layer,
					layedit = layui.layedit,
					laydate = layui.laydate;

				//创建一个编辑器
				var editIndex = layedit.build('LAY_demo_editor');
			
				//自定义验证规则
				form.verify({
					title: function(value) {
						if(value.length < 4) {
							return '分类至少得4个字符啊';
						}
					},
					// pass: [/(.+){6,12}$/, '密码必须6到12位'],
					// content: function(value) {
					// 	layedit.sync(editIndex);
					// }
				});

				//监听提交
				// form.on('submit(demo1)', function(data) {
				// 	layer.alert(JSON.stringifyify(data.field), {
				// 		title: '最终的提交信息'
				// 	})
				// 	return false;
				// });
			});
		</script>
	</body>

</html>