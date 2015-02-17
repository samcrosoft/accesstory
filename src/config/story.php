<?php
/**
 * Created by PhpStorm.
 * User: Adebola
 * Date: 29/08/2014
 * Time: 11:58
 */


return [

    /*
    |--------------------------------------------------------------------------
    | Session Key Entry Name
    |--------------------------------------------------------------------------
    |
    | The AccessStory package is highly dependent on the session
    | Hence we store bits and pieces of data in a session
    | You can alter the name of the key here
    |
    */

    'session_key_name'     => 'accesstory_store',

    /*
    |--------------------------------------------------------------------------
    | Include Application Booting Duration In Response Time Calculation
    |--------------------------------------------------------------------------
    |
    | if this is set to true, the response time will include the entire
    | time spent booting laravel
    | In my opinion, this should be left as true
    |
    */

    'include_laravel_boot' => TRUE,

    /*
    |--------------------------------------------------------------------------
    | Name of Custom Method in The BaseController [/Controller Class]
    |--------------------------------------------------------------------------
    |
    | The flexibility of the accessstory package is that you can extend it
    | You can extend the columns in the table by editing the migration after publishing it to your codebase
    |
    | This value represents the name of the method to be added to the [Controller] class or majorly its extended classes
    | BaseController ->
    | This method should return an array of values to be added to the accesstory table
    |
    */
    'custom_controller_method_name' => 'accessHistoryExtraData',


    /*
    |--------------------------------------------------------------------------
    | Name of event to be called
    |--------------------------------------------------------------------------
    |
    |
    */
    'event_fire_name'   => 'samcrosoft.events.accesstory'

    /*
    |--------------------------------------------------------------------------
    | Name of the table name for the accesstory
    |--------------------------------------------------------------------------
    |
    |
    */
    'table_name' => 'AccessStory'
];