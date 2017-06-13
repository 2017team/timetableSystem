<?php
namespace app\common\model;
use think\Model;
/**
 * 班级
 */
class Klass extends Model
{
	/**
	 * 获取对应的教师（辅导员）信息
	 * @return Teacher 教师
	 * @author panjie <panjie@yunzhiclub.com>
	 */
	public function getTeaher()
	{   //通过内部的方法从数据表中获取teacher的关键字
		$teacherId = $this->getData('teacher_id');
        //根据关键字来获得对象的所有属性
		$Teacher = Teacher::get($teacherId);
		//返回这个对象值
		return $Teacher;
	}
}