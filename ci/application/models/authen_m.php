<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 28/10/2555
 * Time: 0:20 น.
 * To change this template use File | Settings | File Templates.
 */
class Authen_m extends CI_Model
{
    var $context = array();

    function loginAdmin()
    {
        $filter = array(
            'username' => $this->context['user'],
            'password' => $this->context['password']
        );
        $this->db->select('adminID,firstname,lastname');
        $query = $this->db->get_where('tbl_admin', $filter);
        return $query->result_array();
    }
    function loginUser()
    {
        $filter = array(
            'username' => $this->context['user'],
            'password' => $this->context['password']
        );
        $this->db->select('traineeID,prefix,prefix_other,name,lastname');
        $query = $this->db->get_where('tbl_trainees', $filter);
        return $query->result_array();
    }

}
