<?php
namespace app\index\controller;
use think\Db;

class Stuadd
{
    /**
     * 添加单条记录
     */
    public function add ()
    {
        $add=[
            'student_name'=>'aaaa',
            'student_sex'=> 1,
            'student_age'=>19,
            'score'=>59
        ];
        $num=Db::name('student')->insert($add);
        echo '添加'.$num.'条';
    }

    /**
     * 添加多条记录
     * @param int 添加记录的数量，默认10条
     */
    public function many($num=10)
    {
        for ($i=0;$i<$num;$i++){
            $add2=[
                'student_name'=>$this->strName(5),
                'student_sex'=> $this->stu_info()['sex'],
                'student_age'=>$this->stu_info()['age'],
                'score'=>$this->stu_info()['score']
            ];
            Db::name('student')->insert($add2);
        }

    }



    /**
     * @return mixed 返回一个a-z随机的字符
     */
    public function randStr(){
        $str='abcdefghijklmnopqrstuvwxyz';
        $rand=rand(0,strlen($str)-1);

        return $str[$rand];
    }



    /**
     * @param int $len  传入一个int类型，作为返回的字符串长度
     * @return string  返回一个随机的字符串
     */
    public function  strName ($len)
    {
        $str='';
        for ($i=0;$i<$len;$i++) {
            $str.=$this->randStr();
        }
        return $str;
    }

    public function  stu_info()
    {
        $sex=rand(0,1);
        $age=rand(10,30);
        $score=rand(30,100);
        $info['sex']=$sex;
        $info['age']=$age;
        $info['score']=$score;
        return $info;
    }
}