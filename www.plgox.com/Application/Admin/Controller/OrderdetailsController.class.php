<?php 
namespace Admin\Controller;
use Think\Controller;
class OrderdetailsController extends SessionController {
	/**
	 * @param 订单详情
	 */
	public function order_details() {
		// 数据展示
		$count = D("Order_detil")->count();
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$order_detil = D("Order_detil as orders")
		->where(array('order_detil_status'=>array("eq",1)))
		->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id")
		->join("left join plgox_member as member on member.plgox_id = orders.order_memberuid")
		->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
		->join("left join plgox_address as address on address.address_id = order_addressid ")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		$this->assign("order_detil",$order_detil);
		$this->assign("page",$page->show());
		$this->assign("setTitle","租赁订单管理");
		$this->display("order_details");
	}
	public function order_details_data() {
		if( base64_decode(I('order_id')) ){
			$orders = D("Order_detil as orders")->where(array("order_id"=>array("eq",base64_decode(I('order_id')))))
			->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id ")
			->join("left join plgox_member as member on member.plgox_id = orders.order_memberuid")
			->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
			->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
			->join("left join plgox_zulin as zulin on zulin.zulin_id = sp.specifications_day_number_id")
			->join("left join plgox_address as address on address.address_id = order_addressid ")
			->join("left join plgox_filter as filter on filter.filter_id = share.share_prices_qujian")
			->find();
			$this->assign("orders",$orders);
			$this->assign("setTitle","查看订单详情");
			$this->display("order_details_data");
		}
	}
	// 订单搜索
	public function order_search() {
		if( !empty(I('search_ziying')) ){
			$count = D("Order_detil")->where(array("order_type"=>array("eq",I('search_ziying'))))->count();
		}else if( !empty(I('search_play')) ){
			$count = D("Order_detil")->where(array("order_pay_status"=>array("eq",I('search_play'))))->count();
		}else if( !empty(I('search_ordernumber')) ){
			$count = D("Order_detil")->where(array("order_number"=>array("eq",I('search_ordernumber'))))->count();
		}
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		if(!empty(I('search_ziying'))){
		$order_detil = D("Order_detil as orders")
		->where(array("order_type"=>array("eq",I('search_ziying'))))
		->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id")
		->join("left join plgox_member as member on member.plgox_id = orders.order_memberuid")
		->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
		->join("left join plgox_address as address on address.address_id = order_addressid ")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		}else if(!empty(I('search_play'))){
		$order_detil = D("Order_detil as orders")
		->where(array("order_pay_status"=>array("eq",I('search_play'))))
		->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id")
		->join("left join plgox_member as member on member.plgox_id = orders.order_memberuid")
		->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
		->join("left join plgox_address as address on address.address_id = order_addressid ")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		}else if(!empty(I('search_ordernumber'))){
		$order_detil = D("Order_detil as orders")
		->where(array("order_number"=>array("eq",I('search_ordernumber'))))
		->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id")
		->join("left join plgox_member as member on member.plgox_id = orders.order_memberuid")
		->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
		->join("left join plgox_address as address on address.address_id = order_addressid ")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		}
		$this->assign("search_ordernumber",I('search_ordernumber'));
		$this->assign("order_detil",$order_detil);
		$this->assign("page",$page->show());
		$this->assign("setTitle","订单管理");
		$this->display("order_details");
	}
	// 订单操作状态
	public function order_caozuo_status() {
		if(I('order_1')){
			$data = array(
				'order_id' => I('order_1'),
				'order_status' => I('order_status'),
				'order_daojishi' => strtotime(date('Y-m-d H:i:s',strtotime('+2 day'))),
			);
			$save_time = D("Order_detil")->where(array("order_id"=>array("EQ",I('order_1'))))->find();
			if( $save_time['order_status'] != I('order_status') ){
				$save_data  = D("Order_detil")->save($data);
				if( $save_data ){
					if( $save_time['order_status'] == 2 ){
						$arr = array(
							'order_id' => I('order_1'),
							'order_queren_time' => time()
						);
						D("Order_detil")->save($arr);
					}
					$this->ajaxReturn(array("status"=>2000));
				}else{
					$this->ajaxReturn(array("status"=>-2000));
				}
			}else{
				$this->ajaxReturn(array("status"=>-2001,"message"=>"已是当前状态无法再次定位该状态,如果强行从头修改后果自负!"));
			}
		}
	}
	// 返还押金
	public function order_fhyj(){
		$orders = D("Order_detil as orders")->where(array("order_id"=>array("EQ",base64_decode(I("order_fhyj_id")))))
		->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id")
		->join("left join plgox_member as member on member.plgox_id = orders.order_memberuid")
		->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
		->find();
		$this->assign("orders",$orders);
		$this->assign("setTitle","返回押金");
		$this->display("order_fhyj");
	}
	// 确认退押金 微信退款
	public function order_yes_fhyj() {
		$data_save = array(
			'order_id' =>I("refund_order_id"),
			'order_status' => 8,
		);
		D("Order_detil")->save($data_save);

		$data = array(
			'refund_order_id' => I("refund_order_id"),
			'refund_prices' => I("refund_prices"),
			'refund_status' => I("refund_status"),
			'refund_createtime' => strtotime(date('Y-m-d H:i:s',strtotime('+3 day'))),
			'refund_person' => $_SESSION['plgox_user']['plgox_id']
		);
		D("Refund")->add($data);
		// 统一调用支付退款
		/*vendor('WxPayPubHelper.WxPayPubHelper');
		$orderRefund = new \Refund_pub();
		$out_trade_no = I('order_weixin_number');
		$total_fee = I("order_deposit");//订单金额
		$refund_fee = I('refund_prices');//退款金额
		$refund_total_fee_Handle = 0;
		$refund_fee_Handle = 0;
		if( isset($out_trade_no) ){
			$orderRefund->SetParameter("out_trade_no",$out_trade_no);//商户订单号
			$orderRefund->SetParameter("out_refund_no",date("YmdHis").mt_rand(11111,99999));//商户退款单号
			// 金额处理
			if( $refund_total_fee_Handle ){
				$refund_total_fee_Handle = $total_fee*100;
			}else{
				$refund_total_fee_Handle = "1";
			}
			$orderRefund->SetParameter("total_fee",$refund_total_fee_Handle);//订单金额
			if( $refund_fee_Handle ){
				$refund_fee_Handle = $refund_fee*100;
			}else{
				$refund_fee_Handle = "1";
			}
			$orderRefund->SetParameter("refund_fee",$refund_fee_Handle);//退款金额
			$orderRefund->SetParameter("refund_desc","共享押金退款");//退款原因
    		$refundResult = $orderRefund->getResult();
    		$this->ajaxReturn($refundResult);
		}*/
	}
	// 用户报修
	public function order_baoxiu() {
		$shaixuan_list =  D("Repair")->count();
		$page = new \Think\Page($shaixuan_list,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$repair = D("Repair as rer")
		->join("left join plgox_select_content as selected on selected.select_id = rer.repair_reason_id ")
		->join("left join plgox_order_detil as orders on orders.order_id = rer.repair_order_id ")
		->join("left join plgox_member as member on member.plgox_id = rer.repair_vip ")
		->limit($page->firstRow.','.$page->listRows)
		->order("repair_createtime asc")
		->select();
		$this->assign("page",$page->show());
		$this->assign("repair",$repair);
		$this->assign("setTitle","用户报修管理");
		$this->display("order_baoxiu");
	}
	// 报修查看
	public function look_baoxiu() {
		$repair = D("Repair as rer")->where(array('rer.repair_id'=>array('eq',base64_decode(I('look_baoxiu_id')))))
		->join("left join plgox_select_content as selected on selected.select_id = rer.repair_reason_id ")
		->join("left join plgox_order_detil as orders on orders.order_id = rer.repair_order_id ")
		->join("left join plgox_member as member on member.plgox_id = rer.repair_vip ")
		->find();
		$this->assign("repair",$repair);
		$this->assign("setTitle","报修处理");
		$this->display("look_baoxiu");
	}
	// 报修处理
	public function AjaxBaoxiuChuli() {
		$data = array(
			'repair_id' => I('repair_id'),
			'repair_status' => I('repair_status'),
			'repair_success_time' => time()
		);
		$repair = D("Repair")->save($data);
		if( $repair ){
			// 报修完成之后,自动推送消息给用户 //短信 //站内
			$repair_notice = D("Repair as rer")->where(array("repair_id"=>array("eq",I('repair_id'))))
			->join("left join plgox_member as user on user.plgox_id = rer.repair_vip ")
			->join("left join plgox_select_content as sel on sel.select_id = rer.repair_reason_id ")
			->find();
			if( !empty($repair_notice) ){
				$datas = array(
					'message_uid' => $repair_notice['plgox_id'],
					'message_title' => "关于‘".$repair_notice['select_name']."’反馈",
					'message_content' => "尊敬的用户:".$repair_notice['plgox_user']."您好，针对你于".date('Y-m-d H:i:s',$repair_notice['select_createtime'])."提交的报修问题，我们已经为您解决，感谢您的使用，祝您生活愉快!",
					'message_createtime'=>time(),
					'message_person' => $_SESSION['plgox_user']['plgox_user'],
					'message_success' => 1,
					'message_type' => 1,
				);
				D("Message")->add($datas);
			}
			$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功!"));
			return false;
		}else{
			$this->ajaxReturn(array("status"=>2000,"message"=>"修改失败!"));
			return false;
		}
	}
	// 报修条件筛选
	public function order_serach() {
		$shaixuan = "";
		if( !empty(I("baoxiu_shaixuan")) ){
			$shaixuan.= " and (repair_baoxiu_types = ".I('baoxiu_shaixuan').")";
		}
		if( I("baoxiu_shaixuan_1") == 0 ){
			$shaixuan.= " and (repair_status = '0')";
		}else if( I("baoxiu_shaixuan_1") == 1 ){
			$shaixuan.= " and (repair_status = '1')";
		}else if( I("baoxiu_shaixuan_1") == 2 ){
			$shaixuan.= " and (repair_status = '2')";
		}
		$shaixuan_list =  D("Repair")->where("repair_id".$shaixuan)->count();
		$page = new \Think\Page($shaixuan_list,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$this->assign("repair",D("Repair")->where("repair_id".$shaixuan)->limit($page->firstRow.','.$page->listRows)->order("repair_createtime asc")->select());
		$this->assign("page",$page->show());
		$this->assign("setTitle","用户报修管理");
		$this->assign("baoxiu_shaixuan",I("baoxiu_shaixuan"));
		$this->assign("baoxiu_shaixuan_1",I("baoxiu_shaixuan_1"));
		$this->display("order_baoxiu");
	}
	// 执行删除
	public function order_del() {
		// 单选删除
		if( I("repair_id") ){
			$repair_find =  D("Repair")->where(array("repair_id"=>array('eq',I("repair_id") )))->find();
			if( $repair_find ){
				$repair_del = D("Repair")->delete(I("repair_id"));
				if( $repair_del ){
					unlink("./Uploads/home_baoxiu/".$repair_find['repair_img']);
				}
				$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功!"));
			}
		}
		// 多选删除
		if( I("repair_ids") ){
			 D("Repair")->delete(I("repair_ids"));
			$this->ajaxReturn(array("status"=>2002,"message"=>"全选删除成功!"));
		}
	}
	// 报修原因添加
	public function order_baoxiu_reason() {
		if( base64_decode(I('order_baoxiu_reason_id')) ){
			// edit
			$this->assign("selecteds_",D("Select_content")->where(array("select_id"=>array("eq",base64_decode(I('order_baoxiu_reason_id')))))->find());
			$this->assign("setTitle","报修原因修改");
			$this->display("order_baoxiu_reason");
		}else{
			// add
			$this->assign("setTitle","报修原因添加");
			$this->display("order_baoxiu_reason");
		}
	}
	// 报修原因列表
	public function order_baoxiu_reason_list() {
		$count = D("Select_content")->count();
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$this->assign("select_list",D("Select_content")->limit($page->firstRow.','.$page->listRows)->order("select_createtime desc")->select());
		$this->assign("setTitle","报修原因列表");
		$this->assign("page",$page->show());
		$this->display("order_baoxiu_reason_list");
	}
	// 执行数据
	public function AjaxBaoxiu() {
		if( I('select_id') ){
			$data = array(
					'select_id' => I('select_id'),
					'select_name' => I('select_name'),
					'select_type' => 2,
					'select_updatetime' => time(),
					'select_memberuid' => $_SESSION['plgox_user']['plgox_id'],
				);
				$data_save = D("Select_content")->save($data);
				if( $data_save ){
					$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功"));
					return false;
				}else{
					$this->ajaxReturn(array("status"=>2000,"message"=>"修改失败"));
					return false;
				}
		}else{
			$data = array(
				'select_name' => I('select_name'),
				'select_createtime' => time(),
				'select_type' => 2,
				'select_memberuid' => $_SESSION['plgox_user']['plgox_id'],
			);
			$data_add = D("Select_content")->add($data);
			if( $data_add ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加成功"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加失败"));
				return false;
			}
		}
	}
	// 执行删除
	public function order_baoxiu_reason_del() {
		if( I('select_id') ){
			D("Select_content")->delete(I('select_id'));
			$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功!"));
			return false;
		}else if( I("select_ids") ){
			D("Select_content")->delete(I('select_ids'));
			$this->ajaxReturn(array("status"=>2002,"message"=>"全选删除成功!"));
			return false;
		}
	}
	// 评价
	public function order_pingjia() {
		$pingjia = D("Pingjia as pj")
		->join("left join plgox_order_detil as orders on orders.order_id = pj.pingjia_orderid")
		->join("LEFT JOIN plgox_cart as cart on cart.cart_id = orders.order_cart_id")
		->join("LEFT JOIN plgox_member as user on user.plgox_id = cart.cart_memberuid")
		->select();
		foreach ($pingjia as $key => $value) {
			$img[] = explode(",", $value['pingjia_img']);
		}
		$this->assign("images",$img);
		$this->assign("pingjia",$pingjia);
		$this->assign("setTitle","评价管理列表");
		$this->display("order_pingjia");
	}
	public function order_pingjia_look() {
		if( base64_decode(I('order_pingjia_id')) ){
			$pingjia = D("Pingjia as pj")->where(array("pingjia_id"=>array("eq",base64_decode(I('order_pingjia_id')))))
			->join("left join plgox_order_detil as orders on orders.order_id = pj.pingjia_orderid")
			->join("LEFT JOIN plgox_cart as cart on cart.cart_id = orders.order_cart_id")
			->join("LEFT JOIN plgox_member as user on user.plgox_id = cart.cart_memberuid")
			->find();
			$this->assign("images",explode(",", $pingjia['pingjia_img']));
			$this->assign("pingjia",$pingjia);
		}
		$this->display("order_pingjia_look");
	}
	// 筛选
	public function order_pingjia_shaixuan() {
		$shaixuan = "";
		/*if( !empty(I("pingjia_shaixuan")) ){
			$shaixuan.= " and (repair_baoxiu_types = ".I('pingjia_shaixuan').")";
		}*/
		if( I("pingjia_shaixuan") == 1 ){
			$shaixuan.= " and (pingjia_type = '1')";
		}else if( I("pingjia_shaixuan") == 2 ){
			$shaixuan.= " and (pingjia_type = '2')";
		}
		$shaixuan_list =  D("Pingjia")->where("pingjia_id".$shaixuan)->count();
		$page = new \Think\Page($shaixuan_list,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$this->assign("pingjia",D("Pingjia")->where("pingjia_id".$shaixuan)->limit($page->firstRow.','.$page->listRows)->order("pingjia_createtime asc")->select());
		$this->assign("page",$page->show());
		$this->assign("setTitle","评价管理搜索");
		$this->assign("pingjia_shaixuan",I("pingjia_shaixuan"));
		$this->assign("pingjia_shaixuan_1",I("pingjia_shaixuan_1"));
		$this->display("order_pingjia");
	}
	// 执行删除
	public function pingjia_del() {
		// 单选删除
		if( I('pingjia_id') ){
			D("Pingjia")->delete(I('pingjia_id'));
			$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功!"));
			return false;
		}else if( I("pingjia_ids") ){
			D("Pingjia")->delete(I('pingjia_ids'));
			$this->ajaxReturn(array("status"=>2002,"message"=>"全选删除成功!"));
			return false;
		}
	}
	// 投诉
	public function order_tousu() {
		$shaixuan_list =  D("Tousu")->where(array("tousu_type"=>array("eq",2)))->count();
		$page = new \Think\Page($shaixuan_list,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$toushu = D("Tousu as ts")->where(array("tousu_type"=>array("eq",2)))
		->join("left join plgox_select_content as selects on selects.select_id = ts.tousu_yuanyin")
		->join("left join plgox_order_detil as orders on orders.order_id = ts.tousu_goods_id")
		->join("left join plgox_member as user on user.plgox_id = ts.tousu_memberiud")
		->limit($page->firstRow.','.$page->listRows)
		->order("tousu_createtime asc")
		->select();
		$this->assign("page",$page->show());
		$this->assign("toushu",$toushu);
		$this->assign("setTitle","投诉管理");
		$this->display("order_tousu");
	}
	// 添加投诉原因
	public function order_tousu_reason() {
		if( base64_decode(I("order_tousu_reason_id")) ){
			$select_content = D("Select_content")->where(array("select_id"=>array("eq",base64_decode(I("order_tousu_reason_id")))))->find();
			$this->assign("select_content",$select_content);
			$this->assign("setTitle","投诉原因修改");
			$this->display("order_tousu_reason");
		}else{
			$this->assign("setTitle","投诉原因添加");
			$this->display("order_tousu_reason");
		}
	}
	public function AjaxTousu() {
		if( I("select_id") ){
			$data = array(
					'select_id' => I('select_id'),
					'select_name' => I("tousu_name"),
					'select_memberuid' => $_SESSION['plgox_user']['plgox_id'],
					'select_updatetime' => time(),
				);
				$select_save = D("Select_content")->save($data);
				if( $select_save ){
					$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功!"));
					return false;
				}else{
					$this->ajaxReturn(array("status"=>2000,"message"=>"修改失败!"));
					return false;
				}
		}else{
			$data = array(
				'select_name' => I("tousu_name"),
				'select_type' => 1,
				'select_memberuid' => $_SESSION['plgox_user']['plgox_id'],
				'select_createtime' => time(),
			);
			$select_add = D("Select_content")->add($data);
			if( $select_add ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加失败!"));
				return false;
			}
		}
	}
	public function order_tousu_reason_list() {
		$select_content = D("Select_content")->where(array("select_type"=>array("eq",1)))->select();
		$this->assign("select_content",$select_content);
		$this->assign("setTitle","投诉原因列表");
		$this->display("order_tousu_reason_list");
	}
	public function order_tousu_reason_del() {
		// 单选删除
		if( I('select_id') ){
			D("Select_content")->delete(I('select_id'));
			$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功!"));
			return false;
		}else if( I("select_ids") ){
			D("Select_content")->delete(I('select_ids'));
			$this->ajaxReturn(array("status"=>2002,"message"=>"全选删除成功!"));
			return false;
		}
	}
	// 投诉查看
	public function look_tousu() {
		if( base64_decode(I('look_tousu_id')) ){
			$toushu = D("Tousu as ts")->where(array("tousu_id"=>array("eq",base64_decode(I('look_tousu_id'))),"tousu_type"=>array("eq",2)))
			->join("left join plgox_select_content as selects on selects.select_id = ts.tousu_yuanyin")
			->join("left join plgox_order_detil as orders on orders.order_id = ts.tousu_goods_id")
			->join("left join plgox_member as user on user.plgox_id = ts.tousu_memberiud")
			->find();
			$this->assign("toushu",$toushu);
			$this->assign("setTitle","投诉查看");
			$this->display("look_tousu");
		}
	}
	public function AjaxTousu_() {
		$data = array(
			'tousu_id' => I('tousu_id'),
			'tousu_huifu' => I('tousu_huifu'),
			'tousu_updatetime' => time()
		);
		$Tousu = D("Tousu")->save($data);
		if( $Tousu ){
			// 报修完成之后,自动推送消息给用户 //短信 //站内
			$tousu_notice = D("Tousu as ts")->where(array("tousu_type"=>array("eq",2),"tousu_id"=>array("eq",I('tousu_id'))))
			->join("left join plgox_member as user on user.plgox_id = ts.tousu_memberiud ")
			->join("left join plgox_select_content as sel on sel.select_id = ts.tousu_yuanyin ")
			->find();
			if( !empty($tousu_notice) && I("tousu_huifu") == "1" ){
				$datas = array(
					'message_uid' => $tousu_notice['plgox_id'],
					'message_title' => "关于‘".$tousu_notice['select_name']."’的投诉反馈",
					'message_content' => "尊敬的用户:'".$tousu_notice['plgox_user']."'您好，针对您于".date('Y-m-d H:i:s',$tousu_notice['select_createtime'])."提交的投诉问题，我们正在为您处理中，请您耐心等待，感谢您的支持!",
					'message_createtime'=>time(),
					'message_person' => $_SESSION['plgox_user']['plgox_user'],
					'message_success' => 1,
					'message_type' => 1,
				);
				D("Message")->add($datas);
			}else if( !empty($tousu_notice) && I("tousu_huifu") == "2" ){
				$datas = array(
					'message_uid' => $tousu_notice['plgox_id'],
					'message_title' => "关于‘".$tousu_notice['select_name']."’的处理结果",
					'message_content' => "尊敬的用户:'".$tousu_notice['plgox_user']."'您好，针对您于".date('Y-m-d H:i:s',$tousu_notice['select_createtime'])."提交的投诉问题，我们已经为您处理成功，感谢您的支持!",
					'message_createtime'=>time(),
					'message_person' => $_SESSION['plgox_user']['plgox_user'],
					'message_success' => 1,
					'message_type' => 1,
				);
				D("Message")->add($datas);
			}
			$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功!"));
			return false;
		}else{
			$this->ajaxReturn(array("status"=>2000,"message"=>"修改失败!"));
			return false;
		}
	}
	// 筛选
	public function tousu_shaixuan() {
		$shaixuan = "";
		// 商家/自营筛选
		if( !empty(I("tousu_shaixuan")) ){
			$shaixuan.= " and (toushu_share_type = ".I('tousu_shaixuan').")";
		}
		// 处理结果筛选
		if( I("tousu_shaixuan_1") == '4' ){
			$shaixuan.= " and (tousu_huifu = '0')";
		}else if( I("tousu_shaixuan_1") == '1' ){
			$shaixuan.= " and (tousu_huifu = '1')";
		}else if( I("tousu_shaixuan_1") == '2' ){
			$shaixuan.= " and (tousu_huifu = '2')";
		}
		$shaixuan_list =  D("Tousu")->where("tousu_type = 2".$shaixuan)->count();
		$page = new \Think\Page($shaixuan_list,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$tousu = D("Tousu as ts")->where("tousu_type = 2".$shaixuan)->limit($page->firstRow.','.$page->listRows)->order("tousu_createtime asc")
		->join("left join plgox_select_content as selects on selects.select_id = ts.tousu_yuanyin")
		->join("left join plgox_order_detil as orders on orders.order_id = ts.tousu_goods_id")
		->join("left join plgox_member as user on user.plgox_id = ts.tousu_memberiud")
		->select();
		$this->assign("toushu",$tousu);
		$this->assign("page",$page->show());
		$this->assign("setTitle","投诉管理搜索");
		$this->assign("tousu_shaixuan",I("tousu_shaixuan"));
		$this->assign("tousu_shaixuan_1",I("tousu_shaixuan_1"));
		$this->display("order_tousu");
	}
	// 执行删除
	public function tousu_del() {
		// 单选删除
		if( I("tousu_id") ){
			$tousu_find =  D("Tousu")->where(array("tousu_id"=>array('eq',I("tousu_id") )))->find();
			if( $tousu_find ){
				$tousu_del = D("Tousu")->delete(I("tousu_id"));
				if( $tousu_del ){
					unlink("./Uploads/home_baoxiu/".$tousu_find['tousu_home_img']);
				}
				$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功!"));
			}
		}
		// 多选删除
		if( I("tousu_ids") ){
			D("Tousu")->delete(I("tousu_ids"));
			$this->ajaxReturn(array("status"=>2002,"message"=>"全选删除成功!"));
		}
	}
	/**
	  * @param 买卖订单管理
	  */
	public function order_details_shop(){
		// 数据展示
		$count = D("Order_detil")->count();
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$order_detil = D("Order_detil as orders")
		->where(array('order_detil_status'=>array("eq",2)))
		->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id")
		->join("left join plgox_member as member on member.plgox_id = orders.order_memberuid")
		->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
		->join("left join plgox_address as address on address.address_id = order_addressid ")
		->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		$this->assign("order_detil",$order_detil);
		$this->assign("page",$page->show());
		$this->assign("setTitle","买卖订单管理");
		$this->display("order_details_shop");
	}
	public function order_details_shop_data(){
		if( base64_decode(I('order_id')) ){
			$orders = D("Order_detil as orders")->where(array("order_id"=>array("eq",base64_decode(I('order_id')))))
			->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id ")
			->join("left join plgox_member as member on member.plgox_id = orders.order_memberuid")
			->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
			->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
			->join("left join plgox_zulin as zulin on zulin.zulin_id = sp.specifications_day_number_id")
			->join("left join plgox_address as address on address.address_id = order_addressid ")
			->join("left join plgox_filter as filter on filter.filter_id = share.share_prices_qujian")
			->find();
			$this->assign("orders",$orders);
			$this->assign("setTitle","查看订单详情");
			$this->display("order_details_shop_data");
		}
	}
	public function order_shop_status(){
		if( I("order_1") ){
			$data = array(
				'order_id' => I("order_1"),
				'order_status' => I("order_status"),
				'order_daojishi' => strtotime(date('Y-m-d H:i:s',strtotime('+6 day'))) // 用户如果收到货后六天内未确认收货将自动收货
			);
			$order_save = D("Order_detil")->save($data);
			if( $order_save ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功！"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"修改失败！"));
				return false;
			}
		}
	}
}
?>