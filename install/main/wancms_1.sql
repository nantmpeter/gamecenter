
--
-- 转存表中的数据 `mygame_ad`
--

INSERT INTO `mygame_ad` (`id`, `title`, `content`, `description`, `addtime`, `status`, `type`, `end_time`, `url`) VALUES
(32, 'ccc121212', '5161118dcb544.jpg', 'ere23', 2013, 0, 2, 0, 'http://www.hao123.com'),
(34, '测试', '516111b64cc8b.jpg', '测试', 1363164552, 0, 2, 1364719740, 'http://www.baidu.com'),
(42, '霸王之心-端午节活动', '517a59590d833.jpg', '', 1366972761, 0, 2, 0, ''),
(44, 'asdf', '', '', 1376633523, 0, 1, 0, 'asdfsad');

-- --------------------------------------------------------



--
-- 转存表中的数据 `mygame_admin_role`
--

INSERT INTO `mygame_admin_role` (`roleid`, `rolename`, `description`, `disabled`) VALUES
(1, '超级管理员', '超级管理员1', 0),
(11, '测试2', '测试2', 0),
(12, '客服', 'kefu', 0);

-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_ad_where`
--

INSERT INTO `mygame_ad_where` (`id`, `title`) VALUES
(1, '头部广告'),
(2, '首页轮换'),
(10, '首页轮换'),
(11, '首页悬挂'),
(15, '首页轮播'),
(16, '1');

-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_article`
--

