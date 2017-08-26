  $(document).on('click','.del',function(){
                    var id = $(this).attr('idd');
                    var _this = $(this);
                    $.ajax({
                       url:"{:U('Article/article_label')}",
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
