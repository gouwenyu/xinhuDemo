<?php
namespace Home\Controller;
use Think\Controller;
class ShopcenterController extends CommonController {
	//商家中心
    public function sj_center(){	
        if( empty(get_login_userid()) ){
            $this->redirect("Tourist/login");
            exit;
        }
        $this->display();
    }
    //商家申请
    public function sj_shengqing(){
        if( empty(get_login_userid()) ){
            $this->redirect("Tourist/login");
            exit;
        }
        $this->display("sj_shengqing");
    }
     //商家申请
    public function sj_shengqing_add(){
    	$data = array(
			'shop_only_id' => get_login_userid(),
			'shop_name' => I('shop_name'),
			'shop_telephone' => I('shop_telephone'),
			'shop_fp_type' => I('shop_fp_type'),
			'shop_bx_telephone' => I('shop_bx_telephone'),
            'shop_is_xieyi' => I('shop_is_xieyi'),
            'shop_xieyi_bianhao' => date("Ymd").mt_rand(1111111,9999999),
			'shop_createtime' => time()
		);
       $shop_center =  D("Shop_center")->where(array("shop_only_id"=>array("eq",get_login_userid())))->find();
       if( empty($shop_center) ){
            $data_add = D("shop_center")->add($data);
            if( $data_add ){
                $this->ajaxReturn(array("status"=>2000,"mmessage"=>"申请成功，请等待后台审核，将有工作人员与您联系。"));
                return false;
            }else{
                $this->ajaxReturn(array("status"=>-2001,"message"=>"添加商家入驻基本信息失败!"));
                return false;
            }        
       }else{
             $this->ajaxReturn(array("status"=>-2002,"message"=>"您已经提交过一次商家入驻请求,无法重复提交!"));
             return false;
       }

        $this->display("sj_shengqing");
    }
   //商家头部
    public function sj_top(){
        $this->display();
    }
     //商家头部
    public function sj_xieyi(){
        $this->display("sj_xieyi");
    }

    	
}