INSERT INTO `mygame_article` (`aid`, `title`, `titlecorlor`, `author`, `tags`, `description`, `from`, `istop`, `addtime`, `imgurl`, `ishot`, `isflash`, `content`, `hits`, `typeid`, `status`) VALUES
(36, '带图片', 'black', '31玩小编', '', '', '31玩平台', 0, 1369107640, './Public/images/default.jpg', 0, 0, '<p>31wan带图片</p>', 61, 8, 0),
(37, '测试', 'black', '31玩小编', '', '错误？', '31玩平台', 0, 1369213479, './Public/images/default.jpg', 1, 0, '<p>31wan</p><div><img src=\\"/Public/ueditor/themes/default/images/spacer.gif\\" word_img=\\"file:///C:\\\\Users\\\\Administrator\\\\Documents\\\\Tencent Files\\\\800030820\\\\1003\\\\Image\\\\VPXYGLNJCYF`)KIOH1K)_}V.jpg\\" style=\\"background:url(/public/ueditor/lang/zh-cn/images/localimage.png) no-repeat center center;border:1px solid #ddd\\" /></div><p style=\\"margin-left:52px;\\"><span style=\\"font-size:19px\\">1.<span style=\\"font:9px &#39;times new roman&#39;\\"> &nbsp; &nbsp; </span></span><span style=\\"font-size:19px;font-family:宋体\\">充值查询</span></p><p><br /></p>', 48, 8, 0),
(22, '科比', 'black', '31玩小编', 'kobe', '我不相信奇迹，我只相信科比', '31玩平台', 0, 1366616546, './Public/images/default.jpg', 1, 1, '<p>科比，神一样的男人，希望他早日康复，继续在球场上。。。</p>', 820, 8, 1),
(10, '常见问题11', 'black', '31玩小编', '', '常见问题11', '31玩平台', 0, 1362620420, './Public/images/default.jpg', 0, 1, '<p>31wan常见问题11常见问题11常见问题11</p>', 186, 10, 0),
(8, '测试内容', 'black', '31玩小编', '测试内容', '测试内容', '31玩平台', 0, 1362362134, './Public/images/default.jpg', 0, 1, '<p>31wan测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容</p>', 194, 7, 0),
(11, '11111111111111', 'black', '31玩小编', '', '111111111145', '31玩平台', 0, 1362812187, './Public/images/default.jpg', 1, 1, '<p>11111111111111111111</p>', 26, 7, 1),
(12, '骏网一卡通充值流程', 'black', '31玩小编', '', '', '31玩平台', 0, 1363605633, './Public/images/default.jpg', 0, 1, '<p>1、点击充值中心：<strong><span style=\\"color:#ff0000\\">&nbsp;</span></strong><span style=\\"color:#ff0000\\"><span style=\\"color:#000000\\">选择“骏网一卡通”。输入所玩的游戏，账号，所属的服务器。</span></span></p><p><span style=\\"color:#ff0000\\"><span style=\\"color:#000000\\">（<span style=\\"color:#ff0000\\">如游戏内未创建角色名，无法为账号进行充值</span>）</span></span></p><p><span style=\\"color:#ff0000\\"><span style=\\"color:#000000\\"><img style=\\"width:600px;float:none;height:359px\\" title=\\"1.jpg\\" border=\\"0\\" hspace=\\"0\\" src=\\"http://demo.31wan.cn/Public/ueditor/php/upload/41331363605687.jpg\\" width=\\"600\\" height=\\"359\\" /><br /></span></span></p><p><br /></p><p><span style=\\"color:#ff0000\\"><span style=\\"color:#000000\\">2、确认无误后，点击“确认充值”。即可跳转到骏网一卡通相关充值页面，为账号充值。</span></span></p><p><img style=\\"float:none\\" title=\\"2.jpg\\" border=\\"0\\" hspace=\\"0\\" src=\\"http://demo.31wan.cn/Public/ueditor/php/upload/19211363605687.jpg\\" /><br /></p><p><span style=\\"color:#ff0000\\"><span style=\\"color:#000000\\"><br /></span></span></p><p><span style=\\"color:#ff0000\\"><span style=\\"color:#000000\\"><span style=\\"color:#ff0000\\">备注：如在充值中，遇到问题，请及时联系官网的</span><a style=\\"color:#ff0000;text-decoration:underline\\" href=\\"http://www.qq163.com/kefu/online/pay.html\\" target=\\"_blank\\"><span style=\\"color:#ff0000\\">充值客服</span></a><span style=\\"color:#ff0000\\">。</span></span></span></p><p>&nbsp;</p>', 50, 4, 0),
(13, '电话手机V币充值流程', 'black', '31玩小编', '', '', '31玩平台', 0, 1363605705, './Public/images/default.jpg', 0, 1, '<div class=\\"content\\"><p>一、点击充值中心，选择“电话手机V币充值，选择您要充值的游戏、您所在的服务器、您的帐户信息并确认后，选择你的充值卡相对的面值，最后选择立刻充值。<br /></p><img style=\\"border-bottom:#000000 0px solid;border-left:#000000 0px solid;width:608px;float:none;height:450px;border-top:#000000 0px solid;border-right:#000000 0px solid\\" title=\\"1.jpg\\" border=\\"0\\" src=\\"http://uploads.qq163.com/userup/1112/210143446252.jpg\\" /><br /><p><br /></p><p><br /></p><p>二、点击“立即充值”出现以下画面。请认真填写充值信息以免造成充值错误.</p><img style=\\"border-bottom:#000 0px solid;border-left:#000 0px solid;float:none;border-top:#000 0px solid;border-right:#000 0px solid\\" title=\\"2.jpg\\" border=\\"0\\" src=\\"http://uploads.qq163.com/userup/1112/210144227945.jpg\\" /><br /><br />第三步：确认信息无误后，点击“确认提交”按钮，去到声讯卡号密码填写处。<br /><span style=\\"color:#ff0000\\">注：</span><br /><span style=\\"color:#ff0000\\">1、如果您想电话直充，只有5元、10元、15元、20元、30元五种金额选择</span><br /><p><span style=\\"color:#ff0000\\">2、如果您想支付50元、100元等大额，请您用您的V币帐户支付！</span></p><p><br /></p><img style=\\"border-bottom:#000000 0px solid;border-left:#000000 0px solid;width:588px;float:none;height:257px;border-top:#000000 0px solid;border-right:#000000 0px solid\\" title=\\"1.jpg\\" border=\\"0\\" src=\\"http://uploads.qq163.com/userup/1112/210145126237.jpg\\" /><br /><br />第四步：<br />1、如果您是电话直充小额支付，请拨打您所在区域的声讯电话号码。根据语音提示（提示流程说明）便可得到卡号和密码，然后进行支付。<br />2、如果您是V币帐户支付，则直接输入您的帐户信息，即可进行大额支付。<br /><img style=\\"border-bottom:#000 0px solid;border-left:#000 0px solid;float:none;border-top:#000 0px solid;border-right:#000 0px solid\\" title=\\"2.jpg\\" border=\\"0\\" src=\\"http://uploads.qq163.com/userup/1112/210146052938.jpg\\" /><br /><p><span style=\\"color:#ff0000\\">注：如果您不懂得您所在的区域的声讯号码，请查询：全国声讯电话号码查询</span><span style=\\"color:#ff0000\\">（点击您所在省份，即可）</span></p><p><img style=\\"border-bottom:#000 0px solid;border-left:#000 0px solid;float:none;border-top:#000 0px solid;border-right:#000 0px solid\\" title=\\"3.jpg\\" border=\\"0\\" src=\\"http://uploads.qq163.com/userup/1112/210147339363.jpg\\" /><br /></p><br />友情提示：<br />●由于服务提供商的不同，资费标准也可能不相同，请您拨打声讯电话前认真阅读相关说明。<br />●您在购买V币卡的过程中遇到问题可以拨<span style=\\"color:#ff0000\\"><span style=\\"color:#000000\\">打</span></span><strong><span style=\\"color:#ff0000\\">盈华讯方客服电话：0755-82126199</span></strong>进行咨询。<br /><br /></div><p>&nbsp;</p>', 22, 4, 1),
(39, '圆圆', 'black', '31玩小编', '', '还是很不错的', '31玩平台', 1, 1369226903, './Public/images/default.jpg', 0, 0, '<p style=\\"line-height:2em\\"><span style=\\"font-size:14px\\"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;人这一生要走很长很长的路，沿途必定要经过很多风景，其中当然不乏让你怦然心动的美丽风景。但你要清楚，不是所有你喜欢的风景都能属于你。有些风景，你只能是路过，只能是欣赏，然后，要毅然决然地继续向前，走自己的路。</strong></span></p><p style=\\"line-height:2em\\"><span style=\\"font-size:14px\\"><strong>　　&nbsp;也许，这是你第一次遇到这么美丽的风景，这里的鸟语花香、风和日丽让你产生了错觉，以为这就是你寻寻觅觅终于找到了的港湾，你想在这里放松身心、休养生息。</strong></span></p><p style=\\"line-height:2em\\"><span style=\\"font-size:14px\\"><strong>　　&nbsp;是的，这里曾给了你那么多的阳光那么多的美好那么多的快乐那么多的梦。但是，你没有想到，这里，也会有季节的变化，春天终究抵不过时间最残酷的脚步。萧瑟的秋风终于还是来了，它吹落了红的花，绿的叶，吹走了歌唱的鸟飞舞的蝶，也吹走了你心中的阳光。温暖渐渐离你远去。</strong></span></p><p>&nbsp;</p>', 253, 9, 0),
(38, 'XXXXXXXXXXXXXXXXXXXXXX', 'black', '小平', '龙将活动', 'CCCCCCC', '小平', 1, 1369225198, './Public/images/default.jpg', 1, 1, '<p>CCCCCCCCCCCCCCCCCCCC</p><p><br /></p><p>CCCCCCCCCCCCCCCCCCCCCCCCC</p><div><img src=\\"/Public/ueditor/themes/default/images/spacer.gif\\" word_img=\\"file:///C:\\\\Documents and Settings\\\\Administrator\\\\Application Data\\\\Tencent\\\\Users\\\\25203318\\\\QQ\\\\WinTemp\\\\RichOle\\\\T4OGC{NM)$5KM[6_H7M5$%0.jpg\\" style=\\"background:url(/public/ueditor/lang/zh-cn/images/localimage.png) no-repeat center center;border:1px solid #ddd\\" /><img src=\\"/Public/ueditor/php/../../upload/20130522/13692252553896.jpg\\" title=\\"idnHnvnHc4rHmLgp401timenHnvrj0sn1c4P6.jpg\\" /></div><p><br /></p>', 10040, 3, 0),
(18, '暗示法撒旦', 'black', '31玩小编', '', '的发生发的', '31玩平台', 0, 1365565023, './Public/images/default.jpg', 0, 1, '<p>31wan施工的非官方大哥</p>', 53, 7, 1),
(21, '测试二', 'black', '31玩小编', '', '测试', '31玩平台', 1, 1366602750, './Public/images/default.jpg', 1, 1, '<div style=\\"text-align:left;widows:2;text-transform:none;background-color:#ffffff;text-indent:30px;font:14px/24px arial, 宋体, sans-serif;orphans:2;letter-spacing:normal;color:#000000;word-spacing:0px;-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;margin-bottom:14px;\\" class=\\"para\\">从明天起，做一个幸福的人</div><div style=\\"text-align:left;widows:2;text-transform:none;background-color:#ffffff;text-indent:30px;font:14px/24px arial, 宋体, sans-serif;orphans:2;letter-spacing:normal;color:#000000;word-spacing:0px;-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;margin-bottom:14px;\\" class=\\"para\\">喂马，劈柴，周游世界</div><div style=\\"text-align:left;widows:2;text-transform:none;background-color:#ffffff;text-indent:30px;font:14px/24px arial, 宋体, sans-serif;orphans:2;letter-spacing:normal;color:#000000;word-spacing:0px;-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;margin-bottom:14px;\\" class=\\"para\\">从明天起，关心粮食和蔬菜</div><div style=\\"text-align:left;widows:2;text-transform:none;background-color:#ffffff;text-indent:30px;font:14px/24px arial, 宋体, sans-serif;orphans:2;letter-spacing:normal;color:#000000;word-spacing:0px;-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;margin-bottom:14px;\\" class=\\"para\\">我有一所房子，面朝大海，春暖花开</div><div style=\\"text-align:left;widows:2;text-transform:none;background-color:#ffffff;text-indent:30px;font:14px/24px arial, 宋体, sans-serif;orphans:2;letter-spacing:normal;color:#000000;word-spacing:0px;-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;margin-bottom:14px;\\" class=\\"para\\">从明天起，和每一个亲人通信</div><div style=\\"text-align:left;widows:2;text-transform:none;background-color:#ffffff;text-indent:30px;font:14px/24px arial, 宋体, sans-serif;orphans:2;letter-spacing:normal;color:#000000;word-spacing:0px;-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;margin-bottom:14px;\\" class=\\"para\\">告诉他们我的幸福</div><div style=\\"text-align:left;widows:2;text-transform:none;background-color:#ffffff;text-indent:30px;font:14px/24px arial, 宋体, sans-serif;orphans:2;letter-spacing:normal;color:#000000;word-spacing:0px;-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;margin-bottom:14px;\\" class=\\"para\\">那幸福的闪电告诉我的</div><div style=\\"text-align:left;widows:2;text-transform:none;background-color:#ffffff;text-indent:30px;font:14px/24px arial, 宋体, sans-serif;orphans:2;letter-spacing:normal;color:#000000;word-spacing:0px;-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;margin-bottom:14px;\\" class=\\"para\\">我将告诉每一个人</div><div style=\\"text-align:left;widows:2;text-transform:none;background-color:#ffffff;text-indent:30px;font:14px/24px arial, 宋体, sans-serif;orphans:2;letter-spacing:normal;color:#000000;word-spacing:0px;-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;margin-bottom:14px;\\" class=\\"para\\">给每一条河每一座山取一个温暖的名字</div><div style=\\"text-align:left;widows:2;text-transform:none;background-color:#ffffff;text-indent:30px;font:14px/24px arial, 宋体, sans-serif;orphans:2;letter-spacing:normal;color:#000000;word-spacing:0px;-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;margin-bottom:14px;\\" class=\\"para\\">陌生人，我也为你祝福</div><div style=\\"text-align:left;widows:2;text-transform:none;background-color:#ffffff;text-indent:30px;font:14px/24px arial, 宋体, sans-serif;orphans:2;letter-spacing:normal;color:#000000;word-spacing:0px;-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;margin-bottom:14px;\\" class=\\"para\\">愿你有一个灿烂的前程</div><div style=\\"text-align:left;widows:2;text-transform:none;background-color:#ffffff;text-indent:30px;font:14px/24px arial, 宋体, sans-serif;orphans:2;letter-spacing:normal;color:#000000;word-spacing:0px;-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;margin-bottom:14px;\\" class=\\"para\\">愿你有情人终成眷属</div><div style=\\"text-align:left;widows:2;text-transform:none;background-color:#ffffff;text-indent:30px;font:14px/24px arial, 宋体, sans-serif;orphans:2;letter-spacing:normal;color:#000000;word-spacing:0px;-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;margin-bottom:14px;\\" class=\\"para\\">愿你在尘世获得幸福</div><div style=\\"text-align:left;widows:2;text-transform:none;background-color:#ffffff;text-indent:30px;font:14px/24px arial, 宋体, sans-serif;orphans:2;letter-spacing:normal;color:#000000;word-spacing:0px;-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;margin-bottom:14px;\\" class=\\"para\\">我只愿面朝大海，春暖花开</div><p>&nbsp;</p>', 94, 8, 0),
(40, '图片', 'black', '31玩小编', '', '图片', '31玩平台', 0, 1369288935, './Public/images/default.jpg', 0, 0, '<p>31wan<img src="/Public/ueditor/php/../../upload/20130524/13693625501945.jpg" title="面朝大海.jpg" /> 面朝大海~~</p>', 69, 8, 0),
(42, '000', 'black', '31玩小编', '', '', '31玩平台', 0, 1369899041, './Public/images/default.jpg', 0, 0, '<p>31wan<img title=\\"zhaopian\\" src=\\"/Public/ueditor/php/../../upload/20130530/13698990984386.jpg\\" /></p>', 89, 7, 0),
(43, '111', 'black', '31玩小编', '', '', '31玩平台', 0, 1369899432, './Public/images/default.jpg', 0, 0, '<p><img src=\\"/Public/ueditor/php/../../upload/20130530/13698994719422.png\\" title=\\"00\\" />31wan</p>', 93, 7, 0),
(44, '222', 'black', '31玩小编', '', '', '31玩平台', 0, 1369899835, './Public/images/default.jpg', 0, 0, '<p><img title=\\"520\\" src=\\"/Public/ueditor/php/../../upload/20130530/13698998625885.png\\" /></p>', 139, 7, 0),
(45, '0123', 'black', '31玩小编', '', '', '31玩平台', 0, 1369902621, './Public/images/default.jpg', 0, 0, '<p><img title=\\"31wan1.png\\" src=\\"/Public/ueditor/php/../../upload/20130530/1369902632368.png\\" />31wan</p>', 138, 7, 0),
(46, '11111111111111111111', 'black', '31玩小编', '', '', '31玩平台', 0, 1370010177, './Public/images/default.jpg', 0, 0, '<p>31wan</p>', 30, 5, 0);

-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_card`
--

INSERT INTO `mygame_card` (`card`, `name`, `gid`, `sid`, `status`, `id`, `start_time`, `total`) VALUES
('00000000000009\r\n00000000000010\r\n00000000000011', '神魔仙界新手卡', 9, 0, 0, 24, 1365842880, 1),
('大法师打发', '新手卡2', 15, 0, 0, 23, 1364367240, 1),
('\n', '神魔新手卡2', 9, 7, 0, 28, 0, 1),
('打断施法速度', '新手卡1', 13, 0, 0, 21, 1364367180, 1),
('贾斯丁附加赛地方', '新手卡2', 14, 0, 0, 22, 1363935180, 1),
('我是不是', '理工菜鸟', 17, 0, 0, 27, 1366619520, 1);

-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_category`
--

