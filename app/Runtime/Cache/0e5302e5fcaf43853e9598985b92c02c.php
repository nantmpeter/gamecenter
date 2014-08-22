<?php if (!defined('THINK_PATH')) exit();?>
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/games.css" rel="stylesheet" type="text/css" />
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/user.css" rel="stylesheet" type="text/css" />
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/kefu.css" rel="stylesheet" type="text/css" />
<!--header-->
 
<div class="main">
  <div class="banner_t"><img src="__TMPL__<?php echo ($config["THEME"]); ?>/images/stage/upload/banner2.jpg" width="918" height="123" /></div>
  <ul class="user_b">
    <li class="ques on"><a onclick="javascript:;" class="b1">常见问题</a></li>
    <li class=""><a href="/service" onclick="javascript:;" class="b2" target="_blank">在线客服</a></li>
    <!--li class=""><a href="kefu/?_c=pwd" class="b3">密码申诉</a></li-->
    <li class="parent "><a onclick="javascript:;" class="b4">家长监护</a></li>
    <li class="process "><a class="b5" onclick="javascript:;">服务申请</a></li>
</ul>

<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/jquery-1.4.2.js"></script>
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/stage/plat_action.js"></script>
<script type="text/javascript">
$(".ques").click(function(){
    $('.user_b li').removeClass("on");
    $(".user_b li.ques").addClass("on");
    $(".parentbody").hide();
    $(".processbody").hide();
    $(".quesbody").show();
});
$(".parent").click(function(){
    $('.user_b li').removeClass("on");
    $(".user_b li.parent").addClass("on");
    $(".quesbody").hide();
    $(".processbody").hide();
    $(".parentbody").show();
});
$(".process").click(function(){
    $('.user_b li').removeClass("on");
    $(".user_b li.process").addClass("on");
    $(".quesbody").hide();
    $(".parentbody").hide();
    $(".processbody").show();
});
</script>
  <div class="quesbody" style="display:block">
  <div class="user_m step1">
    <dl>
      <dt>如何创建我的个人帐号？</dt>
      <dd>在31wan平台首页的用户登录窗口，点击绿色的免费<a href="/accounts/register">注册</a>按钮，进入注册页面填写完善个人帐号信息之后，您将免费获得您的31wan帐号，开始体验精彩游戏。</dd>
    </dl>
    <dl>
      <dt>如何修改个人资料？</dt>
      <dd>登录31wan平台成功后进入"<a href="/accounts/register">用户中心</a>"，可以看到个人资料，点击各项资料后面的修改即可对基本信息进行修改。注意：帐号和邮箱在注册后不可再修改，游戏中的昵称可以在第一次进入游戏时输入，之后也是不可更改的，并且是唯一的！。</dd>
    </dl>
    <dl>
      <dt>帐号被盗怎么办？</dt>
      <dd>在31wan平台首页的用户登录窗口，通过"找回密码"功能可以找回您的密码，同时建议您重新修改密码并加大密码强度。</dd>
    </dl>
    <dl>
      <dt>如何保证帐号及个人资料游戏数据安全？</dt>
      <dd>31wan平台为帐号安全提供三重保护：1）邮箱认证 2）设置安全问题 3）身份证认证。注册通行证时，请务必设定较高级别的密码强度并填写个人常用邮箱。注册完通行证后，强烈建议您在"用户中心"完善安全个人信息和身份证信息，并设置密保问题。</dd>
    </dl>
    <dl>
      <dt>为何已实名认证，登录时仍有防沉迷提示？</dt>
      <dd>如您已年满18周岁，但仍然受到了防沉迷系统的限制，可能您当时填写身份证资料不正确导致，请您登录进入用户中心的防沉迷设置中修改您的个人身份资料，确保信息记录正确，即可解除您的防沉迷系统的限制。</dd>
    </dl>
  </div>
</div><!--问题question-->

