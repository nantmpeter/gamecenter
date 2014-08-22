<?php if (!defined('THINK_PATH')) exit();?><link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/total.css" rel="stylesheet" type="text/css" />
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/pay.css" rel="stylesheet" type="text/css" />

<div class="main">
  <div class="b_nav" id="cz_nav">
            <h3>选择充值方式</h3>
            <ul class='pay_ways'>
            <?php $_result=D('pay_type')->order('sort asc')->where('status =1 and isdisplay = 1')->select(); if ($_result): $i=0;foreach($_result as $key=>$game):++$i;$mod = ($i % 2 );?><li pay_type="<?php echo ($game["id"]); ?>" id="<?php echo ($game["tag"]); ?>" node="<?php echo ($game["payname"]); ?>"  >
             <a data="<?php echo ($game["id"]); ?>" style="background:url(<?php echo ($game["icon"]); ?>) no-repeat; height:25px; font-size:14px;"><?php echo ($game["payname"]); ?></a>
             </li><?php endforeach; endif;?>
            <?php  ?>
       
                          </ul>
    <div class="bank_i"></div>
  </div><!--b_nav-->
  <div class="pay">
    <h3>您当前选择的是<strong class="pay_type_name_a">"<span class="p_name"></span>"</strong>的充值方式</h3>
    <div style="float:right; display:none;margin-right:10px" class="pay_help_btn_a"><a class="q pay_help_btn" href="javascript:;">充值遇到问题？</a></div>
     <div class="pay_m">
      <ul>
        <li class="toweb_a">
            <label> 选择充入的游戏：</label>
            <input type="text" class="text select_game_btn" id="select_game_a" readonly="readonly" value="<?php echo ($userinfo["pay_game"]); ?>">
                        <span style="padding-left:4px;">
            <input type="submit" name="button" class="select_game_btn" value="选择游戏">
            <span class="show_msg_a" msg_for="game"></span></span>
        </li>
        <li class="toweb_a">
            <label> 请选择服务器：</label>
            <input type="text" class="text select_server_btn" id="select_server_a" value="<?php echo ($userinfo["pay_server"]); ?>">
            <input type="submit" name="button2" value="选择服务器" class="select_server_btn">
            <span class="show_msg_a" msg_for="server"></span></span>            
        </li>
        <li>
            <label> 您需要充值的帐号： </label>
            <input id="game_account" name="game_account" type="text" class="text" value="<?php echo ($userinfo["pay_user"]); ?>">
            &nbsp;<span class="show_msg_a1" msg_for="game_account"></span>
        </li>
        <li class="game_account2_a">
          <label>确认您充值的帐号：</label>
          <input id="game_account2" type="text" class="text" name="game_account2" value="<?php echo ($userinfo["pay_user"]); ?>">
          &nbsp;<span class="show_msg_a2" msg_for="game_account"></span>
        </li>
                
                <!--充值卡帐号密码-->
        <li class="card_info" style="display: none;">
            <label>充值卡卡号：</label>
            <input id="card_no" type="text" name="card_no" class="text">
            &nbsp;<span class="show_msg_a" msg_for="card_no"></span>
        </li>
        <li class="card_info" style="display: none;">
            <label>充值卡密码：</label>
            <input id="card_pwd" type="text" name="card_pwd" class="text">
            &nbsp;<span class="show_msg_a" msg_for="card_pwd"></span>
        </li>

                <!--手工填写金额-->
        <li class="cz_conbb normal_money_a block_a" style="height: 100px; display: list-item;">
          <label>请选择金额：</label>
          <div class="money_a data">
            <label for="money_1"><input class="radio" id="money_1" type="radio" name="select_money" value="1">1元</label>
            <label for="money_10"><input class="radio" id="money_10" type="radio" name="select_money" value="10">10元</label>
            <label for="money_30"><input class="radio" id="money_30" type="radio" name="select_money" value="30">30元</label>
            <label for="money_50"><input class="radio" id="money_50" type="radio" name="select_money" value="50">50元</label>
            <label for="money_100"><input class="radio" id="money_100" type="radio" name="select_money" value="100" checked="checked">100元</label>
                        <br>
            <label for="money_500"><input class="radio" id="money_500" type="radio" name="select_money" value="500">500元</label>
            <label for="money_1000"><input  class="radio" id="money_1000" type="radio" name="select_money" value="1000">1000元</label>
            <label for="money_2000"><input class="radio" id="money_2000" type="radio" name="select_money" value="2000">2000元</label>
                        <br>
             <div class="other">
                <label style="padding-right:5px;" for="other_money_radio"><input type="radio" class="radio2" id="other_money_radio" name="select_money" value="">其他</label>
                <input type="text" id="other_money" class="text2" size="10" maxlength="10">请输入(<span class="limit_money_a">5-100000</span>)之间的整数<br>
                <span class="show_msg_a" msg_for="money"></span>
            </div>
            <div class="money_result get">您将获得 <strong class="gameb">0&nbsp;</strong></div>
                </div>
        </li>
                
                <!--手工填写金额-->
        <li class="cz_conbc card_money_a block_a" style="min-height: 140px; display: none;">
            <label>请选择充值卡面值：</label>
            <div class="data">
                <div class="money_list"><div class="item"><label for="card_money_5"><input id="card_money_5" type="radio" name="card_pay_money" value="5">￥5元面值的充值卡</label></div><div class="item"><label for="card_money_10"><input id="card_money_10" type="radio" name="card_pay_money" value="10">￥10元面值的充值卡</label></div><div class="item"><label for="card_money_15"><input id="card_money_15" type="radio" name="card_pay_money" value="15">￥15元面值的充值卡</label></div><div class="item"><label for="card_money_20"><input id="card_money_20" type="radio" name="card_pay_money" value="20">￥20元面值的充值卡</label></div><div class="item"><label for="card_money_25"><input id="card_money_25" type="radio" name="card_pay_money" value="25">￥25元面值的充值卡</label></div><div class="item"><label for="card_money_30"><input id="card_money_30" type="radio" name="card_pay_money" value="30">￥30元面值的充值卡</label></div><div class="item"><label for="card_money_35"><input id="card_money_35" type="radio" name="card_pay_money" value="35">￥35元面值的充值卡</label></div><div class="item"><label for="card_money_40"><input id="card_money_40" type="radio" name="card_pay_money" value="40">￥40元面值的充值卡</label></div><div class="item"><label for="card_money_45"><input id="card_money_45" type="radio" name="card_pay_money" value="45">￥45元面值的充值卡</label></div><div class="item"><label for="card_money_50"><input id="card_money_50" type="radio" name="card_pay_money" value="50">￥50元面值的充值卡</label></div></div>
            <br>
            <p class="get">您将获得 <strong class="gameb">0&nbsp;</strong></p>
                </div>
        </li>
                
                <!--充值类型-->
        <li class="cz_conbc bank_a block_a" style="display: list-item;"> 
                  <table border="0" cellspacing="0">
                    <tbody><tr>
                      <td align="right" width="122" valign="top">充值到：</td>
                      <td><label for="type_bank">
                          <input class="to_where" type="radio" name="pay_to" value="0" checked="checked">
                         直充到游戏 </label>
                        <label for="type_kq">
                          <input class="to_where" type="radio" name="pay_to" value="1">
                          充值为平台币</label></td>
                    </tr>
                  </tbody></table>
            <div class="bank_list_a" style="display: none;">
                    <h3>请选择银行</h3>
                    <div class="bank_item fl">
                      <label for="bank_icbc">
                        <input id="bank_icbc" class="bank_lists" type="radio" name="bank" value="ICBC-NET-B2C" checked="checked">
                        &nbsp;<img src="__TMPL__<?php echo ($config["THEME"]); ?>/images/banks/bank_icbc.jpg" width="141" height="33" alt="中国工商银行"></label>
                    </div>
                    <div class="bank_item fl">
                      <label for="bank_ccb">
                        <input id="bank_ccb" class="bank_lists"  type="radio" name="bank" value="CCB-NET-B2C">
                        &nbsp;<img src="__TMPL__<?php echo ($config["THEME"]); ?>/images/banks/bank_ccb.jpg" width="141" height="33" alt="中国建设银行"></label>
                    </div>
                    <div class="bank_item fl">
                      <label for="bank_abc">
                        <input id="bank_abc" class="bank_lists"  type="radio" name="bank" value="ABC-NET-B2C">
                        &nbsp;<img src="__TMPL__<?php echo ($config["THEME"]); ?>/images/banks/bank_abc.jpg" width="141" height="33" alt="中国农业银行"></label>
                    </div>
                    <div class="bank_item fl">
                      <label for="bank_cmb">
                        <input id="bank_cmb" class="bank_lists"  type="radio" name="bank" value="CMBCHINA-NET-B2C">
                        &nbsp;<img src="__TMPL__<?php echo ($config["THEME"]); ?>/images/banks/bank_cmb.jpg" width="141" height="33" alt="招商银行"></label>
                    </div>
                    <div class="bank_item fl">
                      <label for="bank_boc">
                        <input id="bank_boc" class="bank_lists"  type="radio" name="bank" value="BOC-NET-B2C">
                        &nbsp;<img src="__TMPL__<?php echo ($config["THEME"]); ?>/images/banks/bank_boc.jpg" width="141" height="33" alt="中国银行"></label>
                    </div>
                    <div class="bank_item fl">
                      <label for="bank_bcom">
                        <input id="bank_bcom" class="bank_lists"  type="radio" name="bank" value="BOCO-NET-B2C">
                        &nbsp;<img src="__TMPL__<?php echo ($config["THEME"]); ?>/images/banks/bank_bcom.jpg" width="141" height="33" alt="交通银行"></label>
                    </div>
                    <div class="bank_item fl">
                      <label for="bank_ceb">
                        <input id="bank_ceb" class="bank_lists"  type="radio" name="bank" value="CEB-NET-B2C">
                        &nbsp;<img src="__TMPL__<?php echo ($config["THEME"]); ?>/images/banks/bank_ceb.jpg" width="141" height="33" alt="中国光大银行"></label>
                    </div>
                    <div class="bank_item fl">
                      <label for="bank_gdb">
                        <input id="bank_gdb" class="bank_lists"  type="radio" name="bank" value="GDB-NET-B2C">
                        &nbsp;<img src="__TMPL__<?php echo ($config["THEME"]); ?>/images/banks/bank_gdb.jpg" width="141" height="33" alt="广东发展银行"></label>
                    </div>
                    <div class="bank_item fl">
                      <label for="bank_post">
                        <input id="bank_post" class="bank_lists"  type="radio" name="bank" value="POST-NET-B2C">
                        &nbsp;<img src="__TMPL__<?php echo ($config["THEME"]); ?>/images/banks/bank_post.jpg" width="141" height="33" alt="中国邮政储蓄银行"></label>
                </div>

      
                    <br style="clear:both">
            
                </div>
        </li><!--充值类型-->
        <li><input name="" type="button" value="" class="text3 sub_btn"></li>
      </ul>
                </div>
    <!--添加支付页面充值回馈礼包功能-->
    <div class="pay_game_libao"></div>
    <!--温馨提示-->
    <div class="cz_intro ts">
        <strong>温馨提示：</strong>
                   <div class="alert alert-info">
