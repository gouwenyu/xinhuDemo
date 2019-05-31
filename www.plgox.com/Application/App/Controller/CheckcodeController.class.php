<?php  
namespace App\Controller;
use Think\Controller;
class CheckcodeController extends Controller {
	function checkcode() {
		$Verify = new \Think\Verify();
		$Verify->codeSet = '0123456789'; 
		$Verify->length = 4;
		$Verify->entry();
	}
}
?>
