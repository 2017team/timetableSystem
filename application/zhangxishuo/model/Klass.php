<?php
namespace app\zhangxishuo\model;
use think\Model;

/**
* 
*/
class Klass extends Model
{
	public function getTeacher(){
		echo '执行1次<br />';

		$teacherId = $this->getData('teacher_id');
		$Teacher = Teacher::get($teacherId);
		return $Teacher;
	}

}