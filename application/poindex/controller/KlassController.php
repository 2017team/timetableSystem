<?php
namespace app\poindex\controller;
use app\poindex\common\model\Klass;     // 班级
use think\Request;       //请求

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
        return $this->fetch();
    }

    public function save()
    {
        var_dump(Request::instance()->post());
    }
}