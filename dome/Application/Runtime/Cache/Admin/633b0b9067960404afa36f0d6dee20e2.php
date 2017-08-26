<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台模板</title>
    <link rel="stylesheet" href="/Public/Admin/css2/amazeui.css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Public/Admin/css2/core.css" />
    <link rel="stylesheet" href="/Public/Admin/css2/menu.css" />
    <link rel="stylesheet" href="/Public/Admin/css2/index.css" />
    <link rel="stylesheet" href="/Public/Admin/css2/admin.css" />
    <!-- <link rel="stylesheet" href="/Public/Admin/css2/typography.css" /> -->
    <link rel="stylesheet" href="/Public/Admin/css2/page/form.css" />
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
                        </div>
                    </div>
                </div>
                <div class="am-g">
                    <div class="am-u-sm-12">
                        <form class="am-form">
                            <table class="am-table am-table-striped am-table-hover table-main">
                                <thead>
                                <tr>
                                    <th class="table-check"><input type="checkbox" /></th>
                                    <th class="table-title">分类名称</th>
                                    <th class="table-set">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($are)): $i = 0; $__LIST__ = $are;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($v["sort_id"]); ?>">
                                    <td><input type="checkbox" value="<?php echo ($v["sort_name"]); ?>" /></td>
                <td><span class="update"><?php echo ($v["sort_name"]); ?></span><input type="hidden" class="dian" idd="<?php echo ($v["sort_id"]); ?>"></td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                                                <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                                               
                                            </div>
                                        </div>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                                </tbody>
                            </table>
                                <?php echo ($page); ?>
                     </form>
                    </div>
                </div>
            </div>
        </div>
</div>
<script type="text/javascript" src="/Public/auto/jq.js"></script>
<script type="text/javascript">

                $(document).on('click','.update',function(){
                        $(this).hide();
                        $(this).next().prop('type',"text");
                })
                 $(document).on('blur','.dian',function(){
                    var id = $(this).attr("idd");
                    var val = $(this).val();
                    var _this = $(this);
                    $.ajax({
                        url:"<?php echo U('Article/sort_Update');?>",
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

                $(document).on('click','.del',function(){
                    var id = $(this).attr('idd');
                    var _this = $(this);
                    $.ajax({
                       url:"<?php echo U('Article/sort_Showdel');?>",
                       type:'get',
                       data:"id="+id,
                       dataType:'json',
                       success:function(msg){
                             if(msg == 1)
                             {
                              _this.parents("tr").remove();
                             }
                        }

                    })
                     
                })

         
</script>