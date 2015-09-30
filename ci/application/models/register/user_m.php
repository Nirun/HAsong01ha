<?php

/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 30/9/2555
 * Time: 16:40 น.
 * To change this template use File | Settings | File Templates.
 */
class User_m extends CI_Model
{
    var $context = array();

    function __construct()
    {
        parent::__construct();

    }

    function getOccupation()
    {
                return $this->db->get('tbl_occupation')->result_array();
    }
    function getOccupationByID($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_occupation');
        $this->db->where_in('id',$id);
        return $this->db->get()->result_array();
    }
    function getPrefixName()
    {
        return $this->db->get('tbl_prefix_name')->result_array();
    }

    function getPosition()
    {
        return $this->db->get('tbl_position')->result_array();
    }

    function getRegisType()
    {
        return $this->db->get(' tbl_register_type')->result_array();
    }

    function getAddType()
    {
        return $this->db->get(' tbl_address_type')->result_array();
    }

    function getProvince()
    {
        $this->db->select('PROVINCE_CODE,PROVINCE_NAME');
        return $this->db->get('tbl_province')->result_array();
    }

    function getCountUserList()
    {
        $this->db->from('tbl_registration');
        $this->db->join('tbl_trainees', 'tbl_trainees.traineeID = tbl_registration.traineeID', 'left');
        $this->db->where('tbl_registration.courseID', $this->context['courseID']);
        return $this->db->count_all_results();
    }

