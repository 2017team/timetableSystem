<?php
// namespace说明文件在app\chernzhigao\validate下
namespace app\chernzhigao\validate;
use think\Validate;     // 内置验证类

// 我的类名叫做Teacher，对应的文件名为Teacher.php，该类继承了Validate类，Validate在文件头中，提前使用use进行了导入。
class Teacher extends Validate
{
    protected $rule = [
        'username' => 'require|unique:teacher|length:4,25',
        'name'  => 'require|length:2,25',
        'sex' => 'in:0,1',
        'email' => 'email',
    ];
}