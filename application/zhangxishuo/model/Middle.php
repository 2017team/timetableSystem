<?php

namespace app\zhangxishuo\model;
use think\Model;

/**
* \
*/
class Middle extends Model{
    
    public function User(){
        return $this->belongsTo('User');
    }

    public function Curriculum(){
        return $this->belongsTo('Curriculum');
    }

    public function Week(){
        return $this->belongsTo('Week');
    }

    public function Day(){
        return $this->belongsTo('Day');
    }

    public function Knob(){
        return $this->belongsTo('Knob');
    }
}