<?php
namespace app\zhangxishuo\model;
use think\Model;

/**
* 
*/
class Klass extends Model
{
	private $Teacher;

	public function getTeacher()
    {
        if (is_null($this->Teacher)) {
            echo '执行1次 <br />';
            $teacherId = $this->getData('teacher_id');
            $this->Teacher = Teacher::get($teacherId);
        }
        return $this->Teacher;
    }

    public function Teacher(){
    	echo '执行1次 <br />';
    	$teacherId = $this->getData('teacher_id');
    	return Teacher::get($teacherId);
    }
}