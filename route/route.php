<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
include 'test_route.php';

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');


Route::get('abc/bbb' ,'index/abc');

Route::get('db','index/test_db');


//1、查询所有学生的信息
Route::get('stu/all','Stu/stuAll');


//2、查询学生年龄超过20岁的学生
Route::get('stu/a20','Stu/stuA20');

//3、查询学生年龄小于十八岁的学生
Route::get('stu/a18','Stu/stuA18');

//4、查询综合积分大于150的学生
Route::get('stu/150','Stu/stu150');


//5、查询性别为女的学生信息
Route::get('stu/gal','Stu/gal');


//6、查询性别为男的学生信息
Route::get('stu/boy','Stu/boy');

//7、查询综合分数少于59的学生
Route::get('stu/s59','Stu/sco59');

//8、查询年龄咋18-25之间的学生
Route::get('stu/bet','Stu/bet');


//9、查询女生中年龄小于20的学生
Route::get('stu/galA','Stu/galA20');

//10、查询id为5的学生信息
Route::get('stu/id5','Stu/id5');

//11、查询综合积分在150以上的学生
Route::get('stu/sdo','Stu/down');


//12、查询id为5-10之间学生的综合积分
Route::get('stu/scBt','Stu/bet2');



//给学生表添加一条记录
Route::get('stu/add','Stuadd/add');



//给学生表中添加多条记录

Route::get('stu/addmany','Stuadd/many');



//测试
Route::get('test1','testa/aa');




//登录页面
Route::get('login','user/login');


//注册页面
Route::get('reg','user/reg');


//登录获取参数页面
Route::post('login_p','user/login_p');

//注册获取参数页面
Route::post('reg_p','user/reg_p');

//登录成功判断页面
Route::post('pe','user/pe');




//个人中心页面
Route::get('cen','user/cen');


//退出登录页面
Route::get('out','user/out');

//商品搜索页面
Route::get('search','goods/goodsSearch');

//商品展示页面
Route::post('goods','goods/goods_f');



//图书页面
Route::get('book','book/bookShow');

//图书添加页面
Route::get('bookadd','book/bookadd');
Route::post('bookadd','book/bookadd');
//图书删除页面
Route::get('bookdel/:id','book/bookdel');

//图书修改页面
Route::get('bookup/:id','book/bookup');
Route::post('bookup/:id','book/bookupdate');


//电影评分页面
Route::get('movie/score/:id','Movie/moviescore');
Route::post('movie/add','Movie/movieadd');



//抽奖页面
Route::get('draw/luck/:id','draw/draw');


//订座页面
Route::get('reserve/res','reserve/res');

//订座提交
Route::post('reserve/res','reserve/resDo');

//我的预订
Route::get('reserve/movie','reserve/mo');

return [
];
