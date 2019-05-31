<?php  
namespace Home\Controller;
use Think\Controller;
class UserController extends CommonController {
	/**
	 * @param 我的头部
	 */
	public function my_top() {
		$this->display("my_top");
	}
	/**
	 * @param 我的保修
	 */
	public function my_baoxiu() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		$selecteds = D("Select_content as set_c")->join('left join plgox_member as member on member.plgox_id = set_c.select_memberuid')->select();
		$this->assign("selecteds",$selecteds);
		$orders = D("Order_detil as orders")->where(array('order_id'=>array('eq',I("baoxiu_id"))))
		->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id")
		->join("left join plgox_member as member on member.plgox_id = cart.cart_shangjia_id")
		->find();
		$this->assign("orders",$orders);
		$this->assign("baoxiu_id",I("baoxiu_id"));
		$this->display("my_baoxiu");
	}
	// 报修 投诉 评价 
	public function Ajax_order_BX_TS_PJ() {
		if( I("order_baoxiu") ){
			
			// 图片处理
			$image = new \Think\Image(); 
			// 上传类
			$config = array(
			    'maxSize'    =>   3145728,
			    'rootPath'   =>   './Uploads/home_baoxiu/',
			    'saveName'   =>  array('uniqid',''),
			    'exts'       =>  array('jpg', 'gif', 'png', 'jpeg', 'bmp'),
			);
			$upload = new \Think\Upload($config);
			$info = $upload->upload();
			if( !$info ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>$upload->getError()));
				return false;
			}else{
				$data_ = array(
					'repair_img' => $info['0']['savepath'].$info['0']['savename'],
				);
			}
			//  订单关联数据
			$orders = D("Order_detil as orders")->where(array('order_id'=>array('eq',I("order_baoxiu"))))
			->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id")
			->join("left join plgox_member as member on member.plgox_id = cart.cart_shangjia_id")
			->find();
			// 用户关联数据
			$user_id = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
			$data = array(
				'repair_order_id' => I("order_baoxiu"),
				'repair_vip' => get_login_userid(),
				'repair_uid' => $orders['plgox_id'],
				'repair_reason_id' => I('repair_reason'),
				'repair_tel' => $user_id['plgox_tel'],
				'repair_shangjia_tel' => $orders['plgox_tel'],
				'repair_content' => I('repair_content'),
				'repair_createtime' => time(),
			); 
			// 自营与商家判断 
			$member = D("Order_detil as orders")->where(array("order_id"=>I('order_baoxiu')))
			->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id ")
			->join("left join plgox_member as user on user.plgox_id = cart.cart_shangjia_id ")
			->find();
			if( $member['plgox_usertype'] ==  "0" || $member['plgox_usertype'] == "1"   ){
				$datas = array(
					'repair_baoxiu_types' => 1,
				);
			}else if( $member['plgox_usertype'] ==  "4" ){
				$datas = array(
					'repair_baoxiu_types' => 2,
				);
			}
			// 抑制用户报修过于频繁不让添加
			/**
			 * @param 在这写该数据
			 */
			$image->open('./Uploads/home_baoxiu/'.$data_['repair_img']);
			// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
			$image->thumb(150,150)->save('./Uploads/home_baoxiu/'.$data_['repair_img']);
			$data_add = D("Repair")->add(array_merge($data,$data_,$datas));
			if( $data_add ){
				$this->ajaxReturn(array("status"=>2000));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"报修失败,或者是您已重复报修!"));
				return false;
			}
		}else if( I("order_tousu") ){
			// 实例化图片处理类
			$image = new \Think\Image();
			// 上传类
			$config = array(
			    'maxSize'    =>   3145728,
			    'rootPath'   =>   './Uploads/home_tousu/',
			    'saveName'   =>  array('uniqid',''),
			    'exts'       =>  array('jpg', 'gif', 'png', 'jpeg', 'bmp'),
			);
			$upload = new \Think\Upload($config);
			// $this->ajaxReturn($upload);
				// return false;
			$info = $upload->upload();
			if( !$info ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>$upload->getError()));
				return false;
			}else{
				$data_img = array(
					'tousu_home_img' => $info['0']['savepath'].$info['0']['savename'],
				);
				$image->open('./Uploads/home_tousu/'.$data_img['tousu_home_img']);
				$image->thumb(800,800)->save('./Uploads/home_tousu/'.$data_img['tousu_home_img']);
			}
			// 判断是否商家/平台自营
			$orders_data = D("Order_detil as orders")->where(array("order_id"=>array("eq",I('order_tousu'))))
			->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id")
			->join("left join plgox_member as member on member.plgox_id = cart.cart_shangjia_id")
			->find();
			if( $orders_data['plgox_usertype'] == '0' || $orders_data['plgox_usertype'] == '1' ){
				$data_ = array(
					'toushu_share_type' => 1,
				);
			}else if( $orders_data['plgox_usertype'] == '4' ){
				$data_ = array(
					'toushu_share_type' => 2,
				);
			}
			$data = array(
				'tousu_yuanyin' => I('tousu_select'),
				'tousu_shuoming' => I('tousu_content'),
				'tousu_type' => 2,
				'tousu_goods_id' => I('order_tousu'),
				'tousu_memberiud' => get_login_userid(),
				'tousu_shangjiauserid' => $orders_data['plgox_id'],
				'tousu_createtime' => date("Y-m-d H:i:s",time()),
			);
			// 执行添加 
			$tousu_add = D("Tousu")->add(array_merge($data,$data_img,$data_));
			if( $tousu_add ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"投诉申诉已提交,感谢您的使用!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2002,"message"=>"投诉申诉提交失败请重新提交!"));
				return false;
			}
		}
	}
	/**
	 * @param 我的评价
	 */
	public function my_pingjia() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		$this->assign("pingjia_id",I('pingjia_id'));
		$this->display("my_pingjia");
	}
	/**
	 * @param 我的个人认证
	 */
	public function my_grrz() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		$this->display("my_grrz");
	}
	public function AjaxPingjia() {
		if( I("pingjia_id") ){
			// 图片处理
			$image = new \Think\Image();
			// 上传
			$config = array(
			    'maxSize'    =>    3145728,
			    'rootPath'   =>    './Uploads/home_pingjia_img/',
			    'saveName'   =>    array('uniqid',''),
			    'exts'       =>    array('jpg', 'gif', 'png', 'jpeg' , 'bmp'),
			);
			$upload = new \Think\Upload($config);
			$info = $upload->upload();
			if( !$info ){
				$this->ajaxReturn(array("status"=>-2002,"message"=>$upload->getError()));
			}else{
				$data_img = array(
					$info['0']['savepath'].$info['0']['savename'],
					$info['1']['savepath'].$info['1']['savename'],
					$info['2']['savepath'].$info['2']['savename'],
					$info['3']['savepath'].$info['3']['savename'],
					$info['4']['savepath'].$info['4']['savename'],
				);
				foreach( $data_img as $val ){
					if( !empty($val) ){
						$data_duo_img[] = $val;
						// 将图片进行压缩
						$image->open("./Uploads/home_pingjia_img/".$val);
						$image->thumb(800,800)->save("./Uploads/home_pingjia_img/".$val);
					}
				}
				if( $data_duo_img == null ){
					$pingjia_img = "";
				}else{
					$pingjia_img = implode(",",$data_duo_img);
				}
				$data_imgs = array(
					'pingjia_img' => $pingjia_img,
				);
			}
			$pingjia_data = D("Order_detil as orders")->where(array("order_id"=>array("eq",I('pingjia_id'))))
			->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id")
			->join("left join plgox_member as user on user.plgox_id = cart.cart_shangjia_id")
			->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
			->find();
			$data = array(
				'pingjia_content' => I('textarea_content'),
				'pingjia_descriptions_pingjia' => I('pingjia_descriptions_pingjia'),
				'pingjia_maijia_pingjia' => I('pingjia_maijia_pingjia'),
				'pingjia_yunsong_pingjia' => I('pingjia_yunsong_pingjia'),
				'pingjia_share_id' => $pingjia_data['share_id'],
				'pingjia_orderid' => I('pingjia_id'),
				'pingjia_memberuid' => get_login_userid(),
				'pingjia_createtime' => time(),
			);
			// 针对于自营和商户的评价type管理
			if( $pingjia_data['plgox_usertype'] == "0" || $pingjia_data['plgox_usertype'] == "1"  ){
				$datas = array(
					'pingjia_type' => 1,
				);
			}else if( $pingjia_data['plgox_usertype'] == "4" ){
				$datas = array(
					'pingjia_type' => 2,
				);
			}
			$pingjia_add = D("Pingjia")->add(array_merge($data,$datas,$data_imgs));
			if( $pingjia_add ){
				// 修改订单表状态
				$data_ = array(
					'order_id' => I("pingjia_id"),
					'order_status' => 9
				);
				D("Order_detil")->save($data_);
				$this->ajaxReturn(array("status"=>2000,"message"=>"评价成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2001,"message"=>"评价失败!"));
				return false;
			}
		}
	}
	/**
	 * @param 我的投诉
	 */
	public function my_tousu() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		$select_content = D("Select_content")->where(array("select_type"=>array("eq",1)))->select();
		$this->assign("select_content",$select_content);
		$this->assign("tousu_id",I("tousu_id"));
		$this->display("my_tousu");
	}
	/**
	 * @param 我的租赁订单
	 */
	public function my_dingdan() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		$count = D("Order_detil")->where(array("order_detil_status"=>array("eq",1),"order_member_del_status"=>array("neq",1),"order_memberuid"=>array("eq",get_login_userid())))->count();
		$page = new \Think\Page($count,20);
		$order_detil = D("Order_detil")->where(array("order_detil_status"=>array("eq",1),"order_member_del_status"=>array("neq",1),"order_memberuid"=>array("eq",get_login_userid())))
		->join('LEFT JOIN plgox_cart as cart on cart.cart_id = plgox_order_detil.order_cart_id')
		->join('LEFT JOIN plgox_share as share on cart.cart_share_id = share.share_id')
		->join("LEFT JOIN plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
		->join("LEFT JOIN plgox_refund as refund on refund.refund_order_id = plgox_order_detil.order_id")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		$page->setConfig("header","<div class='page_style'>共<b>%TOTAL_PAGE%</b>页</div><div class='page_djy'>/第<b><input type='text' value=%NOW_PAGE% class='bdz'/></b>页</div><div class='qdtz'>确定</div>");
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        $page->setConfig("first","首页");
        $page->setConfig("last","尾页");
        $page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$this->assign("page",$page->show());
		$this->assign("date_time",time());//数据存的退款的时间
		$this->assign('order_detil',$order_detil);
		$this->assign("option_type",I("order_select"));
		$this->assign("setTitle","个人中心-租赁订单");
		$this->display("my_dingdan");
	}
	// 我的买卖订单
	public function my_mm_dingdan(){
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		$count = D("Order_detil")->where(array("order_detil_status"=>array("eq",2),"order_member_del_status"=>array("neq",1),"order_memberuid"=>array("eq",get_login_userid())))->count();
		$page = new \Think\Page($count,20);
		$order_detil = D("Order_detil")->where(array("order_detil_status"=>array("eq",2),"order_member_del_status"=>array("neq",1),"order_memberuid"=>array("eq",get_login_userid())))
		->join('LEFT JOIN plgox_cart as cart on cart.cart_id = plgox_order_detil.order_cart_id')
		->join('LEFT JOIN plgox_share as share on cart.cart_share_id = share.share_id')
		->join("LEFT JOIN plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
		->join("LEFT JOIN plgox_refund as refund on refund.refund_order_id = plgox_order_detil.order_id")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		$page->setConfig("header","<div class='page_style'>共<b>%TOTAL_PAGE%</b>页</div><div class='page_djy'>/第<b><input type='text' value=%NOW_PAGE% class='bdz'/></b>页</div><div class='qdtz'>确定</div>");
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        $page->setConfig("first","首页");
        $page->setConfig("last","尾页");
        $page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
        $this->assign("page",$page->show());
		$this->assign("date_time",time());//数据存的退款的时间
		$this->assign('order_detil',$order_detil);
		$this->assign("option_type",I("order_select"));
		$this->assign("setTitle","个人中心-买卖订单");
		$this->display("my_mm_dingdan");
	}
	public function AjaxConfirm_get_shop(){
		$data = array(
			'order_id' => I('shop_id'),
			'order_status' => 5
		);
		$order_save = D("Order_detil")->save($data);
		if( $order_save ){
			$this->ajaxReturn(array('status'=>2000));
		}else{
			$this->ajaxReturn(array('status'=>-2000));
		}
	}
	// 倒计时完毕之后 更改订单状态
	public function Ajax_save_order_status(){
		$data = array(
			'order_id' => I('attr_id'),
			'order_status' => 5
		);
		$order_save = D("Order_detil")->save($data);
		if( $order_save ){
			$this->ajaxReturn(array('status'=>2000));
		}else{
			$this->ajaxReturn(array('status'=>-2000));
		}
	}
	/**
	 * @param 订单操作
	 */
	public function ajaxOrderCazuo() {
		// 取消订单
		if( I("cancel_order_id") ){
			$data = array(
				'order_id' => I('cancel_order_id'),
				'order_status' => 11,
			);
			$save_data  = D("Order_detil")->save($data);
			if( $save_data ){
				$this->ajaxReturn(array("status"=>2000));
			}else{
				$this->ajaxReturn(array("status"=>-2000));
			}
		}
	}
	// 退租操作
	public function ajaxRetreat_rent() {
		if( I("order_id") ){
			$data = array(
				'order_id' => I('order_id'),
				'order_status' => 6,
				'order_tuizu_time' => time(),//退租时间
			);
			$save_data  = D("Order_detil")->save($data);
			if( $save_data ){
				// 如果退租成功，就更改租金表的租赁状态
				$zujin = D("Zujin")->where(array("zujin_oid"=>array("eq",I('order_id'))))->find();
				$data_ = array(
					'zujin_id' => $zujin['zujin_id'],
					'zujin_rent_status' => 2,//2 代表退租
				);
				$zujin_save = D("Zujin")->save($data_);
				if( $zujin_save ){
					$this->ajaxReturn(array("status"=>2000,"message"=>"退租成功，商家将会在1～3个工作日内处理!"));
				}
			}else{
				$this->ajaxReturn(array("status"=>-2000));
			}
		}else if( I('order_ids') ){
			$data = array(
				'order_id' => I('order_ids'),
				'order_status' => 7,
			);
			$save_data  = D("Order_detil")->save($data);
			if( $save_data ){
				$this->ajaxReturn(array("status"=>2000));
			}else{
				$this->ajaxReturn(array("status"=>-2000));
			}
		}
	}
	// 删除订单
	public function order_del_(){
		if( I("order_del_id") ){
			$data = array(
				'order_id' => I("order_del_id"),
				'order_member_del_status' => 1,
			);
			$data_save = D("order_detil")->save($data);
			if( $data_save ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"删除失败"));
				return false;
			}
		}
	}
	// 订单状态查询
	public function option_sreach() {
		// 查询
		if( I("order_select") == 1 ){
			// 查询待收货
			$option_status = 0;
			$count = D("Order_detil")->where(array("order_memberuid"=>array("eq",get_login_userid()),"order_status"=>array("eq",$option_status)))->count();
			$page = new \Think\Page($count,20);
			$order_detil = D("Order_detil")->where(array("order_status"=>array("eq",$option_status),"order_memberuid"=>array("eq",get_login_userid())))
			->join('left join plgox_cart as cart on cart.cart_id = plgox_order_detil.order_cart_id')
			->join('left join plgox_share as share on cart.cart_share_id = share.share_id')
			->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
			->join("left join plgox_refund as refund on refund.refund_order_id = plgox_order_detil.order_id")
			->limit($page->firstRow.','.$page->listRows)
			->select();
		}else if( I("order_select") == 2 ){
			// 查询是否支付
			$option_status = 1;
			$count = D("Order_detil")->where(array("order_memberuid"=>array("eq",get_login_userid()),"order_pay_status"=>array("eq",$option_status)))->count();
			$page = new \Think\Page($count,20);
			$order_detil = D("Order_detil")->where(array("order_pay_status"=>array("eq",$option_status),"order_memberuid"=>array("eq",get_login_userid())))
			->join('left join plgox_cart as cart on cart.cart_id = plgox_order_detil.order_cart_id')
			->join('left join plgox_share as share on cart.cart_share_id = share.share_id')
			->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
			->join("left join plgox_refund as refund on refund.refund_order_id = plgox_order_detil.order_id")
			->limit($page->firstRow.','.$page->listRows)
			->select();
		}else if( I("order_select") == 3 ){
			// 查询全部
			$option_status = 1;
			$count = D("Order_detil")->where(array("order_memberuid"=>array("eq",get_login_userid())))->count();
			$page = new \Think\Page($count,20);
			$order_detil = D("Order_detil")->where(array("order_memberuid"=>array("eq",get_login_userid())))
			->join('left join plgox_cart as cart on cart.cart_id = plgox_order_detil.order_cart_id')
			->join('left join plgox_share as share on cart.cart_share_id = share.share_id')
			->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
			->join("left join plgox_refund as refund on refund.refund_order_id = plgox_order_detil.order_id")
			->limit($page->firstRow.','.$page->listRows)
			->select();
		}
		$page->setConfig("header","<div class='page_style'>共<b>%TOTAL_PAGE%</b>页</div><div class='page_djy'>/第<b><input type='text' value=%NOW_PAGE% class='bdz'/></b>页</div><div class='qdtz'>确定</div>");
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        $page->setConfig("first","首页");
        $page->setConfig("last","尾页");
        $page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$this->assign("page",$page->show());
		$this->assign("date_time",time());//数据存的退款的时间
		$this->assign('order_detil',$order_detil);
		$this->assign("option_type",I("order_select"));
		$this->display("my_dingdan");
	}
	/**
	 * @param 我的账单
	 * 查看明细
	 */
	public function my_ck_mingxi() {
		$this->display("my_ck_mingxi");
	}
	/**
	 * @param 我的账单
	 * 订单详情
	 */
	public function my_dd_xiangqing() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		$order_detil = D("Order_detil")->where(array("order_memberuid"=>array("eq",get_login_userid()),"order_id"=>array('eq',I('id'))))
		->join('left join plgox_cart as cart on cart.cart_id = plgox_order_detil.order_cart_id')
		->join('left join plgox_share as share on cart.cart_share_id = share.share_id')
		->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
		->join("left join plgox_zulin as zulin on zulin.zulin_id = cart.cart_day_number_id")
		->join("left join plgox_address as address on address.address_id = order_addressid ")
		->join("left join plgox_invoice as invoice on invoice.invoice_id = plgox_order_detil.order_fapiao_id")
		->find();
		$this->assign("order_detil",$order_detil);
		$this->assign("setTitle","我的订单-查看订单详情");
		$this->display("my_dd_xiangqing");
	}
	public function my_mm_dd_xiangqing() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		$order_detil = D("Order_detil")->where(array("order_memberuid"=>array("eq",get_login_userid()),"order_id"=>array('eq',I('id'))))
		->join('left join plgox_cart as cart on cart.cart_id = plgox_order_detil.order_cart_id')
		->join('left join plgox_share as share on cart.cart_share_id = share.share_id')
		->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
		->join("left join plgox_zulin as zulin on zulin.zulin_id = cart.cart_day_number_id")
		->join("left join plgox_address as address on address.address_id = order_addressid ")
		->join("left join plgox_invoice as invoice on invoice.invoice_id = plgox_order_detil.order_fapiao_id")
		->find();
		$this->assign("order_detil",$order_detil);
		$this->assign("setTitle","我的订单-查看订单详情");
		$this->display("my_mm_dd_xiangqing");
	}
	/**
	 * @param 我的账单
	 * 我的订单
	 */
	public function my_zhangdan() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		// dump(strtotime("+1 Month",strtotime(date("Y-m-1",time()))));
		//  账单3月1号展示判断，如果当前的时间 大于或者等于 每月的1号的话，那么就展示数据
		// strtotime(date("Y-m-d",strtotime("+1 day",time())))
		if( strtotime(date("Y-m-d",time())) >= strtotime(date("Y-m"."-1",strtotime("+1 day"))) ){
			$zujin = D("Zujin as zj")->where(array("zujin_memberuid"=>array("eq",get_login_userid())))
			->join("left join plgox_order_detil as orders on orders.order_id = zj.zujin_oid")
			->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id")
			->join("left join plgox_zulin as zl on zl.zulin_id = cart.cart_day_number_id")
			->select();
			$this->assign("zujin_data",$zujin);
		}
		$this->assign("setTitle","个人中心-我的账单");
		$this->display("my_zhangdan");
	}
	// 查询日期
	public function AjaxDateLook() {
		$get_time = strtotime("-1 Month",strtotime(date("Y-m-d",strtotime(I("date_year")."-".I("date_month")))));//用于匹配数据时间归类查询
		$get_times = strtotime(date("Y-m-d",strtotime(I("date_year")."-".I("date_month"))));//用于if(){}else{}时间判断
		$bill_date = D("Zujin as zj")->where(array("zujin_rank_time"=>array("eq",$get_time),"zujin_memberuid"=>array("eq",get_login_userid())))
			->join("left join plgox_order_detil as orders on orders.order_id = zj.zujin_oid")
			->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id")
			->join("left join plgox_zulin as zl on zl.zulin_id = cart.cart_day_number_id")
			->select();
		/*foreach( $bill_date as $key=>$value ){
			// 当我前端点击的时间小于或者是等于数据计费的那天时间的话，那么就展示数据
			if( strtotime($get_time) <= strtotime(date("Y-m",$value['zujin_charging_time'])) ){

				$this->ajaxReturn("xxxxxx");
			}else{
			// 当我前端点击的时间大于或者是等于数据计费的那天时间的话，那么就没有数据
				$this->ajaxReturn(array("status"=>-2001,"message"=>"o(╯□╰)o&nbsp;&nbsp;亲爱哒，您本月账单暂时还没有生成啦，等到每月一号再看吧！"));
			}
		}*/
		if( I("bill_lookta_status") == 2 ){
			if( !empty($bill_date)  and time() >= $get_times ){
				$this->ajaxReturn(array("status"=>2000,"message"=>$bill_date));
			}else if( !empty($bill_date) and time() <= $get_times ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>"o(╯□╰)o&nbsp;&nbsp;亲爱哒，您本月账单暂时还没有生成啦，等到次月一号再看吧！"));
			}else if( empty($bill_date) and  time() <= $get_times ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>"o(╯□╰)o&nbsp;&nbsp;亲爱哒，您本月的账单暂时没有！"));
			}else if( $get_time <= strtotime(date("Y-m-1",time()))  ){
				if( empty($bill_date) ){
					$this->ajaxReturn(array("status"=>-2000,"message"=>"o(╯□╰)o&nbsp;&nbsp;亲爱哒，你上月没有租赁任何东西，所以本月没有账单！")); //为空 就证明没有数据
				}else{
					$this->ajaxReturn(array("status"=>2001,"message"=>$bill_date));//不为空 就证明有数据
				}
			}
		}else if( I("bill_lookta_status") == 1 ){
			/*if(  !empty($bill_date)  and time() >= $get_times  ){
				$this->ajaxReturn(array("status"=>2000,"message"=>$bill_date));
			}else if( empty($bill_date) ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>"o(╯□╰)o&nbsp;&nbsp;亲爱哒，您本月账单暂时还没有生成啦，等到次月一号再看吧！"));
			}*/
			if( !empty($bill_date)  and time() >= $get_times ){
				$this->ajaxReturn(array("status"=>2000,"message"=>$bill_date));
			}else if( !empty($bill_date) and time() <= $get_times ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>"o(╯□╰)o&nbsp;&nbsp;亲爱哒，您本月账单暂时还没有生成啦，等到次月一号再看吧！"));
			}else if( empty($bill_date) and  time() <= $get_times ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>"o(╯□╰)o&nbsp;&nbsp;亲爱哒，您本月的账单暂时没有！"));
			}else if( $get_time <= strtotime(date("Y-m-1",time()))  ){
				if( empty($bill_date) ){
					$this->ajaxReturn(array("status"=>-2000,"message"=>"o(╯□╰)o&nbsp;&nbsp;亲爱哒，你上月没有租赁任何东西，所以本月没有账单！")); //为空 就证明没有数据
				}else{
					$this->ajaxReturn(array("status"=>2001,"message"=>$bill_date));//不为空 就证明有数据
				}
			}
		}else if( I("bill_lookta_status") == 3 ){
			// 下月账单预展示数据
			$set_time = strtotime(date("Y-m-d",strtotime(I("date_year")."-".I("date_month"))));//用于匹配数据时间归类查询
			$bill_time = D("Zujin as zj")->where(array("zujin_rank_time"=>array("eq",$set_time),"zujin_memberuid"=>array("eq",get_login_userid())))
			->join("left join plgox_order_detil as orders on orders.order_id = zj.zujin_oid")
			->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id")
			->join("left join plgox_zulin as zl on zl.zulin_id = cart.cart_day_number_id")
			->select();
			if( !empty($bill_time) and $set_time <= strtotime("+1 Month",strtotime(date("Y-m-1",time()))) ){
				$this->ajaxReturn(array("status"=>2000,"message"=>$bill_time));
			}
		}else if( I("bill_lookta_status")  == 4 ){
			$set_time = strtotime("-1 Month",strtotime(date("Y-m-d",strtotime(I("date_year")."-".I("date_month")))));//用于匹配数据时间归类查询
			// $set_time = strtotime(date("Y-m-d",strtotime(I("date_year")."-".I("date_month"))));//用于匹配数据时间归类查询
			$bill_time = D("Zujin as zj")->where(array("zujin_rank_time"=>array("eq",$set_time),"zujin_memberuid"=>array("eq",get_login_userid())))
			->join("left join plgox_order_detil as orders on orders.order_id = zj.zujin_oid")
			->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id")
			->join("left join plgox_zulin as zl on zl.zulin_id = cart.cart_day_number_id")
			->select();
			if( !empty($bill_time) ){
				$this->ajaxReturn(array("status"=>2000,"message"=>$bill_time));
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"o(╯□╰)o&nbsp;&nbsp;亲爱哒，你上月没有租赁任何东西，所以本月没有账单！"));
			}
		}
	}
	// 账单短信提醒 时间轮询
	public function AjaxSmsSend() {

	}
	/**
	 * @param 我的信用
	 * 
	 */
	public function my_xinyun() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		$member = D("Member")->where(array("plgox_id"=>array("EQ",get_login_userid())))->find();
		$credit = D("Credit")->where(array("credit_uid"=>array("eq",$member['plgox_id'])))->select();
		$this->assign("member",$member);
		$this->assign("credit",$credit);
		$this->display("my_xinyun");
	}
	/**
	 * @param 我的基本资料
	 * 
	 */
	public function my_jbzl() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		$member = D("Member")->where(array("plgox_id"=>array("EQ",get_login_userid())))->find();
		$this->assign("member",$member);
		$this->assign("setTitle","个人中心-基本资料");
		$this->display("my_jbzl");
	}
	public function ajaxPassword() {
		if( I("plgox_pwd") ){
			$member = D("Member")->where("plgox_id = ".get_login_userid()."  and plgox_pwd = '".md5(I('plgox_pwd'))."' ")->find();
			$this->ajaxReturn($member);
			return false;
		}else if( I("plgox_password") ){
			$member = D("Member")->where("plgox_id = ".get_login_userid()." ")->find();
			$data['plgox_id'] = $member['plgox_id'];
			$data['plgox_pwd'] = md5(I("plgox_password"));
			$data['plgox_updatetime'] = time();
			$member = D("Member")->save($data);
			if( $member ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"修改失败!"));
				return false;
			}
		} 
	}
	public function ajaxCheck() {
		if( I("plgox_email") ){
			$plgox_email = D("Member")->where(" plgox_email = '".I('plgox_email')."' ")->select();
			$this->ajaxReturn($plgox_email);
			return false;
		}else if( I("plgox_emails") ){
			$member = D("Member")->where("plgox_id = ".get_login_userid()." ")->find();
			$data['plgox_id'] = $member['plgox_id'];
			$data['plgox_email'] = I("plgox_emails");
			$data['plgox_updatetime'] = time();
			$member = D("Member")->save($data);
			if( $member ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"绑定成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"绑定失败!"));
				return false;
			}
		}
		$members = D("Member")->where("plgox_id = ".get_login_userid()." ")->find();
		$this->ajaxReturn($members);
	}
	public function ajaxMember() {
		if( I("plgox_nickname") ){
			$plgox_nickname = $members = D("Member")->where("plgox_id = ".get_login_userid()." and plgox_nickname = '".I("plgox_nickname")."' ")->find();
			$this->ajaxReturn($plgox_nickname);
			return false;
		}else if( I("plgox_nicknames") ){
			$member = D("Member")->where("plgox_id = ".get_login_userid()." ")->find();
			$data['plgox_id'] = $member['plgox_id'];
			$data['plgox_nickname'] = I("plgox_nicknames");
			$data['plgox_updatetime'] = time();
			$member = D("Member")->save($data);
			if( $member ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"修改失败!"));
				return false;
			}
		}
		$members = D("Member")->where("plgox_id = ".get_login_userid()." ")->find();
		$this->ajaxReturn($members);
	}
	/**
	 * @param 我的企业认证首页
	 * 
	 */
	public function my_qyrz_sy() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		$redis = new \Redis();
		$redis->connect('127.0.0.1',6379);
		$cache = $redis->lrange("image_rz_path",0,1);
		if( I('renzheng_edit_id') ){
			$Renzheng =  D("Renzheng")->where(array("renzheng_id"=>array("eq",I('renzheng_edit_id'))))->find();
			$this->assign("Renzheng",$Renzheng);
		}else if( I("renzheng_id") ){
			$Renzheng =  D("Renzheng")->where(array("renzheng_id"=>array("eq",I('renzheng_id'))))->find();
			$this->assign("Renzheng",$Renzheng);
		}
		// 公司经营项目
		$renzheng_programmer = D("Renzheng_info")->where(array("renzheng_shaixuan"=>array("eq",1)))->select();
		$this->assign("renzheng_programmer",$renzheng_programmer);
		// 公司性质
		$renzheng_nature = D("Renzheng_info")->where(array("renzheng_shaixuan"=>array("eq",2)))->select();
		$this->assign("renzheng_nature",$renzheng_nature);
		// 联系人身份
		$renzheng_lxr_sf = D("Renzheng_info")->where(array("renzheng_shaixuan"=>array("eq",3)))->select();
		$this->assign("renzheng_lxr_sf",$renzheng_lxr_sf);
		// 紧急联系人身份
		$renzheng_jjlxr_sf = D("Renzheng_info")->where(array("renzheng_shaixuan"=>array("eq",4)))->select();
		// 给二维码传送token
		$token = $member = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
		$this->assign("token",md5($token['plgox_user']));
		$this->assign("status_keys",2);// 页面状态码 1 = 商户页面扫码 2 = 认证页面扫码
		/*foreach ($cache as $key => $value) {
			$datas_= explode(",",$value);
			if( $datas_['0'] == md5($token['plgox_user']) ){ // 做用户信息匹配，只有token值相等的用户才可以匹配到redis相对应的值
				$this->assign("cache",$datas_);// 读取redis图片
			}
		}*/
		$this->assign("times",time());
		$this->assign("renzheng_jjlxr_sf",$renzheng_jjlxr_sf);
		$this->assign("setTitle","企业认证-填写企业认证");
		$this->display("my_qyrz_sy");
	}
	// 无刷新查图
	public function ajax_rz_upload(){
		$redis = new \Redis();
		$redis->connect('127.0.0.1',6379);
		$cache = $redis->lrange("image_rz_path",0,1);
		// 给二维码传送token
		$token = $member = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
		if( I("status_") == 1 ){ // 读取数据
			foreach ($cache as $key => $value) {
				$datas_= explode(",",$value);
				if( $datas_['0'] == md5($token['plgox_user']) and !empty($datas_['2']) ){ // 做用户信息匹配，只有token值相等的用户才可以匹配到redis相对应的值
					$this->ajaxReturn(array("status"=>2000,"message"=>$datas_));// 读取redis图片
				}
			}
		}else if(  I("status_") == 2  ){ // 清空缓存
			foreach ($cache as $key => $value) {
				$val = explode(",",$value);
				$del_ = $redis->lrem("image_rz_path",$value,$key+1);
				if( $del_ ){
					unlink("./Uploads/home_renzheng_img/{$val['2']}");
					$this->ajaxReturn(array("status"=>-2000,"message"=>"刷新页面后,已清空图片缓存!"));
					return false;
				}
			}
		}
	}
	public function AjaxRenzheng() {
		// 上传图片
		$image = new \Think\Image();
		// 上传
		$config = array(
		    'maxSize'    =>    3145728,
		    'rootPath'   =>    './Uploads/home_renzheng_img/',
		    'saveName'   =>    array('uniqid',''),
		    'exts'       =>    array('jpg', 'gif', 'png', 'jpeg' , 'bmp'),
		);
		$upload = new \Think\Upload($config);
		$info = $upload->upload();
		if( I('renzheng_id') != "undefined" || I('renzheng_ids') != "undefined" ){
			if( I('renzheng_ids') != "undefined" ){
				$rensheng_img = D("Renzheng")->where(array("renzheng_id"=>array("eq",I('renzheng_ids'))))->find();
			}else if( I('renzheng_id') != "undefined" ){
				$rensheng_img = D("Renzheng")->where(array("renzheng_id"=>array("eq",I('renzheng_id'))))->find();
			}
			if( empty($info) ){
				$data_img = array(
					'renzheng_zhizhao_img' => $rensheng_img['renzheng_zhizhao_img'],
				);
			}else{
				$data_img = array(
					'renzheng_zhizhao_img' => empty($info)?$rensheng_img['renzheng_zhizhao_img']:$info['0']['savepath'].$info['0']['savename'],
				);
				$image->open("./Uploads/home_renzheng_img/".$data_img['renzheng_zhizhao_img']);
				$image->thumb(800,800)->save("./Uploads/home_renzheng_img/".$data_img['renzheng_zhizhao_img']);
			}
			if( I('renzheng_ids') != "undefined" ){
				$data = array(
					'renzheng_id' => I('renzheng_ids'),
					'renzheng_commpany' => I("renzheng_commpany"),
					'renzheng_zhucehao' => I("renzheng_zhucehao"),
					'renzheng_address' => I('renzheng_address'),
					'renzheng_name' => I('renzheng_name'),
					'renzheng_tel' => I('renzheng_tel'),
					'renzheng_jl_name' => I('renzheng_jl_name'),
					'rensheng_jl_tel' => I('rensheng_jl_tel'),
					'renzheng_commpany_nature' => I('renzheng_commpany_nature'),
					'renzheng_jy_pg' => I('renzheng_jy_pg'),
					'renzheng_info' => I('renzheng_info'),
					'renzheng_shenfen' => I('renzheng_shenfen'),
					'renzheng_memberuid' => get_login_userid(),
					'renzheng_status' => 2, // 默认等于1
					'renzheng_bianhao' => date('Ymd').mt_rand(1111111,9999999),
					'renzheng_createtime' => time(),
				);
				$buttn_value = "重新提交资料";
			}else if( I('renzheng_id') != "undefined" ){
				$data = array(
					'renzheng_id' => I('renzheng_id'),
					'renzheng_commpany' => I("renzheng_commpany"),
					'renzheng_zhucehao' => I("renzheng_zhucehao"),
					'renzheng_address' => I('renzheng_address'),
					'renzheng_name' => I('renzheng_name'),
					'renzheng_tel' => I('renzheng_tel'),
					'renzheng_jl_name' => I('renzheng_jl_name'),
					'rensheng_jl_tel' => I('rensheng_jl_tel'),
					'renzheng_commpany_nature' => I('renzheng_commpany_nature'),
					'renzheng_jy_pg' => I('renzheng_jy_pg'),
					'renzheng_info' => I('renzheng_info'),
					'renzheng_shenfen' => I('renzheng_shenfen'),
					'renzheng_updatetime' => time(),
				);
				$buttn_value = "修改认证资料";
			}
			$renzheng_save = D("Renzheng")->save(array_merge($data,$data_img));
			if( $renzheng_save ){
				$this->ajaxReturn(array("status"=>2000,"message"=>$buttn_value."成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2002,"message"=>$buttn_value."失败!"));
				return false;
			}
		}else{
			if( !empty(I("renzheng_zhizhao_img")) ){
				$data_img = array(
						'renzheng_zhizhao_img' =>I("renzheng_zhizhao_img"),
					);
			}else{
				if( !$info ){
					$this->ajaxReturn(array("status"=>-2001,"message"=>$upload->getError()));
					return false;
				}else{
					$data_img = array(
						'renzheng_zhizhao_img' => $info['0']['savepath'].$info['0']['savename'],
					);
					$image->open("./Uploads/home_renzheng_img/".$data_img['renzheng_zhizhao_img']);
					$image->thumb(800,800)->save("./Uploads/home_renzheng_img/".$data_img['renzheng_zhizhao_img']);
				}				
			}
			$data = array(
				'renzheng_commpany' => I("renzheng_commpany"),
				'renzheng_zhucehao' => I("renzheng_zhucehao"),
				'renzheng_address' => I('renzheng_address'),
				'renzheng_name' => I('renzheng_name'),
				'renzheng_tel' => I('renzheng_tel'),
				'renzheng_jl_name' => I('renzheng_jl_name'),
				'rensheng_jl_tel' => I('rensheng_jl_tel'),
				'renzheng_commpany_nature' => I('renzheng_commpany_nature'),
				'renzheng_jy_pg' => I('renzheng_jy_pg'),
				'renzheng_info' => I('renzheng_info'),
				'renzheng_shenfen' => I('renzheng_shenfen'),
				'renzheng_memberuid' => get_login_userid(),
				'renzheng_status' => 2,
				'renzheng_createtime' => time(),
				'renzheng_bianhao' => date('Ymd').mt_rand(1111111,9999999),
			);
			$renzheng_info = D("Member as user")->where(array("user.plgox_id"=>get_login_userid()))
			->find();
			if( $renzheng_info['plgox_is_renzheng'] == "0" ){
				$renzheng = D("Renzheng")->add(array_merge($data,$data_img));
				if( $renzheng ){
					$this->ajaxReturn(array("status"=>2000,"message"=>"提交认证成功,请等待认证审核!"));
					return false;
				}else{
					$this->ajaxReturn(array("status"=>-2002,"message"=>"提交认证失败,请重新提交认证!"));
					return false;
				}
			}else{
				$this->ajaxReturn(array("status"=>-2003,"message"=>"你已经提交过一次认证,无法重复认证!"));
				return false;
			}
		}
	}
	/**
	 * @param 我的企业认证成为租赁商
	 * 
	 */
	public function my_qyrz_zls() {
		$this->display("my_qyrz_zls");
	}
	/**
	 * @param 我的企业认证
	 * 
	 */
	public function my_qyrz() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		$renzheng = D("Renzheng")->where(array("renzheng_memberuid"=>array("eq",get_login_userid())))->find();
		$this->assign("renzheng",$renzheng);
		$this->assign("setTitle","个人中心-企业认证");
		$this->display("my_qyrz");
	}
	/**
	 * @param 修改密码
	 * 
	 */

	public function my_update_password() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		$member = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
		$this->assign("member",$member);
		$this->assign("get_user_id",get_login_userid());
		$this->assign("setTitle","基本资料-修改登陆密码");
		$this->display("my_update_password");
	}
	public function ajax_paaword() {
		if( !check_verify(I("img_code")) ){
			$this->ajaxReturn(array("status"=>-2001,"message"=>"图形验证码不正确!"));
			return false;
		}else{
			$this->ajaxReturn(array("status"=>2000));
			return false;
		}
	}
	// 获取验证码
	public function get_AjaxCode() {
		$content = "(修改密码验证码)，请在2分钟完成验证，请记住您的验证码打死也不要告诉任何人额，如不是本人请直接忽略!";
		$memer_info = D("Member")->where(array('plgox_id'=>array("eq",get_login_userid())))->find();
		if( !empty( $memer_info ) ){
			message_sendSMS($memer_info['plgox_tel'] , $content );
			$this->ajaxReturn(array("status"=> 2000,"message"=>"发送验证码成功!"));
		}else{
			$this->ajaxReturn(array("status"=> -2001,"message"=>"发送失败,当前用户手机号不存在或者用户出现变动!"));
		}
	}
	// 修改密码
	public function Success_sen_code() {
		$member = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
		$data = array(
			'plgox_id' => $member['plgox_id'],
			'plgox_pwd' => md5(I('_password')),
		);
		$member_save = D("Member")->save($data);
		if( !empty($member_save) ){
			session('plgox_username',null);
			session('home_auth_id',null);
			$this->ajaxReturn(array("status"=>2000));
			return false;
		}else{
			$this->ajaxReturn(array("status"=> -2001,"message"=>"修改密码失败!"));
			return false;
		}
	}
	/**
	 * @param 修改邮箱
	 * 
	 */

	public function my_update_email() {
		$this->display("my_update_email");
	}
	/**
	 * @param 修改手机号
	 * 
	 */

	public function my_update_telephone() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		dump($_SESSION['code']);
		$member = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
		$this->assign("member",$member);
		$this->assign("setTitle","基本资料-修改手机号码");
		$this->display("my_update_telephone");
	}
	// 更改手机号
	public function Ajax_save_tel() {
		// 检测验证码
		$content = "（修改手机号码验证码），请您在两分钟内完成验证，并且同时不要将您的验证码告诉给他人额!么么哒!";
		$member = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
		if( I("check_status") == 1 ){
			if( !check_verify( I("img_codes") ) ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>"输入的图形验证码不正确!"));
			}else{
				if( I("fs_code") == "success" ){
					message_sendSMS( $member['plgox_tel'] , $content , false );
					$this->ajaxReturn(array("status"=>2000,"message"=>"验证码已经下发至您的原手机,请注意查收!"));
				}else if( I("fs_code") == "success1" ){
					$this->ajaxReturn(array("status"=>2000));
				}else if( I("fs_code") == "success2" ){
					message_sendSMS( I('new_tel') , $content , false );
					$this->ajaxReturn(array("status"=>2000,"message"=>"验证码已经下发至您的原手机,请注意查收!"));
				}
			}
		}else if( I("check_status") == 2 ){
			// 检测手机验证码是否正确
			$member = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
			$check_code = mobiles_code_check(I("send_code") , $member['plgox_tel']);
			if( $check_code['status'] == 1 ){
				$this->ajaxReturn(array("status"=>2000,"message"=>$check_code['message'])); //验证成功
				session("code",null);
				session("phone",null);
			    session('code_createtime',null);
			}else if( $check_code['status'] == 2 ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>$check_code['message'])); //手机验证码错误
			}else if( $check_code['status'] == 3 ){
				$this->ajaxReturn(array("status"=>-2002,"message"=>$check_code['message'])); //接受验证码的手机号与当前填写的手机号不一致
			}
		}else if( I("check_status") == 3 ){
			//先检测新手机接受的验证码 输入之后的验证
			$check_code = mobiles_code_check(  I('new_send_code') , I("new_tel") );
			if( $check_code['status'] == 1 ){
				$data = array(
					'plgox_id' => $member['plgox_id'],
					'plgox_tel' => I("new_tel")
				);
				$member_save = D("Member")->save($data);
				if( $member_save ){
					session("code",null);
					session("phone",null);
			   		session('code_createtime',null);
					$this->ajaxReturn(array("status"=>2000,"message"=>$check_code['message'])); //验证成功
				}
			}else if( $check_code['status'] == 2 ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>$check_code['message'])); //手机验证码错误
			}else if( $check_code['status'] == 3 ){
				$this->ajaxReturn(array("status"=>-2002,"message"=>$check_code['message'])); //接受验证码的手机号与当前填写的手机号不一致
			}
		}else if( I("check_status") == 4 ){
			$member_tel = D("Member")->where(array("plgox_tel"=>array("eq",I('new_tel'))))->find();
			if( !empty($member_tel) ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>"当前输入的手机号已经存在,请换一个手机号!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>2000));
				return false;
			}
		}
	}
	/**
	 * @param 我的收货地址
	 * 
	 */
	public function my_shdz() {
		if( empty(get_login_userid()) ){
			$this->redirect("Tourist/login");
			exit;
		}
		$this->assign("address",D("address")->where("address_memberid = ".get_login_userid()." ")->order("address_id desc")->select());
		$this->assign("city",D("City")->where(array("city_pid"=>array("EQ",1)))->select());
		$this->assign("setTitle","个人中心-收货地址");
		$this->display("my_shdz");
	}
	// 地址数据
	public function addressAjax() {
		$data = array(
			'address_name'  => I('address_name'),
			'address_tel'  => I('address_tel'),
			'address_default'  => I('address_default'),
			'address_city_sheng'  => I('address_city_sheng'),
			'address_city_shi'  => I('address_city_shi'),
			'address_city_xian'   => I('address_city_xian'),
			'address_memberid' => get_login_userid(),
			'address_createtime' => time()
		);
		$address_add = D("Address")->add($data);
		if( $address_add ){
			$this->ajaxReturn(array("status"=>2000,"message"=>"添加成功!"));
			return false;
		}else{
			$this->ajaxReturn(array("status"=>2000,"message"=>"添加失败!"));
			return false;
		}

	}
	public function ajaxAddress() {
		$where['city_pid'] = I("cityId");
		$city = D("City")->where($where)->select();
		$this->ajaxReturn($city);
	}
	public function Address_del() {
		if( I("address_id") ){
			D("Address")->delete(I("address_id"));
			$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功!"));
			return false;
		}else{
			$this->ajaxReturn(array("status"=>-2000,"message"=>"删除失败!"));
			return false;
		}
	}
}
?>