    function getCountUserListByFilter_bk()
    {

        $arr = $this->context['filter'];
        $_name = (isset($arr['name'])) ? $arr['name'] : '';
        $_lastname = (isset($arr['lastname'])) ? $arr['lastname'] : '';
        $_register_type = (isset($arr['register_type'])) ? $arr['register_type'] : '';
        $_occupation = (isset($arr['position'])) ? $arr['position'] : '';
        $_hospital = (isset($arr['hospital'])) ? $arr['hospital'] : '';
        $_course = (isset($arr['course'])) ? $arr['course'] : '';

        $this->db->select('tbl_trainees.traineeID,prefix,title_th,prefix_other,tbl_trainees.name as name,
        tbl_trainees.lastname as lastname,type_name,hospital.name as hospitalName,isPaid,
        (select count(tr.registrationID) from tbl_registration as tr where tr.traineeID = tbl_trainees.traineeID) as total_course');
        $this->db->from('tbl_registration');
        $this->db->join('tbl_trainees', 'tbl_trainees.traineeID = tbl_registration.traineeID', 'left');
        $this->db->join('hospital', 'tbl_trainees.hospitalID = hospital.hospitalid', 'left');
        $this->db->join('tbl_prefix_name', 'tbl_prefix_name.id = tbl_trainees.prefix', 'left');
        $this->db->join('tbl_register_type', 'tbl_register_type.type_id = tbl_trainees.registrationtype', 'left');
        /*
         * filter
         */
        ($_name != '') ? $this->db->like('tbl_trainees.name', $_name) : '';
        ($_lastname != '') ? $this->db->like('tbl_trainees.lastname', $_lastname) : '';
        ($_register_type != '') ? $this->db->where('tbl_trainees.registrationtype', $_register_type) : '';
        ($_occupation != '') ? $this->db->where('tbl_trainees.professiontypeID', $_occupation) : '';
        ($_hospital != '') ? $this->db->where('tbl_trainees.hospitalID', $_hospital) : '';
        ($_course != '') ? $this->db->where('tbl_registration.courseID', $_course) : '';
        /*
         * end filter
         */
        $this->db->where('tbl_trainees.IsDelete', 0);
        return $this->db->count_all_results();
    }

    function getCountUserListByFilter()
    {
        $arr = $this->context['filter'];
        $_name = (isset($arr['name'])) ? $arr['name'] : '';
        $_lastname = (isset($arr['lastname'])) ? $arr['lastname'] : '';
        $_register_type = (isset($arr['register_type'])) ? $arr['register_type'] : '';
        $_occupation = (isset($arr['position'])) ? $arr['position'] : '';
        $_hospital = (isset($arr['hospital'])) ? $arr['hospital'] : '';
        $_course = (isset($arr['course'])) ? $arr['course'] : '';

        /* new query */
        $this->db->select('rg.type_name,r.traineeID,r.registrationID,r.registerstatus,r.registerBy,
        r.isPaid,p.title_th,t.name,t.prefix,t.lastname,h.name as hospitalName,t.prefix_other,
        (select count(tr.registrationID) from tbl_registration as tr where tr.traineeID = r.traineeID and tr.refType=0) as total_course');
        $this->db->from('tbl_registration r');
        $this->db->join('tbl_register_type rg', 'rg.type_id = r.registerBy', 'left');
        $this->db->join('tbl_trainees t', 'r.traineeID = t.traineeID', 'left');
        $this->db->join('hospital h', 't.hospitalID = h.hospitalid', 'left');
        $this->db->join('tbl_prefix_name p', 'p.id = t.prefix', 'left');
        /*
        * filter
        */
        ($_name != '') ? $this->db->like('t.name', $_name) : '';
        ($_lastname != '') ? $this->db->like('t.lastname', $_lastname) : '';
        ($_register_type != '') ? $this->db->where('r.registerBy', $_register_type) : '';
        ($_occupation != '') ? $this->db->where('t.professiontypeID', $_occupation) : '';
        ($_hospital != '') ? $this->db->where('t.hospitalID', $_hospital) : '';
        ($_course != '') ? $this->db->where('r.courseID', $_course) : '';
        /*
         * end filter
         */
        //$this->db->where('t.IsDelete', 0);
        $this->db->where('r.refType', 0); // edit for get user registration only
        $this->db->where('r.isDelete', 0);
        $this->db->order_by('r.registrationID', 'desc');

        $query = $this->db->count_all_results();
        return $query;
    }

    function getUserList()
    {

        $arr = $this->context['filter'];
        $_name = (isset($arr['name'])) ? $arr['name'] : '';
        $_lastname = (isset($arr['lastname'])) ? $arr['lastname'] : '';
        $_register_type = (isset($arr['register_type'])) ? $arr['register_type'] : '';
        $_occupation = (isset($arr['position'])) ? $arr['position'] : '';
        $_hospital = (isset($arr['hospital'])) ? $arr['hospital'] : '';
        $_course = (isset($arr['course'])) ? $arr['course'] : '';

        /* new query */
        $this->db->select('rg.type_name,r.traineeID,r.registrationID,r.registerstatus,r.registerBy,
        r.isPaid,p.title_th,t.name,t.prefix,t.lastname,h.name as hospitalName,t.prefix_other,
        (select count(tr.registrationID) from tbl_registration as tr where tr.traineeID = r.traineeID and tr.refType=0) as total_course');
        $this->db->from('tbl_registration r');
        $this->db->join('tbl_register_type rg', 'rg.type_id = r.registerBy', 'left');
        $this->db->join('tbl_trainees t', 'r.traineeID = t.traineeID', 'left');
        $this->db->join('hospital h', 't.hospitalID = h.hospitalid', 'left');
        $this->db->join('tbl_prefix_name p', 'p.id = t.prefix', 'left');

        /* end new query */

        /*
        $this->db->select('tbl_trainees.traineeID,prefix,title_th,prefix_other,tbl_trainees.name as name,
        tbl_trainees.lastname as lastname,type_name,hospital.name as hospitalName,isPaid,
        (select count(tr.registrationID) from tbl_registration as tr where tr.traineeID = tbl_trainees.traineeID and tbl_registration.refType=0) as total_course');
        $this->db->from('tbl_registration');
        $this->db->join('tbl_trainees', 'tbl_trainees.traineeID = tbl_registration.traineeID', 'right');
        $this->db->join('hospital', 'tbl_trainees.hospitalID = hospital.hospitalid', 'left');
        $this->db->join('tbl_prefix_name', 'tbl_prefix_name.id = tbl_trainees.prefix', 'left');
        $this->db->join('tbl_register_type', 'tbl_register_type.type_id = tbl_trainees.registrationtype', 'left');
*/
        /*
         * filter
         */
        ($_name != '') ? $this->db->like('t.name', $_name) : '';
        ($_lastname != '') ? $this->db->like('t.lastname', $_lastname) : '';
        ($_register_type != '') ? $this->db->where('r.registerBy', $_register_type) : '';
        ($_occupation != '') ? $this->db->where('t.professiontypeID', $_occupation) : '';
        ($_hospital != '') ? $this->db->where('t.hospitalID', $_hospital) : '';
        ($_course != '') ? $this->db->where('r.courseID', $_course) : '';
        /*
         * end filter
         */
        //$this->db->where('t.IsDelete', 0);
        $this->db->where('r.refType', 0); // edit for get user registration only
        $this->db->where('r.isDelete', 0);
        $this->db->order_by('r.registrationID', 'desc');
        $this->db->limit($this->context['limit'], $this->context['page']);
        $query = $this->db->get();
        // var_dump($query->result_array()); exit;
        return $query->result_array();
    }

    function addTrianee()
    {
        $ok = false;
        $data = array(
            'prefix' => $this->input->post('prefix'),
            'prefix_other' => $this->input->post('prefix_other'),
            'name' => $this->input->post('name'),
            'lastname' => $this->input->post('lastname'),
            'cardID' => $this->input->post('idcard'),
            'photo' => $this->context['picture'],
            'username' => $this->input->post('user'),
            'password' => $this->input->post('password'),
            'email' => $this->input->post('email'),
            'registrationtype' => $this->input->post('register_type'),
            'cohosname' => $this->input->post('coname'),
            'cohoslastname' => $this->input->post('colastname'),
            'cohostel' => $this->input->post('cotel'),
            'cohosmobile' => $this->input->post('comobile'),
            'cohosfax' => $this->input->post('cofax'),
            'cohosemail' => $this->input->post('coemail'),
            'professiontypeID' => $this->input->post('occupation'),
            'professionother' => $this->input->post('occupation_other'),
            'hospitalID' => $this->input->post('hospital_id'),
            'hospitalother' => $this->input->post('hospital_other'),
            'positionID' => $this->input->post('position'),
            'positionother' => $this->input->post('position_other'),
            'IsChange' => 0,
            'IsDelete' => 0,
            'createdatetime' => date('Y-m-d H:i:s'),
            'createuser' => $this->context['adminID'],
            'lastupdatetime' => date('Y-m-d H:i:s'),
            'updateuser' => 0,
            'profession_id' => $this->input->post('profession_id'),
            'hospital_member_id' => $this->input->post('hospital_member_id')
        );
        $data2 = array(
            'address' => $this->input->post('address'),
            'soi' => $this->input->post('soi'),
            'road' => $this->input->post('road'),
            'district' => $this->input->post('district'),
            'placetype' => $this->input->post('placetype'),
            'provinceID' => $this->input->post('province'),
            'postcode' => $this->input->post('zip'),
            'tel' => $this->input->post('tel'),
            'mobile' => $this->input->post('mobile'),
            'fax' => $this->input->post('fax'),
            'IsDelete' => 0
        );

        $this->db->trans_begin();
        $chkInsert = $this->db->insert('tbl_trainees', $data);
        $trianeeID = $this->db->insert_id();
        if (!$chkInsert) {
            $this->db->trans_rollback();
        } else {
            $data2['traineeID'] = $trianeeID;
            $addID = $this->db->insert('tbl_address', $data2);
            if (!$addID) {
                $this->db->trans_rollback();
            } else {

                $this->db->trans_commit();
                $arrLogin = array(
                    'traineeID' => $trianeeID,
                    'prefix' => $this->input->post('prefix'),
                    'prefix_other' => $this->input->post('prefix_other'),
                    'name' => $this->input->post('name'),
                    'lastname' => $this->input->post('lastname'),
                    'isLogin' => true
                );
                $this->session->set_userdata($arrLogin); // Auto Login
                $ok = true;

//                if ($this->updateMemberRegistered($this->input->post('name'), $this->input->post('lastname'), $trianeeID)) {
//                    $this->db->trans_commit();
//                    $arrLogin = array(
//                        'traineeID' => $trianeeID,
//                        'prefix' => $this->input->post('prefix'),
//                        'prefix_other' => $this->input->post('prefix_other'),
//                        'name' => $this->input->post('name'),
//                        'lastname' => $this->input->post('lastname'),
//                        'isLogin' => true
//                    );
//                    $this->session->set_userdata($arrLogin); // Auto Login
//                    $ok = true;
//                } else {
//                    $this->db->trans_rollback();
//                }

            }
        }
        return $ok;
    }

    function editTrianee()
    {
        $ok = false;
        $trianeeID = $this->input->post('traineeid');
        $addressID = $this->input->post('addressid');
        $data = array(
            'prefix' => $this->input->post('prefix'),
            'prefix_other' => $this->input->post('prefix_other'),
            'name' => $this->input->post('name'),
            'lastname' => $this->input->post('lastname'),
            'cardID' => $this->input->post('idcard'),
            'email' => $this->input->post('email'),
            'registrationtype' => $this->input->post('register_type'),
            'cohosname' => $this->input->post('coname'),
            'cohoslastname' => $this->input->post('colastname'),
            'cohostel' => $this->input->post('cotel'),
            'cohosmobile' => $this->input->post('comobile'),
            'cohosfax' => $this->input->post('cofax'),
            'cohosemail' => $this->input->post('coemail'),
            'professiontypeID' => $this->input->post('occupation'),
            'professionother' => $this->input->post('occupation_other'),
            'hospitalID' => $this->input->post('hospital_id'),
            'hospitalother' => $this->input->post('hospital_other'),
            'positionID' => $this->input->post('position'),
            'positionother' => $this->input->post('position_other'),
            'IsChange' => 0,
            'IsDelete' => 0,
            'createdatetime' => date('Y-m-d H:i:s'),
            'lastupdatetime' => date('Y-m-d H:i:s'),
            'updateuser' => $this->context['adminID'],
            'profession_id' => $this->input->post('profession_id'),
            'hospital_member_id' => $this->input->post('hospital_member_id')
        );
        if ($this->context['picture'] != '') {
            $data['photo'] = $this->context['picture'];
        }
        if ($this->input->post('password') != '') {
            $data['password'] = $this->input->post('password');
        }
        $data2 = array(
            'address' => $this->input->post('address'),
            'placetype' => $this->input->post('placetype'),
            'provinceID' => $this->input->post('province'),
            'postcode' => $this->input->post('zip'),
            'tel' => $this->input->post('tel'),
            'mobile' => $this->input->post('mobile'),
            'fax' => $this->input->post('fax'),
            'IsDelete' => 0
        );
        //var_dump($data,$data2); exit;
        $this->db->trans_begin();
        $this->db->where('traineeID', $trianeeID);
        $chkInsert = $this->db->update('tbl_trainees', $data);
        if (!$chkInsert) {
            $this->db->trans_rollback();
        } else {
            $this->db->where('addressID', $addressID);
            $updateID = $this->db->update('tbl_address', $data2);
            if (!$updateID) {
                $this->db->trans_rollback();
            } else {
                $ok = true;
                $this->db->trans_commit();
            }
        }
        return $ok;
    }

    function editTrianeeWithoutCo($trainee_id = 0)
    {
        //var_dump($_POST);exit;
        $ok = false;
        if ($trainee_id === 0) {
            $trianeeID = $this->input->post('traineeid');
            $addressID = $this->input->post('addressid');
        } else {
            $trianeeID = $trainee_id;
            $sql = $this->db->get_where('tbl_address', array('traineeID ' => $trianeeID), 1, 0);
            $res = $sql->result_array();
            $addressID = $res[0]['addressID'];
        }

        $data = array(
            'prefix' => $this->input->post('prefix'),
            'prefix_other' => $this->input->post('prefix_other'),
            'name' => $this->input->post('name'),
            'lastname' => $this->input->post('lastname'),
            'cardID' => $this->input->post('idcard'),
            'email' => $this->input->post('email'),
            'registrationtype' => $this->input->post('register_type'),
            'professiontypeID' => $this->input->post('occupation'),
            'professionother' => $this->input->post('occupation_other'),
            'hospitalID' => $this->input->post('hospital_id'),
            'hospitalother' => $this->input->post('hospital_other'),
            'positionID' => $this->input->post('position'),
            'positionother' => $this->input->post('position_other'),
            'IsChange' => 0,
            'IsDelete' => 0,
            'createdatetime' => date('Y-m-d H:i:s'),
            'lastupdatetime' => date('Y-m-d H:i:s'),
            'updateuser' => 0,
            'profession_id' => $this->input->post('profession_id'),
            'hospital_member_id' => $this->input->post('hospital_member_id')
        );
        if ($this->context['picture'] != '') {
            $data['photo'] = $this->context['picture'];
        }
        if ($this->input->post('user') != '') {
            $data['username'] = $this->input->post('user');
        }
        if ($this->input->post('password') != '') {
            $data['password'] = $this->input->post('password');
        }
        $data2 = array(
            'address' => $this->input->post('address'),
            'soi' => $this->input->post('soi'),
            'road' => $this->input->post('road'),
            'district' => $this->input->post('district'),
            'placetype' => $this->input->post('placetype'),
            'provinceID' => $this->input->post('province'),
            'postcode' => $this->input->post('zip'),
            'tel' => $this->input->post('tel'),
            'mobile' => $this->input->post('mobile'),
            'fax' => $this->input->post('fax'),
            'IsDelete' => 0
        );
        //var_dump($data,$data2); exit;
        $this->db->trans_begin();
        $this->db->where('traineeID', $trianeeID);
        $chkInsert = $this->db->update('tbl_trainees', $data);
        if (!$chkInsert) {
            $this->db->trans_rollback();
        } else {
            $this->db->where('addressID', $addressID);
            $updateID = $this->db->update('tbl_address', $data2);
            if (!$updateID) {
                $this->db->trans_rollback();
            } else {
                $ok = true;
                $this->db->trans_commit();
                if ($trainee_id !== 0) {
                    $arrLogin = array(
                        'traineeID' => $trainee_id,
                        'prefix' => $this->input->post('prefix'),
                        'prefix_other' => $this->input->post('prefix_other'),
                        'name' => $this->input->post('name'),
                        'lastname' => $this->input->post('lastname'),
                        'isLogin' => true
                    );
                    $this->session->set_userdata($arrLogin); // Auto Login
                    $ok = true;
                }
            }
        }
        return $ok;
    }

    function del_user($id)
    {
        $data = array(
            'IsDelete' => 1
        );
        // var_dump($data,$id); exit;
        $this->db->where('traineeID', $id);
        $res = $this->db->update('tbl_trainees', $data);
        return $res;
    }

    function del_register($registerID)
    {
        // var_dump($data,$id); exit;
        $sql = $this->db->get_where('tbl_registration', array('registrationID' => $registerID, 'isDelete' => 0), 1, 0);
        $data = $sql->result_array();
        $refID = $data[0]['refID'];
        if ($refID != 0) {
            $sql2 = $this->db->get_where('tbl_registration', array('refID' => $refID, 'isDelete' => 0));
            $totalRef = $sql2->num_rows();
            if ($totalRef == 1) {
                $this->db->where('registrationID', $refID);
                //$res2 = $this->db->delete('tbl_registration');
                $res = $this->db->update('tbl_registration', array('isDelete' => 1));
            }
        }
        $this->db->where('registrationID', $registerID);
        //$res = $this->db->delete('tbl_registration');
        $res = $this->db->update('tbl_registration', array('isDelete' => 1));
        return $res;
    }

    function get_user($id)
    {

        $this->db->select('*');
        $this->db->from('tbl_trainees');
        $this->db->join('tbl_address', 'tbl_address.traineeID = tbl_trainees.traineeID', 'left');
        $this->db->where('tbl_trainees.traineeID', $id);
        $this->db->limit(1, 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_user_profile($id)
    {
        $this->db->select('pf.title_th as prefix,t.prefix_other,t.name,t.lastname,t.email,d.tel,d.mobile,d.fax,o.title_th as occupation,t.professionother,p.position,t.positionother,d.address,pv.PROVINCE_NAME,d.postcode,d.soi,d.road,d.district,t.cardID,t.hospitalID');
        $this->db->from('tbl_trainees t');
        $this->db->join('tbl_address d', 'd.traineeID = t.traineeID', 'left');
        $this->db->join('tbl_prefix_name pf', 'pf.id = t.prefix', 'left');
        $this->db->join('tbl_occupation o', 'o.id = t.professiontypeID', 'left');
        $this->db->join('tbl_position p', 'p.positionID = t.positionID', 'left');
        $this->db->join('tbl_province pv', 'pv.PROVINCE_CODE = d.provinceID', 'left');
        $this->db->where('t.traineeID', $id);
        $this->db->limit(1, 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    function valid_m()
    {
        $ok = false;
        $username = $this->input->get('user');
        $query = $this->db->get_where('tbl_trainees', array('username' => $username));
        if ($query->num_rows() === 0) {
            $ok = true;
        }
        return $ok;
    }

    function valid_mail()
    {
        $ok = false;
        $email = $this->input->get('email');
        $query = $this->db->get_where('tbl_trainees', array('email' => $email, 'registrationtype' => 1));
        if ($query->num_rows() === 0) {
            $ok = true;
        }
        return $ok;
    }

    function getLastCourse($IsActive = false)
    {
        $this->db->select('c.*,(select count(t.registrationID) from tbl_registration t where t.courseID = c.courseID and t.refType=0) as total_trainees');
        ($IsActive) ? $this->db->where('c.IsActive', 0) : null;
        $this->db->where('c.isdelete', 0);
        $this->db->order_by('c.courseID', 'desc');
        $this->db->limit(1, 0);
        $query = $this->db->get('tbl_courses as c');
        return $query->result_array();
    }

    function getTotalRegisterByCourse($courseID)
    {
        $query = $this->db->get_where('tbl_registration', array('courseID' => $courseID, 'refType' => 0, 'isDelete' => 0));
        $count = $query->num_rows();
        return $count;
    }

    function getCourseByUser($id = 0, $refType = false)
    {
        $this->db->select('c.courseID,c.startdate,c.enddate,c.coursecode,c.generation,r.registerBy,r.IsPaid,r.registrationID,
        coursename,pt.paymenttype,p.detail,p.cheuqeno,p.bankname,p.paymentID,p.receiptno,p.paymenttypeID,
        p.cheuqeno,p.paiddatetime,rt.type_name as typename,c.content,c.qualification,c.objective,c.speaker,c.registstartdate,
        c.registenddate,r.registerdatetime,t.name,t.lastname,t.prefix,t.prefix_other,pf.title_th');
        $this->db->from('tbl_registration as r');
        $this->db->join('tbl_trainees as t', 'r.traineeID=t.traineeID', 'left');
        $this->db->join('tbl_register_type as rt', 'rt.type_id=r.registerBy', 'left');
        $this->db->join('tbl_courses as c', 'c.courseID=r.courseID', 'left');
        $this->db->join('tbl_payment as p', 'p.paymentID=r.paymentID', 'left');
        $this->db->join('tbl_prefix_name as pf', 'pf.id=t.prefix', 'left');
        $this->db->join('tbl_paymenttype as pt', 'pt.paymenttypeID=p.paymenttypeID', 'left');
        $this->db->order_by('r.registrationID', 'desc');
        $this->db->where('r.isDelete', 0);
        $this->db->where('r.traineeID', $id);
        $this->db->where('r.refID', 0);
        ($refType) ? $this->db->where('r.refType', 0) : '';
        $query = $this->db->get();
        return $query->result_array();
    }

    // register member //
    function addRegister()
    {
        $ok = false;
        $data = $this->context['data'];
        $dataRegist = array(
            'traineeID' => $data['traineeID'],
            'courseID' => $data['courseID'],
            'registerBy' => $data['registerBy'],
            'registerdatetime' => date('Y-m-d H:i:s'),
            'paymentID' => 0,
            'IsPaid' => 0,
            'food_id' => $data['own_food'],
        );
        $dataReserve = array();

        $this->db->trans_begin();
        $addID = $this->db->insert('tbl_registration', $dataRegist);
        $add_ID = $this->db->insert_id();
        if (!$addID) {
            $this->db->trans_rollback();
        } else {
            if ($data['registerBy'] == 3) {

                foreach ($data['register'] as $key => $val) {
                    $dataReserve[] = array(
                        'registrationID' => $add_ID,
                        'traineeID' => $data['traineeID'],
                        'courseID' => $data['courseID'],
                        'name' => $val['name'],
                        'lastname' => $val['lastname'],
                        'idcard' => $val['idcard'],
                        'email' => $val['email'],
                        'is_register' => 0,
                        'canceled' => 0,
                        'food_id' => $val['food']
                    );
                }
                $ID = $this->db->insert_batch('tbl_representive', $dataReserve);
                if (!$ID) {
                    $this->db->trans_rollback();
                } else {
                    $ok = true;
                    $this->db->trans_commit();
                }
            } else {
                $ok = true;
                $this->db->trans_commit();
            }
        }
        return $ok;
    }

    function addPaymentUpdateRegister()
    {
        $ok = false;
        $register = $this->context['register'];
        $dataPay = array(
            'receiptno' => $register['traineeID'],
            'paymenttypeID' => $this->context['payment_type'],
            'detail' => $this->context['desc'],
            'cheuqeno' => $this->context['cheq'],
            'bankname' => $this->context['bank_name'],
            'paiddatetime' => date('Y-m-d H:i:s'),
            'createdatetime' => date('Y-m-d H:i:s'),
            'createuser' => 0,
        );

        $this->db->trans_begin();
        $chkInsert = $this->db->insert('tbl_payment', $dataPay);
        $payID = $this->db->insert_id();
        if (!$chkInsert) {
            $this->db->trans_rollback();
        } else {
            $dataRegist = array(
                'paymentID' => $payID,
                'IsPaid' => 2 // request paid
            );
            $this->db->where('registrationID', $register['registerID']);
            $chkupdate = $this->db->update('tbl_registration', $dataRegist);
            if (!$chkupdate) {
                $this->db->trans_rollback();
            } else {
                $ok = true;
                $this->db->trans_commit();
            }
        }
        return $ok;
    }

    function addPaymentWithRegister()
    {
        $ok = false;
        $register = $this->context['register'];
        $billType = $this->context['receipt_type'];
        $billName = $this->context['nameBilling'];
        $billAdd = $this->context['addBilling'];
        $billSoi = $this->context['soiBilling'];
        $billRoad = $this->context['roadBilling'];
        $billDistrict = $this->context['districtBilling'];
        $billProvince = $this->context['provinceBilling'];
        $billPostcode = $this->context['postcodeBilling'];
        $billtaxID = $this->context['tax_id'];
        $billDefault = $this->context['default_add'];

        $dataPay = array(
            'receiptno' => $register['traineeID'],
            'paymenttypeID' => $this->context['payment_type'],
            'detail' => $this->context['desc'],
            'cheuqeno' => $this->context['cheq'],
            'bankname' => $this->context['bank_name'],
            'paiddatetime' => date('Y-m-d H:i:s'),
            'createdatetime' => date('Y-m-d H:i:s'),
            'createuser' => 0,
        );
        $dataRegist = array(
            'traineeID' => $register['traineeID'],
            'courseID' => $this->user_m->context['courseID'],
            'registerBy' => $register['registerBy'],
            'registerdatetime' => date('Y-m-d H:i:s'),
            'IsPaid' => $this->user_m->context['IsPaid'],//2, // request paid
            'food_id' => $register['own_food'],
            'refType' => ($register['registerBy'] == 3) ? 1 : 0
        );
        $dataReserve = array();

        $this->db->trans_begin();
        $chkInsert = $this->db->insert('tbl_payment', $dataPay);
        $payID = $this->db->insert_id();
        if (!$chkInsert) {
            $this->db->trans_rollback();
        } else {
            $dataRegist['paymentID'] = $payID;
            $addID = $this->db->insert('tbl_registration', $dataRegist);
            $add_ID = $this->db->insert_id();
            if (!$addID) {
                $this->db->trans_rollback();
            } else {
                if ($register['registerBy'] == 3) { /* edit register */

                    /* end receipt info */
                    $rowBill = 0;
                    foreach ($register['register'] as $key => $val) {
                        /* check trainee exists */
                        $trainee_name = trim($val['name']);
                        $trainee_lastname = trim($val['lastname']);
                        $trainee_email = trim($val['email']);
                        $trainee_prefix = trim($val['prefix']);
                        $trainee_occupation = trim($val['occupation']);
                        $food_id = trim($val['food']);
                        $resTrainee = $this->checkTraineeByName($trainee_name, $trainee_lastname);
                        if (count($resTrainee) == 1) {
                            $trainee_id = $resTrainee[0]['traineeID'];
                        } else {
                            /* crate new user */
                            $hospital = $this->get_user($register['traineeID']);
                            $data_trainee = array(
                                'prefix' => $trainee_prefix,
                                'name' => $trainee_name,
                                'lastname' => $trainee_lastname,
                                'email' => $trainee_email,
                                'registrationtype' => 3, // สรพ สมัครให้
                                'professiontypeID' => $trainee_occupation,
                                'IsChange' => 0,
                                'IsDelete' => 0,
                                'createdatetime' => date('Y-m-d H:i:s'),
                                'createuser' => 0,
                                'lastupdatetime' => date('Y-m-d H:i:s'),
                                'updateuser' => 0,
                                'hospitalID' => $hospital[0]['hospitalID']

                            );
                            $this->db->trans_begin();
                            $chkInsert_trainee = $this->db->insert('tbl_trainees', $data_trainee);
                            $trainee_id = $this->db->insert_id();
                            if (!$chkInsert_trainee) {
                                $this->db->trans_rollback();
                            } else {
                                $data_add = array(
                                    'traineeID' => $trainee_id,
                                    'IsDelete' => 0
                                );
                                $addressID = $this->db->insert('tbl_address', $data_add);
                                if (!$addressID) {
                                    $this->db->trans_rollback();
                                } else {
                                    $this->db->trans_commit();
                                }
                            }
                            /* end crate new user */
                        }
                        /* add registration */
                        $dataRegist_trainee = array(
                            'traineeID' => $trainee_id,
                            'refID' => $add_ID,
                            'refType' => 0,
                            'courseID' => $this->user_m->context['courseID'],
                            'registerBy' => $register['registerBy'],
                            'registerdatetime' => date('Y-m-d H:i:s'),
                            'IsPaid' => $this->user_m->context['IsPaid'], //2, // request paid
                            'food_id' => ($register['registerBy'] == 3) ? $food_id : $register['own_food']
                        );
                        $trainee_addID = $this->db->insert('tbl_registration', $dataRegist_trainee);
                        $trainee_add_ID = $this->db->insert_id();
                        if (!$trainee_addID) {
                            $this->db->trans_rollback();
                        } else {
                            /* receipt info */
                            if ($billType == 'separate') {
                                if ($billDefault == 1) {
                                    $this->addReceiptInfo($trainee_add_ID, $billName[$rowBill], $billAdd[0], $billSoi[0], $billRoad[0], $billDistrict[0], $billProvince[0], $billPostcode[0], $billtaxID[0]);
                                } else {
                                    $this->addReceiptInfo($trainee_add_ID, $billName[$rowBill], $billAdd[$rowBill], $billSoi[$rowBill], $billRoad[$rowBill], $billDistrict[$rowBill], $billProvince[$rowBill], $billPostcode[$rowBill], $billtaxID[$rowBill]);
                                }
                            } else {
                                $this->addReceiptInfo($trainee_add_ID, $billName, $billAdd, $billSoi, $billRoad, $billDistrict, $billProvince, $billPostcode, $billtaxID);
                            }
                            $this->db->trans_commit();
                        }
                        $rowBill++;
                        /* end recipt info */
                        /* end registration */
                        /* edit register */
                        $ok = $add_ID;

                    }
                } else {
                    $this->addReceiptInfo($add_ID, $billName, $billAdd, $billSoi, $billRoad, $billDistrict, $billProvince, $billPostcode, $billtaxID);
                    $ok = true;
                    $this->db->trans_commit();
                    $ok = $add_ID;
                }
            }
        }
        return $ok;
    }

    function updateMemberRegistered($name = '', $lastname = '', $memberID = 0)
    {
        $ok = false;
        $this->db->select('id,registrationID,traineeID,courseID,dateCreate');
        $qry1 = $this->db->get_where('tbl_representive',
            array('name' => $name,
                'lastname' => $lastname,
                'is_register' => 0,
                'canceled' => 0));

        if ($qry1->num_rows() > 0) {
            $data_1 = array();
            $data_1 = $qry1->result_array();
            $data_insert = array();
            $data_update = array();
            foreach ($data_1 as $key => $val) {
                $this->db->select('paymentID,registerstatus,registerBy,IsPaid');
                $qry2 = $this->db->get_where('tbl_registration', array('registrationID' => $val['registrationID']));
                if ($qry2->num_rows() > 0) {
                    $data_2 = array();
                    $data_2 = $qry2->result_array();
                    $data_insert[] = array(
                        'traineeID' => $memberID,
                        'courseID' => $val['courseID'],
                        'paymentID' => $data_2[0]['paymentID'],
                        'registerstatus' => $data_2[0]['registerstatus'],
                        'registerBy' => $data_2[0]['registerBy'],
                        'IsPaid' => $data_2[0]['IsPaid'],

                    );
                }
            }

            //$data_update = array('id' => $val['id'], 'is_register' => 1);
            $data_update = array('is_register' => 1);
            $this->db->trans_begin();
            $ID = $this->db->insert_batch('tbl_registration', $data_insert);
            if (!$ID) {
                $this->db->trans_rollback();
            } else {
                //$updateID = true;
                $this->db->where(array('name' => $name,
                    'lastname' => $lastname,
                    'is_register' => 0,
                    'canceled' => 0));
                $updateID = $this->db->update('tbl_representive', $data_update);
                if (!$updateID) {
                    $this->db->trans_rollback();
                } else {
                    $ok = true;
                    $this->db->trans_commit();
                }
            }
        } else {
            $ok = true;
        }
        return $ok;
    }

    /*
    function getRepresentive($registrationID = 0)
    {
        $this->db->select('name,lastname');
        $qry = $this->db->get_where('tbl_representive', array('registrationID' => $registrationID));
        return $qry->result_array();
    }*/

    function getRepresentive($registrationID = 0)
    {
        $criteria = array('r.refID' => $registrationID);
        $this->db->select('r.registrationID,t.name,t.lastname,t.prefix,t.prefix_other,pf.title_th');
        $this->db->from('tbl_registration r');
        $this->db->join('tbl_trainees t', 'r.traineeID = t.traineeID', 'left');
        $this->db->join('tbl_prefix_name pf', 'pf.id = t.prefix', 'left');
        $qry = $this->db->where($criteria);
        return $qry->get()->result_array();
    }

    function getForgetPassword()
    {
        $email = $this->input->post('email');
        $qry = $this->db->get_where('tbl_trainees', array('email' => $email), 1, 0);
        return $qry->result_array();
    }

    function getCourseExistsByUserId($traineeID, $CourseID)
    {
        $criteria = array('traineeID' => $traineeID, 'courseID' => $CourseID, 'registerBy' => 1, 'isDelete' => 0);
        $this->db->select('registrationID');
        $qry = $this->db->get_where('tbl_registration', $criteria, 1, 0);
        return $qry->result_array();
    }

    /*
    function getCourseExistsByRepresentative($name, $lastname, $CourseID)
    {
        $criteria = array('name' => $name, 'lastname' => $lastname, 'courseID' => $CourseID, 'canceled' => 0);
        $this->db->select('id');
        $qry = $this->db->get_where('tbl_representive', $criteria, 1, 0);
        return $qry->result_array();
    }
    */
    function getCourseExistsByRepresentative($name, $lastname, $CourseID)
    {
        $criteria = array('t.name' => $name, 't.lastname' => $lastname, 'r.courseID' => $CourseID, 'r.isDelete' => 0);
        $this->db->select('r.registrationID');
        $this->db->from('tbl_registration r');
        $this->db->join('tbl_trainees t', 'r.traineeID = t.traineeID', 'left');
        $qry = $this->db->where($criteria);
        return $qry->get()->result_array();
    }

    function getFoodType()
    {
        $qry = $this->db->get('tbl_food_type');
        return $qry->result_array();
    }

    function getBillingInfo($regisID)
    {
        $this->db->select("r.registrationID ,r.traineeID,r.courseID,r.registerBy,t.name,t.lastname,t.hospitalID,
        t.hospitalother,h.name as hospitalname,c.coursecode,c.generation,c.startdate,c.price,c.coursename,c.days,
        c.enddate,c.place,rc.name as receipt_name,t.email,r.registerdatetime,c.payenddate");
        $this->db->from('tbl_registration r');
        $this->db->join('tbl_trainees t', 'r.traineeID = t.traineeID', 'left');
        $this->db->join('hospital h', 't.hospitalID = h.hospitalid', 'left');
        $this->db->join('tbl_courses c', 'r.courseID = c.courseID', 'left');
        $this->db->join('tbl_receipt_info rc', 'rc.register_id = r.registrationID', 'left');
        $this->db->where('r.registrationID', $regisID);
        return $this->db->get()->result_array();
    }

    function getRegisterInfo($regisID)
    {
        $this->db->select('r.registrationID, r.traineeID, t.name, t.lastname, t.prefix,t.email, t.professiontypeID, t.positionid, r.food_id, rc.id as rc_id, rc.name as rc_name, rc.address as rc_address,rc.soi as rc_soi,rc.road as rc_road,rc.district as rc_district,rc.province as rc_province,rc.postcode as rc_postcode, rc.tax_id as rc_tax_id');
        $this->db->from('tbl_registration r');
        $this->db->join('tbl_trainees t', 'r.traineeID = t.traineeID', 'left');
        $this->db->join('tbl_receipt_info rc', 'rc.register_id = r.registrationID', 'left');
        $this->db->where('r.registrationID', $regisID);
        return $this->db->get()->result_array();

    }

    function updateRegistrationRefNo($regisID, $ref1, $ref2)
    {
        $ok = false;
        $data = array(
            'billing_ref1' => $ref1,
            'billing_ref2' => $ref2,
            'IsPaid' => 2
        );

        $this->db->where('registrationID', $regisID);
        $this->db->or_where('refID', $regisID);
        $update_id = $this->db->update('tbl_registration', $data);
        if (!$update_id) {
            $ok = false;
        } else {
            $ok = true;
        }
        return $ok;
    }

    function addReceiptInfo($regisID = 0, $name = '', $address = '', $soi = '', $road = '', $district = '', $province = '', $postcode = '', $taxID = '')
    {
        $ok = false;
        $data = array(
            'register_id' => $regisID,
            'name' => $name,
            'address' => $address,
            'soi' => $soi,
            'road' => $road,
            'district' => $district,
            'province' => $province,
            'postcode' => $postcode,
            'tax_id' => $taxID
        );
        $chkInsert = $this->db->insert('tbl_receipt_info', $data);
        if (!$chkInsert) {
            $ok = false;
        } else {
            $ok = true;
        }
        return $ok;

    }

    function checkRegisterExists($id)
    {
        $this->db->where('registrationID', $id);
        $this->db->from('tbl_registration');
        return $this->db->count_all_results();

    }

    function checkTraineeByName($name = '', $lastname = '')
    {
        $data = array(
            'name' => $name,
            'lastname' => $lastname
        );
        $qry = $this->db->get_where('tbl_trainees', $data, 1, 0);
        return $qry->result_array();
    }

    function updateTraineeChange()
    {
        $ok = false;
        $data = array(
            'name' => $this->input->post('name'),
            'lastname' => $this->input->post('lastname'),
            'email' => $this->input->post('email'),
            'prefix' => $this->input->post('prefix'),
            'professiontypeID' => $this->input->post('occupation'),
        );
        $this->db->where('traineeID', $this->input->post('traineeID'));
        $update_id = $this->db->update('tbl_trainees', $data);

        if (!$update_id) {
            $ok = false;
        } else {
            $ok = true;
        }
        return $ok;
    }

    function updateReceiptInfo()
    {
        $ok = false;
        $data = array(
            'name' => $this->input->post('rc_name'),
            'address' => $this->input->post('rc_address'),
            'soi' => $this->input->post('rc_soi'),
            'road' => $this->input->post('rc_road'),
            'district' => $this->input->post('rc_district'),
            'province' => $this->input->post('rc_province'),
            'postcode' => $this->input->post('rc_postcode'),
            'tax_id' => $this->input->post('rc_taxID')


        );
        $this->db->or_where('id', $this->input->post('receiptID'));
        $update_id = $this->db->update('tbl_receipt_info', $data);
        if (!$update_id) {
            $ok = false;
        } else {
            $data = array(
                'food_id' => $this->input->post('food')
            );
            $this->db->where('registrationID', $this->input->post('registrationID'));
            $update_id_food = $this->db->update('tbl_registration', $data);
            $ok = true;
        }
        return $ok;
    }

    function updateChangeRegister()
    {
        $trainee_name = trim($this->input->post('name'));
        $trainee_lastname = trim($this->input->post('lastname'));
        $resTrainee = $this->checkTraineeByName($trainee_name, $trainee_lastname);
        if (count($resTrainee) == 1) {
            $trainee_id = $resTrainee[0]['traineeID'];
        } else {
            /* crate new user */
            $hospital = $this->get_user($this->input->post('traineeID'));
            $data_trainee = array(

                'name' => $trainee_name,
                'lastname' => $trainee_lastname,
                'email' => $this->input->post('email'),
                'prefix' => $this->input->post('prefix'),
                'professiontypeID' => $this->input->post('occupation'),
                'registrationtype' => 3, // สรพ สมัครให้
                'IsChange' => 0,
                'IsDelete' => 0,
                'createdatetime' => date('Y-m-d H:i:s'),
                'createuser' => 0,
                'lastupdatetime' => date('Y-m-d H:i:s'),
                'updateuser' => 0,
                'hospitalID' => $hospital[0]['hospitalID']
            );
            $this->db->trans_begin();
            $chkInsert_trainee = $this->db->insert('tbl_trainees', $data_trainee);
            $trainee_id = $this->db->insert_id();
            if (!$chkInsert_trainee) {
                $this->db->trans_rollback();
            } else {
                $data_add = array(
                    'traineeID' => $trainee_id,
                    'IsDelete' => 0
                );
                $addressID = $this->db->insert('tbl_address', $data_add);
                if (!$addressID) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                }
            }
            /* end crate new user */
        }
        /* add registration */
        $data = array(
            'traineeID' => $trainee_id,
            'food_id' => $this->input->post('food')
        );
        $this->db->where('registrationID', $this->input->post('registrationID'));
        $update_id = $this->db->update('tbl_registration', $data);
        if ($update_id) {
            $datalog = array(
                'registrationID' => $this->input->post('registrationID'),
                'own_id' => $this->input->post('traineeID'),
                'new_id' => $trainee_id,
            );
            $this->db->insert('tbl_log_change', $datalog);
        }
    }

    function getAllUserList()
    {
        $arr = $this->context['filter'];
        $_name = (isset($arr['name'])) ? $arr['name'] : '';
        $_lastname = (isset($arr['lastname'])) ? $arr['lastname'] : '';
        $_register_type = (isset($arr['register_type'])) ? $arr['register_type'] : '';
        $_occupation = (isset($arr['position'])) ? $arr['position'] : '';
        $_hospital = (isset($arr['hospital'])) ? $arr['hospital'] : '';

        /* new query */
        $this->db->select('t.traineeID,t.prefix,pf.title_th as prefix_name,t.prefix_other,
        t.name,t.lastname,t.registrationtype,rt.type_name,t.hospitalid,h.name as hospital_name,
        t.hospitalother ,(select count(r.registrationID) from tbl_registration r where r.traineeID = t.traineeID and r.refType=0) as total_course');
        $this->db->from('tbl_trainees t');
        $this->db->join('tbl_prefix_name pf', 'pf.id = t.prefix', 'left');
        $this->db->join('tbl_register_type rt', 'rt.type_id = t.registrationtype', 'left');
        $this->db->join('hospital h', 'h.hospitalid = t.hospitalid', 'left');
        /* end new query */

        /*
         * filter
         */
        ($_name != '') ? $this->db->like('t.name', $_name) : '';
        ($_lastname != '') ? $this->db->like('t.lastname', $_lastname) : '';
        ($_register_type != '') ? $this->db->where('t.registrationtype', $_register_type) : '';
        ($_occupation != '') ? $this->db->where('t.professiontypeID', $_occupation) : '';
        ($_hospital != '') ? $this->db->where('t.hospitalid', $_hospital) : '';
        /*
         * end filter
         */
        $criteria = array(
            't.username !=' => '',
            'IsDelete' => 0
        );
        $this->db->where($criteria); // edit for get user registration only
        $this->db->order_by('t.traineeID', 'desc');
        $this->db->limit($this->context['limit'], $this->context['page']);
        $query = $this->db->get();
        // var_dump($query->result_array()); exit;
        return $query->result_array();
    }

    function getCountAllUserListByFilter()
    {

        $arr = $this->context['filter'];
        $_name = (isset($arr['name'])) ? $arr['name'] : '';
        $_lastname = (isset($arr['lastname'])) ? $arr['lastname'] : '';
        $_register_type = (isset($arr['register_type'])) ? $arr['register_type'] : '';
        $_occupation = (isset($arr['position'])) ? $arr['position'] : '';
        $_hospital = (isset($arr['hospital'])) ? $arr['hospital'] : '';

        $this->db->select('t.traineeID,t.prefix,pf.title_th as prefix_name,t.prefix_other,
        t.name,t.lastname,t.registrationtype,rt.type_name,t.hospitalid,h.name as hospital_name,
        t.hospitalother ,(select count(r.registrationID) from tbl_registration r where r.traineeID = t.traineeID and r.refType=0) as total_course');
        $this->db->from('tbl_trainees t');
        $this->db->join('tbl_prefix_name pf', 'pf.id = t.prefix', 'left');
        $this->db->join('tbl_register_type rt', 'rt.type_id = t.registrationtype', 'left');
        $this->db->join('hospital h', 'h.hospitalid = t.hospitalid', 'left');
        /*
         * filter
         */
        ($_name != '') ? $this->db->like('t.name', $_name) : '';
        ($_lastname != '') ? $this->db->like('t.lastname', $_lastname) : '';
        ($_register_type != '') ? $this->db->where('t.registrationtype', $_register_type) : '';
        ($_occupation != '') ? $this->db->where('t.professiontypeID', $_occupation) : '';
        ($_hospital != '') ? $this->db->where('t.hospitalid', $_hospital) : '';
        /*
         * end filter
         */
        $criteria = array(
            't.username !=' => '',
            'IsDelete' => 0
        );
        $this->db->where($criteria); // edit for get user registration only
        return $this->db->count_all_results();
    }

    function getCountAllUserList()
    {
        $criteria = array(
            'username !=' => '',
            'IsDelete' => 0
        );
        $this->db->select('traineeID');
        $this->db->from('tbl_trainees');
        $this->db->where($criteria);
        $total = $this->db->count_all_results();
        return $total;
    }

    function checkYourRegistration($registrationID = 0, $traineeID = 0)
    {
        $this->db->where('registrationID', $registrationID);
        $this->db->where('traineeID', $traineeID);
        $this->db->from('tbl_registration');
        return $this->db->count_all_results();

    }

    function removeYourRegistration($registrationID = 0, $traineeID = 0)
    {
        $ok = false;
        $this->db->where('registrationID', $registrationID);
        $this->db->or_where('refID', $registrationID);
        $res = $this->db->update('tbl_registration', array('isDelete' => 1));
        //$res = $this->db->delete('tbl_registration');
        if ($res) {
            //Log::setLog(2,$traineeID,array('remove'=>'registration','registrationID'=>$registrationID));
            $ok = true;
        }
        return $res;
    }

    function getSeatByRegistrationID($registrationID = 0)
    {
        $criteria = array(
            'registrationID' => $registrationID
        );
        $this->db->select('seatNo');
        $this->db->from('tbl_seats');
        $this->db->where($criteria);
        $res = $this->db->get()->result_array();
        return $res;
    }

    function getTmpId()
    {
        $this->db->select('id');
        $this->db->where('IsDelete', 0);
        $this->db->from('tbl_tmp_id');
        $this->db->order_by('id', 'asc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function delTmpId($id = 0)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_tmp_id', array('IsDelete' => 1));
    }

    function getRefInfo($registrationID = 0)
    {
        $this->db->select('billing_ref1,billing_ref2');
        $this->db->where('registrationID', $registrationID);
        $this->db->from('tbl_ref_no');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getRefNo($courseID = 0)
    {
        $this->db->where(array('courseID' => $courseID));
        $this->db->from('tbl_ref_no');
        return $this->db->count_all_results();
    }

    function setRefNo($registrationID = 0, $traineeID = 0, $courseID = 0, $billing_ref1 = 0, $billing_ref2 = 0)
    {
        $data = array(
            'registrationID' => $registrationID,
            'traineeID' => $traineeID,
            'courseID' => $courseID,
            'billing_ref1' => $billing_ref1,
            'billing_ref2' => $billing_ref2,
        );
        $this->db->insert('tbl_ref_no', $data);
        return $this->db->insert_id();
    }

    function getRemindWaiting()
    {
        $db = $this->db->query("SELECT a.registrationID ,b.email FROM tbl_registration a
left join tbl_trainees b on a.traineeID= b.traineeID
where a.isPaid = 2 and a.isDelete = 0 and a.refID = 0
and date(a.registerdatetime) = date(now()-interval 4 day)");

//        $this->db->select('registrationID');
//        $this->db->from('tbl_registration');
//        $this->db->where("isPaid = 2 and isDelete = 0 and refID = 0 and date(registerdatetime) = date(now()-interval 4 day)");
        $res = $db->result_array();
        return $res;
    }

    function getCountHospitalRegisterGroup($courseID)
    {
        $sql = "SELECT c.hospitalID,count(c.hospitalID) as total
FROM tbl_registration a
left join tbl_registration b on a.refID = b.registrationID
left join tbl_trainees c on c.traineeID = case a.refID when 0 then a.traineeID else b.traineeID end
where a.refType = 0 and a.isDelete = 0 and a.courseID = {$courseID}
group by c.hospitalID";
        $db = $this->db->query($sql);
        $res = $db->result_array();
        return $res;
    }

    function getHospitalRegistered($group_course)
    {
        $sql = "SELECT  b.hospitalID,a.courseID
FROM tbl_registration a
left join tbl_trainees b on b.traineeID = a.traineeID
where a.courseID in ({$group_course})
group by b.hospitalID,a.courseID";
        $db = $this->db->query($sql);
        $res = $db->result_array();
        return $res;
    }


}
