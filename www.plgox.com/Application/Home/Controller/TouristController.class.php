<?php  
namespace Home\Controller;
use Think\Controller;
class TouristController extends CommonController {
	/**
	 * @param 用户功能模块
	 */
	public function login() {
		$this->display();
	}
	/**
	 * @param 注册
	 */
	public function register() {
		$this->display();
	}
	public function doregister() {
		/*if( !check_verify(I("imgCode")) ){
			$this->ajaxReturn(array("status"=>"-2001","message"=>"图形验证码错误"));
		}*/
		$name['plgox_user'] = I("username");
		$tel['plgox_tel'] = I("tel");
		$re_user = D("Member")->where($name)->count();
		$re_tel = D("Member")->where($tel)->count();
		if( !empty($re_user) and !empty($re_tel) ){
			$this->ajaxReturn(array("status"=>201,"message"=>"手机号或者用户名存在"));
			return;
		}else{
			$mobile_code_check = mobile_code_check(I('telCode'),I('tel'));
			if( $mobile_code_check['status'] == 1 ){
				$where['plgox_tel'] = I('tel');
				$re_user = D("Member")->where($where)->count();
				if( empty($re_user) ){
					$data = array(
							"plgox_user"=>strtolower(trim(I("username"))),
							"plgox_pwd" =>strtolower(trim(md5(I("password")))),
							"plgox_tel" => trim(I("tel")),
							"plgox_ip"  => get_client_ip(),
							"plgox_createtime" => time(),
							"plgox_name" => "前台用户",
							"plgox_usertype" => 3,
							'plgox_credit'	=> 100
					);
					$useradd = M("Member")->add($data);
					if( $useradd ){
						$this->ajaxReturn(array("status"=>200,"message"=>"注册成功"));
						session('code',null);
						session('phone',null);
						session('code_createtime',null);
					}else{
						$this->ajaxReturn(array("status"=>201,"message"=>"注册失败"));
						session(null);
					}
				}else{
					$this->ajaxReturn(array("status"=>202,"message"=>"手机号已经存在"));
				}
			}else if($mobile_code_check['status'] == 2 ){
				$this->ajaxReturn(array("status"=>203,"message"=>"验证码不正确"));
			}else if( $mobile_code_check['status'] == 3 ){
				$this->ajaxReturn(array("status"=>204,"message"=>"接受验证码的手机号与当前填写的手机号不一致"));
			}
		}
	}
	//  获取验证码
	public function send_code(){
		$tu_Code = strtolower(trim(I("imgCode")));
		if( !check_verify($tu_Code) ){
			$this->ajaxReturn(array("status"=>201,"message"=>"图形验证码错误!"));
		}
		$mobile_code = I("tel");
		$name['plgox_user'] = I("username");
		$tel['plgox_tel'] = $mobile_code;
		$user_count_name = D("Member")->where($name)->count();
		$user_count_tel = D("Member")->where($tel)->count();
		if( empty($user_count_tel) && empty($user_count_name) ){
			$check_code_phones = sendSMS($mobile_code,false);
			$this->ajaxReturn(array("status"=>200,"message"=>$check_code_phones['message']));
		}else{
			$this->ajaxReturn(array("status"=>202,"message"=>"手机号或者用户名存在"));
		}
	}
	// 找回密码
	public function eidt_dofindpass() {
		/*if( !check_verify(I("imgCode")) ){
			$this->ajaxReturn(array("status"=>-2001,"message"=>"图形验证码错误!"));
		}*/
		$tel_phone = I("telephone");
		$where['plgox_tel'] = $tel_phone;
		$user_tel_ = D("Member")->where($where)->find();
		if( !empty( $user_tel_ ) ){
			$mobile_code_check_ = mobile_code_check_(I("telCode"),$tel_phone);
			if( $mobile_code_check_['status'] == 2 ){
				$data = array(
					"plgox_pwd" => md5(strtolower(trim(I("password")))),
				);
				$user_edit = D("Member")->where(array("plgox_id"=>$user_tel_['plgox_id']))->save($data);
				if( $user_edit ){
					$this->ajaxReturn(array("status"=>2000,"message"=>"恭喜您，成功找回您的密码，请您妥善保管您的密码!"));
					session('send_code',null);
					session('tel_phone',null);
					session('createtimes',null);
				}else{
					$this->ajaxReturn(array("status"=>-2002,"message"=>"找回密码失败,请及时联系客服! error"));
					session(null);
				}
			}else if( $mobile_code_check_['status'] == 1 ){
				$this->ajaxReturn(array("status"=>-2003,"message"=>"接受验证码的手机号与当前填写的手机号不一致!"));
			}else if( $mobile_code_check_['status'] == 3 ){
				$this->ajaxReturn(array("status"=>-2004,"message"=>"手机验证码错误!"));
			}
		}
	}
	// 发送找回密码验证码信息
	public function send_code1() {
		$code = I("imgCode");
		if( !check_verify($code) ){
			$this->ajaxReturn(array("status"=>-2001,"message"=>"图形验证码错误!"));
		}
		$mobile_phone = I("tel_phone");
		$where['plgox_tel'] = $mobile_phone;
		$user_count_tel = D("Member")->where($where)->count();
		if( !empty( $user_count_tel ) ){
			$check_mobile_phone = code_send_sms($mobile_phone,false);
			$this->ajaxReturn(array("status"=>2000,"message"=>$check_mobile_phone['message']));
		}else{
			$this->ajaxReturn(array("status"=>-2002,"message"=>"手机号不存在!"));
		}
	}
	public function dologin() {
		$username = I("post.username");
		$password = I("post.password");
		$where['plgox_user'] = $username;
		$where['plgox_tel'] = $username;
		$where['_logic'] = 'OR';
		$user_check = D("Member")->where(array($where,"plgox_pwd"=>md5($password),"plgox_usertype"=>array("in","3,4")))->find();
		if( empty($user_check) ){
			$data['status'] = 201;
			$data['message'] = "你输入的密码和账户名不匹配";
			$this->ajaxReturn($data,"JSON");
		}else{
			session("plgox_username",$user_check);
			session("home_auth_id",1);
			$arr['plgox_logintime'] = time();
			D("Member")->where(array("plgox_id"=>$user_check['plgox_id']))->save($arr);
			D("Member")->where(array("plgox_id"=>$user_check['plgox_id']))->setInc("plgox_loginumer",1);
			$data['status'] = 200;
			$data['message'] = "登陆成功";
			$this->ajaxReturn($data,"JSON");
		}
	}
	public function loginout() {
		if( isset($_COOKIE[session_name()] ) ){
			session('plgox_username',null);
			session('home_auth_id',null);
			session("wyyx_id",null);
			$data['status'] = 200;
			$data['message'] = "退出成功";
			$this->ajaxReturn($data,"JSON");
		}
	}
}
?>