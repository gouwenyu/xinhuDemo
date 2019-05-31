<?php
namespace Home\Controller;
use Think\Controller;
class PayController extends CommonController {
    public function pay(){	
    	if( empty(get_login_userid()) ){
    		$this->redirect("Tourist/login");
    		exit;
    	}
    	$this->assign("orders",D("Order_detil as orders")->where(array("order_id"=>array("eq",I('id'))))->find());
    	// 支付类型 1=>押金支付 2=>租金支付 3=>信用金支付
    	$this->assign("type",I('type'));
        // 统一支付押金的id
            

        foreach ( explode(",", base64_decode(I('shop_id'))) as $key => $val) {
           $order_catr =  D("order_detil")->where(array("order_cart_id"=>array('eq',$val)))->select();
           foreach ($order_catr as $key => $values) {
               $data[] = $values['pay_number']; // 统一支付订单号
           }
        }
        $Order_detil =  D("order_detil")->where(array("pay_number"=>array('eq',implode(",", array_unique($data)))))->select();
        foreach ( $Order_detil as $key => $value ) {
            if( $value['order_detil_status'] == 1 ){
                $prices[] = $value['order_detill_xyj'];
                $pay_number[] = $value['pay_number'];
            }else if( $value['order_detil_status'] == 2 ){
                $prices[] = $value['order_mm_prices'];
                $pay_number[] = $value['pay_number'];
            }
        }
        $this->assign("prices",array_sum($prices));// 统一支付的价格
        $this->assign("pay_number",implode(",", array_unique($pay_number))); // 统一支付的订单号
        if( I("type") == 1 ){
            $this->assign("setTitle","魄力餐厨-支付押金");
        }else if( I("type") == 2 ){
            $this->assign("setTitle","魄力餐厨-支付租金");
        }else if( I("type") == 3 || I("type") == 4 ){
            $this->assign("setTitle","魄力餐厨-信用金支付");
        }else if( I("type") == 5 ){
            $this->assign("setTitle","魄力餐厨-商品购买支付");
        }
        $this->display('pay');
    }
    // 支付宝支付
    public function alipay(){
        // 读取支付宝的配置
        $alipay_config = C("alipay_config");
        $orderid = explode(",",I('id'));//订单id
        $prices = I("price");// 支付金额
        $pay_type = I('pay_type'); //支付方式：支付宝
        $type_status = I('type'); //支付类型：押金
        $pay_number = I('pay_number');//统一支付订单号

        //金额处理
        $prices_all = 0;
        // 共享押金 
        if( $pay_type == 1 ){ //支付宝支付
            if( $type_status == 1 ){ //押金支付
                foreach($orderid as $key => $val ){
                   $order_detil =  D("Order_detil as orders")->where(array('order_id'=>array('eq',$val)))
                   ->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id ")
                   ->join("left join plgox_share as share on share.share_id = cart.cart_share_id ")
                   ->join("left join plgox_member as member on member.plgox_id = cart.cart_shangjia_id ")
                   ->find();
                    $out_trade_no = $order_detil['order_number'];//商户订单号，商户网站订单系统支付信用金唯一订单号，必填；采用数据库订单;
                    $body = "魄力租赁市场-".$order_detil['share_name'];//商品描述，可空;使用商品名称代替
                }
                $subject = "租赁押金支付";//订单名称，必填
                if( doubleval($prices) <= 0 ){
                    $this->ajaxReturn(array("status"=>-2001,"message"=>"订单金额是不能小于0的!"));
                    return false;
                }else{
                    $total_fee = doubleval($prices);//付款金额，必填
                }
                // 判断订单号是否存在
                if( empty($order_detil) || $order_detil['order_member_del_status'] == 1 ){
                    $this->ajaxReturn(array("status"=>-2002,"message"=>"当前订单不存在或已在支付前被删除,无法完成支付!"));
                    return false;
                }
            }else if( $type_status == 3 ){ //信用金支付
                foreach($orderid as $key => $val ){
                   $order_detil =  D("Order_detil as orders")->where(array('order_id'=>array('eq',$val)))
                   ->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id ")
                   ->join("left join plgox_share as share on share.share_id = cart.cart_share_id ")
                   ->join("left join plgox_member as member on member.plgox_id = cart.cart_shangjia_id ")
                   ->find();
                    $out_trade_no = $order_detil['order_detil_number1'];//商户订单号，商户网站订单系统支付信用金唯一订单号，必填；采用数据库订单;
                    $body = "魄力租赁市场-".$order_detil['share_name'];//商品描述，可空;使用商品名称代替
                }
                $subject = "信用金支付";//订单名称，必填
                if( doubleval($prices) <= 0 ){
                    $this->ajaxReturn(array("status"=>-2001,"message"=>"订单金额是不能小于0的!"));
                    return false;
                }else{
                    $total_fee = doubleval($prices);//付款金额，必填
                }
                // 判断订单号是否存在
                if( empty($order_detil) || $order_detil['order_member_del_status'] == 1 ){
                    $this->ajaxReturn(array("status"=>-2002,"message"=>"当前订单不存在或已在支付前被删除,无法完成支付!"));
                    return false;
                }
            }else if( $type_status == 4 ){
                $order_detil = D("order_detil as orders")->where(array("pay_number"=>array("eq",$pay_number)))
                ->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id ")
                ->join("left join plgox_share as share on share.share_id = cart.cart_share_id ")
                ->join("left join plgox_member as member on member.plgox_id = cart.cart_shangjia_id ")
                ->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
                ->select();
                foreach( $order_detil as $key => $value ){
                   $data['pay_number'] = $value['pay_number']; // 支付订单号
                   $body_[] = $value['specifications_name']; // 产品规格名称
                   $order_number_del_status[] = $value['order_member_del_status']; //订单状态 0 未删除 1 删除
                }
                $out_trade_no = $data['pay_number']; // 支付订单号：支付订单号是支付合并信用金唯一订单号，必填；采用数据库订单;
                $body = "魄力租赁市场-".implode(",", $body_); // 商品描述，可空;使用商品名称代替
                $subject = "信用金支付"; // 商品名称
                if( doubleval($prices) <=0 ){ // 判断商品的价格不能小于0
                     $this->ajaxReturn(array("status"=>-2001,"message"=>"订单金额是不能小于0的!"));
                    return false;
                }else{
                    $total_fee = doubleval($prices); // 付款的金额 必填写
                }
                // 判断订单号是否存在
                if( empty($order_detil) ){
                    $this->ajaxReturn(array("status"=>-2002,"message"=>"当前订单不存在或已在支付前被删除,无法完成支付!"));
                    return false;
                }
            }else if( $type_status == 5 ){
                foreach ($orderid as $key => $value) {
                   $order_detil =  D("Order_detil as orders")->where(array('order_id'=>array('eq',$value)))
                   ->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id ")
                   ->join("left join plgox_share as share on share.share_id = cart.cart_share_id ")
                   ->join("left join plgox_member as member on member.plgox_id = cart.cart_shangjia_id ")
                   ->find();
                   $out_trade_no = $order_detil['order_number'];//商户订单号，商户网站订单系统支付唯一订单号，必填；采用数据库订单;
                   $body = "魄力餐厨-".$order_detil['share_name'];//商品描述，可空;使用商品名称代替
                }
                $subject = "魄力餐厨-商品购买支付";//订单名称，必填
                if( doubleval($prices) <= 0 ){
                    $this->ajaxReturn(array("status"=>-2001,"message"=>"订单金额是不能小于0的!"));
                    return false;
                }else{
                    $total_fee = doubleval($prices);//付款金额，必填
                }
                // 判断订单号是否存在
                if( empty($order_detil) || $order_detil['order_member_del_status'] == 1 ){
                    $this->ajaxReturn(array("status"=>-2002,"message"=>"当前订单不存在或已在支付前被删除,无法完成支付!"));
                    return false;
                }
            }else if(  $type_status == 6 ){
                $order_detil = D("order_detil as orders")->where(array("pay_number"=>array("eq",$pay_number)))
                ->join("left join plgox_cart as cart on cart.cart_id = orders.order_cart_id ")
                ->join("left join plgox_share as share on share.share_id = cart.cart_share_id ")
                ->join("left join plgox_member as member on member.plgox_id = cart.cart_shangjia_id ")
                ->join("left join plgox_specifications as sp on sp.specifications_id = cart.cart_product_id")
                ->select();
                foreach( $order_detil as $key => $value ){
                   $data['pay_number'] = $value['pay_number']; // 支付订单号
                   $body_[] = $value['specifications_name']; // 产品规格名称
                   $order_number_del_status[] = $value['order_member_del_status']; //订单状态 0 未删除 1 删除
                }
                $out_trade_no = $data['pay_number']; // 支付订单号：支付订单号是支付合并信用金唯一订单号，必填；采用数据库订单;
                $body = "魄力餐厨-".implode(",", $body_); // 商品描述，可空;使用商品名称代替
                $subject = "魄力餐厨-商品购买支付"; // 商品名称
                if( doubleval($prices) <=0 ){ // 判断商品的价格不能小于0
                     $this->ajaxReturn(array("status"=>-2001,"message"=>"订单金额是不能小于0的!"));
                    return false;
                }else{
                    $total_fee = doubleval($prices); // 付款的金额 必填写
                }
                // 判断订单号是否存在
                if( empty($order_detil) ){
                    $this->ajaxReturn(array("status"=>-2002,"message"=>"当前订单不存在或已在支付前被删除,无法完成支付!"));
                    return false;
                }
            }
        }
        if( $pay_type == 1 && $type_status == 1 ){
        // 押金
           $parameter_1['return_url'] = getDomain()."/Pay/return_url";
           $parameter_1['notify_url'] = getDomain()."/Pay/notify_url";
        }else if( $pay_type == 1 && $type_status == 2 ){
        // 租金
           $parameter_1['return_url'] = getDomain()."/Pay/return_url";
           $parameter_1['notify_url'] = getDomain()."/Pay/notify_url1";
        }else if( $pay_type == 1 && $type_status == 3 ){
            // 信用金
            $parameter_1['return_url'] = getDomain()."/Pay/return_url2";
            $parameter_1['notify_url'] = getDomain()."/Pay/notify_url2";
        }else if( $pay_type == 1 && $type_status == 4 ){
            // 统一支付的信用金
            $parameter_1['return_url'] = getDomain()."/Pay/return_url3";
            $parameter_1['notify_url'] = getDomain()."/Pay/notify_url3";
        }else if( $pay_type == 1 && $type_status == 5 ){
            // 商品购买付款
            $parameter_1['return_url'] = getDomain()."/Pay/return_url4";
            $parameter_1['notify_url'] = getDomain()."/Pay/notify_url4";
        }else if(  $pay_type == 1 && $type_status == 6 ){
            // 商品购买统一付款
            $parameter_1['return_url'] = getDomain()."/Pay/return_url5";
            $parameter_1['notify_url'] = getDomain()."/Pay/notify_url5";
        }
        // 共享租金
        $parameter = array(
                "service"       => $alipay_config['service'],
                "partner"       => $alipay_config['partner'],
                "seller_id"     => $alipay_config['partner'],
                "payment_type"  => $alipay_config['payment_type'],
                // 防止钓鱼的
                "anti_phishing_key"=> $alipay_config['anti_phishing_key'],
                "exter_invoke_ip"=> get_client_ip(),
                "out_trade_no"  => $out_trade_no,
                "subject"   => $subject,
                "total_fee" => $total_fee,
                "body"  => $body,
                'it_b_pay' => "10m",
                "_input_charset"    => trim(strtolower($alipay_config['input_charset']))
        );
        $parameters = array_merge($parameter,$parameter_1);
        //建立请求
        $alipaySubmit = new \Think\AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameters,"get", "确认");
        echo $html_text;
    }
    // 购买统一付款 同步通知
    public function return_url5(){
        // 支付宝配置文件
        $alipay_config = C('alipay_config');
       //计算得出通知验证结果
        $alipayNotify = new \Think\AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {//验证成功
            $data = I('get.');
            //商户订单号
            $out_trade_no = $data['out_trade_no'];
            //支付宝交易号
            $trade_no = $data['trade_no'];
            //交易状态
            $trade_status = $data['trade_status'];
            // 买家交易账号
            $buyer_email = $data['buyer_email'];
            // 买家数字身份id
            $order_buyer_id = $data['buyer_id'];
            // 验证成功后执行的数据
            if($data['trade_status'] == 'TRADE_FINISHED' || $data['trade_status'] == 'TRADE_SUCCESS') {
               if( payOrderLook($out_trade_no) ){
                    // 更改数据库订单状态
                    // $save_data = order_shop_pay($out_trade_no,$buyer_email,$order_buyer_id,$trade_no);
                    $order_find = D("Order_detil")->where(array("pay_number"=>array("eq",$out_trade_no)))->select();
                    foreach( $order_find as $val ){
                        if( !empty($val) ){
                            $data = array(
                                'order_id' => $val['order_id'],
                                'order_pay_status' => 2,
                                'order_pay_time' => time(),
                                'order_pay_type' => 1,
                                'order_status' => 1,
                                'order_trade_no' => $trade_no,
                                'order_buyer_email' => $buyer_email,
                                'order_buyer_id' => $order_buyer_id
                            );
                            $save_data = D("Order_detil")->save($data);
                        }
                    }
                    if( $save_data ){
                      $this->redirect("User/my_mm_dingdan");
                    }
               }
            }else {
              echo "trade_status=".$data['trade_status'];
              $this->redirect("User/my_mm_dingdan");
            }
        }else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            echo "验证失败";
        }
    }
    // 购买同步付款 异步通知
    public function notify_url5(){
        // 支付宝配置
        $alipay_config = C('alipay_config');
       //计算得出通知验证结果
        $alipayNotify = new \Think\AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        if($verify_result) {//验证成功
            // 支付宝数据参数
            $data = I("post.");
            //商户订单号
            $out_trade_no = $data['out_trade_no'];
            //支付宝交易号
            $trade_no = $data['trade_no'];
            //交易状态
            $trade_status = $data['trade_status'];
            // 买家交易账号
            $buyer_email = $data['buyer_email'];
            // 买家数字身份id
            $order_buyer_id = $data['buyer_id'];

            if($data['trade_status'] == 'TRADE_FINISHED') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
                    //如果有做过处理，不执行商户的业务程序
                        
                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }else if ($data['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
                    //如果有做过处理，不执行商户的业务程序
                if( payOrderLook($out_trade_no) ){
                    // 更改数据库订单状态
                    // $save_data = order_shop_pay($out_trade_no,$buyer_email,$order_buyer_id,$trade_no);
                    $order_find = D("Order_detil")->where(array("pay_number"=>array("eq",$out_trade_no)))->select();
                    foreach( $order_find as $val ){
                        if( !empty($val) ){
                            $data = array(
                                'order_id' => $val['order_id'],
                                'order_pay_status' => 2,
                                'order_pay_time' => time(),
                                'order_pay_type' => 1,
                                'order_status' => 1,
                                'order_trade_no' => $trade_no,
                                'order_buyer_email' => $buyer_email,
                                'order_buyer_id' => $order_buyer_id
                            );
                            $save_data = D("Order_detil")->save($data);
                        }
                    }
                    if( $save_data ){
                      $this->redirect("User/my_mm_dingdan");
                    }
               }
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }else {
              echo "trade_status=".$data['trade_status'];
              $this->redirect("User/my_mm_dingdan");
            }
            // echo "success";  
        }else {
            //验证失败
            echo "fail";
            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }
    // 支付宝购买商品同步通知
    public function return_url4(){
        // 支付宝配置文件
        $alipay_config = C('alipay_config');
       //计算得出通知验证结果
        $alipayNotify = new \Think\AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {//验证成功
            $data = I('get.');
            //商户订单号
            $out_trade_no = $data['out_trade_no'];
            //支付宝交易号
            $trade_no = $data['trade_no'];
            //交易状态
            $trade_status = $data['trade_status'];
            // 买家交易账号
            $buyer_email = $data['buyer_email'];
            // 买家数字身份id
            $order_buyer_id = $data['buyer_id'];
            // 验证成功后执行的数据
            if($data['trade_status'] == 'TRADE_FINISHED' || $data['trade_status'] == 'TRADE_SUCCESS') {
               if( orderChecked($out_trade_no) ){
                    // 更改数据库订单状态
                    $save_data = order_shop_pay($out_trade_no,$buyer_email,$order_buyer_id,$trade_no);
                    if( $save_data ){
                      $this->redirect("User/my_mm_dingdan");
                    }
               }
            }else {
              echo "trade_status=".$data['trade_status'];
              $this->redirect("User/my_mm_dingdan");
            }
        }else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            echo "验证失败";
        }
    }
    // 支付宝购买商品异步通知
    public function notify_url4(){
        // 支付宝配置文件
        $alipay_config = C("alipay_config");
        //计算得出通知验证的结果
        $alipayNotify = new \Think\AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if( $verify_result ){
            $data = I("post.");
            // 商户订单号
            $out_trade_no = $data['out_trade_no'];
            // 支付宝交易号
            $trade_status = $data['trade_no'];
            // 买家交易状态
            $trade_status = $data['trade_status'];
            // 买家交易号
            $buyer_email = $data['buyer_email'];
            // 买家交易id
            $order_buyer_id = $data['buyer_id'];
            // 验证是否交易成功
            if( $data['trade_status'] == 'TRADE_FINISHED' || $data['trade_status'] == 'TRADE_SUCCESS' ){
                if( orderChecked($out_trade_no) ){
                    // 更改订单状态
                    $save_data = order_shop_pay($out_trade_no,$buyer_email,$order_buyer_id,$trade_no);
                    if( $save_data ){
                        $this->redirect("User/my_mm_dingdan");
                    }
                }
            }else{
                echo "trade_status=".$data['trade_status'];
                $this->redirect("User/my_mm_dingdan");
            }
        }else{
            echo "验证失败";
        }
    }
    // 支付宝服务器同步通知
    public function return_url() {
        // 支付宝配置文件
        $alipay_config = C('alipay_config');
       //计算得出通知验证结果
        $alipayNotify = new \Think\AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {//验证成功
            $data = I('get.');
            //商户订单号
            $out_trade_no = $data['out_trade_no'];
            //支付宝交易号
            $trade_no = $data['trade_no'];
            //交易状态
            $trade_status = $data['trade_status'];
            // 买家交易账号
            $buyer_email = $data['buyer_email'];
            // 买家数字身份id
            $order_buyer_id = $data['buyer_id'];
            // 验证成功后执行的数据
            if($data['trade_status'] == 'TRADE_FINISHED' || $data['trade_status'] == 'TRADE_SUCCESS') {
               if( orderChecked($out_trade_no) ){
                    // 更改数据库订单状态
                    $save_data = order_status_save($out_trade_no,$buyer_email,$order_buyer_id,$trade_no);
                    if( $save_data ){
                      $this->redirect("User/my_dingdan");
                    }
               }
            }else {
              echo "trade_status=".$data['trade_status'];
              $this->redirect("User/my_dingdan");
            }
        }else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            echo "验证失败";
        }
    }
    // 支付宝服务器异步通知 //押金 
    public function notify_url() {
        // 支付宝配置
        $alipay_config = C('alipay_config');
       //计算得出通知验证结果
        $alipayNotify = new \Think\AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        if($verify_result) {//验证成功
            // 支付宝数据参数
            $data = I("post.");
            //商户订单号
            $out_trade_no = $data['out_trade_no'];
            //支付宝交易号
            $trade_no = $data['trade_no'];
            //交易状态
            $trade_status = $data['trade_status'];
            // 买家交易账号
            $buyer_email = $data['buyer_email'];
            // 买家数字身份id
            $order_buyer_id = $data['buyer_id'];

            if($data['trade_status'] == 'TRADE_FINISHED') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
                    //如果有做过处理，不执行商户的业务程序
                        
                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }else if ($data['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
                    //如果有做过处理，不执行商户的业务程序
                if( orderChecked($out_trade_no) ){
                    $save_data = order_status_save($out_trade_no,$buyer_email,$order_buyer_id,$trade_no);
                    if( $save_data ){
                        echo "success";
                    }else{
                        echo "fail";
                    }
                }
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }
            // echo "success";  
        }
        else {
            //验证失败
            echo "fail";
            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }
    // 租金
    public function notify_url1() {

    }
    // 信用金
    public function return_url2() {
        // 支付宝配置文件
        $alipay_config = C('alipay_config');
       //计算得出通知验证结果
        $alipayNotify = new \Think\AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {//验证成功
            $data = I('get.');
            //商户订单号
            $out_trade_no = $data['out_trade_no'];
            //支付宝交易号
            $trade_no = $data['trade_no'];
            //交易状态
            $trade_status = $data['trade_status'];
            // 买家交易账号
            $buyer_email = $data['buyer_email'];
            // 买家数字身份id
            $order_buyer_id = $data['buyer_id'];
            // 验证成功后执行的数据
            if($data['trade_status'] == 'TRADE_FINISHED' || $data['trade_status'] == 'TRADE_SUCCESS') {
               if( orderChecked($out_trade_no) ){
                    // 更改数据库订单状态
                    $save_data = order_xyj_save($orderid,$buyer_email,$order_buyer_id,$trade_no);
                    if( $save_data ){
                      $this->redirect("User/my_dingdan");
                    }
               }
            }else {
              echo "trade_status=".$data['trade_status'];
              $this->redirect("User/my_dingdan");
            }
        }else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            echo "验证失败";
        }
    }
    public function notify_url2() {
                // 支付宝配置
        $alipay_config = C('alipay_config');
       //计算得出通知验证结果
        $alipayNotify = new \Think\AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        if($verify_result) {//验证成功
            // 支付宝数据参数
            $data = I("post.");
            //商户订单号
            $out_trade_no = $data['out_trade_no'];
            //支付宝交易号
            $trade_no = $data['trade_no'];
            //交易状态
            $trade_status = $data['trade_status'];
            // 买家交易账号
            $buyer_email = $data['buyer_email'];
            // 买家数字身份id
            $order_buyer_id = $data['buyer_id'];

            if($data['trade_status'] == 'TRADE_FINISHED') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
                    //如果有做过处理，不执行商户的业务程序
                        
                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }else if ($data['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
                    //如果有做过处理，不执行商户的业务程序
                if( orderChecked($out_trade_no) ){
                    $save_data = order_xyj_save($orderid,$buyer_email,$order_buyer_id,$trade_no);
                    if( $save_data ){
                        echo "success";
                    }else{
                        echo "fail";
                    }
                }
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }
            // echo "success";  
        }
        else {
            //验证失败
            echo "fail";
            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }
    // 统一支付信用金
    public function return_url3(){ //同步
        // 支付宝配置文件
        $alipay_config = C('alipay_config');
       //计算得出通知验证结果
        $alipayNotify = new \Think\AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {//验证成功
            $data = I('get.');
            //商户订单号
            $out_trade_no = $data['out_trade_no'];
            //支付宝交易号
            $trade_no = $data['trade_no'];
            //交易状态
            $trade_status = $data['trade_status'];
            // 买家交易账号
            $buyer_email = $data['buyer_email'];
            // 买家数字身份id
            $order_buyer_id = $data['buyer_id'];
            // 验证成功后执行的数据
            if($data['trade_status'] == 'TRADE_FINISHED' || $data['trade_status'] == 'TRADE_SUCCESS') {
               if( payOrderLook($out_trade_no) ){ // 统一支付订单检测
                    // 更改数据库订单状态
                    // $save_data = order_xyj_pay_save($out_trade_no,$buyer_email,$order_buyer_id,$trade_no,$order_trade_no);
                    $order_find = D("Order_detil")->where(array("pay_number"=>array("eq",$out_trade_no)))->select();
                    foreach( $order_find as $val ){
                        if( !empty($val) ){
                            $data = array(
                                'order_id' => $val['order_id'],
                                'order_xyj_status' => 2,
                                'order_pay_type' => 1,
                                'order_status' => 1,
                                'order_xyj_trade_no' => $trade_no,
                                'order_xyj_buyer_email' => $buyer_email,
                                'order_xyj_buyer_id' => $order_buyer_id,
                                'order_xyj_pay_time' => time()
                            );
                            $save_data = D("Order_detil")->save($data);
                        }
                    }
                    // exit;
                    if( $save_data ){
                      $this->redirect("User/my_dingdan");
                    }
               }
            }else {
              echo "trade_status=".$data['trade_status'];
              $this->redirect("User/my_dingdan");
            }
        }else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            echo "验证失败";
        }
    }
    public function notify_url3(){ //异步
        // 支付宝配置
        $alipay_config = C('alipay_config');
       //计算得出通知验证结果
        $alipayNotify = new \Think\AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        if($verify_result) {//验证成功
            // 支付宝数据参数
            $data = I("post.");
            //商户订单号
            $out_trade_no = $data['out_trade_no'];
            //支付宝交易号
            $trade_no = $data['trade_no'];
            //交易状态
            $trade_status = $data['trade_status'];
            // 买家交易账号
            $buyer_email = $data['buyer_email'];
            // 买家数字身份id
            $order_buyer_id = $data['buyer_id'];

            if($data['trade_status'] == 'TRADE_FINISHED') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
                    //如果有做过处理，不执行商户的业务程序
                        
                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }else if ($data['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
                    //如果有做过处理，不执行商户的业务程序
                if( payOrderLook($out_trade_no) ){
                    // $save_data = order_xyj_pay_save($orderid,$buyer_email,$order_buyer_id,$trade_no,$order_trade_no);
                    $order_find = D("Order_detil")->where(array("pay_number"=>array("eq",$out_trade_no)))->select();
                    foreach( $order_find as $val ){
                        if( !empty($val) ){
                            $data = array(
                                'order_id' => $val['order_id'],
                                'order_xyj_status' => 2,
                                'order_pay_type' => 1,
                                'order_status' => 1,
                                'order_xyj_trade_no' => $trade_no,
                                'order_xyj_buyer_email' => $buyer_email,
                                'order_xyj_buyer_id' => $order_buyer_id,
                                'order_xyj_pay_time' => time()
                            );
                            $save_data = D("Order_detil")->save($data);
                        }
                    }
                    // exit;
                    if( $save_data ){
                        echo "success";
                    }else{
                        echo "fail";
                    }
                }
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }
            // echo "success";  
        }
        else {
            //验证失败
            echo "fail";
            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }

    // 微信支付 生成二维码
     public function wechat(){
     	if( empty(get_login_userid()) ){
    		$this->redirect("Tourist/login");
    		exit;
    	}else{
    		$data['userid'] = get_login_userid();
    		$data['prices'] = I("price");
    		$data['createtime'] = time();
    	}
    	// 支付状态 1= 押金 2=租金
    	$type_status = I("type");
    	// 支付类型 1= 押金 2=租金
    	$pay_type = I("pay_type");
    	$Order_detil_id = I("id");
        // 统一支付支付订单号
        $pay_number = I('pay_number');
    	$this->assign("prices",I('price'));//押金价钱
    	$this->assign("time",date("YmdHis").rand(11111,99999));
    	//订单号
    	$diy_ordernumber = time();
    	// 统一使用支付接口
    	vendor('WxPayPubHelper.WxPayPubHelper');
    	$unfiedOrder = new \UnifiedOrder_pub();
    	// 设置统一支付接口的参数
    	$arr = explode(",",$Order_detil_id);
    	$prices_all = 0;
    	// 遍历id
    	foreach( $arr as $k=>$v ){
    		// 押金支付
    		if( $type_status == 1 ){
    			if( $pay_type == 2){
    				$order_data = D("Order_detil")->where(array("order_id"=>array("eq",$v)))->find();
                    // dump($order_data['order_deposit']);
    				$prices_all += I('price');
    				$unfiedOrder->SetParameter("body","押金支付");
                    $unfiedOrder->SetParameter("product_id",$Order_detil_id);//商品ID
                    $out_trade_no = date("YmdHis").rand(1000,9999);
    			}
    		// 租金支付
    		}else if( $type_status == 2 ){
    			if( $pay_type == 2 ){
    				$order_data = D("Order_detil")->where(array("order_id"=>array("eq",$v)))->find();
    				$prices_all += $order_data['order_rent'];
    				$unfiedOrder->SetParameter("body","租金支付");
                    $unfiedOrder->SetParameter("product_id",$Order_detil_id);//商品ID
                    $out_trade_no = date("YmdHis").rand(1000,9999);
    			}
            // 信用金支付
    		}else if(  $type_status == 3 ){ // 单个商品微信支付 按照商品的ID查询，进行支付
                $order_data = D("Order_detil")->where(array("order_id"=>array("eq",$v)))->find();
                $prices_all += $order_data['order_detill_xyj'];
                $unfiedOrder->SetParameter("body","首付信用金支付");
                $unfiedOrder->SetParameter("product_id",$Order_detil_id);//商品ID
                $out_trade_no = date("YmdHis").rand(1000,9999);
            }else if( $type_status == 4 ){ // 合并商品统一微信支付 按照合并商品的支付订单号查询，进行支付。
               if( $pay_type == 2 ){
                   $order_data =  D("Order_detil")->where(array("pay_number"=>array("eq",$pay_number)))->select();
                   foreach ($order_data as $key => $value) {
                     $datas[] = $value['order_detill_xyj']; // 合并商品 共计求和的信用金
                   }
                   $prices_all = array_sum($datas); // 支付金额
                   $unfiedOrder->SetParameter("body","首付信用金支付"); // 商品描述
                   $unfiedOrder->SetParameter("product_id",$pay_number);//商品ID 以统一支付单号为基准
                   $out_trade_no = $pay_number; // 支付订单号
               }
            }else if( $type_status == 5 ){ // 购买商品微信支付
                if( $pay_type == 2 ){
                    $order_data = D("Order_detil as orders")->where(array("order_id"=>array("eq",$v)))
                    ->join("left join plgox_cart as carts on carts.cart_id = orders.order_cart_id")
                    ->join("left join plgox_share as share on share.share_id = carts.cart_share_id")
                    ->find();
                    $prices_all+= I('price'); // 支付金额
                    $unfiedOrder->SetParameter("body","魄力餐厨-".$order_data['share_name']."-商品支付");
                    $unfiedOrder->SetParameter("product_id",$Order_detil_id);
                    $out_trade_no = date("YmdHis").rand(1000,9999);
                }
            }else if(  $type_status == 6 ){ //微信购买商品统一支付
                if( $pay_type == 2 ){
                   $order_data =  D("Order_detil")->where(array("pay_number"=>array("eq",$pay_number)))->select();
                   foreach ($order_data as $key => $value) {
                     $datas[] = $value['order_mm_prices']; // 合并商品 共计求和的信用金
                     $datas_number[] = $value['order_id'];
                   }
                   $prices_all = array_sum($datas); // 支付金额
                   $unfiedOrder->SetParameter("body","魄力餐厨-购买商品统一支付*".count($datas_number)); // 商品描述
                   $unfiedOrder->SetParameter("product_id",$pay_number);//商品ID 以统一支付单号为基准
                   $out_trade_no = $pay_number; // 支付订单号
               }

            }
    		if( !$order_data ){
    			$this->ajaxReturn(array("status"=>-2000,"message"=>"订单不存在!"));
    			return false;
    		}
    	}
    	// 金额处理
    	$prices_Handle = $prices_all;
    	if( $prices_Handle ){
    		$prices_Handle = $prices_Handle*100;
    	}else{
    		$prices_Handle = "1";
    	}
    	// 数据处理
    	$unfiedOrder->SetParameter("out_trade_no",$out_trade_no);//商户订单号
    	$unfiedOrder->SetParameter("total_fee",$prices_Handle);//支付金额
    	$unfiedOrder->SetParameter("time_start",date('YmdHis'));//交易起始时间
    	$unfiedOrder->SetParameter("time_expire",date('YmdHis',time()+600));//交易结束时间
    	$unfiedOrder->SetParameter("trade_type","NATIVE");//交易类型 扫码交易
    	$unfiedOrder->SetParameter("notify_url","http://www.weixin.qq.com/wxpay/pay.php");//异步接收微信支付结果通知的回调地址
    	// 获取统一的支付接口
    	$unifedOrderResult = $unfiedOrder->getResult();
    	// 商户根据实际的情况设置相应的处理流程
    	if( $unifedOrderResult['return_code'] ==  "FAIL" ){
    		echo "通信错误:".$unifedOrderResult['return_msg']."<br>";
    	}
    	else if( $unifedOrderResult['result_code'] == "FAIL")
    	{
    		echo "错误代码:".$unifedOrderResult['error_code']."<br>";
    		echo "错误代码描述:".$unifedOrderResult['err_code_des']."<br>";
    	}
    	else if( $unifedOrderResult['code_url'] != NULL )
    	{
    		$code_url = $unifedOrderResult['code_url'];
    	}

    	$this->assign("out_trade_no",$out_trade_no);
    	$this->assign("code_url",$code_url);
    	$this->assign("rmd",$prices_Handle); 
    	$pay_statue = $type_status."_".$pay_type;
    	$this->assign("pay_statue",$pay_statue);
    	$this->assign("id",$Order_detil_id);
    	$this->assign("userid",get_login_userid());
    	$this->assign("unifedOrderResult",$unifedOrderResult);
        $this->assign("setTitle","魄力餐厨-微信支付");
        $this->display('wechat');
    }
    // 查询订单
    public function OrderQuery() {
        // $this->ajaxReturn(I("pay_statue"));
    	$json = array();
    	// 退款的订单号
    	// empty(I("out_trade_no"))
    	$order_detil = I("out_trade_no");
    	if( !isset($order_detil) ){
    		$out_trade_no = "";
    	}else{
    		$out_trade_no = I('out_trade_no');
    		// 调用查询接口
    		vendor('WxPayPubHelper.WxPayPubHelper');
    		$orderQuery = new \OrderQuery_pub();
    		$orderQuery->SetParameter("out_trade_no",$out_trade_no);
    		// 获取订单查询的结果
    		$orderQueryResult = $orderQuery->getResult();
    		// $this->ajaxReturn($orderQueryResult);
    		// 通信标识 返回状态码
    		if( $orderQueryResult['return_code'] == "FAIL" ){
    			$this->ajaxReturn(array("status"=>-2001,"message"=>$out_trade_no));
    		}
    		// 返回业务结果 支付失败
    		else if( $orderQueryResult['result_code'] == "FAIL" ){
    			$this->ajaxReturn(array("status"=>-2002,"message"=>$out_trade_no));
    		}
    		else{
    			// 查看交易状态
    			switch ($orderQueryResult['trade_state']) {
    				case 'SUCCESS':
    					$id = I("id");//订单id
    					$order_memberuid = I("userid");//用户id
    					$pay_statue = explode("_", I('pay_statue'));
    					$type_status = $pay_statue[0];//支付类型 1=>押金 2=>租金 3=> 信用金
    					$pay_status = $pay_statue[1];//支付选择  微信支付
                        // 购买统一支付
                        if(  $type_status == 6 ){
                            if( $pay_status == 2 ){
                                $order_detil = D("Order_detil")->where(array("pay_number"=>array("eq",$out_trade_no)))->select();
                                if( !$order_detil ){
                                    return false;
                                }
                                foreach( $order_detil as $key=>$value ){
                                    if( $value['order_pay_status'] == 2 ){   
                                       return false;
                                    }else if( $value['order_pay_status'] == 1 ){
                                        $data = array(
                                            'order_id' => $value['order_id'],
                                            'order_pay_status' => 2,
                                            'order_pay_time' => time(),
                                            'order_pay_type' => 1,
                                            'order_status' => 1,
                                        );
                                        $resl_save = D("Order_detil")->save($data);
                                    }
                                }
                            }
                        }
                        // 购买商品支付
                        if( $type_status == 5 ){
                            if( $pay_status == 2 ){
                                $order_detil = D("Order_detil")->where(array("order_id"=>array("eq",$id)))->find();
                                if( !$order_detil ){ // 判断订单是否存在
                                    return false;
                                }
                                if( $order_detil['order_pay_status'] == 2 ){ // 判断当前的支付状态 如果等于2 等于已经支付
                                    return false;
                                }else if( $order_detil['order_pay_status'] == 1 ){ // 等于1 等于未支付 进行订单更改
                                    $data = array(
                                        'order_id' => $id,
                                        'order_pay_status' => 2,
                                        'order_pay_type' => $pay_status,
                                        'order_weixin_number' => $out_trade_no,
                                        'order_status' => 1,
                                        'order_pay_time' => time()
                                    );
                                   $res_saves =  D("Order_detil")->save($data);
                                }
                            }
                        }
                        // 统一信用金支付
                        if( $type_status == 4 ){
                            if( $pay_status == 2 ){
                                $order_detil = D("Order_detil")->where(array("pay_number"=>array("eq",$out_trade_no)))->select();
                                if( !$order_detil ){
                                    return false;
                                }
                                foreach( $order_detil as $key=>$value ){
                                    if( $value['order_xyj_status'] == 2 ){   
                                       return false;
                                    }else if( $value['order_xyj_status'] == 1 ){
                                        $data = array(
                                            'order_id' => $value['order_id'],
                                            'order_xyj_status' => 2,
                                            'order_status' => 1,
                                            'order_weixin_xyj_number' => $out_trade_no,
                                            'order_xyj_pay_time' => time(),
                                        );
                                        $res_save = D("Order_detil")->save($data);
                                    }
                                }
                            }
                        }
                        // 信用金
                        if( $type_status == 3  ){
                            if( $pay_status == 2 ){
                               $order_detil = D("Order_detil")->where(array("order_id"=>array("eq",$id)))->find();
                               if( !$order_detil ){
                                 return false;
                               }
                               if( $order_detil['order_xyj_status'] == 2 ){
                                 return false;
                               }else if( $order_detil['order_xyj_status'] == 1 ){ // 更改信用金状态，首次支付信用金
                                 $data = array(
                                    'order_id' => $id,
                                    'order_xyj_status' => 2,
                                    'order_status' => 1,
                                    'order_weixin_xyj_number' => $out_trade_no,
                                    'order_xyj_pay_time' => time(),
                                 );
                                 $res_save = D("Order_detil")->save($data);
                               }
                            }
                        }
    					// 押金回调
    					if( $type_status == 1 ){
    						if( $pay_status == 2 ){
    							$order_detil = D("Order_detil")->where(array("order_id"=>array("eq",$id)))->find();
    							if( !$order_detil ){
    								return false;
    							}
    							if( $order_detil['order_pay_status'] == 2 ){
    								return false;
    							}
    							// 更改押金订单的状态 首次支付
    							if( $order_detil['order_pay_status'] == 1 ){
    								$data = array(
    									'order_id' => $id,
    									'order_pay_status' => 2,
                                        'order_pay_type' => $pay_status,
                                        'order_weixin_number' => $out_trade_no,
                                        'order_status' => 5,
    									'order_pay_time' => time()
    								);
    								$res_save = D("Order_detil")->save($data);
                                    if( !empty($res_save) ){
                                        $times = strtotime(date('Y-m-d',strtotime("+1 day",time())));
                                        $rank_time = strtotime(date("Y-m".'-1'));
                                        $zujin_number = date("Ymd").mt_rand(111111,999999);
                                        zujin_data($order_detil['order_id'],$order_detil['order_rent'],1,strtotime(date('Y-m'.'-5')),get_login_userid(),time(),$times,$rank_time,$order_detil['order_shangjia_id'],$zujin_number);
                                    }
    							}
    							// 逾期支付
    							if( $Order_detil['order_pay_status'] == 3 ){
    								$data = array(
    									"order_id" => $id,
                                        'order_status' => 5,
                                        'order_pay_type' => $pay_status,
                                        'order_weixin_number' => $out_trade_no,
    									"order_pay_status" => 4,
    									"order_pay_time" => time(),
    								);
    								$res_save = D("Order_detil")->save($data);
                                    if( !empty($res_save) ){
                                        $times = strtotime(date('Y-m-d',strtotime("+1 day",time())));
                                        $rank_time = strtotime(date("Y-m".'-1'));
                                        $zujin_number = date("Ymd").mt_rand(111111,999999);
                                        zujin_data($order_detil['order_id'],$order_detil['order_rent'],1,strtotime(date('Y-m'.'-5')),get_login_userid(),time(),$times,$rank_time,$order_detil['order_shangjia_id'],$zujin_number);
                                    }
    							}
    						}
    					}
    					// 租金回调
    					if( $type_status == 2 ){
    						if( $pay_status == 2 ){
    							$order_list = D("Order_detil")->where(array("order_id"=>array("eq",$id)))->find();
                                if( $order_list['order_pay_status'] == 2 || $order_list['order_pay_status'] == 3 ){
                                    return false;
                                }
                                $arr = explode(",", $id);
                                foreach( $arr as $key => $val ){
                                    // 更改订单数据表，并且添加租金表数据
                                    $data = array(
                                        'order_id' => $id,
                                        'order_pay_status' => 2,
                                        'order_pay_time' => time()
                                    );
                                    $res_save = D("Order_detil")->where(array("order_id"=>$v,"order_pay_status"=>1))->save($data);
                                    // 做查询
                                    $result_order = D("Order_detil")->where(array("order_id"=>array("eq",$v)))->find();
                                    $cart_id = D("Cart")->where(array("cart_id"=>array("eq",$result_order['order_cart_id'])))->find();
                                    // 首次顺利支付查询的支付状态
                                    if( $result_order['order_pay_status'] == 2 ){
                                        // 销量加一
                                       $res_save =  D("Share")->where(array("share_id"=>$cart_id['cart_share_id']))->setInc("share_volume");
                                    }
                                    // 首次逾期支付后查询的支付状态
                                    if( $result_order['order_pay_status'] == 4 ){
                                        // 销量加一
                                        $res_save = D("Share")->where(array("share_id"=>$cart_id['cart_share_id']))->setInc("share_volume");
                                    }
                                }
    						}
    					}
                        // 支付后的状态
                        if( $res_save ){
                             $this->ajaxReturn(array("status"=>2000,"message"=>"支付成功"));
                             return false;
                        }else if( $res_saves ){// 购买商品支付后的状态
                             $this->ajaxReturn(array("status"=>2001,"message"=>"支付成功"));
                             return false;
                        }else if( $resl_save ){
                             $this->ajaxReturn(array("status"=>2004,"message"=>"支付成功"));
                             return false;
                        }else{
                             $this->ajaxReturn(array("status"=>-2003,"message"=>"支付失败"));
                             return false;
                        }
    				break;
    				case "REFUND":
                        $this->ajaxReturn(array("status"=>-2004,"message"=>"转入退款中!".time()));
                    break;
                    case "NOTPAY":
                        $this->ajaxReturn(array("status"=>-2005,"message"=>"当前订单还未支付,等待支付中!".time()));
                    break;
                    case "CLOSED":
                        $this->ajaxReturn(array("status"=>-2006,"message"=>"支付失败,订单已被关闭!".time()));
                    break;
                    case "REVOKED":
                        $this->ajaxReturn(array("status"=>-2007,"message"=>"订单已被撤销,支付失败!".time()));
                    break;
                    case "USERPAYING":
                        $this->ajaxReturn(array("status"=>-2008,"message"=>"用户支付中,请稍后!".time()));
                    break;
                    case "PAYERROR":
                        $this->ajaxReturn(array("status"=>-2009,"message"=>"支付失败".$orderQueryResult['trade_state']));
                    break;
    				default:
    				    $this->ajaxReturn(array("status"=>-2009,"message"=>"未知失败".$orderQueryResult['trade_state']));
    				break;
    			}
    		}
    	}
    }
    // 企业银联支付
    public function yinlian() {
         // 商品价格
        $prices = I("price");
         //接收订单id
        $orderid = I("id");
        // 支付type 选中判断  1押金 / 2租金
        $pay_type = I("pay_type");
        // 判断属于那个支付类型 1 支付宝 2 微信 3 银联
        $type = I("type");
        //计算总价钱.
        $arr = explode(',',$orderid);
        $price_all =0;
        foreach($arr as $k=>$v){
            //押金
            if($type == 1){
                $bao =  D("Order_detil")->where(array("order_id"=>$v))->find();
                $price_all += $bao['order_deposit'];
                if(doubleval($bao["order_deposit"])<=0){
                    $this->error("订单金额不能为0",U('User/my_dingdan'));
                }
            }
            // 租金
            if($type == 2){
                $bao =  D("Zujin")->where(array("zujin_oid"=>$v))->find();
                $price_all = $bao['zujin_prices'];
                if(doubleval($bao["zujin_prices"])<=0){
                    $this->error("订单金额不能为0",U('User/my_dingdan'));
                }
            }
            if(!$bao){
                $this->error("订单不存在",U('User/my_dingdan'));
            }

        }
        // 判断支付类型是租金还是押金
        if( $type == 1 ){
            $title = '共享押金支付';
        }else if($type == 2){
            $title = '共享租金支付';
        }
        $orderSn =mt_rand(1111111111111111,9999999999999999);// 银联的orderId  需要16位字符 支付宝的order_sn没有限制
        $data=array(
            'orderSn'  => $orderSn,  // 商家订单号 必填
            'orderName'=>$title,     // 订单名称    必填
            'orderFee' =>$price_all,       // 付款金额  必填 $price_all
            'body'     =>$orderid,         //订单描述
            'showUrl'  =>'',         // 商品展示地址
            'backUrl' => "http://".$_SERVER["HTTP_HOST"]."/Pay/tongzhi/type/".$type."/orderid/".$orderid //后台通知地址
        );
        //跳转银联支付
        $pay = A('Home/Ypay');
        $pay->usespay_qiye($data);
    }
    //通知
    function  tongzhi(){
        file_put_contents('dingdan.txt', json_encode($_GET), FILE_APPEND);
        $orderid = $_GET['orderid'];
        $type = $_GET['type'];
        file_put_contents('dingdan.txt', json_encode($_GET['orderiid']), FILE_APPEND);
        $id=explode(',',$orderid);
        //押金回调
        if($type == 1){
            $didzong = D("Order_detil")->where(array("order_id" =>array("eq",$orderid)))->find();
            if (!$didzong) {
                return false;
            }
            if ( $didzong["order_pay_status"] == 2 || $didzong["order_pay_status"] == 3 ) {
                return false;
            }
            if( $didzong['order_pay_status'] == 1 ){
               $res =  D("Order_detil")->where(array("order_id"=>array("eq",$orderid)))->save(array("order_pay_status"=>2,"order_pay_time"=>time()));
               if( $res ){
                    $times = strtotime(date('Y-m-d',strtotime("+1 day",time())));
                    zujin_data($order_detil['order_id'],$order_detil['order_rent'],1,strtotime(date('Y-m'.'-5')),get_login_userid(),time(),$times,$rank_time,$order_detil['order_shangjia_id']);
               }
            }
            if($didzong['order_pay_status'] == 3){
                $res = D("Zujin")->where(array("order_id" => $orderid))->save(array("order_pay_status" => 4, "order_pay_time" => time()));
                if( $res ){
                    $times = strtotime(date('Y-m-d',strtotime("+1 day",time())));
                    zujin_data($order_detil['order_id'],$order_detil['order_rent'],1,strtotime(date('Y-m'.'-5')),get_login_userid(),time(),$times,$rank_time,$order_detil['order_shangjia_id']);
                }
            }
            foreach( $id as $k=>$v ){
                //销售量加1
                $dingdan = D("Order_detil")->where(array("order_id" => $v))->find();
                $good = D("Cart")->where(array("cart_id" => $dingdan['order_cart_id']))->find();

                if ( $dingdan['order_pay_status'] == 2 || $dingdan['order_pay_status'] == 4 ) {
                    D("Share")->where(array("share_id" => $good['cart_share_id']))->setInc('share_chuzhu');
                    // D("Share")->where(array("id" => $good['goodid']))->setDec('kucun');
                }
            }
        }
        //租金回调
        if($type == 2){
            $didzong = D("Zujin")->where(array("zujin_oid" => $orderid))->find();
            if (!$didzong) {
                return false;
            }
            if ( $didzong["zujin_pay_status"] == 2 ||  $didzong["zujin_pay_status"] == 4 ) {
                return false;
            }
            //更改订单状态
            foreach ($id as $k=>$v){
                $r = D("Zujin")->where(array("zujin_oid" => $v, "zujin_pay_status" => 1))->save(array("zujin_pay_status" => 2, "zujin_pay_time" => time()));
            }
            file_put_contents('dingdan.txt','chenggo', FILE_APPEND);
        }
    }
    // 支付失败
    public  function error() {
        var_dump("Pay Error：Dear user, Hello, your current payment failure, please pay again!");
    }
    // 银联对公账号
    public function ylpay() {
        $this->assign("setTitle","企业公对公银行账户信息");
        $this->display("ylpay");
    }
}