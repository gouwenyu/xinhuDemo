<?php
namespace Home\Controller;
use Think\Controller;
class JueZhiController extends CommonController {
    public function JueZhi_fbgl(){
    	//掘值中心发布管理
    	
    	$search = I("type");
    	if(empty($search)){
    		$order =  "goods_publish_time";
    	}else if($search==1){
    		$order =  "goods_publish_time";
    	}else{
    		$order =  "goods_edit_time";
    	}
    	$count = D("Goods")->where(array('goods_is_check'=>1,'goods_push_user_id'=> $_SESSION['plgox_username']['plgox_id']))->count();
    	//echo $count;
    	//exit;
    	$page = new \Think\Page($count,5);
    	$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
    	$page->setConfig("prev","上一页");
    	$page->setConfig("next","下一页");
    	$page->setConfig("first","首页");
    	$page->setConfig("last","末页");
    	$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
    	
    	
    	$goodss = D('Goods');
    	$goods = $goodss->field('goods_publish_time,goods_id,goods_edit_time,goods_name,goods_is_watched')->where(array('goods_is_check'=>1,'goods_push_user_id'=> $_SESSION['plgox_username']['plgox_id']))->limit($page->firstRow.','.$page->listRows)->order($order.' desc')->select();
    	//echo $goodss->getLastSql();
    	//echo "<br>user_id:".$_SESSION['plgox_username']['plgox_id'];
    	//exit;
    	$this->assign("count",$count);
    	$this->assign("goods",$goods);
    	$this->assign("page",$page->show());
    	$this->display('JueZhi_fbgl');
    }
    //掘值中心我的收藏
     public function JueZhi_wdsc(){
     	$type=I("type");
     	if(!empty($type)){
     		if($type==1){
     			$order['g.goods_deal_price'] = 'asc';
     			$change_color=1;
     		}else if($type==2){
     			$order['g.goods_deal_price'] = 'desc';
     			$change_color=2;
     		}
     		else if($type==0){
     			$order['c.collect_id'] = 'desc';
     		    $change_color=0;
     		}
     		
     	}else{
     		$order['c.collect_id'] = 'desc';
     		$change_color=0;
     	}
     	$this->assign("change_color",$change_color);
     	$count = D("collect")->where(array('collect_user_id'=> $_SESSION['plgox_username']['plgox_id']))->count();
     	//echo $count;
     	//exit;
     	$page = new \Think\Page($count,5);
     	$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
     	$page->setConfig("prev","上一页");
     	$page->setConfig("next","下一页");
     	$page->setConfig("first","首页");
     	$page->setConfig("last","末页");
     	$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
     	
     	$result  = D('collect c')->field("c.*,g.*")->join('LEFT JOIN plgox_goods g ON c.collect_goods_id = g.goods_id')->order($order)->select();
     	//echo D('collect c')->getLastSql();
     	// dump($_SESSION);
     	$this->assign("goods",$result);
    	$this->assign("page",$page->show());
        $this->display('JueZhi_wdsc');
    }
    //掘值中心审核中
     public function JueZhi_shz(){
     	$search = I("type");
     	if(empty($search)){
     		$order =  "goods_publish_time";
     	}else if($search==1){
     		$order =  "goods_publish_time";
     	}else{
     		$order =  "goods_edit_time";
     	}
     	$count = D("Goods")->where(array('goods_is_check'=>0,'goods_push_user_id'=> $_SESSION['plgox_username']['plgox_id']))->count();
     	//echo $count;
     	//exit;
     	$page = new \Think\Page($count,5);
     	$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
     	$page->setConfig("prev","上一页");
     	$page->setConfig("next","下一页");
     	$page->setConfig("first","首页");
     	$page->setConfig("last","末页");
     	$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
     	 
     	 
     	 
     	$goods = D('Goods')->where(array('goods_is_check'=>0,'goods_push_user_id'=> $_SESSION['plgox_username']['plgox_id']))->limit($page->firstRow.','.$page->listRows)->order($order.' desc')->select();
     	//echo D('Goods')->getLastSql();
     	$this->assign("count",$count);
     	$this->assign("goods",$goods);
     	$this->assign("page",$page->show());
        $this->display('JueZhi_shz');
    }
    //掘值中心我的足记
     public function JueZhi_wdzj(){
     	$zj_ptime_list = D('Footprint')->field('footprint_ptime')->where(array("footprint_type"=>2))->group("footprint_ptime")->select();
     	foreach ($zj_ptime_list as $k=>$v){
     		$zj_list = D('Footprint')->field('footprint_goods_id,footprint_price,footprint_picture_url')->where(array("footprint_ptime"=>$v['footprint_ptime']))->where(array("footprint_type"=>2))->order("footprint_id")->select();
     		$zj_ptime_list[$k]['goodsList'] = $zj_list;
     	}

     	//print_r($zj_ptime_list);
     	//exit;
     	$arr=array(array("key2"=>"juezhi_wdzj2.jpg","key1"=>'123'),array("key2"=>"juezhi_wdzj3.jpg","key1"=>'1234'),array("key2"=>"juezhi_wdzj1.jpg","key1"=>'1235'),array("key2"=>"juezhi_wdzj2.jpg","key1"=>'12356'),array("key2"=>"juezhi_wdzj3.jpg","key1"=>'123567'));
        $this->assign("arr",$arr);
        $this->assign("biglist",$zj_ptime_list);
        $this->display('JueZhi_wdzj');
        
    }
     //掘值中心未通过
     public function JueZhi_wtg(){
    	// dump($_SESSION);
     	$search = I("type");
     	if(empty($search)){
     		$order =  "goods_publish_time";
     	}else if($search==1){
     		$order =  "goods_publish_time";
     	}else{
     		$order =  "goods_edit_time";
     	}
     	$count = D("Goods")->where(array('goods_is_check'=>2,'goods_push_user_id'=> $_SESSION['plgox_username']['plgox_id']))->count();
     	
     	$page = new \Think\Page($count,5);
     	$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
     	$page->setConfig("prev","上一页");
     	$page->setConfig("next","下一页");
     	$page->setConfig("first","首页");
     	$page->setConfig("last","末页");
     	$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
     	 
     	
     	 
     	$goods = D('Goods')->field('goods_publish_time,goods_id,goods_edit_time,goods_name,goods_is_watched,goods_reason')->where(array('goods_is_check'=>2,'goods_push_user_id'=> $_SESSION['plgox_username']['plgox_id']))->limit($page->firstRow.','.$page->listRows)->order($order.' desc')->select();
     	$this->assign("count",$count);
     	$this->assign("goods",$goods);
     	$this->assign("page",$page->show());
        $this->display('JueZhi_wtg');
    }
    public function delete_goods(){
    	$type = I('type');
    	$where = array();
    	if($type==1){
    		//单删商品
	    	$where['goods_id'] = I('id');
	    	D("goods")->where($where)->delete();
	    	//echo D('goods')->getLastSql();
    	}else if($type==2){
    		//多删商品
    		$id_array = explode(",", I('id'));
    		$where['goods_id'] = array("in",$id_array);
	    	D("goods")->where($where)->delete();
    	}else if($type==3){
    		//取消一个收藏
    		$where['collect_id'] = I('id');
    		D("collect")->where($where)->delete();
    	}else if($type==4){
    		//批量取消收藏
    		$id_array = explode(",", I('id'));
    		$where['collect_id'] = array("in",$id_array);
    		D("collect")->where($where)->delete();
    	}
    	//echo D("goods")->getLastSql();
    	echo D("collect")->getLastSql();
    }
}