<?php
namespace app\shuindex\model;
use think\Model;

/**
 * 班级
 */
class Klass extends Model
{
	 public function getTeacher()
    {
        $teacherId = $this->getData('teacher_id');
        $Teacher = Teacher::get($teacherId);
        return $Teacher;
    }
    
}