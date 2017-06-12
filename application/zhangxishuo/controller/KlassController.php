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

	public function edit(){
		$id = Request::instance()->param('id/d');

		$teachers = Teacher::all();
		$this->assign('teachers',$teachers);

		if (false == $Klass = Klass::get($id)){
			return $this->error('Not Found id:'.$id);
		}

		$this->assign('Klass',$Klass);
		return $this->fetch();
	}

	public function update(){
		$id = Request::instance()->post('id/d');

		$Klass = Klass::get($id);
		if (is_null($Klass)){
			return $this->error('Not Found id:'.$id);
		}

		$Klass->name = Request::instance()->post('name');
		$Klass->teacher_id = Request::instance()->post('teacher_id/d');
		if (!$Klass->validate()->save()){
			return $this->error('Error:'.$Klass->getError());
		} else {
			return $this->success('Success',url('index'));
		}
	}

	public function delete(){
		$id = Request::instance()->param('id/d');

		if(is_null($id)||0 === $id){
			return $this->error('Not Found id');
		}

		$Klass = Klass::get($id);

		if(is_null($Klass)){
			return $this->error('不存在id为' . $id . '的班级，删除失败');
		}

		if(!$Klass->delete()){
			return $this->error('删除失败' . $Klass->getError());
		}

		return $this->success('删除成功',url('index'));
	}
}