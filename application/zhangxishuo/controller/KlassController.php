<?php
namespace app\zhangxishuo\controller;
use app\zhangxishuo\model\Klass;
use app\zhangxishuo\model\Teacher;
use think\Request;


class KlassController extends IndexController
{
	
	public function index(){
		$klasses = Klass::paginate();
		$this->assign('klasses',$klasses);
		return $this->fetch();
	}

	public function add(){
		$teachers = Teacher::all();
		$this->assign("teachers",$teachers);

		return $this->fetch();
	}

	public function save(){
		$Request = Request::instance();

		$Klass = new Klass();
		$Klass->name = $Request->post('name');
		$Klass->teacher_id = $Request->post('teacher_id/d');

		if(!$Klass->validate(true)->save()){
			return $this->error('数据添加错误'.$Klass->getError());
		}

		return $this->success('操作成功',url('index'));
	}
}