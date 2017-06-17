<?php
namespace app\poindex\controller;
use app\poindex\common\model\Klass;     // 班级
use think\Request;      //请求
use app\poindex\common\model\Teacher;   //教师

class KlassController extends IndexController
{
    public function index()
    {
    	
        try {
            //获取班级名称
    	    $name = input('get.name');
            
            //实例化klass对象
            $Klass = new Klass;

            // 按条件查询数据并调用分页
            $klasses = $Klass->where('name', 'like', '%' . $name . '%')->paginate('5', false, [
                'query'=>[
                    'name' => $name,
                    ],
                ]);

            // 向V层传数据
            $this->assign('klasses', $klasses);

            // 取回打包后的数据
            $htmls = $this->fetch();

            //返还给用户
            return $htmls;

            $klasses = Klass::paginate();
            $this->assign('klasses', $klasses);
            return $this->fetch();

            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

     public function add()
    {
        //获取所有的教师信息
        $teachers = Teacher::all();
        $this->assign('teachers',$teachers);
        return $this->fetch();
    }

    public function save()
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
}