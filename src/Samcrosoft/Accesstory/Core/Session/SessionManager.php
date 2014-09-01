<?php
/**
 * Created by PhpStorm.
 * User: Adebola
 * Date: 29/08/2014
 * Time: 12:57
 */

namespace Samcrosoft\Accesstory\Core\Session;
use Samcrosoft\Accesstory\Config\Reader;

/**
 * Class SessionManager
 * @package Samcrosoft\Accesstory\Core\Session
 */
class SessionManager {

    /**
     * @var null|float
     */
    private $fStartTimeStore = null;
    /**
     * @var null
     */
    private $fEndTime   = null;

    /**
     * @var null
     */
    private $fMemoryUsage = null;

    /**
     * @var array
     */
    public $aCollectedData = [];


    /**
     * @return float|null
     */
    public function getStartTime()
    {
        return $this->fStartTimeStore;
    }

    /**
     */
    public function setStartTime()
    {
        // set the time to the start of laravel
        $this->fStartTimeStore = Reader::includeLaravelBootTime() ? LARAVEL_START : microtime(true);
    }

    /**
     *
     */
    public function setEndTime(){
        $this->fEndTime = microtime(true);
    }

    /**
     * @return null
     */
    public function getEndTime(){
        if(is_null($this->fEndTime))
            $this->setEndTime();

        return $this->fEndTime;
    }

    /**
     * This will return the time take
     */
    public function getTimeTaken(){
        return round($this->getEndTime() - $this->getStartTime(), 6);
    }

    /**
     * This will set the memory usage for the current request[session]
     */
    public function setMemoryUsage(){
        $this->fMemoryUsage = memory_get_usage(TRUE);
    }

    /**
     * @return string
     */
    public function getMemoryUsage(){
        if(empty($this->fEndTime)) $this->setMemoryUsage();

        return $this->fMemoryUsage;
    }

    /**
     * @param array $aData
     */
    public function saveCollectedData($aData = []){
        $this->aCollectedData = $aData;
    }

    /**
     * @return array
     */
    public function getCollectedData(){
        return $this->aCollectedData;
    }



} 