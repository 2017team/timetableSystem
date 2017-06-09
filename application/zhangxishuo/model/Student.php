<?php
namespace app\zhangxishuo\model;
use think\Model;

class Student extends Model{
	public function getSexAttr($value){
		$status = array('0'=>'男','1'=>'女');
		$sex = $status[$value];
		if (isset($sex)){
			return $sex;
		} else {
			return $status[0];
		}
	}
}