<?php
/**
 * Created by PhpStorm.
 * User: Sofia
 * Date: 30/04/2017
 * Time: 03:47 PM
 */

namespace App\Http\Controllers;


class directories
{

    public static $imagesAplicationPath =  'images/aplication/';
    // public static $imagesLogoPath =  'images/logo/';


//    public static $imagesAplicationPath =  '../lilianapineda/images/aplication/';
//    public static $imagesLogoPath =  '../lilianapineda/images/logo/';

    public static function  getAplicationPath() {
        return self::$imagesAplicationPath;

    }

    public static function getPermissionPath() {
        return self::$imagesAplicationPath . 'permission/';
    }

    public static function getUserPath() {
        return self::$imagesAplicationPath . 'user/';
    }

    // public static function getClientPath() {
    //     return self::$imagesAplicationPath . 'clients/';
    // }

    // public static function getMaskPath() {
    //     return self::$imagesLogoPath;
    // }
    
}