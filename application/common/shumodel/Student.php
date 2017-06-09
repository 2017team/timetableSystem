<?php
namespace app\common\model;
use think\Model;
/**
* Student学生表
*/
class Student extends Model
{
	private $Teacher;
	/**
     * 输出性别的属性
     * @return string 0男，1女
     * @author 梦云智 http://www.mengyunzhi.com
     */
	public function getSexAttr($value)
	{
		$status = array('0'=>'男','1'=>'女');
		$sex = $status[$value];
		if (isset($sex))
		{
			return $sex;
		} else {
			return $status[0];
		}
	}
     /**
     * 获取要显示的创建时间
     * @param  int $value 时间戳
     * @return string  转换后的字符串
     * @author panjie <panjie@yunzhiclub.com>
     */
     protected $dateFormat = 'Y年m月d日';    // 日期格式

     protected $type = [
     'create_time' => 'datetime',
     ];

     public function Klass()
     {
     	return $this->belongsTo('Klass');
     }
     public function Teacher()
     {
     
        if (is_null($this->Teacher)) {
           
            $teacherId = $this->getData('teacher_id');
            $this->Teacher = Teacher::get($teacherId);
        }
        return $this->Teacher;
     }
 }