INSERT INTO `mygame_category` (`typeid`, `typename`, `keywords`, `description`, `is_showdesc`, `html_file`, `ismenu`, `islink`, `url`, `target`, `drank`, `irank`, `fid`, `show`) VALUES
(1, '游戏大厅', '游戏大厅，聚集最好玩的游戏ccccccccccccc', '游戏大厅，聚集xcccc最好玩的游戏', 1, 'hall.html', 1, 1, '/hall/', 1, 2, 2, 0, 0),
(2, '用户中心', '用户中心', '用户中心', 0, '', 1, 1, '/members/', 1, 1, 1, 0, 0),
(3, '资讯中心', '资讯XXXXX', '资讯中心', 0, 'news.html', 1, 1, '/article/', 1, 2, 2, 0, 0),
(4, '充值中心', '充值hhh', '充值中心kkkkkkkkkkkkkkkkkkw', 0, 'pay.html', 1, 1, '/pay', 1, 3, 3, 0, 0),
(5, '客服中心', '客服', '客服中心', 0, 'service.html', 1, 1, '/service', 1, 2, 2, 7, 0),
(6, '游戏论坛', '游戏论坛', '游戏论坛', 1, '', 1, 1, 'http://bbs.31wan.cn', 0, 3, 3, 0, 0),
(7, '新闻', '', '', 0, '', 0, 0, '', 1, 10, 10, 3, 0),
(8, '活动', '', '', 0, '', 0, 0, '', 1, 10, 10, 7, 0),
(9, '热点', '', '', 0, '', 0, 0, '', 1, 10, 10, 3, 0),
(10, '常见问题', '常见问题', '常见问题', 0, '', 0, 0, '', 1, 10, 10, 3, 0);

-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_category_list`
--

INSERT INTO `mygame_category_list` (`id`, `category`, `module_alias`, `hidden`, `fid`, `listorder`) VALUES
(1, '全局配置', 'Global', 0, 0, 1),
(2, '推广管理', 'Channel', 0, 0, 2),
(3, '统计系统', 'Statistical', 0, 0, 3),
(4, '文章系统', 'Article', 0, 0, 4),
(5, '游戏管理', 'Game', 0, 0, 5),
(6, '充值管理', 'Pay', 0, 0, 6),
(7, '广告管理', 'Ad', 0, 0, 7),
(8, '拓展', 'Other', 0, 0, 9),
(9, '站点配置', 'siteconf', 0, 1, 0),
(11, '管理员管理', 'manager_list', 0, 1, 0),
(12, '角色管理', 'role_list', 0, 1, 0),
(13, '增加角色', 'role_add', 0, 1, 1),
(14, '添加管理员', 'manager_add', 0, 1, 1),
(15, '订单管理', 'pay_order_manager', 1, 6, 0),
(17, '编辑充值方式', 'edit_pay_type', 1, 6, 1),
(18, '更新充值方式', 'update_pay_type', 1, 6, 1),
(19, '充值查询(游戏币)', 'order', 0, 6, 0),
(20, '后台充值', 'budan', 0, 6, 0),
(21, '添加充值方式', 'pay_way_add', 0, 6, 0),
(22, '充值管理方式', 'manager_for_pay_way', 0, 6, 0),
(23, '添加处理方式', 'do_pay_way_add', 1, 6, 1),
(24, '保存图标', 'save_icon', 1, 6, 1),
(25, '充值到平台', 'pay_member_plf', 1, 6, 1),
(27, '栏目管理', 'category_index', 0, 4, 0),
(28, '增加栏目', 'category_add', 0, 4, 0),
(29, '增加栏目(add)', 'category_doadd', 1, 4, 1),
(30, '编辑栏目', 'category_edit', 1, 4, 1),
(31, '编辑栏目(操作)', 'doedit_cat', 1, 4, 1),
(32, '删除栏目', 'category_del', 1, 4, 1),
(33, '状态更新', 'category_status', 1, 4, 1),
(36, '推广查询', 'accounts_list ', 0, 2, 0),
(35, '推广对账', 'accounts_js', 0, 2, 0),
(37, '批量计算', 'accounts_pl', 1, 2, 1),
(38, '推广结算', 'accounts', 0, 2, 0),
(39, '推广用户管理', 'cpsmember_list', 0, 2, 0),
(40, '修改推广客户', 'cpsmember_edit', 1, 2, 1),
(41, '删除推广客户', 'cpsmember_delete', 1, 2, 1),
(42, ' 锁定用户', 'cpsmember_lock', 1, 2, 1),
(43, '解锁用户', 'cpsmember_unlock', 1, 2, 1),
(44, '外链管理', 'link_list', 0, 2, 0),
(45, '修改外链', 'link_edit', 1, 2, 1),
(46, '删除外链', 'link_delete', 1, 2, 1),
(47, '增加推广客户', 'add_cps', 0, 2, 0),
(48, '游戏管理', 'game_list', 0, 5, 0),
(49, '增加游戏', 'game_add ', 0, 5, 0),
(50, '修改游戏', 'game_edit', 1, 5, 1),
(51, ' 删除游戏', 'game_delete', 1, 5, 1),
(52, '服务器管理', 'server_list ', 0, 5, 0),
(53, ' 增加服务器', 'server_add', 0, 5, 0),
(54, '修改区服', 'server_edit', 1, 5, 1),
(55, '删除区服', 'server_delete', 1, 5, 1),
(56, '游戏类型管理', 'gametype_list', 0, 5, 0),
(57, '增加游戏类型', 'gametype_add', 0, 5, 0),
(58, '修改游戏类型', 'gametype_edit', 1, 5, 1),
(59, '删除游戏类型', 'gametype_delete ', 1, 5, 1),
(60, '新手卡管理', 'card_list', 0, 5, 0),
(61, '增加新手卡', 'card_add', 0, 5, 0),
(62, '新手卡修改', 'card_edit', 1, 5, 1),
(63, '新手卡删除', 'card_delete', 1, 5, 1),
(64, '网站统计', 'statistical_index', 0, 3, 0),
(65, '防沉迷管理', 'fcm_list', 0, 3, 0),
(66, '修改防沉迷', 'fcm_edit', 1, 3, 1),
(67, '批量修改防沉迷', 'fcm_batch', 1, 3, 1),
(68, '会员管理', 'member_list', 0, 3, 0),
(69, '修改会员', 'member_edit', 1, 3, 1),
(70, '删除会员', 'member_delete', 1, 3, 1),
(71, '锁定用户', 'member_lock ', 1, 3, 1),
(72, ' 解锁用户', 'member_unlock', 1, 3, 0),
(73, ' 游戏登录记录', 'game_log', 0, 3, 0),
(74, '删除登录 ', 'game_log_delete', 1, 3, 1),
(75, '友情链接', 'ad_link', 0, 7, 0),
(76, '添加友情链接', 'ad_linkadd', 0, 7, 0),
(77, '修改友情链接', 'ad_linkedit', 1, 7, 1),
(78, '删除友情链接', 'ad_linkdelete', 1, 7, 1),
(79, ' 广告管理', 'ad_index', 0, 7, 0),
(80, '增加广告', 'add', 0, 7, 1),
(152, '修改文章操作', 'doedit', 1, 4, 0),
(83, ' 删除', 'del', 1, 7, 1),
(154, '订单查看', 'order_info', 1, 6, 0),
(86, '文章管理', 'article_index', 0, 4, 0),
(87, '增加文章 ', 'add', 1, 4, 1),
(88, '增加', 'addop', 1, 4, 1),
(89, '修改', 'edit_art', 1, 4, 1),
(90, '修改', 'doedit_art', 1, 4, 1),
(91, '删除', 'del', 1, 4, 1),
(92, '状态', 'status ', 1, 4, 1),
(93, '删除', 'delall', 1, 4, 1),
(94, '移动', 'moveop ', 1, 4, 1),
(95, '跳转', 'jumpop', 1, 4, 1),
(96, '修改', 'editop', 1, 4, 1),
(97, '投票', 'vote', 1, 4, 1),
(98, 'url', 'urlmode', 1, 4, 1),
(99, '搜索', 'search ', 1, 4, 1),
(101, '删除栏目', 'del', 1, 4, 1),
(102, '状态更新', 'status', 1, 4, 1),
(103, '保存站点配置', 'save_basic', 1, 1, 1),
(104, '保存图标操作', 'save_icon', 1, 1, 1),
(105, '保存logo操作', 'save_logo', 1, 1, 1),
(129, '文章发布', 'add', 0, 4, 0),
(130, '文章发布操作', 'doadd', 1, 4, 1),
(131, '编辑角色', 'role_edit', 1, 1, 1),
(134, '广告编辑', 'edit', 1, 7, 1),
(133, '管理员编辑', 'manager_edit', 1, 1, 1),
(132, '删除角色', 'role_delete', 1, 1, 1),
(114, '数据库备份', 'index', 0, 8, 0),
(115, '数据库备份操作', 'dobackup', 1, 8, 1),
(116, '数据还原', 'restore', 0, 8, 0),
(117, '插入SQL', 'insertsql', 1, 8, 1),
(118, '数据库恢复', 'back', 1, 8, 1),
(119, '数据库下载', 'down', 1, 8, 1),
(120, '删除分卷', 'del', 1, 8, 1),
(121, '删除所有分卷', 'delall', 1, 8, 1),
(122, '上传备份文件', 'upload', 0, 8, 0),
(123, '执行上传', 'doupload', 1, 8, 1),
(124, '日志查看', 'log', 0, 8, 0),
(125, '删除日志', 'del_log', 1, 8, 1),
(126, '删除IP', 'del_ip', 1, 8, 1),
(127, '屏蔽IP', 'ip', 0, 8, 0),
(128, '添加IP', 'ip_add', 1, 8, 1),
(135, '后台充值管理', 'admin_pay', 0, 6, 0),
(136, '后台菜单', 'menu_list', 0, 8, 0),
(137, '增加栏目', 'menu_add', 1, 8, 1),
(138, '后台栏目排序', 'menu_listorders', 1, 8, 1),
(144, '订单查询(平台币)', 'order_plf', 0, 6, 0),
(140, '栏目修改', 'menu_edit', 1, 8, 1),
(143, '批量开启', 'fcm_open', 1, 3, 1),
(142, '栏目删除', 'menu_del', 1, 8, 1),
(146, '权限设置', 'role_priv', 1, 1, 1),
(147, '删除支付方式', 'del_pay', 1, 6, 0),
(148, '增加广告位', 'add_adwhere', 0, 7, 0),
(149, '广告位列表', 'adwhere_list', 0, 7, 0),
(150, '广告位修改', 'edit_adwhere', 1, 7, 0),
(151, '删除广告位', 'adwhere_delete', 1, 7, 0),
(155, '游戏补单', 'game_budan', 1, 6, 0),
(156, '订单删除', 'pay_order_del', 1, 6, 0),
(166, '删除管理员', 'manager_delete', 1, 1, 0),
(167, '文章修改', 'edit', 1, 4, 0);

-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_cps`
--