<!--家长parent-->
<div class="parentbody" style="display:none">
    <div class="user_m step4">
        <div class="about">
            <h3>
                工程体系
            </h3>
                &quot;网络游戏未成年人家长监护工程&quot;是一项由国内网络游戏企业共同发起并参与实施，由中华人民共和国文化部指导，旨在加强家长对未成年人参与网络游戏的监护，引导未成年人健康、绿色参与网络游戏，和谐家庭关系的社会性公益行动。它提供了一种切实可行的方法，一种家长实施监控的管道，使家长纠正部分未成年子女沉迷游戏的行为成为可能。
            <br />
            <a href="javascript:;" class="more" onclick="document.getElementById('benParentMore').style.display='block';this.style.display='none'">
                点击查看全部
            </a>
            <!--显示更多-->
            <div class="parent_more" id="benParentMore" style="display:none;">
                    该项社会公益行动充分反映了中国网络游戏行业高度的社会责任感，对未成年玩家合法权益的关注及对用实际行动营造和谐社会的愿望。
                <br />
                    "家长监护机制"是31wan在这一公益行动中，针对目前未成年人缺乏自控及自律能力，容易陷入沉迷；少数监护人缺少时间照顾未成年人，不能及时监督未成年人游戏时间的现状，而推出的一种可由家长实施监控，纠正部分未成年子女沉迷游戏的保护机制。
                <br />
                <br />
                <strong>
                    《未成年人健康参与网络游戏提示》
                </strong>
                <br />
                    随着网络在青少年中的普及，未成年人接触网络游戏已经成为普遍现象。为保护未成年人健康参与游戏，在政府进一步加强行业管理的前提下，家长也应当加强监护引导。为此，我们为未成年人参与网络游戏提供以下意见：
                <br />
                    一、主动控制游戏时间。游戏只是学习、生活的调剂，要积极参与线下的各类活动，并让父母了解自己在网络游戏中的行为和体验。
                <br />
                    二、不参与可能耗费较多时间的游戏设置。不玩大型角色扮演类游戏，不玩有PK类设置的游戏。在校学生每周玩游戏不超过2小时，每月在游戏中的花费不超过10元。
                <br />
                    三、不要将游戏当作精神寄托。尤其在现实生活中遇到压力和挫折时，应多与家人朋友交流倾诉，不要只依靠游戏来缓解压力。
                <br />
                    四、养成积极健康的游戏心态。克服攀比、炫耀、仇恨和报复等心理，避免形成欺凌弱小、抢劫他人等不良网络行为习惯。
                <br />
                    五、注意保护个人信息。包括个人家庭、朋友身份信息，家庭、学校、单位地址，电话号码等，防范网络陷阱和网络犯罪。
                <br />
                <strong>
                    家长监护服务说明：                </strong>
                <br />
                    家长监护系统充分考虑家长的实际需求，当家长发现自己的孩子玩游戏过于沉迷的时候，由家长提供合法的监护人资质证明、游戏名称帐号、以及家长对于限制强度的愿望等信息，可对处于孩子游戏沉迷状态的帐号采取几种限制措施，解决未成年人沉迷游戏的不良现象，如限制未成年人每天玩游戏的时间区间和长度，也可以限制只有节假日才可以游戏，或者完全禁止。                <br />
                <strong>
                    家长监护服务进度查询：                </strong>
                <br />
                    如果您已经申请家长监护服务，在服务期间，当您对需要提交的信息、处理结果有疑问，或者其他任何问题，您均可以在工作时间联系我们，我们将由专门负责的受理专员为您提供咨询解答服务，或者配合、指导您解决问题。                <br />
                <br />
            </div>
        </div>
        <div class="down">
            <h3>
                工程体系
            </h3>
            <a class="d_btn" href="kefu/static/zip/jz.zip">
                申请表单下载
            </a>
            <strong>
           
                    表单内容：           
                </a> 
            </strong>
            <p> <a  href="kefu/static/zip/Guardian.zip">
                附件表一：监护人信息表 
                </a>           
            </p>
            <p> <a  href="kefu/static/zip/ward.zip">
                附件表二：被监护人信息表
                </a>
            </p>
            <p> <a  href="kefu/static/zip/application.zip">
                附件表三：家长监护申请书
                </a>
            </p>
        </div>
        <div class="fw">
            <h3>
                咨询方式
            </h3>
            <p class="i1">
                <strong>
                    咨询热线：                </strong>
                400-9966-163
            </p>
            <p class="i2">
                <strong>
                    传真电话：                </strong>
                020-85559051
            </p>
            <p class="i3">
                <strong>
                    受理时间：                </strong>
                <br />
                周一至周五9:30-20:00
            </p>
        </div>
        <div class="faq">
            <h3>
                家长监护系统FAQ
            </h3>
            <p class="ask">
                如何创建我的个人帐号？            </p>
            <p class="q">
                在QQ163平台首页的用户登录窗口，点击绿色的免费注册按钮，进入注册页面填写完善个人帐号信息之后，您将免费获得您的QQ163帐号，开始体验精彩游戏。
            </p>
            <p class="ask">
                如何创建我的个人帐号？            </p>
            <p class="q">
                在QQ163平台首页的用户登录窗口，点击绿色的免费注册按钮，进入注册页面填写完善个人帐号信息之后，您将免费获得您的QQ163帐号，开始体验精彩游戏。
            </p>
        </div>
    </div>
