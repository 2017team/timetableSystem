<?php
namespace app\shuindex\controller;
use app\shuindex\model\Timetable;
use think\Request;
use think\Controller; 

class TimetableController extends Controller
{
	public function index()
	{
        //跳转到指定的时间
        $postDataweek = Request::instance()->post('week');
        $postDatadays = Request::instance()->post('days');
        
        $tpost = $postDataweek*7 + $postDatadays;
        //指定时间
        $tmodle = date("md", strtotime(" +$tpost days", strtotime("2017-06-27")));

		$Timetable = new Timetable;
		//var_dump($Timetable);
		$timetables = $Timetable->select();
		$timetablea = null;
		$b = sizeof($timetables);
        //系统时间
		$time = date('md',time());
		$y=0;
		for($x=0;$x<$b;$x++){
		$t = $timetables[$x]->time1 *7+$timetables[$x]->time2;
		$t3 = date("md", strtotime(" +$t days", strtotime("2017-06-27")));
        // 如果时间相对应，则传入另一个数组
		if($tmodle == $t3){
			$timetablea[$y]=$timetables[$x];
			$y=$y+1;
		}else{
			$this->assign('timetables',null);
		}
		}
		$this->assign('timetables', $timetablea);
		// var_dump($timetables);
		
        $Date_1 = date("Y-m-d");
        $Date_2 = "2017-6-27";
        $d1 = strtotime($Date_1);
        $d2 = strtotime($Date_2);
        $Days = round(($d1-$d2)/3600/24);
        $week = intval($Days/7);
        $day = $Days%7+1;
        // var_dump($week);
        // $times = array();
        // $times[0] = $week;
        // $times[1] = $day;
        $this->assign('day', $day);
        $this->assign('week', $week);
        return $this->fetch();
	}
	public function add()
	{
		return $this->fetch();
	}
	public function save()
	{
		$postData = Request::instance()->post();    
        // 实例化Timetable空对象
        $Timetable = new Timetable();
        $weeks = Request::instance()->post('week/a');
        if (!$this->saveTimetable($Timetable, $weeks)) {
            return $this->error('操作失败' . $Timetable->getError());
        }
        // 成功跳转至index触发器
        return $this->success('操作成功', url('index'));  
	}
    // 课表保存
	private function saveTimetable(Timetable &$Timetable, $weeks = array()) 
    {
      	$w = sizeof($weeks);
        $r = 0;
        $t = 0;
        $q = 0;
      	for($a=0;$a<$w;$a++){
            $newTimetable = new Timetable;
            $newTimetable->name = input('post.name');
            $newTimetable->time1 = $weeks[$a];
            $newTimetable->time2 = input('post.time2');
            $newTimetable->course1 = input('post.course1');
            $newTimetable->course2 = input('post.course2');
            $newTimetable->course3 = input('post.course3');
            $newTimetable->course4 = input('post.course4');
            $timetables = $Timetable->select();
            $b = sizeof($timetables);
             var_dump($b);
            for($i = 0;$i < $b;$i++ ){
                // var_dump($timetables[$i]->name);
                // var_dump(input('post.name'));
                if($timetables[$i]->name==input('post.name')){
                    // var_dump(1);
                    if($timetables[$i]->time1==$weeks[$a]){
                        // var_dump(2);
                        if($timetables[$i]->time2==input('post.time2')){
                             // var_dump(3);
                            $r = 0;
                            $q = 1;
                        }else{
                            $r=1;
                        }
                    }else{
                        $r=1;
                    }
                }else{
                    $r=1;
                }
            }
            if($r==1){
                if($q==0){
                $newTimetable->validate(true)->save();
                $t++;
                }
            }
            if($q==1){
                return 0;
            }
        }
        
        if($t==$w){
            return 1;
        }else{
            return 0;
                }
    }
}