1、QQ登陆玩家的帐号非QQ号码，切勿将QQ号码当做游戏帐号！<br/>
2、QQ登陆的玩家，可以处于登陆状态返回官网，可看到所属的帐号。<br/>
3、如需QQ帐号登录游戏 请点击官网左边QQ登录按钮。<br/>
4、针对银行卡帐号用户。<br/>
5、支持全国29家银行卡(需要开通网上银行)及快钱帐号。<br/>
		          </div>
     </div><!--温馨提示-->
    <!--维护-->
            <div id="pay_html_a" style=" display:none"></div>
            <div id="pay_fix_a" style=" display:none">
              <div class="ant">
                <div class="payimg"><img width="122" height="70" src=""></div>
                <h1><span class="fix_game_a"></span>维护，暂时无法支付<span class="fix_tips_a"></span></h1>
                <p>维护时间：<span class="fix_date_a"></span></p>
              </div>
    </div><!--维护-->
            </div>

  <div class="service">
    <h3>客服中心</h3>
    <p>平台企业QQ：800030820 <br />
      游戏客服：<a href="http://demo.31wan.cn/kefu/online.html" target="_blank">在线客服</a> <br />
      充值客服：<a href="http://demo.31wan.cn/kefu/online/pay.html" target="_blank">在线客服</a></p>
    <div class="bg"></div>
      </div>
  <div class="faq">
    <h3>常见问题</h3>
    <ul>
           <?php $_result=D('article')->where('typeid=10')->limit(6)->select(); if ($_result): $i=0;foreach($_result as $key=>$game):++$i;$mod = ($i % 2 );?><li><a href="<?php echo U('Article/read');?>/aid/<?php echo ($game["aid"]); ?>" target="_blank"><?php echo ($game["title"]); ?></a></li><?php endforeach; endif;?>   
     </ul>
    </div>
  </div>
