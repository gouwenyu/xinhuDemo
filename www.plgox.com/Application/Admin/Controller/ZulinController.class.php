<?php 
namespace Admin\Controller;
use Think\Controller;
class ZulinController extends SessionController {
	/**
	 * 委托租赁
	 */
	public function zulin() {
		$count = D("Weituo")->count();
		$page  = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$weituo = D("Weituo as wt")->join("left join plgox_member as user on user.plgox_id = wt.weituo_uid ")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		$this->assign('page',$page->show());
		$this->assign("weituo",$weituo);
		$this->assign("setTitle","委托租赁");
		$this->display('zulin');
	}
	// 查看
	public function look_weituo() {
		if( base64_decode(I('look_weituo_id')) ){
		 	$weituo = D("Weituo as wt")->where(array("weituo_id"=>array("eq",base64_decode(I('look_weituo_id')))))->join("left join plgox_member as user on user.plgox_id = wt.weituo_uid ")->find();
		 	$this->assign("setTitle","查看委托");
		 	$this->assign("look_weituo",$weituo);
		 	$this->display("look_weituo");
		}
	}
	// 修改
	public function weituo_save() {
		if( I("wt_id") ){
			$data = array(
				'weituo_id' => I("wt_id"),
				'weituo_status' => I('weituo_status')
			);
			$Weituo = D("Weituo")->save($data);
			if( $Weituo ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2001,"message"=>"修改失败!"));
				return false;
			}
		}
	}
	// 筛选
	public function shaixuan() {
		$shaixuan = "";
		if( I("weituo_shaixuan_1") == 1 ){
			$shaixuan.=" and (weituo_status = 0 ) ";
		}else if( I("weituo_shaixuan_1") == 2 ){
			$shaixuan.=" and (weituo_status = 1 ) ";
		}
		$count = D("Weituo")->where("weituo_id".$shaixuan)->count();
		$page  = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$weituo = D("Weituo as wt")
		->where("weituo_id".$shaixuan)
		->join("left join plgox_member as user on user.plgox_id = wt.weituo_uid ")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		$this->assign('page',$page->show());
		$this->assign("weituo",$weituo);
		$this->assign("weituo_shaixuan_1",I("weituo_shaixuan_1"));
		$this->assign("setTitle","委托租赁搜索");
		$this->display('zulin');
	}
	// 删除
	public function weituo_del() {
		if( I("weituo_id") ){
			$Weituo = D("Weituo")->delete(I("weituo_id"));
			if( $Weituo ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2001,"message"=>"删除失败!"));
				return false;
			}
		}else if( I("weituo_ids") ){
			$Weituo = D("Weituo")->delete(I("weituo_ids"));
			if( $Weituo ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"全选删除成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2001,"message"=>"全选删除失败!"));
				return false;
			}
		}
	}
}
?>