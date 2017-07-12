<?php

namespace app\shuindex\model;
use think\Model;    //  导入think\Model类

class Timetable extends Model
{
	 public function times($t1,$t2)
	{
		$t = $t1*7+$t2;
		$t3 = date("md", strtotime(" +$x days", strtotime("2011-07-05")));
		
		$time = date('md',time());
		return 0;
	}
}