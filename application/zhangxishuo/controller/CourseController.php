<?php
namespace app\zhangxishuo\controller;
use app\zhangxishuo\model\Course;
use app\zhangxishuo\model\Klass;
use think\Request;

class CourseController extends IndexController{
	public function index(){

	}

	public function add(){
		$klasses = Klass::all();
		$this->assign('klasses',$klasses);

		return $this->fetch();
	}

	public function save(){
		$Course = new Course();
		$Course->name = Request::instance()->post('name');

		if(!$Course->validate(true)->save()){
			return $this->error('Error' . $Course->getError());
		}

		$klassIds = Request::instance()->post('klass_id/a');

		if(!is_null($klassIds)){
			$data = array();
			foreach($klassIds as $klassId){
				$data = array();
				$data['klass_id'] = $klassId;
				$data['course_id'] = $Course->id;
				array_push($datas, $data);
			}

			if(!empty($datas)){
				$KlassCourse = new KlassCourse;

				if(!$KlassCourse->validate(true)->saveAll($datas)){
					return $this->error('Error' . $KlassCourse->getError());
				}
				unset($KlassCourse);
			}
		}

		unset($Course);

		return $this->success('Success',url('index'));
	}
}