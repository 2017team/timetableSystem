<?php
namespace app\zhangxishuo\controller;
use app\zhangxishuo\model\Student;
use app\zhangxishuo\model\Klass;
use think\Request;

class StudentController extends IndexController{
	public function index(){
		$student = new Student();
		$students = $student->paginate();
		$this->assign('students',$students);
		return $this->fetch();
	}

	public function edit(){
		$id = Request::instance()->param('id/d');

		if(is_null($Student = Student::get($id))){
			return $this->error('未找到ID为' . $id . '的记录');
		}

		$this->assign('Student',$Student);
		return $this->fetch();
	}
}