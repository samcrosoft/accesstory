<?php
/**
 * Created by PhpStorm.
 * User: Adebola
 * Date: 29/08/2014
 * Time: 12:01
 */

namespace Samcrosoft\Accesstory\Config;

use Config;
use Samcrosoft\Accesstory\Facade\Facade;

/**
 * Class Reader
 * @package Samcrosoft\Accesstory\Config
 */
class Reader {

    /**
     * @static
     * @var string
     */
    const CONFIG_KEY_SESSION_KEY_NAME = "session_key_name";
    /**
     * @static
     * @var string
     */
    const CONFIG_KEY_INCLUDE_LARAVEL_BOOT = "include_laravel_boot";
    /**
     *
     */
    const STORY_CONFIG_FILENAME = "story";

    /**
     * @param $sKey
     * @return string
     */
    public static function remapConfigName($sKey){
        return Facade::FACADE_NAME."::".self::STORY_CONFIG_FILENAME .".".$sKey;
    }

    /**
     * @param $sKey
     * @param null $mDefault
     * @return mixed
     */
    private static function getPackageConfigItem($sKey, $mDefault = null){
        return Config::get(
            self::remapConfigName($sKey, $mDefault)
        );
    }
    /**
     * @return mixed
     */
    public static function getSessionKeyName(){
        return self::getPackageConfigItem(self::CONFIG_KEY_SESSION_KEY_NAME);
    }

    /**
     * @return boolean
     */
    public static function includeLaravelBootTime(){
        return (bool) (self::getPackageConfigItem(self::CONFIG_KEY_SESSION_KEY_NAME));
    }
} 