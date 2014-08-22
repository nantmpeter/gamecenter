<?php if (!defined('THINK_PATH')) exit();?>            <h3 class="f14"><span class="switchs cu on" title="广告管理"></span>广告管理</h3>
            <ul>
               <?php if(is_array($data1)): $i = 0; $__LIST__ = $data1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?><li id="_MP<?php echo ($v2["id"]); ?>" class="sub_menu">
                                   <a href="javascript:_MP('<?php echo ($v2["id"]); ?>','./index.php?m=ad&a=<?php echo ($v2["module_alias"]); ?>');" hidefocus="true" style="outline:none;"><?php echo ($v2["category"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li id="_MP<?php echo ($vo["access_id"]); ?>" class="sub_menu">
                	<a href="javascript:_MP('<?php echo ($vo["access_id"]); ?>','./index.php?m=<?php echo ($vo["parent_module"]); ?>&a=<?php echo ($vo["access_name"]); ?>');" hidefocus="true" style="outline:none;"><?php echo ($vo["module"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
             </ul>
			<script type="text/javascript">
            $(".switchs").each(function(i){
                var ul = $(this).parent().next();
                $(this).click(
                function(){
                    if(ul.is(':visible')){
                        ul.hide();
                        $(this).removeClass('on');
                            }else{
                        ul.show();
                        $(this).addClass('on');
                    }
                })
            });
            </script>