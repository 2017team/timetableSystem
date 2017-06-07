<?php
// 简单的原理重复记： namespace说明了该文件位于application\common\model 文件夹中
namespace app\common\model;
use think\Model;    //  导入think\Model类
/**
 * Teacher 教师表
 */

// 我的类名叫做Teacher，对应的文件名为Teacher.php，该类继承了Model类，Model我们在文件头中，提前使用use进行了导入。
class Teacher extends Model
{
	static public function login($username,$password)
	{
		$map = array('username' => $username);
		$Teacher = self::get($map);

		if(!is_null($Teacher))
		{
			if($Teacher->checkPassword($password))
			{
				session('teacherId',$Teacher->getData('id'));
				return true;
			}
		}

		return false;
	}

	public function checkPassword($password){
		if($this->getData('password')===$this::encryptPassword($password)){
			return true;
		}
		else{
			return false;
		}
	}

	static public function encryptPassword($password){
		if(!is_string($password)){
			throw new \RuntimeException("传入变量类型非字符串，错误码2", 2);
			
		}

		return sha1(md5($password).'mengyunzhi');
	}

	static public function logOut()
    {
        // 销毁session中数据
        session('teacherId', null);
        return true;
    }

    static public function isLogin(){
    	$teacherId = session('teacherId');

    	if(isset($teacherId)){
    		return true;
    	}
    	else{
    		return false;
    	}
    }
}