<?php
namespace app\shuindex\controller;
use app\shuindex\model\Klass;        // 班级
use think\Request;     //引用Request
use app\shuindex\model\Teacher;       // 教师

class KlassController extends IndexController
{
    public function index()
    {
        // 获取查询信息
            $name = Request::instance()->get('name');
           

            $pageSize = 2; // 每页显示5条数据

            // 实例化Klass
            $Klass = new Klass; 

            // 定制查询信息
            if (!empty($name)) {
                $Klass->where('name', 'like', '%' . $name . '%');
            }

            // 按条件查询数据并调用分页
            $klasses = $Klass->paginate($pageSize);

            // 向V层传数据
            $this->assign('klasses', $klasses);

            // 取回打包后的数据
            $htmls = $this->fetch();

            // 将数据返回给用户
            return $htmls;

    }
     public function add()//添加
    {
    	  // 获取所有的教师信息
        $teachers = Teacher::all();
        $this->assign('teachers', $teachers);
        return $this->fetch();
       
    }

    public function save()//保存
    {
         // 实例化请求信息
        $Request = Request::instance();

        // 实例化班级并赋值
        $Klass = new Klass();
        $Klass->name = $Request->post('name');
        $Klass->teacher_id = $Request->post('teacher_id/d');

        // 添加数据
        if (!$Klass->validate(true)->save()) {
            return $this->error('数据添加错误：' . $Klass->getError());
        }

        return $this->success('操作成功', url('index'));
    }

     public function edit()
    {
        $id = Request::instance()->param('id/d');

        // 获取所有的教师信息
        $teachers = Teacher::all();
        $this->assign('teachers', $teachers);

        // 获取用户操作的班级信息
        if (false === $Klass = Klass::get($id))
        {
            return $this->error('系统未找到ID为' . $id . '的记录');
        }

        $this->assign('Klass', $Klass);
        return $this->fetch();
    }

    public function update()
    {
        $id = Request::instance()->post('id/d');

        // 获取传入的班级信息
        $Klass = Klass::get($id);
        if (is_null($Klass)) {
            return $this->error('系统未找到ID为' . $id . '的记录');
        }

        // 数据更新
        $Klass->name = Request::instance()->post('name');
        $Klass->teacher_id = Request::instance()->post('teacher_id/d');
        if (!$Klass->validate()->save()) {	// 这里使用的是validate()而不是validate(true)效果相同，为什么呢？
            return $this->error('更新错误：' . $Klass->getError());
        } else {
            return $this->success('操作成功', url('index'));
        }
    }
     public function delete(){
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
            $Klass = Klass::get($id);

            // 要删除的对象存在
            if (is_null($Klass)) {
                throw new \Exception('不存在id为' . $id . '的教师，删除失败', 1);
            }

            // 删除对象
            if (!$Klass->delete()) {
                return $this->error('删除失败:' . $Klass->getError());
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