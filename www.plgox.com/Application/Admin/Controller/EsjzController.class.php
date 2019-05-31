<?php  
namespace Admin\Controller;
use Think\Controller;
class EsjzController extends SessionController {
	public function esjz_brand_list(){
		$brand_list = D('juezhi_brand')->select();
		foreach ($brand_list as $k=>$v){
			$flag=0;
			 if($v['juezhi_brand_aid']!=0){
			 	$aid_name= D('juezhi_brand')->where(array("juezhi_brand_id"=>$v['juezhi_brand_aid']))->find();
			 	$brand_list[$k]['juezhi_brand_aid'] = $aid_name['juezhi_brand_name']."->";
			 }else{
			 	$flag+=1;
			 	$brand_list[$k]['juezhi_brand_aid']="";
			 }
			 if($v['juezhi_brand_bid']!=0){
				 $bid_name= D('juezhi_brand')->where(array("juezhi_brand_id"=>$v['juezhi_brand_bid']))->find();
				 $brand_list[$k]['juezhi_brand_bid'] = $bid_name['juezhi_brand_name']."->";
			 	$brand_list[$k]['juezhi_brand_title'] = "【三级分类】";
			 }else{
			 	$flag+=1;
			 	$brand_list[$k]['juezhi_brand_bid']="";
			 	$brand_list[$k]['juezhi_brand_title'] = "【二级分类】";
			 }
			 if($flag==2){
			 	$brand_list[$k]['juezhi_brand_title'] = "【顶级分类】";
			 }
		}
		$this->assign("brand_list",$brand_list);
		$this->display("esjz_brand_list");
	}

