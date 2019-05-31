<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
	/**
	 * @param 首页页面数据
	 */
    public function index(){
    	$cart = D("Cart")->where( array( "cart_memberuid"=>array( "eq",get_login_userid()),'cart_status'=>array("eq",1)))->select();
		$this->assign("cart",count($cart));
		// 顶级分类
        $Classify = D("Classify")->where(array("classify_pid"=>array("eq",0)))->select();
            // 子分类
        foreach( $Classify as $key => $val ){
           $Classify[$key][$val['classify_id']] =  D("Classify")->where(array("classify_pid"=>array("eq",$val['classify_id'])))->limit(8)->order("classify_createtime desc")->select();
        }
        $is_renzheng = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
        if( $is_renzheng['plgox_is_renzheng'] == '0' ){
            $is_sjrz = 1;
        }else if( $is_renzheng['plgox_is_renzheng'] == '1' ){
            $is_sjrz = 2;
        }
        // 判断点击商家中心是否认证
        
        // $renzheng =  D("Renzheng")->where(array("renzheng_memberuid"=>array("eq",get_login_userid())))->find();
        $this->assign("user_info",get_login_userid());
        
        $this->assign("Classify",$Classify);
    	
    	
    	 $this->assign("sjrz_renzheng",$is_renzheng);
        $this->assign("is_sjrz",$is_sjrz);
    	// 商品板块
    	$this->assign("module",D("Module")->select());
        // 推荐至首页
        $this->assign("shares_home",D("Share")->where(array("share_recommend"=>array("eq",4)))->order("share_id desc")->select());
    	// 商品右侧
    	$this->assign("share",D("Share")->limit(6)->where(array("share_recommend"=>array("EQ",0)))->order("share_id desc")->select());
    	// 商品左侧
    	$this->assign("shares_",D("Share")->where(array("share_recommend"=>array("eq",1)))->order("share_id desc")->select());
    	// banner
    	$this->assign("banner",D("Banner")->select());
        // 合作伙伴
        $this->assign("cooperation",D("Cooperation")->select());
        // 顶级分类
        $Classify = D("Classify")->where(array("classify_pid"=>array("eq",0)))->select();
            // 子分类
        foreach( $Classify as $key => $val ){
           $Classify[$key][$val['classify_id']] =  D("Classify")->where(array("classify_pid"=>array("eq",$val['classify_id'])))->limit(8)->order("classify_createtime desc")->select();
        }
        $this->assign("Classify",$Classify);
        $this->display();
    }
    // 定位
    public function weizhi() {
        $name = I("name");
        $jingdu = I("jingdu");
        $weidu = I("weidu");
        if($name  == '0'){
            session('city',null);
            $this->ajaxReturn(array('sta'=>2,'msg'=>'清空完成'));
            exit();
        }
        if($name){
            session('city',$name);
            session('jingdu',$jingdu);
            session('weidu',$weidu);
        }else{
            $this->ajaxReturn(array('sta'=>2,'msg'=>'定位失败'));
        }
        if(session('jingdu')){
            $this->ajaxReturn(array('sta'=>1,'msg'=>'成功'));
        }else{
            $this->ajaxReturn(array('sta'=>2,'msg'=>'失败'));
        }
    }
    //不存在的页面
    public function no_exit(){
    	
        $this->display('no_exit');
    }
    // 委托租赁
    public function weituo(){
        $data = array(
            'weituo_uid' => get_login_userid(),
            'weituo_tel' => I('weituo_tel'),
            'weituo_time' => time()
        );
       // $Weituo = D("Weituo")->where(array("weituo_uid"=>array("eq",get_login_userid())))->find();
       // if( empty($Weituo['weituo_status']) ){
           $Weituos =  D("Weituo")->add($data);
           if( $Weituos ){
                $this->ajaxReturn(array("status"=>2000,"message"=>"委托成功,稍后我们会致电给您,请耐心等待!"));
                return false;
           }else{
                $this->ajaxReturn(array("status"=>-2001,"message"=>"委托失败,请刷新网页后重新发起委托!"));
                return false;
           }
       // }else{
            //  $this->ajaxReturn(array("status"=>-2001,"message"=>"您发起的委托尚未处理,请勿重复发起委托!"));
            // return false;
       // }
    }
}