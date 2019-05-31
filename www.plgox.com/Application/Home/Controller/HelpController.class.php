<?php
namespace Home\Controller;
use Think\Controller;
class HelpController extends CommonController {
	//帮助中心
    public function help_top(){
        $this->display('help_top');
    }
     //公司概况
    public function GongSiGaiKuang(){
        $this->display('GongSiGaiKuang');
    }
     //商务合作
    public function ShangWuHeZuo(){
        $this->display('ShangWuHeZuo');
    }
     //加入我们
    public function JiaRuWoMen(){
        $this->display('JiaRuWoMen');
    }
      //联系我们
    public function LianXiWoMen(){
        $this->display('LianXiWoMen');
    }
    
    
   
    //租赁流程
    public function ZuLinLiuCheng(){
        $this->display('ZuLinLiuCheng');
    }
     //租金支付
    public function ZuJinZhiFu(){
        $this->display('ZuJinZhiFu');
    }
      //租赁协议
    public function ZuLinXieYi(){
        $this->display('ZuLinXieYi');
    }
     //退还说明
    public function TuiHuanShuoMing(){
        $this->display('TuiHuanShuoMing');
    }
     //服务时间
    public function FuWuShiJian(){
        $this->display('FuWuShiJian');
    }
    
    
      //入驻条件
    public function RuZhuTiaoJian(){
        $this->display('RuZhuTiaoJian');
    }
     //入驻流程
    public function RuZhuLiuCheng(){
        $this->display('RuZhuLiuCheng');
    }
      //入驻协议
    public function RuZhuXieYi(){
        $this->display('RuZhuXieYi');
    }
    
    
    
     //签收注意事项
    public function QianShouZhuYi(){
        $this->display('QianShouZhuYi');
    }
     //退机流程
    public function TuiJiLiuCheng(){
        $this->display('TuiJiLiuCheng');
    }
     //售后服务
    public function ShouHouFuWu(){
        $this->display('ShouHouFuWu');
    }
     //违约处理
    public function WeiYueChuLi(){
        $this->display('WeiYueChuLi');
    }
     //故障报修
    public function GuZhangBaoXiu(){
        $this->display('GuZhangBaoXiu');
    }
     //设备故障怎么办
    public function SheBeiGuZhang(){
        $this->display('SheBeiGuZhang');
    }
     //面签准备什么
    public function MianQianZhunBei(){
        $this->display('MianQianZhunBei');
    }
	//设备丢失和损坏
    public function SheBeiDiuShi(){
        $this->display('SheBeiDiuShi');
    }
    
}