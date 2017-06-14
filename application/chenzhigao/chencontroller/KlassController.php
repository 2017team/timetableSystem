<?php
namespace app\index\controller;
use app\common\model\Klass;         //班级
class KlassController extends IndexController
{
	public function index()
	{   //调用分页方法
		$klasses = Klass::paginate();
		//向v层传数据   
		$this->assign('klasses', $klasses);
		//取回打包后的数据并返回给用户
		return $this->fetch();
	}
}