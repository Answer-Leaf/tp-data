<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

Class Book extends Controller
{

    /**
     * 图书添加
     */
    public function bookAdd()
    {
        if (empty($_POST) ==false){
            if (in_array(null,$_POST)==false|| array_combine() ){
                $in=Db::table('book')->insert($_POST);
                echo '数据添加成功';
                header('Refresh:1;url=/book');
            }else{
                echo('数据不能未空');
            }
        }


        return $this->fetch();

    }



    /**
     * 图书展示页面
     */
    public function bookShow()
    {

        $book=Db::table('book')->select();

        foreach ($book as $k => $v) {

            if ($v['is_sale']==1){
                $book[$k]['is_sale']='是';
            }else if ($v['is_sale']==2){
                $book[$k]['is_sale']='否';
            }
        }

        $this->assign('book',$book);
        return $this->fetch();
    }


    /**
     * 参数会在点击时自动传入
     * 图书删除
     */
    public function bookDel($id)
    {

      // $id=intval($_GET['id']);
       Db::table('book')->where('book_id',$id)->delete();
       return $this->fetch();
    }

    /**
     * 修改页面
     */
    public function bookUp($id)
    {
        $b=Db::table('book')->where('book_id',$id)->find();

        $this->assign('b',$b);
        return $this->fetch();
    }

    /**
     * 修改方法
     */
    public function bookUpDate($id)
    {

        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        Db::table('book')->where('book_id',$id)->update($_POST);
        return redirect('/book');
    }

}


