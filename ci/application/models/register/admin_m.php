<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 24/10/2555
 * Time: 1:03 น.
 * To change this template use File | Settings | File Templates.
 */
class Admin_m extends CI_Model
{
    var $context = array();

    function __construct()
    {
        parent::__construct();

    }

    function getPermission()
    {
        return $this->db->get('tbl_permission')->result_array();
    }

    function addAdmin()
    {
        $ok = false;
        $now = date('Y-m-d H:i:s');
        $data = array(
            'firstname' => $this->input->post('name'),
            'lastname' => $this->input->post('lname'),
            'position' => $this->input->post('position'),
            'username' => $this->input->post('user'),
            'password' => $this->input->post('password'),
            'IsDelete' => 0,
            'createdatetime' => $now,
            'createuser' => $this->context['adminID'],
            'lastupdatetime' => $now,
            'updateuser' => $this->context['adminID']
        );

        $this->db->trans_begin();
        $chkInsert = $this->db->insert('tbl_admin', $data);
        $adminID = $this->db->insert_id();
        if (!$chkInsert) {
            $this->db->trans_rollback();
        } else {
            $data2 = array();
            foreach ($this->input->post('permission') as $key => $val) {
                $data2[] = array(
                    'adminID' => $adminID,
                    'permissionID' => $val
                );
            }
            $autID = $this->db->insert_batch('tbl_authorize', $data2);
            if (!$autID) {
                $this->db->trans_rollback();
            } else {
                $ok = true;
                $this->db->trans_commit();
            }
        }
        return $ok;
    }

    function editAdmin()
    {
        $ok = false;
        $now = date('Y-m-d H:i:s');
        $adminID= trim($this->input->post('adminId'));
        $data = array(
            'firstname' => $this->input->post('name'),
            'lastname' => $this->input->post('lname'),
            'position' => $this->input->post('position'),
            'lastupdatetime' => $now,
            'updateuser' => $this->context['adminID']
        );
        if (trim($this->input->post('password')) != '') {
            $data['password'] = $this->input->post('password');
        }

        $this->db->trans_begin();
        $this->db->where('adminID', $adminID);
        $chkInsert = $this->db->update('tbl_admin', $data);
        if (!$chkInsert) {
            $this->db->trans_rollback();
        } else {
            $this->db->delete('tbl_authorize',array('adminID'=>$adminID));
            $data2 = array();
            foreach ($this->input->post('permission') as $key => $val) {
                $data2[] = array(
                    'adminID' => $adminID,
                    'permissionID' => $val
                );
            }
            $autID = $this->db->insert_batch('tbl_authorize', $data2);
            if (!$autID) {
                $this->db->trans_rollback();
            } else {
                $ok = true;
                $this->db->trans_commit();
            }
        }
        return $ok;
    }

    function getAdminList()
    {
        $this->db->select('adminID,firstname,lastname,position');
        $this->db->from('tbl_admin');
        $this->db->where('IsDelete', 0);
        $rest = $this->db->get();
        return $rest->result_array();
    }

    function getPermissionByAdmin($adminID)
    {
        $this->db->select('tbl_permission.permission');
        $this->db->from('tbl_authorize');
        $this->db->join('tbl_permission', 'tbl_permission.permissionID = tbl_authorize.permissionID', 'left');
        $this->db->where('tbl_authorize.adminID', $adminID);
        $this->db->limit($this->context['limit'], $this->context['page']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function valid_m()
    {
        $ok = false;
        $username = $this->input->get('user');
        $query = $this->db->get_where('tbl_admin', array('username' => $username));
        if ($query->num_rows() === 0) {
            $ok = true;
        }
        return $ok;
    }

    function del_admin($id)
    {
        $data = array(
            'IsDelete' => 1
        );
        $this->db->where('adminID', $id);
        $res = $this->db->update('tbl_admin', $data);
        return $res;
    }

    function get_user($id = 0)
    {
        $query = $this->db->get_where('tbl_admin', array('adminID' => $id), 1, 0);
        return $query->result_array();
    }

    function getAuthenByUserId($id = 0)
    {
        $this->db->select('permissionID');
        $query = $this->db->get_where('tbl_authorize', array('adminID' => $id));
        return $query->result_array();
    }

}
