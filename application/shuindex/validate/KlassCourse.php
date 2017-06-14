<?php
namespace app\shuindex\validate;
use think\Validate;

/**
* 
*/
class KlassCourse extends Validate
{
	protected $rule = [
	'klass_id' => 'require|length:0,25',
	
	];
}