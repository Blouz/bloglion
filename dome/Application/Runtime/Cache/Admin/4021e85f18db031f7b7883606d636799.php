<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>数据列表页面</title>
    <!-- layui.css -->
    <link href="/Public/bluo/plugin/layui/css/layui.css" rel="stylesheet" />
    <style>
        .layui-btn-small {
            padding: 0 15px;
        }

        .layui-form-checkbox {
            margin: 0;
        }

        tr td:not(:nth-child(0)),
        tr th:not(:nth-child(0)) {
            text-align: center;
        }

        #dataConsole {
            text-align: center;
        }
        /*分页页容量样式*/
        /*可选*/
        .layui-laypage {
            display: block;
        }

        /*可选*/
        .layui-laypage > * {
            float: left;
        }
        /*可选*/
        .layui-laypage .laypage-extend-pagesize {
            float: right;
        }
        /*可选*/
        .layui-laypage:after {
            content: ".";
            display: block;
            height: 0;
            clear: both;
            visibility: hidden;
        }

        /*必须*/
        .layui-laypage .laypage-extend-pagesize {
            height: 30px;
            line-height: 30px;
            margin: 0px;
            border: none;
            font-weight: 400;
        }
        /*分页页容量样式END*/
    </style>
</head>
<body>
<fieldset id="dataConsole" class="layui-elem-field layui-field-title"  style="display:none;">
    <legend>控制台</legend>
    <div class="layui-field-box">
        <div id="articleIndexTop">
            <form class="layui-form layui-form-pane" action="<?php echo ('ULogin/adm_show');?>">
                <div class="layui-form-item" style="margin:0;margin-top:15px;">
                    <div class="layui-inline">
                        
                        <label class="layui-form-label">关键词</label>
                        <div class="layui-input-inline">
                            <input type="text" id="key" name="keywords" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-input-inline" style="width:auto">
                            <span class="layui-btn key" lay-submit lay-filter="formSearch">搜索</span>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <div class="layui-input-inline" style="width:auto">
                            <a  href="<?php echo U('Login/register');?>" id="addArticle" class="layui-btn layui-btn-normal">添加管理员</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</fieldset>
<fieldset id="dataList" class="layui-elem-field layui-field-title sys-list-field" style="display:none;">
    <legend style="text-align:center;">管理员列表</legend>
    <div class="layui-field-box">
        <div id="dataContent" class="">
            <!--内容区域 ajax获取-->
            <table style="" class="layui-table" lay-even="">
                <colgroup>
                    <col width="180">
                    <col>
                    <col width="150">
                    <col width="180">
                    <col width="90">
                    <col width="90">
                    <col width="50">
                    <col width="50">
                </colgroup>
                <thead>
                <tr>
                    <th>账号</th>
                    <th>创建时间</th>
                    <th>最后登录时间</th>
                    <th>ip</th>
                    <th colspan="2">选项</th>
                    <th colspan="2">操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>home</td>
                    <td>2017年8月14日19:32:21</td>
                    <td>2017年8月14日19:32:21</td>
                    <td>127.0.0</td>
                    <td>
                        <form class="layui-form" action="">
                            <div class="layui-form-item" style="margin:0;">
                                <input type="checkbox" name="top" title="置顶" lay-filter="top" checked>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form class="layui-form" action="">
                            <div class="layui-form-item" style="margin:0;">
                                <input type="checkbox" name="top" title="推荐" lay-filter="recommend" checked>
                            </div>
                        </form>
                    </td>
                    <td>
                        <button class="layui-btn layui-btn-small layui-btn-normal"><i class="layui-icon">&#xe642;</i></button>
                    </td>
                    <td>
                        <button class="layui-btn layui-btn-small layui-btn-danger"><i class="layui-icon">&#xe640;</i></button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div id="pageNav"></div>
        </div>
    </div>
</fieldset>
<!-- layui.js -->
<script src="/Public/bluo/plugin/layui/layui.js"></script>
<!-- layui规范化用法 -->
<script type="text/javascript">
    layui.config({
        base: '/Public/bluo/js/'
    }).use('datalist');
</script>
</body>
</html>
<script type="text/javascript" src="/Public/auto/jq.js"></script>
<script type="text/javascript">

            $(document).on('click','.key',function(){
                  var key = $('#key').val();
                  
            })
          

            $(document).on('click','.del',function(){
               var id =  $(this).attr('idd');
                    var _this = $(this);
                    $.ajax({
                       url:"<?php echo U('Login/adm_del');?>",
                       type:'get',
                       data:"id="+id,
                       dataType:'json',
                       success:function(msg){
                             if(msg == 1)
                             {
                                 _this.parents("tr").remove();
                             }else{
                                alert('没有权限');
                             }
                        }

                    })
                     
                }) 
              $(document).on('click','.upda',function(){
                   $(this).hide();
                   $(this).next().prop('type',"text");
              })
              $(document).on('blur','.hide',function(){
                    var id = $(this).attr("idd");
                    var val = $(this).val();
                    var _this = $(this);
                    $.ajax({
                        url:"<?php echo U('Login/update');?>",
                        data:"id="+id+"&val="+val,
                        type:"get",
                        dataType:'json',
                        success:function(msg){
                            if(msg == 1)
                            {
                                _this.prop('type',"hidden");
                                _this.prev().show();
                                _this.prev().html(val);
                            }
                        }
                    })
              })
     
</script>