<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
 <link href="http://lib.sinaapp.com/js/bootstrap/2.2.1/css/bootstrap.min.css" rel="stylesheet" media="screen">
 <script src="http://lib.sinaapp.com/js/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
 <script src="http://lib.sinaapp.com/js/bootstrap/2.2.1/js/bootstrap.min.js" type="text/javascript"></script>
<title>状态提示</title>
</head>
<body>
 <div class="container">
<?php if(isset($message)): ?><div class="alert alert-success">
 <?php echo($message); ?>
</div>
 
<?php else: ?>
<div class="alert alert-error">
 <?php echo($error); ?> 
</div><?php endif; ?>
<p class="detail"></p>
<p class="jump">
页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
</p>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time == 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>