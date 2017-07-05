<?php
// 简单的原理重复记： namespace说明了该文件位于application\common\model 文件夹中
namespace app\zj\model;
use think\Model;
/**
 * 课程
 */
class Course extends Model
{
    /**
     * 多对多关联
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-10-24T16:26:58+0800
     */
    public function Klasses()
    {
        return $this->belongsToMany('Klass',  config('database.prefix') . 'klass_course');
    }

    /**
     * 获取是否存在相关关联记录
     * @param  object  班级
     * @return bool
     * @author panjie <panjie@yunzhiclub.com>
     */
    public function getIsChecked(Klass &$Klass)
    {
        // 取课程ID
        // 从关联表中取信息
        // 有记录，返回true；没记录，返回false。
    }
}