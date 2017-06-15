<?php
namespace app\zhangxishuo\model;
use think\Model;

class Course extends Model{
	public function Klasses(){
		return $this->belongsToMany('Klass',config('database.prefix') . 'klass_course');
	}

	public function getIsChecked(Klass &$Klass){
		$courseId = (int) $this->id;
		$klassId = (int) $Klass->id;

		$map = array();
		$map['klass_id'] = $klassId;
		$map['course_id'] = $courseId;

		$KlassCourse = KlassCourse::get($map);
		if(is_null($KlassCourse)){
			return false;
		} else {
			return true;
		}
	}
}