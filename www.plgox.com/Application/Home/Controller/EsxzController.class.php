<?php
namespace Home\Controller;
use Think\Controller;
use Home;
class EsxzController extends CommonController {
	
	//二手闲置转让
    public function index(){
    	// dump($_SESSION);	
        
        //print_r($goods);
        //echo D('Goods')->getLastSql();
	    //exit;
	    
        
        

       /*  $count = D("Goods")->where(array('goods_is_check'=>2))->count();
        $page = new \Think\Page($count,5);
        $page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        $page->setConfig("first","首页");
        $page->setConfig("last","末页");
        $page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
        
        $goods = D('Goods')->where(array('goods_is_check'=>2))->limit($page->firstRow.','.$page->listRows)->order('goods_publish_time desc')->select();
        foreach ($goods as $k=>$v){
        	$province_name = D('city')->where(array('city_id'=>$v['goods_province']))->find();
        	$goods[$k]['goods_province'] = $province_name['city_name'];
        	$city_name = D('city')->where(array('city_id'=>$v['goods_city']))->find();
        	$goods[$k]['goods_city'] = $city_name['city_name'];
        }
        $this->assign("goods",$goods);
        $this->assign("page",$page->show()); */
    	//浏览最多
    	$where1['goods_is_check'] = 1;
    	$where1['goods_is_watch_max'] = array("neq",0);
    	$order1['goods_is_watch_max'] = 'desc';
    	$watch_max_list= D('goods')->where($where1)->order($order1)->select();
    	//echo D('goods')->getLastSql();
    	//exit;
    	$this->assign("watch_max_list",$watch_max_list);
    	//查询类别
    	$type_list = D('juezhi_brand')->where(array("juezhi_brand_aid"=>0))->select();
    	//print_r($type_list);
    	//exit;
    	$this->assign("type",$type_list);
    	//查询省份
    	$province = $_SESSION['province'];
    	if(empty($province)){
    		$province = 10001;
    	}
    	$address_list = D('city')->where(array("city_pid"=>$province))->select();
    	$address_count = count($address_list);
    	if($address_count==1){
    		$address1_list = D('city')->where(array("city_pid"=>$address_list[0]['city_id']))->select();
    		$this->assign("address_list",$address1_list);
    	}else{
    		$this->assign("address_list",$address_list);
    	}
        $this->display();
    }
    
