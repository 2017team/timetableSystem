<?php
namespace app\poindex\common\model;		//文件存储位置
use think\Model;

/**
 * 学生表
 */

class Student extends Model
{
	/**
     * 输出性别的属性
     * @return string 0男，1女
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
}