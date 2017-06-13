<?php
namespace app\zj\model;
use think\Model;
/**
 * 班级
 */
class KlassCourse extends Model
{
    protected $rule = [
        'name'  => 'require|length:2,25',
        'teacher_id' => 'require',
    ];	 
}