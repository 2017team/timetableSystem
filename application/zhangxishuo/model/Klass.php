<?php
namespace app\zhangxishuo\model;
use think\Model;

/**
* 
*/
class Klass extends Model
{
	private $Teacher;

    public function Teacher(){
    	return $this->belongsTo('Teacher');
    }
}