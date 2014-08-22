后台默认账号密码 admin  adminadmin1234
安装完成后 根目录中config.inc.php为配置uc（需自行安装uc）
如若使用cps，由于数据清空，请自行指定一个推广人员的uid（/app/Lib/Action/AccountsAction.class.php)函数username_check1（）
eg：
if($uid_1){
$info = $extend->where (' grouping = 1 and uid ='.$uid_1)->find ();
if (empty($info)) {
	$extends_info ['sub_channels'] = '4';
	$extends_info ['total_channels'] = '4';
								
	}else{
	$extends_info ['sub_channels'] = $uid_1;
	if($info['subsign']=='0'){
	$extends_info ['total_channels'] = $uid_1;
	}else{
		$extends_info ['total_channels'] = $info['subsign'];
		}
							
		}
	}else{
		$extends_info ['sub_channels'] = '4';
		$extends_info ['total_channels'] = '4';
		}
		
上面的操作相当于指定一个系统推广账号（必须）