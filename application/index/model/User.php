<?php
namespace app\index\model;

use think\Model;

class User extends Model
{
    //设置数据库表
    protected $table='users';

    //设置数据库主键名
    protected $pk='id';
}