     //二手查询iframe
    public function iframe(){
    	//根据类型搜索商品
    	$R = D("Goods");
    	$where = array();
    	$order = array();
    	$where['status'] =1;   //上架的商品
    	$num= I('num',5);//每页显示行数
    	//echo I("price");
    	//exit;
    	if(I("price")){
    		//GT大于，EGT大于等于，LT小于，ELT小于等于
    		if(I("price") == 0){
    			$where['goods_deal_price'] = array('neq',0);
    		}else if(I("price")==1){
    			$where['goods_deal_price'] = array('lt',100);
    		}else if(I('price')==2){
    			$where['goods_deal_price'] = array(array('egt',100),array('lt',500));
    		}else if(I('price')==3){
    			$where['goods_deal_price'] = array(array('GT',500),array('LT',3000));
    		}else if(I('price')==4){
    			$where['goods_deal_price'] = array(array('EGT',3000),array('LT',5000));
    		}else if(I('price')==5){
    			$where['goods_deal_price'] = array(array('EGT',5000),array('LT',10000));
    		}else{
    			$where['goods_deal_price'] = array('EGT',10000);
    		}
    	} 
    	if(I("area")){
    		if(I("area")==0){
    			$where['goods_city'] = array('neq',0);
    		}else{
    			$where['goods_city'] = I("area");
    		}
    	}
    	if(I("selltype")){
    		$where['goods_sell_type'] = I("selltype");
    	}else{
    		$where['goods_sell_type'] = 1;
    	}
    	if(I("search_name")){
    		$where['goods_name']=array('like',"%".I('search_name')."%");
    	}
    	if(I("typea")){
    		$where['goods_typea'] = I("typea");
    	}
    	if(I("typeb")){
    		$where['goods_typeb'] = I("typeb");
    	}
    	if(I("typec")){
    		$where['goods_typec'] = I("typec");
    	}

    	if(I("price_order")){
    		if(I("price_order")==1){
    			$order =array();
    			$order['goods_deal_price'] = 'asc';
    		}else{
    			$order =array();
    			$order['goods_deal_price'] = 'desc';
    		}
    	}
    	$where['goods_is_check'] = 1;
    	//$where['goods_deal_price'] = array(array('lt',100),array('lt',500));
    	$count = $R->where($where)->count();//一共有多少条记录
    	//$page = new \Think\Page($count,5);
    	//$page->setConfig('header','条记录');
    	
    	$page = new \Think\Page($count,5);
    	$page->setConfig("header",'<div class="page_style">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
    	$page->setConfig("prev","上一页");
    	$page->setConfig("next","下一页");
    	$page->setConfig("first","首页");
    	$page->setConfig("last","末页");
    	$page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
    	//print_r($where);exit;
    	$show = $page->show();
    	//加载数据
    	$order['goods_publish_time'] = 'desc';
    	$goods = $R->where($where)->order($order)->limit($page->firstRow.','.$page->listRows)->select();
    	//echo $R->getLastSql();
    	//exit;
    	foreach ($goods as $k=>$v){
        	$province_name = D('city')->where(array('city_id'=>$v['goods_province']))->find();
        	$goods[$k]['goods_province'] = $province_name['city_name'];
        	$city_name = D('city')->where(array('city_id'=>$v['goods_city']))->find();
        	$goods[$k]['goods_city'] = $city_name['city_name'];
        }
        //echo $R->getLastSql();
        //exit;
        
        //print_r($page->show());
        //exit;
        
    	$this->assign("goods",$goods);
    	$this->assign("show",$page->show());
    	$this->display();
    }
    
     //二手求购详情
     public function esxz_detil_qg(){
    	// dump($_SESSION);
        $this->display('esxz_detil_qg');
    }
     //二手闲置详情餐厅转让
      public function esxz_detil_zr(){
    	// dump($_SESSION);
        $this->display('esxz_detil_zr');
    }
    //二手闲置商品详情
     public function esxz_detil(){     
    	$id = I('id');
    	//浏览次数加1 begin
    	D('Goods')->where('goods_id='.$id)->setInc('goods_is_watched'); 
        //echo D('Goods')->getLastSql();
    	//浏览次数加1 end
    	
    	//获取商品详细信息 begin
    	$goods_detail = D('Goods')->where(array('goods_id'=>$id))->find();
    	//获取商品详细信息 end
    	
    	//转换性别 begin
    	if($goods_detail['goods_link_sex']==1){
    		$goods_detail['goods_link_sex']="先生";
    	}else if($goods_detail['goods_link_sex']==2){
    		$goods_detail['goods_link_sex']="女士";
    	}else{
    		$goods_detail['goods_link_sex']="小姐";
    	}
    	//转换性别end
    	
    	//用户足迹加1条记录 begin
    	/* if(!empty($_SESSION['plgox_username']['plgox_id'])){
    		$result = D('footprint')->where('footprint_goods_id='.$id)->find();
    		if(empty($result)){
    			$data['footprint_user_id'] = $_SESSION['plgox_username']['plgox_id'];
    			$data['footprint_goods_id'] = $id;
    			$data['footprint_ptime'] = date("Y-m-d");
    			$data['footprint_type'] = 2;
    			$data['footprint_price'] = $goods_detail['goods_deal_price'];
    			$data['footprint_picture_url'] = $goods_detail['goods_first_pic'];
    			$User = M('footprint');
    			$User->data($data)->add();
    		}
    	} */
    	//echo D('Goods')->getLastSql();
    	//用户足迹加1 end
    	
    	//图片转换为数组
    	
    	//转换省市 begin
    	$province_name = D('city')->where(array('city_id'=>$goods_detail['goods_province']))->find();
    	$goods_detail['goods_province'] = $province_name['city_name'];
    	$city_name = D('city')->where(array('city_id'=>$goods_detail['goods_city']))->find();
    	$goods_detail['goods_city'] = $city_name['city_name'];
    	//转换省市 end
    	
    	//获取发布商品用户信息 begin
    	$user_info = D('member')->where(array('plgox_id'=>$goods_detail['goods_push_user_id']))->find();
    	//获取发布商品用户信息 end
    	
    	//判断是否收藏，如果收藏，要笔芯，begin
    	$where_collect['collect_goods_id'] = $id;
    	$where_collect['collect_user_id'] = $_SESSION['plgox_username']['plgox_id'];
    	$res_collect = D('collect')->where($where_collect)->find();
    	if(empty($res_collect)){//未收藏
    		$goods_detail['is_collect']=0;
    	}else{
    		$goods_detail['is_collect']=1;
    	}
    	//判断是否收藏，如果收藏，要笔芯，end
    	
    	//把图片组成数据,begin.
    	$img_url = $goods_detail['goods_pic'];
    	$img_url_arr= explode(",", $img_url);
    	//把图片组成数据,end.
    	//print_r($img_url_arr);
    	if(empty($_SESSION['plgox_username']['plgox_id'])){
    		$is_login=0;//未登录
    	}else{
    		$is_login=1;//登录
    	}
        // 检测我有意向是否发布
        $where['wyyx_id'] = $_SESSION['wyyx_id'];
        $wyyx_id = D("juezhi_wyyx")->where($where)->find();
        $this->assign("wyyx_id",$wyyx_id);
        $this->assign("juezi_detil_id",$id);
    	$this->assign("is_login",$is_login);
    	$this->assign("img_url",$img_url_arr);
        $this->assign("goods_detail",$goods_detail);
        $this->assign("user_info",$user_info);
        //判断商品goods_sell_type,
        //echo $goods_detail['goods_sell_type'];
        if($goods_detail['goods_sell_type']<3){//餐厅转卖，酒店转换
        	$this->display('esxz_detil');
        }else if($goods_detail['goods_sell_type']==3){//求购
        	$this->display('esxz_detil_qg');
        }else{//转让
        	$this->display('esxz_detil_zr');
        }
    }
    // 检测是否登录
    public function AjaxLogin() {
        if( empty(get_login_userid()) ){
            $this->ajaxReturn(array("status"=>-2001,"message"=>"请先登录后在进行发布!"));
        }else{
            $this->ajaxReturn(get_login_userid());
        }
    }
    // 检测时间
    public function AjaxTime() {
        $wyyx_time = D("juezhi_wyyx")->find($_SESSION['wyyx_id']);
        if( $wyyx_time['wyyx_createtime'] > time() ){
            $this->ajaxReturn(array("status"=>-2001,"message"=>"您刚刚发送完了信息,请3个小时以后在重新发布!"));
        }else if( empty($wyyx_time['wyyx_id']) ){
            $this->ajaxReturn(array("status"=>2000));
        }else if( $wyyx_time['wyyx_createtime'] < time() ){
            $this->ajaxReturn(array("status"=>2002));
        }
    }
    // 我有意向
    public function AjaxWyyx() {
        // 添加我有意向值
        $data = array(
            'wyyx_prices' =>I("baojia"),
            'wyyx_tel'  =>I("jz_tel"),
            'wyyx_wxh'  =>I("wxhm"),
            'wyyx_qq'   =>I("qqhm"),
            'wyyx_address'  => I("address"),
            'wyyx_status'   => 1,
            'wyyx_createtime' => strtotime(date('Y-m-d H:i:s',strtotime("+3 minute"))),
            // date('Y-m-d H:i:s',strtotime("+1 day +3 hour +1 minute");
            'wyyx_uid' => get_login_userid()
        );
            $select_look_data = D("juezhi_wyyx")->add($data);
            session('wyyx_id',$select_look_data);
            if( $select_look_data ){
                $content = "尊敬的用户，您好，您发布的二手详情有新的报价消息，请及时的查看，如不是本人，请直接忽略!";
                // 发布短信
                $where['goods_id'] = I("juezi_detil_id");
                $juezhi_data = D("Goods")->where($where)->find();
                $user_info = D("Member")->where(array("plgox_id"=>array('eq',$juezhi_data['goods_push_user_id'])))->find();
                sendsms_template($user_info['plgox_tel'] , $content );
               $this->ajaxReturn(array("status"=>2000,"message"=>"提交成功!"));
            }else{
               $this->ajaxReturn(array("status"=>-2001,"message"=>"提交失败!"));
            }            
    }
    //二手闲置举报
     public function esxz_jubao(){
    	// dump($_SESSION);
    	//dump(I('id'));
    	$this->assign("goods_id",I('id'));
        $this->display('esxz_jubao');
    }
    public function esxz_push_jubao(){
    	$data['tousu_yuanyin'] = I('yuanyin');
    	$data['tousu_shuoming'] = I('shuoming');
    	$data['tousu_type'] = 1;
    	$data['tousu_goods_id'] = I('goods_id');
    	$data['tousu_createtime'] = date('Y-m-d H:i:s');
    	$config = array(
    			'maxSize'    =>    10485760,
    			'rootPath'   =>    './Uploads/admin/',
    			'saveName' =>    array('uniqid',''),
    			'exts'         =>    array("bmp","jpg","jpeg","gif","png"),
    	);
    	$upload = new \Think\Upload($config);
    	$info   =   $upload->upload();
    	//$this->ajaxReturn($info);
    	if(empty($info)){
    		$this->ajaxReturn(array("status"=>-2002,"message"=>$upload->getError() ));
    		return false;
    	}
    	
    	$img_douhao = array();
    	foreach ($info as $k=>$v){
    		$img_douhao[] = $v['name'];
    	}
    	
    	$data['tousu_home_img'] = implode(",",$img_douhao);
    	
    	
    	D("tousu")->add($data);
    	//举报成功时，用户被举报次数加1,begin
    	D("member")->where('plgox_id='.$_SESSION['plgox_username']['plgox_id'])->setInc('plgox_reported_num');
    	//举报成功时，用户被举报次数加1,end
    	echo D("tousu")->getLastSql();
    	exit;
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
     //二手闲置发布信息,酒店二手，餐厅二手
     public function esxz_fbmessage(){
        // dump(I('share_id3'));
        if( I('edit_id') ){ // 修改页面的数据读取
            $goods_ = D("goods")->where(array("goods_id"=>array("eq",I('edit_id'))))->find();
            $this->assign("goods_",$goods_);
            $this->assign("goods_pic",explode(",", $goods_['goods_pic']));
        }
        $is_renzheng = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
        // redis读取缓存
        $redis = new \Redis();
        $redis->connect('127.0.0.1',6379);
        $keys = md5($is_renzheng['plgox_user']).','.'3';
        $redis_val = $redis->lrange($keys,0,6);
    	// dump($_SESSION);
    	$where["city_pid"]=1;
    	$province = D("city")->where($where)->select();
    	$where1["city_pid"] = $province[0]['city_id'];
    	$city = D("city")->where($where1)->select();
    	//return $this->ajaxReturn($province);
    	$this->assign("city",$city);
    	//return $this->ajaxReturn($city);
        if( $is_renzheng['plgox_is_renzheng'] == '0' ){
            $is_sjrz = 1;
        }else if( $is_renzheng['plgox_is_renzheng'] == '1' ){
            $is_sjrz = 2;
        }
        // 
        $this->assign("sjrz_renzheng",$is_renzheng);
        $this->assign("is_sjrz",$is_sjrz);
        $this->assign("token",md5($is_renzheng['plgox_user']));//token
    	$this->assign("province",$province);
    	$this->assign("share_id1",I("share_id1"));//一级列表
    	$this->assign("share_id2",I("share_id2"));//二级列表
    	$this->assign("share_id3",I("share_id3"));//三级列表
        $class_ify = D("juezhi_brand")->where(array("juezhi_brand_id"=>array("eq",I("share_id3"))))->find();
            //$this->assign("class_ify",$class_ify);
        //dump($class_ify['juezhi_brand_name']);
        // $this->assign("class_ify",$class_ify['juezhi_brand_name']);
        $this->assign("class_ify",$class_ify);
    	$this->assign("flz",I("flz"));//三级列表
        $this->display('esxz_fbmessage');
    }
    // ajax无法刷新获取图片
    public function ajaxUploadFiles(){
        $member = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
        $redis = new \Redis();
        $redis->connect("127.0.0.1",6379);
        if( I('status_') == 1 ){
            $keys = md5($member['plgox_user']).","."3";
            $datas = $redis->lrange($keys,0,6);
            foreach ($datas as $key => $value) {
                $datas_val[] = explode(",", $value);
            }
            if( !empty($datas_val) ){
                $this->ajaxReturn(array("status"=>2000,"message"=>$datas_val));
                return false;
            }
        }else if( I("status_") == 2 ){ //执行刷新清空当前用户redis
            $keys = md5($member['plgox_user']).","."3";
            $datas = $redis->lrange($keys,0,6);
            for ($i=0; $i < 6 ; $i++) { 
                unlink("./Uploads/admin/".explode(",",$datas[$i])['1']);
            }
            $del = $redis->del($keys);
            if( $del ){
                $this->ajaxReturn(array("status"=>2000,"message"=>"当前页面已被刷新，缓存已被清除!"));
                return false;
            }
        }
    }
    public function esxz_choose_city(){
    	$province_id = I('id');
    	if($province_id>10000){
    		$where1["city_pid"] = $province_id;
    		$province_nextid = D("city")->where($where1)->find();
    		$province_id= $province_nextid['city_id'];
    	}
    	$where["city_pid"]=$province_id;
    	$city_list = D("city")->where($where)->select();
    	$this->ajaxReturn($city_list);
    }
     
      //发布求购信息
     public function esxz_fbmessage_qg(){
    	// dump($_SESSION);
     	$where["city_pid"]=1;
     	$province = D("city")->where($where)->select();
     	$where1["city_pid"] = $province[0]['city_id'];
     	$city = D("city")->where($where1)->select();
     	$this->assign("city",$city);
     	 
          $is_renzheng = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
        if( $is_renzheng['plgox_is_renzheng'] == '0' ){
            $is_sjrz = 1;
        }else if( $is_renzheng['plgox_is_renzheng'] == '1' ){
            $is_sjrz = 2;
        }

         $this->assign("sjrz_renzheng",$is_renzheng);
        $this->assign("is_sjrz",$is_sjrz);


     	$this->assign("province",$province);
     	$this->assign("share_id1",I("share_id1"));//一级列表
     	$this->assign("share_id2",I("share_id2"));//二级列表
     	$this->assign("share_id3",I("share_id3"));//三级列表
     	$this->assign("flz",I("flz"));//三级列表
        $this->display('esxz_fbmessage_qg');
    }
      //发布转让信息
     public function esxz_fbmessage_zr(){
        if( empty(I("edit_id")) ){ // 添加
            //  认证
            $is_renzheng = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
            if( $is_renzheng['plgox_is_renzheng'] == '0' ){
                $is_sjrz = 1;
            }else if( $is_renzheng['plgox_is_renzheng'] == '1' ){
                $is_sjrz = 2;
            }
            $where["city_pid"]=1;
            $province = D("city")->where($where)->select();
            $where1["city_pid"] = $province[0]['city_id'];
            $city = D("city")->where($where1)->select();
            $this->assign("city",$city);
            $this->assign("province",$province);
            $this->assign("share_id1",I("share_id1"));//一级列表
            $this->assign("share_id2",I("share_id2"));//二级列表
            $this->assign("share_id3",I("share_id3"));//三级列表
            $this->assign("flz",I("flz"));//三级列表
            $this->assign("sjrz_renzheng",$is_renzheng);
            $this->assign("is_sjrz",$is_sjrz);
        }else if( !empty(I("edit_id")) ){ // 修改
            //  认证
            $is_renzheng = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
            if( $is_renzheng['plgox_is_renzheng'] == '0' ){
                $is_sjrz = 1;
            }else if( $is_renzheng['plgox_is_renzheng'] == '1' ){
                $is_sjrz = 2;
            }
            $this->assign("sjrz_renzheng",$is_renzheng);
            $this->assign("is_sjrz",$is_sjrz);
            $goods_val = D("Goods")->where(array("goods_id"=>array("eq",I('edit_id'))))->find();
            $where["city_pid"]=1;
            $province = D("city")->where($where)->select();            
            $where1["city_pid"] = $province[0]['city_id'];  
            if( empty($goods_val['goods_id']) ){
                $city = D("city")->where($where1)->select();
            }else if( !empty($goods_val['goods_id']) ){
                $city = D("city")->where(array("city_pid"=>array("eq",$goods_val['goods_province'])))->select();
            }         
            foreach ( explode(",", $goods_val['goods_zr_mating']) as $key => $value ) {
                if( !empty($value) ){
                    $good_ze_matings[$key] = $value;
                }
            }
            $this->assign("good_ze_matings",implode(",",$good_ze_matings));
            $this->assign("goods_pic",explode(",", $goods_val['goods_pic']));
            $this->assign("goods_val",$goods_val);
            $this->assign("city",$city);
            $this->assign("province",$province);
            $this->assign("share_id1",I("share_id1"));//一级列表
            $this->assign("share_id2",I("share_id2"));//二级列表
            $this->assign("share_id3",I("share_id3"));//三级列表
            $this->assign("flz",I("flz"));//三级列表
        }
        $this->display('esxz_fbmessage_zr');
    }
    
    //二手闲置发布批量信息
    public function esxz_fbmessage_more(){
    	// dump($_SESSION);
    	$this->display('esxz_fbmessage_more');
    }
     public function publish_content(){
        // goods_zr_shop_type_value
        // 图片裁剪
        $images = new \Think\Image(); 
        $config = array(
                'maxSize'    =>    10485760,
                'rootPath'   =>    './Uploads/admin/',
                'saveName' =>    array('uniqid',''),
                'exts'         =>    array("bmp","jpg","jpeg","gif","png"),
        );
        $upload = new \Think\Upload($config);
        $info  =  $upload->upload();
        // 读取数据的数据
        $goods_ = D("goods")->where(array("goods_id"=>array("eq",I('goods_id'))))->find();
        // 修改
        if( I("goods_id") != undefined ){
            $date['goods_id'] = I("goods_id");
            $date['goods_edit_time'] = date("Y-m-d H:i:s");
            if( empty( $info ) ){ // 图片
                $date['goods_pic'] = $goods_['goods_pic'];//多图
                $date['goods_first_pic'] = explode(",", $goods_['goods_pic'])['0'];
                $date['goods_bill_pic'] = $goods_['goods_bill_pic'];//单图
            }else{
                $goods_img = explode(",", $goods_['goods_pic']);
                $data_img = array(
                    empty($info['0'])?$goods_img['0']:$info['0']['savepath'].$info['0']['savename'],
                    empty($info['1'])?$goods_img['1']:$info['1']['savepath'].$info['1']['savename'],
                    empty($info['2'])?$goods_img['2']:$info['2']['savepath'].$info['2']['savename'],
                    empty($info['3'])?$goods_img['3']:$info['3']['savepath'].$info['3']['savename'],
                    empty($info['4'])?$goods_img['4']:$info['4']['savepath'].$info['4']['savename'],
                    empty($info['5'])?$goods_img['5']:$info['5']['savepath'].$info['5']['savename']
                );
                foreach( $data_img as $key => $value ) {
                   if( !empty($value) ){
                        $data_imgs[] = $value;
                        $images->open("./Uploads/admin/".$value);
                        $images->thumb(600,600,\Think\Image::IMAGE_THUMB_FILLED)->save("./Uploads/admin/".$value);
                   }
                }
                $date['goods_pic'] = implode(",", $data_imgs);
                $date['goods_first_pic'] = $data_imgs['0'];
                $date['goods_bill_pic'] = empty($info['6'])?$goods_['goods_bill_pic']:$info['6']['savepath'].$info['6']['savename'];
            }
        }else if( I("goods_id") == undefined ){
            // 添加
            if( !empty(I('src_path_')) ){
                $date['goods_pic'] = I('src_path_');
            }else{
                if(empty($info)){
                    $this->ajaxReturn(array("status"=>-2002,"message"=>$upload->getError() ));
                    return false;
                }            
            }
            $img_douhao = array();
            foreach ($info as $k=>$v){
                $img_douhao[] = $v['savepath'].$v['savename'];
            }
            $date['goods_first_pic'] = $img_douhao[0];
            if($date['goods_sell_type']<3){
                $date['goods_bill_pic'] = $img_douhao[count($img_douhao)-1];
            }
            $date['goods_pic'] = implode(",",$img_douhao);
        }
     	$date['goods_push_user_id'] = $_SESSION['plgox_username']['plgox_id'];
     	$date['goods_is_business'] = I('shenfen');
     	$date['goods_sell_type'] = I('goods_sell_type');
     	$date['goods_is_batch'] = I('goods_num');
        // goods_produce_address
     	//$date['text'] = I('text');//哪类用户可见，先不入库，没定好库结构。
        $date['goods_produce_address'] = I('goods_produce_address');
     	$date['goods_name'] = I('goods_name');
     	$date['goods_cost_price'] = I('goods_cost_price');
     	$date['goods_deal_price'] = I('esxz_zrjg');
     	$date['goods_brand'] = I('goods_brand');
     	$date['goods_description'] = I('goods_description');
     	$date['goods_link_name'] = I('link_name');
     	$date['goods_link_phone'] = I('phone');
     	$date['goods_link_qq'] = I('qq');
     	$date['goods_link_sex'] =I('sex');
     	$date['goods_link_wechat'] = I('wechat');
     	$date['goods_typea'] = I('goods_typea');
     	$date['goods_typeb'] = I('goods_typeb');
     	$date['goods_typec'] = I('goods_typec');
     	$date['goods_sell_type'] = I('goods_sell_type');
     	$date['goods_province'] = I('province');
     	$date['goods_city'] = I('city');
     	$date['goods_address'] = I('shouhuo_address');
     	$date['goods_publish_time'] = date("Y-m-d H:i:s");
     	$date['goods_city'] = I('city');
        $date['goods_is_check'] = 1;
     	//转让数据接收
     	$date['goods_zr_shop_type'] = I('shop_type');
     	if($date['goods_zr_shop_type']==6){
     		$date['goods_zr_shop_type_value'] = I('shop_type_value');
     	}
     	$date['goods_zr_status'] = I('zr_status');
     	$date['goods_zr_area'] = I('area');
     	$date['goods_zr_floor'] = I('floor');
     	if($date['goods_zr_floor']==1){
     		$date['goods_zr_floor_num'] = I('num');
     		$date['goods_zr_floor_count'] = I('count');
     		$date['goods_zr_floor_lastnum'] = 0;
     	}else{
     		$date['goods_zr_floor_num'] = I('num');
     		$date['goods_zr_floor_count'] = I('count');
     		$date['goods_zr_floor_lastnum'] = I('lastnum');
     	}
     	
     	$date['goods_zr_weight'] = I('weight');
     	$date['goods_zr_height'] = I('height');
     	$date['goods_zr_depth'] = I('depth');
     	$date['goods_zr_mating'] = I('str');
     	//$this->ajaxReturn($info);
        if( I("goods_id") != undefined ){
            D("goods")->save($date);
        }else if( I("goods_id") == undefined ){
            D("goods")->add($date);
        }
     	//发布成功时，用户发布次数加1,begin
     	D("member")->where('plgox_id='.$_SESSION['plgox_username']['plgox_id'])->setInc('plgox_publish_num');
     	//发布成功时，用户发布次数加1,end
     	
     	/*echo D("goods")->getLastSql();
     	$this->ajaxReturn($_REQUEST);*/
     	exit;
     }
     public function esxz_collect(){
     	if(I('type')==1){
     	$data['collect_goods_id'] = I('id');
     	$data['collect_ptime'] = date("Y-m-d H:i:s");
     	$data['collect_user_id'] = $_SESSION['plgox_username']['plgox_id'];
     	D("collect")->add($data);
     	}else{
     		$where['collect_goods_id'] = I('id');
     		$where['collect_user_id'] = $_SESSION['plgox_username']['plgox_id'];
     		D("collect")->where($where)->delete();
     	}
     	//echo D("collect")->getLastSql();
     }
     public function esxz_exit_goods(){
     	$where['goods_id'] = I('id');
     	$goods_detail = D('goods')->where($where)->find();
     	$img_url = explode(",", $goods_detail['goods_pic']);
     	//$this->ajaxReturn($goods_detail);
     	$this->assign("province_id",$goods_detail['goods_province']);
     	$this->assign("city_id",$goods_detail['goods_city']);
     	$this->assign("img_url",$img_url);
     	$this->assign("goods_detail",$goods_detail);
     	//取省份城市
     	// dump($_SESSION);
     	$where["city_pid"]=1;
     	$province = D("city")->where($where)->select();
     	$where1["city_pid"] = $goods_detail['goods_province'];
     	$city = D("city")->where($where1)->select();
     	if(count($city)==1){
     		$where2["city_pid"] = $city[0]['city_id'];
     		$city = D("city")->where($where2)->select();
     	}
     	//return $this->ajaxReturn($province);
     	$this->assign("city",$city);
     	//return $this->ajaxReturn($city);
     	$this->assign("province",$province);
     	
     	if(I('type')==1||I('type')==2){
     		$this->display('esxz_update_detil');
     	}else if(I('type')==3){
    		$this->display('esxz_update_detil_qg');
     	}else if(I('type')==4){
     		$this->display('esxz_update_detil_zr');
     	}
     }
     
     public function update_content(){
     	$date['goods_is_batch'] = I('goods_num');
     	//$date['text'] = I('text');//哪类用户可见，先不入库，没定好库结构。
     	$date['goods_name'] = I('goods_name');
     	$date['goods_cost_price'] = I('goods_cost_price');
     	$date['goods_deal_price'] = I('esxz_zrjg');
     	$date['goods_produce_address'] = I('goods_produce_address');
     	$date['goods_brand'] = I('goods_brand');
     	$date['goods_description'] = I('goods_description');
     	$date['goods_is_business'] = I('shenfen');
     	$date['goods_link_name'] = I('link_name');
     	$date['goods_link_phone'] = I('phone');
     	$date['goods_link_qq'] = I('qq');
     	$date['goods_link_sex'] =I('sex');
     	$date['goods_link_wechat'] = I('wechat');
     	$date['goods_province'] = I('province');
     	$date['goods_city'] = I('city');
     	$date['goods_address'] = I('shouhuo_address');
     	$date['goods_edit_time'] = date("Y-m-d H:i:s");
     	$date['goods_city'] = I('city');
     	//转让数据接收
     	$date['goods_zr_shop_type'] = I('shop_type');
     	if($date['goods_zr_shop_type']==6){
     		$date['goods_zr_shop_type_value'] = I('shop_type_value');
     	}
     	$date['goods_zr_status'] = I('zr_status');
     	$date['goods_zr_area'] = I('area');
     	$date['goods_zr_floor'] = I('floor');
     	if($date['goods_zr_floor']==1){
     		$date['goods_zr_floor_num'] = I('num');
     		$date['goods_zr_floor_count'] = I('count');
     		$date['goods_zr_floor_lastnum'] = 0;
     	}else{
     		$date['goods_zr_floor_num'] = I('num');
     		$date['goods_zr_floor_count'] = I('count');
     		$date['goods_zr_floor_lastnum'] = I('lastnum');
     	}
     	//echo $date['goods_zr_floor_lastnum'];
     	$date['goods_zr_weight'] = I('weight');
     	$date['goods_zr_height'] = I('height');
     	$date['goods_zr_depth'] = I('depth');
     	$date['goods_zr_mating'] = I('str');
     
     	$config = array(
     			'maxSize'    =>    10485760,
     			'rootPath'   =>    './Uploads/admin/',
     			'saveName' =>    array('uniqid',''),
     			'exts'         =>    array("bmp","jpg","jpeg","gif","png"),
     	);
		$image = new \Think\Image();
     	$upload = new \Think\Upload($config);
     	$info   =   $upload->upload();

     	$old_pic_url = D("goods")->field("goods_pic,goods_first_pic,goods_bill_pic,goods_sell_type")->where(array("goods_id"=>I("goodsid")))->find();
     	if(empty($info)){
     		$date['goods_first_pic'] = $old_pic_url['goods_first_pic'];
     		$date['goods_pic'] = $old_pic_url['goods_pic'];
     	}else{
     		$img_url_array = explode(",", $old_pic_url['goods_pic']);
     		$img_url_new = array(
     				empty($info['0'])?$img_url_array['0']:$info['0']['savepath'].$info['0']['savename'],
     				empty($info['1'])?$img_url_array['1']:$info['1']['savepath'].$info['1']['savename'],
     				empty($info['2'])?$img_url_array['2']:$info['2']['savepath'].$info['2']['savename'],
     				empty($info['3'])?$img_url_array['3']:$info['3']['savepath'].$info['3']['savename'],
     				empty($info['4'])?$img_url_array['4']:$info['4']['savepath'].$info['4']['savename'],
     				empty($info['5'])?$img_url_array['5']:$info['5']['savepath'].$info['5']['savename'],
     				empty($info['6'])?$img_url_array['6']:$info['6']['savepath'].$info['6']['savename'],
     				empty($info['7'])?$img_url_array['7']:$info['7']['savepath'].$info['7']['savename'],
     				empty($info['8'])?$img_url_array['8']:$info['8']['savepath'].$info['8']['savename'],
     				empty($info['9'])?$img_url_array['9']:$info['9']['savepath'].$info['9']['savename']
     		);
     		$date['goods_first_pic'] = $img_url_new['0'];
     		$date['goods_pic'] = implode(',',$img_url_new);
     	}
     	if($old_pic_url['goods_sell_type']==1||$old_pic_url['goods_sell_type']==2){
     		if(empty($info['10'])){
     			$date['goods_bill_pic'] = $old_pic_url['goods_bill_pic'];
     		}else{
     			$date['goods_bill_pic'] = $info['10']['savepath'].$info['10']['savename'];
     		}
     	}
     	
     	if($old_pic_url['goods_sell_type']==3){
     		$date['goods_produce_address'] = I('goods_area');
     	}
     	
     	/* $img_douhao = array();
     	foreach ($info as $k=>$v){
     		$img_douhao[] = $v['savepath'].$v['savename'];
     	}
     
     	$date['goods_first_pic'] = $img_douhao[0];
     	if($date['goods_sell_type']<3){
     		$date['goods_bill_pic'] = $img_douhao[count($img_douhao)-1];
     	}
     	$date['goods_pic'] = implode(",",$img_douhao); */
     	$where['goods_id'] = I('goodsid');
     	D("goods")->where($where)->save($date); 
     
     	//echo D("goods")->getLastSql();
     	$this->ajaxReturn($info);
     	//$this->ajaxReturn($_REQUEST);
     	exit;
     }
     
}