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
     * @static
     * @var string
     */
    const CONFIG_KEY_CUSTOM_CONTROLLER_METHOD_NAME = "custom_controller_method_name";
    /**
     * @static
     * @var string
     */
    const CONFIG_KEY_EVENT_FIRE_NAME = "event_fire_name";
    /**
     * @static
     * @var string
     */
    const DEFAULT_EVENT_FIRE_NAME    = "samcrosoft.events.accesstory";
    /**
     * @static
     * @var string
     */
    const STORY_CONFIG_FILENAME = "story";

    /**
     * @static
     * @var string
     */
    const CONFIG_KEY_TABLE_NAME = "table_name";

    /**
     * Configure the config file name to use the laravel5 stucture
     * @param $sKey
     * @return string
     */
    public static function remapConfigName($sKey){
        return self::STORY_CONFIG_FILENAME .".".$sKey;
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
     * This will return the name of the session key in the global session
     * @return mixed
     */
    public static function getSessionKeyName(){
        return self::getPackageConfigItem(self::CONFIG_KEY_SESSION_KEY_NAME);
    }

    /**
     * This will return a boolean that indicates if the laravel boot time should be included in the
     * time calculation
     * @return boolean
     */
    public static function includeLaravelBootTime(){
        return (bool) (self::getPackageConfigItem(self::CONFIG_KEY_SESSION_KEY_NAME));
    }

    /**
     * This returns the name of the method that be used to supply custom data
     * @return string
     */
    public static function getCustomDataMethodName(){
        return strval(self::getPackageConfigItem(
            self::CONFIG_KEY_CUSTOM_CONTROLLER_METHOD_NAME
        ));
    }


    /**
     * This will return the string that can be used to call the event
     * @return string
     */
    public static function getEventName(){
        return strval(self::getPackageConfigItem(
            self::CONFIG_KEY_EVENT_FIRE_NAME, self::DEFAULT_EVENT_FIRE_NAME
        ));
    }

    /**
     * This will return the table name from the configuration file
     * @return string
     */
    public static function getTableName()
    {
        return strval(self::getPackageConfigItem(
            self::CONFIG_KEY_TABLE_NAME
        ));
    }
} 