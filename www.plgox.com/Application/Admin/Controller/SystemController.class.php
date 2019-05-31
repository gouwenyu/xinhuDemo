<?php
namespace Admin\Controller;
use Think\Controller;
class SystemController extends SessionController {
	/**
	 * @param 合作伙伴
	 */
    public function cooperation(){
    	$count = D("Cooperation")->count();
    	$page = new \Think\Page($count,10);
    	$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
    	$page->setConfig("prev","上一页");
    	$page->setConfig("next","下一页");
    	$page->setConfig("first","首页");
    	$page->setConfig("last","末页");
    	$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
    	$this->assign('cooperation',D("Cooperation")->order("cooperation_id desc")->limit($page->firstRow.','.$page->listRows)->select());
    	$this->assign("page",$page->show());
    	$this->assign("setTitle","合作伙伴管理");
        $this->display("cooperation");
    }
    public function cooperation_data(){
    	if( base64_decode(I("cooperation_id")) ){
    		// edit
    		$this->assign('cooperation',D("Cooperation")->find(base64_decode(I("cooperation_id"))));
    		$this->assign("setTitle","合作修改");
    		$this->display("cooperation_data");
    	}else{
    		//add
    		$this->assign("setTitle","合作添加");
    		$this->display("cooperation_data");
    	}
    }
    public function cooperation_datas() {
    	if( I('cooperation_id') ){
    		// edit
    		$image = new \Think\Image();
    		$config = array(
			    'maxSize'    =>    3145728,
			    'rootPath'   =>    './Uploads/admin/',
			    'saveName'   =>    array('uniqid',''),
			    'exts'       =>    array('jpg', 'gif', 'png', 'jpeg','bmp'),
			);
			$upload = new \Think\Upload($config);
			$info = $upload->upload();
			$cooperation_id = D("Cooperation")->find(I('cooperation_id'));
			if( empty($info) ){
				$data_img = array(
					'cooperation_img' => $cooperation_id['cooperation_img'],
				);
			}else{
				$data_img = array(
					'cooperation_img' => empty($info['0'])?$cooperation_id['cooperation_img']:$info['0']['savepath'].$info['0']['savename'],
				);
				$image->open("./Uploads/admin/".$data_img['cooperation_img']);
				$image->thumb(1200,1200)->save('./Uploads/admin/'.$data_img['cooperation_img']);
			}
			$datas = array(
				'cooperation_id' => I('cooperation_id'),
				'cooperation_status' => I('cooperation_status'),
				'cooperation_title' => I("cooperation_title"),
				'cooperation_link' => I("cooperation_link"),
				'cooperation_desc' => I('cooperation_desc'),
				'cooperation_key' => I('cooperation_key'),
				'cooperation_createtime' => time(),
			);
			$data = array_merge($data_img,$datas);
			$cooperation_save = D("Cooperation")->save($data);
			if( $cooperation_save ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2002,"message"=>"修改失败"));
				return false;
			}
    	}else{
    		//add
    		$image = new \Think\Image();
    		$config = array(
			    'maxSize'    =>    3145728,
			    'rootPath'   =>    './Uploads/admin/',
			    'saveName'   =>    array('uniqid',''),
			    'exts'       =>    array('jpg', 'gif', 'png', 'jpeg','bmp'),
			);
			$upload = new \Think\Upload($config);
			$info = $upload->upload();
			if( !$info ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>$upload->getError()));
				return false;
			}else{
				$data_img = array(
					'cooperation_img' => $info['0']['savepath'].$info['0']['savename'],
				);
				$image->open("./Uploads/admin/".$data_img['cooperation_img']);
				$image->thumb(1200,1200)->save('./Uploads/admin/'.$data_img['cooperation_img']);
			}
			$datas = array(
				'cooperation_title' => I("cooperation_title"),
				'cooperation_status' => I('cooperation_status'),
				'cooperation_link' => I("cooperation_link"),
				'cooperation_desc' => I('cooperation_desc'),
				'cooperation_key' => I('cooperation_key'),
				'cooperation_createtime' => time(),
			);
			$data = array_merge($data_img,$datas);
			$cooperation_add = D("Cooperation")->add($data);
			if( $cooperation_add ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加成功"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2002,"message"=>"添加失败"));
				return false;
			}
    	}
    }
    // 删除
    public function cooperation_del() {
    	if( I("cooperation_id") ){
    		$cooperation = D("Cooperation")->where(array("cooperation_id"=>I('cooperation_id')))->find();
    		D("Cooperation")->delete(I("cooperation_id"));
    		if($cooperation){
    			unlink("./Uploads/admin/".$cooperation['cooperation_img']);
    		}
    		$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功"));
    		return false;
    	}else if( I("cooperation_ids") ){
    		D("Cooperation")->delete(I("cooperation_ids"));
    		$this->ajaxReturn(array("status"=>2002,"message"=>"全选删除成功"));
    		return false;
    	}
    }
}
?>