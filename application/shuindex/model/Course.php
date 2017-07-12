<?php
namespace app\shuindex\model;
use think\Model;
use app\shuindex\model\KlassCourse;

/**
 * 班级
 */
class Course extends Model
{
	 public function Klasses()
    {
        return $this->belongsToMany('Klass',  config('database.prefix') . 'klass_course');
    }
    public function getIsChecked(Klass &$Klass)
    {
    	//去课程id
    	$courseId = (int)$this->id;
    	$klassId = (int)$Klass->id;
    	//从关联表中取信息
    	$map = array();
    	$map['klass_id'] = $klassId;
    	$map['course_id'] = $courseId;
    	//有记录，返回true；没记录，返回false
    	$KlassCourse = KlassCourse::get($map);
        var_dump($KlassCourse);
    	if (is_null($KlassCourse)) {
    		return false;
    	} else {
    		return true;
    	}
    }
      public function KlassCourses()
    {
        return $this->hasMany('KlassCourse');
    }
}