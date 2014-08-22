<?php
@set_time_limit(1000);
if(phpversion() < '5.3.0') set_magic_quotes_runtime(0);
if(phpversion() < '5.2.0') exit('您的php版本过低，不能安装本软件，请升级到5.2.0或更高版本再安装，谢谢！');

/* define('APP_DEBUG',true);
define('THINK_PATH','../sys/system/');
require_once THINK_PATH.'ThinkPHP.php';

defined('THINK_PATH') or exit('No permission resources.'); */
if(file_exists('../res/config/install.lock')) exit('您已经安装过wancms,如果需要重新安装，请删除 ./caches/install.lock 文件！');

$steps = include './step.inc.php';
if(isset($_REQUEST["step"]))$step=$_REQUEST["step"];
else $step=1;


$mode = 0777;

switch($step)
{
    case '1': //安装许可协议
		$license = file_get_contents("./license.txt");
		include "./step/step".$step.".tpl.php";
		break;
	
	case '2':  //环境检测 (FTP帐号设置）
        $PHP_GD  = '';
		if(extension_loaded('gd')) {
			if(function_exists('imagepng')) $PHP_GD .= 'png';
			if(function_exists('imagejpeg')) $PHP_GD .= ' jpg';
			if(function_exists('imagegif')) $PHP_GD .= ' gif';
		}
		$PHP_JSON = '0';
		if(extension_loaded('json')) {
			if(function_exists('json_decode') && function_exists('json_encode')) $PHP_JSON = '1';
		}
		//新加fsockopen 函数判断,此函数影响安装后会员注册及登录操作。
		if(function_exists('fsockopen')) {
			$PHP_FSOCKOPEN = '1';
		}
        $PHP_DNS = preg_match("/^[0-9.]{7,15}$/", @gethostbyname('www.phpcms.cn')) ? 1 : 0;
		//是否满足phpcms安装需求
		$is_right = (phpversion() >= '5.2.0' && extension_loaded('mysql') && $PHP_JSON && $PHP_GD && $PHP_FSOCKOPEN) ? 1 : 0;		
		
		include "./step/step".$step.".tpl.php";
		break;
	

	case '3': //配置帐号 （MYSQL帐号、管理员帐号、）
	
		include "./step/step".$step.".tpl.php";
		break;

	case '4': //安装详细过程
		extract($_POST);
		//$testdata = $_POST['testdata'];
		include "./step/step".$step.".tpl.php";
		break;

	case '5': //完成安装
	
		file_put_contents('../res/config/install.lock','');
		include "./step/step".$step.".tpl.php";
		//删除安装目录
		//delete_install(PHPCMS_PATH.'install/');
		break;
	
	case 'installmodule': //执行SQL
		extract($_POST);

		$PHP_SELF = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['ORIG_PATH_INFO']);
		$rootpath = str_replace('\\','/',dirname($PHP_SELF));	
		$rootpath = substr($rootpath,0,-7);
		$rootpath = strlen($rootpath)>1 ? $rootpath : "/";	
		$db_config =  array(
				/* 数据库设置 */
				'DB_TYPE'               => 'mysql',     // 数据库类型
				'DB_HOST'               => $dbhost, // 服务器地址
				'DB_NAME'               => $dbname,          // 数据库名
				'DB_USER'               => $dbuser,      // 用户名
				'DB_PWD'                => $dbpw,          // 密码

		
		);
			set_config($db_config,'config.inc');
			
			$lnk = mysql_connect($dbhost, $dbuser, $dbpw) or die ('Not connected : ' . mysql_error());
			$version = mysql_get_server_info();

		
			
			if($version > '5.0') {
				mysql_query("SET sql_mode=''");
			}
			
												
			if(!@mysql_select_db($dbname)){
				@mysql_query("CREATE DATABASE $dbname DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");
				if(@mysql_error()) {
					echo 1;exit;
				} else {
					mysql_select_db($dbname);
				}
			}
		    mysql_query("SET NAMES UTF8");
			$dbfile =  'wancms.sql';


			if(file_exists("./main/".$dbfile)) {


				$sql = file_get_contents("./main/".$dbfile);


				_sql_execute($sql);	


		


			}else{


				echo '2';//数据库文件不存在


			}

			mysql_query("SET NAMES UTF8");
			$dbfile1 =  'wancms_1.sql';

			if(file_exists("./main/".$dbfile1)) {
				$sql1 = file_get_contents("./main/".$dbfile1);
				_sql_execute($sql1);
			}else{
				echo '3';//数据库文件不存在
			}						
		
		break;
		//数据库测试
		case 'dbtest':
			extract($_GET);
			if(!@mysql_connect($dbhost, $dbuser, $dbpw)) {
				exit('2');
			}
			$server_info = mysql_get_server_info();
			if($server_info < '4.0') exit('6');
			if(!mysql_select_db($dbname)) {
				if(!@mysql_query("CREATE DATABASE `$dbname` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci")) exit('3');
			
				mysql_select_db($dbname);
			}
			$tables = array();
			$query = mysql_query("SHOW TABLES FROM `$dbname`");
			while($r = mysql_fetch_row($query)) {
				$tables[] = $r[0];
			}
			if($tables && in_array($tablepre.'module', $tables)) {
				exit('0');
			}
			else {
				exit('1');
			}
			break;
				//数据库测试
	case 'dbtest':
		extract($_GET);
		if(!@mysql_connect($dbhost, $dbuser, $dbpw)) {
			exit('2');
		}
		$server_info = mysql_get_server_info();
		if($server_info < '4.0') exit('6');
		if(!mysql_select_db($dbname)) {
			if(!@mysql_query("CREATE DATABASE `$dbname`")) exit('3');
			mysql_select_db($dbname);
		}
		$tables = array();
		$query = mysql_query("SHOW TABLES FROM `$dbname`");
		while($r = mysql_fetch_row($query)) {
			$tables[] = $r[0];
		}
		if($tables && in_array($tablepre.'module', $tables)) {
			exit('0');
		}
		else {
			exit('1');
		}
		break;

}

