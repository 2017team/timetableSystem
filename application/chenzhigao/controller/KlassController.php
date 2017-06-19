<?php
// namespace说明文件在app\chenzhigao\controller下
namespace app\chenzhigao\controller;
use app\chenzhigao\model\Klass;         // 导入app\chenzhigao\model\Klass模块
use think\Controller;    // 导入think\Controller模块



class KlassController extends Controller
{
	public function index()
	{   // 调用分页方法
		$klasses = Klass::paginate();
		// 向v层传数据   
		$this->assign('klasses', $klasses);
		// 取回打包后的数据并返回给用户
		return $this->fetch();
	}
}