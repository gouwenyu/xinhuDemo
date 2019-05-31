<?php  
namespace Home\Widget;
use Think\Controller;
class CommonWidget extends Controller {
	/**
	 * @param Widget扩展一般用于页面组件的扩展。
	 */
	public function header() {
		/**
	 	  * @param header为公共头部
	 	  */
		// 我的租赁车
	 	$cart = D("Cart")->where( array("cart_radio_status"=>array("eq",1),"cart_memberuid"=>array( "eq",get_login_userid()),'cart_status'=>array("eq",1)))->select();
		$this->assign("cart",count($cart));
        // 我的购物车
        $shop_cart = D("Cart")->where( array("cart_radio_status"=>array("eq",2),"cart_memberuid"=>array( "eq",get_login_userid()),'cart_status'=>array("eq",1)))->select();
		$this->assign("shop_cart",count($shop_cart));

		$this->assign("message_count",D("Message")->where( array("message_status"=>array("eq",0),"message_uid"=>array("eq",get_login_userid())) )->count());
		$is_renzheng = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
        if( $is_renzheng['plgox_is_renzheng'] == '0' ){
        	$is_sjrz = 1;
        }else if( $is_renzheng['plgox_is_renzheng'] == '1' ){
        	$is_sjrz = 2;
        }
        $this->assign("sjrz_renzheng",$is_renzheng);
        $this->assign("is_sjrz",$is_sjrz);
		$this->display("Widget:header");

	}
	/**
	 * @param 商品搜索
	 */
	public function header1() {
	
        $this->display("Widget:header1");
	}
	/**
	 * @param 登录
	 */
	public function header3() {
        $this->display("Widget:header3");
	}
	/**
	 * @param 登录
	 */
	public function htsy_top() {
		if(empty(get_login_userid())){
			$this->redirect("Tourist/login");
			exit;
		}
		$is_renzheng = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();

        if( $is_renzheng['plgox_is_renzheng'] == '0' ){
        	$is_sjrz = 1;
        }else if( $is_renzheng['plgox_is_renzheng'] == '1' ){
        	$is_sjrz = 2;
        }

        $this->assign("sjrz_renzheng",$is_renzheng);

        $this->assign("is_sjrz",$is_sjrz);
		
		$this->display("Widget:htsy_top");
	}
	/**
	 * @param 底部公共
	 */
	public function footer() {
		$this->display("Widget:footer");
	}
	
	/**
	 * @param Widget二手闲置
	 */
	public function header_esxz() {
		/**
	 	  * @param header为公共头部
	 	  */
		// 租赁
		$cart = D("Cart")->where( array( "cart_radio_status"=>array("eq",1),"cart_memberuid"=>array( "eq",get_login_userid()),'cart_status'=>array("eq",1)))->select();
		$this->assign("cart",count($cart));
		// 购买
		$shop_cart = D("Cart")->where( array( "cart_radio_status"=>array("eq",2),"cart_memberuid"=>array( "eq",get_login_userid()),'cart_status'=>array("eq",1)))->select();
		$this->assign("shop_cart",count($shop_cart));

		$is_renzheng = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
        if( $is_renzheng['plgox_is_renzheng'] == '0' ){
        	$is_sjrz = 1;
        }else if( $is_renzheng['plgox_is_renzheng'] == '1' ){
        	$is_sjrz = 2;
        }
        $this->assign("sjrz_renzheng",$is_renzheng);
        $this->assign("is_sjrz",$is_sjrz);


		$this->display("Widget:header_esxz");
	}
	/**
	 * @param Widget二手闲置
	 */
	public function header1_esxz() {
		/**
	 	  * @param header为公共头部
	 	  */
		if(empty($_SESSION['plgox_username']['plgox_id'])){
			$a = 1;
		}else{
			$a = 2;
		}
		$is_renzheng = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
        if( $is_renzheng['plgox_is_renzheng'] == '0' ){
        	$is_sjrz = 1;
        }else if( $is_renzheng['plgox_is_renzheng'] == '1' ){
        	$is_sjrz = 2;
        }
        $class_ify = D("juezhi_brand")->where(array("juezhi_brand_id"=>array("eq",I("share_id3"))))->find();
        $this->assign("class_ify",$class_ify);
        $this->assign("sjrz_renzheng",$is_renzheng);
        $this->assign("is_sjrz",$is_sjrz);
		$this->assign("check",$a);
		$this->display("Widget:header1_esxz");
	}
	/**
	 * @param 底部公共
	 */
	public function footer_esxz() {
		$this->display("Widget:footer_esxz");
	}
	/**
	 * @param 调用公共搜索头部
	 */
	public function header1_search() {
		/**
	 	  * @param header为公共头部
	 	  */
		$this->display("Widget:header1_search");
	}
}
?>