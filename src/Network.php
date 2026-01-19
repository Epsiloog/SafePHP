<?php
namespace SafePHP;

class Network {
    private static array $WhiteList;
    private static array $GreyList;
    private static array $BlackList;

    public static function getWhiteList(){
        return self::$WhiteList;
    }
    public static function getGreyList(){
        return self::$GreyList;
    }   
    public static function getBlackList(){
        return self::$BlackList;
    }
    public static function createWhiteList($AList) {
        return self::$WhiteList = $AList;
    }
    public static function createGreyList($AList){
        return self::$GreyList = $AList;
    }
    public static function createBlackList($AList){
        return self::$BlackList = $AList;
    }

    public static function addWhiteList(){

    }
    public static function addGreyList(){

    }
    public static function addBlackList(){

    }

    public static function deleteWhiteList(){
        return self::$WhiteList = [];
    }
    public static function deleteGreyList(){
        return self::$GreyList = [];
    }
    public static function deleteBlackList(){
        return self::$BlackList = [];
    }
}