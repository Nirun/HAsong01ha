<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 30/10/2555
 * Time: 0:41 น.
 * To change this template use File | Settings | File Templates.
 */
class Log
{
    static $CI;
    var $userContext = array();
    var $context = array();

    function __construct()
    {
        // $this->CI = & get_instance();
        self::$CI = & get_instance();
    }

    public static function setLog($logTypeID = 2, $userID = 0, $data = array())
    {
        $dataLog = array(
            'userID' => $userID,
            'logType' => $logTypeID,
            'logData' => json_encode($data)
        );
        return self::set($dataLog);
    }

    private function set($data = array())
    {
        $res = false;
        self::$CI->load->model('log_m', 'log_m');
        $res = self::$CI->log_m->addLog($data);
        return $res;
    }
    public static function getLog($logTypeID = 2, $userID = 0,$limit = 25,$page = 1,$sort = 'desc'){
        $data = array(
            'logTypeID'=>$logTypeID,
            'userID'=>$userID,
            'limit'=>$limit,
            'page'=>($page * $limit) - $limit,
            'sort'=>$sort
        );
        $res = false;
        self::$CI->load->model('log_m', 'log_m');
        $res = self::$CI->log_m->getLog($data);
        return $res;
    }
}
