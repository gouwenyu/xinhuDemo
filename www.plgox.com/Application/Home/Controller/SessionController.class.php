<?php 
namespace Home\Controller;
use Think\Controller;
class SessionController extends CommonController {
	/**
	 * @param session集成
	 */
	function _initialize() {
		parent::_initialize();
 		
		
		$user = get_login_user();
		if( empty($user['plgox_id']) ){
			if( IS_AJAX ){
				$this->ajaxReturn(2,"请先登录");
			}else{
				$this->redirect('Index/index');
			}
		}
	}
}
?>