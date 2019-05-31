<?php  
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
	function _initialize() {
		$user = get_login_user();
		if(!empty($user)){
			$this->assign('loguser',$user);
		}
	}
}
?>