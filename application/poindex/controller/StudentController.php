<?php
namespace app\poindex\controller;		//文件存储位置
use app\poindex\common\model\Student;

class StudentController extends IndexController
{
    public function index()
    {
        $students = Student::paginate();
        $this->assign('students', $students);
        return $this->fetch();
    }
}