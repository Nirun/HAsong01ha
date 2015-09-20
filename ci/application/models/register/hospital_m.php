<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 15/11/2555
 * Time: 23:54 น.
 * To change this template use File | Settings | File Templates.
 */
class Hospital_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }
    function getHospital(){
        $this->db->select('hospitalid, name, belong,hospitaltype,bed');
        $this->db->order_by('name','asc');
        $query = $this->db->get('hospital');
        return $query->result_array();
    }
}
