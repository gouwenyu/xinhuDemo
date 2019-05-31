<?php
namespace Home\Controller;
use Think\Controller;

class YpayController extends Controller
{
    /**
     * 支付配置
     * @var array  银联5.0以上的支付。需要证书。靠
     */
    public $config = array();
    /**
     * 支付参数，提交到银联对应接口的所有参数
     * @var array
     */
    public $params = array();
    /**
     * 自动提交表单模板
     * @var string
     */
    private $formTemplate = <<<HTML
        <!DOCTYPE HTML>
        <html>
        <head>
                <meta charset="utf-8">
                <title>支付</title>
        </head>
        <body>
                <div style="text-align:center">跳转中...</div>
                <form id="pay_form" name="pay_form" action="%s" method="post">
                        %s
                </form>
                <script type="text/javascript">
                        document.onreadystatechange = function(){
                                if(document.readyState == "complete") {
                                        document.pay_form.submit();
                                }
                        };
                </script>
        </body>
        </html>
HTML;
    
    
    function usespay($upresult){
        $this->config = C('UNIONPAY');//上面的配置
        $config = C('UNIONPAY_CONFIG');
        $config['certId']  = $this->getSignCertId(); //证书ID
        $config['orderId'] = $upresult['orderSn'];
        $config['txnAmt']  = $upresult['orderFee']*100; //交易金额，单位分
        $config['backUrl'] = $upresult['backUrl'];
		$this->params = $config;
		$html = $this->createPostForm();
        echo $html;
    }

    function usespay_qiye($upresult){
        $this->config = C('UNIONPAYS');//上面的配置
        $config = C('UNIONPAY_CONFIGS');
        $config['certId']  = $this->getSignCertId(); //证书ID
        $config['orderId'] = $upresult['orderSn'];
        $config['txnAmt']  = $upresult['orderFee']*100; //交易金额，单位分
        $config['backUrl'] = $upresult['backUrl'];
        $this->params = $config;
        $html = $this->createPostForm();
        echo $html;
    }
    function usernotify(){// 付款后返回商家
        file_put_contents('1231123.txt', 'qweeqweqweqwe', FILE_APPEND);
//        $this->orderPay(I('post.'),2);
        $data = I('post.');
        if($data['respCode'] == '00'){
            return true;
        }else{
            return  false;
        }
		/*付款后业务逻辑代码  */
    }
    function notify(){
        $filename = 'Log/yapy';        
        file_put_contents($filename.'/'.I('post.orderId').'.txt', json_encode($_POST), FILE_APPEND);
    }
    function unionpayfail(){
        
    }
    function orderPay($orderinfo,$state){
        file_put_contents($orderinfo['orderId'].'.txt', json_encode($_POST), FILE_APPEND);
        $order = D('dingdan');
//        $payment = D('payment');
        $where['order_sn'] = array('in', array($orderinfo['orderId']));
        $orinfo = $order->where($where)->find();
        
//        $rs = $payment->where($where)->find();
        if (empty($rs) && $orinfo['order_state'] < 2 ) {
            $where1['udb_user.user_id'] = array('eq', session('id'));
            $userinfo1 = json_decode(req_api("api_key", C("API_KEY"), C('USER_API') ."user/api/GetSomeuser/", array('where' => json_encode($where1))), true);
            $data1['order_state'] = (int) $state;
            $orderwhere['order_sn'] = array('in', array($orderinfo['orderId']));

            $order->where($orderwhere)->save($data1);

            if($orinfo['balance'] >0 && $orinfo['isblance'] == 1){
                if($userinfo1[0]['balance']-$orinfo['balance']>=0){
                    $total1 = $total1-$data['balance'];
                    $istrue = req_api("api_key", C("API_KEY"), C('USER_API') . "user/api/removeBalance/", array('user' =>session('id'),'count'=>$orinfo['balance'],'type'=>'d'));
                    $this->BanlanceRecord(2,$orinfo['balance'],'购物消费',session('id'));
                }
            }
            if ($orinfo['jindou'] >0 && $orinfo['isjindou'] == 1) {
                if($userinfo1[0]['user_wealth']-$orinfo['jindou']>=0){
                    $istrue = req_api("api_key", C("API_KEY"), C('USER_API') . "user/api/AddJindou/", array('user' =>session('id'),'count'=>$orinfo['jindou'],'type'=>'d'));
                    $this->ChangeRecord(2,$orinfo['jindou'],'购物抵消',session('id'));
                    $total1 = $total1-($orinfo['jindou']/100);
                }
            }
            $data['order_sn'] = $orderinfo['orderId'];
            $data['buyer_id'] = $orderinfo['certId'];
            $data['buyer_user'] = '银联支付';
            $data['is_success'] = 'T';
            $data['notify_time'] = substr($orderinfo['txnTime'],0,4)."-".substr($orderinfo['txnTime'],4,2).'-'.substr($orderinfo['txnTime'],6,2).' '.substr($orderinfo['txnTime'],8,2).':'.substr($orderinfo['txnTime'],10,2).':'.substr($orderinfo['txnTime'],12,2);
            $data['trade_no'] = $orderinfo['queryId'];
            $data['seller_id'] = $orderinfo['merId'];
            $data['total_fee'] = $orderinfo['txnAmt']*100;
            $data['sign'] = $orderinfo['signature'];
            $data['user_id'] = $orinfo['user_id'];
            $data['order_state'] = (int) $state;
            $data['status'] = 0;
            var_dump($data);

//            $payment->data($data)->filter('strip_tags')->add();
        }

        
//        $record = A('Shop/Orderrecord');
//        $shuju['order_state'] = (string) $state;
//        $shuju['action_user_id'] = session('id');
//        $shuju['action_descrption'] = $type.'支付宝付款' . $orinfo['payable_total'];
//        $record->ChangeOrderRecords($orinfo['_id'], $shuju);
//        $orderrecord = A('Shop/Order');
//        $orderrecord->CashMoneyRecord(2, $orinfo['payable_total'], '购物消费--订单(' . $orderinfo['out_trade_no'] . ')', session('id'));
//        layout(false);
//        $this->assign('orderinfo', $orinfo);
//        $this->display('Order:PaySuccess6');
    }
    
