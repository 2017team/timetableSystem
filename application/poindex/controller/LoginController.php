<?php
namespace app\poindex\controller;
use think\Controller;
use think\Request;
use app\poindex\common\model\Teacher;

class LoginController extends Controller
{
    // 用户登录表单
    public function index()
    {
        //显示登录表单
        return $this->fetch();
    }

    // 处理用户提交的登录数据
    public function login()
    {
        // 接收post信息
        $postData = Request::instance()->post();
        
        // 直接调用M层方法，进行登录。
        if (Teacher::login($postData['username'], $postData['password'])) {
            return $this->success('login success', url('Teacher/index'));
        } else {
            return $this->error('username or password incorrent', url('index'));
        }
    }

    // 注销
    public function logOut()
    {
        if (Teacher::logOut()) {
            return $this->success('logout success', url('index'));
        } else {
            return $this->error('logout error', url('index'));
        }
    }

    public function test()
    {
        $hello = ['hello'];
        echo Teacher::encryptPassword($hello);
    }
}