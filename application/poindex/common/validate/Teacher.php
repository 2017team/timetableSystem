<?php
namespace app\poindex\common\validate;
use think\Validate;		//内置验证类

/**
* 
*/
class Teacher extends Validate
{
	protected $rule=[
		'username' => 'require|unique:teacher|length:4,25',
        'name'  => 'require|length:2,25',
        'sex' => 'in:0,1',
        'email' => 'email',
    ];

    protected $message = [
        'name.require'  =>  '用户名必须',
        'email' =>  '邮箱格式错误',
    ];
    
    protected $scene = [
        'add'   =>  ['name','email'],
        'edit'  =>  ['email'],
    ];
}