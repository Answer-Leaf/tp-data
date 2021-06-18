<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
    class Goods extends Controller
    {

        /**
         * @return mixed 进入搜索页
         */
        public function goodsSearch()
        {

            return $this -> fetch();
        }

        public function goods_f()
        {

            if (isset($_POST['search'])==false){
                die('请在搜索页输入内容');
            }
            $id=intval($_POST['search']);

            $goods=Db::name('p_goods')->where('goods_id',"{$id}")->find();
            if (empty($goods)){
                die('未搜索到此商品');
            }

            $this->assign('name',$goods['goods_name']);
            $this->assign('pri',$goods['shop_price']);
            return $this->fetch();
        }
    }