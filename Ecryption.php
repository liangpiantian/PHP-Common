<?php
namespace think;
class Ecryption
{
    static $secret="tiandire";
    public static function ecrypt($str)
    {
        $block=mcrypt_get_block_size('des','ecb');//8
        $pad=$block-(strlen($str) % $block);//7
        $str.=str_repeat(chr($pad),$pad);
        //$str.=str_repeat(' ',$pad);
        $encdata=mcrypt_encrypt(MCRYPT_DES,self::$secret,$str,MCRYPT_MODE_ECB);
        return urlencode(base64_encode($encdata));
    }

    public static function decrypt($str)
    {
        $decdata=mcrypt_decrypt(MCRYPT_DES,self::$secret,base64_decode(urldecode($str)),MCRYPT_MODE_ECB);//调用解密算法
        $pad=ord($decdata[strlen($decdata)-1]);//获得添加的字符，并通过ord()获得字符对应的ASCII码，也就是那个余数
        $result=substr($decdata,0,strlen($decdata)-$pad);//获得最终解密结果
        return $result;
    }
}