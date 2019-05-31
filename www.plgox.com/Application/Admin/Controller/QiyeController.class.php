<?php  
namespace Admin\Controller;
use Think\Controller;
class QiyeController extends SessionController {
	/**
	 * @param 企业认证
	 */
	public function qiye_index(){
		$count = D("Renzheng")->count();
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$renzheng = D("Renzheng as rz")
		->join("left join plgox_member as user on user.plgox_id = rz.renzheng_memberuid")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		$this->assign("page",$page->show());
		$this->assign("renzheng",$renzheng);
		$this->assign("setTitle","企业认证");
		$this->display('qiye_index');
	}
	// 查看企业认证
	public function qiye_rensheng_data() {
		if( base64_decode(I("qiye_rensheng_id")) ){
			$renzheng = D("Renzheng as rz")
			->where(array("renzheng_id"=>array("eq",base64_decode(I("qiye_rensheng_id")))))
			->join("left join plgox_member as user on user.plgox_id = rz.renzheng_memberuid")
			->find();
			$this->assign("setTitle","查看认证");
			$this->assign('renzheng',$renzheng);
		}
		$this->display("qiye_rensheng_data");
	}
	// 认证ajax
	public function AjaxQiye_renzheng() {
		if( I('renzheng_id') ){
			$data = array(
				'renzheng_id' => I('renzheng_id'),
				'renzheng_status' => I('renzheng_status'),
				'renzheng_updatetime' => time()
			);
			$is_renzheng = D("Renzheng")->where(array("renzheng_id"=>array("eq",I('renzheng_id'))))->find();
			if( $is_renzheng['renzheng_status'] == "3" || $is_renzheng['renzheng_status'] == "4" ){
				$this->ajaxReturn(array("status"=>-2002,"message"=>"已经是当前状态,无法重复修改!"));
			    return false;
			}else{
				$Renzheng = D("Renzheng")->save($data);
			}
			if( $Renzheng ){
				// 认证成功之后修改用户表的认证状态
				$Renzheng_check = D("Renzheng")->where(array("renzheng_id"=>array("eq",I('renzheng_id'))))->find();
				if( $Renzheng_check['renzheng_status'] == "3" ){
					$user = array(
						'plgox_id' => $Renzheng_check['renzheng_memberuid'],
						'plgox_is_renzheng' => 1,
						'plgox_name' => '商家用户',
						'plgox_usertype' => 4,
					);
					D("Member")->save($user);
					// 获取手机号
					$user_info = D("Member")->where(array("plgox_id"=>array("eq",$Renzheng_check['renzheng_memberuid'])))->find();
					// 短信内容 //后期读取模版当中的
					$msm_content = "尊敬的".$user_info['plgox_user']."用户，您好！您提交的企业认证已通过，可以租赁商品和发布二手交易信息啦，如有疑问请联系客服！010-67881490";
					// 下发短信提醒
					sendsms_template($user_info['plgox_tel'] , $msm_content , false );
				}else if( $Renzheng_check['renzheng_status'] == "4" ){
					// 获取手机号
					$user_info = D("Member")->where(array("plgox_id"=>array("eq",$Renzheng_check['renzheng_memberuid'])))->find();
					// 短信内容 //后期读取模版当中的
					$msm_content = "尊敬的".$user_info['plgox_user']."用户，您好！您提交的企业认证未通过，需要重新提交企业认证，如有疑问请联系客服！010-67881490";
					// 下发短信提醒
					sendsms_template($user_info['plgox_tel'] , $msm_content , false );
				}
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2001,"message"=>"修改失败!"));
				return false;
			}
		}
	}
	// 参数ajax 
	public function AjaxInfoAdd() {
		$array_data = array();
		$array_data = array(
			'renzheng_info_name' => I('renzheng_info_name'),
			'renzheng_info_uid' => $_SESSION['plgox_user']['plgox_id'],
			'renzheng_info_attr' => I("renzheng_info_attr"),
			'renzheng_shaixuan' => I('authentication_number'),
			'renzheng_info_createtime' => time()
		);
		$renzheng_info = D("Renzheng_info")->add($array_data);
		if( $renzheng_info ){
			$this->ajaxReturn(array("status"=>2000,"message"=>"添加".I('texts_info')."成功"));
			return false;
		}else{
			$this->ajaxReturn(array("status"=>-2001,"message"=>"添加".I('texts_info')."失败"));
			return false;
		}
	}
	// 信息添加
	public function qiye_info() {
		$this->assign("setTitle","认证信息添加");
		$this->display("qiye_info");
	}
	// 信息参数列表
	public function qiye_info_parameter_list() {
		$count = D("Renzheng_info")->count();
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$renzheng_parameter = D("Renzheng_info as parameter")
		->join("left join plgox_member as user on user.plgox_id = parameter.renzheng_info_uid")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		$this->assign("page",$page->show());
		$this->assign("renzheng_parameter",$renzheng_parameter);
		$this->assign("setTitle","参数index列表");
		$this->display("qiye_info_parameter_list");
	}
	// 信息参数筛选
	public function parameter_shaixuan() {
		$parametr = "";
		// 类别筛选
		if( I("parameter_shaixuan_1") ){
			$parametr.=" and (renzheng_shaixuan	= '".I('parameter_shaixuan_1')."' )";
		}
		// 查询参数名称
		if( I('parameter_search') ){
			$parametr.=" and (renzheng_info_name = '".I('parameter_search')."' )";
		}
		$count = D("Renzheng_info")->where("renzheng_info_id".$parametr)->count();
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$renzheng_parameter = D("Renzheng_info as parameter")
		->where("renzheng_info_id".$parametr)
		->join("left join plgox_member as user on user.plgox_id = parameter.renzheng_info_uid")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		$this->assign("renzheng_parameter",$renzheng_parameter);
		$this->assign("page",$page->show());
		$this->assign("parameter_shaixuan_1",I('parameter_shaixuan_1'));
		$this->assign("parameter_search",I('parameter_search'));
		$this->assign("setTitle","参数搜索列表");
		$this->display("qiye_info_parameter_list");
	}
	// 执行删除
	public function renzheng_info_del() {
		if( I("renzheng_info_id") ){
			$renzheng_info = D("Renzheng_info")->delete(I("renzheng_info_id"));
			if( $renzheng_info ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2001,"message"=>"删除失败!"));
				return false;
			}
		}else if( I("renzheng_info_ids") ){
			$renzheng_info = D("Renzheng_info")->delete(I("renzheng_info_ids"));
			if( $renzheng_info ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"全选删除成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2001,"message"=>"全选删除失败!"));
				return false;
			}
		}
	}
	// 认证筛选
	public  function renzheng_shaixuan() {
		$rezheng_suiffx = "";
		if( I("renzheng_shaixuan_1") ){
			$rezheng_suiffx.=" and (renzheng_status = ".I('renzheng_shaixuan_1').")";
		}else if( I('search_bianhao') ){
			$rezheng_suiffx.=" and (renzheng_bianhao = ".I('search_bianhao')." )";
		}
		$count = D("Renzheng")->where("renzheng_id".$rezheng_suiffx)->count();
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$renzheng = D("Renzheng as rz")
		->where("rz.renzheng_id".$rezheng_suiffx)
		->join("left join plgox_member as user on user.plgox_id = rz.renzheng_memberuid")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		$this->assign("renzheng",$renzheng);
		$this->assign("page",$page->show());
		$this->assign('renzheng_shaixuan_1',I('renzheng_shaixuan_1'));
		$this->assign('search_bianhao',I('search_bianhao'));
		$this->display("qiye_index");
	}
	// 删除
	public function renzheng_del() {
		if( I('renzheng_id') ){
			$Renzheng = D("Renzheng")->where(array("renzheng_id"=>array("eq",I('renzheng_id'))))->find();
			if( $Renzheng ){
				$del = D("Renzheng")->delete(I('renzheng_id'));
				if( $del ){
					unlink("./Uploads/home_renzheng_img/".$Renzheng['renzheng_zhizhao_img']);
					$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功!"));
					return false;
				}else{
					$this->ajaxReturn(array("status"=>-2001,"message"=>"删除失败!"));
					return false;
				}
			}
		}else if( I("renzheng_ids") ){
			$del = D("Renzheng")->delete(I('renzheng_ids'));
			if($del){
				$this->ajaxReturn(array("status"=>2000,"message"=>"全选删除成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2001,"message"=>"全选删除失败!"));
				return false;
			}
		}
	}
	/**
	 * @param 商家认证
	 */
	public function shangjia_index() {
		$count = D("Shop_center")->count();
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");		
		$shop_info = D("Shop_center as ruz")
		->join("left join plgox_member as user on user.plgox_id = ruz.shop_only_id")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		$this->assign("page",$page->show());
		$this->assign('shop_info',$shop_info);
		$this->assign("setTitle","商家申请管理");
		$this->display('shangjia_index');
	}
	public function qiye_sjrz_data() {
		if( base64_decode(I('qiye_sjrz_data_id')) ){
			$shop_info = D("Shop_center as ruz")
			->where(array("shop_id"=>array('eq',base64_decode(I('qiye_sjrz_data_id')))))
			->join("left join plgox_member as user on user.plgox_id = ruz.shop_only_id")
			->find();
			$this->assign("setTitle","商家协议查看");
			$this->assign("shop_info",$shop_info);
			$this->display('qiye_sjrz_data');
		}
	}
	public function AjaxRjrz() {
		if( I('shop_id') ){
			// 图片压缩
			$image = new \Think\Image();
			// 文件上传
			$config = array(
				'maxSize'    =>  3145728,
			    'rootPath'   =>  './Uploads/home_sjrz_img/',
			    'saveName'   =>  array('uniqid',''),
			    'exts'       =>  array('jpg', 'gif', 'png', 'jpeg', 'bmp'),
			);
			$upload = new \Think\Upload($config);
			$info = $upload->upload();
			$shop_sjrz_img = D("Shop_center")->where(array('shop_id'=>array('eq',I('shop_id'))))->find();
			
			if( empty($info) ){
				$data_img = array(
					'shop_xieyi_img' => $shop_sjrz_img['shop_xieyi_img'],
				);
			}else{
				$data_img = array(
					'shop_xieyi_img' => empty($info)?$shop_sjrz_img['shop_xieyi_img']:$info[0]['savepath'].$info[0]['savename'],
				);
				$image->open("./Uploads/home_sjrz_img/".$data_img['shop_xieyi_img']);
				$image->thumb(800,800)->save("./Uploads/home_sjrz_img/".$data_img['shop_xieyi_img']);
			}
			$data = array(
				'shop_id' => I('shop_id'),
				'shop_fp_type' => I('shop_fp_type'),
				'shop_xianxia_xieyi' => I('shop_xianxia_xieyi'),
				'shop_updatetime' => time()
			);
			// 判断线下协议是否签订的状态
			if( $shop_sjrz_img['shop_xianxia_xieyi'] == "0" ){
				$shop_center_save = D("Shop_center")->save(array_merge($data,$data_img));
				if( $shop_center_save ){
					$sjrz_status = D("Shop_center")->where(array("shop_id"=>array("eq",I('shop_id'))))->find();
					if( $sjrz_status['shop_xianxia_xieyi'] == '1' ){
						// 改变用户类型
						$member_type = array(
							'plgox_id' => $sjrz_status['shop_only_id'],
							'plgox_name' => '商家用户',
							'plgox_usertype' => 4,
						);
						D("Member")->save($member_type);
						// 获取用户手机号
						$use_info = D("Member")->where(array("plgox_id"=>array("eq",$sjrz_status['shop_only_id'])))->find();
						$sendSMS_content = "尊敬的".$use_info['plgox_user']."用户您好，恭喜您已经成功入驻商家，赶快去发布自己的租赁产品吧!";//到时候读取后台模板
						// 发送短信
						$success_status = sendsms_template( $use_info['plgox_tel'] , $sendSMS_content , false );
					}
					$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功并成功下发短信!"));
					return false;
				}else{
					$this->ajaxReturn(array("status"=>-2001,"message"=>"修改失败并下发短信失败!"));
					return false;
				}
			}else if( $shop_sjrz_img['shop_xianxia_xieyi'] == "1" ){
				$this->ajaxReturn(array("status"=>-2002,"message"=>"您好,该用户已经是协议签订用户,无法重复签订!"));
				return false;
			}
		}
	}
	// 删除
	public function sjrz_del() {
		if( I('shop_id') ){
			$shoop_center = D("Shop_center")->where(array("shop_id"=>array("eq",I('shop_id'))))->find();
			if( $shoop_center ){
				$shoop_center_del = D("Shop_center")->delete(I('shop_id'));
				if( $shoop_center_del ){
					unlink("./Uploads/home_sjrz_img/".$shoop_center['shop_xieyi_img']);
					$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功!"));
					return false;
				}else{
					$this->ajaxReturn(array("status"=>-2001,"message"=>"删除失败!"));
					return false;
				}
			}
		}
		// 全选删除
		if( I("shop_ids") ){
			$shop_checked = D("Shop_center")->delete( I("shop_ids") );
			if( $shop_checked ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"全选删除成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>2000,"message"=>"全选删除失败!"));
				return false;
			}
		}
	}
	// 条件筛选
	public  function sjrz_shaixuan() {
		$sjrz_suiffx = "";
		if( I("sjrz_shaixuan_1") == '1' ){
			$sjrz_suiffx.=" and (shop_xianxia_xieyi = 0 )";
		}else if( I('sjrz_shaixuan_1') == '2' ){
			$sjrz_suiffx.=" and (shop_xianxia_xieyi = 1 )";
		}
		if( I("search_bianhao") ){
			$sjrz_suiffx.=" and (shop_xieyi_bianhao = '".I('search_bianhao')."' )";
		}
		$count = D("Shop_center")->where("shop_id".$sjrz_suiffx)->count();
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$shop_info = D("Shop_center as ruz")
		->where("shop_id".$sjrz_suiffx)
		->join("left join plgox_member as user on user.plgox_id = ruz.shop_only_id")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		$this->assign("shop_info",$shop_info);
		$this->assign("page",$page->show());
		$this->assign("setTitle","商家搜索数据");
		$this->assign('sjrz_shaixuan_1',I('sjrz_shaixuan_1'));
		$this->assign('search_bianhao',I('search_bianhao'));
		$this->display("shangjia_index");
	}
}
?>