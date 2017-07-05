<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

    ''            => ['zhangxishuo/Login/index',['method' => 'get']],
    'login'       => ['zhangxishuo/Login/login',['method' => 'post']],
    'logout'      => ['zhangxishuo/Login/logout',['method' => 'get']],

    'teacher/'      =>  ['zhangxishuo/Teacher/index', ['method' => 'get']],
    'teacher/add'   =>  ['zhangxishuo/Teacher/add', ['method' => 'get']],
    'teacher/save'  =>  ['zhangxishuo/Teacher/save', ['method' => 'post']],
    'teacher/edit/:id'  =>  ['zhangxishuo/Teacher/edit', ['method' => 'get'], ['id' => '\d+']],
    'teacher/update'  =>  ['zhangxishuo/Teacher/update', ['method' => 'post']],
    'teacher/delete/:id'     => ['zhangxishuo/Teacher/delete', ['method' => 'get'], ['id' => '\d+']],

];
