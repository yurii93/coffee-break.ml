<?php

namespace Common;

class Functions
{
    /*
     * Returns string with first letter
     * in uppercase (UTF_8 encoding)
     */
    public static function ucfirst_utf8($str)
    {
        return mb_substr(mb_strtoupper($str, 'utf-8'), 0, 1, 'utf-8') . mb_substr($str, 1, mb_strlen($str)-1, 'utf-8');
    }

    /*
     * Cuts text up to a certain number of sentences
     */
    public  static function sentence($string, $quantity)
    {
        return implode('. ', array_slice(explode('.', $string), 0, $quantity)). '.';
    }


}