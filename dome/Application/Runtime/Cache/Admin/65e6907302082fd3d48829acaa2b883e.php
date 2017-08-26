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
        <legend>网站配置</legend>
      </fieldset>

      <form class="layui-form" action="<?php echo U('Conf/conf');?>"  method="post">
        <div class="layui-form-item">
          <label class="layui-form-label">网站域名:</label>
          <div class="layui-input-block">
            <input type="text" value="<?php echo ($are['WEB_SITE']); ?>" name="WEB_SITE" lay-verify="title" autocomplete="off"  class="layui-input">
          </div>
        </div>

          <div class="layui-form-item">
          <label class="layui-form-label">网站标题:</label>
          <div class="layui-input-block">
            <input type="text" value="<?php echo ($are['WEB_TITLE']); ?>" name="WEB_TITLE" lay-verify="title" autocomplete="off"  class="layui-input">
          </div>
        </div>

     <div class="layui-form-item">
          <label class="layui-form-label">分页条数:</label>
          <div class="layui-input-block">
            <input type="text" value="<?php echo ($are['PAGE_SIZE']); ?>" name="PAGE_SIZE" lay-verify="title" autocomplete="off"  class="layui-input">
          </div>
        </div>



          <div class="layui-form-item">
          <label class="layui-form-label">WB是否关闭</label>
          <div class="layui-input-block">
            <input type="radio" <?php if($are['WEB_OFF'] == 1): ?>checked<?php endif; ?> name="WEB_OFF" value="1" lay-verify="title" title="是" autocomplete="off" class="layui-input">
            <input type="radio" <?php if($are['WEB_OFF'] == 0): ?>checked<?php endif; ?>  name="WEB_OFF" title="否" value="0" lay-verify="title" autocomplete="off" class="layui-input">
          </div>
        </div>

          <div class="layui-form-item">
          <label class="layui-form-label">缓存开启</label>
          <div class="layui-input-block">
            <input type="radio" <?php if($are['WEB_CON'] == 1): ?>checked<?php endif; ?> name="WEB_CON" value="1" lay-verify="title" title="是" autocomplete="off" class="layui-input">
            <input type="radio" <?php if($are['WEB_CON'] == 0): ?>checked<?php endif; ?>  name="WEB_CON" title="否" value="0" lay-verify="title" autocomplete="off" class="layui-input">
          </div>
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
          //  layedit.sync(editIndex);
          // }
        });

        //监听提交
        // form.on('submit(demo1)', function(data) {
        //  layer.alert(JSON.stringify(data.field), {
        //    title: '最终的提交信息'
        //  })
        //  return false;
        // });
      });


    </script>
  </body>

</html>