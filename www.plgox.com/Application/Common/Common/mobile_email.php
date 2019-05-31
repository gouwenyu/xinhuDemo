<?php  
//  短信验证码用户名
function mobile_code_user() {
	return "N1641744";
}
// 短线验证码密码
function mobile_code_pass() {
	return "AGYugbZalLba6e";
}
function mobile_code_url() {
	return "http://smssh1.253.com/msg/send/json";
}
//发送手机短信验证码
function sendSMS( $mobile,$needstatus = 'true') {
	$code = mt_rand(10000,99999);
	session("code",$code);
	session("phone",$mobile);
    session('code_createtime',time());
	$postArr = array(
			'account' => mobile_code_user(),
			'password' => mobile_code_pass(),
			'msg' => urlencode(mobile_code_content($code)),
			'phone' => $mobile,
			'report' => $needstatus
		);
	$return  = curlPost(mobile_code_url(),$postArr);
	return $return;
}
/**
 * @param 验证手机验证码
 */
function mobile_code_check($code,$mobile) {
	if( $_SESSION['phone'] != $mobile && $_SESSION['code'] == $code ){
		return array("status"=>3,"message"=>"接受验证码的手机号与当前填写的手机号不一致!");
	}else if( $_SESSION['code'] == $code && $_SESSION['phone'] == $mobile && $_SESSION['code_createtime'] > time()-mobile_expire_time() ){
		return array("status"=>1,"message"=>"验证成功");
	}else{
		return array("status"=>2,"message"=>"手机验证码错误");
	}
}
// curl解析短信接口
function curlPost($url,$postFields) {
	$postFields = json_encode($postFields);
	$ch = curl_init();//初始化
	curl_setopt($ch,CURLOPT_URL,$url);//设置属性
	curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/json; charset=utf-8'));
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_POST, 1 );
	curl_setopt($ch,CURLOPT_POSTFIELDS, $postFields);
	curl_setopt($ch,CURLOPT_TIMEOUT,1); 
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, 0);
	$ret = curl_exec($ch);
    if (false == $ret) {
        $result = curl_error($ch);
    } else {
        $rsp = curl_getinfo( $ch, CURLINFO_HTTP_CODE);
        if (200 != $rsp) {
            $result = "请求状态 ". $rsp . " " . curl_error($ch);
        } else {
            $result = array("status"=>1,"message"=>"验证码已发送到您的手机，请注意查收！");
        }
    }
    curl_close ( $ch );
    return $result;
}
// 找回密码
function code_send_sms($mobile,$needstatus="true"){
	$code = mt_rand(10000,99999);
	session("send_code",$code);
	session("tel_phone",$mobile);
	session("createtimes",time());
	$postArr = array(
		"account" => mobile_code_user(),
		"password" => mobile_code_pass(),
		"msg" => urlencode(findpass_code_content($code)),
		"phone" => $mobile,
		"report" => $needstatus
	);
	$return = _curlPost(mobile_code_url(),$postArr);
	return $return;
}
function _curlPost($url,$postFields) {
	$postFields = json_encode($postFields);
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type: application/json; charset=utf-8"));
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_POST,1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$postFields);
	curl_setopt($ch,CURLOPT_TIMEOUT,1);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
	$ret = curl_exec($ch);
	if( $ret == false ){
		$result = curl_error($ch);
	}else{ 
		$rsp = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
		if( 200 != $rsp ){
			$result = "请求状态 ". $rsp . " " . curl_error($ch);
		}else{
			$result = array("status"=>1,"message"=>"验证码已发送到您的手机，请注意查收！");
		}
	}
	curl_close($ch);
	return $result;	
}
// 后台短信提醒
function message_sms_send($mobile,$content,$needstatus = "true" ) {
	$postArr = array(
			// 帐号
			"account"   => mobile_code_user(),
			"password"	=> mobile_code_pass(),
			"msg"		=> $content,
			"phone"		=> $mobile,
			"report"	=> $needstatus
	);
	$url = mobile_code_url();
	$postFields = json_encode($postArr);
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type: application/json; charset=utf-8"));
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_POST,1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$postFields);
	curl_setopt($ch,CURLOPT_TIMEOUT,1);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
	$ret = curl_exec($ch);
	if( $ret == false ){
		$result = curl_error($ch);
	}else{
		$rsp = curl_getinfo($ch,CURLINFO_HTTP_CODE);
		if( 200 != $rsp ){
			$result = "请求状态 ". $rsp . " " . curl_error($ch);
		}else{
			$result = array("status"=>1,"message"=>"短信已成功下发至用户手机！");
		}
	}
	curl_close($ch);
	return $result;	
}
/**
 * @param 判断短信验证码和手机
 */
function mobile_code_check_($code,$mobile) {
	if( $_SESSION['tel_phone'] != $mobile && $_SESSION['send_code'] == $code ){
		return array("status"=>1,"message"=>"接受验证码的手机号与当前填写的手机号不一致");
	}else if( $_SESSION['tel_phone'] == $mobile && $_SESSION['send_code'] == $code && $_SESSION['createtimes'] > time() - mobile_expire_time() ){
		return array("status"=>2,"message"=>"验证成功");
	}else{
		return array("status"=>3,"message"=>"手机验证码错误");
	}
}
// 注册专用
function mobile_code_content($code) {
	return $code."（魄力共享注册验证码），请在2分钟内完成注册。如非本人，请忽略。";
}
// 找回密码专用
function findpass_code_content($code) {
	return $code."（魄力共享找回密码验证码），请在2分钟内完成注册。如非本人，请忽略。";
}
//  多次发送验证码的时间间隔，单位秒
function mobile_code_time() {
	return 60;
}
// 多次发送验证码的过期时间
function mobile_expire_time() {
	return 120;
}
?>