<?php

namespace app\zhangxishuo\model;
use think\Model;

/**
* 
*/
class Time extends Model
{
    
    public function User(){
        $id = $this->user_id;
        var_dump($id);
        $User = User::get($id);
        return $User;
    }
}