function format_textarea($string) {
	return nl2br(str_replace(' ', '&nbsp;', htmlspecialchars($string)));
}

function _sql_execute($sql,$r_tablepre = '',$s_tablepre = 'mygame_') {
    $sqls = _sql_split($sql,$r_tablepre,$s_tablepre);
	if(is_array($sqls))
    {
		foreach($sqls as $sql)
		{
			if(trim($sql) != '')
			{
				mysql_query($sql);
			}
		}
	}
	else
	{
		mysql_query($sqls);
	}
	return true;
}

function _sql_split($sql,$r_tablepre = '',$s_tablepre='mygame_') {
	
	$dbcharset = 'utf8';
	$tablepre = 'mygame_';
	$r_tablepre = $r_tablepre ? $r_tablepre : $tablepre;
	if(mysql_get_server_info() > '4.1' && $dbcharset)
	{
		$sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=".$dbcharset,$sql);
	}
	
	if($r_tablepre != $s_tablepre) $sql = str_replace($s_tablepre, $r_tablepre, $sql);
	$sql = str_replace("\r", "\n", $sql);
	$ret = array();
	$num = 0;
	$queriesarray = explode(";\n", trim($sql));
	unset($sql);
	foreach($queriesarray as $query)
	{
		$ret[$num] = '';
		$queries = explode("\n", trim($query));
		$queries = array_filter($queries);
		foreach($queries as $query)
		{
			$str1 = substr($query, 0, 1);
			if($str1 != '#' && $str1 != '-') $ret[$num] .= $query;
		}
		$num++;
	}
	return $ret;
}

function dir_writeable($dir) {
	$writeable = 0;
	if(is_dir($dir)) {  
        if($fp = @fopen("$dir/chkdir.test", 'w')) {
            @fclose($fp);      
            @unlink("$dir/chkdir.test"); 
            $writeable = 1;
        } else {
            $writeable = 0; 
        } 
	}
	return $writeable;
}

function writable_check($path){
	$dir = '';
	$is_writable = '1';
	if(!is_dir($path)){return '0';}
	$dir = opendir($path);
 	while (($file = readdir($dir)) !== false){
		if($file!='.' && $file!='..'){
			if(is_file($path.'/'.$file)){
				//是文件判断是否可写，不可写直接返回0，不向下继续
				if(!is_writable($path.'/'.$file)){
 					return '0';
				}
			}else{
				//目录，循环此函数,先判断此目录是否可写，不可写直接返回0 ，可写再判断子目录是否可写 
				$dir_wrt = dir_writeable($path.'/'.$file);
				if($dir_wrt=='0'){
					return '0';
				}
   				$is_writable = writable_check($path.'/'.$file);
 			}
		}
 	}
	return $is_writable;
}

function set_config($config,$cfgfile) {
	if(!$config || !$cfgfile) return false;
	$configfile = '../res/config/'.$cfgfile.'.php';
	if(!is_writable($configfile)) showmessage('Please chmod '.$configfile.' to 0777 !');
	$pattern = $replacement = array();
	foreach($config as $k=>$v) {
			$v = trim($v);
			$configs[$k] = $v;
			$pattern[$k] = "/'".$k."'\s*=>\s*([']?)[^']*([']?)(\s*),/is";
        	$replacement[$k] = "'".$k."' => \${1}".$v."\${2}\${3},";							
	}
	$str = file_get_contents($configfile);
	$str = preg_replace($pattern, $replacement, $str);
	return file_put_contents($configfile, $str);		
}

function set_sso_config($config,$cfgfile) {
	if(!$config || !$cfgfile) return false;
	$configfile = PHPCMS_PATH.'phpsso_server'.DIRECTORY_SEPARATOR.'caches'.DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.$cfgfile.'.php';
	if(!is_writable($configfile)) showmessage('Please chmod '.$configfile.' to 0777 !');
	$pattern = $replacement = array();
	foreach($config as $k=>$v) {
			$v = trim($v);
			$configs[$k] = $v;
			$pattern[$k] = "/'".$k."'\s*=>\s*([']?)[^']*([']?)(\s*),/is";
        	$replacement[$k] = "'".$k."' => \${1}".$v."\${2}\${3},";							
	}
	$str = file_get_contents($configfile);
	$str = preg_replace($pattern, $replacement, $str);
	return file_put_contents($configfile, $str);		
}

function remote_file_exists($url_file){
	$headers = get_headers($url_file);
	if (!preg_match("/200/", $headers[0])){
		return false;
	}
	return true;
}
function delete_install($dir) {
	$dir = dir_path($dir);
	if (!is_dir($dir)) return FALSE;
	$list = glob($dir.'*');
	foreach($list as $v) {
		is_dir($v) ? delete_install($v) : @unlink($v);
	}
    return @rmdir($dir);
}
?>