-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_game`
--

INSERT INTO `mygame_game` (`gid`, `game_starttime`, `sort`, `gamename`, `short`, `tag`, `gametype`, `gamepic`, `smallpic`, `ordinarypic`, `payto`, `content`, `ishot`, `game_web`, `game_bbs`, `game_guide`, `card`, `service`, `currency`, `addtime`, `game_hit`, `game_key`, `game_paykey`, `game_url`, `game_payurl`, `p_id`, `isdisplay`, `desc1`) VALUES
(9, 1360978027, 1, '神魔仙界', 'S', 'ce1', 1, '5170df8f590dd.jpg', '5146f390b2296.jpg', '514dbf9498f04.jpg', 10, '街机三国', 0, 'http://ngame.9157tuan.com/wangbacs/20073.html?subtype=001', 'http://ngame.9157tuan.com/wangbacs/20073.html?subtype=001', 'http://ngame.9157tuan.com/wangbacs/20073.html?subtype=001', '', '', '金币', 1360978027, 236931, '', 'fdfdf', 'fdf', 'adfasd', 0, 0, '神魔仙界是跨时代Q版MMORPG鼎力大作！'),
(10, 1360978064, 1, '倾世情缘', '', 'ce2', 1, '5146f40b34f3c.jpg', '5146f40b3751a.jpg', '', 10, '游戏测试278', 0, 'demo.31wam.cn', 'bbs.31wan.cn', 'dfdfdfdf', '', '', '元宝', 1360998552, 1, '', 'fdfdf', '', 'dasfsdf', 0, 0, '倾世情缘是一款Q版MMORPG回合制网页游戏鼎力大作！'),
(13, 1363604754, 1, '天行剑', 't', 'ce3', 1, '5146f588caded.jpg', '5146f539601af.jpg', '5146f54f13c1e.jpg', 10, '', 1, '', '', '', '', '', '', 1363604754, 1, '', '', '', '', 0, 0, '天行剑是一款以修真世题材即时战斗游戏！'),
(15, 1363605106, 1, '神将三国', '', '', 1, '5146f672c2a58.jpg', '5146f672c3fff.jpg', '5146f672c530d.jpg', 10, '', 1, '', '', '', '', '', '', 1363605106, 1, '', '', '', '', 0, 0, '神将三国是半即时横版玄幻页游大作！'),
(16, 1363605262, 1, '醉西游', '', '', 1, '5146f70e38374.jpg', '5146f70e39475.jpg', '5146f70e3a319.jpg', 10, '', 1, '', '', '', '', '', '', 1363605262, 1, '', '', '', '', 0, 0, '醉西游是年度最火爆Q版修仙类ARPG网页游戏！'),
(17, 1363605333, 1, '赤月', '', '', 1, '5146f7556bdb0.jpg', '5146f7556ce0b.jpg', '5146f7556ec81.jpg', 10, '', 0, '', '', '', '', '', '', 1363605333, 1, '', '', '', '', 0, 0, '赤月是一款万人攻城的传奇网页游戏！'),
(18, 1363605413, 1, '梦幻飞仙', '', '', 1, '5146f7a53ef09.jpg', '5146f7a53fe3a.jpg', '5146f7a540cfc.jpg', 10, '', 1, '', '', '', '', '', '', 1363605413, 1, '', '', '', '', 0, 0, '梦幻飞仙是划时代Q版MMORPG网页游戏！'),
(36, 1366968005, 1, '街机三国', '', '', 1, '', '', '', 10, '街机三国', 1, '', '', '', '', '', '', 1366968005, 1, '', '', '', '', 0, 0, '街机三国'),
(44, 1370441855, 1, '测试三国888', '', '', 1, '', '', '', 10, '测试三国888', 1, 'http://s1.sglj.aibu99.com/', 'http://s1.sglj.aibu99.com/', 'http://s1.sglj.aibu99.com/', '', '', '云豹', 1370441855, 1, 'sZkMrDzpEfen2ScJxhIg', 'qOgBGAbJCqRC5bFxGkJ0', 'http://s1.sglj.aibu99.com/', '', 0, 0, '测试三国888'),
(45, 1370055240, 1, '烈火战神啊', 'L', 'lhzsa', 1, '', '', '', 10, '烈火战神啊', 1, '', '', '', '', '', '', 1372474480, 1, '', '', '', '', 0, 0, '烈火战神啊'),
(43, 1369107120, 1, '好游戏', '', '', 1, '', '', '', 10, '313123131231231', 0, 'hall/server_list?gid=9', '3123123', '12312', '', '', '123', 1369020765, 11, '', '', '', '', 0, 0, '13211'),
(46, 1378101840, 1, '百度游戏', 'b', 's', 1, '5237f222ca9f3.jpg', '5237f222cad2b.jpg', '5237f222cafea.jpg', 10, '三三四四', 0, 'http://www.baidu.com', 'http://www.baidu.com', 'http://www.baidu.com', '', '', '元宝/金币', 1379398178, 10, '1', '21', '1', '', 1, 0, '呵呵');

-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_gametype`
--

INSERT INTO `mygame_gametype` (`id`, `typename`) VALUES
(1, '角色扮演'),
(2, '动作冒险'),
(3, '社区养成'),
(4, '战国'),
(11, '经营策略'),
(15, 'RPG'),
(18, 'rpg');

-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_game_log`
--


-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_link`
--

INSERT INTO `mygame_link` (`linkid`, `linktype`, `name`, `url`, `logo`, `introduce`, `username`, `listorder`, `elite`, `passed`, `addtime`) VALUES
(16, 0, '31wan', 'http://demo.31wan.cn', '', 'er', 'wan', 0, 1, 0, 1366613354),
(23, 0, '腾讯', 'www.qq.com', '', '', '', 0, 0, 0, 1367569000),
(25, 0, 'A5站长网', 'http://www.admin5.net/thread-13202014-1-1.html', '', '', '', 0, 0, 1, 1376457232),
(24, 0, '17173', 'www.17173.com', '', '17173', '17173', 1, 1, 1, 1370674424);

-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_manager`
--

INSERT INTO `mygame_manager` (`uid`, `username`, `password`, `roleid`, `login_ip`, `os`, `login_time`, `login_count`, `status`, `email`) VALUES
(1, 'admin', '09b030479dc266aaa457a13b6034cd73', 1, '122.194.179.34', 'Windows XP', 1379812167, 876, 0, 'shnb1sd3@153.com'),
(4, 'demo', '3bf152dc5cf5f5be3ab97170a238b6db', 11, '180.106.87.55', 'Windows NT', 1379758888, 1165, 0, 'asdas@qq.c');

-- --------------------------------------------------------




--
-- 转存表中的数据 `mygame_menu`
--

INSERT INTO `mygame_menu` (`id`, `name`, `zh_name`, `m`, `c`, `a`, `data`, `listorder`, `display`, `parentid`) VALUES
(1, 'Global', '全局配置', '', '', '', '', 0, '1', 0),
(2, 'Statistical', '统计系统', '', '', '', '', 0, '1', 0),
(3, 'Article', '文章管理', '', '', '', '', 0, '1', 0),
(4, 'siteconf', '站点配置', '', '', '', '', 0, '1', 1);

-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_pay_ok`
--


-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_pay_type`
--

INSERT INTO `mygame_pay_type` (`id`, `sort`, `tag`, `payname`, `pic`, `icon`, `fee`, `rebate`, `content`, `extend`, `target`, `addtime`, `modifytime`, `isdisplay`, `status`, `operater`, `account`, `key`) VALUES
(11, 2, 'yeepay', '易宝充值', NULL, 'http://demo.31wan.cn/Public/Uploads/icon/519ccaf8c5aa0.png', '90', 10, '方便快捷', NULL, '_self', 1369230077, 1369232893, 1, 1, 'admin', '10001126856', '69cl522AV6q613Ii4W6u8K6XuW8vM1N6bFgyv769220IuYe9u37N4y7rI4Pl'),
(6, 6, 'JUNNET', '骏网一卡通', NULL, 'http://demo.31wan.cn/app/Tpl/default/images/payway/20120807054511_43121.png', '80', 0, '易宝骏网一卡通充值', NULL, '_self', 1361864590, 1366770891, 1, 1, 'admin', '', ''),
(9, 1, 'alipay', '支付宝', NULL, 'http://demo.31wan.cn/Public/Uploads/icon/51750fda3192f.png', '100', 0, '踩踩踩', NULL, '_self', 1366626329, NULL, 1, 1, 'admin', '', '');

-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_role_access`
--

