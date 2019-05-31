<?php  
namespace Home\Controller;
use Think\Controller;
class HomeuserController extends CommonController {
	/**
	 * @param 前台用户管理页面
	 */
	public function index() {
		if(empty(get_login_userid())){
			$this->redirect("Tourist/login");
			exit;
		}
		// 订单数量统计
		$order_detil = D("Cart as carts")
		->where(array("cart_shangjia_id"=>array("eq",get_login_userid())))
		->join("left join plgox_order_detil as orders on orders.order_cart_id = carts.cart_id")
		->count();
		// 维修订单统计
		$repair = D("Repair")->where(array("repair_uid"=>array("eq",get_login_userid())))->count();
		// 退租统计
		$this->assign("order_detil",$order_detil);
		$this->assign("repair",$repair);
		$this->display("htsy_index");
	}
	// 认证查询
	public function ajaxRZ_select(){
		$is_renzheng = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
		if( $is_renzheng['plgox_is_renzheng'] == 0 ){
			$this->ajaxReturn(array("status"=>-2000,"message"=>"你尚未进行企业认证,请先认证后再进行商家入驻!"));
			return false;
		}else if( $is_renzheng['plgox_is_renzheng'] == 1 ){
			$this->ajaxReturn(array("status"=>-2001));
			return false;
		}
		$this->ajaxReturn($is_renzheng);
	}
	/**
	 * @param 登录
	 */
	public function htsy_top() {
		if(empty(get_login_userid())){
			$this->redirect("Tourist/login");
			exit;
		}
		$is_renzheng = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();

        if( $is_renzheng['plgox_is_renzheng'] == '0' ){
        	$is_sjrz = 1;
        }else if( $is_renzheng['plgox_is_renzheng'] == '1' ){
        	$is_sjrz = 2;
        }

        $this->assign("sjrz_renzheng",$is_renzheng);

        $this->assign("is_sjrz",$is_sjrz);
		
		$this->display("Homeuser:htsy_top");
	}
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
    	$goods = $goodss->field('goods_publish_time,goods_id,goods_edit_time,goods_name,goods_is_watched,goods_sell_type')
    	// ->join(" left join plgox_juezhi_brand as b on b.juezhi_brand_id = plgox_goods.goods_typec") ,juezhi_brand_name
    	->where(array('goods_is_check'=>1,'goods_push_user_id'=> $_SESSION['plgox_username']['plgox_id']))
    	->limit($page->firstRow.','.$page->listRows)->order($order.' desc')->select();
    	//echo $goodss->getLastSql();
    	//echo "<br>user_id:".$_SESSION['plgox_username']['plgox_id'];
    	//exit;
    	$this->assign("count",$count);
    	$this->assign("goods",$goods);
    	$this->assign("page",$page->show());
    	$this->display('JueZhi_fbgl');
    }
	 //二手闲置选择分类
     public function esxz_choose_fl(){
     	//type==0,初始页面加载。
     	$id = I("id");
     	$type = I("type");
     	if($type==0){
	     	$where1['juezhi_brand_aid'] = array('eq',0);
	     	$list_one = D('juezhi_brand')->where($where1)->select();
	     	$where2['juezhi_brand_aid'] = $list_one[0]['juezhi_brand_id'];
	     	$where2['juezhi_brand_bid'] = array('eq',0);
	     	$list_two = D('juezhi_brand')->where($where2)->select();
	     	$where3['juezhi_brand_bid'] = $list_two[0]['juezhi_brand_id'];
	     	$list_three = D('juezhi_brand')->where($where3)->select();
	     	$choose[0]['list_one'] = $list_one;
	     	$choose[0]['list_two'] = $list_two;
	     	$choose[0]['list_three'] = $list_three;
	     	//print_r($choose);
	     	//exit;
    		$this->assign("choose1",$list_one);
    		$this->assign("choose2",$list_two);
    		$this->assign("choose3",$list_three);
    		$this->display('esxz_choose_fl');
    	// dump($_SESSION);
     	//type==1,用户点击1级列表。
     	}else if($type==1){
     		$where1['juezhi_brand_aid'] = $id;
	     	$where1['juezhi_brand_bid'] = array('eq',0);
     		$list_two = D('juezhi_brand')->where($where1)->select();
     		$where2['juezhi_brand_bid'] = $list_two[0]['juezhi_brand_id'];
     		$list_three = D('juezhi_brand')->where($where2)->select();
	     	//$choose[0]['list_two'] = $list_two;
	     	//$choose[0]['list_three'] = $list_three;
	     	$choose['list_two'] = $list_two;
	     	$choose['list_three'] = $list_three;
	     	$this->ajaxReturn($choose);
	    //type==2,用户点击2级列表。
     	}else{
     		$where2['juezhi_brand_bid'] = $id;
     		$list_three = D('juezhi_brand')->where($where2)->select();
	     	//$choose[0]['list_three'] = $list_three;
	     	$choose['list_three'] = $list_three;
	     	$this->ajaxReturn($choose);
     	}
    }
	/**
	 * @param 我的租赁
	 */
	public function wode_zuling() {
		if(empty(get_login_userid())){
			$this->redirect("Tourist/login");
			exit;
		}
		// 分页
		$count = D("Share")
		->where(array("share_member_uid"=>array("eq",get_login_userid()),"share_release_ascription"=>array("eq",2),"share_self_support"=>array("eq",2)))
		->count();
		$page = new \Think\Page($count,10);
		$page->setConfig("header","<div class='page_style'>共<b>%TOTAL_PAGE%</b>页</div><div class='page_djy'>/第<b><input type='text' value=%NOW_PAGE% class='bdz'/></b>页</div><div class='qdtz'>确定</div>");
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        $page->setConfig("first","首页");
        $page->setConfig("last","尾页");
        $page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		// 商品表
		$shangjia_share = D("Share as share")
		->where(array("share_member_uid"=>array("eq",get_login_userid()),"share_release_ascription"=>array("eq",2),"share_self_support"=>array("eq",2)))
		->join("left join plgox_brand as pp on pp.brand_id = share.share_the_brand_id")
		->join("left join plgox_city as city on city.city_id = share.share_sheng")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		// 规格表 share_product_type_id
		$specifications = D("Specifications")->where(array("specifications_zy_sj"=>array("eq",2)))->select();
		$this->assign("page",$page->show());
		$this->assign('specifications',$specifications);
		$this->assign("shangjia_share",$shangjia_share);
		$this->display("wode_zuling");
	}
	// 删除商品
	public function AjaxShare_del() {
		if( I('specifications_id') ){
			// 删除并且删除原始的图片
			$specifications_img = D("specifications")->where(array("specifications_id"=>array("eq",I('specifications_id'))))->find();
			if( $specifications_img ){
				unlink("./Uploads/admin/".$specifications_img['specifications_img']);
				$specifications = D("specifications")->delete(I('specifications_id'));
				if( $specifications ){
					$this->ajaxReturn(array("status"=>2000,"message"=>"删除套餐成功!"));
					return false;
				}
			}else{
				$this->ajaxReturn(array("status"=>-2001,"message"=>"删除套餐失败!"));
				return false;
			}
		}else if( I("share_id") ){
			// 删除并且删除原始的图片
			$share_id = D("share")->where(array("share_id"=>array("eq",I('share_id'))))->find();
			if( $share_id ){
				$share_many_img = explode(",",$share_id['share_many_img']);
				foreach ($share_many_img as $key => $value) {
					unlink("./Uploads/admin/".$value);
				}
				$share = D("share")->delete(I('share_id'));
				if( $share ){
					$this->ajaxReturn(array("status"=>2000,"message"=>"删除租赁商品成功!"));
					return false;
				}
			}else{
				$this->ajaxReturn(array("status"=>-2001,"message"=>"删除租赁商品失败!"));
				return false;
			}
		}
	}
	// 商品上下架
	public function AjaxShare_status(){
		$share = D("share")->where(array("share_id"=>array("eq",I("share_id"))))->find();
		if( $share["share_status"] == 0 ){
			$data = array(
				'share_id' => I("share_id"),
				'share_status' => 1,
			);
			$share_save = D("share")->save($data);
			if( $share_save ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"已成功下架商品！"));
			}else{
				$this->ajaxReturn(array("status"=>2000,"message"=>"下架商品失败！"));
			}
			
		}else if( $share["share_status"] == 1 ){
			$data = array(
				'share_id' => I("share_id"),
				'share_status' => 0,
			);
			$share_save = D("share")->save($data);
			if( $share_save ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"已成功上架商品！"));
			}else{
				$this->ajaxReturn(array("status"=>2000,"message"=>"上架商品失败！"));
			}
		}
	}
	// 查看报价
	public function select_baojia() {
		$this->display("select_baojia");
	}
	// 商品搜索
	public function share_search() {
		if(empty(get_login_userid())){
			$this->redirect("Tourist/login");
			exit;
		}
		if( !empty(I("share_name")) ){
			$count = D("Share")
			->where("share_member_uid = ".get_login_userid()." AND share_name LIKE '%".I("share_name")."%' AND share_release_ascription = 2 AND share_self_support = 2 ")
			->count();
			
		}
		$page = new \Think\Page($count,10);
		$page->setConfig("header","<div class='page_style'>共<b>%TOTAL_PAGE%</b>页</div><div class='page_djy'>/第<b><input type='text' value=%NOW_PAGE% class='bdz'/></b>页</div><div class='qdtz'>确定</div>");
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        $page->setConfig("first","首页");
        $page->setConfig("last","尾页");
        $page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
        // 商品表
		$shangjia_share = D("Share as share")
		->where("share_member_uid = ".get_login_userid()." AND share_name LIKE '%".I("share_name")."%' AND share_release_ascription = 2 AND share_self_support = 2 ")
		->join("left join plgox_brand as pp on pp.brand_id = share.share_the_brand_id")
		->join("left join plgox_city as city on city.city_id = share.share_sheng")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		// 规格表
		$specifications = D("Specifications")->where(array("specifications_zy_sj"=>array("eq",2)))->select();
		$this->assign("page",$page->show());
		$this->assign('specifications',$specifications);
		$this->assign("shangjia_share",$shangjia_share);
		$this->display("wode_zuling");
	}
	/**
	 * @param 我的租赁编辑租赁
	 */
	// ------------------------------------------
	public function abcdefg(){
		$this->display("wode_zl_bj_2");
	}
	// ------------------------------------------
	public function wode_zl_bj() {
		if(empty(get_login_userid())){
			$this->redirect("Tourist/login");
			exit;
		}
		// dump($_SESSION['plgox_username']['plgox_id']);
		$members = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
		$redis = new \Redis();
		$redis->connect('127.0.0.1',6379);
		$cache = $redis->lrange(md5($members['plgox_user']),0,5);
		// dump($cache);
		if( empty(I('edit_id')) ){ // 添加
			//  分类
			$classify_value = D("Classify")->where(array("classify_pid"=>array("eq",0)))->select();
			// 产地
			$city = D("City")->where(array("city_pid"=>array("eq",1)))->select();
			// 日租金
			$zulin = D("Zulin")->select();
			$this->assign("zulin",$zulin);
			$this->assign("city",$city);
			$this->assign("classify_value",$classify_value);
			// 分类查询
			$class_ify = D("Classify as fl")->where(array("classify_id"=>array("eq",I('classify_id'))))->find();
			$this->assign("class_ify",$class_ify);
			// 分类id
			$this->assign("classify_id",I("classify_id"));
			// 规格套餐
			$specifications = D('Specifications as sp')->where(array("specifications_classify_id"=>array("eq",I('classify_id')),"specifications_zy_sj"=>array("eq",2),"specifications_business_id"=>array("eq",get_login_userid())))->select();
			// dump($specifications);
			// 用户标志 token
			$token = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
			$this->assign("token",md5($token['plgox_user']));
			// 上传页面 1 = 商户上传 2 = 认证上传
			$this->assign("status_keys",1);
			$this->assign("specifications",$specifications);
			$this->assign("setTitle","添加租赁");
			/*foreach ($cache as $key => $value) {
				$fg_cache_sz[] = explode(",",$value);
			}
			$this->assign("cache",$fg_cache_sz);*/
			$this->assign('edit_id',I('edit_id'));
		}else if( !empty(I('edit_id')) ){ // 修改
			// 商品数据查询
			$share = D("Share")->where(array("share_self_support"=>array("eq",2),"share_release_ascription"=>array("eq",2),"share_id"=>array("eq",I('edit_id'))))->find();
			$this->assign("share_img",explode(",",$share['share_many_img']));
			$this->assign("share_data",$share);
			// 分类
			$classify_value = D("Classify")->where(array("classify_pid"=>array("eq",0)))->select();

			$class_ify = D("Classify")->where(array("classify_id"=>array("eq",$share['share_classify_pid'])))->find();
			$this->assign("class_ify",$class_ify);
			// 产地
			$city = D("City")->where(array("city_pid"=>array("eq",1)))->select();
			// 日租金
			$zulin = D("Zulin")->select();
			$this->assign("zulin",$zulin);
			$this->assign("city",$city);
			$this->assign("classify_value",$classify_value);
			// 分类id
			$this->assign("classify_id",I("classify_id"));
			// 规格套餐
			$specifications = D('Specifications')->where(array("specifications_classify_id"=>array("eq",$share['share_classify_pid']),"specifications_zy_sj"=>array("eq",2),"specifications_business_id"=>array("eq",get_login_userid())))->select();
			$this->assign("specifications",$specifications);
			$this->assign("setTitle","编辑租赁");
			// redis读取图片缓存
			$this->assign('edit_id',I('edit_id'));
		}
		$this->display("wode_zl_bj");
	}
	// 用户redis缓存ajax执行
	public function ajax_redis_(){
		$redis = new \Redis();
		$redis->connect('127.0.0.1',6379);
		$members = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
		$cache = $redis->lrange(md5($members['plgox_user']),0,5);
		if( I("status_") == 1 ){ //执行查询并删除
			// $cache_del = explode(",",$cache);
			foreach ($cache as $key => $value) {
				$cache_del[] = explode(",", $value);
			}
			$del_code_img = $redis->del(md5($members['plgox_user'])); // 刷新后删除当前用户的redis缓存
			if( $del_code_img ){
				unlink("./Uploads/admin/{$cache_del['0']['1']}");
				unlink("./Uploads/admin/{$cache_del['1']['1']}");
				unlink("./Uploads/admin/{$cache_del['2']['1']}");
				unlink("./Uploads/admin/{$cache_del['3']['1']}");
				unlink("./Uploads/admin/{$cache_del['4']['1']}");
				unlink("./Uploads/admin/{$cache_del['5']['1']}");
				$this->ajaxReturn(array("status"=>-2000,"message"=>"刷新页面后,已清空图片缓存!"));
			}
		}else if( I("status_") == 2 ){
			foreach ($cache as $key => $value) {
				$cache_del[] = explode(",", $value);
			}
			if( !empty($cache_del) ){
				$this->ajaxReturn(array("status"=>2000,"message"=>$cache_del));
				return false;
			}
		}
	}
	// 商家数据
	public function AjaxHomeuserProduct() {
		// 图像压缩处理
		$image = new \Think\Image();
		// 图片上传
		$config = array(
			'maxSize'    =>    10485760,
			'rootPath'   =>    './Uploads/admin/',
			'saveName' =>    array('uniqid',''),
			'exts'         =>    array("bmp","jpg","jpeg","gif","png"),
		);
		$upload = new \Think\Upload($config);
		$info   =   $upload->upload();
		if( empty(I("share_id"))  ){ // 添加
			if( empty(I('share_many_img')) ){ // 如果未经过扫码上传
				// 进行图片上传
				if( !$info ){
					$this->ajaxReturn(array("status"=>-2001,"message"=>$upload->getError()));
					return false;
				}else{
					$data_img = array(
						$info['0']['savepath'].$info['0']['savename'],
						$info['1']['savepath'].$info['1']['savename'],
						$info['2']['savepath'].$info['2']['savename'],
						$info['3']['savepath'].$info['3']['savename'],
						$info['4']['savepath'].$info['4']['savename'],
						$info['5']['savepath'].$info['5']['savename'],
						// $info['6']['savepath'].$info['6']['savename'],
						// $info['7']['savepath'].$info['7']['savename']
					);
					foreach( $data_img as $key=>$val ){
						if( !empty($val) ){
							// 图片压缩
							$image->open('./Uploads/admin/'.$val);
							$image->thumb(600,600,\Think\Image::IMAGE_THUMB_FILLED)->save('./Uploads/admin/'.$val);
							$data_val[] = $val;
						}
					}
					if( $data_val == null ){
						$this->ajaxReturn(array("status"=>-2002,"message"=>"商品图片您必须上传一张!"));
						return false;
					}else{
						$share_many_imgs = implode(",",$data_val);
					}
					$data_img_ = array(
						'share_home_img' => $info['0']['savepath'].$info['0']['savename'], // 单图
						'share_many_img' => $share_many_imgs,// 多图
					);
					// 图片压缩
					$image->open('./Uploads/admin/'.$data_img_['share_home_img']);
					$image->thumb(180,180,\Think\Image::IMAGE_THUMB_FILLED)->save('./Uploads/admin/'.$data_img_['share_home_img']);
				}				
			}else if( !empty(I('share_many_img')) ){
				$data_img_ = array(
						'share_home_img' => explode(",", I('share_many_img'))['0'], // 单图
						'share_many_img' => I('share_many_img'),// 多图
					);
			}
			$data = array(
				'share_name' => I('share_name'), // 产品名称
				'share_key' => I("share_key"), // 产品key描述
				'share_classify_pid' => I('share_classify_pid'), // 产品分类
				'share_member_uid' => get_login_userid(), // 商家id
				'share_release_ascription' => 2, //商品发布归属；1=>后台发布；2=>前台发布
				'share_sheng' => I("share_sheng"), // 发货省 
				'share_shi' => I("share_shi"), // 发货市
				'share_product_type_id' => I('share_product_type_id'), // 产品规格
				'share_createtime' => time(), // 上架时间
				'share_descriptions' => base64_decode(I('share_descriptions')), // 共享商品描述
				'share_chandi' => I('share_chandi'), // 共享产地
				'share_self_support' => 2, // 共享自营 1=>自营;2=>商家
				'share_rent'=> I("share_rent"), // 展示型租金
				'share_sj_pq'=> I("share_sj_pq"), // 商家品牌
				'share_sj_xh'=> strtolower(I("share_sj_xh")), // 商家型号
				'share_type' => 1, // 类型
				// 'share_weizhi' // 定位ip
			);
			$data_count = array_merge($data,$data_img_);
			$share = D("share")->add($data_count);
			if( $share ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加商品成功!"));
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"添加商品失败!"));
			}
		}else if( !empty(I("share_id"))  ){ // 修改
			$share_img = D("Share")->where(array("share_id"=>array("eq",I('share_id'))))->find();
			if( empty($info) ){
				$data_img = array(
					"share_home_img" => $share_img['share_home_img'],
					"share_many_img" => $share_img['share_many_img'],
				);
			}else{
				$share_imgs = explode(",", $share_img['share_many_img']);
				$data_image = array(
					empty($info['0'])?$share_imgs['0']:$info['0']['savepath'].$info['0']['savename'],
					empty($info['1'])?$share_imgs['1']:$info['1']['savepath'].$info['1']['savename'],
					empty($info['2'])?$share_imgs['2']:$info['2']['savepath'].$info['2']['savename'],
					empty($info['3'])?$share_imgs['3']:$info['3']['savepath'].$info['3']['savename'],
					empty($info['4'])?$share_imgs['4']:$info['4']['savepath'].$info['4']['savename'],
					empty($info['5'])?$share_imgs['5']:$info['5']['savepath'].$info['5']['savename'],
					// empty($info['6'])?$share_imgs['6']:$info['6']['savepath'].$info['6']['savename'],
					// empty($info['7'])?$share_imgs['7']:$info['7']['savepath'].$info['7']['savename'],
				);
				/*$data_images = implode(",", $data_image);
				$data_images1 = explode(",", $data_images);*/
				foreach( $data_image as $key=>$value ){
					if( !empty( $value ) ){
						$data_imge[] = $value;
						$image->open("./Uploads/admin/".$value);
						$image->thumb(600,600,\Think\Image::IMAGE_THUMB_FILLED)->save("./Uploads/admin/".$value);
					}
				}
				$data_img = array(
					'share_home_img' => $data_imge['0'],
					'share_many_img' => implode(",", $data_imge),
				);
			}
			$data = array(
				'share_id' => I('share_id'),
				'share_name' => I('share_name'), // 产品名称
				'share_key' => I("share_key"), // 产品key描述
				'share_member_uid' => get_login_userid(), // 商家id
				'share_release_ascription' => 2, //商品发布归属；1=>后台发布；2=>前台发布
				'share_sheng' => I("share_sheng"), // 发货省 
				'share_shi' => I("share_shi"), // 发货市
				'share_product_type_id' => I('share_product_type_id'), // 产品规格
				'share_createtime' => time(), // 上架时间
				'share_descriptions' => base64_decode(I('share_descriptions')), // 共享商品描述
				'share_chandi' => I('share_chandi'), // 共享产地
				'share_self_support' => 2, // 共享自营 1=>自营;2=>商家
				'share_rent'=> I("share_rent"), // 展示型租金
				'share_sj_pq'=> I("share_sj_pq"), // 商家品牌
				'share_sj_xh'=> strtolower(I("share_sj_xh")), // 商家型号
				'share_type' => 1, // 类型
				// 'share_weizhi' // 定位ip
			);
			$data_edit = array_merge($data_img,$data);
			$share_save = D("share")->save($data_edit);
			if( $share_save ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改商品成功!"));
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"修改商品失败!"));
			}
		}
	}
	/**
	 * @param 套餐功能点
	 */
	public function fabutaocan() {
		$specifications = D("Specifications as sp")->where(array("specifications_zy_sj"=>array("eq",2),"specifications_business_id"=>array("eq",get_login_userid())))
		->join("left join plgox_zulin as zl on zl.zulin_id = sp.specifications_day_number_id")
		->join("left join plgox_classify as fl on fl.classify_id = sp.specifications_classify_id")
		->select();
		$this->assign("specifications",$specifications);
		$this->display();
	}
	// 编辑数据展示
	// 套餐管理
	public function taocan_guanli() {
		if(empty(get_login_userid())){
			$this->redirect("Tourist/login");
			exit;
		}
		if(empty(base64_decode(I("edit_id")))){ // 添加
			// 日租金
			$zulin = D("Zulin")->select();
			$this->assign("zulin",$zulin);
			$this->assign("setTitle","添加租赁套餐");
			// 分类
			$this->assign("classify",D('Classify')->classify_index());
			$this->display("taocan_guanli");
		}else if( !empty(base64_decode(I("edit_id")))){ // 修改
			$specifications_save = D("Specifications as sp")->where(array("specifications_id"=>array("eq",base64_decode(I("edit_id"))),"specifications_zy_sj"=>array("eq",2),"specifications_business_id"=>array("eq",get_login_userid())))
			->join("left join plgox_zulin as zl on zl.zulin_id = sp.specifications_day_number_id")
			->find();
			// 日租金
			// 分类
			$this->assign("classify",D('Classify')->classify_index($specifications_save['specifications_classify_id']));
			$zulin = D("Zulin")->select();
			$this->assign("setTitle","修改租赁套餐");
			$this->assign("specifications_save",$specifications_save);
			$this->assign("zulin",$zulin);
			$this->display("taocan_guanli");
		}
		
	}
	// 规格套餐数据
	public function specifications_add() {
		$image = new \Think\Image();
		// 图片上传
		$config = array(
			'maxSize'  =>  3145728,
			'rootPath' => "./Uploads/admin/",
			'saveName' => array('uniqid',''),
			'exts'     => array('jpg', 'gif', 'png', 'jpeg', 'bmp'),
		);
		$upload = new \Think\Upload($config);
		$info = $upload->upload();
		// 添加
		if( empty(I('specifications_id')) ){
			if( !$info ){
				$this->ajaxReturn(array("status"=>-2001,"message"=>$upload->getError()));
				return false;
			}else{
				$data_img = array(
					'specifications_img' => $info['0']['savepath'].$info['0']['savename'],
				);
				// 图片压缩
				$image->open("./Uploads/admin/".$data_img['specifications_img']);
				$image->thumb(800,800,\Think\Image::IMAGE_THUMB_FILLED)->save("./Uploads/admin/".$data_img['specifications_img']);
			}
			$data = array(
				'specifications_name' => I('specifications_name'),// 产品规格名称
				'specifications_keys' => I("specifications_keys"),// 套餐名称
				'specifications_classify_id'=> I("specifications_classify_id"),// 套餐分类
				'specifications_status' => 0,  // 规格状态 
				'specifications_give' => I('specifications_give'),// 优惠政策
				'specifications_createtime' => time(), // 产品规格创建时间
				'specifications_market' => I('specifications_market'), //市场价
				'specifications_deposit' => I('specifications_deposit'),// 押金
				'specifications_stock' => I('specifications_stock'), // 库存
				'specifications_rent' => I('specifications_rent'), // 租金
				'specifications_day_number_id' => I("specifications_day_number_id"), //租赁天数id
				'specifications_day_number' => I('specifications_day_number'), // 租满即送天数
				'specifications_day_type' => "天", // 标致
				'specifications_zy_sj' => 2, //1;自营规格/2;商家规格
				'specifications_business_id' => get_login_userid()
			);
			$data_add = array_merge($data_img,$data);
			$specifications = D("Specifications")->add($data_add);
			if( !empty($specifications) ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"添加成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"添加失败!"));
				return false;
			}
		// 修改
		}else if(  !empty(I('specifications_id'))  ){
			$specifications = D("specifications")->where(array("specifications_id"=>array("eq",I('specifications_id'))))->find();
			if( empty($info) ){
				$data_img = array(
					'specifications_img' => $specifications['specifications_img'],
				);
			}else{
				$data_img = array(
					'specifications_img' => empty($info['0'])?$specifications['specifications_img']:$info['0']['savepath'].$info['0']['savename'],
				);
				$image->open("./Uploads/admin/".$data_img['specifications_img']);
				$image->thumb(800,800,\Think\Image::IMAGE_THUMB_FILLED)->save("./Uploads/admin/".$data_img['specifications_img']);
			}
			$data = array(
				'specifications_id' => I('specifications_id'), // 规格id
				'specifications_keys' => I("specifications_keys"),// 套餐名称
				'specifications_classify_id'=> I("specifications_classify_id"),// 套餐分类
				'specifications_name' => I('specifications_name'),// 产品规格名称
				'specifications_status' => 0,  // 规格状态 
				'specifications_give' => I('specifications_give'),// 优惠政策
				'specifications_createtime' => time(), // 产品规格创建时间
				'specifications_market' => I('specifications_market'), //市场价
				'specifications_deposit' => I('specifications_deposit'),// 押金
				'specifications_stock' => I('specifications_stock'), // 库存
				'specifications_rent' => I('specifications_rent'), // 租金
				'specifications_day_number_id' => I("specifications_day_number_id"), //租赁天数id
				'specifications_day_number' => I('specifications_day_number'), // 租满即送天数
				'specifications_day_type' => "天", // 标致
				'specifications_zy_sj' => 2, //1;自营规格/2;商家规格
				'specifications_business_id' => get_login_userid()
			);
			$data_save = array_merge($data,$data_img);
			$specifications = D("Specifications")->save($data_save);
			if( !empty($specifications) ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"修改成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2000,"message"=>"修改失败!"));
				return false;
			}
		}
	}
	/**
	 * @param 上传图pain
	 */
	public function uplads_tp() {
		$shjg=I("data");
    header('Content-type:text/html;charset=utf-8');
    $base64_image_content =$shjg;
				//匹配出图片的格式
				if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
					$type = $result[2];
					$new_file = "./Uploads/admin/".date('Ymd',time())."/";
					if(!file_exists($new_file))
					{
					//检查是否有该文件夹，如果没有就创建，并给予最高权限
					   mkdir($new_file, 0700);
					}
					$new_file = $new_file.time().".{$type}";
					if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
					   $this->ajaxReturn( array("status"=>'上传成功', "message"=>$new_file),'json');
				    }else{
				       echo '新文件保存失败';
				    }
				  }
	}
	
	/**
	 * @param 发布租赁
	 */
	public function fabu_zuling2() {
		if(empty(get_login_userid())){
			$this->redirect("Tourist/login");
			exit;
		}
		//一级分类
		$this->assign("yijifenlei",D("Classify")->where(array("classify_pid"=>array("eq",0)))->select());
		$first_one=D("Classify")->where(array("classify_pid"=>array("eq",0)))->select()[0]['classify_id'];

		//二级分类
		$this->assign("erjifenlei",D("Classify")->where(array("classify_pid"=>$first_one))->select());
		$second_one=D("Classify")->where(array("classify_pid"=>$first_one))->select()[0]['classify_id'];
		
	    //三级分类
	    $this->assign("sanjifenlei",D("Classify")->where(array("classify_pid"=>$second_one))->select());
	    
	    
	    
		$this->display("fabu_zuling2");
	}

	/**
	 * @param 发布租赁
	 */
	public function fabu_zuling() {
		if(empty(get_login_userid())){
			$this->redirect("Tourist/login");
			exit;
		}
		//一级分类
		$this->assign("yijifenlei",D("Classify")->where(array("classify_pid"=>array("eq",0)))->select());
		$first_one=D("Classify")->where(array("classify_pid"=>array("eq",0)))->select()[0]['classify_id'];

		//二级分类
		$this->assign("erjifenlei",D("Classify")->where(array("classify_pid"=>$first_one))->select());
		$second_one=D("Classify")->where(array("classify_pid"=>$first_one))->select()[0]['classify_id'];
		
	    //三级分类
	    $this->assign("sanjifenlei",D("Classify")->where(array("classify_pid"=>$second_one))->select());
	    
	    
	    
		$this->display("fabu_zuling");
	}
	public function fu_zfl(){
		//type==0,初始页面加载。
     	$id = I("id");
     	$type = I("type");
     	
     	if($type==1){

     		$list_two = D('Classify')->where(array("classify_pid"=>$id))->select();
     		$second_one=D("Classify")->where(array("classify_pid"=>$id))->select()[0]['classify_id'];
     		$list_three=D("Classify")->where(array("classify_pid"=>$second_one))->select();
     		$choose['list_two'] = $list_two;
	     	$choose['list_three'] = $list_three;
	     	$this->ajaxReturn($choose);
	     	
     	}
     	else if($type==2){
     		$list_three = D('Classify')->where(array("classify_pid"=>$id))->select();
     		$choose['list_three'] = $list_three;
	     	$this->ajaxReturn($choose);
     	}
     	
	}
	// 处理分类
	public function ajaxClassify() {
		$where['classify_pid'] = I('classify_id');
		$classify = D("Classify")->where($where)->select();
		$this->ajaxReturn($classify);
	}
	/**
	 * @param 订单管路
	 */
	public function dingdan_guanli() {
		if(empty(get_login_userid())){
			$this->redirect("Tourist/login");
			exit;
		}
		$count = D("Order_detil")->where(array("order_type"=>array("eq",2),"order_shangjia_id"=>array("eq",get_login_userid())))->count();
		$page = new \Think\Page($count,10);
		$page->setConfig("header","<div class='page_style'>共<b>%TOTAL_PAGE%</b>页</div><div class='page_djy'>/第<b><input type='text' value=%NOW_PAGE% class='bdz'/></b>页</div><div class='qdtz'>确定</div>");
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        $page->setConfig("first","首页");
        $page->setConfig("last","尾页");
        $page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");

		$order_detil = D("Order_detil as orders")
		->where(array("order_type"=>array("eq",2),"order_shangjia_id"=>array("eq",get_login_userid())))
		->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id ")
		->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
		->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
		->join("left join plgox_address as address on address.address_id = orders.order_addressid")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		// dump($order_detil);
		$this->assign("page",$page->show());
		$this->assign("order_detil",$order_detil);
		// 全部订单
		$this->assign("qbdd",$count);
		// 待配送订单
		$dpsdd = D("Order_detil")->where(array("order_status"=>array("eq",0),"order_type"=>array("eq",2),"order_shangjia_id"=>array("eq",get_login_userid())))->count();
		$this->assign("dpsdd",$dpsdd);
		// 待确认送达订单
		$qrsddd = D("Order_detil")->where(array("order_status"=>array("eq",1),"order_type"=>array("eq",2),"order_shangjia_id"=>array("eq",get_login_userid())))->count();
		$this->assign("qrsddd",$qrsddd);
		// 等待支付押金的订单
		$zfyjdd = D("Order_detil")->where(array("order_status"=>array("eq",2),"order_type"=>array("eq",2),"order_shangjia_id"=>array("eq",get_login_userid())))->count();
		$this->assign("zfyjdd",$zfyjdd);
		$this->display("dingdan_guanli");
	}
	// 订单筛选
	public function search_shaixuan() {
		$count = D("Order_detil")->where(array("order_type"=>array("eq",2),"order_shangjia_id"=>array("eq",get_login_userid())))->count();
		// 全部订单
		$this->assign("qbdd",$count);
		// 待配送订单
		$dpsdd = D("Order_detil")->where(array("order_status"=>array("eq",0),"order_type"=>array("eq",2),"order_shangjia_id"=>array("eq",get_login_userid())))->count();
		$this->assign("dpsdd",$dpsdd);
		// 待确认送达订单
		$qrsddd = D("Order_detil")->where(array("order_status"=>array("eq",1),"order_type"=>array("eq",2),"order_shangjia_id"=>array("eq",get_login_userid())))->count();
		$this->assign("qrsddd",$qrsddd);
		// 等待支付押金的订单
		$zfyjdd = D("Order_detil")->where(array("order_status"=>array("eq",2),"order_type"=>array("eq",2),"order_shangjia_id"=>array("eq",get_login_userid())))->count();
		$this->assign("zfyjdd",$zfyjdd);
		// 执行现实判断
		if( I("dingdan_dataid") == 1 ){
			// 全部订单数据
			$page = new \Think\Page($count,10);
			$where = array("order_type"=>array("eq",2),"order_shangjia_id"=>array("eq",get_login_userid()));
		}else if( I("dingdan_dataid") == 2 ){
			// 待配送数据
			$page = new \Think\Page($dpsdd,10);
			$where = array("order_status"=>array("eq",0),"order_type"=>array("eq",2),"order_shangjia_id"=>array("eq",get_login_userid()));
		}else if( I("dingdan_dataid") == 3 ){
			// 待确认送达数据
			$page = new \Think\Page($qrsddd,10);
			$where = array("order_status"=>array("eq",1),"order_type"=>array("eq",2),"order_shangjia_id"=>array("eq",get_login_userid()));
		}else if( I("dingdan_dataid") == 4 ){
			// 待支付的数据
			$page = new \Think\Page($zfyjdd,10);
			$where = array("order_status"=>array("eq",2),"order_type"=>array("eq",2),"order_shangjia_id"=>array("eq",get_login_userid()));
		}
		// 分页
		$page->setConfig("header","<div class='page_style'>共<b>%TOTAL_PAGE%</b>页</div><div class='page_djy'>/第<b><input type='text' value=%NOW_PAGE% class='bdz'/></b>页</div><div class='qdtz'>确定</div>");
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        $page->setConfig("first","首页");
        $page->setConfig("last","尾页");
        $page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");

        $order_detil = D("Order_detil as orders")
		->where($where)
		->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id ")
		->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
		->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
		->join("left join plgox_address as address on address.address_id = orders.order_addressid")
		->limit($page->firstRow.','.$page->listRows)
		->select();
		$this->assign("page",$page->show());
		$this->assign("pdgj",I("dingdan_dataid"));
		$this->assign("order_detil",$order_detil);
		$this->display("dingdan_guanli");
	}
	/**
	 * @param 在组订单
	 */
	public function zaizu_dingdan() {
		$this->display("zaizu_dingdan");
	}
	/**
	 * @param 我的账户
	 */
	public function wode_zhanghu() {
		$this->display("wode_zhanghu");
	}
	/**
	 * @param 提现记录
	 */
	public function tixian_jilu() {
		if(empty(get_login_userid())){
			$this->redirect("Tourist/login");
			exit;
		}
		$count = D("Withdrawals")->where(array("withdrawals_memberid"=>array("eq",get_login_userid())))->count();
		$page = new \Think\Page($count,10);
		$page->setConfig("header","<div class='page_style'>共<b>%TOTAL_PAGE%</b>页</div><div class='page_djy'>/第<b><input type='text' value=%NOW_PAGE% class='bdz'/></b>页</div><div class='qdtz'>确定</div>");
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        $page->setConfig("first","首页");
        $page->setConfig("last","尾页");
        $page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
		// 提现记录
		$withdrawals = D("Withdrawals")->where(array("withdrawals_memberid"=>array("eq",get_login_userid())))
		->limit($page->firstRow.','.$page->listRows)
		->select();
		$this->assign("page",$page->show());
		$this->assign("withdrawals",$withdrawals);
		$this->display("tixian_jilu");
	}
	/**
	 * @param 发起提现
	 */
	public function fq_tx() {
		$this->display("fq_tx");
	}
	/**
	 * @param 账户明细
	 */
	public function zhanghu_mingxi() {
		$this->display("zhanghu_mingxi");
	}
	/**
	 * @param 生成子账户
	 */
	public function shengcheng_zizhanghu() {
		if(empty(get_login_userid())){
			$this->redirect("Tourist/login");
			exit;
		}
		$this->assign("sczhsy",D("level_member")->where(array("level_memberid"=>array("eq",get_login_userid())))->select());
		
		$this->display("shengcheng_zizhanghu");
	}
	
	public function shengcheng_zizhanghu_add() {
		$data = array(
			'level_member_name' => I('level_member_name'),
			'level_member_sonphone' => I('level_member_sonphone'),
			'level_member_pass' => md5(I('level_member_pass')),
			'level_memberid' => get_login_userid(),
			'level_createtime' => time()
		);
		$data_add = D("level_member")->add($data);
		if($data_add){
			$this->ajaxReturn(array("status"=>2000));
		}else{
			$this->ajaxReturn(array("status"=>-2000,"message"=>"添加子账号失败!"));
		}
	}
	
	public function shengcheng_zizhanghu_delete(){
		$data_add = D("level_member")->delete(I('level_member_id'));
		if($data_add){
			$this->ajaxReturn(array("status"=>2000));
		}else{
			$this->ajaxReturn(array("status"=>-2000,"message"=>"添加子账号失败!"));
		}
	}
	
	/**
	 * @param 订单详情
	 */
	public function dingdan_xiangqing() {
		if(empty(get_login_userid())){
			$this->redirect("Tourist/login");
			exit;
		}
		$order_detil = D("Order_detil as orders")
		->where(array("order_id"=>array("eq",I("order_id")),"order_type"=>array("eq",2),"order_shangjia_id"=>array("eq",get_login_userid())))
		->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id ")
		->join("left join plgox_share as share on share.share_id = cart.cart_share_id")
		->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
		->join("left join plgox_address as address on address.address_id = orders.order_addressid")
		->join("left join plgox_zulin as zulin on zulin.zulin_id = sp.specifications_day_number_id")
		->find();
		$this->assign('order_detil',$order_detil);
		$this->display("dingdan_xiangqing");
	}
	/**
	 * @param 账户明细查看详情
	 */
	public function zhmx_ckxq() {
		$this->display("zhmx_ckxq");
	}
	/**
	 * @param 咨询中心
	 */
	public function zixun_zhongxin() {
		$this->display("zixun_zhongxin");
	}
	/**
	 * @param 账户管理
	 */
	public function zhanghu_guanli() {
		if(empty(get_login_userid())){
			$this->redirect("Tourist/login");
			exit;
		}
		$member = D("Member")->where(array("plgox_id"=>get_login_userid()))->find();
		// 修改资金
		$edit_zijin = D("Zjinpass")->where(array("zjinpass_uid"=>array("eq",get_login_userid())))->find();
		// 账户管理
		$zhanghu_admin = D("Zhanghu_add")->where(array("zhanghu_add_uid"=>array("eq",get_login_userid()),"zhanghu_add_type"=>array("eq",1)))->find();
		$zhifubao = D("Zhanghu_add")->where(array("zhanghu_add_uid"=>array("eq",get_login_userid()),"zhanghu_add_type"=>array("eq",2)))->find();
		$this->assign("zhifubao",$zhifubao);
		$this->assign("zhanghu_admin",$zhanghu_admin);
		$this->assign("edit_zijin",$edit_zijin);
		$this->assign("member",$member);
		$this->display("zhanghu_guanli");
	}
	// 发送手机号
	public function sendsMs(){
		if( I("message") == 1 ){
			$user_info = D("Member")->where( array("plgox_id"=>array("eq",get_login_userid()),"plgox_tel"=>array("eq",I("user_phone"))) )->find();
			$msm_content = "(资金密码设置验证码)，请在2分钟内完成验证，并且不要把验证码转交他人!";
			$user_senSMS = message_sendSMS( $user_info['plgox_tel'] , $msm_content , false );
			$this->ajaxReturn(array("status"=>2000,"message"=>$user_senSMS['message']));
		}else if( I("message") == 2 ){
			$user_info = D("Member")->where( array("plgox_id"=>array("eq",get_login_userid()),"plgox_tel"=>array("eq",I("user_phone"))) )->find();
			$msm_content = "(银行卡绑定验证码)，请在2分钟内完成验证，并且不要把验证码转交他人!";
			$user_senSMS = message_sendSMS( $user_info['plgox_tel'] , $msm_content , false );
			$this->ajaxReturn(array("status"=>2000,"message"=>$user_senSMS['message']));
		}else if(  I("message") == 3 ){
			$user_info = D("Member")->where( array("plgox_id"=>array("eq",get_login_userid()),"plgox_tel"=>array("eq",I("user_phone"))) )->find();
			$msm_content = "(支付宝绑定验证码)，请在2分钟内完成验证，并且不要把验证码转交他人!";
			$user_senSMS = message_sendSMS( $user_info['plgox_tel'] , $msm_content , false );
			$this->ajaxReturn(array("status"=>2000,"message"=>$user_senSMS['message']));
		}
	}
	// 账户绑定
	public  function AjaxZH_admin() {
		// $this->ajaxReturn(I("post."));
		// return false;
		if( I('data_val') == 1 ){
			if( I("zijin_id") != 1 ){
				$data = array(
					'zjinpass_uid' => get_login_userid(),
					'zjinpass_password' => md5(I('password')),
					'zijinpass_tel' => I("zijinpass_tel"),
					'zjinpass_createtime' => time()
				);
			}else{
				$data = array(
					'zjinpass_id' => I("zijin_id"),
					'zjinpass_password' => md5(I('password')),
					'zijinpass_tel' => I("zijinpass_tel"),
					'zjinpass_updatetime' => time()
				);
			}
			$code_status = mobiles_code_check( I('sendsMs_code') , I("zijinpass_tel") );
			// 成功
			if( $code_status['status'] == 1 ){
				if( I("zijin_id") != 1 ){
					$uid_check = D("Zjinpass")->where(array("zjinpass_uid"=>array("eq",get_login_userid())))->find();
					if( empty($uid_check) ){
						$zujin = D("Zjinpass")->add($data);
					}else{
						$this->ajaxReturn(array("status"=>-2004,"message"=>"当前资金用户已经存在，不可以重复的添加!"));
					}
				}else{
					$zujin = D("Zjinpass")->save($data);
				}
				if( $zujin ){
					session('code',null);
					session('phone',null);
					session('code_createtime',null);
					$this->ajaxReturn(array("status"=>2000,"message"=>$code_status['message']));
				}else{
					$this->ajaxReturn(array("status"=>-2001,"message"=>"验证失败"));
				}
			// 手机号不一致
			}else if( $code_status['status'] == 2 ) {
				$this->ajaxReturn(array("status"=>-2002,"message"=>$code_status['message']));
			// 手机验证码错误
			}else if( $code_status['status'] == 3 ) {
				$this->ajaxReturn(array("status"=>-2003,"message"=>$code_status['message']));
			}	
		}else if( I('data_val') == 2 ){
			$data = array(
				'zhanghu_add_acconut' => I('zhanghu'),
				'zhanghu_add_name' => I('username'),
				'zhanghu_add_khh' => I('zhanghu_add_khh'),
				'zhanghu_add_tel' => I('user_phone_1'),
				'zhanghu_add_type' => 1,
				'zhanghu_add_time' => time(),
				'zhanghu_add_uid' => get_login_userid()
			);
			$code_status = mobiles_code_check( I('yyzz_code') , I('user_phone_1') );
			if( $code_status['status'] == 1 ){
				$Zhanghu_add = D("Zhanghu_add")->add($data);
				if($Zhanghu_add){
					session('code',null);
					session('phone',null);
					session('code_createtime',null);
					$this->ajaxReturn(array("status"=>2000,"message"=>$code_status['message']));
				}else{
					$this->ajaxReturn(array("status"=>-2001,"message"=>"验证失败"));
				}
			}else if( $code_status['status'] == 2 ){
				$this->ajaxReturn(array("status"=>-2002,"message"=>$code_status['message']));
			}else if( $code_status['status'] == 3 ){
				$this->ajaxReturn(array("status"=>-2003,"message"=>$code_status['message']));
			}
		}else if( I('data_val') == 3 ){
			$data = array(
				'zhanghu_add_acconut' => I('zfb_sk'),
				'zhanghu_add_name' => I('zfb_name'),
				'zhanghu_add_tel' => I('user_phone3'),
				'zhanghu_add_type' => 2,
				'zhanghu_add_time' => time(),
				'zhanghu_add_uid' => get_login_userid()
			);
			$code_status = mobiles_code_check( I('zfb_ceode') , I('user_phone3') );
			if( $code_status['status'] == 1 ){
				$Zhanghu_add = D("Zhanghu_add")->add($data);
				if($Zhanghu_add){
					session('code',null);
					session('phone',null);
					session('code_createtime',null);
					$this->ajaxReturn(array("status"=>2000,"message"=>$code_status['message']));
				}else{
					$this->ajaxReturn(array("status"=>-2001,"message"=>"验证失败"));
				}
			}else if( $code_status['status'] == 2 ){
				$this->ajaxReturn(array("status"=>-2002,"message"=>$code_status['message']));
			}else if( $code_status['status'] == 3 ){
				$this->ajaxReturn(array("status"=>-2003,"message"=>$code_status['message']));
			}
		}
	}



//店铺管理
	public function shop_guanli() {
		
		$this->display("shop_guanli");
	}
	// 删除
	public function AjaxDel() {
		if( I("zhuanghu_id") ){
			$zhanghu = D("Zhanghu_add")->delete(I("zhuanghu_id"));
			if( $zhanghu ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2001,"message"=>"删除失败!"));
				return false;
			}
		}else if( I('zhifubao') ){
			$zhanghu = D("Zhanghu_add")->delete(I("zhifubao"));
			if( $zhanghu ){
				$this->ajaxReturn(array("status"=>2000,"message"=>"删除成功!"));
				return false;
			}else{
				$this->ajaxReturn(array("status"=>-2001,"message"=>"删除失败!"));
				return false;
			}
		}
	}
}
?>