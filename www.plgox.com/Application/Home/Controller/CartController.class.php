<?php  
namespace Home\Controller;
use Think\Controller;
class CartController extends CommonController {
	/**
	 * @param 订单结算
	 */
	public function dingdan_jiesuan() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		foreach (explode(",", I('shop_id')) as $key => $value) {
			$dingdan_jiesuan[] = D("Cart as cart")->where(array("cart_id"=>array("eq",$value),"cart_radio_status"=>array("eq",I('shop_status')),"cart_memberuid"=>array("eq",get_login_userid()),'cart_status'=>array("eq",1)))
			->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
			->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
			->join("left join plgox_zulin as zulin on zulin.zulin_id = cart.cart_day_number_id")
			->find();	
		}
		// 信用金
		$xyj_ = D("Xyj")->find();
		$this->assign("xyj_",$xyj_);
		// 配送地址
		$this->assign("address_id",D("Address")->where(array("address_memberid"=>array("eq",get_login_userid())))->select());
		$this->assign("city_id",D("City")->where(array("city_pid"=>array("eq",1)))->select());
		$this->assign("dingdan_jiesuan",$dingdan_jiesuan);
		$this->assign("order_detil_status",$dingdan_jiesuan['0']['cart_radio_status']);
		// $this->assign("pay_number",$_SESSION['pay_number']['pay_number']);
		// 统一支付付款状态
		$this->assign("shop_pay_status",I("shop_pay_status"));
		$this->assign("setTitle","魄力餐厨-订单结算");
		$this->display("dingdan_jiesuan");
	}
	public function AjaxMessage(){
		$message_del = D("Message")->delete(I('message_id'));
		if( $message_del ){
			$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功"));
			return false;
		}else{
			$this->ajaxReturn(array("status"=>-2000,"message"=>"删除失败"));
			return false;
		}
	}
	// 立即下单
	public function Ajaxzujin() {
		$member = D("Member")->where(array('plgox_id'=>array("eq",get_login_userid())))->find();
		$data = array(
			'plgox_id' => $member['plgox_id'],
			'plgox_zulin_xiey' => 1,
		);
		$qianyue = D("Member")->save($data);
		if( $qianyue ){
			$this->ajaxReturn(array("status"=>2000,"message"=>"感谢您的信任,祝您使用愉快"));
			return false;
		}else{
			$this->ajaxReturn(array("status"=>-2000,"message"=>"确认签约签约失败,请重新确认"));
			return false;
		}			
	}
	public function Ajaxdodingdan() { //立即结算的时候 把购物车的商品添加到 订单表里面
		$order_cart_id = I('order_cart_id');
		$data_['pay_number'] = date('YmdHis').mt_rand(111111,999999); //统一支付的订单号
		foreach( $order_cart_id as $key => $val ){
			// 购物车表
			$res = D("Cart as cart")->where(array("cart_id"=>array("eq",$val)))
			->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
			->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
			->find();
			$data = array();
			$data['order_cart_id'] = $val; // 购物车id
			$data['order_addressid'] = I('order_addressid'); // 地址id
			$data['order_memberuid'] = get_login_userid(); // 当前用户id
			if( I("order_detil_status") == 1 ){ // 租赁
				$data['order_detil_status'] = 1; //订单隶属
				$data['order_xyj_status'] = 1; //信用金
				$data['order_detil_number1'] = date('Ymd').mt_rand(111111,999999); // 信用金伪订单号
				$data['order_detill_xyj'] = $res['cart_xyj_prices']; // 信用金
				$data['order_rent'] = $res['specifications_rent']*$res['cart_number']; // 租金
				$data['order_deposit'] = $res['cart_deposit']*$res['cart_number']; // 押金

			}else if( I("order_detil_status") == 2 ){ // 购买
				$data['order_detil_status'] = 2; //订单隶属
				$data['order_mm_prices'] = $res['cart_prices']; //购买金额
			}
			$data['order_number'] = time().mt_rand(111111,999999);
			$data['order_createtime'] = time();
			$data['order_shangjia_id'] = $res['cart_shangjia_id'];
			$data['order_pay_status'] = 1;
			$data['order_detil_liuyan'] = I('order_detil_liuyan');
			if( empty($_SESSION['invoice_id']) ){
				$data['order_fapiao_id'] = "";
			}else{
				$data['order_fapiao_id'] = $_SESSION['invoice_id'];
			}
			// 自营产品订单状态改变
			if( $res['share_self_support'] == 1 ){
				$data['order_type'] = 1;
			}else{
				$data['order_type'] = 2;
			}
			$data_i = array_merge($data_,$data);
			$order_detils = D("Order_detil")->add($data_i);
			// 修改购物车商品的状态
			$cart_data['cart_id'] = $val;
			$cart_data['cart_status'] = 2;
			$cart_status = D("Cart as cart")->save($cart_data);
		}
		if( $order_detils ){
			session("invoice_id",null);
			$this->ajaxReturn(array("status"=>2000,"message"=>array("下单成功,已加入到订单中心!")));
			return false;
		}else{
			$this->ajaxReturn(array("status"=>-2000,"message"=>array("下单失败")));
			return false;
		}
	}
	public function AjaxAddressDel(){
		if( I('address_id') ){
			$address_ids = D("Address")->delete(I('address_id'));
			if( $address_ids ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"删除失败或者已经删除!"));
				return false;
			}
		}
	}
	public function AjaxAddress() {
		$where['city_pid'] = I('city_id');
		$city = D("City")->where($where)->select();
		$this->ajaxReturn($city);
	}
	public function AjaxAddress_add() {
		$data = array(
			'address_name' => I('address_name'),
			'address_city_sheng' => I('address_city_sheng'),
			'address_city_shi' => I('address_city_shi'),
			'address_city_xian' => I('address_city_xian'),
			'address_default' => I('address_default'),
			'address_tel' => I('address_tel'),
			'address_memberid' => get_login_userid(),
			'address_createtime' => time()
		);
		$data_add = D("Address")->add($data);
		if( $data_add ){
			$this->ajaxReturn(array("status"=>2000));
		}else{
			$this->ajaxReturn(array("status"=>-2000,"message"=>"添加收货地址失败!"));
		}
	}
	//发票添加
	public function invoice_add(){
		$data = array(
		    'invoice_type' => I('invoice_type'),
			'invoice_title' => I('invoice_title'),
			'invoice_shibiehao' => I('invoice_shibiehao'),
			'invoice_createtime' => time()
		);
		$data_add = D("Invoice")->add($data);
		if( $data_add ){
			session("invoice_id",$data_add);
			$this->ajaxReturn(array("status"=>2000,"ftpd"=>I('invoice_title')));
		}
		else{
			$this->ajaxReturn(array("status"=>-2000,"message"=>"添加发票失败!"));
		}
	}
	public function AjaxAddress_update() {
		$data = array(
			'address_name' => I('address_name'),
			'address_city_sheng' => I('address_city_sheng'),
			'address_city_shi' => I('address_city_shi'),
			'address_city_xian' => I('address_city_xian'),
			'address_default' => I('address_default'),
			'address_tel' => I('address_tel'),
			'address_memberid' => get_login_userid(),
			'address_createtime' => time()
		);
		$data_add = D("Address")->where(array('address_id'=>I('address_id')))->save($data);
		if( $data_add ){
			$this->ajaxReturn(array("status"=>2000));
		}else{
			$this->ajaxReturn(array("status"=>-2000,"message"=>"修改收货地址失败!"));
		}
	}
	public function address_default() {
		if(I('address_id')){
		   $only_id=D("Address")->where(array('address_id' =>I('address_id')))->field('address_memberid') ->select();

		   $data = array(
				'address_default_type' =>0
			);
			$data_save = D("Address")->where(array('address_memberid'=>$only_id[0]['address_memberid']))->save($data);
			$data1 = array(
				'address_id' => I('address_id'),
				'address_default_type' => I('address_default_type')
			);
			
			$data_save1 = D("Address")->save($data1);
			if( $data_save1 ){
				$this->ajaxReturn(array("status"=>2000));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"当前地址已经是默认地址!"));
				return false;
			}
		}
	}
	/**
	 * @param 租赁车
	 */
	public function gouwu_che() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		// 租赁 商品
		$cart = D("Cart as cart")->where(array("cart_radio_status"=>array("eq",1),"cart_memberuid"=>array("eq",get_login_userid()),'cart_status'=>array("eq",1)))
		->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
		->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
		->join("left join plgox_zulin as zulin on zulin.zulin_id = cart.cart_day_number_id")
		->select();
		/*// 购买 商品
		$shop_cart = D("Cart as cart")->where(array("cart_radio_status"=>array("eq",2),"cart_memberuid"=>array("eq",get_login_userid()),'cart_status'=>array("eq",1)))
		->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
		->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
		->join("left join plgox_zulin as zulin on zulin.zulin_id = cart.cart_day_number_id")
		->select();*/
		$vvs = D("Cart as cart")->where(array( "cart_memberuid"=>array("eq",get_login_userid()),'cart_status'=>array("eq",1)))->join("left join plgox_member as vp on vp.plgox_id = cart.cart_memberuid")
		->select();
		// 租赁商品统计
		$cart_count = D("Cart")->where(array("cart_radio_status"=>array("eq",1),"cart_memberuid"=>array("eq",get_login_userid()),'cart_status'=>array("eq",1)))->count();
		$this->assign("cart_count",$cart_count);
		/*// 购物车商品
		$cart_count_ = D("Cart")->where(array("cart_radio_status"=>array("eq",2),"cart_memberuid"=>array("eq",get_login_userid()),'cart_status'=>array("eq",1)))->count();
		$this->assign("cart_count_",$cart_count_);*/
		$this->assign("cart",$cart);
		// $this->assign("shop_cart",$shop_cart);
		// 获取信用金
		$get_xyj = D("Xyj")->find();
		$this->assign("get_xyj",$get_xyj);
		$this->assign("setTitle","魄力餐厨-购物车");
		$this->display("gouwu_che");	
	}
	// 购物车
	public function gouwu_cart(){
		// 购买 商品
		$shop_cart = D("Cart as cart")->where(array("cart_radio_status"=>array("eq",2),"cart_memberuid"=>array("eq",get_login_userid()),'cart_status'=>array("eq",1)))
		->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
		->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
		->join("left join plgox_zulin as zulin on zulin.zulin_id = cart.cart_day_number_id")
		->select();
		$this->assign("shop_cart",$shop_cart);
		$cart_count_ = D("Cart")->where(array("cart_radio_status"=>array("eq",2),"cart_memberuid"=>array("eq",get_login_userid()),'cart_status'=>array("eq",1)))->count();
		$this->assign("cart_count_",$cart_count_);
		$this->display("gouwu_cart");
	}

	// 删除购物车商品
	public function cart_del() {
		if( I("cart_id") ){
			D('Cart')->delete(I('cart_id'));
			$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功"));
			return false;
		}else if( I("cart_ids") ){
			D('Cart')->delete(I('cart_ids'));
			$this->ajaxReturn(array("status"=>2001,"message"=>"全部删除成功"));
			return false;
		}else if( I("carts_id") ){
			D('Cart')->delete(I('carts_id'));
			$this->ajaxReturn(array("status"=>2002,"message"=>"清空购物车成功"));
			return false;
		}
	}
	public function cart_numer() {
		// 获取信用金
		$get_xyj = D("Xyj")->find();
		// 加
		if( I('cart_id') ){
			$Carts_ids = D("Cart as cart")->where(array("cart_id"=>array("eq",I('cart_id'))))->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")->find();
			$data = array(
				'cart_id' => I('cart_id'),
				'cart_number' => $Carts_ids['cart_number']+1>=$Carts_ids['specifications_stock']?$Carts_ids['specifications_stock']:$Carts_ids['cart_number']+1,
				'cart_rent' => ($Carts_ids['cart_number']+1)*$Carts_ids['specifications_rent'] >= ($Carts_ids['specifications_rent']*$Carts_ids['specifications_stock']) ? ($Carts_ids['specifications_rent']*$Carts_ids['specifications_stock']) : ($Carts_ids['cart_number']+1)*$Carts_ids['specifications_rent'] ,
				'cart_xyj_prices' => $Carts_ids['cart_number']+1>$Carts_ids['specifications_stock']?$Carts_ids['cart_xyj_prices']:(($Carts_ids['cart_number']+1)*$Carts_ids['specifications_deposit'])*$get_xyj['xyj_prices'],
				'cart_prices' => $Carts_ids['cart_number']+1 >= $Carts_ids['specifications_stock'] ? ($Carts_ids['specifications_prices']*$Carts_ids['specifications_stock']) : ($Carts_ids['specifications_prices']*($Carts_ids['cart_number']+1)),
			);
			D("Cart")->save($data);
		}else if( I('cart_ids') ){
			$Carts_ids = D("Cart as cart")->where(array("cart_id"=>array("eq",I('cart_ids'))))->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")->find();
			// 减
			$data = array(
				'cart_id' => I('cart_ids'),
				'cart_number' => $Carts_ids['cart_number']-1<=0?1:$Carts_ids['cart_number']-1,
				'cart_rent' => $Carts_ids['cart_rent'] <= $Carts_ids['specifications_rent']?$Carts_ids['cart_rent']:($Carts_ids['cart_number']-1)*$Carts_ids['specifications_rent'],
				'cart_xyj_prices' => $Carts_ids['cart_number']-1<=0?$Carts_ids['specifications_deposit']*$get_xyj['xyj_prices']:(($Carts_ids['cart_number']-1)*$Carts_ids['specifications_deposit'])*$get_xyj['xyj_prices'],
				'cart_prices' => $Carts_ids['cart_number']-1 <= 0 ? $Carts_ids['specifications_prices'] : ($Carts_ids['specifications_prices']*($Carts_ids['cart_number']-1)),
			);
			D("Cart")->save($data);
		}else if( I('carts_ids') ){
			$carts_id = D("Cart as cart")->where(array("cart_id"=>array("eq",I('carts_ids'))))->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")->find();
			// 输入的数量 往上加
			if( I("text_number") > 0 ){
				$data = array(
					'cart_id' => I('carts_ids'),
					'cart_number' => intval(I('text_number')) >= $carts_id['specifications_stock'] ? $carts_id['specifications_stock'] : intval(I('text_number')),
					'cart_rent' => intval(I('text_number'))*$carts_id['specifications_rent'] >= ($carts_id['specifications_rent']*$carts_id['specifications_stock']) ? ($carts_id['specifications_rent']*$carts_id['specifications_stock']) : intval(I('text_number'))*$carts_id['specifications_rent'],
					'cart_xyj_prices' => intval(I('text_number')) > $carts_id['specifications_stock'] ? $carts_id['cart_xyj_prices'] : (intval(I('text_number'))*$carts_id['specifications_deposit'])*$get_xyj['xyj_prices'],
					'cart_prices' => intval(I('text_number')) >= $carts_id['specifications_stock'] ? (intval($carts_id['specifications_prices']*$carts_id['specifications_stock']) ) : (intval(I('text_number'))*$carts_id['specifications_prices']),
				);
			// 输入的数量 往下减 
			}else if( I("text_number1") <= 0 ){
				$data = array(
					'cart_id' => I('carts_ids'),
					'cart_number' => intval(I('text_number1')) <= 0 ? 1 :  intval(I('text_number1')),
					'cart_rent' =>  intval(I('text_number1'))*$carts_id['cart_rent'] <=  $carts_id['specifications_rent'] ? $carts_id['specifications_rent'] : intval(I('text_number1'))*$carts_id['cart_rent'],
					'cart_xyj_prices' => intval(I('text_number1')) <= 0 ? $carts_id['specifications_deposit']*$get_xyj['xyj_prices'] : (intval(I('text_number1'))*$carts_id['specifications_deposit'])*$get_xyj['xyj_prices'],
					'cart_prices' => intval(I('text_number1')) <= 0 ? $carts_id['specifications_prices'] : intval(I("text_number1")*$carts_id['specifications_prices']),
				);
			}
			D("Cart")->save($data);
			// 最终数量值查询
			$text_cart_id = D("Cart as cart")->where(array("cart_id"=>array("eq",I('carts_ids'))))->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")->find();
			$this->ajaxReturn($text_cart_id);	
		}
		$this->ajaxReturn($Carts_ids);
	}
	// 价格请求
	public function ajaxData() {
		$cart_data = D("Cart")->where(array("cart_id"=>array("eq",I('cart_ids'))))->find();
		$this->ajaxReturn($cart_data);
	}
	// 商品统计
	public function AjaxCount(){
		if( I('cart_id') ){
			$catr_ids = explode(",",I('cart_id'));
			foreach( $catr_ids as $k=>$v){
				$cart_id[] = D("Cart")->where(array("cart_id"=>array("eq",$v)))->find();
			}
			$this->ajaxReturn($cart_id);
		} 
	}
	/**
	 * @param 切换城市
	 */
	public function qiehuan_city() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		$city = D("City")->where(" city_pid = 1 ")->order("city_first asc")->select();
		foreach( $city as $k=>$v ){
			$city_arr[] = D("City")->where(" city_pid = ".$v['city_id']." ")->select();
		}
		$this->assign("city",$city);
		$this->assign("city_arr",$city_arr);
		$this->display("qiehuan_city");
	}
	/**
	 * @param 消息
	 */
	public function message() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		$count = D("Message")->where(array("message_uid"=>array("eq",get_login_userid()),"message_type"=>array("eq",1)))->count();
		$page = new \Think\Page($count,28);
		$page->setConfig("header","<div class='page_style'>共<b>%TOTAL_PAGE%</b>页</div><div class='page_djy'>/第<b><input type='text' value=%NOW_PAGE% class='bdz'/></b>页</div><div class='qdtz'>确定</div>");
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        $page->setConfig("first","首页");
        $page->setConfig("last","尾页");
        $page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$this->assign("message",D("Message")->where(array("message_uid"=>array("eq",get_login_userid()),"message_type"=>array("eq",1)))->limit($page->firstRow.','.$page->listRows)->select());
		$this->assign("page",$page->show());
		$this->display("message");
	}
	/**
	 * @param 查看详情
	 */
	public function look_xiangqin() {
		$data = array(
			'message_id' => I('message_id'),
			'message_status' => 1
		);
		D("Message")->save($data);
		$this->assign("message_",D("Message")->where(array('message_id'=>I('message_id')))->find());
		$this->display("look_xiangqin");
	}
	/**
	 * @param 商品详情
	 */
	public function shop_detil() {
		$share = D("Share")->where(array("share_id"=>array("EQ",I("id"))))
		->join("left join plgox_brand as brand on plgox_share.share_the_brand_id = brand.brand_id")
		->join("left join plgox_classify as classify on plgox_share.share_classify_pid = classify.classify_id")
		->join("left join plgox_zulin as zulin on zulin.zulin_id = plgox_share.share_day_number_id")
		->join("left join plgox_pingjia as pj on pj.pingjia_share_id = plgox_share.share_id")
		->find();
		$specifications = D("Specifications")->where(array("specifications_id"=>array("IN",$share['share_product_type_id'])))->select();
		$this->assign("specifications",$specifications);
		$share_many_img = explode(",",$share['share_many_img']);
		// 统计代码
		$pingjia = D("Pingjia")->where(array("pingjia_share_id"=>array("EQ",I("id"))))->count();
		// 评价select查询
		$pingjia_data = D("Pingjia as pj")->where(array("pingjia_share_id"=>array("EQ",I("id"))))
		->join("plgox_member as user on user.plgox_id = pj.pingjia_memberuid")
		->select();
		$this->assign("pingjia_data",$pingjia_data);
		$this->assign("pingjia_count",$pingjia);
		if( $share['share_self_support'] == 2 ){ // 商家
			$this->assign("share_pq",$share['share_sj_pq']);
		}else if( $share['share_self_support'] == 1 ){ // 自营
			// $this->assign("share_pq",$share['brand_name']);
			$this->assign("share_pq",$share['share_sj_pq']);
		}
		foreach ($pingjia_data as $key => $value) {
			$img[] = explode(",",$value['pingjia_img']);
		}
		$this->assign("images",$img);
		$this->assign("share",$share);
		$this->assign("share_many_img",$share_many_img);
		// 同款推荐
		$tongkuang = D("Tongkuang")->where(array("tongkuang_share_id"=>array("EQ",I('id'))))->find();
		$tongkuangs = explode(",",$tongkuang['tongkuang_product_id']);
		foreach( $tongkuangs as $val ){
			$product_list[] = D("Share")->where(array("share_id"=>$val ))->select();
		}
		$product_lists = $product_list;
		$this->assign("product_lists",$product_lists);
		$this->display("shop_detil");
	}
	public function ajaxFcuntion() {
		$where['specifications_id'] = I("specifications_id");
		$specifications = D("Specifications as sp")->where($where)->join("left join plgox_zulin as zulin on zulin.zulin_id = sp.specifications_day_number_id")->select();
		$this->ajaxReturn($specifications);
	}
	// 认证检测
	public function renzheng_check() {
		$member = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
		$this->ajaxReturn($member);
	}
	// 加入租售车
	public function ajaxCart() { 
		// 查询商家的id
		$share = D("Share")->where(array("share_id"=>array("eq",I('share_id'))))->find();
		$cart_is = D("Cart")->where(array("cart_product_id"=>array("eq",I('cart_product_id')),"cart_share_id"=>array("eq",I('share_id')),"cart_memberuid"=>array("eq",get_login_userid()),"cart_status"=>array("eq",1)))->find();
		// 获取天数
		$specifications = D("Specifications")->where( array( "specifications_id"=>array("eq",I('cart_product_id') ) ) )->find();
		// 信用金获取
		$get_xyj = D("Xyj")->find();
		if( empty($cart_is) ){
			$data = array(
				// 商品属性id
				'cart_product_id' => I('cart_product_id'),
				// 数量
				'cart_number' 	=> I("catr_number"),
				// 租赁天数id
				'cart_day_number_id' => $specifications['specifications_day_number_id'],
				// 用户id
				'cart_memberuid' => get_login_userid(),
				'cart_status' => 1,
				// 商家id
				'cart_shangjia_id' => $share['share_member_uid'],
				// 租金
				'cart_rent' => $specifications['specifications_rent'],
				// 押金
				'cart_deposit' =>$specifications['specifications_deposit'],
				// 出售价
				'cart_prices' => $specifications['specifications_prices'],
				//买卖/租赁状态
				'cart_radio_status' => 1,
				// 商品id
				'cart_share_id' => I('share_id'),
				'cart_type' => I('ctar_type'),
				// 信用金
				'cart_xyj_prices' => $specifications['specifications_deposit']*$get_xyj['xyj_prices'],
				'cart_createtime' => time()
			);
			$data_data = D("Cart")->add($data);
		}else{
			$data = array(
				// 购物车id
				'cart_id' => $cart_is['cart_id'],
				// 商品属性id
				'cart_product_id' => I('cart_product_id'),
				// 数量
				'cart_number' 	=> $cart_is['cart_number']+I('catr_number'),
				// 租赁天数id
				'cart_day_number_id' => $specifications['specifications_day_number_id'],
				// 商家id
				'cart_shangjia_id' => $share['share_member_uid'],
				// 租金
				'cart_rent' => $specifications['specifications_rent']*($cart_is['cart_number']+1),
				// 押金
				'cart_deposit' => $specifications['specifications_deposit'],
				// 出售价
				'cart_prices' => $specifications['specifications_prices'],
				//买卖/租赁状态
				'cart_radio_status' => 1,
				// 商品id
				'cart_share_id' => I('share_id'),
				'cart_memberuid' => get_login_userid(),
				'cart_type' => I('ctar_type'),
				// 信用金
				'cart_xyj_prices' => ($specifications['specifications_deposit']*($cart_is['cart_number']+1))*$get_xyj['xyj_prices'],
				'cart_createtime' => time()
			);
			$data_data = D("Cart")->save($data);
		}
		if( $data_data ){
			$this->ajaxReturn(array("status"=>2000));
			return false;
		}else{
			$this->ajaxReturn(array("status"=>-2000));
			return false;
		}
	}
	// 加入购物车
		public function ajaxCart_() { 
		// 查询商家的id
		$share = D("Share")->where(array("share_id"=>array("eq",I('share_id'))))->find();
		$cart_is = D("Cart")->where(array("cart_product_id"=>array("eq",I('cart_product_id')),"cart_share_id"=>array("eq",I('share_id')),"cart_memberuid"=>array("eq",get_login_userid()),"cart_status"=>array("eq",1)))->find();
		// 获取天数
		$specifications = D("Specifications")->where( array( "specifications_id"=>array("eq",I('cart_product_id') ) ) )->find();
		// 信用金获取
		$get_xyj = D("Xyj")->find();
		if( empty($cart_is) ){
			$data = array(
				// 商品属性id
				'cart_product_id' => I('cart_product_id'),
				// 数量
				'cart_number' 	=> I("catr_number"),
				// 租赁天数id
				'cart_day_number_id' => $specifications['specifications_day_number_id'],
				// 用户id
				'cart_memberuid' => get_login_userid(),
				'cart_status' => 1,
				// 商家id
				'cart_shangjia_id' => $share['share_member_uid'],
				// 租金
				'cart_rent' => $specifications['specifications_rent'],
				// 押金
				'cart_deposit' =>$specifications['specifications_deposit'],
				// 出售价
				'cart_prices' => $specifications['specifications_prices'],
				//买卖/租赁状态
				'cart_radio_status' => 2,
				// 商品id
				'cart_share_id' => I('share_id'),
				'cart_type' => I('ctar_type'),
				// 信用金
				'cart_xyj_prices' => $specifications['specifications_deposit']*$get_xyj['xyj_prices'],
				'cart_createtime' => time()
			);
			$data_data = D("Cart")->add($data);
		}else{
			$data = array(
				// 购物车id
				'cart_id' => $cart_is['cart_id'],
				// 商品属性id
				'cart_product_id' => I('cart_product_id'),
				// 数量
				'cart_number' 	=> $cart_is['cart_number']+I('catr_number'),
				// 租赁天数id
				'cart_day_number_id' => $specifications['specifications_day_number_id'],
				// 商家id
				'cart_shangjia_id' => $share['share_member_uid'],
				// 租金
				'cart_rent' => $specifications['specifications_rent']*($cart_is['cart_number']+1),
				// 押金
				'cart_deposit' => $specifications['specifications_deposit'],
				// 出售价
				'cart_prices' => $specifications['specifications_prices']*($cart_is['cart_number']+1),
				//买卖/租赁状态
				'cart_radio_status' => 2,
				// 商品id
				'cart_share_id' => I('share_id'),
				'cart_memberuid' => get_login_userid(),
				'cart_type' => I('ctar_type'),
				// 信用金
				'cart_xyj_prices' => ($specifications['specifications_deposit']*($cart_is['cart_number']+1))*$get_xyj['xyj_prices'],
				'cart_createtime' => time()
			);
			$data_data = D("Cart")->save($data);
		}
		if( $data_data ){
			$this->ajaxReturn(array("status"=>2000));
			return false;
		}else{
			$this->ajaxReturn(array("status"=>-2000));
			return false;
		}
	}
	// 改变购物车租赁/购买状态
	public function AjaxCart_status(){
		if( I('status') == 1 ){ //租赁
			$data = array(
				'cart_id' => I('cart_id'),
				'cart_radio_status' => 1
			);
		}else if( I('status') == 2 ){ // 购买
			$data = array(
				'cart_id' => I('cart_id'),
				'cart_radio_status' => 2
			);
		}
		$cart_save =  D("Cart")->save($data);
		if( $cart_save ){
			$this->ajaxReturn(array("status"=>2000,"message"=>"移动商品成功!"));
		}else{
			$this->ajaxReturn(array("status"=>-2000,"message"=>"移动商品失败!"));
		}
	}
}
?>