<?php  
namespace Admin\Controller;
use Think\Controller;
class ShareController extends SessionController {
	/**
	 * @param 共享市场
	 * 第一步 板块
	 * 第二步 分类
	 * 第三步 商品
	 */
	// 板块
	public function share_module_list() {
		$share_list = D("Module")->select();
		$this->assign("share_list",$share_list);
		$this->assign("setTitle","板块管理列表");
		$this->display("share_module_list");	
	}
	// 添加板块
	public function share_module_data() {
		if( base64_decode(I("module_edit_id")) ){
			$share_list = D("Module")->where( array("module_id"=>base64_decode(I("module_edit_id"))) )->find();
			$this->assign("setTitle","板块修改");
			$this->assign("share_list",$share_list);
			$this->display("share_module_data");	
		}else{
			$this->assign("module_createtime",time());
			$this->assign("setTitle","板块新增");
			$this->display("share_module_data");			
		}
	}
	public function share_module_update() {
		if( I('module_id') ){
			// 板块修改
			$data = array(
				'module_id'				=> I('module_id'),
				'module_title'			=> I('module_title'),
				'module_descriptions'	=> I('module_descriptions'),
				'module_updatetime'		=> time(),
				'module_person'			=> $_SESSION['plgox_user']['plgox_user'],
			);
			$module_save = D("Module")->save($data);
			if( $module_save ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"修改失败"));
				return false;
			}
		}else{
			$data = array(
				'module_title'			=> I('module_title'),
				'module_descriptions'	=> I('module_descriptions'),
				'module_createtime'		=> strtotime(I('module_createtime')),
				'module_person'			=> $_SESSION['plgox_user']['plgox_user'],
			);
			$module_add = D("Module")->add($data);
			if( $module_add ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加成功"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"添加失败"));
				return false;
			}
		}
	}
	public function module_del(){
		if( I("module_id") ){
			$module = D("Share")->where(array("share_module_id"=>I("module_id")))->find();
			if( empty($module) ){
				D("Module")->delete( I("module_id") );
				$this->ajaxReturn(array("status"=>2000,"message"=>"删除板块成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>2003,"message"=>"无法删除,因为该板块下面有商品模块!"));
			}
		}else if( I("module_ids") ){
			$where[] = 'FIND_IN_SET("'.I('module_ids').'",share_module_id)';
			$module = D("Share")->where($where)->select();
			$module_ = D("Share")->where(array("share_module_id"=>array("IN",I('module_ids'))))->select();
			if( empty($module) AND empty($module_) ){
				D("Module")->delete( I("module_ids") );
				$this->ajaxReturn(array("status"=>2002,"message"=>"全选删除板块成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>2003,"message"=>"全选删除的状态下,有板块带有商品模块,请仔细检查后删除!"));
				return false;
			}
			
		}
	}
	// 分类展示
	public function share_classify_list() {
		// 自定义分类查询
		$this->assign("classify_select",D('Classify')->classify_list());
		$this->assign("setTitle","分类列表管理");
		$this->display("share_classify_list");
	}
	public function share_classify_data(){
		if( base64_decode(I("classify_update_id")) ){
			// 修改分类
			$classify_value = D("Classify")->where(array("classify_id"=>base64_decode(I("classify_update_id"))))->find();
			$this->assign("Classifys_select",D("Classify")->classify_lists( $classify_value['classify_pid'] ));
			$this->assign("classify_value",$classify_value);
			$this->assign("setTitle","共享分类修改");
			$this->display("share_classify_data");
		}else{
			$this->assign("Classifys_select",D("Classify")->classify_lists());
			$this->assign("setTitle","新分类添加");
			$this->display("share_classify_data");
		}
	}
	// 分类更新/添加
	public function share_claaify_save() {
		if( I("classify_id") ){
			// 修改
			$data = array();
			if( I("classify_pid" ) == 0 ){
		    	$data = array(
		    		'classify_pid' 	=> I('classify_pid'),
		    		'classify_path' => 0
		    	);
		    }else{
		    	$data = array(
		    		'classify_pid' 	      => I('classify_pid'),
		    		'classify_path'	      => D("Classify")->where(array("classify_id"=>I('classify_pid')))->getField('classify_path'),
		    	);
		    	$data['classify_path'] .= '-'.I('classify_pid');
		    }	
		    $datas = array(
		    	'classify_id'		  => I('classify_id'),
	    		'classify_title'      => I('classify_title'),
	    		'classify_order'      => I("classify_order"),
	    		'classify_status'     => I("classify_status"),
	    		'classify_createtime' => time()
		    );
		    $data_ = array_merge($data,$datas);
		    $classify_save = D("Classify")->save($data_);
		    if( $classify_save ){
		    	$this->ajaxReturn(array("status"=>2000,"message"=>"分类修改成功"));
				return false;
		    }else{
		    	$this->ajaxReturn(array("status"=>-2000,"message"=>"分类修改失败"));
				return false;
		    }
		}else{
			$data = array();
		    // 添加
		    if( I("classify_pid" ) == 0 ){
		    	$data = array(
		    		'classify_pid' 	=> I('classify_pid'),
		    		'classify_path' => 0
		    	);
		    }else{
		    	$data = array(
		    		'classify_pid' 	      => I('classify_pid'),
		    		'classify_path'	      => D("Classify")->where(array("classify_id"=>I('classify_pid')))->getField('classify_path'),
		    	);
		    	$data['classify_path'] .= '-'.I('classify_pid');
		    }	
		    $datas = array(
	    		'classify_title'      => I('classify_title'),
	    		'classify_order'      => I("classify_order"),
	    		'classify_status'     => I("classify_status"),
	    		'classify_createtime' => time()
		    );
		    $data_ = array_merge($data,$datas);
		    $classify_add = D("Classify")->add($data_);
		    if( $classify_add ){
		    	$this->ajaxReturn(array("status"=>2000,"message"=>"分类添加成功"));
				return false;
		    }else{
		    	$this->ajaxReturn(array("status"=>-2000,"message"=>"分类添加失败"));
				return false;
		    }
		}
	}
	// 分类删除
	public function classify_del()
	{
		if( I("classify_id") ){
			$classify_sel = D('Classify')->where(array("classify_pid"=>I("classify_id") ))->select();
			if( !empty($classify_sel) ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>"该分类存在子类，暂时无法删除!"));
				return false;
			}else{
				D("Classify")->delete(I("classify_id"));
				$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功"));
				return false;
			}
		}else if( I("classify_ids") ){
			$classify_sel = D('Classify')->where(array("classify_pid"=>array("in",I('classify_ids')) ))->select();
			if( !empty($classify_sel) ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>"您全选的分类当中存在子类，请注意选择!"));
			}else{
				D("Classify")->delete(I("classify_ids"));
				$this->ajaxReturn(array("status"=>2002,"message"=>"一键删除成功"));
				return false;				
			}
		}
	}
	// 注入子分类value展示
	public function share_level_classify() {
		$classify_id = D("Classify")->where(array("classify_id"=>base64_decode(I('share_level_classify_id'))))->find();
		$this->assign("classify_id",$classify_id);
		$this->assign("classify_ids",base64_decode(I('share_level_classify_id')));
		$this->assign("setTitle","添加子分类");
		$this->display("share_level_classify");
	}
	// 添加子分类
	public function share_level_classify_add() {
		$data = array(
			'classify_pid' 	  		=> I('classify_ids'),
			'classify_title'  		=> I('classify_title'),
			'classify_status' 		=> I('classify_status'),
			'classify_order'  		=> I('classify_order'),
			'classify_path'	  		=> D("Classify")->where(array("classify_id"=>I('classify_ids')))->getField("classify_path"),
			'classify_createtime'	=> time()
		);
		$data['classify_path'].= '-'.I('classify_ids');
		$data_add_id = D("Classify")->add($data);
		if( $data_add_id ){
	    	$this->ajaxReturn(array("status"=>2000,"message"=>"分类添加成功"));
			return false;
	    }else{
	    	$this->ajaxReturn(array("status"=>-2000,"message"=>"分类添加失败"));
			return false;
	    }
	}
	// 租赁方式
	public function share_zulin_type() {
		$count = D("Zulin ")->count();
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$zulin = D("Zulin")->order("zulin_id desc")->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign("page",$page->show());
		$this->assign("zulin",$zulin);
		$zulin_ = D("Zulin")->select();
		$this->assign("zulin_",$zulin_);
		$this->assign("setTitle","租赁方式列表");
		$this->display("share_zulin_type");
	}
	public function share_zulin_search() {
		if( I("zulin_day_number") != "0" ){
			if( !empty( I("zulin_day_number") ) ){
				$count = D("Zulin")->where(" zulin_day_number = ".I("zulin_day_number")." ")->count();
				$page = new \Think\Page($count,10);
				$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
				$page->setConfig("prev","上一页");
				$page->setConfig("next","下一页");
				$page->setConfig("first","首页");
				$page->setConfig("last","末页");
				$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
				$zulin = D("Zulin")->where(" zulin_day_number = ".I("zulin_day_number")." ")->order("zulin_id desc")->limit($page->firstRow.','.$page->listRows)->select();
				$this->assign("page",$page->show());
				$this->assign("zulin",$zulin);
				$zulin_ = D("Zulin")->select();
				$this->assign("zulin_",$zulin_);
				$this->assign("zulin_day_number",I("zulin_day_number"));
				$this->assign("setTitle","租赁方式列表");
				$this->display("share_zulin_type");
			}
		}else{
			echo "<script>alert('当前搜索错误,请正确搜索');location.href='share_zulin_type'</script>";
		}
	}
	public function share_zulin_data() {
		if( base64_decode(I("share_zulin_id")) ){
			$zulin_save = D("Zulin")->where(array("zulin_id"=>base64_decode(I("share_zulin_id"))))->find();
			$this->assign("zulin_save",$zulin_save);
			$this->assign("setTitle","租赁方式修改");
			$this->display("share_zulin_data");
		}else{
			$this->assign("setTitle","租赁方式添加");
			$this->display("share_zulin_data");
		}
	}
	public function share_zulin_add() {
		if( I("zulin_id") ){
			$data = array(
				'zulin_id'					=> I("zulin_id"),
				"zulin_day_number"			=> I("zulin_day_number"),
				"zulin_status"				=> I("zulin_status"),
				"zulin_name"				=> I("zulin_name"),
				'zulin_give'				=> I("zulin_give"),
				"zulin_createtime"			=> time()
			);
			$data_save = D("Zulin")->save($data);
			if( $data_save ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改失败"));
				return false;
			}
		}else{
			$data = array(
				"zulin_day_number"			=> I("zulin_day_number"),
				"zulin_status"				=> I("zulin_status"),
				"zulin_name"				=> I("zulin_name"),
				'zulin_give'				=> I("zulin_give"),
				"zulin_createtime"			=> time()
			);
			$data_add = D("Zulin")->add($data);
			if( $data_add ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加成功"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加失败"));
				return false;
			}			
		}
	}
	public function share_zulin_del() {
		if( I("zulin_id") ){
			$where[]= 'FIND_IN_SET("'.I("zulin_id").'",share_day_number_id)';
			$share = D("Share")->where($where)->select();
			if( empty($share) ){
	 			D("Zulin")->delete(I("zulin_id"));
	 			$this->ajaxReturn(array("status"=>2000,"message"=>"单选删除成功"));				
	 			return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"当前选项正在使用中,请取消后再删除!"));
				return false;
			}
		}else if( I("zulin_ids") ){
			$where[]= 'FIND_IN_SET("'.I("zulin_ids").'",share_day_number_id)';
			$share = D("Share")->where($where)->select();
			$share_ = D("Share")->where("share_day_number_id IN(".I("zulin_ids").") ")->select();
			if( empty( $share ) AND empty( $share_ ) ){
				D("Zulin")->delete(I("zulin_ids"));
 				$this->ajaxReturn(array("status"=>2002,"message"=>"全选删除成功"));
			}else{
				$this->ajaxReturn(array("status"=>-2002,"message"=>"删除操作当中有选项正在使用中,无法删除!"));
				return false;
			}

		}
	}
	// 产品品牌
	public function share_brand_list() {
		$count = D("Brand")->count();
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$brand = D("Brand")->order("brand_id desc")->limit($page->firstRow.','.$page->listRows)->select();
		$brand_ = D("Brand")->select();
		$this->assign("brand",$brand);
		$this->assign("brand_",$brand_);
		$this->assign("page",$page->show());
		$this->assign("setTitle","共享品牌列表");
		$this->display("share_brand_list");
	}
	public function share_brand_search(){
		if( I("brand_name") != "0" ){
			if( !empty( I("brand_name") ) ){
				$count = D("Brand")->where("brand_name = '".I("brand_name")."' ")->count();
				$page = new \Think\Page($count,10);
				$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
				$page->setConfig("prev","上一页");
				$page->setConfig("next","下一页");
				$page->setConfig("first","首页");
				$page->setConfig("last","末页");
				$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
				$brand = D("Brand")->where(" brand_name = '".I("brand_name")."' ")->order("brand_id desc")->limit($page->firstRow.','.$page->listRows)->select();
				$this->assign("page",$page->show());
				$this->assign("brand",$brand);
				$brand_ = D("Brand")->select();
				$this->assign("brand_",$brand_);
				$this->assign("name",I("brand_name"));
				$this->assign("setTitle","共享品牌列表");
				$this->display("share_brand_list");
			}
		}else{
			echo "<script>alert('当前搜索错误,请正确搜索');location.href='share_brand_list'</script>";
		}
	}
	public function share_brand_data(){
		if( base64_decode(I("share_brand_id")) ){
			$this->assign("brand_",D("Brand")->where(array("brand_id"=>base64_decode(I("share_brand_id"))))->find());
			$this->assign("setTitle","共享品牌修改");
			$this->display("share_brand_data");
		}else{
			$this->assign("setTitle","共享品牌添加");
			$this->display("share_brand_data");
		}
	}
	public function share_brand_add() {
		if( I("brand_id") ){
			//修改
			$data = array(
				'brand_id'		=> I("brand_id"),
				'brand_name' => I("brand_name"),
				'brand_status' => I("brand_status"),
				'brand_createtime' => time()
				);
			$data_save = D("Brand")->save($data);
			if( $data_save ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"修改失败"));
				return false;
			}
		}else{
			//添加
			$data = array(
				'brand_name' => I("brand_name"),
				'brand_status' => I("brand_status"),
				'brand_createtime' => time()
				);
			$data_add = D("Brand")->add($data);
			if( $data_add ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加成功"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"添加失败"));
				return false;
			}
		}
	}
	public function share_brand_del() {
		if( I("brand_id") ){
			D("Brand")->delete(I("brand_id"));
			$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功"));
			return false;
		}else if( I("brand_ids") ){
			D("Brand")->delete(I("brand_ids"));
			$this->ajaxReturn(array("status"=>2002,"message"=>"删除成功"));
			return false;
		}
	}
	// 库存规格
	public function share_specifications_list() {
		// 判断租赁数据状态
		$count = D("specifications")->count();
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$this->assign("specifications",D("Specifications as sp")->order("specifications_id desc")->join("left join plgox_zulin as zulin on zulin.zulin_id = sp.specifications_day_number_id")->limit($page->firstRow.','.$page->listRows)->select());
		$this->assign("specifications_",D("Specifications")->select());
		$this->assign("page",$page->show());
		$this->assign("setTitle","库存规格列表");
		$this->display("share_specifications_list");
	}
	// 分页搜索
	public function share_specifications_search() {
		if( I("specifications_name") != '-1' || I('specifications_status') != '-1' ){
			$count = D("specifications")->where( " specifications_name = '".I("specifications_name")."' OR specifications_status = ".I('specifications_status')." " )->count();
			$page = new \Think\Page($count,10);
			$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
			$page->setConfig("prev","上一页");
			$page->setConfig("next","下一页");
			$page->setConfig("first","首页");
			$page->setConfig("last","末页");
			$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
			$this->assign("specifications",D("Specifications")->where( " specifications_name = '".I("specifications_name")."' OR specifications_status = ".I('specifications_status')." " )->order("specifications_id desc")->limit($page->firstRow.','.$page->listRows)->select());
			$this->assign("specifications_",D("Specifications")->select());
			$this->assign("page",$page->show());
			$this->assign("zulin_",D("Zulin")->select());
			$this->assign("setTitle","库存规格列表");
			$this->display("share_specifications_list");			
		}
	}
	public function share_specifications_data(){
		if( base64_decode(I("share_specifications_id")) ){
			// 修改
			$specifications = D("Specifications as sp")->where(array("specifications_id"=>base64_decode(I("share_specifications_id"))))->find();
			$this->assign("classify",D("Classify")->classify_lists($specifications['specifications_classify_id']));
			$this->assign("zulin_day",D("Zulin")->select());
			$this->assign("specifications",$specifications);
			$this->assign("setTitle","库存规格修改");
			$this->display("share_specifications_data");
		}else{
			// 添加
			$this->assign("classify",D("Classify")->classify_lists());
			$this->assign("zulin_day",D("Zulin")->select());
			$this->assign("setTitle","库存规格添加");
			$this->display("share_specifications_data");
		}
	}
	public function share_specifications_add() {
		// 修改
		if( I("specifications_id") ){
			$image = new \Think\Image();
			// 修改
			$config = array(
			    'maxSize'    =>    10485760,
			    'rootPath'   =>    './Uploads/admin/',
			    'saveName' =>    array('uniqid',''),
			    'exts'         =>    array("bmp","jpg","jpeg","gif","png"),
			);
			$upload = new \Think\Upload($config);
			$info   =   $upload->upload();
			$specifications_img = D("Specifications")->where(array("specifications_id"=>I("specifications_id")))->find();
			if( empty($info) ){
				$data_img = array(
					'specifications_img' => $specifications_img['specifications_img'],
				);
			}else{
				$data_img['specifications_img'] = empty($info['0'])?$specifications_img['specifications_img']:$info['0']['savepath'].$info['0']['savename'];
			}
			$image->open('./Uploads/admin/'.$data_img['specifications_img']);
			$image->thumb(1200,1200)->save('./Uploads/admin/'.$data_img['specifications_img']);
			$data = array(
				'specifications_id'	=> I("specifications_id"),
				'specifications_keys' => I('specifications_keys'),
				'specifications_prices' => I('specifications_prices'),
				'specifications_zy_sj' => 1,
				'specifications_business_id' => get_session_info(),
				'specifications_classify_id'=> I("specifications_classify_id"),
				'specifications_satisfaction' => I('specifications_satisfaction'),
				'specifications_chuzu' => I('specifications_chuzu'),
				'specifications_name' => I("specifications_name"),
				'specifications_day_number_id' => I('specifications_day_number_id'),
				'specifications_day_number' => trim(I('specifications_day_number')),
				'specifications_day_type' => I('specifications_day_type'),
				'specifications_give' => I('specifications_give'),
				'specifications_rent' =>I('specifications_rent'),
				'specifications_market'	=> I("specifications_market"),
				'specifications_deposit'	=> I("specifications_deposit"),
				'specifications_stock'	=> I("specifications_stock"),
				'specifications_status' => I("specifications_status"),
				'specifications_createtime' => time()
			);
			$data_save = D("Specifications")->save(array_merge($data,$data_img));
			if( $data_save ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"修改失败"));
				return false;
			}
		}else{
			$image = new \Think\Image();
			$config = array(
			    'maxSize'    =>    10485760,
			    'rootPath'   =>    './Uploads/admin/',
			    'saveName' =>    array('uniqid',''),
			    'exts'         =>    array("bmp","jpg","jpeg","gif","png"),
			);
			$upload = new \Think\Upload($config);
			$info   =   $upload->upload();
			if( !$info ){
				$this->ajaxReturn(array("status"=>-2002,"message"=>$upload->getError() ));
				return false;
			}else{
				$data_img = array(
					'specifications_img' => $info['0']['savepath'].$info['0']['savename']
				);
			}
			$image->open('./Uploads/admin/'.$data_img['specifications_img']);
			$image->thumb(1200,1200)->save('./Uploads/admin/'.$data_img['specifications_img']);
			$data = array(
				'specifications_keys' => I('specifications_keys'),
				'specifications_classify_id'=> I("specifications_classify_id"),
				'specifications_rent' => I('specifications_rent'),
				'specifications_zy_sj' => 1,
				'specifications_business_id' => get_session_info(),
				'specifications_satisfaction' => I('specifications_satisfaction'),
				'specifications_chuzu' => I('specifications_chuzu'),
				'specifications_prices' => I('specifications_prices'),
				'specifications_name' => I("specifications_name"),
				'specifications_day_number_id' => I('specifications_day_number_id'),
				'specifications_day_number' => trim(I('specifications_day_number')),
				'specifications_day_type' => I('specifications_day_type'),
				'specifications_give' => I('specifications_give'),
				'specifications_market'	=> I("specifications_market"),
				'specifications_deposit'	=> I("specifications_deposit"),
				'specifications_stock'	=> I("specifications_stock"),
				'specifications_status' => I("specifications_status"),
				'specifications_createtime' => time()
			);
			$data_add = D("Specifications")->add(array_merge($data,$data_img));
			if( $data_add ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加成功"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"添加失败"));
				return false;
			}
		}
	}
	public function share_specifications_del() {
		if( I("specifications_id") ){
			D("Specifications")->delete(I("specifications_id"));
			$this->ajaxReturn(array("status"=>2000,"message"=>"单选删除成功"));
			return false;
		}else if( I("specifications_ids") ){
			D("Specifications")->delete(I("specifications_ids"));
			$this->ajaxReturn(array("status"=>2002,"message"=>"全选删除成功"));
			return false;
		}
	}
	// 共享商品展示
	public function share_product_list() {
		// 分页
		$count = D("Share")->count();
		$page = new \Think\Page($count,10);
		$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$page->setConfig("first","首页");
		$page->setConfig("last","末页");
		$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		$this->assign("specifications",$specifications);
		$this->assign("share_product",D("Share as share")->join("left join plgox_zulin as zulin on zulin.zulin_id =  share.share_day_number_id")->limit($page->firstRow.','.$page->listRows)->order("share_id desc")->select());
		$this->assign("page",$page->show());
		$this->assign("setTitle","共享商品列表");
		$this->display("share_product_list");
	}
	public function share_product_data(){
		if( base64_decode(I("share_product_id")) ){
			// edit
			$share = D("Share")->where(array("share_id"=>base64_decode(I("share_product_id"))))->find();
			$share_many_img = explode(",",$share['share_many_img']);
			$this->assign("share_many_img",$share_many_img);
			$this->assign("share",$share);
			$this->assign("module",D("Module")->select());
			$this->assign("module_id",$share['share_module_id']);
			// $this->assign("classify",D("Classify")->classify_lists($share['share_classify_pid']));
			$this->assign("classify",I("product_classify_id"));
			$this->assign("brand",D("Brand")->select());
			$this->assign("specifications",D("Specifications")->where(array("specifications_classify_id"=>array("eq",I("product_classify_id"))))->select());
			// 级联
			$this->assign("sheng",D("City")->where( array("city_pid"=>array("EQ",1)) )->select());
			$this->assign("shi",D("City")->where( array("city_pid" => array("EQ",$share['share_sheng'])) )->select());
			$this->assign("xian",D("City")->where( array("city_pid" => array("EQ",$share['share_shi'])) )->select());
			$this->assign("filter",D("Filter")->select());
			$this->assign("classify_name",D("Classify")->where(array("classify_id"=>array("eq",I("product_classify_id"))))->find());
			$this->assign("setTitle","共享商品修改列表");
			$this->assign("filter",D("Filter")->select());
			$this->display("share_product_data");
		}else{
			// add
			$this->assign("time",time());
			// dump(D("Specifications")->where(array("specifications_classify_id"=>array("eq",I("product_classify_id"))))->select());
			$this->assign("specifications",D("Specifications")->where(array("specifications_classify_id"=>array("eq",I("product_classify_id"))))->select());
			$this->assign("brand",D("Brand")->select());
			$this->assign("address",D("City")->where("city_pid = 1")->select());
			$this->assign("module",D("Module")->select());
			$this->assign("classify",I("product_classify_id"));
			$this->assign("classify_name",D("Classify")->where(array("classify_id"=>array("eq",I("product_classify_id"))))->find());
			$this->assign("filter",D("Filter")->select());
			$this->assign("zulin_day",D("Zulin")->select());
			$this->assign("setTitle","共享商品添加列表");
			$this->display("share_product_data");
		}
	}
	public function share_product_add(){
		if( I("share_id") ){
			$image = new \Think\Image();
			// 修改
			$config = array(
			    'maxSize'    =>    10485760,
			    'rootPath'   =>    './Uploads/admin/',
			    'saveName' =>    array('uniqid',''),
			    'exts'         =>    array("bmp","jpg","jpeg","gif","png"),
			);
			$upload = new \Think\Upload($config);
			$info   =   $upload->upload();
			$share_img = D("Share")->where(array("share_id"=>I("share_id")))->find();
			if( empty($info) ){
				$data_img = array(
					'share_home_img' => $share_img['share_home_img'],
					'share_many_img' => $share_img['share_many_img'],
				);
			}else{
				// 多图
				$share_imgs = explode(",",$share_img['share_many_img']);
				$share_many_img = array(
					empty($info['1'])?$share_imgs['0']:$info['1']['savepath'].$info['1']['savename'],
					empty($info['2'])?$share_imgs['1']:$info['2']['savepath'].$info['2']['savename'],
					empty($info['3'])?$share_imgs['2']:$info['3']['savepath'].$info['3']['savename'],
					empty($info['4'])?$share_imgs['3']:$info['4']['savepath'].$info['4']['savename'],
					empty($info['5'])?$share_imgs['4']:$info['5']['savepath'].$info['5']['savename'],
					empty($info['6'])?$share_imgs['5']:$info['6']['savepath'].$info['6']['savename']
				);	
				$share_many_image = implode(',',$share_many_img);
				$share_imgages = explode(",",$share_many_image);
				foreach( $share_imgages as $val ){
					if( !empty($val) ){
						$image->open('./Uploads/admin/'.$val);
						$image->thumb(600,600)->save('./Uploads/admin/'.$val);
						$data[] = $val;
					}
				}
				$share_many_images = implode(",", $data);
				if( empty($info['0']) ){
					$share_home_imgs = $share_img['share_home_img'];
				}else{
					$share_home_imgs = $info['0']['savepath'].$info['0']['savename'];
				}
				$data_img = array(
					'share_home_img' => $share_home_imgs,
					'share_many_img' => $share_many_images,
				);
				$image->open('./Uploads/admin/'.$data_img['share_home_img']);
				$image->thumb(180,180)->save('./Uploads/admin/'.$data_img['share_home_img']);
			}
			$data_ = array(
				'share_id' => I("share_id"),
				'share_type' => 1,
				'share_release_ascription' => 1,
				'share_key'  => I("share_key"),
				'share_weight' => I("share_weight"),
				'share_prices_qujian' => I('share_prices_qujian'),
				'share_caizhi' => I('share_caizhi'),
				'share_sj_pq' => I('share_sj_pq'),
				'share_sj_xh' => I('share_sj_xh'),
				'share_cptgs' => I("share_cptgs"),
				// 'share_rent' => I("share_rent"),
				'share_self_support' => 1,
				'share_name'	=> I("share_name"),
				'share_module_id'   => I("share_module_id"),
				'share_classify_pid' => I("share_classify_id"),
				'share_chandi' => I("share_chandi"),
				'share_production_date' => I("share_production_date"),
				'share_freight'	=> I("share_freight"),
				'share_freight_prices'  => I("share_feright_prices"),
				// 'share_the_brand_id' => I("share_the_brand_id"),
				'share_product_type_id' => I("share_product_type_id"),
				'share_sheng' => I("share_sheng"),
				'share_shi' => I("sheng"),
				'share_xian' => I("shi"),
				'share_descriptions' => base64_decode(I("share_descriptions")),
				'share_recommend' => I("share_recommend"),
				'share_status'	=> I("share_status"),
				'share_createtime'  => strtotime(I("share_createtime")),
				'share_member_uid' => get_session_info(),
				'share_updatetime'  => time()
			);
			$data = array_merge($data_img,$data_);
			$data_save = D("Share")->save($data);
			if( $data_save ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功" ));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"修改失败" ));
				return false;
			}
		}else{
			$image = new \Think\Image();
			// 添加
			$config = array(
			    'maxSize'    =>    10485760,
			    'rootPath'   =>    './Uploads/admin/',
			    'saveName' =>    array('uniqid',''),
			    'exts'         =>    array("bmp","jpg","jpeg","gif","png"),
			);
			$upload = new \Think\Upload($config);
			$info   =   $upload->upload();
			if( !$info ){
				$this->ajaxReturn(array("status"=>-2002,"message"=>$upload->getError() ));
				return false;
			}else{
				// 多图
				$share_many_img = array(
					$info['1']['savepath'].$info['1']['savename'],
					$info['2']['savepath'].$info['2']['savename'],
					$info['3']['savepath'].$info['3']['savename'],
					$info['4']['savepath'].$info['4']['savename'],
					$info['5']['savepath'].$info['5']['savename'],
					$info['6']['savepath'].$info['6']['savename']
				);
				foreach( $share_many_img as $val ){
					if( !empty($val) ){
						$image->open('./Uploads/admin/'.$val);
						$image->thumb(600,600,\Think\Image::IMAGE_THUMB_FILLED)->save('./Uploads/admin/'.$val);
						$img_data[] = $val;
					}
				}
				if( $img_data == null ){
					$this->ajaxReturn(array("status"=>-2002,"message"=>"至少上传一张多产品详情图!"));
					return false;
				}else{
					$share_many_image = implode(',',$img_data);
				}
				$data_img = array(
					'share_home_img' => $info['0']['savepath'].$info['0']['savename'],
					'share_many_img' => $share_many_image,
				);
				// 图片压缩
				$image->open('./Uploads/admin/'.$data_img['share_home_img']);
				$image->thumb(180,180,\Think\Image::IMAGE_THUMB_FILLED)->save("./Uploads/admin/".$data_img['share_home_img']);
			}
			$data_ = array(
				'share_key'  => I("share_key"),
				'share_type' => 1,
				'share_release_ascription' => 1,
				'share_cptgs' => I("share_cptgs"),
				// 'share_rent' => I("share_rent"),
				'share_weight' => I("share_weight"),
				'share_sj_pq' => I('share_sj_pq'),
				'share_sj_xh' => I('share_sj_xh'),
				'share_prices_qujian' => I('share_prices_qujian'),
				'share_caizhi' => I('share_caizhi'),
				'share_self_support' => 1,
				'share_name'	=> I("share_name"),
				'share_module_id'   => I("share_module_id"),
				'share_classify_pid' => I("share_classify_id"),
				'share_chandi' => I("share_chandi"),
				'share_production_date' => I("share_production_date"),
				'share_freight'	=> I("share_freight"),
				'share_freight_prices'  => I("share_feright_prices"),
				// 'share_the_brand_id' => I("share_the_brand_id"),
				'share_product_type_id' => I("share_product_type_id"),
				'share_sheng' => I("share_sheng"),
				'share_shi' => I("sheng"),
				'share_xian' => I("shi"),
				'share_descriptions' => base64_decode(I("share_descriptions")),
				'share_recommend' => I("share_recommend"),
				'share_status'	=> I("share_status"),
				'share_createtime'  => strtotime(I("share_createtime")),
				'share_member_uid' => get_session_info()
			);
			$data = array_merge($data_img,$data_);
			$data_add = D("Share")->add($data);
			if( $data_add ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加成功" ));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"添加失败" ));
				return false;
			}			
		}
	}
	// 执行商品删除
	public function share_product_del() {
		if( I("share_id") ){
			$share_sel = D("Share")->where( array("share_id"=>I("share_id") ) )->find();
			$share_img = explode(",",$share_sel['share_many_img']);
			$share_del = D("Share")->delete(I("share_id"));
			if( $share_del ){
				unlink("./Uploads/admin/".$share_sel['share_home_img']);
				unlink("./Uploads/admin/".$share_img['0']);
				unlink("./Uploads/admin/".$share_img['1']);
				unlink("./Uploads/admin/".$share_img['2']);
				unlink("./Uploads/admin/".$share_img['3']);
				unlink("./Uploads/admin/".$share_img['4']);
				$this->ajaxReturn(array("status"=>2000,"message"=>"单条数据删除成功!"));
				return false;
			}
		}else if( I("share_ids") ){
			D("Share")->delete(I("share_ids"));
			$this->ajaxReturn(array("status"=>2002,"message"=>"全选数据删除成功!"));
			return false;
		}
	}
	public function getArea(){
		$where['city_pid'] = I("cityId");
		$city = D("City")->where($where)->select();
		$this->ajaxReturn($city);
	}
	// 同款推荐
	public function share_tongkuang(){
		$this->assign("tongkuang_list",D("Tongkuang as tk")->join("left join plgox_share as share on share.share_id = tk.tongkuang_share_id")->where(array("tongkuang_share_id"=>base64_decode(I('share_product_tongkuang_id')) ))->select());
		$this->assign("share_id",base64_decode(I('share_product_tongkuang_id')));
		$this->assign("setTitle","同款推荐");
		$this->display("share_tongkuang_list");
	}
	// 展示同款
	public function share_tongkuang_look() {
		if( empty(base64_decode(I("share_edit_id"))) ){
			$share_ids = D("Share")->where(array("share_id"=>array("EQ",I('tongkuang_setup_id'))))->find();
			// 分类查询
			$classify = D("Classify")->where(array("classify_id"=>array("EQ",$share_ids['share_classify_pid'])))->find();
			$this->assign("classify_name",$classify);
			$this->assign("share_data",D("Share")->where(array("share_id"=>array("EQ",I('tongkuang_setup_id'))))->find());
			$this->assign("tuijian_product",D("Share")->select());
			// 调用分类
			$this->assign("classify",D("Classify")->classify_lists());
			// 价格区间
			$this->assign("setTitle","同款推荐添加");
			$this->display("share_tongkuang_add");
		}else{
			$tongkuang_id = D("Tongkuang as tk")->where( array("tk.tongkuang_id"=>base64_decode(I("share_edit_id")) ) )
			->join("left join plgox_share as share on share.share_id = tk.tongkuang_share_id")
			->join("left join plgox_classify as classify on classify.classify_id = tk.tongkuang_classify_id")->find();

			$classify_name = D("Classify")->where(array("classify_id"=>array("EQ",$tongkuang_id['tongkuang_classify_id'])))->find();
			$this->assign("classify_name",$classify_name);
			$this->assign("tongkuang_id",$tongkuang_id);
			$this->assign("tuijian_product",D("Share")->select());
			// 调用分类
			$this->assign("classify",D("Classify")->classify_lists($tongkuang_id['classify_id']));
			// 价格区间
			$this->assign("setTitle","同款推荐修改");
			$this->display("share_tongkuang_add");
		}
	}
	// 设置同款推荐
	public function share_tongkuang_setup() {
		// edit
		$share_id = D("Tongkuang")->where(array("tongkuang_id"=>I("tongkuang_id") ))->find();
		if( !empty($share_id) ){
			$tongkuang_product_id = implode(",",I('tongkuang_product_id'));
			$data = array(
				'tongkuang_id' => I('tongkuang_id'),
				'tongkuang_classify_id' => I("tongkuang_classify_id"),
				'tongkuang_share_id' => I('tongkuang_product_id'),
				'tongkuang_product_id' => $tongkuang_product_id,
				'tongkuan_admin_id' => $_SESSION['plgox_user']['plgox_id'],
				'tongkuang_stauts' => I('tongkuang_stauts'),
				'tongkuang_createtime' => time()
			);
			$data_save = D("tongkuang")->save($data);
			if( $data_save ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"修改失败!"));
				return false;
			}
		}
		// add
		$share_id = D("Tongkuang")->where(array("tongkuang_share_id"=>I("tongkuang_id") ))->find();
		if( !empty($share_id) ){
			$this->ajaxReturn(array("status"=>-2000,"message"=>"当前店铺已存在,如果需要执行添加新的推荐,请进入修改区域添加!"));
			return false;
		}else{
			$tongkuang_product_id = implode(",",I('tongkuang_product_id'));
			$data = array(
				'tongkuang_share_id' => I('tongkuang_share_id'),
				'tongkuang_classify_id' => I("tongkuang_classify_id"),
				'tongkuang_product_id' => $tongkuang_product_id,
				'tongkuan_admin_id' => $_SESSION['plgox_user']['plgox_id'],
				'tongkuang_stauts' => I('tongkuang_stauts'),
				'tongkuang_createtime' => time()
			);
			$data_add = D("tongkuang")->add($data);
			if( $data_add ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"设置成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"设置失败!"));
				return false;
			}				
		}
	}
	// 无刷新同款推荐
	public function getTongkuang(){
		$where['tongkuang_id'] = I("tongkuang_id");
		$tongkuang = D("Tongkuang")->where($where)->find();
		$this->ajaxReturn($tongkuang);
	}
	public function getClassify(){
		$where['share_classify_pid'] = I('classify_id');
		$classify = D("Share")->where($where)->select();
		$this->ajaxReturn($classify);
	}
	// 价格区间
	public function filter_qujian() {		
		$this->assign("filter",D("Filter")->order("filter_id desc")->select());
		$this->display("filter_qujian");
	}
	public function filter_qujian_data() {
		if( !empty(base64_decode(I("filter_edit_id"))) ){
			//edit
			$prices = D("Filter")->where(array("filter_id"=>array("EQ",base64_decode(I("filter_edit_id")))))->find();
			$this->assign("prices",explode("-",$prices['filter_content']));
			$this->assign("filter",D("Filter")->where(array("filter_id"=>array("EQ",base64_decode(I("filter_edit_id")))))->find());
			$this->display("filter_qujian_data");
		}else{
			//add
			$this->display("filter_qujian_data");
		}
	}
	public function filter_qujian_add() {
		if( empty( I("filter_id") ) ){
			$data = array(
				'filter_content' => I('filter_content'),
				'filter_status' => I('filter_status'),
				'filter_createtime' => time()
			);
			$data_add = D("Filter")->add($data);
			if( $data_add ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"添加失败!"));
				return false;
			}			
		}else{
			$data = array(
				'filter_id' => I('filter_id'),
				'filter_content' => I('filter_content'),
				'filter_status' => I('filter_status'),
				'filter_createtime' => time()
			);
			$data_save = D("Filter")->save($data);
			if( $data_save ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"修改失败!"));
				return false;
			}	
		}			
	}
	public function filter_del() {
		if( I("filter_id") ){
			D("Filter")->delete(I("filter_id"));
			$this->ajaxReturn(array("status"=>2000,"message"=>"单选删除成功!"));
			return false;
		}else if( I("filter_ids") ){
			D("Filter")->delete(I("filter_ids"));
			$this->ajaxReturn(array("status"=>-2000,"message"=>"全选删除成功!"));
			return false;
		}
	}
	// 进入商品前先选择分类
	public function share_select_classify_product(){
		if( empty( base64_decode(I('share_product_id')) ) ){
			// 查询分类顶级级分类
			$classify = D("Classify")->where(array("classify_pid"=>array("eq",0)))->select();
			$this->assign("classify",$classify);
			$this->assign("setTitle","发布商品 > 选择商品所在分类");
		}else if( !empty( base64_decode(I('share_product_id')) ) ){
			// 查询share表的分类
			$share = D("Share")->where(array("share_id"=>array("eq",base64_decode(I('share_product_id')))))->find();
			$classify = D("Classify")->where(array("classify_pid"=>array("eq",0)))->select();
			$this->assign("classify",$classify);
			$this->assign("setTitle","修改商品 > 选择商品所在分类");
			$this->assign("share_product_id",base64_decode(I('share_product_id')));
			$this->assign("share_classify_pid",$share['share_classify_pid']);
			/*// 展示三级分类
			$classify_ = D("Classify")->where(array("classify_pid"=>array("eq",$share['share_classify_pid'])))->find();
			$this->assign("classify_",$classify_ );*/
		}
		$this->display("share_select_classify_product");
	}
	// 获取二级分类
	public function share_classify_erji(){
		$where['classify_pid'] = I("erjifenlei");
		$erjifenlei = D("Classify")->where($where)->select();
		$this->ajaxReturn($erjifenlei);
	}
	// 获取三级分类
	public function share_classify_sanji(){
		$where['classify_pid'] = I("sanjifenlei");
		$sanjifenlei = D("Classify")->where($where)->select();
		$this->ajaxReturn($sanjifenlei);
	}
}
?>