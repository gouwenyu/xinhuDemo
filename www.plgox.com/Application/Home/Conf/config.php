<?php
return array(
	'alipay_config'=>array(
		//'配置项'=>'配置值'
	 //合作身份者ID，签约账号，以2088开头由16位纯数字组成的字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
	 'partner'		=> '2088721345050616', 
	 // MD5密钥，安全检验码，由数字和字母组成的32位字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
	 'key'			=> '8wapda6lxswo795pq2y7jstv7wp2hxll', 
	 //签名方式
	 'sign_type'	=> strtoupper('MD5'),
	 //字符编码格式 目前支持 gbk 或 utf-8
	 'input_charset'=> strtolower('utf-8'),
	 //ca证书路径地址，用于curl中ssl校验
	 //请保证cacert.pem文件在当前文件夹目录中
	 'cacert'		=> './ThinkPHP/Library/Org/Util/pay/cacert.pem',
	 //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
	 'transport'	=> 'http',
	 // 支付类型 ，无需修改
	 'payment_type'	=> "1",
	 // 产品类型，无需修改
	 'service'		=> "create_direct_pay_by_user",
	),
);
