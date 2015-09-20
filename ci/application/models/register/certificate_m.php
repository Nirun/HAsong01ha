<?php

/**
 * Created by PhpStorm.
 * User: Nirun
 * Date: 25/12/2557
 * Time: 1:01 น.
 */
class Certificate_m extends CI_Model
{
    var $context = array();

    function __construct()
    {
        parent::__construct();

    }

    function setTemplate()
    {
        $id = $this->context['id'];
        $data = array(
            'txt' => $this->context['txt']
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_certificate_template', $data);
    }

    function getTemplate()
    {
        $id = $this->context['id'];
        $sql = $this->db->get_where('tbl_certificate_template', array('id' => $id));
        if ($sql->num_rows() > 0) {
            return  $sql->first_row()->txt;
        } else {
            return '';
        }

    }
    function getTemplateName(){
        $id = $this->context['id'];
        $sql = $this->db->get_where('tbl_certificate_template', array('id' => $id));
        if ($sql->num_rows() > 0) {
            return  $sql->result_array();
        } else {
            return null;
        }
    }
} 