<?php
     /**
      * @name Web Game Plf 入口文件
      * 
      * @access public
      * 
      * @author lostman $ (leefongyun@gmail.com)
      * 
      */
      define('APP_NAME','app');
      define('APP_DEBUG',true);
      define('APP_PATH','./app/');
      define('THINK_PATH','./sys/system/');
      require_once THINK_PATH.'ThinkPHP.php';
      require_once 'config.inc.php';
      require_once 'uc_client/client.php';
?>
      