</div>

<!--游戏选择弹出窗口开始-->
<div id="cz_select_game"  class="benShowSelectGame">
  <div class="msg">
    <h5>请选择游戏</h5>
    <div class="search">
      <input type="text" class="text" id="game_keyword"/>
      <input type="submit" name="button2" id="game_search_btn" value="搜 索"  class="text1"/>
    </div><!--search-->
    <div class="ban">
    <ul class="win_game_nav">
     <!-- <li id="no1" class="no_1 on"><a href="javascript:;" class="t1"></a></li>-->
      <li id="no2" class="no_2"><a href="javascript:;" class="t2">全部游戏</a></li>
    </ul>
    <div class="clear"></div>
    </div><!--ban-->
    <!--<div id="nlist1" class="pay_last_game_list">
        <ul class="lastplay_game_data">
        <li></li>
        </ul>
    <div class="clear"></div>
    </div><!--nlist1-->
    <div class="payg_list" id="nlist2" style="display:none;">
        <ul class="all_game_data">
                 <?php if(is_array($games)): $i = 0; $__LIST__ = $games;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$game): $mod = ($i % 2 );++$i;?><li data="<?php echo ($game["gid"]); ?>" game="<?php echo ($game["gamename"]); ?>"><a href="javascript:void(0);" game="<?php echo ($game["gid"]); ?>"><?php echo ($game["gamename"]); ?><span class="ico_txj" style="background:url(<?php echo ($game["smallpic"]); ?>)"></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    <div class="clear"></div>
        <div class="pages pay_page"></div>
    </div><!--nlist2-->
    <div class="close_select_game_win_btn close"></div>
  </div><!--msg-->
  </div><!--cz_select_game-->
