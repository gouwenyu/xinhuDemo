<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends SessionController {
    public function index(){
    	$cc = D("Member")->where(array("plgox_id" => get_session_info()))->find();
    	$this->assign("cc",$cc);
    	$this->display("index");
    }
}