    /**
    * 构建自动提交HTML表单
    * @return string
    */
    public function createPostForm()
    {
        
        $this->params['signature'] = $this->sign();
        $input = '';
        foreach($this->params as $key => $item) {
                $input .= "\t\t<input type=\"hidden\" name=\"{$key}\" value=\"{$item}\">\n";
        }
        return sprintf($this->formTemplate, $this->config['frontUrl'], $input);
    }
    /**
    * 验证签名
    * 验签规则：
    * 除signature域之外的所有项目都必须参加验签
    * 根据key值按照字典排序，然后用&拼接key=value形式待验签字符串；
    * 然后对待验签字符串使用sha1算法做摘要；
    * 用银联公钥对摘要和签名信息做验签操作
    *
    * @throws \Exception
    * @return bool
    */
    public function verifySign()
    {
        $publicKey = $this->getVerifyPublicKey();
        $verifyArr = $this->filterBeforSign();
        ksort($verifyArr);
        $verifyStr = $this->arrayToString($verifyArr);
        $verifySha1 = sha1($verifyStr);
        $signature = base64_decode($this->params['signature']);
        $result = openssl_verify($verifySha1, $signature, $publicKey);
        if($result === -1) {
                throw new \Exception('Verify Error:'.openssl_error_string());
        }
        return $result === 1 ? true : false;
    }
    /**
    * 取签名证书ID(SN)
    * @return string
    */
    public function getSignCertId()
    {   

        return $this->getCertIdPfx($this->config['signCertPath']);
    }  
    /**
    * 签名数据
    * 签名规则:
    * 除signature域之外的所有项目都必须参加签名
    * 根据key值按照字典排序，然后用&拼接key=value形式待签名字符串；
    * 然后对待签名字符串使用sha1算法做摘要；
    * 用银联颁发的私钥对摘要做RSA签名操作
    * 签名结果用base64编码后放在signature域
    *
    * @throws \InvalidArgumentException
    * @return multitype|string
    */
    private function sign() {
        $signData = $this->filterBeforSign();
        ksort($signData);
        $signQueryString = $this->arrayToString($signData);
        if($this->params['signMethod'] == 01) {
                //签名之前先用sha1处理
                //echo $signQueryString;exit;
                $datasha1 = sha1($signQueryString);
                $signed = $this->rsaSign($datasha1);
        } else {
                throw new \InvalidArgumentException('Nonsupport Sign Method');
        }
        return $signed;
    }
    /**
    * 数组转换成字符串
    * @param array $arr
    * @return string
    */
    private function arrayToString($arr)
    {
        $str = '';
        foreach($arr as $key => $value) {
                $str .= $key.'='.$value.'&';
        }
        return substr($str, 0, strlen($str) - 1);
    }
    /**
    * 过滤待签名数据
    * signature域不参加签名
    *
    * @return array
    */
    private function filterBeforSign()
    {
        $tmp = $this->params;
        unset($tmp['signature']);
        return $tmp;
    }
    /**
    * RSA签名数据，并base64编码
    * @param string $data 待签名数据
    * @return mixed
    */
    private function rsaSign($data)
    {
        $privatekey = $this->getSignPrivateKey();
        $result = openssl_sign($data, $signature, $privatekey);
        if($result) {
                return base64_encode($signature);
        }
        return false;
    }
    /**
    * 取.pfx格式证书ID(SN)
    * @return string
    */
    private function getCertIdPfx($path)
    {
//        $data = fopen($path);
        $pkcs12certdata = file_get_contents($path);
        openssl_pkcs12_read($pkcs12certdata, $certs, $this->config['signCertPwd']);
        $x509data = $certs['cert'];
        openssl_x509_read($x509data);
        $certdata = openssl_x509_parse($x509data);
        return $certdata['serialNumber'];
    }
    /**
    * 取.cer格式证书ID(SN)
    * @return string
    */
    private function getCertIdCer($path)
    {
        $x509data = file_get_contents($path);
        openssl_x509_read($x509data);
        $certdata = openssl_x509_parse($x509data);
        return $certdata['serialNumber'];
    }
    /**
    * 取签名证书私钥
    * @return resource
    */
    private function getSignPrivateKey()
    {
        $pkcs12 = file_get_contents($this->config['signCertPath']);
        openssl_pkcs12_read($pkcs12, $certs, $this->config['signCertPwd']);
        return $certs['pkey'];
    }
    /**
    * 取验证签名证书
    * @throws \InvalidArgumentException
    * @return string
    */
    private function getVerifyPublicKey()
    {
        //先判断配置的验签证书是否银联返回指定的证书是否一致
        if($this->getCertIdCer($this->config['verifyCertPath']) != $this->params['certId']) {
                throw new \InvalidArgumentException('Verify sign cert is incorrect');
        }
        return file_get_contents($this->config['verifyCertPath']);      
    }
}   