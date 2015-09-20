<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 30/10/2555
 * Time: 0:44 น.
 * To change this template use File | Settings | File Templates.
 */
class Log_m extends CI_Model
{
    function addLog($data = array())
    {
        $ok = false;
        $chkInsert = $this->db->insert('tbl_log', $data);
        if ($chkInsert) {
            $ok = true;
        }
        return $ok;
    }

    function getLog($data = array())
    {
        $res = array();
        $userID = $data['userID'];
        $logTypeID = $data['logTypeID'];
        $limit = $data['limit'];
        $page = $data['page'];
        $this->db->order_by('logID', $data['sort']);
        $res = $this->db->get_where('tbl_log', array('userID' => $userID, 'logType' => $logTypeID), $limit, $page)
            ->result_array();
        return $res;
    }
}
