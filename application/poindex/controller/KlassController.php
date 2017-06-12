<?php
namespace app\poindex\controller;
use app\poindex\common\model\Klass;        // 班级

class KlassController extends IndexController
{
    public function index()
    {
    	//获取班级名称
    	$name = Request::instance()->get('name');
    	echo $name;
    	return $this->get('error');

        $klasses = Klass::paginate();
        $this->assign('klasses', $klasses);
        return $this->fetch();
    }
}