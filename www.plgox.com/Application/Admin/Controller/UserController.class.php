<?php 
namespace Admin\Controller;
use Think\Controller;
use Think\Model;
use Think\Page;
use Think\Upload;
class UserController extends SessionController {
	/**
 	 * @param 针对于前端普通用户的数据
	 */
	public function home_member_list() {
		$page_count = D("Member")->where( array("plgox_usertype"=>array('in',"3")) )->count();
		$page = new \Think\Page($page_count,10);
		$home_user = D("Member")->where( array("plgox_usertype"=>array('in',"3")) )->order("plgox_id desc")->limit($page->firstRow.",".$page->listRows)->select();
		$this->assign("home_user",$home_user);
		$page->setConfig('header', '<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
	    $page->setConfig('prev', '上一页');
	    $page->setConfig('next', '下一页');
	    $page->setConfig('last', '末页');
	    $page->setConfig('first', '首页');
    	$page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
		$this->assign("page",$page->show());
		$this->display("member-list");
	}
	// 修改
	public function edit_member_home() {
		$user_value = D("Member")->where(array("plgox_id"=>base64_decode(I('home_user_id'))))->find();
		$this->assign("user_value",$user_value);
		$this->display("edit_home_member");
	}
	public function member_home_update() {
		if( empty( I("plgox_pwd") ) ){
			$data = array(
				'plgox_id' => I('plgox_id'),
				'plgox_tel' => I('plgox_tel'),
				'plgox_email' => I('plgox_email'),
				'plgox_activation' => I('plgox_activation'),
				'plgox_sex' => I('plgox_sex'),
				'plgox_updatetime' => time()
			);
		}else{
			$data = array(
				'plgox_id' => I('plgox_id'),
				'plgox_pwd' => strtolower(trim(md5(I('plgox_pwd')))),
				'plgox_tel' => I('plgox_tel'),
				'plgox_email' => I('plgox_email'),
				'plgox_activation' => I('plgox_activation'),
				'plgox_sex' => I('plgox_sex'),
				'plgox_updatetime' => time()
			);
		}
		$user_save = D("Member")->save($data);
		if( $user_save ){
			$this->ajaxReturn(array("status"=> 2000, "message"=> "修改用户资料成功" ));
			return false;
		}else{
			$this->ajaxReturn(array("status"=> -2000, "message"=> "修改用户资料失败" ));
			return false;
		}
	}

	// 搜索
	public function search_home_member() {
		$Model = new \Think\Model();
		if( !empty( I("search_fields") ) ){
			$plgox_user = I('search_fields');
			$plgox_tel = I('search_fields');
			$plgox_sex = I('search_fields');
			$plgox_email = I('search_fields');
			$plgox_ip = I('search_fields');
			$count = D("Member")->where("plgox_usertype IN(3) AND plgox_user LIKE '%$plgox_user%' OR plgox_tel  LIKE '%$plgox_tel%' OR plgox_email LIKE '%$plgox_email%' OR plgox_ip  LIKE '%$plgox_ip%'")->count();
			$page = new \Think\Page($count,5);
			$home_user = D("Member")->where("plgox_usertype IN(3) AND plgox_user LIKE '%$plgox_user%' OR plgox_tel  LIKE '%$plgox_tel%' OR plgox_email LIKE '%$plgox_email%' OR plgox_ip  LIKE '%$plgox_ip%'")->order("plgox_id desc")->limit($page->firstRow.",".$page->listRows)->select();
			if( !empty( $home_user ) ){
				$this->assign("home_user",$home_user);
				$this->assign("page",$page->show());
				$this->display("member-list");
			}else{
				 echo "<script>alert('您当前输入的内容不存在');location.href='home_member_list'</script>";
			}
			// 分页显示
		}
	}
	/**
	 * 可共用的方法
	 */
	public function select_tel() {
		$select_tel_all = D("Member")->where(" plgox_id NOT IN(".I('plgox_id').") AND plgox_tel = ".I('plgox_tel')." ")->select();
		if( empty($select_tel_all) ){
			$this->ajaxReturn(array("status"=>2000));
			return false;
		}else{
			$this->ajaxReturn(array("status"=>-2000,"message"=>"当前手机号存在，请更换新的手机号!"));
			return false;
		}
	}
	/**
 	 * @param 针对于商家用户的数据
	 */
	public function home_mrchant_list() {
		// 数据分页
		$page_count = D("Member")->where( array("plgox_usertype"=>array('in',"4")) )->count();
		$page = new \Think\Page($page_count,10);
		$home_user = D("Member")->where( array("plgox_usertype"=>array('in',"4")) )->order("plgox_id desc")->limit($page->firstRow.",".$page->listRows)->select();
		$this->assign("home_user",$home_user);
		$page->setConfig('header', '<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
	    $page->setConfig('prev', '上一页');
	    $page->setConfig('next', '下一页');
	    $page->setConfig('last', '末页');
	    $page->setConfig('first', '首页');
    	$page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
		$this->assign("page",$page->show());
		$this->display("member-mrchant-list");
	}
	public function edit_mrchant_home_() {
		$user_value = D("Member")->where(array("plgox_id"=>base64_decode(I('home_user_id'))))->find();
		$this->assign("user_value",$user_value);
		$this->display("home_edit_page");
	}
	public function mrchant_home_update() {
		if( empty( I("plgox_pwd") ) ){
			$data = array(
				'plgox_id' => I('plgox_id'),
				'plgox_tel' => I('plgox_tel'),
				'plgox_email' => I('plgox_email'),
				'plgox_activation' => I('plgox_activation'),
				'plgox_sex' => I('plgox_sex'),
				'plgox_updatetime' => time()
			);
		}else{
			$data = array(
				'plgox_id' => I('plgox_id'),
				'plgox_pwd' => strtolower(trim(md5(I('plgox_pwd')))),
				'plgox_tel' => I('plgox_tel'),
				'plgox_email' => I('plgox_email'),
				'plgox_activation' => I('plgox_activation'),
				'plgox_sex' => I('plgox_sex'),
				'plgox_updatetime' => time()
			);
		}
		$user_save = D("Member")->save($data);
		if( $user_save ){
			$this->ajaxReturn(array("status"=> 2000, "message"=> "修改用户资料成功" ));
			return false;
		}else{
			$this->ajaxReturn(array("status"=> -2000, "message"=> "修改用户资料失败" ));
			return false;
		}
	}
	public function delete_mrchant() {
		// 单选删除
		if( I("plgox_id") ){
			D("Member")->delete(I('plgox_id'));
			$this->ajaxReturn(array("status"=> 2000, "message"=> "删除成功" ));
			return false;
		}else if( I('plgox_uid') ){
			$del_user = D("Member")->delete(I('plgox_uid'));
			$this->ajaxReturn(array("status"=> 2002, "message"=> "删除成功" ));
			return false;
		}
	}
	// 后台字段搜索
	public function seacrh_mrcahet() {
		$Model = new \Think\Model();
		if( !empty( I("search_fields") ) ){
			$plgox_user = I('search_fields');
			$plgox_tel = I('search_fields');
			$plgox_sex = I('search_fields');
			$plgox_email = I('search_fields');
			$plgox_ip = I('search_fields');
			$count = D("Member")->where("plgox_usertype IN(4) AND plgox_user LIKE '%$plgox_user%' OR plgox_tel  LIKE '%$plgox_tel%' OR plgox_email LIKE '%$plgox_email%' OR plgox_ip  LIKE '%$plgox_ip%'")->count();
			$page = new \Think\Page($count,5);
			$home_user = D("Member")->where("plgox_usertype IN(4) AND plgox_user LIKE '%$plgox_user%' OR plgox_tel  LIKE '%$plgox_tel%' OR plgox_email LIKE '%$plgox_email%' OR plgox_ip  LIKE '%$plgox_ip%'")->order("plgox_id desc")->limit($page->firstRow.",".$page->listRows)->select();
			if( !empty( $home_user ) ){
				$this->assign("home_user",$home_user);
				$this->assign("page",$page->show());
				$this->display("member-mrchant-list");
			}else{
				 echo "<script>alert('您当前输入的内容不存在');location.href='home_mrchant_list'</script>";
			}
			// 分页显示
		}
	}
	// 消息通知
	public function mrchant_message() {
		if( !empty(I('home_user_id')) ){
			$count = D("Message")->where("message_type = 1 AND message_uid = ".base64_decode(I('home_user_id'))." ")->join("INNER JOIN plgox_member on plgox_member.plgox_id = plgox_message.message_uid")->count();
		}else{
			$count = D("Message")->where("message_type = 1")->join("INNER JOIN plgox_member on plgox_member.plgox_id = plgox_message.message_uid")->count();
		}
		// 分页展示
		$page = new \Think\Page($count,10);
		if(!empty(I("home_user_id"))){
			$user_message = D("Message")->where("message_type = 1 AND message_uid = ".base64_decode(I('home_user_id'))." ")->join("INNER JOIN plgox_member on plgox_member.plgox_id = plgox_message.message_uid")->order("message_id desc")->limit($page->firstRow.','.$page->listRows)->select();
		}else{
			$user_message = D("Message")->where("message_type = 1")->join("INNER JOIN plgox_member on plgox_member.plgox_id = plgox_message.message_uid")->order("message_id desc")->limit($page->firstRow.','.$page->listRows)->select();
		}
		$page->setConfig('header', '<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig('theme',"%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$this->assign("user_message",$user_message);
		$this->assign("page",$page->show());
		$this->assign('setTitle','消息通知');
		$this->display('mrchant_message_list');
	}
	public function insert_message() {
		$member =  D("Member  as m")->where("plgox_usertype IN(3,4)")->select();
		$this->assign("member",$member);
		$this->assign('datetime',time());
		$this->display("insert_message");
	}
	public function user_message_add() {
		$data = array(
			'message_uid'		 => I('message_uid'),
			'message_title'		 => I('message_title'),
			'message_content'	 => I('message_content'),
			'message_createtime' => strtotime(I('message_createtime')),
			'message_person'	 => $_SESSION['plgox_user']['plgox_user'],
			'message_type'       => 1,
			'message_success'	 => 1,
		);
		$message_add = D("Message")->add($data);
		if( $message_add ){
			$this->ajaxReturn(array("status"=>2000,"message"=>"发送成功"));
		}else{
			$this->ajaxReturn(array("status"=>-2000,"message"=>"发送失败"));
		}
	}
	public function select_message() {
		$message_sel = D("Message")->where( array( "message_id"=>base64_decode(I('msg_user_id'))  ) )->join("INNER JOIN plgox_member on plgox_member.plgox_id = plgox_message.message_uid")->find();
		$this->assign("message_sel",$message_sel);
		$this->assign('setTitle','消息通知修改');
		$this->display("select_message");
	}
	public function mrchant_message_lists() {
		$message_selected = D("Member")->where("plgox_id = ".base64_decode(I("home_user_id"))." ")->find();
		$member = D("Member")->where("plgox_usertype = 3")->select();
		$this->assign("member",$member);
		$this->assign("message_selected",$message_selected);
		$this->assign("datetime",time());
		$this->assign('memberid',base64_decode(I("home_user_id")));
		$this->display("mrchant_message_lists");
	}
	public function mrchant_msg_list() {
		$message_selected = D("Member")->where("plgox_id = ".base64_decode(I("home_user_id"))." ")->find();
		$member = D("Member")->where("plgox_usertype = 4")->select();
		$this->assign("member",$member);
		$this->assign("message_selected",$message_selected);
		$this->assign("datetime",time());
		$this->assign('memberid',base64_decode(I("home_user_id")));
		$this->display("mrchant_msg_list");
	}
	public function mrchant_message_list_home(){
		// 分页
		$count = D("Message")->where("message_type = 1 AND message_uid = ".I('user_home_message_id')." ")->count();
		$page = new \Think\Page($count,10);
		$user_message = D("Message")->where("message_type = 1 AND message_uid = ".I('user_home_message_id')." ")->join("INNER JOIN plgox_member on plgox_member.plgox_id = plgox_message.message_uid")->order('message_uid desc')->limit($page->firstRow.','.$page->listRows)->select();
		$page->setConfig('header', '<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
	    $page->setConfig('prev', '上一页');
	    $page->setConfig('next', '下一页');
	    $page->setConfig('last', '末页');
	    $page->setConfig('first', '首页');
    	$page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
		$this->assign("page",$page->show());
		$this->assign("user_message",$user_message);
		$this->display("mrchant_message_list_home");
	}
	public function del_message() {
		if( I("message_id") ){
			D("Message")->where(array("message_id"=>I('message_id')))->delete();
			$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功"));
			return false;
		}else if( I('message_ids') ){
			D("Message")->delete(I('message_ids'));
			$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功"));
			return false;
		}
	}
	// 搜索
	public function search_message() {
		if( !empty(I('search_fields')) ){
			$message_uid      = I('search_fields');
			$member = D("Member")->where(" plgox_user = '$message_uid' ")->find();
			$message_uid = $member['plgox_id'];
			$message = D("Message")->where(" message_uid = '$message_uid' ")->count();
			$page = new \Think\Page($message,1);
			$user_message = D("Message")->where(" message_uid ='$message_uid' ")->join("INNER JOIN plgox_member on plgox_member.plgox_id = plgox_message.message_uid")->order("message_id desc")->limit($page->firstRow.','.$page->listRows)->select();
			if( !empty($user_message) ){
				$page->setConfig('header', '<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
			    $page->setConfig('prev', '上一页');
			    $page->setConfig('next', '下一页');
			    $page->setConfig('last', '末页');
			    $page->setConfig('first', '首页');
		    	$page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
				$this->assign("user_message",$user_message);
				$this->assign("page",$page->show());
			}else{
				echo "<script>alert('您当前查询的内容不存在!');location.href='mrchant_message'</script>";
			}
			$this->display("mrchant_message_list");
		}
	}
	// 短信通知 普通会员
	public function message_sms() {
		$count = D("Message")->where("message_type = 2 AND message_uid = ".base64_decode(I('home_user_id'))." ")->count();
		$page = new \Think\Page($count,10);
		$sms_send_sel = D('Message')->where("message_type = 2 AND message_uid = ".base64_decode(I('home_user_id'))." ")->join("INNER JOIN plgox_member as mem on mem.plgox_id = plgox_message.message_uid")->order("message_id desc")->limit($page->firstRow.','.$page->listRows)->select();
		$message_sms = base64_decode(I('home_user_id'));
		$page->setConfig('header','<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$page->setConfig('first','首页');
		$page->setConfig('last','末页');
		$page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$this->assign("page",$page->show());
		$this->assign("message_sms",$message_sms);
		$this->assign("sms_send_sel",$sms_send_sel);
		$this->display("message_sms");
	}
	public function message_sms_add() {
		// $message = D("Message")->where("message_uid = ".I("user_message_insert_id")." ")->find();
		$message = D("Member")->where("plgox_id = ".I("user_message_insert_id")." ")->find();
		$member = D("Member")->where("plgox_usertype = 3")->select();
		$this->assign("member",$member);
		$this->assign("datetime",time());
		$this->assign("message",$message);
		$this->display("message_sms_add");
	}
	//商家会员
	public function duanxin_sms() {
		$count = D("Message")->where("message_type = 2 AND message_uid = ".base64_decode(I('home_user_id'))." ")->count();
		$page = new \Think\Page($count,10);
		$sms_send_sel = D('Message')->where("message_type = 2 AND message_uid = ".base64_decode(I('home_user_id'))." ")->join("INNER JOIN plgox_member as mem on mem.plgox_id = plgox_message.message_uid")->order("message_id desc")->limit($page->firstRow.','.$page->listRows)->select();
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig('last', '末页');
	    $page->setConfig('first', '首页');
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$message_sms = base64_decode(I('home_user_id'));
		$this->assign("page",$page->show());
		$this->assign("message_sms",$message_sms);
		$this->assign("sms_send_sel",$sms_send_sel);
		$this->assign('setTitle','消息通知');
		$this->display("duanxin_sms");
	}
	public function message_sms_adddata() {
		$message = D("Member")->where("plgox_id = ".I("user_message_insert_ids")." ")->find();
		$member = D("Member")->where("plgox_usertype = 4")->select();
		$this->assign("member",$member);
		$this->assign("datetime",time());
		$this->assign("message",$message);
		$this->assign('setTitle','消息通知添加');
		$this->display("message_sms_adddata");
	}
	// 短信发送
	public function message_sms_insert() {
		$data = array(
			"message_uid" 	    => I("message_uid"),
			"message_content"	=> I("message_content"),
			"message_createtime"=> strtotime(I("message_createtime")),
			"message_person"	=> $_SESSION['plgox_user']['plgox_user'],
			"message_type"		=> 2,
			'message_status' 	=> 1,
			'message_success'	=> 1
		);
		$message = D("Member")->where("plgox_id = ".I("message_uid")."")->find();
		$message_sms_send = message_sms_send($message['plgox_tel'],I("message_content"));
		$message_add = D("Message")->add($data);
		if( $message_add && $message_sms_send['status'] == 1 ){
			$this->ajaxReturn(array("status"=>2000,"message"=>$message_sms_send['message']));
			return false;
		}else{
			$this->ajaxReturn(array("status"=>-2000,"message"=>"发送失败"));
			return false;
		}
	}
	// 用户信誉
	public function home_credit_list() {
		// home_credit_id
		$member_credit = D("Member")->where(" plgox_id = ".base64_decode(I('home_credit_id'))." ")->find();
		//分页
		$count = D("Credit")->where(" credit_uid = ".base64_decode(I('home_credit_id'))." ")->count();
		$page = new \Think\Page($count,10);
		$credit_score = D("Credit")->where("credit_uid = ".base64_decode(I('home_credit_id'))." ")->join("INNER JOIN plgox_member as mem on mem.plgox_id = plgox_credit.credit_uid")->order("credit_id desc")->limit($page->firstRow.','.$page->listRows)->select();
		$page->setConfig('header','<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$page->setConfig('first','首页');
		$page->setConfig('last','末页');
		$page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$this->assign("home_credit_id",base64_decode(I('home_credit_id')));
		$this->assign("credit_score",$credit_score);
		$this->assign("member_credit",$member_credit);
		$this->assign("page",$page->show());
		$this->display("home_credit_list");
	}
	// 扣分
	public function home_credit_comprehensive() {
		if( I('home_credit_reason_id') ){
			$member_credit = D("Member")->where(" plgox_id = ".I('home_credit_reason_id')." ")->find();
			$this->assign("member_credit",$member_credit);
			$this->display("home_credit_jian");
		}else if( I('home_credit_add_id') ){
			$member_credit = D("Member")->where(" plgox_id = ".I('home_credit_add_id')." ")->find();
			$this->assign("member_credit",$member_credit);
			$this->display("home_credit_jia");
		}
	}
	public function credit_score_comprehensive(){
		if( I('credit_uid') ){
			$member_credit = D("Member")->where("plgox_id = ".I('credit_uid')." ")->find();
			if( $member_credit['plgox_credit'] <= 0 ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>"亲，当前用户的积分已经是最低了，无法在减了!"));//
			}else{
				$number_jian = $member_credit['plgox_credit']-I('credit_number');
				if( $number_jian < 0 ){
					$this->ajaxReturn(array("status"=>-2002,"message"=>"亲，你所减的积分已经超过限制!"));
				}else{
					$save['plgox_credit'] = $member_credit['plgox_credit']-I('credit_number');
					$save['plgox_id'] = $member_credit['plgox_id'];
					D("Member")->save($save);
					// 积分减
					$data = array(
						'credit_uid' 		=> I('credit_uid'),
						'credit_number'		=> I('credit_number'),
						'credit_ddn_reason' => I('credit_ddn_reason'),
						'credit_ddn_person'	=> $_SESSION['plgox_user']['plgox_user'],
						'credit_updatetime'	=> time(),
						'credit_beautiful'	=> '-'
					);
					$credit_add = D("Credit")->add($data);
					if( $credit_add ){
						$this->ajaxReturn(array("status"=>2000,"message"=>$member_credit['plgox_id']));
					}else{
						$this->ajaxReturn(array("status"=>-2000,"message"=>"扣分失败"));
					}							
				}
			}
		}else if( I('credit_uid_') ){
			$member_credit = D("Member")->where("plgox_id = ".I('credit_uid_')." ")->find();
			if( $member_credit['plgox_credit'] >= 100 ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>"亲，当前用户的积分已经是100%了，不可以在加了!"));
			}else{
				// 相加求和计算
				$number_sum = array_sum(array( $member_credit['plgox_credit'],I('credit_number') ));
				if( $number_sum > 100 ){
					$this->ajaxReturn(array("status"=>-2002,"message"=>"亲，你所加的积分已经超过限制!"));
				}else{
					$save['plgox_credit'] = $member_credit['plgox_credit']+I('credit_number');
					$save['plgox_id'] = $member_credit['plgox_id'];
					D("Member")->save($save);
					// 积分加
					$data = array(
						'credit_uid' 		=> I('credit_uid_'),
						'credit_number'		=> I('credit_number'),
						'credit_ddn_reason' => I('credit_ddn_reason'),
						'credit_ddn_person'	=> $_SESSION['plgox_user']['plgox_user'],
						'credit_updatetime'	=> time(),
						'credit_beautiful'	=> '+'
					);
					$credit_add = D("Credit")->add($data);
					if( $credit_add ){
						$this->ajaxReturn(array("status"=>2000,"message"=>$member_credit['plgox_id']));
					}else{
						$this->ajaxReturn(array("status"=>-2000,"message"=>"加分失败"));
					}					
				}
			}
		}
	}
	// 用户协议
	public function user_protocol() {
		$protocol=D("Protocol")->find();
		$this->assign("vo",$protocol);
		$this->assign('setTitle','用户协议');
		$this->display("user_protocol");
	}
	public function user_protocol_update() {
		$data = array(
			'protocol_name'      => I("protocol_name"),
			'protocol_content'	 => I("protocol_content"),
			'protocol_title'	 => I("protocol_title"),
			'protocol_type'		 => I("protocol_type"),
			'protocol_add_time'	 => time()
		);
		if( !empty(I('protocol_id')) ){
			$r = D("Protocol")->where( array( "protocol_id" => I('protocol_id') ) )->save($data);
		}else{
			$r = D("Protocol")->add($data);
		}
		if( $r ){
			$this->ajaxReturn(array("status"=>2000,"message"=>"修改协议成功"));
		}else{
			$this->ajaxReturn(array("status"=>-2000,"message"=>"修改协议失败"));
		}
	}
	// 热门关键字
	public function hot_keyword() {
		$list=D("Keyword")->order(" keyword_px desc")->select();
        $this->assign("list",$list);
        $this->assign("setTitle","热门关键字");
		$this->display("hot_keyword");
	}
	public function Hot_keywords_data() {
		if( base64_decode(I("hot_keywords_id")) ){
			$user_value = D("Keyword")->where(" keyword_id = ".base64_decode(I("hot_keywords_id"))." ")->find();
	        $this->assign("user_value",$user_value);
	        $this->assign("setTitle","热门关键字修改");
			$this->display("Hot_keywords_data");
		}else{
			$this->assign("setTitle","热门关键字添加");
			$this->display("Hot_keywords_data");
		}
	}
	public function hot_keyword_() {
		if( I("keyword_id") ){
			$data = array(
				'keyword_id'	 	=> I('keyword_id'),
				'keyword_type'	 	=> I('keyword_type'),
				'keyword_name'	 	=> I('keyword_name'),
				'keyword_px'	 	=> I('keyword_px'),
				'keyword_updatetime'=> time(),
			);
			$keyword_edit = D("Keyword")->save($data);
			if( $keyword_edit ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功"));
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"修改失败"));
			}
		}else{
			$data = array(
				'keyword_type'	 	=> I('keyword_type'),
				'keyword_name'	 	=> I('keyword_name'),
				'keyword_px'	 	=> I('keyword_px'),
				'keyword_createtime'=> time(),
			);
			$keyword_add = D("Keyword")->add($data);
			if( $keyword_add ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加成功"));
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"添加失败"));
			}
		}
	}
	public function keyword_delete() {
		if( I('keyword_id') ){
			D("Keyword")->delete(I('keyword_id'));
			$this->ajaxReturn(array("status"=> 2000, "message"=> "删除成功"));
		}else if( I('keywords_id') ){
			D("Keyword")->delete(I('keywords_id'));
			$this->ajaxReturn(array("status"=> 2002, "message"=> "删除成功"));
		}
	}
	public function banner_list() {
		// 分页
		$banner_count = D("Banner")->count();
		$page = new \Think\Page($banner_count,10);
		$banner_select = D("Banner")->order("banner_px desc")->limit($page->firstRow.','.$page->listRows)->select();
		$page->setConfig('header','<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$page->setConfig('first','首页');
		$page->setConfig('last','末页');
		$page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$this->assign('banner_select',$banner_select);
		$this->assign("page",$page->show());
		$this->assign("setTitle","banner管理列表页");
		$this->display("banner_list");
	}
	public function banner_data() {
		if( base64_encode(I("banner_data_id")) ){
			$banner_sel = D("Banner")->where( array("banner_id"=>base64_decode(I("banner_data_id"))) )->find();
			$this->assign("banner_sel",$banner_sel);
			$this->assign("setTitle","banner修改页面");
			$this->display("banner_data");
		}else{
			$this->assign("setTitle","banner添加页面");
			$this->display("banner_data");
		}
	}
	public function banner_list_pic_data() {
		if( I("banner_id") ){
			$upload = new \Think\Upload();
			$upload->exts = array("jpg","png","gif","jpeg","bmp");
			$upload->maxSize = 3145728;
			$upload->rootPath ='./Uploads/admin/';
			$upload->saveName = time()."_".mt_rand();
			$info = $upload->upload();
			$banner_id = D("Banner")->where( array("banner_id"=>I("banner_id")) )->find();
			if( empty($info) ){
				$banner_img1 = array(
					'banner_pic' => $banner_id['banner_pic'],
				);
			}else{
				$banner_img1 = array(
					'banner_pic' => empty($info['0'])?$banner_id['banner_pic']:$info['0']['savepath'].$info['0']['savename'],
				);
			}
			$banner_data = array(
				'banner_id' 		=> I("banner_id"),
				'banner_type'		=> I('banner_type'),
				'banner_title'		=> I('banner_title'),
				'banner_link'		=> I('banner_link'),
				'banner_content'	=> I('banner_content'),
				'banner_px'			=> I('banner_px'),
				'banner_updatetime'	=> time(),
			);
			$banner_save = array_merge($banner_img1,$banner_data);
			$banner_saves = D("Banner")->save($banner_save);
			if( $banner_saves ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功"),"JSON");
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2001,"message"=>"修改失败"),"JSON");
				return false;
			}
		}else{
		// 文件上传
		$upload = new \Think\Upload();
		$upload->maxSize   =  3145728 ;// 设置附件上传大小
		$upload->exts      =  array('jpg', 'gif', 'png', 'jpeg','bmp');// 设置附件上传类型
	    	$upload->rootPath  =  './Uploads/admin/'; // 设置附件上传根目录
	    	$upload->saveName  =	time()."_".mt_rand();
	    	$info = $upload->upload();
	    	if( $info ){
	    		$banner_img = array(
	    			'banner_pic' => $info['0']['savepath'].$info['0']['savename'],
	    		);
	    	}else{
	    		$this->ajaxReturn( array("status"=>-2002 , "message"=>$upload->getError() ) );
	    	}
			$banner_data = array(
				'banner_type'		=> I('banner_type'),
				'banner_title'		=> I('banner_title'),
				'banner_link'		=> I('banner_link'),
				'banner_content'	=> I('banner_content'),
				'banner_px'			=> I('banner_px'),
				'banner_createtime'	=> time(),
			);
			$data = array_merge($banner_data,$banner_img);
			$banner_add = D("Banner")->add($data);
			if( $banner_add ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加banner成功"),"JSON");
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2001,"message"=>"添加banner失败"),"JSON");
				return false;
			}
		}
	}
	// 执行删除
	public function del_banner() {
		if( I('banner_id_') ){
			$banner_img_url = D("Banner")->where(array("banner_id"=>I("banner_id_")))->find();
			$banner_del = D("Banner")->where( array("banner_id"=>I("banner_id_")) )->delete();
			if( $banner_del ){
				unlink("./Uploads/admin/".$banner_img_url['banner_pic']);
			}
			$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功"));
		}else if( I("banner_ids") ){
			$banner_local_url = D("Banner")->where(array("banner_id"=>I("banner_ids")))->find();
			$banner_del_ids = D("Banner")->delete(I("banner_ids"));
			if( $banner_del_ids ){
				unlink("./Uploads/admin/".$banner_local_url['banner_pic']);
			}
			$this->ajaxReturn(array("status"=>2002,"message"=>"删除成功"));
			return false;
		}
	}
	  /**
	   * @param 收货地址管
	   */
	public function user_address_list() {
		//分页带搜索
		$member_uid = D("Member as m")->where("plgox_user LIKE '%".I("search_fields")."%' ")->find();
		// $count = D("Address")->count();
		$plgox_uid = $member_uid['plgox_id'];
		$count = D("Address")->where(" address_memberid LIKE '%$plgox_uid%' ")->count();
		// 判断搜索的内容是否存在
		// if( empty($count) ){
		// 	echo "<script>alert('您当前搜索的内容不存在');location.href='user_address_list'</script>";
		// }
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","尾页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		if( I("search_fields") ){
			$address_select = D("Address as address")->where("address_memberid LIKE '%$plgox_uid%' ")->order("address_id desc")->join("INNER JOIN plgox_member as mem on mem.plgox_id = address.address_memberid")->limit($page->firstRow.','.$page->listRows)->select();
		}else{
			$address_select = D("Address as address")->order("address_id desc")->join("INNER JOIN plgox_member as mem on mem.plgox_id = address.address_memberid")->limit($page->firstRow.','.$page->listRows)->select();
		}
		$this->assign("address_select",$address_select);
		$this->assign("setTitle","收货地址管理");
		$this->assign("page",$page->show());
		$this->assign("search_name",I("search_fields"));
		$this->display("user_address_list");
	}
	public function user_address_data() {
		if( !empty( base64_decode(I("address_edit_id")) ) ) {
			$address_edit = D("Address as address")->where( array("address_id"=>base64_decode(I("address_edit_id"))) )->join("INNER JOIN plgox_member as mem on mem.plgox_id = address.address_memberid")->find();
			$this->assign("address_edit",$address_edit);
			// 省份
			$city_ = D("City")->where(array("city_pid"=>array("EQ",1)))->select();
			$this->assign("city_",$city_);			
			// 地级市
			$where['city_pid'] =$address_edit['address_city_sheng'];
			$shi = D("City")->where($where)->select();
			$this->assign("shi",$shi);
			// 县/镇/区
			$xian['city_pid'] = $address_edit['address_city_shi'];
			$xian = D("City")->where($xian)->select();
			$this->assign("xian",$xian);
			$this->assign("setTitle","修改地址管理");
			$this->display("user_address_data");
		}
	}
	// 二级 三级 级联获取
	public function getArea() {
		$where['city_pid']  = I("cityId");
		$getCity = D("City")->where($where)->select();
		$this->ajaxReturn($getCity);
	}
	// 修改收货地址
	public function address_edit() {
		$memberuid = D("Member")->where( array( "plgox_user"=>I("memberuid") ) )->find();
		$data = array(
			'address_id'			=> I("address_id"),
			'address_memberid'		=> $memberuid['plgox_id'],
			'address_city_sheng'	=> I("city_sheng"),
			'address_city_shi'		=> I("city_shi"),
			'address_city_xian'		=> I("city_xian"),
			'address_default'		=> I("default_address"),
			'address_default_type'	=> I("setup_address_default"),
			'address_name'			=> I("address_name"),
			'address_tel'			=> I("address_tel"),
			'address_createtime'	=> time(),
		);
		$address_add = D("Address")->save($data);
		if( $address_add ){
			$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功"));
		}else{
			$this->ajaxReturn(array("status"=>-2000,"message"=>"修改失败"));
		}
	}
	/**
	 * @param 执行删除
	 */
	public function del_address() {
		if( I("address_id_") ){
			D("Address")->delete(I("address_id_"));
			$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功"));
			return false;
		}else if( I("address_ids_") ){
			D("Address")->delete(I("address_ids_"));
			$this->ajaxReturn(array("status"=>2002,"message"=>"删除成功"));
			return false;
		}
	}
	// 报修管理
	public function repair_admin() {
		$this->assign("setTitle","报修管理列表");
		
		$this->display("repair_admin");
	}

}
?>