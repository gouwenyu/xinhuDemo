<?php
//  短信验证码用户名
function mobile_user() {
	return "N1641744";
}
// 短线验证码密码
function mobile_pass() {
	return "AGYugbZalLba6e";
}
function mobile_url() {
	return "http://smssh1.253.com/msg/send/json";
}
// 商家模版
function sendsms_template( $mobile , $msg , $needstatus = 'true' ){
	$postArr = array(
		'account' => mobile_user(),
		'password' => mobile_pass(),
		'msg' => urlencode($msg),
		'phone' => $mobile,
		'report' => $needstatus
	);
	$return  = curlPost_URL(mobile_url(),$postArr);
	return $return;
}
// 发送验证码模版
function message_sendSMS( $mobile , $msg ,$needstatus = 'true' ) {
	$code = mt_rand(10000,99999);
	session("code",$code);
	session("phone",$mobile);
    session('code_createtime',time());
	$postArr = array(
			'account' => mobile_user(),
			'password' => mobile_pass(),
			// mobiles_code_content($code)
			'msg' => urlencode($code.$msg),
			'phone' => $mobile,
			'report' => $needstatus
		);
	$return  = curlPost_URL(mobile_url(),$postArr);
	return $return;
}
// 检测填写的验证码
function mobiles_code_check($code,$mobile) {
	if( $_SESSION['phone'] != $mobile && $_SESSION['code'] == $code ){
		return array("status"=>3,"message"=>"接受验证码的手机号与当前填写的手机号不一致!");
	}else if( $_SESSION['code'] == $code && $_SESSION['phone'] == $mobile && $_SESSION['code_createtime'] > time()-mobile_expire_time() ){
		return array("status"=>1,"message"=>"验证成功");
	}else{
		return array("status"=>2,"message"=>"手机验证码错误");
	}
}
// 解析接口
function curlPost_URL( $url , $postFields ) {
	$postFields = json_encode($postFields);
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);//抓取url
	curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/json; charset=utf-8'));//设置header
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);//设置curl参数
	curl_setopt($ch,CURLOPT_POST,1);//post数据
	curl_setopt($ch,CURLOPT_POSTFIELDS,$postFields);
	curl_setopt($ch,CURLOPT_TIMEOUT,1);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);//是否检测服务器的证书是否由正规浏览器认证过的授权CA颁发的
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);//是否检测服务器的域名与证书上的是否一致
	$ret = curl_exec($ch);
	if( false == $ret ){
		$result = curl_error($ch);
	}else{
		$rsp = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
		if( 200 != $rsp){
			$result ="请求状态".$rsp." ".curl_error($ch);
		}else{
			$result = array("status"=>2004,"message"=>"验证码已发送到您的手机，请注意查收!");
		}
	}
	curl_close($ch);
	return $result;
}
function aaa($a){
	dump($a);
	return $a;
}
?>
