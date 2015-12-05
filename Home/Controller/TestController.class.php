<?php

/**
* 
*/
namespace Home\Controller;
use Think\Controller;
use Home\Model\Users;
/**
* 
*/
class TestController extends Controller;
{
	public function index(){

		$userModel = new Users();
		$this->assign('name','13');
		$this->display();
	}
}
?>