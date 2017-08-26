/*

@Name：不落阁后台模板源码 
@Author：Absolutely 
@Site：http://www.lyblogs.cn

*/

layui.define(['laypage', 'layer', 'form', 'pagesize'], function (exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        laypage = layui.laypage;
    var laypageId = 'pageNav';

    initilData(1,5);
    //页数据初始化
    //currentIndex：当前也下标
    //pageSize：页容量（每页显示的条数）
    function initilData(currentIndex, pageSize) {
        var index = layer.load(1);
        //模拟数据
        var data = new Array();
        $.ajax({
              url:'http://blog.com/admin.php/Log/log_show.html',
              type:"get",
              data:"page="+currentIndex+"&size="+pageSize,
              dataType:'json',
              success:function(msg){
                data = msg['are'];
                pages = msg['number'];
              }
        })
        // $.get("http://localhost/dome/index.php/Login/adm_show.html",function(msg){
                
        //         //data = msg;
        // },'json');
        // for (var i = 0; i < 30; i++) {
        //     data.push({ id: i + 1, time: '2017-3-26 15:56', title: '不落阁后台模板源码分享', author: 'Absolutely', category: 'Web前端' });
        // }
        //模拟数据加载
        setTimeout(function () {
            layer.close(index);
            //计算总页数（一般由后台返回）
            // pages = Math.ceil(data.length / pageSize);
            // //模拟数据分页（实际上获取的数据已经经过分页）
            // var skip = pageSize * (currentIndex - 1);
            // var take = skip + Number(pageSize);
            // data = data.slice(skip, take);
            var html = '';  //由于静态页面，所以只能作字符串拼接，实际使用一般是ajax请求服务器数据
            html += '<table style="" class="layui-table" lay-even>';
            html += '<colgroup><col width="180"><col><col width="150"><col width="180"><col width="90"><col width="90"><col width="50"><col width="50"></colgroup>';
            html += '<thead><tr><th>用户</th><th>时间</th><th>内容</th></tr></thead>';
            html += '<tbody>';
            //遍历文章集合
            for (var i = 0; i < data.length; i++) {
                var item = data[i];
                html += "<tr>";
                html += "<td>" + item.adm_admin + "</td>";
                html += "<td>" + formatDate(item.adm_time) + "</td>";
                html += "<td>" + item.adm_operate + "</td>";
                html += "</tr>";
            }
            html += '</tbody>';
            html += '</table>';
            html += '<div id="' + laypageId + '"></div>';

            $('#dataContent').html(html);

            form.render('checkbox');  //重新渲染CheckBox，编辑和添加的时候
            $('#dataConsole,#dataList').attr('style', 'display:block'); //显示FiledBox

            laypage({
                cont: laypageId,
                pages: pages,
                groups: 3,
                skip: '#c00',
                curr: currentIndex,
                jump: function (obj, first) {
                    var currentIndex = obj.curr;
                    if (!first) {
                        initilData(currentIndex, pageSize);
                    }
                }
            });
            //该模块是我定义的拓展laypage，增加设置页容量功能
            //laypageId:laypage对象的id同laypage({})里面的cont属性
            //pagesize当前页容量，用于显示当前页容量
            //callback用于设置pagesize确定按钮点击时的回掉函数，返回新的页容量
            layui.pagesize(laypageId, pageSize).callback(function (newPageSize) {
                //这里不能传当前页，因为改变页容量后，当前页很可能没有数据
                initilData(1, newPageSize);
            });
        }, 500);
    }

    //监听置顶CheckBox
    form.on('checkbox(top)', function (data) {
        var index = layer.load(1);
        setTimeout(function () {
            layer.close(index);
            if (data.elem.checked) {
                data.elem.checked = false;
            }
            else {
                data.elem.checked = true;
            }
            layer.msg('操作失败，返回原来状态');
            form.render();  //重新渲染
        }, 300);
    });

    //监听推荐CheckBox
    form.on('checkbox(recommend)', function (data) {
        var index = layer.load(1);
        setTimeout(function () {
            layer.close(index);
            layer.msg('操作成功');
        }, 300);
    });
    //添加数据
    $('#addArticle').click(function () {
        var index = layer.load(1);
        setTimeout(function () {
            layer.close(index);
            layer.msg('打开添加窗口');
        }, 500);
    });

    //输出接口，主要是两个函数，一个删除一个编辑
    var datalist = {
        deleteData: function (id) {
            layer.confirm('确定删除？', {
                btn: ['确定', '取消'] //按钮 
            }, function () {

                layer.msg('删除Id为【' + id + '】的数据');
                //layer.msg.parents("tr").remove();

            }, function () {

            });
        },
        editData: function (id) {
            layer.msg('编辑Id为【' + id + '】的数据');
        }
    };
 function formatDate(time){
        if(typeof(time)=='string'){
            var _time = parseInt(time+'000');
        }
        var  now = new Date(_time);
        var Y = now.getFullYear(); 
        var m = now.getMonth()+1; 
        var d = now.getDate(); 
        var H = now.getHours(); 
        var i = now.getMinutes(); 
        var s = now.getSeconds(); 
        return Y+"-"+m+"-"+d+" "+H+":"+i+":"+s; 
    }

    exports('log_show', datalist);
});