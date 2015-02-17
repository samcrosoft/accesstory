<?php
/**
 * Created by PhpStorm.
 * User: Adebola
 * Date: 29/08/2014
 * Time: 15:41
 */

namespace Samcrosoft\Accesstory\Core;

use Samcrosoft\Accesstory\Config\Reader;
use Samcrosoft\Accesstory\Core\Session\SessionManager;

/**
 * Class AccessStoryTrait
 * @package Samcrosoft\Accesstory\Core
 */
Trait AccessStoryTrait {
    /**
     * @var null|SessionManager
     */
    protected $oSessionManager = null;

    /**
     * This will setup the session manager to use to register the access tracker
     */
    protected  function setupSessionManager(){

        // if the session exist already, then re-use it
        if (\Session::has(Reader::getSessionKeyName()) && is_null($this->getSessionManager())){
            $this->setSessionManager(\Session::get(Reader::getSessionKeyName()));
        }
        else{
            $this->setSessionManager(new SessionManager());
        }
    }

    /**
     * @return null|SessionManager
     */
    public function getSessionManager()
    {
        return $this->oSessionManager;
    }

    /**
     * @param null|SessionManager $oSessionManager
     */
    public function setSessionManager($oSessionManager)
    {
        $this->oSessionManager = $oSessionManager;
        // save it to the session here
        \Session::flash(Reader::getSessionKeyName(), $oSessionManager);
    }
} 