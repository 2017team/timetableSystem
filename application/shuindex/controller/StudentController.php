<?php
namespace app\shuindex\controller;
use app\shuindex\model\Student;
use think\Request; 
use think\Controller;
use app\shuindex\model\Klass;  


class StudentController extends IndexController
{
	
	public function index() {

        // 获取查询信息
        $name = Request::instance()->get('name');

            // 每页显示5条数据
            $pageSize = 5; 

            // 实例化Teacher
            $Student = new Student; 

            // 定制查询信息
            if (!empty($name)) {
                $Student->where('name', 'like', '%' . $name . '%');
            }

           // 按条件查询数据并调用分页
            $students = $Student->paginate($pageSize, false, [
                'query'=>[
                'name' => $name,
                ],
                ]);

            // 向V层传数据
            $this->assign('students', $students);

            // 取回打包后的数据
            $htmls = $this->fetch();

            // 将数据返回给用户
            return $htmls;
        }
        public function edit() {
           $id = Request::instance()->param('id/d');

           // 判断是否存在当前记录
           if (is_null($Student = Student::get($id))) {
            return $this->error('未找到ID为' . $id . '的记录');
        }

        // 取出班级列表
        $klasses = Klass::all();
        $this->assign('klasses', $klasses);

        $this->assign('Student', $Student);
        return $this->fetch();
    }
    public function update() {
      $id = Request::instance()->post('id/d');

      // 获取传入的班级信息
      $Student = Student::get($id);
      if (is_null($Student)) {
        return $this->error('系统未找到ID为' . $id . '的记录');
    }

    // 数据更新
    $Student->name = Request::instance()->post('name');
    $Student->num= Request::instance()->post('num');
    $Student->sex=Request::instance()->post('sex');
    $Student->klass_id=Request::instance()->post('klass_id');
    $Student->email=Request::instance()->post('email');

        if (!$Student->save()) {	
            return $this->error('更新错误：' . $Student->getError());
        } else {
            return $this->success('操作成功', url('index'));
        }
    }
    // 添加
    public function add() {
        $Student =new Student;

        $Student->id = 0;
        $Student->name = '';
        $Student->num= '';
        $Student->sex=0;
        $Student->klass_id=0;
        $Student->email= '';

      $this->assign('Student', $Student);
      $klasses = Klass::all();
      $this->assign('klasses', $klasses);

      $htmls = $this->fetch('edit');

      return $htmls;
    }
    public function insert() {
        $message = '';  // 提示信息

        try {
            // 接收传入数据
            $postData = Request::instance()->post();    

            // 实例化Teacher空对象
            $Student = new Student();

            // 为对象赋值
            $Student->name = $postData['name'];
            $Student->num = $postData['num'];
            $Student->sex = $postData['sex'];
            $Student->klass_id = $postData['klass_id'];
            $Student->email = $postData['email'];

            // 新增对象至数据表
            $result = $Student->validate(true)->save();

            // 反馈结果
            if ($result ===false )
            {
                // 验证未通过，发生错误
                $message = '新增失败:' . $Student->getError();
            } else {
                // 提示操作成功，并跳转至教师管理列表
                return $this->success('用户' . $Student->name . '新增成功。', url('index'));
            }
             // 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;
        } catch (\Exception $e) {
            // 发生异常
            return $e->getMessage();
        }

        return $this->error($message);
    }
    // 测试
    public function test() {

    }
    // 删除
    public function delete() {
        try {
            // 实例化请求类
            $Request = Request::instance();

            // 获取get数据
            $id = Request::instance()->param('id/d');

            // 判断是否成功接收
            if (0 === $id) {
                throw new \Exception('未获取到ID信息', 1);
            }

            // 获取要删除的对象
            $Student = Student::get($id);

            // 要删除的对象存在
            if (is_null($Student)) {
                throw new \Exception('不存在id为' . $id . '的教师，删除失败', 1);
            }

            // 删除对象
            if (!$Student->delete()) {
                return $this->error('删除失败:' . $Student->getError());
            }

        // 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 

        // 进行跳转 
        return $this->success('删除成功', $Request->header('referer')); 
    }

}