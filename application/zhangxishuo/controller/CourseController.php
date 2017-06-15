<?php
namespace app\zhangxishuo\controller;
use app\zhangxishuo\model\Course;
use app\zhangxishuo\model\Klass;
use think\Request;

class CourseController extends IndexController{
	public function index(){

	}

	public function add(){
		$this->assign('Course',new Course);

		// $klasses = Klass::All();
		// $this->assign('klasses',$klasses);

		return $this->fetch();
	}

	public function edit(){
		$id = Request::instance()->param('id/d');
		$Course = Course::get($id);

		if(is_null($Course)){
			return $this->error('Not Exist' . $id);
		}

		$this->assign('Course',$Course);
		return $this->fetch();
	}

	public function save(){
		$Course = new Course();
		$Course->name = Request::instance()->post('name');

		if(!$Course->validate(true)->save()){
			return $this->error('Error' . $Course->getError());
		}

		//$klassIds = Request::instance()->post('klass_id/a');

		// if(!is_null($klassIds)){
		// 	$data = array();
		// 	foreach($klassIds as $klassId){
		// 		$data = array();
		// 		$data['klass_id'] = $klassId;
		// 		$data['course_id'] = $Course->id;
		// 		array_push($datas, $data);
		// 	}

		// 	if(!empty($datas)){
		// 		$KlassCourse = new KlassCourse;

		// 		if(!$KlassCourse->validate(true)->saveAll($datas)){
		// 			return $this->error('Error' . $KlassCourse->getError());
		// 		}
		// 		unset($KlassCourse);
		// 	}
		// }

		$klassIds = Request::instance()->post('klass_id/a');

		if(!is_null($klassIds)){
			if(!$Course->Klasses()->saveAll($klassIds)){
				return $this_error('Error' . $Course->Klasses()->getError);
			}
		}

		unset($Course);

		return $this->success('Success',url('index'));
	}

	public function update(){
		//var_dump(Request::instance()->post());

		$id = Request::instance()->post('id/d');
		if (is_null($Course = Course::get($id))) {
			return $this->error('Error' . $id . 'Not Found');
		}

		$Course->name = Request::instance()->post('name');

		if (is_null($Course->validate(true)->save())){
			return $this->error('Wrong' . $Course->getError());
		}

		//删除原有信息
		$map = ['course_id' => $id];

		if (false === $Course->KlassCourses()->where($map)->delete()){
			return $this->error('Course Save Error' . $Course->Klasses());
		}
	}
}