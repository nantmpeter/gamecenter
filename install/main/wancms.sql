
-- --------------------------------------------------------

--
-- 表的结构 `mygame_ad`
--

CREATE TABLE IF NOT EXISTS `mygame_ad` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(80) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `end_time` int(11) NOT NULL COMMENT '有效期',
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;


-- --------------------------------------------------------

--
-- 表的结构 `mygame_admin_exec_log`
--

CREATE TABLE IF NOT EXISTS `mygame_admin_exec_log` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `ip` varchar(18) NOT NULL,
  `time` int(12) NOT NULL,
  `remark` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



--
-- 表的结构 `mygame_admin_login_error`
--

CREATE TABLE IF NOT EXISTS `mygame_admin_login_error` (
  `id` int(9) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(30) NOT NULL COMMENT '密码',
  `os` varchar(20) NOT NULL COMMENT '操作系统',
  `time` int(12) NOT NULL COMMENT '登录时间',
  `ip` varchar(18) NOT NULL COMMENT '登录ip',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



--
-- 表的结构 `mygame_admin_pay`
--

CREATE TABLE IF NOT EXISTS `mygame_admin_pay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `op_username` varchar(50) NOT NULL COMMENT '操作管理员',
  `uid` int(10) NOT NULL COMMENT 'uid',
  `username` varchar(50) NOT NULL COMMENT '被充值用户',
  `ip` varchar(50) NOT NULL COMMENT 'ip',
  `add_time` int(11) NOT NULL COMMENT '操作时间',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `real_money` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '充值金额',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



--
-- 表的结构 `mygame_admin_role`
--

CREATE TABLE IF NOT EXISTS `mygame_admin_role` (
  `roleid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `rolename` varchar(50) NOT NULL COMMENT '角色名称',
  `description` varchar(255) NOT NULL COMMENT '角色描述',
  `disabled` tinyint(1) NOT NULL COMMENT '是否显示',
  PRIMARY KEY (`roleid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;



--
-- 表的结构 `mygame_ad_where`
--

CREATE TABLE IF NOT EXISTS `mygame_ad_where` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;


--
-- 表的结构 `mygame_article`
--

CREATE TABLE IF NOT EXISTS `mygame_article` (
  `aid` int(7) NOT NULL AUTO_INCREMENT,
  `title` varchar(55) NOT NULL,
  `titlecorlor` varchar(55) NOT NULL,
  `author` varchar(55) NOT NULL,
  `tags` tinytext NOT NULL,
  `description` tinytext NOT NULL,
  `from` varchar(55) NOT NULL,
  `istop` int(2) NOT NULL DEFAULT '0',
  `addtime` int(15) NOT NULL,
  `imgurl` varchar(255) NOT NULL,
  `ishot` int(2) NOT NULL DEFAULT '0',
  `isflash` int(2) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `hits` int(11) NOT NULL,
  `typeid` int(3) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;



--
-- 表的结构 `mygame_card`
--

CREATE TABLE IF NOT EXISTS `mygame_card` (
  `card` text NOT NULL COMMENT '新手卡',
  `name` varchar(80) NOT NULL,
  `gid` int(5) NOT NULL,
  `sid` int(8) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `start_time` int(13) NOT NULL COMMENT '领取开始时间',
  `total` int(10) NOT NULL COMMENT '新手卡总共个数',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;



--
-- 表的结构 `mygame_card_log`
--

CREATE TABLE IF NOT EXISTS `mygame_card_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `sid` int(6) NOT NULL COMMENT '区服id',
  `gid` int(6) NOT NULL COMMENT '游戏id',
  `uid` int(10) NOT NULL COMMENT '用户uid',
  `get_time` int(11) NOT NULL COMMENT '获取时间',
  `card_info` varchar(50) NOT NULL COMMENT '新手卡',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



--
-- 表的结构 `mygame_category`
--

CREATE TABLE IF NOT EXISTS `mygame_category` (
  `typeid` mediumint(5) unsigned NOT NULL AUTO_INCREMENT,
  `typename` varchar(20) NOT NULL,
  `keywords` char(40) NOT NULL,
  `description` text NOT NULL,
  `is_showdesc` int(2) NOT NULL DEFAULT '0',
  `html_file` varchar(20) NOT NULL,
  `ismenu` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(255) NOT NULL,
  `target` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `drank` mediumint(5) unsigned NOT NULL,
  `irank` mediumint(5) NOT NULL,
  `fid` mediumint(5) unsigned NOT NULL,
  `show` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`typeid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;



--
-- 表的结构 `mygame_category_list`
--

CREATE TABLE IF NOT EXISTS `mygame_category_list` (
  `id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `category` varchar(20) NOT NULL COMMENT '栏目名',
  `module_alias` varchar(20) NOT NULL,
  `hidden` int(1) NOT NULL DEFAULT '0',
  `fid` int(3) NOT NULL COMMENT '父id',
  `listorder` smallint(3) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=168 ;



--
-- 表的结构 `mygame_cps`
--

CREATE TABLE IF NOT EXISTS `mygame_cps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gid` int(10) NOT NULL COMMENT 'gid',
  `uid` int(10) NOT NULL COMMENT 'uid',
  `isflag` smallint(3) NOT NULL COMMENT '状态0通过 1未通过 2 正在审核',
  `starttime` int(13) NOT NULL COMMENT '申请有效开始时间',
  `endtime` int(13) NOT NULL COMMENT '申请有效结束时间',
  `addtime` int(13) NOT NULL COMMENT '申请时间',
  `url` varchar(255) NOT NULL COMMENT '游戏推广链接',
  `ratio` smallint(4) NOT NULL COMMENT '分成比例',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '链接是否可用',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- 表的结构 `mygame_game`
--

CREATE TABLE IF NOT EXISTS `mygame_game` (
  `gid` int(8) NOT NULL AUTO_INCREMENT COMMENT '游戏id',
  `game_starttime` int(15) NOT NULL COMMENT '游戏开服时间',
  `sort` int(8) NOT NULL COMMENT '排序',
  `gamename` varchar(55) NOT NULL COMMENT '游戏名称',
  `short` char(3) NOT NULL COMMENT '简写',
  `tag` char(22) NOT NULL COMMENT '缩写（用于写接口）',
  `gametype` int(3) NOT NULL COMMENT '游戏类别',
  `gamepic` tinytext NOT NULL,
  `smallpic` varchar(255) NOT NULL DEFAULT './Public/images/defaultico.png',
  `ordinarypic` varchar(255) NOT NULL DEFAULT './Public/images/defaults.png',
  `payto` int(5) NOT NULL COMMENT '比例',
  `content` text NOT NULL,
  `ishot` int(3) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `game_web` varchar(255) NOT NULL COMMENT '游戏官网地址',
  `game_bbs` varchar(255) NOT NULL COMMENT '游戏论坛地址',
  `game_guide` varchar(255) NOT NULL COMMENT '游戏指南地址',
  `card` tinytext NOT NULL,
  `service` tinytext NOT NULL,
  `currency` char(20) NOT NULL COMMENT '游戏币单位',
  `addtime` int(15) NOT NULL COMMENT '添加时间',
  `game_hit` int(8) NOT NULL DEFAULT '1' COMMENT '点击次数',
  `game_key` varchar(100) NOT NULL COMMENT '游戏key',
  `game_paykey` varchar(100) NOT NULL COMMENT '游戏充值key',
  `game_url` varchar(100) NOT NULL COMMENT '游戏登陆url',
  `game_payurl` varchar(100) NOT NULL COMMENT '游戏充值url',
  `p_id` int(8) NOT NULL COMMENT '合作平台id',
  `isdisplay` int(2) NOT NULL,
  `desc1` varchar(255) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;



--
-- 表的结构 `mygame_gametype`
--

CREATE TABLE IF NOT EXISTS `mygame_gametype` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `typename` varchar(50) NOT NULL COMMENT '类型名',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;



--
-- 表的结构 `mygame_game_log`
--

CREATE TABLE IF NOT EXISTS `mygame_game_log` (
  `logid` int(6) NOT NULL AUTO_INCREMENT,
  `uid` int(6) NOT NULL,
  `username` varchar(44) NOT NULL,
  `gid` int(3) NOT NULL,
  `sid` int(3) NOT NULL,
  `logintime` int(13) NOT NULL,
  `loginip` varchar(15) NOT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;


--
-- 表的结构 `mygame_link`
--

CREATE TABLE IF NOT EXISTS `mygame_link` (
  `linkid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `linktype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `logo` varchar(255) NOT NULL DEFAULT '',
  `introduce` text NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `elite` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `passed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`linkid`),
  KEY `typeid` (`passed`,`listorder`,`linkid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;



--
-- 表的结构 `mygame_manager`
--

CREATE TABLE IF NOT EXISTS `mygame_manager` (
  `uid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'uid',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(42) NOT NULL COMMENT '密码',
  `roleid` smallint(5) NOT NULL COMMENT '管理员角色',
  `login_ip` varchar(18) NOT NULL COMMENT '登录ip',
  `os` varchar(30) NOT NULL COMMENT '操作系统',
  `login_time` int(13) NOT NULL COMMENT '登录时间',
  `login_count` int(6) NOT NULL COMMENT '登录次数',
  `status` int(1) NOT NULL COMMENT '状态',
  `email` varchar(255) NOT NULL COMMENT 'email',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`),
  UNIQUE KEY `uid_2` (`uid`),
  KEY `uid_3` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=13 ;



--
-- 表的结构 `mygame_member`
--

CREATE TABLE IF NOT EXISTS `mygame_member` (
  `uid` int(10) NOT NULL COMMENT ' uid',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `nickname` varchar(50) NOT NULL COMMENT '呢称',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `phone` varchar(20) NOT NULL COMMENT '手机',
  `avatar` varchar(50) NOT NULL COMMENT '头像地址',
  `level` enum('1','2','3','4') NOT NULL DEFAULT '1' COMMENT '等级',
  `point` int(10) NOT NULL COMMENT '积分',
  `money` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `id_card` char(18) NOT NULL COMMENT '身份证',
  `is_fcm` smallint(2) NOT NULL DEFAULT '0' COMMENT '是否开启防沉迷',
  `safe_q` varchar(50) NOT NULL COMMENT '问题',
  `safe_a` varchar(50) NOT NULL COMMENT '答案',
  `user_status` smallint(3) NOT NULL COMMENT '状态',
  `gender` enum('男','女') NOT NULL DEFAULT '男' COMMENT '性别',
  `pwd_flag` varchar(255) NOT NULL COMMENT '加密字符串',
  `openid` varchar(50) NOT NULL COMMENT '互联时返回唯一值用于绑定解绑用',
  PRIMARY KEY (`uid`),
  KEY `email` (`email`),
  KEY `username` (`username`),
  KEY `user_status` (`user_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



--
-- 表的结构 `mygame_member_extend_info`
--

CREATE TABLE IF NOT EXISTS `mygame_member_extend_info` (
  `uid` int(10) NOT NULL COMMENT 'uid',
  `register_time` int(13) NOT NULL COMMENT '注册时间',
  `register_ip` varchar(18) NOT NULL COMMENT '注册ip',
  `lastlogin_time` int(13) NOT NULL COMMENT '最后登录时间',
  `lastlogin_ip` varchar(18) NOT NULL COMMENT '最后登录ip',
  `max_error` int(3) NOT NULL COMMENT '最大次数',
  `realname` varchar(50) NOT NULL COMMENT '真实姓名',
  `from_soical` varchar(255) NOT NULL COMMENT '来源',
  `total_channels` int(10) NOT NULL COMMENT '推广总渠道',
  `gid` int(10) NOT NULL COMMENT '游戏id',
  `sid` int(10) NOT NULL COMMENT '区id',
  `subsign` int(10) NOT NULL COMMENT '上级推广id',
  `grouping` smallint(3) NOT NULL COMMENT '分组',
  `sub_channels` int(10) NOT NULL COMMENT '推广子渠道'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



--
-- 表的结构 `mygame_menu`
--

CREATE TABLE IF NOT EXISTS `mygame_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `zh_name` char(50) NOT NULL,
  `m` char(20) NOT NULL,
  `c` char(20) NOT NULL,
  `a` char(20) NOT NULL,
  `data` char(100) NOT NULL,
  `listorder` smallint(6) NOT NULL DEFAULT '0',
  `display` enum('0','1') NOT NULL DEFAULT '1',
  `parentid` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;



--
-- 表的结构 `mygame_pay_ok`
--

CREATE TABLE IF NOT EXISTS `mygame_pay_ok` (
  `id` int(9) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `orderid` varchar(20) NOT NULL COMMENT '订单号',
  `pay_way_num` int(1) NOT NULL DEFAULT '0' COMMENT '支付性质（平台/游戏）',
  `gid` int(5) NOT NULL COMMENT '游戏id',
  `sid` int(5) NOT NULL COMMENT '区id',
  `pay_to_account` varchar(30) NOT NULL COMMENT '充值账户',
  `uid` int(9) NOT NULL COMMENT '充值人id',
  `pay_tag` varchar(10) NOT NULL COMMENT '充值渠道标签',
  `pay_port` varchar(20) NOT NULL,
  `pay_bank` varchar(20) NOT NULL COMMENT '支付银行名称',
  `pay_money` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '充值金额',
  `pay_really_money` double(10,2) NOT NULL DEFAULT '0.00',
  `get_coin` int(9) NOT NULL COMMENT '游戏元宝数',
  `pay_ip` varchar(20) NOT NULL COMMENT '充值ip',
  `pay_time` int(12) NOT NULL COMMENT '充值时间',
  `success_time` int(12) NOT NULL COMMENT '充值成功时间',
  `order_status` varchar(10) NOT NULL COMMENT '订单状态',
  `remark` varchar(200) NOT NULL COMMENT '备注',
  `game_status` smallint(3) NOT NULL DEFAULT '0' COMMENT '游戏状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



--
-- 表的结构 `mygame_pay_type`
--

CREATE TABLE IF NOT EXISTS `mygame_pay_type` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `sort` smallint(5) unsigned DEFAULT NULL COMMENT '排序',
  `tag` varchar(30) NOT NULL COMMENT '标签',
  `payname` varchar(50) NOT NULL COMMENT '渠道名称',
  `pic` varchar(150) DEFAULT NULL COMMENT '图片',
  `icon` varchar(150) DEFAULT NULL COMMENT '小图片',
  `fee` char(10) DEFAULT NULL COMMENT '费率',
  `rebate` tinyint(3) DEFAULT NULL COMMENT '折扣',
  `content` tinytext COMMENT '描述',
  `extend` varchar(255) DEFAULT NULL COMMENT '扩展内容',
  `target` char(10) NOT NULL DEFAULT '_self' COMMENT '打开方式',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `modifytime` int(11) DEFAULT NULL COMMENT '修改时间',
  `isdisplay` int(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '是否启用',
  `operater` varchar(30) DEFAULT NULL COMMENT '操作员',
  `account` varchar(255) NOT NULL COMMENT '支付商号',
  `key` varchar(255) NOT NULL COMMENT '支付密钥',
  PRIMARY KEY (`id`),
  UNIQUE KEY `payname` (`payname`),
  UNIQUE KEY `tag` (`tag`),
  KEY `isdispaly` (`isdisplay`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='充值渠道' AUTO_INCREMENT=12 ;



--
-- 表的结构 `mygame_role_access`
--

CREATE TABLE IF NOT EXISTS `mygame_role_access` (
  `role_id` int(3) NOT NULL,
  `access_id` varchar(20) NOT NULL,
  `access_fid` int(2) NOT NULL,
  `parent_module_alias` varchar(20) NOT NULL,
  `parent_module` varchar(20) NOT NULL,
  `module` varchar(20) NOT NULL,
  `access_name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



--
-- 表的结构 `mygame_server`
--

CREATE TABLE IF NOT EXISTS `mygame_server` (
  `sid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gid` int(10) NOT NULL,
  `servername` varchar(50) NOT NULL COMMENT '名字',
  `start_time` int(13) NOT NULL,
  `server_url` varchar(50) NOT NULL,
  `add_time` int(13) NOT NULL,
  `stop_notice` varchar(255) NOT NULL,
  `is_display` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否显示',
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `gameid` varchar(50) NOT NULL COMMENT '若是混服填写混服游戏id',
  `serverid` int(10) NOT NULL COMMENT '混服开服id',
  `line` varchar(50) NOT NULL COMMENT '开服线路',
  `content` varchar(255) NOT NULL COMMENT '简介',
  `server_img` varchar(255) NOT NULL COMMENT '开服表图标',
  PRIMARY KEY (`sid`),
  UNIQUE KEY `sid` (`sid`),
  KEY `sid_2` (`sid`),
  KEY `sid_3` (`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;



--
-- 表的结构 `mygame_soical_login`
--

CREATE TABLE IF NOT EXISTS `mygame_soical_login` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `media_user_id` int(9) NOT NULL,
  `from_id` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;



--
-- 表的结构 `mygame_spend_log`
--

CREATE TABLE IF NOT EXISTS `mygame_spend_log` (
  `id` int(9) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `spend_time` int(12) NOT NULL COMMENT '消费时间',
  `uid` int(9) NOT NULL COMMENT '消费人id',
  `total_channels` int(9) NOT NULL,
  `sub_channels` int(9) NOT NULL,
  `remark` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL COMMENT '消费账户名',
  `gid` int(4) NOT NULL COMMENT '游戏id',
  `sid` int(4) NOT NULL COMMENT '区id',
  `spend_money` int(9) NOT NULL COMMENT '消费金额',
  `spend_ip` varchar(20) NOT NULL COMMENT '消费ip',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- 表的结构 `mygame_statistical`
--

CREATE TABLE IF NOT EXISTS `mygame_statistical` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `spend_time` int(11) NOT NULL COMMENT '充值日期',
  `uid` int(10) NOT NULL COMMENT '推广uid',
  `money` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '充值总额',
  `reg_num` int(6) NOT NULL COMMENT '注册人数',
  `spend_num` int(6) NOT NULL COMMENT '充值人数',
  `status` tinyint(1) NOT NULL COMMENT '是否结算',
  `gid` int(6) NOT NULL COMMENT '对应游戏id',
  `real_money` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '推广人员获得数额',
  `subsign` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



--
-- 表的结构 `mygame_webconfig`
--

CREATE TABLE IF NOT EXISTS `mygame_webconfig` (
  `id` int(11) NOT NULL COMMENT 'id',
  `sitename` varchar(30) NOT NULL COMMENT '站点名称',
  `sitename2` varchar(20) NOT NULL COMMENT '站点副标题',
  `theme` varchar(20) NOT NULL,
  `domain` varchar(35) NOT NULL COMMENT '网站域名',
  `keywords` varchar(200) NOT NULL COMMENT '关键词',
  `descriptions` varchar(200) NOT NULL COMMENT '网站描述',
  `game_sort` int(1) NOT NULL DEFAULT '0',
  `favicon` varchar(200) NOT NULL COMMENT '网站图标',
  `url_model` int(1) NOT NULL COMMENT 'url模式',
  `url_html_suffix` varchar(10) NOT NULL COMMENT 'URL 后缀',
  `open` int(1) NOT NULL COMMENT '是否开启网站',
  `close_notice` text NOT NULL,
  `openreg` int(1) NOT NULL COMMENT '是否开启注册',
  `logo` varchar(200) NOT NULL COMMENT 'logo地址',
  `gzip` smallint(1) NOT NULL DEFAULT '0' COMMENT 'gzip',
  `flash_model` int(1) NOT NULL DEFAULT '0',
  `save_uselog` int(1) NOT NULL DEFAULT '0' COMMENT '是否保存登录日志',
  `save_errorlog` int(1) NOT NULL DEFAULT '0' COMMENT '保存错误日志 	',
  `max_error` int(1) NOT NULL DEFAULT '0' COMMENT '错误日志预警大小',
  `social_login` int(1) NOT NULL DEFAULT '0' COMMENT '后台最大登陆失败次数',
  `appid` varchar(50) NOT NULL COMMENT 'appid',
  `appkey` varchar(50) NOT NULL COMMENT 'appkey',
  `mail_server` varchar(30) NOT NULL COMMENT '邮件服务器',
  `mail_port` int(6) NOT NULL COMMENT '邮件端口',
  `mail_from` varchar(40) NOT NULL COMMENT '发件人地址',
  `mail_user` varchar(40) NOT NULL COMMENT '邮件用户名',
  `mail_password` varchar(40) NOT NULL COMMENT '邮件密码',
  `uc_key` int(2) NOT NULL COMMENT 'uc_key',
  `uc_password` varchar(40) NOT NULL COMMENT 'uc_密码',
  `uc_api` varchar(100) NOT NULL COMMENT 'uc_api'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



--
-- 表的结构 `mygame_web_not_allow_ip`
--

CREATE TABLE IF NOT EXISTS `mygame_web_not_allow_ip` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `ip` varchar(18) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;


