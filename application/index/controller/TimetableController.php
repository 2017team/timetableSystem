<?php
namespace app\controller;
use app\common\model\Timetable;
use think\Request; 
use think\Controller;

class TimetableController extends Controller
{
	public function index()
	{
		return $this->fetch();
	}
}