	//新增分类
	public function add_brand(){
		$brand_first = D('juezhi_brand')->where(array("juezhi_brand_aid"=>0,"juezhi_brand_aid"=>0))->select();
		$this->assign("brand_first",$brand_first);
		$this->display("esjz_add_brand");
	}
	//插入分类
	public function insert_brand(){
		$data['juezhi_brand_aid'] = I('id_a');
		$data['juezhi_brand_bid'] = I('id_b');
		$data['juezhi_brand_name'] = I('name');
		$data['juezhi_brand_publish_time'] = date("Y-m-d H:i:s");
		D('juezhi_brand')->add($data);
		//echo D('juezhi_brand')->getLastSql();
	} 
	//删除分类
	public function delete_brand(){
		$where['juezhi_brand_id'] = I('id');
		D('juezhi_brand')->where($where)->delete();
	}
	//获取二级分类
	public function get_second_brand(){
		if(I('type')==1){
			$id = I('id');
			$brand_second = D('juezhi_brand')->where(array("juezhi_brand_aid"=>$id,"juezhi_brand_bid"=>0))->select();
			$this->ajaxReturn($brand_second);
		}else{
			$id = I('id');
			$brand_second = D('juezhi_brand')->where(array("juezhi_brand_bid"=>$id))->select();
			$this->ajaxReturn($brand_second);
		}
	}
	//商品详情
	public function esjz_goods_detail(){
		$id = I("goods_id");
		$goods_detail = D("goods")->where(array("goods_id"=>$id))->find();
		$img_url = explode(",", $goods_detail['goods_pic']);
		$this->assign("img_url",$img_url);
		$this->assign("goods_detail",$goods_detail);
		$this->display("esjz_goods_detail");
	}
	//商品列表
	public function esjz_goods_list(){

		// 分页
		$count = D("goods")->where(array("goods_is_check"=>0))->count();
		//echo D("goods")->getLastSql();
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$goods = D("goods")->limit($page->firstRow.','.$page->listRows)->where(array("goods_is_check"=>0))->order("goods_publish_time desc")->select();
		//echo D("goods")->getLastSql();
		foreach ($goods as $k=>$v){
			//更改省份城市
			$province_name = D('city')->where(array('city_id'=>$v['goods_province']))->find();
			$goods[$k]['goods_province'] = $province_name['city_name'];
			$city_name = D('city')->where(array('city_id'=>$v['goods_city']))->find();
			$goods[$k]['goods_city'] = $city_name['city_name'];
			//四种类型更换
			$goods_typea = D('juezhi_brand')->where(array('juezhi_brand_id'=>$v['goods_typea']))->find();
			$goods[$k]['goods_typea'] = $goods_typea['juezhi_brand_name'];
			$goods_typeb = D('juezhi_brand')->where(array('juezhi_brand_id'=>$v['goods_typeb']))->find();
			$goods[$k]['goods_typeb'] = $goods_typeb['juezhi_brand_name'];
			$goods_typec = D('juezhi_brand')->where(array('juezhi_brand_id'=>$v['goods_typec']))->find();
			$goods[$k]['goods_typec'] = $goods_typec['juezhi_brand_name'];
			$goods_sell_type = D('city')->where(array('city_id'=>$v['goods_province']))->find();
			if($v['goods_sell_type']==1){
				$goods[$k]['goods_sell_type'] = "餐厅二手";
			}else if($v['goods_sell_type']==2){
				$goods[$k]['goods_sell_type'] = "酒店二手";
			}else if($v['goods_sell_type']==3){
				$goods[$k]['goods_sell_type'] = "求购";
			}else{
				$goods[$k]['goods_sell_type'] = "餐厅转让";
			}
			//更改性别
			/* if($v['goods_link_sex']==1){
				$goods[$k]['goods_link_sex']="先生";
			}else if($v['goods_link_sex']==2){
				$goods[$k]['goods_link_sex']="女士";
			}else{
				$goods[$k]['goods_link_sex']="小姐";
			} */
		}
		$this->assign("goods_list",$goods);
		$this->assign("page",$page->show());
		$this->assign("setTitle","掘值待审核商品列表");
		$this->display("esjz_goods_list");
	}
	//设置商品查看最多列表
	public function esjz_goods_look_list(){
	
		// 分页
		$count = D("goods")->where(array("goods_is_check"=>1))->count();
		//echo D("goods")->getLastSql();
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$goods = D("goods")->limit($page->firstRow.','.$page->listRows)->where(array("goods_is_check"=>1))->order("goods_publish_time desc")->select();
		//echo D("goods")->getLastSql();
		$this->assign("goods_list",$goods);
		$this->assign("page",$page->show());
		$this->assign("setTitle","掘值设置查看最多商品列表");
		$this->display("esjz_goods_look_list");
	}
	public function check_goods(){
		$Goods = D('goods');
		$type = I('type');
		$where['goods_id'] = I('id');
		if($type==1){//通过
			$data['goods_is_check']=1;
			$Goods->where($where)->save($data);
		}else{//未通过
			$data['goods_is_check']=2;
			$data['goods_reason']=I('reason');
			$Goods->where($where)->save($data);
		}
	}
	public function update_watch_max(){
		$where['goods_id'] = I('id');
		$data['goods_is_watch_max'] = I('order');
		D('goods')->where($where)->save($data);
	}
	//  编辑
	public function esjz_goods_edit() {
		// 分类
		$juezhi = D("Juezhi_brand")->where(array("juezhi_brand_id"=>array("eq",base64_decode(I("edit_id")))))->find();
		// 分类展示
		$juezhi_ = D("Juezhi_brand")->where( array("juezhi_brand_aid"=>array("eq",0)))->select(); // 一级分类
		$juezhi_er = D("Juezhi_brand")->where( array("juezhi_brand_aid"=>array("neq",0),"juezhi_brand_bid"=>array("eq",0)))->select(); // 二级分类
		$this->assign("juezhi_",$juezhi_);
		$this->assign("juezhi_er",$juezhi_er);
		$this->assign("juezhi",$juezhi);
		$this->assign("setTitle","二手分类修改");
		$this->display("Esjz/esjz_goods_edit");
	}
	// 修改
	public function esjz_edit_save() {
		if( empty( I('id_a') ) ){ // 作为顶级分类的
			$data = array(
				'juezhi_brand_id' => I('brand_id'),
				'juezhi_brand_aid' => 0,
				'juezhi_brand_name' => I('name'),
				'juezhi_brand_publish_time' => date("Y-m-d H:i:s"),
			);
			$data_save = D("juezhi_brand")->save($data);
		}else{
			$data = array(
				'juezhi_brand_id' => I('brand_id'),
				'juezhi_brand_aid' => I('id_a'),
				'juezhi_brand_name' => I('name'),
				'juezhi_brand_publish_time' => date("Y-m-d H:i:s"),
			);
			$data_save = D("juezhi_brand")->save($data);
		}
		if( $data_save ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功"));
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"修改失败"));
		}
	}
}
?>