INSERT INTO `mygame_role_access` (`role_id`, `access_id`, `access_fid`, `parent_module_alias`, `parent_module`, `module`, `access_name`) VALUES
(15, '129', 4, '文章系统', 'Article', '文章发布', 'add'),
(15, '102', 4, '文章系统', 'Article', '状态更新', 'status'),
(15, '101', 4, '文章系统', 'Article', '删除栏目', 'del'),
(15, '99', 4, '文章系统', 'Article', '搜索', 'search '),
(15, '98', 4, '文章系统', 'Article', 'url', 'urlmode'),
(15, '97', 4, '文章系统', 'Article', '投票', 'vote'),
(11, '124', 8, '拓展', 'Other', '日志查看', 'log'),
(11, '114', 8, '拓展', 'Other', '数据库备份', 'index'),
(6, '134', 7, '广告管理', 'Ad', '广告编辑', 'edit'),
(6, '83', 7, '广告管理', 'Ad', ' 删除', 'del'),
(6, '79', 7, '广告管理', 'Ad', ' 广告管理', 'ad_index'),
(6, '77', 7, '广告管理', 'Ad', '修改友情链接', 'ad_linkedit'),
(6, '75', 7, '广告管理', 'Ad', '友情链接', 'ad_link'),
(6, '7', 0, '广告管理', '', '广告管理', 'Ad'),
(6, '155', 6, '充值管理', 'Pay', '游戏补单', 'game_budan'),
(6, '154', 6, '充值管理', 'Pay', '订单查看', 'order_info'),
(6, '144', 6, '充值管理', 'Pay', '订单查询(平台币)', 'order_plf'),
(6, '25', 6, '充值管理', 'Pay', '充值到平台', 'pay_member_plf'),
(6, '19', 6, '充值管理', 'Pay', '充值查询(游戏币)', 'order'),
(6, '6', 0, '充值管理', '', '充值管理', 'Pay'),
(6, '52', 5, '游戏管理', 'Game', '服务器管理', 'server_list '),
(6, '5', 0, '游戏管理', '', '游戏管理', 'Game'),
(6, '9', 1, '全局配置', 'Global', '站点配置', 'siteconf'),
(6, '1', 0, '全局配置', '', '全局配置', 'Global'),
(8, '64', 3, '统计系统', 'Statistical', '网站统计', 'statistical_index'),
(8, '3', 0, '统计系统', '', '统计系统', 'Statistical'),
(8, '35', 2, '推广管理', 'Channel', '推广计算', 'accounts_js'),
(8, '2', 0, '推广管理', '', '推广管理', 'Channel'),
(8, '9', 1, '全局配置', 'Global', '站点配置', 'siteconf'),
(8, '1', 0, '全局配置', '', '全局配置', 'Global'),
(15, '96', 4, '文章系统', 'Article', '修改', 'editop'),
(1, '135', 6, '充值管理', 'Pay', '后台充值管理', 'admin_pay'),
(15, '95', 4, '文章系统', 'Article', '跳转', 'jumpop'),
(1, '25', 6, '充值管理', 'Pay', '充值到平台', 'pay_member_plf'),
(1, '24', 6, '充值管理', 'Pay', '保存图标', 'save_icon'),
(1, '23', 6, '充值管理', 'Pay', '添加处理方式', 'do_pay_way_add'),
(1, '22', 6, '充值管理', 'Pay', '充值管理方式', 'manager_for_pay_way'),
(1, '21', 6, '充值管理', 'Pay', '添加充值方式', 'pay_way_add'),
(1, '20', 6, '充值管理', 'Pay', '后台充值', 'budan'),
(1, '19', 6, '充值管理', 'Pay', '充值查询(游戏币)', 'order'),
(1, '18', 6, '充值管理', 'Pay', '更新充值方式', 'update_pay_type'),
(1, '17', 6, '充值管理', 'Pay', '编辑充值方式', 'edit_pay_type'),
(1, '15', 6, '充值管理', 'Pay', '订单管理', 'pay_order_manager'),
(1, '6', 0, '充值管理', '', '充值管理', 'Pay'),
(1, '63', 5, '游戏管理', 'Game', '新手卡删除', 'card_delete'),
(1, '62', 5, '游戏管理', 'Game', '新手卡修改', 'card_edit'),
(1, '61', 5, '游戏管理', 'Game', '增加新手卡', 'card_add'),
(1, '60', 5, '游戏管理', 'Game', '新手卡管理', 'card_list'),
(1, '59', 5, '游戏管理', 'Game', '删除游戏类型', 'gametype_delete '),
(1, '58', 5, '游戏管理', 'Game', '修改游戏类型', 'gametype_edit'),
(1, '57', 5, '游戏管理', 'Game', '增加游戏类型', 'gametype_add'),
(1, '56', 5, '游戏管理', 'Game', '游戏类型管理', 'gametype_list'),
(1, '55', 5, '游戏管理', 'Game', '删除区服', 'server_delete'),
(1, '54', 5, '游戏管理', 'Game', '修改区服', 'server_edit'),
(1, '53', 5, '游戏管理', 'Game', ' 增加服务器', 'server_add'),
(1, '52', 5, '游戏管理', 'Game', '服务器管理', 'server_list '),
(1, '51', 5, '游戏管理', 'Game', ' 删除游戏', 'game_delete'),
(1, '50', 5, '游戏管理', 'Game', '修改游戏', 'game_edit'),
(1, '49', 5, '游戏管理', 'Game', '增加游戏', 'game_add '),
(1, '48', 5, '游戏管理', 'Game', '游戏管理', 'game_list'),
(1, '5', 0, '游戏管理', '', '游戏管理', 'Game'),
(1, '167', 4, '文章系统', 'Article', '文章修改', 'edit'),
(1, '152', 4, '文章系统', 'Article', '修改文章操作', 'doedit'),
(1, '130', 4, '文章系统', 'Article', '文章发布操作', 'doadd'),
(1, '129', 4, '文章系统', 'Article', '文章发布', 'add'),
(1, '102', 4, '文章系统', 'Article', '状态更新', 'status'),
(1, '101', 4, '文章系统', 'Article', '删除栏目', 'del'),
(1, '99', 4, '文章系统', 'Article', '搜索', 'search '),
(1, '98', 4, '文章系统', 'Article', 'url', 'urlmode'),
(1, '97', 4, '文章系统', 'Article', '投票', 'vote'),
(1, '96', 4, '文章系统', 'Article', '修改', 'editop'),
(1, '95', 4, '文章系统', 'Article', '跳转', 'jumpop'),
(1, '94', 4, '文章系统', 'Article', '移动', 'moveop '),
(1, '93', 4, '文章系统', 'Article', '删除', 'delall'),
(1, '92', 4, '文章系统', 'Article', '状态', 'status '),
(1, '91', 4, '文章系统', 'Article', '删除', 'del'),
(1, '90', 4, '文章系统', 'Article', '修改', 'doedit_art'),
(1, '89', 4, '文章系统', 'Article', '修改', 'edit_art'),
(1, '88', 4, '文章系统', 'Article', '增加', 'addop'),
(1, '87', 4, '文章系统', 'Article', '增加文章 ', 'add'),
(1, '86', 4, '文章系统', 'Article', '文章管理', 'article_index'),
(1, '33', 4, '文章系统', 'Article', '状态更新', 'category_status'),
(1, '32', 4, '文章系统', 'Article', '删除栏目', 'category_del'),
(1, '31', 4, '文章系统', 'Article', '编辑栏目(操作)', 'doedit_cat'),
(1, '30', 4, '文章系统', 'Article', '编辑栏目', 'category_edit'),
(1, '29', 4, '文章系统', 'Article', '增加栏目(add)', 'category_doadd'),
(1, '28', 4, '文章系统', 'Article', '增加栏目', 'category_add'),
(1, '27', 4, '文章系统', 'Article', '栏目管理', 'category_index'),
(1, '4', 0, '文章系统', '', '文章系统', 'Article'),
(1, '143', 3, '统计系统', 'Statistical', '批量开启', 'fcm_open'),
(1, '74', 3, '统计系统', 'Statistical', '删除登录 ', 'game_log_delete'),
(1, '73', 3, '统计系统', 'Statistical', ' 游戏登录记录', 'game_log'),
(1, '72', 3, '统计系统', 'Statistical', ' 解锁用户', 'member_unlock'),
(1, '71', 3, '统计系统', 'Statistical', '锁定用户', 'member_lock '),
(1, '70', 3, '统计系统', 'Statistical', '删除会员', 'member_delete'),
(5, '1', 0, '全局配置', '', '全局配置', 'Global'),
(5, '9', 1, '全局配置', 'Global', '站点配置', 'siteconf'),
(5, '2', 0, '推广管理', '', '推广管理', 'Channel'),
(5, '35', 2, '推广管理', 'Channel', '推广对账', 'accounts_js'),
(5, '36', 2, '推广管理', 'Channel', '推广查询', 'accounts_list '),
(5, '37', 2, '推广管理', 'Channel', '批量计算', 'accounts_pl'),
(5, '38', 2, '推广管理', 'Channel', '推广结算', 'accounts'),
(5, '39', 2, '推广管理', 'Channel', '推广用户管理', 'cpsmember_list'),
(5, '40', 2, '推广管理', 'Channel', '修改推广客户', 'cpsmember_edit'),
(5, '42', 2, '推广管理', 'Channel', ' 锁定用户', 'cpsmember_lock'),
(5, '43', 2, '推广管理', 'Channel', '解锁用户', 'cpsmember_unlock'),
(5, '44', 2, '推广管理', 'Channel', '外链管理', 'link_list'),
(5, '45', 2, '推广管理', 'Channel', '修改外链', 'link_edit'),
(5, '46', 2, '推广管理', 'Channel', '删除外链', 'link_delete'),
(5, '47', 2, '推广管理', 'Channel', '增加推广客户', 'add_cps'),
(5, '3', 0, '统计系统', '', '统计系统', 'Statistical'),
(5, '64', 3, '统计系统', 'Statistical', '网站统计', 'statistical_index'),
(5, '65', 3, '统计系统', 'Statistical', '防沉迷管理', 'fcm_list'),
(5, '66', 3, '统计系统', 'Statistical', '修改防沉迷', 'fcm_edit'),
(5, '67', 3, '统计系统', 'Statistical', '批量修改防沉迷', 'fcm_batch'),
(5, '68', 3, '统计系统', 'Statistical', '会员管理', 'member_list'),
(5, '69', 3, '统计系统', 'Statistical', '修改会员', 'member_edit'),
(5, '71', 3, '统计系统', 'Statistical', '锁定用户', 'member_lock '),
(5, '72', 3, '统计系统', 'Statistical', ' 解锁用户', 'member_unlock'),
(5, '73', 3, '统计系统', 'Statistical', ' 游戏登录记录', 'game_log'),
(5, '143', 3, '统计系统', 'Statistical', '批量开启', 'fcm_open'),
(5, '4', 0, '文章系统', '', '文章系统', 'Article'),
(5, '86', 4, '文章系统', 'Article', '文章管理', 'article_index'),
(5, '87', 4, '文章系统', 'Article', '增加文章 ', 'add'),
(5, '88', 4, '文章系统', 'Article', '增加', 'addop'),
(5, '89', 4, '文章系统', 'Article', '修改', 'edit_art'),
(5, '90', 4, '文章系统', 'Article', '修改', 'doedit_art'),
(5, '91', 4, '文章系统', 'Article', '删除', 'del'),
(5, '92', 4, '文章系统', 'Article', '状态', 'status '),
(5, '93', 4, '文章系统', 'Article', '删除', 'delall'),
(5, '94', 4, '文章系统', 'Article', '移动', 'moveop '),
(5, '95', 4, '文章系统', 'Article', '跳转', 'jumpop'),
(5, '96', 4, '文章系统', 'Article', '修改', 'editop'),
(5, '97', 4, '文章系统', 'Article', '投票', 'vote'),
(5, '98', 4, '文章系统', 'Article', 'url', 'urlmode'),
(5, '99', 4, '文章系统', 'Article', '搜索', 'search '),
(5, '129', 4, '文章系统', 'Article', '文章发布', 'add'),
(5, '130', 4, '文章系统', 'Article', '文章发布操作', 'doadd'),
(5, '5', 0, '游戏管理', '', '游戏管理', 'Game'),
(5, '48', 5, '游戏管理', 'Game', '游戏管理', 'game_list'),
(5, '49', 5, '游戏管理', 'Game', '增加游戏', 'game_add '),
(5, '50', 5, '游戏管理', 'Game', '修改游戏', 'game_edit'),
(5, '51', 5, '游戏管理', 'Game', ' 删除游戏', 'game_delete'),
(5, '52', 5, '游戏管理', 'Game', '服务器管理', 'server_list '),
(5, '53', 5, '游戏管理', 'Game', ' 增加服务器', 'server_add'),
(5, '54', 5, '游戏管理', 'Game', '修改区服', 'server_edit'),
(5, '55', 5, '游戏管理', 'Game', '删除区服', 'server_delete'),
(5, '56', 5, '游戏管理', 'Game', '游戏类型管理', 'gametype_list'),
(5, '57', 5, '游戏管理', 'Game', '增加游戏类型', 'gametype_add'),
(5, '58', 5, '游戏管理', 'Game', '修改游戏类型', 'gametype_edit'),
(5, '59', 5, '游戏管理', 'Game', '删除游戏类型', 'gametype_delete '),
(5, '60', 5, '游戏管理', 'Game', '新手卡管理', 'card_list'),
(5, '61', 5, '游戏管理', 'Game', '增加新手卡', 'card_add'),
(5, '62', 5, '游戏管理', 'Game', '新手卡修改', 'card_edit'),
(5, '63', 5, '游戏管理', 'Game', '新手卡删除', 'card_delete'),
(5, '6', 0, '充值管理', '', '充值管理', 'Pay'),
(5, '15', 6, '充值管理', 'Pay', '订单管理', 'pay_order_manager'),
(5, '17', 6, '充值管理', 'Pay', '编辑充值方式', 'edit_pay_type'),
(5, '18', 6, '充值管理', 'Pay', '更新充值方式', 'update_pay_type'),
(5, '19', 6, '充值管理', 'Pay', '充值查询(游戏币)', 'order'),
(5, '20', 6, '充值管理', 'Pay', '后台充值', 'budan'),
(5, '21', 6, '充值管理', 'Pay', '添加充值方式', 'pay_way_add'),
(5, '22', 6, '充值管理', 'Pay', '充值管理方式', 'manager_for_pay_way'),
(5, '23', 6, '充值管理', 'Pay', '添加处理方式', 'do_pay_way_add'),
(5, '24', 6, '充值管理', 'Pay', '保存图标', 'save_icon'),
(5, '25', 6, '充值管理', 'Pay', '充值到平台', 'pay_member_plf'),
(5, '135', 6, '充值管理', 'Pay', '后台充值管理', 'admin_pay'),
(5, '144', 6, '充值管理', 'Pay', '订单查询(平台币)', 'order_plf'),
(5, '7', 0, '广告管理', '', '广告管理', 'Ad'),
(5, '75', 7, '广告管理', 'Ad', '友情链接', 'ad_link'),
(5, '76', 7, '广告管理', 'Ad', '添加友情链接', 'ad_linkadd'),
(5, '77', 7, '广告管理', 'Ad', '修改友情链接', 'ad_linkedit'),
(5, '78', 7, '广告管理', 'Ad', '删除友情链接', 'ad_linkdelete'),
(5, '79', 7, '广告管理', 'Ad', ' 广告管理', 'ad_index'),
(5, '80', 7, '广告管理', 'Ad', '增加', 'add'),
(5, '81', 7, '广告管理', 'Ad', '修改操作 ', 'doedit'),
(5, '82', 7, '广告管理', 'Ad', '增加操作', 'doadd'),
(5, '83', 7, '广告管理', 'Ad', ' 删除', 'del'),
(5, '84', 7, '广告管理', 'Ad', '状态', 'status'),
(5, '85', 7, '广告管理', 'Ad', '批量修改', 'delall'),
(5, '134', 7, '广告管理', 'Ad', '广告编辑', 'edit'),
(5, '8', 0, '拓展', '', '拓展', 'Other'),
(5, '114', 8, '拓展', 'Other', '数据库备份', 'index'),
(5, '115', 8, '拓展', 'Other', '数据库备份操作', 'dobackup'),
(5, '124', 8, '拓展', 'Other', '日志查看', 'log'),
(5, '128', 8, '拓展', 'Other', '添加IP', 'ip_add'),
(5, '136', 8, '拓展', 'Other', '后台菜单', 'menu_list'),
(5, '138', 8, '拓展', 'Other', '后台栏目排序', 'menu_listorders'),
(5, '16', 0, '栏目管理', '', '栏目管理', 'Category'),
(5, '27', 16, '栏目管理', 'Category', '栏目管理', 'category_index'),
(1, '69', 3, '统计系统', 'Statistical', '修改会员', 'member_edit'),
(1, '68', 3, '统计系统', 'Statistical', '会员管理', 'member_list'),
(1, '67', 3, '统计系统', 'Statistical', '批量修改防沉迷', 'fcm_batch'),
(1, '66', 3, '统计系统', 'Statistical', '修改防沉迷', 'fcm_edit'),
(1, '65', 3, '统计系统', 'Statistical', '防沉迷管理', 'fcm_list'),
(1, '64', 3, '统计系统', 'Statistical', '网站统计', 'statistical_index'),
(1, '3', 0, '统计系统', '', '统计系统', 'Statistical'),
(1, '47', 2, '推广管理', 'Channel', '增加推广客户', 'add_cps'),
(1, '46', 2, '推广管理', 'Channel', '删除外链', 'link_delete'),
(1, '45', 2, '推广管理', 'Channel', '修改外链', 'link_edit'),
(1, '44', 2, '推广管理', 'Channel', '外链管理', 'link_list'),
(1, '43', 2, '推广管理', 'Channel', '解锁用户', 'cpsmember_unlock'),
(1, '42', 2, '推广管理', 'Channel', ' 锁定用户', 'cpsmember_lock'),
(1, '41', 2, '推广管理', 'Channel', '删除推广客户', 'cpsmember_delete'),
(1, '40', 2, '推广管理', 'Channel', '修改推广客户', 'cpsmember_edit'),
(1, '39', 2, '推广管理', 'Channel', '推广用户管理', 'cpsmember_list'),
(1, '38', 2, '推广管理', 'Channel', '推广结算', 'accounts'),
(1, '37', 2, '推广管理', 'Channel', '批量计算', 'accounts_pl'),
(1, '36', 2, '推广管理', 'Channel', '推广查询', 'accounts_list '),
(1, '35', 2, '推广管理', 'Channel', '推广对账', 'accounts_js'),
(1, '2', 0, '推广管理', '', '推广管理', 'Channel'),
(1, '166', 1, '全局配置', 'Global', '删除管理员', 'manager_delete'),
(1, '146', 1, '全局配置', 'Global', '权限设置', 'role_priv'),
(1, '133', 1, '全局配置', 'Global', '管理员编辑', 'manager_edit'),
(1, '132', 1, '全局配置', 'Global', '删除角色', 'role_delete'),
(1, '131', 1, '全局配置', 'Global', '编辑角色', 'role_edit'),
(1, '105', 1, '全局配置', 'Global', '保存logo操作', 'save_logo'),
(1, '104', 1, '全局配置', 'Global', '保存图标操作', 'save_icon'),
(1, '103', 1, '全局配置', 'Global', '保存站点配置', 'save_basic'),
(1, '14', 1, '全局配置', 'Global', '添加管理员', 'manager_add'),
(1, '13', 1, '全局配置', 'Global', '增加角色', 'role_add'),
(1, '12', 1, '全局配置', 'Global', '角色管理', 'role_list'),
(11, '8', 0, '拓展', '', '拓展', 'Other'),
(11, '150', 7, '广告管理', 'Ad', '广告位修改', 'edit_adwhere'),
(11, '151', 7, '广告管理', 'Ad', '删除广告位', 'adwhere_delete'),
(7, '28', 4, '文章系统', 'Article', '增加栏目', 'category_add'),
(7, '4', 0, '文章系统', '', '文章系统', 'Article'),
(7, '2', 0, '推广管理', '', '推广管理', 'Channel'),
(7, '1', 0, '全局配置', '', '全局配置', 'Global'),
(11, '149', 7, '广告管理', 'Ad', '广告位列表', 'adwhere_list'),
(11, '134', 7, '广告管理', 'Ad', '广告编辑', 'edit'),
(11, '148', 7, '广告管理', 'Ad', '增加广告位', 'add_adwhere'),
(11, '83', 7, '广告管理', 'Ad', ' 删除', 'del'),
(11, '80', 7, '广告管理', 'Ad', '增加广告', 'add'),
(11, '78', 7, '广告管理', 'Ad', '删除友情链接', 'ad_linkdelete'),
(11, '79', 7, '广告管理', 'Ad', ' 广告管理', 'ad_index'),
(11, '76', 7, '广告管理', 'Ad', '添加友情链接', 'ad_linkadd'),
(11, '77', 7, '广告管理', 'Ad', '修改友情链接', 'ad_linkedit'),
(1, '11', 1, '全局配置', 'Global', '管理员管理', 'manager_list'),
(1, '9', 1, '全局配置', 'Global', '站点配置', 'siteconf'),
(1, '1', 0, '全局配置', '', '全局配置', 'Global'),
(11, '7', 0, '广告管理', '', '广告管理', 'Ad'),
(11, '75', 7, '广告管理', 'Ad', '友情链接', 'ad_link'),
(11, '156', 6, '充值管理', 'Pay', '订单删除', 'pay_order_del'),
(11, '155', 6, '充值管理', 'Pay', '游戏补单', 'game_budan'),
(11, '25', 6, '充值管理', 'Pay', '充值到平台', 'pay_member_plf'),
(11, '154', 6, '充值管理', 'Pay', '订单查看', 'order_info'),
(11, '144', 6, '充值管理', 'Pay', '订单查询(平台币)', 'order_plf'),
(11, '135', 6, '充值管理', 'Pay', '后台充值管理', 'admin_pay'),
(11, '24', 6, '充值管理', 'Pay', '保存图标', 'save_icon'),
(11, '22', 6, '充值管理', 'Pay', '充值管理方式', 'manager_for_pay_way'),
(11, '20', 6, '充值管理', 'Pay', '后台充值', 'budan'),
(11, '19', 6, '充值管理', 'Pay', '充值查询(游戏币)', 'order'),
(11, '15', 6, '充值管理', 'Pay', '订单管理', 'pay_order_manager'),
(11, '6', 0, '充值管理', '', '充值管理', 'Pay'),
(11, '62', 5, '游戏管理', 'Game', '新手卡修改', 'card_edit'),
(11, '63', 5, '游戏管理', 'Game', '新手卡删除', 'card_delete'),
(11, '60', 5, '游戏管理', 'Game', '新手卡管理', 'card_list'),
(11, '61', 5, '游戏管理', 'Game', '增加新手卡', 'card_add'),
(11, '58', 5, '游戏管理', 'Game', '修改游戏类型', 'gametype_edit'),
(11, '59', 5, '游戏管理', 'Game', '删除游戏类型', 'gametype_delete '),
(11, '57', 5, '游戏管理', 'Game', '增加游戏类型', 'gametype_add'),
(11, '56', 5, '游戏管理', 'Game', '游戏类型管理', 'gametype_list'),
(11, '55', 5, '游戏管理', 'Game', '删除区服', 'server_delete'),
(11, '54', 5, '游戏管理', 'Game', '修改区服', 'server_edit'),
(11, '53', 5, '游戏管理', 'Game', ' 增加服务器', 'server_add'),
(11, '52', 5, '游戏管理', 'Game', '服务器管理', 'server_list '),
(11, '51', 5, '游戏管理', 'Game', ' 删除游戏', 'game_delete'),
(11, '50', 5, '游戏管理', 'Game', '修改游戏', 'game_edit'),
(11, '49', 5, '游戏管理', 'Game', '增加游戏', 'game_add '),
(11, '48', 5, '游戏管理', 'Game', '游戏管理', 'game_list'),
(11, '152', 4, '文章系统', 'Article', '修改文章操作', 'doedit'),
(11, '129', 4, '文章系统', 'Article', '文章发布', 'add'),
(11, '5', 0, '游戏管理', '', '游戏管理', 'Game'),
(11, '130', 4, '文章系统', 'Article', '文章发布操作', 'doadd'),
(11, '102', 4, '文章系统', 'Article', '状态更新', 'status'),
(11, '101', 4, '文章系统', 'Article', '删除栏目', 'del'),
(11, '99', 4, '文章系统', 'Article', '搜索', 'search '),
(11, '98', 4, '文章系统', 'Article', 'url', 'urlmode'),
(11, '97', 4, '文章系统', 'Article', '投票', 'vote'),
(11, '96', 4, '文章系统', 'Article', '修改', 'editop'),
(11, '95', 4, '文章系统', 'Article', '跳转', 'jumpop'),
(11, '94', 4, '文章系统', 'Article', '移动', 'moveop '),
(11, '93', 4, '文章系统', 'Article', '删除', 'delall'),
(11, '92', 4, '文章系统', 'Article', '状态', 'status '),
(11, '91', 4, '文章系统', 'Article', '删除', 'del'),
(11, '90', 4, '文章系统', 'Article', '修改', 'doedit_art'),
(11, '89', 4, '文章系统', 'Article', '修改', 'edit_art'),
(11, '88', 4, '文章系统', 'Article', '增加', 'addop'),
(11, '87', 4, '文章系统', 'Article', '增加文章 ', 'add'),
(11, '86', 4, '文章系统', 'Article', '文章管理', 'article_index'),
(11, '33', 4, '文章系统', 'Article', '状态更新', 'category_status'),
(11, '31', 4, '文章系统', 'Article', '编辑栏目(操作)', 'doedit_cat'),
(11, '30', 4, '文章系统', 'Article', '编辑栏目', 'category_edit'),
(11, '29', 4, '文章系统', 'Article', '增加栏目(add)', 'category_doadd'),
(11, '27', 4, '文章系统', 'Article', '栏目管理', 'category_index'),
(11, '4', 0, '文章系统', '', '文章系统', 'Article'),
(11, '143', 3, '统计系统', 'Statistical', '批量开启', 'fcm_open'),
(11, '74', 3, '统计系统', 'Statistical', '删除登录 ', 'game_log_delete'),
(11, '73', 3, '统计系统', 'Statistical', ' 游戏登录记录', 'game_log'),
(11, '72', 3, '统计系统', 'Statistical', ' 解锁用户', 'member_unlock'),
(11, '71', 3, '统计系统', 'Statistical', '锁定用户', 'member_lock '),
(11, '69', 3, '统计系统', 'Statistical', '修改会员', 'member_edit'),
(11, '68', 3, '统计系统', 'Statistical', '会员管理', 'member_list'),
(11, '67', 3, '统计系统', 'Statistical', '批量修改防沉迷', 'fcm_batch'),
(11, '66', 3, '统计系统', 'Statistical', '修改防沉迷', 'fcm_edit'),
(11, '65', 3, '统计系统', 'Statistical', '防沉迷管理', 'fcm_list'),
(11, '64', 3, '统计系统', 'Statistical', '网站统计', 'statistical_index'),
(11, '46', 2, '推广管理', 'Channel', '删除外链', 'link_delete'),
(11, '47', 2, '推广管理', 'Channel', '增加推广客户', 'add_cps'),
(11, '3', 0, '统计系统', '', '统计系统', 'Statistical'),
(11, '45', 2, '推广管理', 'Channel', '修改外链', 'link_edit'),
(11, '42', 2, '推广管理', 'Channel', ' 锁定用户', 'cpsmember_lock'),
(11, '43', 2, '推广管理', 'Channel', '解锁用户', 'cpsmember_unlock'),
(11, '44', 2, '推广管理', 'Channel', '外链管理', 'link_list'),
(11, '41', 2, '推广管理', 'Channel', '删除推广客户', 'cpsmember_delete'),
(11, '39', 2, '推广管理', 'Channel', '推广用户管理', 'cpsmember_list'),
(11, '40', 2, '推广管理', 'Channel', '修改推广客户', 'cpsmember_edit'),
(11, '38', 2, '推广管理', 'Channel', '推广结算', 'accounts'),
(11, '37', 2, '推广管理', 'Channel', '批量计算', 'accounts_pl'),
(11, '36', 2, '推广管理', 'Channel', '推广查询', 'accounts_list '),
(11, '35', 2, '推广管理', 'Channel', '推广对账', 'accounts_js'),
(11, '2', 0, '推广管理', '', '推广管理', 'Channel'),
(11, '9', 1, '全局配置', 'Global', '站点配置', 'siteconf'),
(11, '1', 0, '全局配置', '', '全局配置', 'Global'),
(15, '94', 4, '文章系统', 'Article', '移动', 'moveop '),
(15, '93', 4, '文章系统', 'Article', '删除', 'delall'),
(15, '92', 4, '文章系统', 'Article', '状态', 'status '),
(15, '91', 4, '文章系统', 'Article', '删除', 'del'),
(15, '90', 4, '文章系统', 'Article', '修改', 'doedit_art'),
(15, '89', 4, '文章系统', 'Article', '修改', 'edit_art'),
(15, '88', 4, '文章系统', 'Article', '增加', 'addop'),
(15, '87', 4, '文章系统', 'Article', '增加文章 ', 'add'),
(15, '86', 4, '文章系统', 'Article', '文章管理', 'article_index'),
(15, '33', 4, '文章系统', 'Article', '状态更新', 'category_status'),
(15, '32', 4, '文章系统', 'Article', '删除栏目', 'category_del'),
(15, '31', 4, '文章系统', 'Article', '编辑栏目(操作)', 'doedit_cat'),
(15, '30', 4, '文章系统', 'Article', '编辑栏目', 'category_edit'),
(15, '29', 4, '文章系统', 'Article', '增加栏目(add)', 'category_doadd'),
(15, '28', 4, '文章系统', 'Article', '增加栏目', 'category_add'),
(15, '27', 4, '文章系统', 'Article', '栏目管理', 'category_index'),
(15, '4', 0, '文章系统', '', '文章系统', 'Article'),
(15, '166', 1, '全局配置', 'Global', '删除管理员', 'manager_delete'),
(15, '146', 1, '全局配置', 'Global', '权限设置', 'role_priv'),
(15, '133', 1, '全局配置', 'Global', '管理员编辑', 'manager_edit'),
(15, '132', 1, '全局配置', 'Global', '删除角色', 'role_delete'),
(15, '131', 1, '全局配置', 'Global', '编辑角色', 'role_edit'),
(15, '105', 1, '全局配置', 'Global', '保存logo操作', 'save_logo'),
(15, '104', 1, '全局配置', 'Global', '保存图标操作', 'save_icon'),
(15, '103', 1, '全局配置', 'Global', '保存站点配置', 'save_basic'),
(15, '14', 1, '全局配置', 'Global', '添加管理员', 'manager_add'),
(15, '13', 1, '全局配置', 'Global', '增加角色', 'role_add'),
(15, '12', 1, '全局配置', 'Global', '角色管理', 'role_list'),
(15, '11', 1, '全局配置', 'Global', '管理员管理', 'manager_list'),
(15, '9', 1, '全局配置', 'Global', '站点配置', 'siteconf'),
(15, '1', 0, '全局配置', '', '全局配置', 'Global'),
(15, '130', 4, '文章系统', 'Article', '文章发布操作', 'doadd'),
(15, '152', 4, '文章系统', 'Article', '修改文章操作', 'doedit'),
(15, '7', 0, '广告管理', '', '广告管理', 'Ad'),
(15, '75', 7, '广告管理', 'Ad', '友情链接', 'ad_link'),
(15, '76', 7, '广告管理', 'Ad', '添加友情链接', 'ad_linkadd'),
(15, '77', 7, '广告管理', 'Ad', '修改友情链接', 'ad_linkedit'),
(15, '78', 7, '广告管理', 'Ad', '删除友情链接', 'ad_linkdelete'),
(15, '79', 7, '广告管理', 'Ad', ' 广告管理', 'ad_index'),
(15, '80', 7, '广告管理', 'Ad', '增加广告', 'add'),
(15, '83', 7, '广告管理', 'Ad', ' 删除', 'del'),
(15, '134', 7, '广告管理', 'Ad', '广告编辑', 'edit'),
(15, '148', 7, '广告管理', 'Ad', '增加广告位', 'add_adwhere'),
(15, '149', 7, '广告管理', 'Ad', '广告位列表', 'adwhere_list'),
(15, '150', 7, '广告管理', 'Ad', '广告位修改', 'edit_adwhere'),
(15, '151', 7, '广告管理', 'Ad', '删除广告位', 'adwhere_delete'),
(1, '144', 6, '充值管理', 'Pay', '订单查询(平台币)', 'order_plf'),
(1, '147', 6, '充值管理', 'Pay', '删除支付方式', 'del_pay'),
(1, '154', 6, '充值管理', 'Pay', '订单查看', 'order_info'),
(1, '155', 6, '充值管理', 'Pay', '游戏补单', 'game_budan'),
(1, '156', 6, '充值管理', 'Pay', '订单删除', 'pay_order_del'),
(1, '7', 0, '广告管理', '', '广告管理', 'Ad'),
(1, '75', 7, '广告管理', 'Ad', '友情链接', 'ad_link'),
(1, '76', 7, '广告管理', 'Ad', '添加友情链接', 'ad_linkadd'),
(1, '77', 7, '广告管理', 'Ad', '修改友情链接', 'ad_linkedit'),
(1, '78', 7, '广告管理', 'Ad', '删除友情链接', 'ad_linkdelete'),
(1, '79', 7, '广告管理', 'Ad', ' 广告管理', 'ad_index'),
(1, '80', 7, '广告管理', 'Ad', '增加广告', 'add'),
(1, '83', 7, '广告管理', 'Ad', ' 删除', 'del'),
(1, '134', 7, '广告管理', 'Ad', '广告编辑', 'edit'),
(1, '148', 7, '广告管理', 'Ad', '增加广告位', 'add_adwhere'),
(1, '149', 7, '广告管理', 'Ad', '广告位列表', 'adwhere_list'),
(1, '150', 7, '广告管理', 'Ad', '广告位修改', 'edit_adwhere'),
(1, '151', 7, '广告管理', 'Ad', '删除广告位', 'adwhere_delete'),
(1, '8', 0, '拓展', '', '拓展', 'Other'),
(1, '114', 8, '拓展', 'Other', '数据库备份', 'index'),
(1, '115', 8, '拓展', 'Other', '数据库备份操作', 'dobackup'),
(1, '116', 8, '拓展', 'Other', '数据还原', 'restore'),
(1, '117', 8, '拓展', 'Other', '插入SQL', 'insertsql'),
(1, '118', 8, '拓展', 'Other', '数据库恢复', 'back'),
(1, '119', 8, '拓展', 'Other', '数据库下载', 'down'),
(1, '120', 8, '拓展', 'Other', '删除分卷', 'del'),
(1, '121', 8, '拓展', 'Other', '删除所有分卷', 'delall'),
(1, '122', 8, '拓展', 'Other', '上传备份文件', 'upload'),
(1, '123', 8, '拓展', 'Other', '执行上传', 'doupload'),
(1, '124', 8, '拓展', 'Other', '日志查看', 'log'),
(1, '125', 8, '拓展', 'Other', '删除日志', 'del_log'),
(1, '126', 8, '拓展', 'Other', '删除IP', 'del_ip'),
(1, '127', 8, '拓展', 'Other', '屏蔽IP', 'ip'),
(1, '128', 8, '拓展', 'Other', '添加IP', 'ip_add'),
(1, '136', 8, '拓展', 'Other', '后台菜单', 'menu_list'),
(1, '137', 8, '拓展', 'Other', '增加栏目', 'menu_add'),
(1, '138', 8, '拓展', 'Other', '后台栏目排序', 'menu_listorders'),
(1, '140', 8, '拓展', 'Other', '栏目修改', 'menu_edit'),
(1, '142', 8, '拓展', 'Other', '栏目删除', 'menu_del');

