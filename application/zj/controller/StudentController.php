<?php
namespace app\zj\controller;
use app\zj\model\Student;
use app\zj\model\IndexController;
class StudentController extends IndexController
{
    public function index()
    {
        $students = Student::paginate();
        $this->assign('students', $students);
        return $this->fetch();
    }
}