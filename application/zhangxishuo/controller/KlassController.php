<?php
namespace app\zhangxishuo\controller;
use app\zhangxishuo\model\Klass;
use think\Controller;


class KlassController extends IndexController
{
	
	public function index(){
		$klasses = Klass::paginate();
		$this->assign('klasses',$klasses);
		return $this->fetch();
	}
}