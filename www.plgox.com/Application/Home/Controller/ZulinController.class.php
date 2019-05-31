<?php
namespace Home\Controller;
use Think\Controller;
class ZulinController extends CommonController {
    public function zulin(){
        if( !empty(I("id")) ){
            $count = D("Share")->where(array("share_classify_pid"=>array("EQ",I('id'))))->count();
            $page = new \Think\Page($count,48);
            $this->assign("share",D("Share")->where(array("share_classify_pid"=>array("EQ",I('id'))))->order("share_self_support = 1 desc")->limit($page->firstRow.','.$page->listRows)->select());
        }else{
            $count = D("Share")->count();
            $page = new \Think\Page($count,48);//48
            $this->assign("share",D("Share")->order("share_self_support = 1 desc")->limit($page->firstRow.','.$page->listRows)->select());
        }
        $page->setConfig("header","<div class='page_style'>共<b>%TOTAL_PAGE%</b>页</div><div class='page_djy'>/第<b><input type='text' value=%NOW_PAGE% class='bdz'/></b>页</div><div class='qdtz'>确定</div>");
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        $page->setConfig("first","首页");
        $page->setConfig("last","尾页");
        $page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
        $this->assign("page",$page->show());
        $this->assign("classify",D("Classify")->select());
        $this->assign("filter",D("Filter")->select());
        $this->assign("setTitle","餐饮租赁");
        $this->display('zulin');
    }
  
    
    // 商品筛选
    public function shaixuan(){
         $sqlexp='';
         $orders = '';
        if( !empty(I('share_product_search')) ){
            $sqlexp.="and ( share_name like '%".I('share_product_search')."%')";
        }
        if( !empty(I("fenlei")) ){
             $sqlexp.= "and (share_classify_pid = ".I("fenlei").")";
        }
        if( !empty( I("zujin")) ){
             $sqlexp.= "and (share_prices_qujian = ".I("zujin").")";
        }
        if( I("share_shaixuan_") == 1 ){ // 租金低到高 排序
            $orders.="share_self_support = 1,share_rent ASC";
        }else if( I("share_shaixuan_") == 2 ){ // 租金高到低 排序
            $orders.="share_self_support = 1,share_rent DESC";
        }else if( I("share_shaixuan_") == 3 ){ // 满意度低到高 排序
            
        }else if( I("share_shaixuan_") == 4 ){ // 满意度高到低 排序

        }
        // 排序
        $count = D("Share")->where("share_type = 1 ".$sqlexp)->count();
        $page = new \Think\Page($count,48);//48
        $share = D("Share")->where("share_type = 1 ".$sqlexp)->order($orders)->limit($page->firstRow.','.$page->listRows)->select();
        $page->setConfig("header","<div class='page_style'>共<b>%TOTAL_PAGE%</b>页</div><div class='page_djy'>/第<b><input type='text' value=%NOW_PAGE% class='bdz'/></b>页</div><div class='qdtz'>确定</div>");
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        $page->setConfig("first","首页");
        $page->setConfig("last","尾页");
        $page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
        $this->assign("page",$page->show());

        //$this->assign("classify",D("Classify")->select());
        //一级分类
        $this->assign("yijifenlei",D("Classify")->where(array("classify_pid"=>array("eq",0)))->select());
        
        $first_one=D("Classify")->where(array("classify_pid"=>array("eq",0)))->select()[0]['classify_id'];

        //二级分类
        $this->assign("erjifenlei",D("Classify")->where(array("classify_pid"=>$first_one))->select());
   
        $second_one=D("Classify")->where(array("classify_pid"=>$first_one))->select()[0]['classify_id'];
        
        //三级分类
        $this->assign("sanjifenlei",D("Classify")->where(array("classify_pid"=>$second_one))->select());

        $is_renzheng = D("Member")->where(array("plgox_id"=>array("eq",get_login_userid())))->find();
        if( $is_renzheng['plgox_is_renzheng'] == '0' ){
            $is_sjrz = 1;
        }else if( $is_renzheng['plgox_is_renzheng'] == '1' ){
            $is_sjrz = 2;
        }
         $this->assign("sjrz_renzheng",$is_renzheng);
        $this->assign("is_sjrz",$is_sjrz);

        $this->assign("filter",D("Filter")->select());
        if( empty(I("fenlei")) && I("fenlei") == "" ){
            $share_product_search = I("share_product_search");
        }else if( !empty(I("fenlei")) && I("fenlei") == "" ){
            $share_product_search = "";
        }
        $this->assign("share_shaixuan_",I("share_shaixuan_"));
        $this->assign("shop_info",D("Classify")->shop_info($share));
        $classify_font = D("Classify")->where(array("classify_id"=>array("eq",I('fenlei'))))->find();
        $this->assign("share_product_search",$share_product_search);
        $this->assign("share_count",count($share));
        $this->assign("classify_font",$classify_font['classify_title']);
        $this->assign("city",$_SESSION['city']);
        $this->assign("fenlei",I('fenlei'));
        $this->assign("zujin",I('zujin'));
        $this->assign("share",$share);
        $this->assign("setTitle","餐饮租赁");
        $this->display('zulin');
    }
    public function AjaxRent() {
        $specifications = D("specifications")->select();
        $this->ajaxReturn($specifications);
    }
/*    public function share_list() {
    	
        if( I('order1') ){
            $ocunt = D("Share")->order(" share_rent asc ")->count();
            $page = new \Think\Page($count,48);//48
             $this->assign("ordersy","1");
            $this->assign("share",D('Share')->order("share_rent asc")->limit($page->firstRow.','.$page->listRows)->select());
        }else if( I("order2") ){
            $ocunt = D("Share")->order(" share_rent desc ")->count();
            $page = new \Think\Page($count,48);//48
            $this->assign("ordersy","2");
            $this->assign("share",D('Share')->order("share_rent desc")->limit($page->firstRow.','.$page->listRows)->select());
        }else if( I("defaults") ){
            $count = D("Share")->count();
            $page = new \Think\Page($count,48);
            $this->assign("share",D("Share")->order(" share_self_support = 1 desc ")->limit($page->firstRow.','.$page->listRows)->select());
        }
            $page->setConfig("header","<div class='page_style'>共<b>%TOTAL_PAGE%</b>页</div><div class='page_djy'>/第<b><input type='text' value=%NOW_PAGE% class='bdz'/></b>页</div><div class='qdtz'>确定</div>");
            $page->setConfig("prev","上一页");
            $page->setConfig("next","下一页");
            $page->setConfig("first","首页");
            $page->setConfig("last","尾页");
            $page->setConfig("theme","%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
            $this->assign("page",$page->show());
            $this->assign("classify",D("Classify")->where(array("classify_pid"=>array("neq",0)))->select());
            $this->assign("filter",D("Filter")->select());
            $this->display('zulin');
    }*/
}