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

	protected $type = [
		'create_time' => 'datetime',
	];

	protected $dateFormat = 'Y年m月d日';

	public function getCreateTimeAttr($value){
		return date('Y-m-d',$value);
	}

	public function Klass(){
		return $this->belongsTo('Klass');

		// $id = $this->klass_id;
		// var_dump($id);
		// $Klass = Klass::get($id);
		// var_dump($Klass);
		// return $Klass;
	}
}