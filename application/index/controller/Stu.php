<?php
namespace app\index\controller;
use think\Db;

class Stu
{
    public function stuAll ()//1、查询所有学生的信息
    {
        $s_all=Db::table('student')->select();
        echo "<pre>";
        print_r($s_all);
        echo "</pre>";
    }

    public  function  stuA20()//2、查询学生年龄超过20岁的学生
    {
        $s_a20=Db::table('student')->where('student_age','>','20')->select();
        echo "<pre>";
        print_r($s_a20);
        echo "</pre>";
       // Db::table('stutdent')->where('b','between',[1,8])->select();
    }

    public function  stuA18()//查询学生年龄小于十八岁的学生
    {

        $s_18=Db::table('student')->where('student_age','<','18')->order('student_age','desc')->limit('10')->select();
        echo "<pre>";
        print_r($s_18);
        echo "</pre>";
    }

    public function gal()//5、查询性别为女的学生信息
    {
        $gal=Db::table('student')->where('student_sex','1')->select();
        echo "<pre>";
        print_r($gal);
        echo "</pre>";
    }

    public function  boy()//6、查询性别为男的学生信息
    {
        $boy=Db::table('student')->where('student_sex','0')->select();
        echo "<pre>";
        print_r($boy);
        echo "</pre>";
    }

    public function stu150()//4、查询综合积分大于150的学生
    {
       $s_150= Db::table('student')->where('score','>','150')->select();
       echo "<pre>";
       print_r($s_150);
       echo "</pre>";
    }

    public function sco59()//7、查询综合分数少于59的学生
    {
        $s59=Db::table('student')->where('score','<','59')->select();
        echo "<pre>";
        print_r($s59);
        echo "</pre>";
    }

    public function bet ()//8、查询年龄咋18-25之间的学生
    {
        $bet=Db::table('student')->where('student_age','between',[18,25])->select();
        echo "<pre>";
        print_r($bet);
        echo "</pre>";
    }

    public function  galA20()//9、查询女生中年龄小于20的学生
    {
      //  $galA=Db::table('student')->where('student_sex','1')->where('student_age','<','20')->select();
       $galA=Db::table('student')->where('student_sex=1 and student_age < 20')->select();
        echo "<pre>";
        print_r($galA);
        echo "</pre>";
    }

    public function id5()//10、查询id为5的学生信息
    {

        $id5=Db::table('student')->where('student_id','5')->find();
        echo "<pre>";
        print_r($id5);
        echo "</pre>";
    }

    public  function  down()//11、查询综合积分在150以上的学生
    {
        $do =Db::table('student')->where('score','<','150')->select();
        echo "<pre>";
        print_r($do);
        echo "</pre>";
    }

    public function bet2()//12、查询id为5-10之间学生的综合积分
    {
        $bet=Db::table('student')->field('score')-> where('student_id','between',[5,10])->select();
        echo "<pre>";
        print_r($bet);
        echo "</pre>";
    }
}