</div><!--家长parent-->

<!--服务申请parent-->
<div class="processbody" style="display:none">
    <div class="user_m step5">
        <div class="about">
            <h3>
                服务申请
            </h3>
            <img src="__TMPL__<?php echo ($config["THEME"]); ?>/images/stage/2c_03.gif" border="0" />
            <strong>
                流程介绍详细说明：            </strong>
            <br>
            <strong>
                护人提出申请
            </strong>
            <br>
                在监护人发现被监护人有沉溺QQ163网页游戏的情况下，监护人可向游国公司申请发起未成年人家长监护机制。            <br>
                监护人需亲自通过邮寄方式 向我司提供有效材料，向游国公司提出未成年人账户监控的申请。在收到邮件后，我司即开始启动监护机制审核流程，首先进入疑似帐号身份确认期。
            <br>
            疑似帐号身份确认期（15 个自然日）            <br>
                在判断申请材料完整的情况下，我司将通过官方邮箱联系疑似帐号归属者，告知其在 15 个自然日内将按照监护人需求对其帐号进行相关操作，并要求疑似帐号归属者提供身份材料以便我司判定其与监护人监护关系；
            若疑似帐号归属者在 15 个自然日内不能提供有效身份证明或逾期提供，则默认为疑似帐号归属者与被监护人身份相符。我司即按照监护人申请要求，对其游戏帐号纳入防沉迷系统；            <br>
                若疑似帐号归属者在 15 个自然日内提供的身份证明与被监护人相符，我司即按照监护人申请要求，对其游戏帐号纳入防沉迷系统；            <br>
                若疑似帐号归属者在 15 个自然日内提供的身份证明与被监护人不符，我司则无法判定其与被监护人的身份关系。在此情况下，为保障用户游戏帐号安全，我司将通知监护人通过公安机关出具帐号找回协查证明，由我司协助被监护人找回游戏帐号后再进行后续操作；
            <br>
            监护服务申请书：
            <br>
            网页游戏未成年人用户家长监控服务申请书（点击下载）            <br>
            1、监护人信息表（包含监护人的身份证明复印件）；            <br>
            2、被监护人信息表（包含被监护人所玩游戏相关信息及身份证明复印件）；            <br>
            3、填写网络游戏未成年人家长监护申请书、保证书、授权书并手工签字（需下载，填写并打印，签字）；
            <br>
            4、申请人与被监护人的监护关系证明文件（户口簿或有关机关出具的证明文件）。
            <br>
        </div>
    </div>
</div><!--服务申请parent-->

</div><!--main-->