<?php  
// 验证码
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}
// session用户信息
function get_session_info(){
	$Member = D("Member")->where(array("plgox_user"=>$_SESSION['plgox_user']['plgox_user']))->find();
	if( empty($Member) ){
		return false;
	}else{
		return $Member['plgox_id'];
	}
}
function get_login_user() {
	return session("plgox_username");
}
function getCurrentAction() {
	return strtolower(CONTROLLER_NAME."/".ACTION_NAME);
}
function get_login_userid(){
	$user = get_login_user();
	return $user['plgox_id'];
}
function set_login_user($user){
	session("plgox_username",$user);
}
function shua_xin_login_user(){
	$user = D("Member")->where(array('plgox_id'=>get_login_userid()))->find();
	set_login_user($user);
}
// 通过id获取名称
function get_field_by_id($id,$table,$field,$data_field) {
	return D($table)->where( array( $data_field=>$id ) )->getField($field);
}
// 商家用户查询
function get_shanjia_by_id($id,$table,$field,$data_field){
	return D($table)->where( array( $data_field=>$id ) )->getField($field);
}
function getDomain(){
	return "http://".str_replace("http://","",$_SERVER['SERVER_NAME']);
}
// 认证数据匹配
function get_renzheng_data($id,$table,$field,$data_field) {
	return D($table)->where(array( $data_field=>$id ))->getField($field);
}
// 百分比换算
function getNum($num){
	$Xyj_data = D("Xyj")->find();
	if( is_numeric($num) ){
		$num = ( $num * $Xyj_data['xyj_prices'] );
		return $num;
	}else{
		return false;
	}
}
?>