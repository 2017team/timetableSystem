<?php

namespace app\zhangxishuo\model;
use think\Model;
use app\zhangxishuo\model\Time;
use app\zhangxishuo\model\UserCurriculum;

/**
* 
*/
class User extends Model{
    
    public function Curriculum($key){
        $map = array();
        $map['user_id'] = $this->id;

        $UserCurriculum = new UserCurriculum();
        $UserCurriculums = $UserCurriculum->where($map)->select();

        var_dump($UserCurriculums);
    }
}