<?php
/**
 * Created by PhpStorm.
 * User: Adebola
 * Date: 29/08/2014
 * Time: 11:52
 */

namespace Samcrosoft\Accesstory\Core;
use App\Models\Audits\AccessHistory;
use Samcrosoft\Accesstory\Config\Reader;

/**
 * Class AccessStory
 * @package Samcrosoft\Accesstory\Core
 */
class AccessStory {

    // use access story trait
    use AccessStoryTrait;

    /**
     */
    public function __construct(){
        $this->setupSessionManager();
    }


    /**
     * This is the start of the story telling
     */
    public function composeStory(){
        // initiate the start time to now
        $this->getSessionManager()->setStartTime();
    }

    /**
     *
     */
    public function saveStory(){
        // set the end time
        $this->getSessionManager()->setEndTime();
        // calculate the memory usage
        $this->getSessionManager()->setMemoryUsage();

        // get the collected data
        $aData = $this->getSessionManager()->getCollectedData();
        $aData = array_merge($aData, [
            'response_time'    => $this->getSessionManager()->getTimeTaken(),
            'memory_usage'     => memory_get_usage(true)
        ]);

        // save the access history nw
        AccessHistory::create($aData);

        // remove the session, so that it would always be unique across each request
        \Session::remove(Reader::getSessionKeyName());

    }


    /**
     * @param \BaseController $oController
     */
    public function publishStory(\BaseController $oController){

        $oRequestInstance = \Request::instance();
        $iLoginID         = $oController->getWebSessionProvider()
            ->getWebSession()->getLoginHistory()->getLoginHistoryID();
        $oRouteInstance   = \Route::current();

        $uri = head($oRouteInstance->methods()) . ' ' . $oRouteInstance->uri();
        $aData = [
            'LoginID'          => $iLoginID,
            'IPAddress'        => \Input::getClientIp(),
            'domain'           => \Request::root(),
            'path'             => \Request::path(),
            'request_method'   => $oRequestInstance->getMethod(),
            'query_string'     => $oRequestInstance->getQueryString(),
            'post_string'      => \Request::method() == "POST" ? json_encode(\Input::all()) : NULL,
            'is_ajax'          => \Request::ajax(),
            'is_secure'        => \Request::secure(),
            'route_uri'        => $uri ?: '-',
            'route_name'       => $oRouteInstance->getName() ?: '-',
            'route_action'     => $oRouteInstance->getActionName() ?: '-',

            'class_controller' => get_class($oController),
            'class_method'     => \Request::method(),
        ];

        // save the collected data
        $this->getSessionManager()->saveCollectedData($aData);

    }
} 