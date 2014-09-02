<?php
/**
 * Created by PhpStorm.
 * User: Adebola
 * Date: 29/08/2014
 * Time: 11:52
 */

namespace Samcrosoft\Accesstory\Core;

use Samcrosoft\Accesstory\Config\Reader;
use Samcrosoft\Accesstory\Core\Model\AccessStoryModel;

/**
 * Class AccessStory
 * @package Samcrosoft\Accesstory\Core
 */
class AccessStory
{

    // use access story trait
    use AccessStoryTrait;

    /**
     *
     */
    public function __construct()
    {
        $this->setupSessionManager();
    }


    /**
     * This is the start of the story telling
     */
    public function composeStory()
    {
        // initiate the start time to now
        $this->getSessionManager()->setStartTime();
    }

    /**
     * This will save the access story to the database
     */
    public function saveStory()
    {
        // set the end time
        $this->getSessionManager()->setEndTime();
        // calculate the memory usage
        $this->getSessionManager()->setMemoryUsage();

        // get the collected data
        $aData = $this->getSessionManager()->getCollectedData();
        $aData = array_merge($aData, [
            'response_time' => $this->getSessionManager()->getTimeTaken(),
            'memory_usage'  => $this->getSessionManager()->getMemoryUsage()
        ]);

        // save the access history now
        AccessStoryModel::create($aData);

        // remove the session, so that it would always be unique across each request
        \Session::remove(Reader::getSessionKeyName());
    }


    /**
     * @param \Controller $oController
     */
    public function publishStory(\Controller $oController)
    {
        $oRequestInstance = \Request::instance();
        $oRouteInstance = \Route::current();

        // get the extra custom data supplied by the user
        $aCustomData = $this->getCustomSuppliedData($oController);

        $uri = head($oRouteInstance->methods()) . ' ' . $oRouteInstance->uri();
        $aData = [
            'ip_address'       => \Input::getClientIp(),
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

        // merge the custom data to the already built data
        $aData = array_merge($aData, $aCustomData);

        // save the collected data
        $this->getSessionManager()->saveCollectedData($aData);

    }

    /**
     * This method will fire the Event structure of Laravel to listen to calls to save the access story
     */
    public static function listenForInterviews(){
        // note - the name of the publish story event must be the same as that of the publish method
        $PublishMethodName = "publishStory";
        $sPublishClassMethod = __CLASS__."@{$PublishMethodName}";
        \Event::listen(Reader::getEventName(), $sPublishClassMethod);
    }

    /**
     * This will call for an interview from the controller
     * @param \Controller $oController
     */
    public static function callForInterviews(\Controller $oController){
        \Event::fire(Reader::getEventName(), $oController);
    }


    /**
     * @param \Controller $oController
     * @return array|mixed
     */
    private function getCustomSuppliedData(\Controller $oController)
    {
        $aOverLoadedData        = [];
        $sOverLoadedFunction    = Reader::getCustomDataMethodName();
        if (method_exists($oController, $sOverLoadedFunction)) {
            $aOverLoadedData    = call_user_func_array([$oController, $sOverLoadedFunction], []);
            $aOverLoadedData    = is_array($aOverLoadedData) ? $aOverLoadedData : [];
        }

        return $aOverLoadedData;
    }
} 