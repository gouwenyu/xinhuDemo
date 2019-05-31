<?php  
/**
 * @param 后台扩展公共类
 */
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
	public function _initialize() {
		// 欢迎页面配置文件
		$config = array(
			"服务器IP地址"		=> $_SERVER['SERVER_NAME'],
			"服务器域名"			=> $_SERVER['HTTP_HOST'],
			"服务器端口"			=> $_SERVER['SERVER_PORT'],
			"服务器系统目录"		=> $_SERVER['DOCUMENT_ROOT'],
			"服务器操作系统" 		=> PHP_OS,
			"服务器脚本超时时间"	=> date_default_timezone_set("PRC"),
			"服务器的语言种类"		=> $_SERVER['HTTP_ACCEPT_LANGUAGE'],
			"PHP版本"			=> PHP_VERSION,
			"服务器当前时间"		=> date("Y年n月j日 H:i:s"),
			"系统类型及版本号"		=> php_uname(),
			"PHP运行方式"			=> php_sapi_name(),
			"PHP安装路径"			=> DEFAULT_INCLUDE_PATH,
			"文件绝对路径"		=> __FILE__,
			"客户端IP"			=> $_SERVER['REMOTE_ADDR'],
			"CPU数量"			=> $_SERVER['PROCESSOR_IDENTIFIER'],
			"通信协议的名称和版本"	=> $_SERVER['SERVER_PROTOCOL'],
			"服务器Web端口"		=> $_SERVER['SERVER_PORT'],
			'剩余空间'			=> round((disk_free_space(".")/(1024*1024)),2).'M',
			'上传附件限制'		=> ini_get('upload_max_filesize'),
 			'执行时间限制'		=> ini_get('max_execution_time').'秒',
 			'ThinkPHP版本'		=> THINK_VERSION.' [ <a href="http://thinkphp.cn" target="_blank">查看最新版本</a> ]',
 			'运行环境'			=> $_SERVER["SERVER_SOFTWARE"],
 			'register_globals'	=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
 			'magic_quotes_gpc'	=>(1===get_magic_quotes_gpc())?'YES':'NO',
 		  'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
		);
		$this->assign("config",$config);
		$loginumber = D("Member")->where(array("plgox_id"=>$_SESSION['plgox_user']['plgox_id']))->find();
		// 统计前端用户 or  后端管理用户
		$admin_user_count = D('Member')->where(array('plgox_usertype'=>array('in','0,1,2')))->count();
		$home_user_count  = D('Member')->where(array('plgox_usertype'=>array('in','3,4')))->count();
		$this->assign("loginumber",$loginumber);
		$this->assign("admin_user_count",$admin_user_count);
		$this->assign("home_user_count",$home_user_count);
	}
}
?>