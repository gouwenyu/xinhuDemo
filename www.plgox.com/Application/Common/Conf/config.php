<?php
if( $_SERVER['HTTP_HOST'] == "localhost" ){
	$conf =  array(
		//'配置项'=>'配置值'
		'DB_TYPE'               =>  'mysql',     // 数据库类型
		'DB_HOST'               =>  'localhost', // 服务器地址
		'DB_NAME'               =>  'plgoxbg',          // 数据库名
		'DB_USER'               =>  'root',      // 用户名
		'DB_PWD'                =>  'root',          // 密码
    );
}else{
	$conf =  array(
		//'配置项'=>'配置值'
		'DB_TYPE'               =>  'mysql',     // 数据库类型
		'DB_HOST'               =>  'localhost', // 服务器地址
		'DB_NAME'               =>  'plgoxbg',          // 数据库名
		'DB_USER'               =>  'root',      // 用户名
		'DB_PWD'                =>  'wuxianpoli2017',          // 密码
    );
}
// 数据库配置
$config =  array(
	'DB_PORT'               =>  '3306',       // 端口
	'DB_PREFIX'             =>  'plgox_',    // 数据库表前缀
	'SHOW_PAGE_TRACE' 		=>   true,	//显示页面Trace
	'URL_MODEL'				=>  '2', //路径
	'MODULE_ALLOW_LIST'  => array('Home','Admin','App',''),
	'DEFAULT_MODULE' => 'Home',
	'LOAD_EXT_FILE'=>   "mobile_email,zhifubao_pay,duanxin_template", //函数扩展
	
	'LOG_RECORD'            =>  true,   // 默认不记录日志
	'LOG_TYPE'              =>  'File', // 日志记录类型 默认为文件方式
	'LOG_LEVEL'             =>  'EMERG,ALERT,CRIT,ERR',// 允许记录的日志级别
	'LOG_EXCEPTION_RECORD'  =>  true,    // 是否记录异常信息日志
    //redis配置
    'DATA_CACHE_PREFIX' => 'Redis_',//缓存前缀
    'DATA_CACHE_TYPE'=>'Redis',//默认动态缓存为Redis
    'REDIS_RW_SEPARATE' => true, //Redis读写分离 true 开启
    'REDIS_HOST'=>'127.0.0.1;101.200.50.113', //redis服务器ip，多台用逗号隔开；读写分离开启时，第一台负责写，其它[随机]负责读；
    'REDIS_PORT'=>'6379',//端口号
    'REDIS_TIMEOUT'=>'300',//超时时间
    'REDIS_PERSISTENT'=>false,//是否长连接 false=短连接
    'REDIS_AUTH'=>'',//AUTH认证密码
	// 银联配置
	'UNIONPAY' => array(
        // 银联配置
        //正式环境参数
        'frontUrl' => 'https://gateway.95516.com/gateway/api/frontTransReq.do', //前台交易请求地址
        'singleQueryUrl' => 'https://gateway.95516.com/gateway/api/queryTrans.do', //单笔查询请求地址
        'signCertPath' =>getcwd().'/Public/cer/PM_898111957120274_acp.pfx', //签名证书路径
        'signCertPwd' => '201706', //签名证书密码
        'verifyCertPath' => getcwd().'/Public/cer/verify_sign_acp.cer.cer', //验签证书路径
        'merId' => '898111957120274', //商户代码
    ),
    'UNIONPAYS' => array(
        // 银联配置
        //正式环境参数
        'frontUrl' => 'https://gateway.95516.com/gateway/api/frontTransReq.do', //前台交易请求地址
        'singleQueryUrl' => 'https://gateway.95516.com/gateway/api/queryTrans.do', //单笔查询请求地址
        'signCertPath' =>getcwd().'/Public/cer/PM_898111949000297_acp.pfx', //签名证书路径
//        'signCertPath' =>getcwd().'/Public/cer/acp_test_sign.qiye.p12', //签名证书路径
        'signCertPwd' => '201706', //签名证书密码
        'verifyCertPath' => getcwd().'/Public/cer/verify_sign_acp_qiye.cer', //验签证书路径
//        'verifyCertPath' => getcwd().'/Public/cer/verify_sign_acp.qiye.cer', //验签证书路径
        'merId' => '898111949000297', //商户代码
    ),
    'UNIONPAY_CONFIGS'=>array(// 银联配置
        'version' => '5.0.0', //版本号
        'encoding' => 'GBK', //编码方式
        'signMethod' => '01', //签名方式
        'txnType' => '01', //交易类型
        'txnSubType' => '01', //交易子类
        'bizType' => '000202', //产品类型
        'channelType' => '08',//渠道类型
        'frontUrl' => "http://".$_SERVER["HTTP_HOST"]."/User/my_dingdan", //前台通知地址
        'frontFailUrl' => "http://".$_SERVER["HTTP_HOST"]."/Pay/error", //失败交易前台跳转地址
        'accessType' => '0', //接入类型
        'merId' => '898111949000297', //商户代码
        'txnTime' => date('YmdHis'), //订单发送时间
        'currencyCode' => '156', //交易币种
    ),
    'UNIONPAY_CONFIG'=>array(// 银联配置
        'version' => '5.0.0', //版本号
        'encoding' => 'GBK', //编码方式
        'signMethod' => '01', //签名方式
        'txnType' => '01', //交易类型
        'txnSubType' => '01', //交易子类
        'bizType' => '000201', //产品类型
        'channelType' => '08',//渠道类型
        'frontUrl' => "http://".$_SERVER["HTTP_HOST"]."/User/my_dingdan", //前台通知地址
        'frontFailUrl' => "http://".$_SERVER["HTTP_HOST"]."/Pay/error", //失败交易前台跳转地址
        'accessType' => '0', //接入类型
        'merId' => '898111957120274', //商户代码
        'txnTime' => date('YmdHis'), //订单发送时间
        'currencyCode' => '156', //交易币种
    ),
);
 return array_merge($config,$conf);