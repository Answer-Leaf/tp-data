<?php
    namespace app\index\controller;
    use think\Controller;
    use think\Db;
    use think\facade\Session;

    class Draw extends Controller
    {
        /**
         * 抽奖页面
         */
        public function draw($id)
        {
            $uid=Session::get('id');
            if (empty($uid)){
                die('请先登录');
            }else  if ($id!=$uid){
                die('用户信息有误');
            }
            $time=time();
            $rand=rand(1,100);
            //查询抽奖表中3条根据时间排序，倒叙的数据
            $draw_time=Db::table('draw')
                ->where('uid',$uid)
                ->order('add_time','desc')
                ->limit(3)->select();
            //判断查询结果不为空
            if (count($draw_time)>=3){

                //随机数是中奖数则进入判断
                if ($rand>=1 && $rand<=6){
                    //查询数据库里   已经中奖的号码  根据uid分组   并返回数组
                    $num_arr=Db::table('draw')
                        ->field('uid,rand_num')
                        ->group('uid')
                        ->whereBetween('rand_num','1,6')->select();
                    //循环判断这些数据
                    foreach ($num_arr as $k => $v) {
                        if ($v['uid']==$uid){
                            $rand=rand(7,100);
                            break;
                        }elseif ($v['rand_num']==$rand){
                            $rand=rand(7,100);
                            break;
                        }
                    }
                }

                //选择数据中的第三个二维数组的时间
                $prev_time = $draw_time[2]['add_time'];
                echo   $time."<br>";
                echo   $prev_time;
                //判断用户之前最后第3次抽奖时间是否大于60秒
                if ($time - $prev_time<60){
                    echo "<br>0<br>";
                    die('一分钟内只能抽奖三次');
                }else{
                    echo "<br>1<br>";
                }
            }
            //将随机信息写入数据库
            $draw_date=[
                'uid'=>$uid,
                'add_time'=>$time,
                'rand_num'=>$rand
            ];
            Db::table('draw')->insert($draw_date);
            $this->assign('r',$rand);
            return $this->fetch();
        }
    }