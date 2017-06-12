<?php
namespace app\zhangxishuo\controller;
use think\Controller;
use think\Request;
use app\zhangxishuo\model\Teacher;

class LoginController extends Controller
{
	public function index(){
		return $this->fetch();
	}
	public function login(){
		$postData = Request::instance()->post();

		// $map = array('username' => $postData['username']);
		// $Teacher = Teacher::get($map);

		// if(!is_null($Teacher)&&$Teacher->getData('password')!==$postData['password']){
		// 		return $this->error('password incrrect',url('index'));
		// }
		// else{
		// 	session('teacherId',$Teacher->getData('id'));
		// 	return $this->success('login success',url('Teacher/index'));
		// }

		// return var_dump(input('post.'));;

		if(Teacher::login($postData['username'],$postData['password'])){
			return $this->success('login success',url('Teacher/index'));
		}
		else{
			return $this->error('username or password incorrent',url('index'));
		}
	}

	public function test(){
		$hello = ['hello'];
		echo Teacher::encryptPassword($hello);
	}

	public function logOut()
    {
        if (Teacher::logOut()) {
            return $this->success('logout success', url('index'));
        } else {
            return $this->error('logout error', url('index'));
        }
    }
}