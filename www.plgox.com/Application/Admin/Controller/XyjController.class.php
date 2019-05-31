<?php  
namespace Admin\Controller;
use Think\Controller;
class XyjController extends SessionController {
	public function xyj_steup() {
		$this->assign("setTitle","信用金设置");
		$this->assign("time",time());
		$xyj_steup = D("Xyj")->find();
		if( !empty($xyj_steup) ){
			$this->assign("xyj_steup",$xyj_steup);
		}
		$this->display("xyj_steup");
	}
	public function num_edit(){
		if( empty(I("xyj_id")) ){
			$data = array(
				'xyj_prices' => I('xyj_prices'),
				'xyj_createtime' => strtotime(I('xyj_createtime'))
			);
			$Xyj_add = D("Xyj")->add($data);
			if($Xyj_add){
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加成功!"));
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"添加失败!"));
			}
		}else if( !empty(I("xyj_id")) ){
			$data = array(
				'xyj_id' => I('xyj_id'),
				'xyj_prices' => I('xyj_prices'),
				'xyj_createtime' => strtotime(I('xyj_createtime'))
			);
			$Xyj_save = D("Xyj")->save($data);
			if($Xyj_save){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功!"));
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"修改失败!"));
			}
		}
	}
}
?>