<!--游戏选择弹出窗口结束--> 

<!--选择服务器弹出框开始-->
<div id="cz_select_server" style="left: 401px; top: 287px; display:none">
   <div class="msg">
    <h5>请选择服务器</h5>
    <div class="ban">
        <ul><li class="on">最近玩过</li></ul>
        <ul class="last_play_server"></ul>
    </div><!--ban-->
  <!--全部服务器-->
  <div class="cz_sega_boxa">
    <ul class="all_servers f_list"></ul>
    <div class="clear"></div>
  </div><!--cz_sega_boxa-->
    <div class="close close_select_server_win_btn"></div><!--close-->
</div>
</div><!--cz_select_server-->
<!--选择服务器弹出框结束--> 

<!--充值确认弹出框-->
<div id="cz_ok" style="display:none">
  <form id="gotopay_form" action="<?php echo U('pay/begin_pay');?>" target="_blank" method="post">
      <!--全部服务器-->
    <table border="0" cellspacing="1" bgcolor="#e2e2e2" style=" margin-left:14px; margin-top:14px; line-height:28px;" >
      <tr >
        <td width="135" align="right" bgcolor="#FFFFFF" style="padding-right:10px;">您充值的方式：</td>
        <td width="262" align="left" bgcolor="#FFFFFF" style="padding-left:10px;" class="show_result_paytype"></td>
      </tr>
      <tr >
        <td width="135" align="right" bgcolor="#FFFFFF" style="padding-right:10px;">您充值的游戏：</td>
        <td width="262" align="left" bgcolor="#FFFFFF" style="padding-left:10px;" class="show_result_game"></td>
      </tr>
      <tr >
        <td width="135" align="right" bgcolor="#FFFFFF" style="padding-right:10px;">您充值的区服：</td>
        <td width="262" align="left" bgcolor="#FFFFFF" style="color:#ff3300; padding-left:10px;" class="show_result_server"></td>
      </tr>
      <tr >
        <td width="135" align="right" bgcolor="#FFFFFF" style="padding-right:10px;">您的订单编号：</td>
        <td width="262" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"  class="show_result_order"></td>
      </tr>
      <tr >
        <td width="135" align="right" bgcolor="#FFFFFF" style="padding-right:10px;">您的充值帐号：</td>
        <td width="262" align="left" bgcolor="#FFFFFF" style="color:#ff3300; padding-left:10px;"  class="show_result_username"></td>
      </tr>
      <tr >
        <td width="135" align="right" bgcolor="#FFFFFF">您充值的金额：</td>
        <td width="150" align="left" bgcolor="#FFFFFF" style="color:#ff3300; padding-left:10px;"  class="show_result_money"></td>
      </tr>
      <tr >
        <td width="135" align="right" bgcolor="#FFFFFF">充值所得：</td>
        <td width="150" align="left" bgcolor="#FFFFFF" style="color:#ff3300; padding-left:10px;"  class="show_result_glod"></td>
      </tr>
    </table>
    <ul>
      <li>
       <!-- 写在这里哦 -->
        <input type="hidden" name="game_id" id="game_id"  value="<?php echo ($userinfo["pay_game_id"]); ?>"/>
        <input type="hidden" name="server_id"  id="server_id" value="<?php echo ($userinfo["pay_server_id"]); ?>"/>
        <input type="hidden" name="order_id" id="order_id" />
        <input type="hidden" name="user_id" id="user_id" />
        <input type="hidden" name="user_id2" id="user_id2" />
        <input type="hidden" name="pay_money" id="pay_money" />             
        <input type="hidden" name="pay_where" id="pay_where" />
        <input type="hidden" name="pay_bank" id="pay_bank" />
        <input type="hidden" name="pay_card_no" id="pay_card_no" />
        <input type="hidden" name="pay_card_pwd" id="pay_card_pwd" />  
        <input type="hidden" name="pay_tag" id="pay_tag" value="yeepay"/>                       
      </li>
    </ul>
  </form>
</div>

<!--充值确认框-->
 <div id="Pop" style="display: none;">
  <p class="topFinish">请您在新打开的支付页面上完成付款充值！</p>
  <p class="Tips"><strong>付款完成前请不要关闭或刷新此窗口。</strong><br>
    完成付款后请根据您的情况点击下面的按钮。</p>

</div>

<!--头部轮换-->
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/jquery-1.4.2.js" type="text/javascript"></script>
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/dialog/jquery.artDialog.js?skin=default" type="text/javascript"></script>
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/dialog/plugins/iframeTools.js" type="text/javascript"></script>
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/jquery.livequery.js" type="text/javascript"></script>
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/pay_server.js" type="text/javascript"></script>