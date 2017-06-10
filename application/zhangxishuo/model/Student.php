<?php
namespace app\zhangxishuo\model;
use think\Model;

class Student extends Model{
	// 在C层中没有调用getSexAttr()方法，怎么将sex赋值为男/女的？这个方法怎么运行的？get...Attr()是规定好的名称吗？
	public function getSexAttr($value){
		$status = array('0'=>'男','1'=>'女');
		$sex = $status[$value];
		if (isset($sex)){
			return $sex;
		} else {
			return $status[0];
		}
	}

	protected $type = [
		'create_time' => 'datetime',
	];

	protected $dateFormat = 'Y年m月d日';

	public function getCreateTimeAttr($value){
		return date('Y-m-d',$value);
	}

	public function Klass(){
		return $this->belongsTo('Klass');
	}
}