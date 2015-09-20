<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 2/3/2556
 * Time: 0:15 น.
 * To change this template use File | Settings | File Templates.
 */
class Search_m extends CI_Model
{
    var $context = array();

    function __construct()
    {
        parent::__construct();

    }
    function getUserList()
    {

        $arr = $this->context['filter'];
        $_name = (isset($arr['name'])) ? $arr['name'] : '';
        $_lastname = (isset($arr['lastname'])) ? $arr['lastname'] : '';

        /* new query */
        /*
        $this->db->select('rg.type_name,r.traineeID,r.registrationID,r.registerstatus,r.registerBy,
        r.isPaid,p.title_th,t.name,t.prefix,t.lastname,h.name as hospitalName,t.prefix_other,r.courseID,c.coursecode,c.coursename,seatNo');
        $this->db->from('tbl_registration r');
        $this->db->join('tbl_register_type rg', 'rg.type_id = r.registerBy', 'left');
        $this->db->join('tbl_trainees t', 'r.traineeID = t.traineeID', 'left');
        $this->db->join('tbl_courses c', 'c.courseID = r.courseID', 'left');
        $this->db->join('hospital h', 't.hospitalID = h.hospitalid', 'left');
        $this->db->join('tbl_prefix_name p', 'p.id = t.prefix', 'left');
        $this->db->join('tbl_seats s', 's.registrationID = r.registrationID', 'left');
        */
        /* end new query */

        $this->db->select('t.prefix,t.name,t.lastname ,c.coursecode,c.coursename,t.prefix_other,p.title_th,s.seatNo, r.isPaid');
        $this->db->from('tbl_trainees t');
        $this->db->join('tbl_registration r','t.traineeID=r.traineeID','left');
        $this->db->join('tbl_courses c', 'c.courseID = r.courseID', 'left');
        $this->db->join('tbl_prefix_name p', 'p.id = t.prefix', 'left');
        $this->db->join('tbl_seats s', 's.registrationID = r.registrationID', 'left');
        /*
         * filter
         */
        ($_name != '') ? $this->db->like('t.name', $_name) : '';
        ($_lastname != '') ? $this->db->like('t.lastname', $_lastname) : '';

        /*
         * end filter
         */
        //$this->db->where('t.IsDelete', 0);
        $this->db->where('c.IsDelete', 0);
        $this->db->where('c.IsActive', 1);
        $this->db->where('r.refType', 0); // edit for get user registration only
        $this->db->order_by('r.registrationID', 'desc');
        $this->db->limit($this->context['limit']);
        $query = $this->db->get();
        // var_dump($query->result_array()); exit;
        return $query->result_array();
    }
}
