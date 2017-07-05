<?php
namespace app\zhangxishuo\model;
use think\Model;
use app\zhangxishuo\model\Teacher;

/**
* 
*/
class Klass extends Model
{
	// private $Teacher;

    public function Teacher(){
    	return $this->belongsTo('Teacher');

        // $id = $this->teacher_id;
        // $Teacher = Teacher::get($id);
        // return $Teacher;
    }
}