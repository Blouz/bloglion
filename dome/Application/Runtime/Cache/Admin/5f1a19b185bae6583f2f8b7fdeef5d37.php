<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>文章标题</title>
<script src="/Public/auto/jq.js"></script> 
<link rel="stylesheet" href="/Public/markdown/css/editormd.css"/>
<script src="/Public/markdown/editormd.js"></script>  
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
				<legend>响应式的表单集合</legend>
			</fieldset>

			<form class="layui-form" action="<?php echo U('Article/article_add');?>" enctype="multipart/form-data" method="post">
				<div class="layui-form-item">
					<label class="layui-form-label">文章标题</label>
					<div class="layui-input-block">
						<input type="text" name="blog_title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
					</div>
					<div class="layui-form-item">
					<label class="layui-form-label">文章作者</label>
					<div class="layui-input-block">
						<input type="text" name="blog_author" lay-verify="title" autocomplete="off" placeholder="请输入作者" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">文章图片</label>
					<div class="layui-input-block">
						<input type="file" name="blog_img" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
					</div>
				</div>
				

				<div class="layui-form-item">
					<label class="layui-form-label">文章分类</label>
					<div class="layui-input-block">
						<select name="blog_sort" lay-filter="aihao">
						   <?php if(is_array($are)): $i = 0; $__LIST__ = $are;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["sort_id"]); ?>"><?php echo ($v["sort_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>

							<div class="layui-form-item">
					<label class="layui-form-label">文章标签</label>
					<div class="layui-input-block">
					<?php if(is_array($label)): $i = 0; $__LIST__ = $label;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><input type="checkbox" value="<?php echo ($v["la_id"]); ?>" name="blog_label[]" lay-verify="title" autocomplete="off" class="layui-input"><?php echo ($v["la_name"]); ?>&nbsp&nbsp<?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>

				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">文章内容</label>
					<div id="test-editormd">
    					<textarea style="display:none;" name="blog_contre" id="ts"></textarea>
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
		<script type="text/javascript" src="/Public/bluo/plugin/layui/layui.js"></script>
		<script>
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
						if(value.length < 1) {
							return '标题至少得1个字符啊';
						}
					},
					// pass: [/(.+){6,12}$/, '密码必须6到12位'],
					// content: function(value) {
					// 	layedit.sync(editIndex);
					// }
				});

				//监听提交
				// form.on('submit(demo1)', function(data) {
				// 	layer.alert(JSON.stringify(data.field), {
				// 		title: '最终的提交信息'
				// 	})
				// 	return false;
				// });
			});


			//文本域
			var testEditor;
			$(function() {
				testEditor = editormd("test-editormd", {
					width   : "1000px",
					height  : 300,
					syncScrolling : "single",
					path    : "/Public/markdown/lib/"
				});
			});
		</script>
	</body>

</html>