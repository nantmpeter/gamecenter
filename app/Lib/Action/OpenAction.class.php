<?php
   /**
    *@name 社会化登陆接口 
    *
    *@todo soicallogin
    *
    *@author lostman $
    */
   class OpenAction extends CommonAction
   {
   	  
   	  public $config;
   	  public function __construct(){
   	  	$public = A('Public');
   	  	$public->read_conf();
   	  	$config = F('basic');
   	  	$this->config = $config;
   	  }
   	  public function index(){
        $dir = $_SERVER['DOCUMENT_ROOT'];
   	  	require_once($dir."/app/Lib/Api/qqConnectAPI.php");
   	  	$qc = new QC();
   	  	$qc->qq_login();
   	  }
   	  
   	  public function alipay(){
   	  	$dir = $_SERVER['DOCUMENT_ROOT'];
	    require_once($dir."/app/Lib/Api/alipay/alipay.config.php");
        require_once($dir."/app/Lib/Api/alipay/lib/alipay_submit.class.php");

/**************************请求参数**************************/

        //目标服务地址
        $target_service = "user.auth.quick.login";
        //必填
        //必填，页面跳转同步通知页面路径
        $return_url = 'http://' . $_SERVER ['HTTP_HOST']."/open/return_url";
        //需http://格式的完整路径，不允许加?id=123这类自定义参数

        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数

        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1


/************************************************************/

//构造要请求的参数数组，无需改动
$parameter = array(
		"service" => "alipay.auth.authorize",
		"partner" => trim($alipay_config['partner']),
		"target_service"	=> $target_service,
		"return_url"	=> $return_url,
		"anti_phishing_key"	=> $anti_phishing_key,
		"exter_invoke_ip"	=> $exter_invoke_ip,
		"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
);

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
echo $html_text;
}
   	  /**
   	   * @name 获取登陆的token
   	   */
   	  public function callback(){
   	  
   	  	header("Content-type:text/html;charset=utf-8");
   	  	$dir = $_SERVER['DOCUMENT_ROOT'];
   	  	require_once($dir."/app/Lib/Api/qqConnectAPI.php");
   	  	$qc = new QC();
   	  	$accessToken = $qc->qq_callback();
   	  	$openid = $qc->get_openid();
   	  	$qc = new QC($accessToken, $openid);
   	  	$user_info= $qc->get_user_info();
   	  	$info= $qc->get_info();

    	  	if(!empty($user_info)){
   	  			$map['openid'] = $info['data']['openid'];
   	  			$model = M('member');
   	  			$login = $model->where($map)->find();

   	  			if(!$login){
   	  				import ( "@.ORG.String" );
   	  				Load ( 'extend' );
   	  				$username = String::rand_string(6,3,'').date ('His');
   	  				if( $info['data']['email'] !==''){
   	  					$data['email'] = $info['data']['email'];
   	  				}else{
   	  					$data['email'] = $username.'@31wan.cn';
   	  				}
   	  				$uid = uc_user_register($username, $username, $data['email']);
   	  				if($uid <= 0){
   	  					if($uid == -1){
   	  						$this->error('您提交的数据有误:用户名非法,请检查您的输入!');
   	  					}elseif($uid == -2){
   	  						$this->error('您提交的数据有误:用户名包含不允许注册的词语,请检查您的输入!');
   	  					}elseif($uid == -3){
   	  						$this->error('您提交的数据有误:用户名已经存在！,请检查您的输入!');
   	  					}elseif($uid == -4){
   	  						$this->error('您提交的数据有误:Email格式,请检查您的输入!');
   	  					}elseif($uid == -5){
   	  						$this->error('您提交的数据有误:您使用的Email不允许注册,请检查您的输入!');
   	  					}elseif($uid == -6){
   	  						$this->error('您提交的数据有误:您使用的Email已经被别人注册,请检查您的输入!');
   	  					}else{
   	  						$this->error('您提交的数据有误:请检查您的输入!');
   	  					}
   	  				}else{
   	  					//若是第一次登录 不能和bbs同步登陆，插入bbs数据库
   	  					/* 	$this->db->query("INSERT INTO pre_common_member SET `uid`='".$uid."',`username`='".$username."',`password`='".$password."',`email`='".$email."',`adminid`='0',`groupid`='10',`regdate`='".$this->base->time."',`credits`='0',`timeoffset`='9999'");
   	  					 $this->db->query("INSERT INTO pre_common_member_status SET `uid`='".$uid."',`regip`='".$regip."',`lastip`='".$regip."',`lastvisit`='1308642137',`lastactivity`='1308642137',`lastpost`='0',`lastsendmail`='0'");
   	  					$this->db->query("INSERT INTO pre_common_member_profile SET `uid`='".$uid."'");
   	  					$this->db->query("INSERT INTO pre_common_member_field_forum SET `uid`='".$uid."'");
   	  					$this->db->query("INSERT INTO pre_common_member_field_home SET `uid`='".$uid."'");
   	  					$this->db->query("INSERT INTO pre_common_member_count SET `uid`='".$uid."',`extcredits1`='0',`extcredits2`='0',`extcredits3`='0',`extcredits4`='0',`extcredits5`='0',`extcredits6`='0',`extcredits7`='0',`extcredits8`='0'");
   	  					*/
   	  					/* 		$common_member = M('common_member','pre_','mysql://root:zhujinok@localhost/demobbs');
   	  					 $sss = $common_member->where('uid =1')->find();
   	  					 $common_member_arr['uid'] =$uid;
   	  					 $common_member_arr['username'] =$username;
   	  					 $common_member_arr['password'] =$username;
   	  				
   	  					 $common_member->data($extends)->add();
   	  					 print_r($sss);exit; */
   	  					//第一次登陆
   	  					$data['username'] = $username;
   	  					$data['nickname'] = $user_info['nickname'];
   	  					$data['uid'] = $uid;
   	  					$data['phone'] = '';
   	  					$data['avatar'] = $user_info['figureurl_1'];
   	  					$data['level'] = "1";
   	  					$data['point'] = "0";
   	  					$data['openid'] = $info['data']['openid'];
   	  					$data['money'] = (int)("0.00");
   	  					$data['is_fcm'] = "1";//默认不开启
   	  					$data['user_status'] = "0";
   	  					if($info['data']['sex']==1){
   	  						$data['gender'] = "男";
   	  					}else{
   	  						$data['gender'] = "女";
   	  					}
   	  					$model = M('member');
   	  					$insert = $model->data($data)->add();
   	  					if(!$insert){
   	  						$this->error('系统发生错误.插入数据失败 *.*');
   	  					
   	  					}else{
   	  						$extends['uid'] = $uid;
   	  						$extends['register_time'] = time();
   	  						$extends['register_ip'] = get_client_ip();
   	  						$extends['lastlogin_time'] = time();
   	  						$extends['lastlogin_ip'] = get_client_ip();
   	  						$extends['realname'] = $info['data']['nick'];
   	  						$extends['from_soical'] = "腾讯";
   	  						$model = M('member_extend_info');
   	  						$st = $model->data($extends)->add();
   	  						if(!$st){
   	  							$this->error('快速登陆发生错误');
   	  						}else{
   	  					
   	  								
   	  						}
   	  					}
   	  					setcookie ( C('COOKIE_PREFIX') .'auth', uc_authcode ( $uid . "\t" . $data['username'], 'ENCODE' ), 0, C('COOKIE_PATH'), C('COOKIE_DOMAIN'), 0, false );
   	  					$ucsynlogin = uc_user_synlogin($uid);
   	  					$_SESSION['uid'] = $uid;
   	  					$_SESSION['member'] = $data['username'];
   	  					$this->success('注册成功,系统正在为你登陆中..'.$ucsynlogin,'/','3');
   	  				}
   	  				
   	  				
   	  				
   	  				
   	  			}else{
   	  				$aa = uc_get_user($login['username']);
   	  				//判断该用户是否被锁定
   	  				$member = M ( 'member' );
   	  				$u_info = $member->where ( "username ='" .$login['username']. "'" )->find ();
   	  				if ($u_info['user_status']=='1') {
   	  						$this->error('您的账号已被平台锁定，请联系平台客服!','/');
   	  				}
   	  				if ($aa[0] > 0) {
   	  				 setcookie ( C('COOKIE_PREFIX') .'auth', uc_authcode ( $aa[0] . "\t" . $login['username'], 'ENCODE' ), '1500', C('COOKIE_PATH'), C('COOKIE_DOMAIN'), 0, false );
   	  				 $ucsynlogin = uc_user_synlogin ($aa[0]);
   	  				 $_SESSION['uid'] = $aa[0];
   	  				 $_SESSION['member'] = $login['username'];
   	  				 $member = M("member_extend_info"); // 实例化member_extend_info对象
   	  				 $map['lastlogin_ip'] = get_client_ip();
   	  				 $map['lastlogin_time'] = time();
   	  				 $member = M("member_extend_info"); // 实例化member_extend_info对象
   	  				 $member->where('uid = '.$aa[0])->save($map); // 根据条件保存修改的数据
   	  				 $this->success('登陆成功'.$aa[0].$ucsynlogin,'/','3');
   	  				}
   	  				  
   	  			}
   	  		
   	  	}
   	 	 	
   	 }
   }
?>