-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_server`
--

INSERT INTO `mygame_server` (`sid`, `gid`, `servername`, `start_time`, `server_url`, `add_time`, `stop_notice`, `is_display`, `status`, `gameid`, `serverid`, `line`, `content`, `server_img`) VALUES
(20, 44, '测试区', 1370355600, 'http://s1.sglj.aibu99.com/?opt=test&server=s1&user', 1370442100, '', '0', '0', 's1', 0, '双线', 'sadd', '51af49746d2f1.jpg'),
(17, 9, '魔兽三区', 1369880580, '', 1367893448, '', '0', '0', '0', 0, '电信2', '', ''),
(7, 9, '亚细亚', 1364192880, 'http://www.baidu.com', 1364192927, '', '0', '0', '1', 1, '联通', '', ''),
(9, 18, '环法华光', 1364175000, 'http://www.91wan.com/user/game_login.php?game_id=7', 1364261576, '', '0', '0', '12', 12, '电信', '', ''),
(10, 17, '火影', 1366972200, '', 1365352422, '', '0', '0', '', 0, '双线2区', '', ''),
(16, 9, '双线三', 1369447980, '', 1367892829, '', '0', '0', '', 0, '电信2', '', ''),
(18, 43, '121212', 1369107180, '', 1369020803, '', '0', '0', '', 0, '12121212', '121212121212', ''),
(19, 9, 'www', 1369580580, '', 1369062239, '', '0', '0', '', 0, '1111', '111', ''),
(21, 46, 'xxxx', 1378623120, 'www.baidu.com', 1379401068, '', '0', '0', '', 0, '双线', 'ffffff', '5237fd6c43265.jpg');

-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_soical_login`
--

