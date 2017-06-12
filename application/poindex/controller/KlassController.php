<?php
namespace app\poindex\controller;
use app\poindex\common\model\Klass;        // 班级

class KlassController extends IndexController
{
    public function index()
    {
        $klasses = Klass::paginate();
        $this->assign('klasses', $klasses);
        return $this->fetch();
    }
}