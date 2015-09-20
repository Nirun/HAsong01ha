<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 8/10/2555
 * Time: 1:07 น.
 * To change this template use File | Settings | File Templates.
 */
class Mail_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

    function getTemplate()
    {
        return $this->db->get_where('tbl_template_email', array('IsDelete' => 0))->result_array();
    }

    function getMailForm($tpID = 0)
    {
        $this->db->select('tp_code');
        return $this->db->get_where('tbl_template_email', array('tp_id' => $tpID), 1, 0)->result_array();
    }

    function getMailList($id = 0)
    {
        $this->db->select('t.traineeID,t.email');
        $this->db->from('tbl_registration r');
        $this->db->join('tbl_trainees t', 't.traineeID=r.traineeID', 'left');
        $this->db->where('r.courseID', $id);
        $this->db->where('t.IsDelete', 0);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function save_template()
    {
        $data = array(
            'tp_name' => $this->input->post('name'),
            'tp_code' =>$this->input->post('detail'),
            //'tp_code' => base64_encode($this->input->post('detail')),
        );
        return $this->db->insert('tbl_template_email', $data);
    }
/*
 * Add email to inbox
 * $user_id = 0;
 * $title = '';
 * $detail = '';
 */
    function add_inbox($user_id = 0, $title = '', $detail = '')
    {
        $data = array(
            'user_id' => $user_id,
            'title' => $title,
            'detail' => $detail,
            'is_read' => 0,
            'is_delete' => 0
        );
        return $this->db->insert('tbl_inbox', $data);
    }

    function mark_read($inbox_id = 0)
    {
        $query = null;
        $data = array(
            'is_read' => 1
        );
        $this->db->where('inbox_id', $inbox_id);
        $query = $this->db->update('tbl_inbox', $data);
        return $query;
    }
    function delete_inbox($inbox_id = 0)
    {
        $query = null;
        $data = array(
            'is_delete' => 1
        );
        $this->db->where('inbox_id', $inbox_id);
        $query = $this->db->update('tbl_inbox', $data);
        return $query;
    }
    function getCountUnread($id){
        $this->db->where(array('user_id'=>$id,'is_delete'=>0,'is_read'=>0));
        $this->db->from('tbl_inbox');
        return $this->db->count_all_results();
    }
    function getUserMailList($id){
        $this->db->order_by("inbox_id", "desc");
        return $this->db->get_where("tbl_inbox", array('is_delete'=>0,'user_id'=>$id))->result_array();

    }
    function getUserMailDesc($id){
        return $this->db->get_where("tbl_inbox", array('is_delete'=>0,'inbox_id'=>$id),1,0)->result_array();

    }
    function getListRemind(){
        $this->db->select('t.name,t.lastname,t.email,c.coursecode,c.coursename,c.startdate,c.enddate,c.place, r.registrationID,t.traineeID,r.refType,r.courseID,r.billing_ref1,r.billing_ref2,r.registerdatetime,r.IsPaid');
        $this->db->from('tbl_registration r');
        $this->db->join('tbl_trainees t','r.traineeID = t.traineeID','left');
        $this->db->join('tbl_courses c','r.courseID = c.courseID','left');
        $criteria = array(
            'r.traineeID  >' => 0,
            'r.refID' => 0,
            'r.IsPaid !='=>1,
            'date(r.registerdatetime) <=' => date('Y-m-d',strtotime("-15 day"))
        );
        $this->db->order_by('r.registerdatetime','desc');
        $this->db->where($criteria);
        return $this->db->get()->result_array();
    }

}