INSERT INTO `mygame_soical_login` (`id`, `media_user_id`, `from_id`) VALUES
(1, 26654152, 13),
(2, 26438722, 13),
(3, 24688361, 3),
(4, 27415403, 13);

-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_spend_log`
--


-- --------------------------------------------------------


--
-- 转存表中的数据 `mygame_webconfig`
--

INSERT INTO `mygame_webconfig` (`id`, `sitename`, `sitename2`, `theme`, `domain`, `keywords`, `descriptions`, `game_sort`, `favicon`, `url_model`, `url_html_suffix`, `open`, `close_notice`, `openreg`, `logo`, `gzip`, `flash_model`, `save_uselog`, `save_errorlog`, `max_error`, `social_login`, `appid`, `appkey`, `mail_server`, `mail_port`, `mail_from`, `mail_user`, `mail_password`, `uc_key`, `uc_password`, `uc_api`) VALUES
(1, '31wan游戏中心', 'wan游戏中心q', 'default', 'http://demo.31wan.cn', '网页游戏,31wan,网页游戏大全,webgame,网页游戏平台,网页游戏排行榜,网页游戏开服表,最新网页游戏,网络游戏,游戏', '31wan游戏中心网页游戏平台是中国最大最知名的专业游戏运营平台，为中外游戏用户提供最新、最优质的网页游戏，31wan致力于游戏精细运作与良好的客户服务，成为最受玩家喜爱的国际化品牌游戏运营商。', 0, 'http://demo.31wan.cn/Public/Uploads/icon/521f1a92c5614.jpg', 0, '0', 0, '', 0, 'http://demo.31wan.cn/Public/Uploads/icon/521f1a9c46d68.jpg', 1, 0, 0, 0, 4, 0, '100395853', '539feea20d6fd2befbf6a9c32710db8a', 'smtp.163.com', 25, 'shf_l@163.com', 'shf_l', '132167', 0, '', '');

-- --------------------------------------------------------
