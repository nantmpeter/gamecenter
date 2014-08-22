<?php

/*
 * @Description 易宝支付产品通用接口范例 
 * @V3.0
 * @Author rui.xin
 */

#	商户编号p1_MerId,以及密钥merchantKey 需要从易宝支付平台获得
$pay_type = M('pay_type');
$info = $pay_type->where("tag='yeepay'")->find();

$p1_MerId			=$info['account'];																									#测试使用
$merchantKey	= $info['key'];		#测试使用

$logName	= "YeePay_HTML.log";

?> 