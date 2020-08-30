<?php

class Random
{
    private static $vocals = 'aeiou';
    private static $consonants = 'bcdfghjklmnpqrstvwxyz';
    private static $doublec = array('St','Nd','Tl','Ch','Nt','Sh','Sm','Dr','Miel','Mail','Hur');
    private static $doublev = array('Ai','Ae','Oi');
    private static $name = "";
    private static $vorc = false; //false = vocal
    
    static function name($length)
    {
        self::$name = "";
        while(strlen(self::$name) < $length){
            if (strlen(self::$name) == 0) {
                self::$name .= self::namGetStr();
                self::$name[0] = strtoupper(self::$name[0]);
            }else {
                self::$name .= strtolower(self::namGetStr(self::$vorc));
            }
        }

        return self::$name;
    }

    private static function namGetStr($vorc = null)
    {
        $chars;
        if($vorc === null){
            switch (mt_rand(0,3)) {
                case 0: $chars = self::$vocals;self::$vorc = false; break;
                case 1: $chars = self::$consonants;self::$vorc = true;break;
                case 2: $chars = self::$doublec;self::$vorc = true;break;
                case 3; $chars = self::$doublev;self::$vorc = false;break;
            }
        }else {
            if ($vorc) {
                switch (mt_rand(0,1)) {
                    case 0: $chars = self::$vocals;self::$vorc = false; break;
                    case 1; $chars = self::$doublev;self::$vorc = false;break;
                }
            }else {
                switch (mt_rand(0,1)) {
                    case 0: $chars = self::$consonants;self::$vorc = true; break;
                    case 1; $chars = self::$doublec;self::$vorc = true;break;
                }
            }
        }

        $len = (gettype($chars) === "array") ? count($chars) : strlen($chars);
        $tmp = $chars[rand(0,$len-1)];
        return $tmp;
    }
}
