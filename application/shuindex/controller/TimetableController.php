<?php
namespace app\shuindex\controller;
use app\shuindex\model\Timetable;
use think\Request; 

class TimetableController extends IndexController
{
	public function index()
	{
		
		$Timetable = new Timetable;
		//var_dump($Timetable);
		$timetables = $Timetable->select();
		$b = sizeof($timetables);

		
		$time = date('md',time());
		$y=0;
		for($x=0;$x<$b;$x++){
		$t = $timetables[$x]->time1 *7+$timetables[$x]->time2;
		$t3 = date("md", strtotime(" +$t days", strtotime("2017-06-27")));
		
		if($time == $t3){
			$timetablea[$y]=$timetables[$x];
			$y=$y+1;
		}else{
			$this->assign('timetables',null);
		}
		
		
		}
		$this->assign('timetables',$timetablea);
		// var_dump($timetables);
		return $this->fetch();
	}
	public function add()
	{
		return $this->fetch();
	}
	public function save()
	{
		$postData = Request::instance()->post();    

        // 实例化Teacher空对象
        $Timetable = new Timetable();
         if (!$this->saveTimetable($Timetable)) {
            return $this->error('操作失败' . $Timetable->getError());
        }
    
        // 成功跳转至index触发器
        return $this->success('操作成功', url('index'));
        
	}
	private function saveTimetable(Timetable &$Timetable) 
    {
      
        $Timetable->name =input('post.name');
        $Timetable->time1 =input('post.time1');
        $Timetable->time2 = input('post.time2');
        $Timetable->course1 =input('post.course1');
        $Timetable->course2 =input('post.course2');
        $Timetable->course3 =input('post.course3');
        $Timetable->course4 =input('post.course4');
        // 更新或保存
        return $Timetable->validate(true)->save();
    }
}