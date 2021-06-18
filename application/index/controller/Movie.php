<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\facade\Session;

class Movie extends Controller
{
    //电影评分页面
    public function movieScore($id)
    {

        $uid=Session::get('id');
        if (empty($uid)){
            $this->redirect('/login');
            die('请登录');
        }
        if ($uid !=$id){
            die('个人信息有误');
        }

        //查询电影平均分
        $avg=Db::table('movie_score')->
        field('round(avg(score),2) avg')->
        group('movie_id')->select();

        //查询电影名
        $m=Db::table('movies')->select();

        //将数据库的数据放进视图
        $this->assign('m',$m);
        $this->assign('avg',$avg);

        return $this->fetch();

    }
    public function movieAdd()
    {
         $uid=Session::get('id');
//        if ($uid !=$id){
//            die('个人信息有误');
//        }
        if (in_array(null,$_POST)){
            $this->redirect('/movie/score');
            die('评分不能有空');
        }
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        $time=time();
        foreach ($_POST as $k => $v) {
            if (intval($v)<0 ||intval($v)>100){
                die('输入分数不符合评分标准');
            }
        }
        foreach ($_POST as $k => $v) {
            $arr=[
                'score'=>$v,
                'movie_id'=>$k,
                'uid' =>$uid,
                'add_time'=> $time
            ];
            Db::table('movie_score')->insert($arr);
        }

    }
}