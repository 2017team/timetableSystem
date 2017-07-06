<?php
namespace app\zhangxishuo\controller;
use app\zhangxishuo\model\Student;
use app\zhangxishuo\model\Klass;
use think\Request;
use think\Controller;

class StudentController extends IndexController{
	public function index(){
		$Student = new Student();
		$Students = $Student->select();

		// var_dump($students);

		// var_dump($Students[0]->Klass);

		$this->assign('Students',$Students);
		return $this->fetch();
	}

	public function edit(){
		$id = Request::instance()->param('id/d');

		if(is_null($Student = Student::get($id))){
			return $this->error('未找到ID为' . $id . '的记录');
		}

		$this->assign('Student',$Student);
		return $this->fetch();
	}

	public function add(){
		$Student = new Student();
		$Student->id = 0;
		$Student->name = '';
		$Student->num = '';
		$Student->sex = 0;
		$Student->klass_id = 1;
		$Student->email = '';

		$this->assign('Student',$Student);
		return $this->fetch('edit');
	}

	public function update(){
		$id = Request::instance()->post('id/d');
		$Student = Student::get($id);

		if(!is_null($Student)){
			if(!$this->saveStudent($Student)){
				return $this->error('Fail' . $Student->getError());
			}
		}

		return $this->success('Success' , url('index'));
	}

	public function save(){
		$Student = new Student();
		if(!$this->saveStudent($Student)){
			return $this->error('Fail' . $Student->getError());
		}
		return $this->success('Success' , url('index'));
	}

	private function saveStudent(Student &$Student){
		$Student->name = Request::instance()->post('name');
		$Student->num = Request::instance()->post('num');
		$Student->sex = Request::instance()->post('sex');
		$Student->klass_id = Request::instance()->post('klass_id');
		$Student->email = Request::instance()->post('email');

		return $Student->validate()->save();
	}

	public function delete(){
		try {
            $Request = Request::instance();
            
            $id = Request::instance()->param('id/d');
            
            if (0 === $id) {
                throw new \Exception('未获取到ID信息', 1);
            }

            $Student = Student::get($id);

            if (is_null($Student)) {
                throw new \Exception('不存在id为' . $id . '的教师，删除失败', 1);
            }

            if (!$Student->delete()) {
                return $this->error('删除失败:' . $Teacher->getError());
            }

        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        } catch (\Exception $e) {
            return $e->getMessage();
        } 

        return $this->success('删除成功', $Request->header('referer')); 
	}
}