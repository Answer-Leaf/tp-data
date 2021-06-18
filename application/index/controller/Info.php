<?php
namespace app\index\controller;
use think\Db;
use app\index\model\Info as IN;
use think\Controller;

class Info extends Controller
{
    public function  p_info()
    {
//        $get_id=User::where('id','22')->find();
//        echo "<pre>";
//        print_r($get_id);
//        echo "</pre>";

        //查询消费最多的前10个用户
        $pay=IN::field('sum(goods_amount) as money ')
            ->group('user_id')
            ->order('money desc')
            ->limit(10)
            ->select()
            ->toArray();




        // 订单最多的前10个用户信息
        $shop=IN::field(' a.user_id,a.user_name ,count(b.user_id) as shop')

            ->alias('b')

            ->Join('p_users a','a.user_id = b.user_id')

            ->group('b.user_id')
            ->order('shop','desc')
            ->limit(10)
            ->select()
            ->toArray();

//        echo "<pre>";
//        print_r($shop);
//        echo "</pre>";
        //卖的最多的前10个商品


        //订单的平均金额
        $avg=IN::field('user_id ,round(avg(goods_amount),2)  as avg')
            ->group('user_id')
            ->order('avg','desc')
            ->limit(10)
            ->select()
            ->toArray();

        echo "<pre>";
        print_r($avg);
        echo "</pre>";

        //人均消费
        $avg_p=IN::field('city,avg(b.goods_amount) as avg')
            ->alias('b')
            ->join('p_users a','a.user_id=b.user_id')
            ->group('city')
            ->order('avg','desc')
            ->limit(30)
            ->select()
            ->toArray();



    }
}