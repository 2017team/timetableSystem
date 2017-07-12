<?php

namespace app\zhangxishuo\controller;
use think\Controller;
use think\Request;
use app\zhangxishuo\model\User;
use app\zhangxishuo\model\Curriculum;
use app\zhangxishuo\model\Week;
use app\zhangxishuo\model\Day;
use app\zhangxishuo\model\Knob;
use app\zhangxishuo\model\UserCurriculum;
use app\zhangxishuo\model\Time;

/**
* 
*/
class UserController extends Controller
{
    public function index(){
        // $starttime = '20170710';
        // $currenttime = date('Ymd');

        // $this->WeekDay($starttime,$currenttime,$Week,$Day);

        // $map = array();
        // $map['week_id'] = $Week;
        // $map['day_id'] = $Day;

        $User = new User();
        $Users = $User->select();

        $this->assign('Users',$Users);

        return $this->fetch();
    }
    
    public function add(){
        $User = new User();
        $this->assign('User',$User);

        $Curriculum = new Curriculum();
        $this->assign('Curriculum',$Curriculum);

        return $this->fetch();
    }

    public function save(){
        $UserCurriculum = new UserCurriculum();
        $map = array();

        $map['name'] = Request::instance()->post('user');
        $User = User::get($map);
        $UserCurriculum->user_id = $User->id;

        $map['name'] = Request::instance()->post('curriculum');
        $Curriculum = Curriculum::get($map);
        $UserCurriculum->curriculum_id = $Curriculum->id;

        if(!$UserCurriculum->save()){
            return $this->error('操作失败' . $UserCurriculum->getError());
        }

        return $this->success('操作成功' , url('index'));
    }

    public function addcurriculum(){
        $Curriculum = new Curriculum();
        $this->assign('Curriculum',$Curriculum);

        $Week = new Week();
        $this->assign('Week',$Week);

        $Day = new Day();
        $this->assign('Day',$Day);

        $Knob = new Knob();
        $this->assign('Knob',$Knob);

        return $this->fetch();
    }

    public function addcurriculum2(){
        $User = new User();
        $this->assign('User',$User);

        $Week = new Week();
        $this->assign('Week',$Week);

        $Day = new Day();
        $this->assign('Day',$Day);

        $Knob = new Knob();
        $this->assign('Knob',$Knob);

        return $this->fetch();
    }

    public function savecurriculum(){
        $weeks = Request::instance()->post('week/a');
        $w = sizeof($weeks);

        for($s = 0 ; $s < $w ; $s ++){
            $Time = new Time();
            $map = array();

            $map['name'] = Request::instance()->post('curriculum');
            $Curriculum = Curriculum::get($map);
            $Time->curriculum_id = $Curriculum->id;

            $Time->week_id = (int)$weeks[$s];

            $map['name'] = Request::instance()->post('day');
            $Day = Day::get($map);
            $Time->day_id = $Day->id;
            
            $map['name'] = Request::instance()->post('knob');
            $Knob = Knob::get($map);
            $Time->knob_id = $Knob->id;

            if(!$Time->save()){
                return $this->error('操作失败' . $Time->getError());
            }
        }

        return $this->success('操作成功' , url('index'));
    }

    public function savecurriculum2(){
        $weeks = Request::instance()->post('week/a');
        $w = sizeof($weeks);

        $knobs = Request::instance()->post('knob/a');
        $k = sizeof($knobs);

        for($s = 0;$s < $w;$s ++){
            for($t = 0;$t < $k;$t ++){
                $Time = new Time();
                $map = array();

                $Time->curriculum_id = -1;

                $Time->week_id = (int)$weeks[$s];

                $map['name'] = Request::instance()->post('day');
                $Day = Day::get($map);
                $Time->day_id = $Day->id;

                $Time->knob_id = (int)$knobs[$t];

                if(!$Time->save()){
                    return $this->error('操作失败' . $Time->getError());
                }
            }
        }

        return $this->success('操作成功' , url('index'));
    }

    private function WeekDay($starttime,$currenttime,&$Week,&$Day){
        $startYear = (int) ($starttime / 10000);
        $startMonth = ($starttime / 100) % 100;
        $startDay = $starttime % 100;

        $currentYear = (int) ($currenttime / 10000);
        $currentMonth = ($currenttime / 100) % 100;
        $currentDay = $currenttime % 100;

        $startTimestamp = mktime(0,0,0,$startMonth,$startDay,$startYear);
        $currentTimestamp = mktime(0,0,0,$currentMonth,$currentDay,$currentYear);

        $TimeInterval = $currentTimestamp - $startTimestamp;

        $DayInterval = $TimeInterval / 86400;

        $Week = (int)($DayInterval / 7) + 1;
        $Day = $DayInterval % 7 + 1;
    }

    public function deletecurriculum(){
        return $this->fetch();
    }

    public function editcurriculum(){
        $User = new User();
        $this->assign('User',$User);

        $Week = new Week();
        $this->assign('Week',$Week);

        $Day = new Day();
        $this->assign('Day',$Day);

        $Knob = new Knob();
        $this->assign('Knob',$Knob);

        return $this->fetch();
    }

    public function readcurriculum(){
        return $this->fetch();
    }

    public function readcurriculum2(){
        return $this->fetch();
    }

    public function editcurriculum2(){
        return $this->fetch();
    }

    public function courselist(){
        return $this->fetch();
    }
}