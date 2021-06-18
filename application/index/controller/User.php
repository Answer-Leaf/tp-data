<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\facade\Session;
use app\index\model\User as U;
    class  user extends  Controller
    {

        //测试

        public function t()
        {
            $co=U::column('id');
            echo "<pre>";
            print_r($co);
            echo "</pre>";


        }



        //登录视图
        public function login()
        {
            $u=Session::get('username');
            if ($u){
                header('Refresh:2;url=cen');
                die('已登录正在转跳个人中心.....');
            }
           return $this->fetch();
        }


        //登录提交返回数据
        public function login_p()
        {
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";

            echo "正在转跳";
            header('Refresh:2;url=/pe');
        }


        /**
         * 登录页面的逻辑
         */
        public function pe()
        {


            if (empty($_POST['username'])){
                header('Refresh:2;url=/login');
                die('请先输入内容');
            }

            $user=Db::name('users')->where('username',"{$_POST['username']}")->find();

            if (empty($user)){
                header('Refresh:2;url=/login');
                die('用户名输入错误');
            }elseif (password_verify($_POST['pass'],$user['pass'])){
                $time=date('Y-m-d H:i:s',time());

                //设置session
                Session::set('id',$user['id']);
                Session::set('username',$user['username']);
                Session::set('now',$time);
                Session::set('last_time',$user['last_time']);
                //redirect()
                Db::table('users')->where('id' ,$user['id'])->update(['last_time'=>$time]);
                $this->success($msg="登录成功正在转跳",$url='/cen',$data=$_SESSION,$wait=1,[]);
            }else{
                header('Refresh:2;url=/login');
                die('密码有误');
            }

        }

        /**
         * @return mixed  返回个人中心页面，并显示用户的登录信息
         * @throws DataNotFoundException
         * @throws ModelNotFoundException
         * @throws DbException
         */
        public function cen()
        {
            //获取session
            $id=Session::get('id');
            $user=Session::get('username');
            if ($id==false || $user==false) {
                header('Refresh:2;url=/login');
                die('请先登录');
            }
            $time=Session::get('now');
            $last_time=Session::get('last_time');

            //登录成功，向登录信息数据库中写入登录数据
            $login_data=[
                'uid' => $id,
                'login_time' => $time,
                'login_ip' => $_SERVER['SERVER_ADDR'],
                'ua' => $_SERVER['HTTP_USER_AGENT']
            ];
            $count_rows=Db::table('login')->insert($login_data);
            echo '成功添加登录记录'.$count_rows.'条';

            //获取登录信息数据库，传入视图中循环显示
            $login=Db::table('login')->where('uid',$id)->select();
            $this->assign('login',$login );



            //设置视图中的替换的内容
            $this->assign('id',"{$id}");
            $this->assign('username',"{$user}");
            $this->assign('now',"{$time}");
            $this->assign('last_time',"{$last_time}");



            return $this->fetch();
        }

        /**
         * 退出登录
         */
        public function out()
        {
            Session::delete('id');
            Session::delete('username');
            $this->success("注销成功",'/login','',2);

        }

        //注册视图
        public function reg()
        {
            return $this->fetch();
        }

        //注册返回数据
        public function reg_p()
        {
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
        }
    }