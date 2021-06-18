<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Session;

class Reserve extends Controller
{
    public function res()
    {
        $uid=Session::get('id');
        if ($uid==false){
            die('请先登录');
        }
        $res_arr=Db::table('res')->field('id,whether')->select();



        $this->assign('r',$res_arr);

        return $this -> fetch();
    }


    /**
     * 订座判断，写入数据库信息
     */
    public function resDo()
    {

        $uid=Session::get('id');
        if ($uid==false){
            die('请先登录');
        }
        $time=time();
        $user_res=Db::table('res')->where('uid' ,$uid)->order('add_time','desc')->find();

        if ($user_res){
            if ($user_res['add_time'] + 86400 > $time){
                die('今天已经预定过座位了，请明天再来');
            }
        }
        if (empty( $_POST) || in_array(null, $_POST) || intval($_POST['id'])==false ||  intval($_POST['id'])>10){
            die('座位号有误');
        }

        $id=intval($_POST['id']);
        $past=Db::table('res')->where('id',$id)->limit(1)->find();
        if ($past['whether']){
            die('位置已经被预定了！');
        }
        $res_in=[
            'uid' => $uid,
            'whether' =>1,
            'add_time' =>$time
        ];
        Db::table('res')->where('id',$id)->update($res_in);
        $new_res=Db::table('res')->where('whether','1')->select();


        echo "<pre>";
        print_r($new_res);
        echo "</pre>";
        foreach ($new_res as $k => $v) {
            $user_arr=[
                'uid'=>$v['uid'],
                'res_id'=>$v['id'],
                'add_time'=>$v['add_time']
            ];
            Db::table('res_user')->insert($user_arr);
        }
        echo $id;
    }

    public function mo()
    {

        $uid=Session::get('id');
        if ($uid==false){
            die('请先登录');
        }

        $user_res=Db::table('res_user')
            ->where('uid',$uid)
            ->order('add_time','desc')->select();

        if ($user_res==false){
            echo "您还没有预订过<br>";
            echo "<a href='/reserve/res'>我要预订</a>";
            die;
        }
        foreach ($user_res as $k =>$v){
            $user_res[$k]['add_time']=date('Y-m-d H:i:s',$v['add_time']);
        }
        $this->assign('user',$user_res);
        return $this->fetch();
    }

}