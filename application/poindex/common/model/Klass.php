<?php
namespace app\poindex\common\model;
use think\Model;
/**
 * 班级
 */
class Klass extends Model
{
	private $Teacher;
	
	/**
	 * 获取对应的教师（辅导员）信息
	 * @return  Teacher 教师
	 */
	public function getTeacher()
    {
        if (is_null($this->Teacher)) {
            echo '执行1次 <br />';
            $teacherId = $this->getData('teacher_id');
            $this->Teacher = Teacher::get($teacherId);
        }
        return $this->Teacher;
    }
}