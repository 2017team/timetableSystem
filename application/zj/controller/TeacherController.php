<?php
namespace app\zj\controller;
use think\Controller;
use think\Request;
use app\zj\model\Teacher;       // 数据库操作类
use app\zj\model\IndexController;
class TeacherController extends IndexController
{
   public function index()
    {        
            // 获取查询信息
            $name = Request::instance()->get('name');
            echo $name;

            $pageSize = 5; // 每页显示5条数据

            // 实例化Teacher
            $Teacher = new Teacher; 

            // 定制查询信息
            if (!empty($name)) {
                $Teacher->where('name', 'like', '%' . $name . '%');
            }

            // 按条件查询数据并调用分页
            $teachers = $Teacher->paginate($pageSize);

            // 向V层传数据
            $this->assign('teachers', $teachers);

            // 取回打包后的数据
            $htmls = $this->fetch();

            // 将数据返回给用户
            return $htmls;
    }
      public function insert()
    {
         $message = '';  // 提示信息

        try {
            // 接收传入数据
            $postData = Request::instance()->post();    

            // 实例化Teacher空对象
            $Teacher = new Teacher();

            // 为对象赋值
            $Teacher->name = $postData['name'];
            $Teacher->username = $postData['username'];
            $Teacher->sex = $postData['sex'];
            $Teacher->email = $postData['email'];

            // 新增对象至数据表
            $result = $Teacher->validate(true)->save();

            // 反馈结果
            if (false === $result)
            {
                // 验证未通过，发生错误
                $message = '新增失败:' . $Teacher->getError();
            } else {
                // 提示操作成功，并跳转至教师管理列表
                return $this->success('用户' . $Teacher->name . '新增成功。', url('index'));
            }
        } catch (\Exception $e) {
            // 发生异常
            return $e->getMessage();
        }

        return $this->error($message);
    }
    public function add()
    {
        try {
            $htmls = $this->fetch();
            return $htmls;
        } catch (\Exception $e) {
            return '系统错误' . $e->getMessage();
        }
    }



    
    public function delete()
    {
          
             // 获取pathinfo传入的ID值.
         // 获取pathinfo传入的ID值.
        $id = Request::instance()->param('id/d'); // “/d”表示将数值转化为“整形”

        if (is_null($id) || 0 === $id) {
            return $this->error('未获取到ID信息');
        }

        // 获取要删除的对象
        $Teacher = Teacher::get($id);

        // 要删除的对象不存在
        if (is_null($Teacher)) {
            return $this->error('不存在id为' . $id . '的教师，删除失败');
        }

        // 删除对象
        if (!$Teacher->delete()) {
            return $this->error('删除失败:' . $Teacher->getError());
        }

        // 进行跳转
        return $this->success('删除成功', url('index'));
    }
    public function edit()
    {
        try {
            // 获取传入ID
            $id = Request::instance()->param('id/d');

            // 判断是否成功接收
            if (is_null($id) || 0 === $id) {
                throw new \Exception('未获取到ID信息', 1);
            }
            
            // 在Teacher表模型中获取当前记录
            if (null === $Teacher = Teacher::get($id))
            {
                // 由于在$this->error抛出了异常，所以也可以省略return(不推荐)
                $this->error('系统未找到ID为' . $id . '的记录');
            } 
            
            // 将数据传给V层
            $this->assign('Teacher', $Teacher);

            // 获取封装好的V层内容
            $htmls = $this->fetch();

            // 将封装好的V层内容返回给用户
            return $htmls;

        // 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 
    }
       public function update()
    {
         try {
            // 接收数据，获取要更新的关键字信息
            $id = Request::instance()->post('id/d');

            // 获取当前对象
            $Teacher = Teacher::get($id);

            // 写入要更新的数据
            $Teacher->name = Request::instance()->post('name');
            $Teacher->username = Request::instance()->post('username');
            $Teacher->sex = Request::instance()->post('sex/d');
            $Teacher->email = Request::instance()->post('email');

            // 更新
            $message = '更新成功';
            if (false === $Teacher->validate(true)->save()) {
                $message =  '更新失败' . $Teacher->getError();
            }

        } catch (\Exception $e) {
            // 由于对异常进行了处理，如果发生了错误，我们仍然需要查看具体的异常位置及信息，那么需要将以下的代码的注释去掉
            // throw $e;
            $message = $e->getMessage();
        }
       
        return $message;
    }
}


    