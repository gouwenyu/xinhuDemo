<?php
namespace Home\Controller;
use Think\Controller;
class UploadfilesController extends CommonController{
	// 上传接口 
	public function index(){
		if( empty(I('get.')) ){ // 如果直接通过url链接访问话，没有进行扫码，不让其进行发布图片！ 
			echo "<script>alert('请进入网站进行登录后方可扫码上传！');location='http://www.plgox.com/index'</script>";
		}else{
			$this->assign("token",I("token"));//token
			$this->assign("status_keys",I("status_keys"));//status 属于那个板块 1 = 商户扫码 2 = 认证扫码
		}
		$this->display("index");
	}
	public function ajaxUpload(){
		$redis = new \Redis();
	    $redis->connect('127.0.0.1',6379);
	    // 图片压缩
	    $image = new \Think\Image();
		if( I('get.status_keys') == 1 ){ // 商户扫码上传
			// 图片上传
			$config = array(
				'maxSize'    =>    10485760,
				'rootPath'   =>    './Uploads/admin/',
				'saveName' =>    array('uniqid',''),
				'exts'     =>    array("bmp","jpg","jpeg","gif","png"),
			);
			$upload = new \Think\Upload($config);
			$info   =   $upload->upload();
			if( !$info ){
				$this->ajaxReturn(array("status"=>-2000,"message"=>$upload->getError()));
			}else{
			    $code = $info['file']['savepath'].$info['file']['savename'];
			    // 图片压缩
				$image->open('./Uploads/admin/'.$code);
				$image->thumb(180,180,\Think\Image::IMAGE_THUMB_FILLED)->save('./Uploads/admin/'.$code);
				// 插入redis缓存当中;时间与图片路径拼接
				$url_code = time().",".$code;
				// $redis->lpush("image_path",$code);
				$redis->lpush(I("get.token"),$url_code);
			    $this->ajaxReturn(array("status"=>2000,"message"=>"成功"));
			}
		}else if( I('get.status_keys') == 2 ){ // 认证扫码上传
			// 图片上传
			$config = array(
				'maxSize'    =>    10485760,
				'rootPath'   =>    './Uploads/home_renzheng_img/',
				'saveName' =>    array('uniqid',''),
				'exts'     =>    array("bmp","jpg","jpeg","gif","png"),
			);
			$upload = new \Think\Upload($config);
			$info   =   $upload->upload();
			if( !$info ){
				$this->ajaxReturn(array("status"=>-2000,"message"=>$upload->getError()));
			}else{
			    $code = $info['file']['savepath'].$info['file']['savename'];
			    // token拼接图片路径进入redis
			    $code_url = I("get.token").",".time().",".$code;
			    // 图片压缩
				$image->open('./Uploads/home_renzheng_img/'.$code);
				$image->thumb(180,180,\Think\Image::IMAGE_THUMB_FILLED)->save('./Uploads/home_renzheng_img/'.$code);
				// 插入redis缓存当中
				$redis->lpush("image_rz_path",$code_url);
			    $this->ajaxReturn(array("status"=>2000,"message"=>"成功"));
			}
		}else if( I('get.status_keys') == 3 ){ // 二手闲置扫码传图
			$config = array(
				'maxSize'    =>    10485760,
				'rootPath'   =>    './Uploads/admin/',
				'saveName' =>    array('uniqid',''),
				'exts'     =>    array("bmp","jpg","jpeg","gif","png"),
			);
			$upload = new \Think\Upload($config);
			$info = $upload->upload();
			if(!$info){
				$this->ajaxReturn(array("status"=>-2000,"message"=>$upload->getError()));
			}else{
				// 路径
				$code = $info['file']['savepath'].$info['file']['savename'];
				// token 拼接 路径
				$code_url = I('get.token').','.$code;
				// 图片处理
				$image->open("./Uploads/admin/".$code);
				$image->thumb(180,180,\Think\Image::IMAGE_THUMB_FILLED)->save("./Uploads/admin/".$code);
				// 存入缓存当中
				// redis key
				$keys = I('get.token').','.I('get.status_keys');
				$redis->lpush($keys,$code_url);
				$this->ajaxReturn(array("status"=>2000,"message"=>"成功"));
			}
		}
	}
	// 缓存图片删除
	public  function ajaxDlelect() {
		// session['xxxxx',I()]
	}
}
?>