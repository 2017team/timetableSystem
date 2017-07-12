<?php
namespace app\shuindex\validate;
use think\Validate;     // 内置验证类

class Timetable extends Validate
{
    protected $rule = [
        'name'  => 'require|length:0,25',
    ];
}