<?php
namespace App\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('App');
    }
}
