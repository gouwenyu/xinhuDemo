<?php 
namespace Admin\Controller;
use Think\Controller;
class TouristController extends CommonController {
	public function index() {
		if( $_SESSION['plgox_user']['plgox_id']){
			$this->redirect("Index/index");
		}
		$this->display("login");
	}
	public function check() {
		$username = trim(strtolower(I("post.username")));
		$password = trim(strtolower(I("post.password")));
		$code = trim(strtolower(I("post.VerCode")));
		$check_user = D('member')->where(array("plgox_user"=>$username,"plgox_pwd"=>md5($password),"plgox_usertype"=>array("in","0,1,2")))->find();
		if( !check_verify($code) ){
			$data['status'] = 301;
			$data['message'] = "验证码错误";
			$this->ajaxReturn($data,"JSON");
		}else{
			if( empty($check_user) ){
				$data['status'] = 201;
				$data['message'] = "帐户不存在或者密码不正确";
				$this->ajaxReturn($data,"JSON");			
			// 判断用户是否激活
			}else if( $check_user['plgox_activation'] == 1 ){
				$data['status'] = 305;
				$data['message'] = "你的帐号没有激活,请联系管理员激活";
				$this->ajaxReturn($data,"JSON");
			}else if(!empty($check_user)){
				// 使用session 储存用户值
				session('plgox_user',$check_user);
				session('is_admin_auth',2);
				D("Member")->where(array("plgox_id"=>$_SESSION['plgox_user']['plgox_id']))->setInc("plgox_loginumer",1);
				$data['status'] = 200;
				$data['message'] = "登录成功";
				$this->ajaxReturn($data,"JSON");				
			}
		}
		
	}
	public function outlogin() {
		if( isset( $_COOKIE[session_name()] ) ){
			// setCookie(session_name(),"",time()-3600,"/");
			$data = array(
				"plgox_ip" => get_client_ip(),
				"plgox_logintime" => time()
			);
			D("Member")->where(array("plgox_id"=>$_SESSION['plgox_user']['plgox_id']))->save($data);
			session('plgox_user',null);
			session('is_admin_auth',null);
			$data['status'] = 200;
			$data['message'] = "退出成功";
			$this->ajaxReturn($data,"JSON");
		}
	}
}
?>
