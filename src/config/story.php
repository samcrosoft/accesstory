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

    'session_key_name'     => 'samcro',
    //'session_key_name'     => 'Samcrosoft_AccessStory',

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
];