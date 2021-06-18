<?php
namespace app\index\controller;
use think\Db;

class Testa
{
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
    public function  strName ($len=0)
    {
        $str='';
        for ($i=0;$i<$len;$i++) {
            $str.=$this->randStr();
        }
        return $str;
    }

    public function aa()
    {
        for ($i=0;$i<10;$i++){
            $s=$this->strName(3);
            echo $s."<br>";
        }

    }
}