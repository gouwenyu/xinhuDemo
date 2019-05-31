<?php 
namespace Admin\Controller;
use Think\Controller;
class SessionController extends CommonController {
	public function _initialize()
	{
		parent:: _initialize();

		$user = $_SESSION['plgox_user'];
		if( empty(session("plgox_user")) ){
			$this->redirect("Tourist/index");
		}else{
			$this->assign("loginuser",$user);
		}
	}
}
?>