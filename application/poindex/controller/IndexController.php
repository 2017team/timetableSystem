<?php
namespace app\poindex\controller;
use think\Controller;
use app\poindex\common\model\Teacher;
/**
* 
*/
class IndexController extends Controller
{
    public function __construct()
    {
        // 调用父类构造函数(必须)
        parent::__construct();

        // 验证用户是否登陆
        if (!Teacher::isLogin()) {
            return $this->error('plz login first', url('Login/index'));
        }
    }

    public function index()
    {
    }
}