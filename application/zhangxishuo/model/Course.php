<?php
namespace app\zhangxishuo\model;
use think\Model;

class Course extends Model{
	public function Klasses(){
		return $this->belongsToMany('Klass',config('database.prefix') . 'klass_course');
	}
}