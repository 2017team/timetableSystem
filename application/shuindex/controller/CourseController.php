<?php
namespace app\shuindex\controller;
use app\shuindex\model\Course;       // 课程
use think\Request;     //引用Request
use app\shuindex\model\Klass;       // 教师
use app\shuindex\model\KlassCourse;
/**
 * 课程管理
 */
class CourseController extends IndexController
{
    public function index()
    {
    	$pageSize = 5;
    	$Course = new Course; 
        $courses = $Course->paginate($pageSize);
        // 向V层传数据
        $this->assign('courses', $courses);

        return $this->fetch();
    }

    public function add()
    {
        $Klass = new Klass;
        $Klasses = Klass::all();
        $this->assign('klasses',$Klasses);
        return $this->fetch();
    }
    public function save()
    {
         // 存课程信息
        $Course = new Course();
        $Course->name = Request::instance()->post('name');

        // 新增数据并验证。验证类我们好像还没有写呢。自己参考其它的验证类，写一下吧。
        if (!$Course->validate(true)->save()) {
            return $this->error('课程保存错误：' . $Course->getError());
        }

        // -------------------------- 新增班级课程信息 -------------------------- 
        // 接收klass_id这个数组
        $klassIds = Request::instance()->post('klass_id/a');       // /a表示获取的类型为数组

        // 利用klass_id这个数组，拼接为包括klass_id和course_id的二维数组。
        if (!is_null($klassIds)) {
            $datas = array();
            foreach ($klassIds as $klassId) {
                $data = array();
                $data['klass_id'] = $klassId;
                $data['course_id'] = $Course->id;     // 此时，由于前面已经执行过数据插入操作，所以可以直接获取到Course对象中的ID值。
                array_push($datas, $data);
            }

            // 利用saveAll()方法，来将二维数据存入数据库。
            if (!empty($datas)) {
                $KlassCourse = new KlassCourse;
                if (!$KlassCourse->validate(true)->saveAll($datas)) {
                    return $this->error('课程-班级信息保存错误：' . $KlassCourse->getError());
                }
                unset($KlassCourse);    // unset出现的位置和new语句的缩进量相同，最后被执行
            }
        }
        // -------------------------- 新增班级课程信息(end) -------------------------- 
        
        unset($Course); // unset出现的位置和new语句的缩进量相同，在返回前，最后被执行。
        return $this->success('操作成功', url('index'));
    }
}