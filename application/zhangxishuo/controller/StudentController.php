<?php
namespace app\zhangxishuo\controller;
use app\zhangxishuo\model\Student;

class StudentController extends IndexController{
	public function index(){
		$students = Student::paginate();
		$this->assign('students',$students);
		return $this->fetch();
	}
}