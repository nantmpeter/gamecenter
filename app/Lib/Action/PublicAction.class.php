<?php
          /**
           * @name 系统公用操作类
           * 
           * @author lostman$ (leefongyun@gmail.com)
           * 
           * @access public 
           * 
           */
		  class PublicAction extends Action
		  {
			  	public function wirte_log_pay($log){
			  	
			  		$fp = fopen($_SERVER['DOCUMENT_ROOT']."/app/Lib/Log/".$log['file']."_".date('Ymd',$_SERVER['REQUEST_TIME']) .'.log', "a");
			  		$s=implode($log['split'],$log['data']);
			  		fwrite($fp,$s."\r\n");
			  		fclose($fp);
			  	}
		  	    public function verify()
		  	    {
		  	    	import("ORG.Util.Image");	
		  	    	Image::buildImageVerify();
		  	    }
			  	public function write_conf()
			  	{
			  		$conn = M("webconfig");
			  		$data_re = $conn->find();
			  		$data = array_change_key_case($data_re,CASE_UPPER);
			  		F('basic',$data,CONF_PATH);
			  		 
			  	}
			  	public function read_conf()
			  	{
			  		if(!CONF_PATH."/basic.php")
			  		{
			  			self::write_conf();
			  		}
			  	}
			  	public function head()
			  	{
			  		self::read_conf();
			  		$config = F('basic');
			  		$this->assign('config',$config);
			  		$map['aid'] = $_GET['aid'];

			  		if($map['aid'] !=''){
					$map['status'] = "1";
			  		$model = M('article');
			  		$info_a = $model->where($map)->find();
			  		$this->assign('info_a',$info_a);
			  		}
			  		$conn =M('category');
			  		$map['show'] = "0";
			  		$map['ismenu'] = "1";
			  		$list = $conn->where($map)->select();
			  		foreach($list as $k=>$v){
			  			$arr = explode('/', $v['url']);
			  			$list[$k]['url1'] = $arr[1];
			  			
			  		}
			  		$model = M('game');
			  		$cond['isdisplay'] = "0";
			  		$lists = $model->where($cond)->order('addtime desc')->select();
			  		$this->assign('lists',$lists);
			  		$str = MODULE_NAME;

			  		$this->assign('str',strtolower($str));
			  		
			  		$info = $conn->where("url = '/".strtolower($str)."'")->select();
			  		$this->assign('info',$info);
			  		$this->assign('category',$list);
			  	    $this->display(TMPL_PATH.$config['THEME'].'/head.html');
			  	}
			  	public function footer()
			  	{
			  		self::read_conf();
			  		$config = F('basic');
			  		$this->assign('config',$config);
			  		$this->display(TMPL_PATH.$config['THEME'].'/footer.html');
			  	}
			  	
			  	
			  	/**
			  	 * 系统邮件发送函数
			  	 * @param string $to    接收邮件者邮箱
			  	 * @param string $name  接收邮件者名称
			  	 * @param string $subject 邮件主题
			  	 * @param string $body    邮件内容
			  	 * @param string $attachment 附件列表
			  	 * @return boolean
			  	 */
			  	public function think_send_mail($to, $name, $subject = '', $body = '', $attachment = null){
			  		self::read_conf();
			  		$config = F('basic');
			  		vendor('PHPMailer.class#phpmailer');       //从PHPMailer目录导class.phpmailer.php类文件
			  		$mail             = new PHPMailer(); //PHPMailer对象
			  		$mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
			  		$mail->IsSMTP();  // 设定使用SMTP服务
			  		$mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能
			  		// 1 = errors and messages
			  		// 2 = messages only
			  		$mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
			  	//	$mail->SMTPSecure = 'ssl';                 // 使用安全协议
			  		$mail->Host       = $config['MAIL_SERVER'];//smtp.163.com';//SMTP服务器
			  		$mail->Port       = $config['MAIL_PORT'];//'25';  // SMTP服务器的端口号
			  		$mail->Username   = $config['MAIL_FROM'];//'shf_l@163.com';  // SMTP服务器用户名
			  		$mail->Password   = $config['MAIL_PASSWORD']; // SMTP服务器密码
			  		$mail->SetFrom($config['MAIL_FROM'], $config['MAIL_USER']);
			  		$replyEmail       = $config['MAIL_FROM'];
			  		$replyName        = $config['MAIL_USER'];
			  		$mail->AddReplyTo($replyEmail, $replyName);
			  		$mail->Subject    = $subject;
			  		$mail->MsgHTML($body);
			  		$mail->AddAddress($to, $name);
			  		if(is_array($attachment)){ // 添加附件
			  			foreach ($attachment as $file){
			  				is_file($file) && $mail->AddAttachment($file);
			  			}
			  		}
			  		return $mail->Send() ? true : $mail->ErrorInfo;
			  	}
			  		
		  }
  